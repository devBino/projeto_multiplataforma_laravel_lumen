<?php
namespace App\Http\Repositories\Responses;

use Illuminate\Http\Response;
use App\Http\Constants\Params;

/**
 * @author Fernando Bino Machado
 * @see
 *  Classe provem funções para tratar e retornar os reponses 
 *  de maneira padronizada
 */
class HttpResponse{

    public static function httpStatus200( $pResponse ){

        return (new Response($pResponse, Params::STATUS_HTTP_200))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public static function httpStatus500( $pResponse ){

        return (new Response($pResponse, Params::STATUS_HTTP_500))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public static function httpStatus401( $pResponse ){

        return (new Response($pResponse, Params::STATUS_HTTP_401))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public static function httpStatus400( $pResponse ){

        return (new Response($pResponse, Params::STATUS_HTTP_400))
            ->header("Content-Type", Params::TYPE_JSON);

    }

    public static function prepareResponseOperacao( $pSucesso  ){

        $dataResponse = [];
    
        $dataResponse['mensagem'] = ($pSucesso || $pSucesso == 1) ? Params::MSG_SUCCESS : Params::MSG_WARNING;
        $dataResponse['sucesso'] = ($pSucesso || $pSucesso == 1) ? true : false;
        $dataResponse['registros'] = [];

        return $dataResponse;
        
    }

    public static function prepareResponseListagem( $pResponseLista ){

        $dataResponse = [];
    
        $dataResponse['mensagem'] = Params::MSG_SUCCESS;
        $dataResponse['sucesso'] = true;
        $dataResponse['registros'] = $pResponseLista;

        return $dataResponse;

    }

    public static function prepareResponseBadRequest( $pResponseLista ){

        $dataResponse = [];
    
        $dataResponse['mensagem'] = Params::MSG_ERROR;
        $dataResponse['sucesso'] = false;
        $dataResponse['registros'] = [];
        $dataResponse['erros'] = $pResponseLista;

        return $dataResponse;

    }
    
    public static function prepareResponseToken( $pToken, $user, $pSucesso ){

        $dataResponse = [];

        $dataResponse['mensagem'] = $pSucesso ? "Token recuperado com sucesso..." : "Erro ao recuperar token...";
        $dataResponse['sucesso'] = $pSucesso;
        $dataResponse['token'] = $pSucesso ? $pToken : false;
        $dataResponse['user'] = $user;

        return $dataResponse;

    }

    

}