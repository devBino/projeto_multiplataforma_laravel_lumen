<?php
namespace App\Http\Repositories\Abstracts;

use DB;
use Exception;
use App\Http\Constants\Params;

/**
 * @author Fernando Bino Mchado
 * @see
 *  Classe abstrata Query com CRUD padrão
 *  que será extendida pelos resources da API
 *  os resourses se encontram em
 * 
 * App\Http\Repositories\Resources
 * 
 */
abstract class Query{

    /**
     * Atributos que serão setados pelos resources
     */
    protected $tabela;
    protected $campoId;
    protected $valorId;
    protected $params;
    protected $limit;

    public function __construct(){
        $this->setLimit();
    }

    /**
     * Permite um resource listar os registros da tabela correspondente no banco de dados
     * $this->limit podera ser setado antes de chamar esse método
     */
    public function listar(){
        return DB::table($this->tabela)->select()->limit($this->limit)->get();
    }

    /**
     * Permite um resource buscar um registro de uma tabela pelo id
     */
    public function buscarId(){
        return DB::table($this->tabela)
            ->where($this->campoId, $this->valorId)
            ->select()
            ->get();
    }

    /**
     * Permite um resourse salvar um registro em uma tabela
     */
    public function salvar(){
        return DB::table($this->tabela)->insert($this->params);
    }

    /**
     * Permite um resource alterar os campos de um registro de uma tabela
     * enquanto o respectivo campo id for igual ao valor recebido
     */
    public function alterar(){
        
        return DB::table($this->tabela)
            ->where($this->campoId, $this->valorId)
            ->update($this->params);
        
    }

    /**
     * Permite um resource deletar um registro de uma tabela
     * pelo id recebido
     */
    public function deletar(){
        return DB::table($this->tabela)
            ->where($this->campoId, $this->valorId)
            ->delete();
    }

    /**
     * Métodos para setar valores dos atributos
     */
    public function setTabela($pTabela){
        $this->tabela = $pTabela;
    }

    public function setCampoId($pCampoId){
        $this->campoId = $pCampoId;
    }

    public function setValorId($pId){
        $this->valorId = $pId;
    }

    public function setParams($pParams){
        $this->params = $pParams;
    }

    public function setLimit($pLimit = Params::DEFAULT_LIMIT_TABLES){
        $this->limit = $pLimit;
    }

}