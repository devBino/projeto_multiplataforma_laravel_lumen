<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;

class IsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        //recupera e valida token
        $requestToken = $request->header(Params::X_ACCESS_TOKEN);
        
        $dadosUsuario = unserialize( 
            app('redis')->get( $request->header(Params::USER) )
        );

        //caso token inválido ou expirado
        if( !(is_array( $dadosUsuario ) && isset($dadosUsuario['token']) && $dadosUsuario['token'] == $requestToken) ){
        
            $dataResponse = [];

            $dataResponse['mensage'] = "Token inválido ou expirado, se autentique e tente novamente...";
            $dataResponse['sucesso'] = false;
            $dataResponse['token'] = false;

            return HttpResponse::httpStatus401($dataResponse);
        }

        return $next($request);
    
    }
}
