<?php 

namespace App\Repositories;

use App\Models\Documento;

class DocumentoRepository extends Repository { 

    public function __construct() {
        parent::__construct(new Documento());
    }   
}