<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AtivoResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza AtivoResource
 * para salvar em banco de dados
 */
class Ativo extends ControllerValidator{

    private $ativoResource;

    public function __construct(){

        $this->ativoResource = new AtivoResource();

        $this->setRegrasCamposPost([
            'nome'=>'required|String',
            'cotacao'=>'required|Numeric',
            'tipo'=>'required|Integer',
            'subTipo'=>'required|Integer',
            'taxaIr'=>'required|Numeric'
        ]);

        $this->setRegrasCamposPut([
            'id'=>'Integer',
            'nome'=>'required|String',
            'cotacao'=>'required|Numeric',
            'tipo'=>'required|Integer',
            'subTipo'=>'required|Integer',
            'taxaIr'=>'required|Numeric'
        ]);
        
    }

    public function listar(Request $request){
        
        $this->ativoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        $this->ativoResource->setRequest($request);

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->ativoResource->listar()
        ));

    }

    public function buscarId(Request $request){

        //valida id
        $arrErros = $this->validarCampoId($request->id);

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }
        
        //busca registro
        $this->ativoResource->setRequest($request);
        $this->ativoResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->ativoResource->buscarId()
        ));

    }

    public function salvar(Request $request){

        //valida campos
        $arrErros = $this->validarCamposPost($request->all());

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }
        
        //salva registro
        $this->ativoResource->setRequest($request);

        $reqBody = $request->input();
        
        $params = [];

        $params['nmPapel'] = $reqBody['nome'];
        $params['cotacao'] = $reqBody['cotacao'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['subTipo'] = $reqBody['subTipo'];
        $params['taxaIr'] = $reqBody['taxaIr'];
        
        $this->ativoResource->setParams($params);

        $sucesso = $this->ativoResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function alterar(Request $request){
        
        //valida campos
        $arrErros = $this->validarCamposPut($request->input());

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //altera registro
        $this->ativoResource->setRequest($request);

        $reqBody = $request->input();

        $params = [];

        $params['nmPapel'] = $reqBody['nome'];
        $params['cotacao'] = $reqBody['cotacao'];
        $params['cdTipo'] = $reqBody['tipo'];
        $params['subTipo'] = $reqBody['subTipo'];
        $params['taxaIr'] = $reqBody['taxaIr'];

        $this->ativoResource->setValorId($reqBody['id']);
        $this->ativoResource->setParams($params);

        $sucesso = $this->ativoResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        //valida id
        $arrErros = $this->validarCampoId($request->id);

        if( count($arrErros) ){
            return HttpResponse::httpStatus400( HttpResponse::prepareResponseBadRequest($arrErros));
        }

        //deleta registro
        $this->ativoResource->setRequest($request);
        $this->ativoResource->setValorId($request->id);

        $sucesso = $this->ativoResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}