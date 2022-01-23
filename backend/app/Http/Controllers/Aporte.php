<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AtivoResource;
use App\Http\Repositories\Resources\AporteResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza AporteResource
 * para salvar em banco de dados
 */
class Aporte{

    private $aporteResource;
    private $ativoResource;

    public function __construct(){
        $this->aporteResource = new AporteResource();
        $this->ativoResource = new AtivoResource();
    }

    public function listar(Request $request){
        
        $this->aporteResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        $this->aporteResource->setRequest($request);

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->aporteResource->listar()
        ));
        
    }

    public function buscarId(Request $request){
        
        $this->aporteResource->setValorId( $request->id );
        $this->aporteResource->setRequest($request);

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->aporteResource->buscarId()
        ));
        
    }

    public function salvar(Request $request){
        
        $this->aporteResource->setRequest($request);

        $reqBody = $request->all();

        //verifica se o ativo pertence ao usuário dono do token
        $this->ativoResource->setValorId($reqBody['papel']);
        $this->ativoResource->setRequest($request);

        $dadosAtivo = $this->ativoResource->buscarId();

        if( !count($dadosAtivo) ){
            return HttpResponse::httpStatus401( HttpResponse::prepareResponseOperacao(false) );
        }

        //caso ativo esteja vinculado ao usuário dono do token
        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];
        $params['dtAporte'] = $reqBody['data'];
        $params['cdStatus'] = $reqBody['status'];
        $params['taxaRetorno'] = $reqBody['taxaRetorno'];
        $params['taxaAdmin'] = $reqBody['taxaAdministracao'];
        
        $this->aporteResource->setParams($params);

        $sucesso = $this->aporteResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );
        
    }

    public function alterar(Request $request){
        
        $this->aporteResource->setRequest($request);

        $reqBody = $request->input();

        //verifica se o ativo pertence ao usuário dono do token
        $this->ativoResource->setValorId($reqBody['papel']);
        $this->ativoResource->setRequest($request);

        $dadosAtivo = $this->ativoResource->buscarId();

        if( !count($dadosAtivo) ){
            return HttpResponse::httpStatus401( HttpResponse::prepareResponseOperacao(false) );
        }

        //caso ativo esteja vinculado ao usuário dono do token
        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];
        $params['dtAporte'] = $reqBody['data'];
        $params['cdStatus'] = $reqBody['status'];
        $params['taxaRetorno'] = $reqBody['taxaRetorno'];
        $params['taxaAdmin'] = $reqBody['taxaAdministracao'];
        
        $this->aporteResource->setValorId($reqBody['id']);
        $this->aporteResource->setParams($params);

        $sucesso = $this->aporteResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->aporteResource->setRequest($request);
        $this->aporteResource->setValorId($request->id);

        $sucesso = $this->aporteResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}