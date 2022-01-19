<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\ProventoResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
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
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->proventoResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        $this->proventoResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->proventoResource->buscarId()
        ));

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

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

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

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->proventoResource->setValorId($request->id);

        $sucesso = $this->proventoResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}