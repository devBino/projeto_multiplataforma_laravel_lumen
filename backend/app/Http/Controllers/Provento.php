<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\ProventoResource;
use App\Http\Constants\Params;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza ProventoResource
 * para salvar em banco de dados
 */
class Provento{

    private $proventoResource;

    public function __construct(){
        $this->proventoResource = new ProventoResource();
    }

    public function listar(){
        
        $this->proventoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);

        return (new Response($this->proventoResource->listar(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function buscarId(Request $request){
        
        $this->proventoResource->setValorId( $request->id );

        return (new Response($this->proventoResource->buscarId(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['dtProvento'] = $reqBody['data'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->proventoResource->setParams($params);

        $sucesso = $this->proventoResource->salvar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function alterar(Request $request){
        
        $reqBody = $request->input();

        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['dtProvento'] = $reqBody['data'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->proventoResource->setValorId($reqBody['id']);
        $this->proventoResource->setParams($params);

        $sucesso = $this->proventoResource->alterar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function deletar(Request $request){

        $this->proventoResource->setValorId($request->id);

        $sucesso = $this->proventoResource->deletar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

}