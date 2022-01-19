<?php
namespace App\Http\Repositories\Abstracts;

use DB;

abstract class Query{

    protected $tabela;
    protected $id;
    protected $params;

    public function __construct(){

    }

    public function listar(){
        return DB::table($this->tabela)->select()->get();
    }

    /*public abstract function salvar();
    public abstract function alterar();
    public abstract function deletar();*/

    public function setTabela($pTabela){
        $this->tabela = $pTabela;
    }

    public function setId($pId){
        $this->id = $pId;
    }

    public function setParams($pParams){
        $this->params = $pParams;
    }

}