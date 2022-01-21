<?php
namespace App\Http\Repositories\Builder;

use App\Http\Repositories\Calculos\MontanteCalculo;

/**
 * @author Fernando Bino Machado
 * 
 * Classe Builder para otimizar uso da classe MontanteCalculo
 * 
 * @see
 * os métodos setDiasCorridos() e setTipo()
 * deverão ser os primeiros a serem invocados ao utilizar esse builder,
 * porque outros métodos irão precisa da informação de dias corridos e do tipo 
 * do aporte para realizar os cálculos
 */
class MontanteCalculoBuilder{

    private $instance;

    public function __construct(){
        $this->instance = new MontanteCalculo();
    }

    public function setTipo($pTipo){
        $this->instance->setTipo($pTipo);
        return $this;
    }

    public function setDiasCorridos($pDias){
        $this->instance->setDiasCorridos($pDias);
        return $this;
    }

    public function setValorAporte($pValor){
        $this->instance->setValorAporte($pValor);
        return $this;
    }

    public function setValorAtual($pValor){
        $this->instance->setValorAtual($pValor);
        return $this;
    }

    public function setTaxaRetorno($pTaxa){
        $this->instance->setTaxaRetorno($pTaxa);
        return $this;
    }
    
    public function setTaxaIr(){
        $this->instance->setTaxaIr();
        return $this;
    }

    public function setTaxaIof(){
        $this->instance->setTaxaIof();
        return $this;
    }

    public function setTaxaAdmin($pTaxa){
        $this->instance->setTaxaAdmin($pTaxa);
        return $this;
    }

    public function builder(){
        $this->instance->calcularMontante();
        return $this->instance;
    }

}