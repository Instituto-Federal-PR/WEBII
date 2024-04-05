<?php 

namespace App\Repositories;

use App\Models\Documento;
use App\Repositories\CategoriaRepository;

class DocumentoRepository extends Repository { 

    private $map = [-1 => 'RECUSADO', 0 => 'SOLICITADO', 1 => 'ACEITO' ];

    public function __construct() {
        parent::__construct(new Documento());
    }
    
    public function mapStatus($data) {

        if(!is_array($data))
            $data->status = $this->map[$data->status]; 
        else 
            for($a=0; $a<count($data); $a++)
                $data[$a]['status'] = $this->map[$data[$a]['status']];

        return $data;
    }

    public function getDocumentsToAssess($curso_id) {

        $arr = array();
        $categorias = ((new CategoriaRepository())->findByColumn('curso_id', $curso_id));
        foreach($categorias as $c) array_push($arr, $c->id);
        
        $data = Documento::with(['categoria', 'user'])->whereIn('categoria_id', $arr)
            ->where('status', 0)->orderBy('created_at')->get();

        return $data;
    }
}