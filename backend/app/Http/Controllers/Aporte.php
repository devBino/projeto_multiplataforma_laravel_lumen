<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AporteResource;
use App\Http\Constants\Params;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza AporteResource
 * para salvar em bando de dados
 */
class Aporte{

    private $aporteResource;

    public function __construct(){
        $this->aporteResource = new AporteResource();
    }

    public function listar(){
        
        $this->aporteResource->setLimit(Params::DEFAULT_LIMIT_TABLES);

        return (new Response($this->aporteResource->listar(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function buscarId(Request $request){
        
        $this->aporteResource->setValorId( $request->id );

        return (new Response($this->aporteResource->buscarId(), Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];
        $params['dtAporte'] = $reqBody['data'];
        $params['cdStatus'] = $reqBody['status'];
        $params['taxaRetorno'] = $reqBody['taxaRetorno'];
        $params['taxaAdmin'] = $reqBody['taxaAdministracao'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->aporteResource->setParams($params);

        $sucesso = $this->aporteResource->salvar();

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
        $params['dtAporte'] = $reqBody['data'];
        $params['cdStatus'] = $reqBody['status'];
        $params['taxaRetorno'] = $reqBody['taxaRetorno'];
        $params['taxaAdmin'] = $reqBody['taxaAdministracao'];
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->aporteResource->setValorId($reqBody['id']);
        $this->aporteResource->setParams($params);

        $sucesso = $this->aporteResource->alterar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public function deletar(Request $request){

        $this->aporteResource->setValorId($request->id);

        $sucesso = $this->aporteResource->deletar();

        return (new Response(['sucesso'=>$sucesso], Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

}