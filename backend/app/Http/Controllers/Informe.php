<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\InformeResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza InformeResource
 * para salvar em banco de dados
 */
class Informe{

    private $informeResource;

    public function __construct(){
        $this->informeResource = new InformeResource();
    }

    public function listar(){
        
        $this->informeResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->informeResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        $this->informeResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->informeResource->buscarId()
        ));

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtInforme'] = $reqBody['data'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->informeResource->setParams($params);

        $sucesso = $this->informeResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function alterar(Request $request){
        
        $reqBody = $request->input();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtInforme'] = $reqBody['data'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->informeResource->setValorId($reqBody['id']);
        $this->informeResource->setParams($params);

        $sucesso = $this->informeResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->informeResource->setValorId($request->id);

        $sucesso = $this->informeResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}