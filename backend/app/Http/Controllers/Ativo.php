<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AtivoResource;
use App\Http\Constants\Params;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza AtivoResource
 * para salvar em bando de dados
 */
class Ativo{

    private $ativoResource;

    public function __construct(){
        $this->ativoResource = new AtivoResource();
    }

    public function listar(){
        
        $this->ativoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);

        return (new Response($this->ativoResource->listar(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function buscarId(Request $request){
        
        $this->ativoResource->setValorId( $request->id );

        return (new Response($this->ativoResource->buscarId(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $params = [];

        $params['nmPapel'] = $reqBody['nome'];
        $params['cotacao'] = $reqBody['cotacao'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['subTipo'] =$reqBody['subTipo'];
        $params['taxaIr'] = $reqBody['taxaIr'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->ativoResource->setParams($params);

        $sucesso = $this->ativoResource->salvar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function alterar(Request $request){
        
        $reqBody = $request->input();

        $params = [];

        $params['nmPapel'] = $reqBody['nome'];
        $params['cotacao'] = $reqBody['cotacao'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['subTipo'] = $reqBody['subTipo'];
        $params['taxaIr'] = $reqBody['taxaIr'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->ativoResource->setValorId($reqBody['id']);
        $this->ativoResource->setParams($params);

        $sucesso = $this->ativoResource->alterar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function deletar(Request $request){

        $this->ativoResource->setValorId($request->id);

        $sucesso = $this->ativoResource->deletar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

}