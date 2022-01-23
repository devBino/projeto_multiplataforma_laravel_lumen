<?php
namespace App\Http\Repositories\Abstracts;

use DB;
use Exception;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

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
    protected $request;
    
    public function __construct(){    
        $this->setLimit();
    }

    /**
     * Permite um resource listar os registros da tabela correspondente no banco de dados
     * $this->limit podera ser setado antes de chamar esse método
     */
    public function listar(){
        try{
            return DB::table($this->tabela)
                ->select()
                ->where(Params::CD_USUARIO, $this->getIdToken())
                ->limit($this->limit)
                ->get();
        }catch(Exception $err){

            if( env('APP_DEBUG') ){
                echo "<pre>";print_r($err->getMessage());die;
            }

            return array();
        }
    }

    /**
     * Permite um resource buscar um registro de uma tabela pelo id
     */
    public function buscarId(){
        try{
            return DB::table($this->tabela)
                ->select()
                ->where($this->campoId, $this->valorId)
                ->where(Params::CD_USUARIO, $this->getIdToken())
                ->get();
        }catch(Exception $err){

            if( env('APP_DEBUG') ){
                echo "<pre>";print_r($err->getMessage());die;
            }

            return array();
        }
    }

    /**
     * Permite um resourse salvar um registro em uma tabela
     */
    public function salvar(){
        try{
            return DB::table($this->tabela)->insert($this->params);
        }catch(Exception $err){

            if( env('APP_DEBUG') ){
                echo "<pre>";print_r($err->getMessage());die;
            }

            return array();
        }
    }

    /**
     * Permite um resource alterar os campos de um registro de uma tabela
     * enquanto o respectivo campo id for igual ao valor recebido
     */
    public function alterar(){
        try{
            return DB::table($this->tabela)
                ->where($this->campoId, $this->valorId)
                ->where(Params::CD_USUARIO, $this->getIdToken())
                ->update($this->params);
        }catch(Exception $err){

            if( env('APP_DEBUG') ){
                echo "<pre>";print_r($err->getMessage());die;
            }

            return array();
        }
    }

    /**
     * Permite um resource deletar um registro de uma tabela
     * pelo id recebido
     */
    public function deletar(){
        try{
            return DB::table($this->tabela)
                ->where($this->campoId, $this->valorId)
                ->where(Params::CD_USUARIO, $this->getIdToken())
                ->delete();
        }catch(Exception $err){

            if( env('APP_DEBUG') ){
                echo "<pre>";print_r($err->getMessage());die;
            }

            return array();
        }
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
        $pParams[Params::CD_USUARIO] = $this->getIdToken();
        $this->params = $pParams;
    }

    public function setLimit($pLimit = Params::DEFAULT_LIMIT_TABLES){
        $this->limit = $pLimit;
    }

    public function setRequest(Request $pRequest){
        $this->request = $pRequest;
    }

    public function getIdToken(){
        
        $dadosToken = $this->request->header(Params::X_ACCESS_TOKEN);
        $arrDados = explode("_", $dadosToken);
        
        return end($arrDados);

    }

}