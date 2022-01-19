<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class AtivoResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("papel");

    }

}