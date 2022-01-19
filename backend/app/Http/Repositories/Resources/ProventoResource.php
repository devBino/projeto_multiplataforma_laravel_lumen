<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class ProventoResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("proventos");
        $this->setCampoId("cdProvento");

    }

}