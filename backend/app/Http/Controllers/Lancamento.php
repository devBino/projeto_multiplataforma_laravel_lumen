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
class Lancamento extends ControllerValidator{

    private $lancamentoResource;

    public function __construct(){
        
        $this->lancamentoResource = new LancamentoResource();

        $this->setRegrasCamposPost([
            'descricao' => 'required|String',
            'valor' => 'required|Numeric',
            'data' => 'required|Date',
            'tipo' => 'required|Integer'
        ]);

        $this->setRegrasCamposPut([
            'id'=>'required|Integer',
            'descricao' => 'required|String',
            'valor' => 'required|Numeric',
            'data' => 'required|Date',
            'tipo' => 'required|Integer'
        ]);

    }

    public function listar(Request $request){
        
        $this->lancamentoResource->setRequest($request);
        $this->lancamentoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->lancamentoResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        //valida id
        $arrErros = $this->validarCampoId($request->id);

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //busca registro
        $this->lancamentoResource->setRequest($request);
        $this->lancamentoResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->lancamentoResource->buscarId()
        ));

    }

    public function salvar(Request $request){
        
        //valida campos
        $arrErros = $this->validarCamposPost($request->all());

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //salva registro
        $this->lancamentoResource->setRequest($request);

        $reqBody = $request->all();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtLancamento'] = $reqBody['data'];
        $params['cdTipo'] = $reqBody['tipo'];

        $this->lancamentoResource->setParams($params);

        $sucesso = $this->lancamentoResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function alterar(Request $request){
        
        //valida campos
        $arrErros = $this->validarCamposPut($request->input());

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //altera registro
        $this->lancamentoResource->setRequest($request);

        $reqBody = $request->input();

        $params = [];

        $params['descricao'] = $reqBody['descricao'];
        $params['valor'] = $reqBody['valor'];
        $params['dtLancamento'] = $reqBody['data'];
        $params['cdTipo'] = $reqBody['tipo'];

        $this->lancamentoResource->setValorId($reqBody['id']);
        $this->lancamentoResource->setParams($params);

        $sucesso = $this->lancamentoResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        //valida id
        $arrErros = $this->validarCampoId($request->id);

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //deleta registro
        $this->lancamentoResource->setRequest($request);
        $this->lancamentoResource->setValorId($request->id);

        $sucesso = $this->lancamentoResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}