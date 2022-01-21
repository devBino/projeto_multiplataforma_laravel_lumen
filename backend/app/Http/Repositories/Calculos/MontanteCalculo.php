<?php
namespace App\Http\Repositories\Calculos;

use App\Http\Constants\Params;
use App\Http\Repositories\Calculos\Taxa as TAXA;

/**
 * @author Fernando Bino Machado
 * 
 * Classe provem recursos para cálculo de montantes e lucros
 * nos investimentos aportados
 */
class MontanteCalculo{

    private $valorAporte;
    private $taxaRetorno;
    private $tipo;
    private $taxaIr;
    private $taxaIof;
    private $diasCorridos;
    private $valorMontanteBruto;
    private $valorDescontos;
    private $valorMontanteLiquido;
    private $valorLucroBruto;
    private $valorLucroLiquido;

    public function __construct(){

    }

    public function setValorAporte($pValor){
        $this->valorAporte = $pValor;
    }

    public function getValorAporte(){
        return $this->valorAporte;
    }

    public function setTaxaRetorno($pTaxa){
        $this->taxaRetorno = $pTaxa;
    }
    
    public function getTaxaRetorno(){
        return $this->taxaRetorno;
    }

    public function setTipo($pTipo){
        $this->tipo = $pTipo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTaxaIr(){
        
        $this->taxaIr = TAXA::getTaxaIR($this->diasCorridos);

        if( $this->tipo == Params::RENDA_VARIAVEL ){
            $this->taxaIr = Params::TAXA_SOBRE_LUCRO;
        }

    }

    public function getTaxaIr(){
        return $this->taxaIr;
    }

    public function setTaxaIof(){
        $this->taxaIof = TAXA::getTaxaIOF($this->diasCorridos);
    }

    public function getTaxaIof(){
        return $this->taxaIof;
    }

    public function setDiasCorridos($pDias){
        $this->diasCorridos = $pDias;
    }

    public function getDiasCorridos(){
        return $this->diasCorridos;
    }

    public function getMontanteBruto(){
        return $this->valorMontanteBruto;
    }

    public function getValorDescontos(){
        return $this->valorDescontos;
    }

    public function getValorMontanteLiquido(){
        return $this->valorMontanteLiquido;
    }

    public function getValorLucroBruto(){
        return $this->valorLucroBruto;
    }
    
    public function getValorLucroLiquido(){
        return $this->valorLucroLiquido;
    }
 
    public function calcularValorMontanteBruto(){
        
    }

    public function calcularMontante(){
        echo "<pre>";print_r($this);die;
    }


}