<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Repositories\Responses\HttpResponse;

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
        $requestToken = $request->header('x-access-token');
        
        $dadosUsuario = unserialize( 
            app('redis')->get( $request->header('user') )
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
