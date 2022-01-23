<?php
namespace App\Http\Repositories\Resources;

use App\Http\Repositories\Abstracts\Query;
use DB;

class UsuarioResource extends Query{

    public function __construct(){
        
        parent::__construct();

        $this->setTabela("usuario");
        $this->setCampoId("cdUsuario");

    }

    public function buscarDadosCredenciais($user, $pass){

        $dadosUsuario = DB::table($this->tabela)
            ->select()
            ->where('nmUsuario', $user)
            ->where('dsSenha', sha1($pass))
            ->get();

        return $dadosUsuario;

    }

}