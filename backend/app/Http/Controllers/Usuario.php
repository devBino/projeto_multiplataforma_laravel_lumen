<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\UsuarioResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Constants\Params;
use Illuminate\Http\Request;

/**
 * Recebe as requisições e utiliza UsuarioResource
 * para salvar em banco de dados
 */
class Usuario{

    private $usuarioResource;

    public function __construct(){
        $this->usuarioResource = new UsuarioResource();
    }

    public function autenticar(Request $request){
        
        //busca dados do usuário com as credenciais recebidas
        $dadosUsuario = $this->usuarioResource->buscarDadosCredenciais($request->user,$request->pass);

        //caso tenha encontrado usuário com as credenciais
        if( count($dadosUsuario) ){
            
            $token = sha1( $dadosUsuario[0]->nmUsuario . $dadosUsuario[0]->dsSenha . env('SECRET_API') );

            app('redis')->set($request->user, serialize(['token'=>$token]));
            app('redis')->expire($request->user, intval(env('TIME_EXPIRE_TOKEN')) );

            return HttpResponse::httpStatus200( HttpResponse::prepareResponseToken($token, $request->user, true));
            
        }

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseToken(false, null, false));

    }

    

}