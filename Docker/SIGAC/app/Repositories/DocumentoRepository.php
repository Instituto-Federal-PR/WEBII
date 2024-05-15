<?php 

namespace App\Repositories;

use App\Models\Categoria;
use App\Models\Documento;
use App\Repositories\CategoriaRepository;

class DocumentoRepository extends Repository { 

    protected $rows = 6;
    private $map = [-1 => 'RECUSADO', 0 => 'SOLICITADO', 1 => 'ACEITO' ];

    public function __construct() {
        parent::__construct(new Documento());
    }

    public function getRows() { return $this->rows; }
    
    public function mapStatus($data) {

        if(!is_array($data))
            $data->status = $this->map[$data->status]; 
        else 
            for($a=0; $a<count($data); $a++)
                $data[$a]['status'] = $this->getMapStatus($data[$a]['status']);

        return $data;
    }

    public function getDocumentsToAssess($curso_id, $paginate) {

        $arr = array();
        $categorias = (new CategoriaRepository())->findByColumn(
            'curso_id', 
            $curso_id,
            (object) ["use" => false, "rows" => $this->rows]
        );
        // $categorias = Categoria::where('curso_id', $curso_id)->get();
        foreach($categorias as $c) array_push($arr, $c->id);
        
        if($paginate) {
            $data = Documento::with(['categoria', 'user'])->whereIn('categoria_id', $arr)
                ->where('status', 0)->orderBy('created_at')->paginate($this->rows);
        }
        else {
            $data = Documento::with(['categoria', 'user'])->whereIn('categoria_id', $arr)
                ->where('status', 0)->orderBy('created_at')->get();
        }

        return $data;
    }

    public function getTotalHoursByStudent($user_id) {

        return (object) [
            "total_in" => Documento::where('user_id', $user_id)->sum('horas_in'),
            "total_out" => Documento::where('user_id', $user_id)->sum('horas_out'),
        ];

        /*return Documento::where('user_id', $user_id)
                ->selectRaw("SUM(horas_in) as total_in")
                ->selectRaw("SUM(horas_out) as total_out")
                ->first();*/
    }

    public function getMapStatus($status) {
        return $this->map[$status];
    }
}