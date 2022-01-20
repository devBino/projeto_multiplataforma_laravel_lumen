<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\LancamentoResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza LancamentoResource
 * para salvar em banco de dados
 */
class Lancamento{

    private $lancamentoResource;

    public function __construct(){
        $this->lancamentoResource = new LancamentoResource();
    }

    public function listar(){
        
        $this->lancamentoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->lancamentoResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        $this->lancamentoResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->lancamentoResource->buscarId()
        ));

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtLancamento'] = $reqBody['data'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->lancamentoResource->setParams($params);

        $sucesso = $this->lancamentoResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function alterar(Request $request){
        
        $reqBody = $request->input();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtLancamento'] = $reqBody['data'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->lancamentoResource->setValorId($reqBody['id']);
        $this->lancamentoResource->setParams($params);

        $sucesso = $this->lancamentoResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->lancamentoResource->setValorId($request->id);

        $sucesso = $this->lancamentoResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}