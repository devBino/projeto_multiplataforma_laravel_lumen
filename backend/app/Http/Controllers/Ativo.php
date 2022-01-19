<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\AtivoResource;
use Illuminate\Http\Response;

class Ativo{

    private $ativoResource;

    public function listar(){
        
        $this->ativoResource = new AtivoResource();
        
        return (new Response($this->ativoResource->listar(),200))
            ->header("Content-Type", "application/json");

    }

}