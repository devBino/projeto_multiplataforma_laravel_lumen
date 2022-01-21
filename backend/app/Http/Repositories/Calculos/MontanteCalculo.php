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
    private $valorAtual;
    private $taxaRetorno;
    private $tipo;
    private $taxaIr;
    private $descontoIr;
    private $taxaIof;
    private $descontoIof;
    private $taxaAdmin;
    private $descontoAdmin;
    private $diasCorridos;
    private $valorMontanteBruto;
    private $valorDescontos;
    private $valorMontanteLiquido;
    private $valorLucroBruto;
    private $valorLucroLiquido;

    public function __construct(){
        
        $this->valorAporte = 0;
        $this->valorAtual = 0;
        $this->taxaRetorno = 0;
        $this->tipo = 0;
        $this->taxaIr = 0;
        $this->descontoIr = 0;
        $this->taxaIof = 0;
        $this->descontoIof = 0;
        $this->taxaAdmin = 0;
        $this->descontoAdmin = 0;
        $this->diasCorridos = 0;
        $this->valorMontanteBruto = 0;
        $this->valorDescontos = 0;
        $this->valorMontanteLiquido = 0;
        $this->valorLucroBruto = 0;
        $this->valorLucroLiquido = 0;

    }

    public function setValorAporte($pValor){
        $this->valorAporte = floatval($pValor);
    }

    public function getValorAporte(){
        return $this->valorAporte;
    }

    public function setValorAtual($pValor){
        $this->valorAtual = floatval($pValor);
    }

    public function getValorAtual(){
        return $this->valorAtual;
    }

    public function setTaxaRetorno($pTaxa){
        $this->taxaRetorno = floatval($pTaxa);
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
        
        $this->taxaIr = floatval(TAXA::getTaxaIR($this->diasCorridos));

        if( $this->tipo == Params::RENDA_VARIAVEL ){
            $this->taxaIr = floatval(Params::TAXA_SOBRE_LUCRO);
        }

    }

    public function getTaxaIr(){
        return $this->taxaIr;
    }

    public function setTaxaIof(){
        $this->taxaIof = floatval(TAXA::getTaxaIOF($this->diasCorridos));
    }

    public function getTaxaIof(){
        return $this->taxaIof;
    }

    public function setTaxaAdmin($pTaxa){
        $this->taxaAdmin = floatval($pTaxa);
    }

    public function getTaxaAdmin(){
        return $this->taxaAdmin;
    }

    public function setDiasCorridos($pDias){
        $this->diasCorridos = $pDias;
    }

    public function getDiasCorridos(){
        return $this->diasCorridos;
    }

    public function getValorMontanteBruto( $formato = true ){
        return floatval($this->valorMontanteBruto);    
    }

    public function getValorDescontos(){
        return floatval($this->valorDescontos);
    }

    public function getValorMontanteLiquido(){
        return floatval($this->valorMontanteLiquido);
    }

    public function getValorLucroBruto(){
        return floatval($this->valorLucroBruto);
    }
    
    public function getValorLucroLiquido(){
        return floatval($this->valorLucroLiquido);
    }

    public function getDescontoIr(){
        return floatval($this->descontoIr);
    }

    public function getDescontoIof(){
        return floatval($this->descontoIof);
    }

    public function getDescontoAdmin(){
        return floatval($this->descontoAdmin);
    }

    public function getTotalDescontos(){
        return floatval($this->totalDescontos);
    }
 
    public function calcularValorMontanteBrutoRendaFixa(){

        /**
         * Fórmula juros compostos
         * M = C (1+i)t
         */
        $c = $this->valorAporte;
        $i = $this->taxaRetorno / 100;
        $t = $this->diasCorridos / 365;

        $m = $c * pow( (1 + $i), $t );

        $this->valorMontanteBruto = $m;

        $this->valorLucroBruto = $this->valorMontanteBruto - $this->valorAporte;
        
    }

    public function calcularValorMontanteBrutoRendaVariaval(){
        
        $this->valorMontanteBruto = $this->valorAtual;
        
        $this->valorLucroBruto = $this->valorAtual - $this->valorAporte;
        
    }

    public function calcularDescontosRendaFixa(){
        
        $umPorCentoLucro = $this->valorLucroBruto / 100;

        $descontoIr = $umPorCentoLucro * $this->taxaIr;
        $this->descontoIr = $descontoIr;

        $descontoIof = $umPorCentoLucro * $this->taxaIof;
        $this->descontoIof = $descontoIof;

        $descontoAdmin = $umPorCentoLucro * $this->taxaAdmin;
        $this->descontoAdmin = $descontoAdmin;

        $this->valorDescontos = ($descontoIr + $descontoIof + $descontoAdmin);

    }

    public function calcularDescontosRendaVariavel(){

        $umPorCentoLucro = abs($this->valorLucroBruto / 100);

        $descontoIr = 0;

        if( $this->valorLucroBruto > 0 ){

            $descontoIr = $umPorCentoLucro * $this->taxaIr;
            $this->descontoIr = $descontoIr;

        }

        $descontoAdmin = $umPorCentoLucro * $this->taxaAdmin;
        $this->descontoAdmin = $descontoAdmin;

        $this->valorDescontos = ($descontoIr + $descontoAdmin);

    }

    public function calcularValorMontanteLiquido(){
        $this->valorMontanteLiquido = $this->valorMontanteBruto - $this->valorDescontos;
    }

    public function calcularValorLucroLiquido(){
        $this->valorLucroLiquido = $this->valorLucroBruto - $this->valorDescontos;
    }

    public function zerarValoresTaxas(){

        $this->taxaIof = 0;

        if( !($this->valorLucroBruto > 0) ){

            $this->taxaIr = 0;
            $this->descontoIr = 0;
            $this->descontoIof = 0;

        }
        
    }

    public function calcularMontante(){

        if( $this->tipo == Params::RENDA_FIXA ){
            
            $this->calcularValorMontanteBrutoRendaFixa();
            $this->calcularDescontosRendaFixa();
            $this->calcularValorMontanteLiquido();
            $this->calcularValorLucroLiquido();

        }else if( $this->tipo == Params::RENDA_VARIAVEL ){

            $this->calcularValorMontanteBrutoRendaVariaval();
            $this->zerarValoresTaxas();
            $this->calcularDescontosRendaVariavel();
            $this->calcularValorMontanteLiquido();
            $this->calcularValorLucroLiquido();

        }
        
    }


}