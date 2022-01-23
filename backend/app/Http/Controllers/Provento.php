<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AtivoResource;
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
    private $ativoResource;

    public function __construct(){
        $this->proventoResource = new ProventoResource();
        $this->ativoResource = new AtivoResource();
    }

    public function listar(Request $request){
        
        $this->proventoResource->setRequest($request);
        $this->proventoResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->proventoResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        $this->proventoResource->setRequest($request);
        $this->proventoResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->proventoResource->buscarId()
        ));

    }

    public function salvar(Request $request){
        
        $this->proventoResource->setRequest($request);

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
        $params['cdTipo'] = $reqBody['tipo'];
        $params['dtProvento'] = $reqBody['data'];
        
        $this->proventoResource->setParams($params);

        $sucesso = $this->proventoResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function alterar(Request $request){
        
        $this->proventoResource->setRequest($request);

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
        $params['cdTipo'] = $reqBody['tipo'];
        $params['dtProvento'] = $reqBody['data'];
        
        $this->proventoResource->setValorId($reqBody['id']);
        $this->proventoResource->setParams($params);

        $sucesso = $this->proventoResource->alterar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->proventoResource->setRequest($request);
        $this->proventoResource->setValorId($request->id);

        $sucesso = $this->proventoResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}