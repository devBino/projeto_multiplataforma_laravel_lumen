<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class InformeResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("informe");
        $this->setCampoId("cdInforme");

    }

}