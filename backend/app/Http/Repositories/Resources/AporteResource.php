<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class AporteResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("aportes");
        $this->setCampoId("cdAporte");

    }

}