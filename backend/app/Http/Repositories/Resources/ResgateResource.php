<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class ResgateResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("resgates");
        $this->setCampoId("cdResgate");

    }

}