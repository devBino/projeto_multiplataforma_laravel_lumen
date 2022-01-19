<?php
namespace App\Http\Repositories\Responses;

use Illuminate\Http\Response;
use App\Http\Constants\Params;

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

}