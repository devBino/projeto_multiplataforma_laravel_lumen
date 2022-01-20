<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;

class LancamentoResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("lancamentos");
        $this->setCampoId("cdLancamento");

    }

}