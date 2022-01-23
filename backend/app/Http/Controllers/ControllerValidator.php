<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\Responses\HttpResponse;
use Validator;


class ControllerValidator{
    
    private $regrasCamposPost;
    private $regrasCamposPut;
    private $regrasCampoId = ['id=>required|Integer'];

    public function validarCamposPost($pParams){

        $arrErros = [];

        if( is_array($this->regrasCamposPost) && count($this->regrasCamposPost) ){
            
            $validator = Validator::make($pParams, $this->regrasCamposPost);
            
            if( count( $validator->errors()->getMessages()) ){
                foreach($validator->errors()->getMessages() as $e => $v){
                    $arrErros[] = $v[0];
                }
            }

        }

        return $arrErros;

    }

    public function validarCamposPut($pParams){

        $arrErros = [];

        if( is_array($this->regrasCamposPut) && count($this->regrasCamposPut) ){
            
            $validator = Validator::make($pParams, $this->regrasCamposPut);
            
            if( count( $validator->errors()->getMessages()) ){
                foreach($validator->errors()->getMessages() as $e => $v){
                    $arrErros[] = $v[0];
                }
            }

        }

        return $arrErros;

    }

    public function validarCampoId($id){

        $arrErros = [];

        if( !empty($id) && !is_numeric($id) ){
            $arrErros[] = "The id must be an integer.";
        }

        return $arrErros;

    }

    public function setRegrasCamposPost($pRegras){
        $this->regrasCamposPost = $pRegras;
    }

    public function setRegrasCamposPut($pRegras){
        $this->regrasCamposPut = $pRegras;
    }


}
