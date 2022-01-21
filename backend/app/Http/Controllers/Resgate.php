<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\ResgateResource;
use App\Http\Repositories\Resources\AtivoResource;
use App\Http\Repositories\Resources\AporteResource;
use App\Http\Repositories\Responses\HttpResponse;
use App\Http\Repositories\Calculos\DataCalculo as DATACALC;
use App\Http\Repositories\Builder\MontanteCalculoBuilder;
use App\Http\Constants\Params;
use Illuminate\Http\Request;
use DateTime;

/**
 * Recebe as requisições e utiliza ResgateResource
 * para salvar em banco de dados
 */
class Resgate{

    private $resgateResource;
    private $papelResource;
    private $ativoResource;
    private $montanteCalculoBuilder;

    public function __construct(){
        $this->ativoResource = new AtivoResource();
        $this->resgateResource = new ResgateResource();
        $this->aporteResource = new AporteResource();
        $this->montanteCalculoBuilder = new MontanteCalculoBuilder();
    }

    public function listar(){
        
        $this->resgateResource->setLimit(Params::DEFAULT_LIMIT_TABLES);
        
        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->resgateResource->listar()
        ));
    }

    public function buscarId(Request $request){
        
        $this->resgateResource->setValorId( $request->id );

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $this->resgateResource->buscarId()
        ));

    }

    public function salvar(Request $request){
        
        $reqBody = $request->all();

        //recupera dados necessários para o calculo
        $this->aporteResource->setValorId( $reqBody['aporte'] );
        $dadosAporte = $this->aporteResource->buscarId();

        $this->ativoResource->setValorId( $dadosAporte[0]->cdPapel );
        $dadosAtivo = $this->ativoResource->buscarId();
        
        //calcula o valor montanta do resgate
        $montanteCalculo = $this->montanteCalculoBuilder
            ->setDiasCorridos( DATACALC::diffDays($dadosAporte[0]->dtAporte, date('Y-m-d')) )
            ->setTipo($dadosAtivo[0]->cdTipo)
            ->setValorAporte($dadosAporte[0]->subTotal)
            ->setValorAtual($reqBody['subTotal'])
            ->setTaxaRetorno($dadosAporte[0]->taxaRetorno)
            ->setTaxaIr()
            ->setTaxaIof()
            ->setTaxaAdmin($dadosAporte[0]->taxaAdmin)
            ->builder();

        //seta os parametros do resgate
        $params = [];

        $params['cdPapel']          = $reqBody['papel'];
        $params['cdAporte']         = $reqBody['aporte'];
        $params['valor']            = floatval($reqBody['valor']);
        $params['qtde']             = $reqBody['quantidade'];
        $params['subTotal']         = floatval($reqBody['subTotal']);
        $params['capitalInicial']   = floatval($dadosAporte[0]->subTotal);
        $params['diasCorridos']     = $montanteCalculo->getDiasCorridos();
        $params['montanteBruto']    = $montanteCalculo->getValorMontanteBruto();
        $params['montanteLiquido']  = $montanteCalculo->getValorMontanteLiquido();
        $params['lucroBruto']       = $montanteCalculo->getValorLucroBruto();
        $params['lucroLiquido']     = $montanteCalculo->getValorLucroLiquido();
        $params['taxaRetorno']      = $montanteCalculo->getTaxaRetorno();
        $params['taxaAdmin']        = $montanteCalculo->getTaxaAdmin();
        $params['taxaIof']          = $montanteCalculo->getTaxaIof();
        $params['taxaIr']           = $montanteCalculo->getTaxaIr();
        $params['descontoIof']      = $montanteCalculo->getDescontoIof();
        $params['descontoIr']       = $montanteCalculo->getDescontoIr();
        $params['descontoAdmin']    = $montanteCalculo->getDescontoAdmin();
        $params['cdUsuario']        = $reqBody['usuario'];
        
        //finaliza o resgate
        $this->resgateResource->setParams($params);

        $sucesso = $this->resgateResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

    public function deletar(Request $request){

        $this->resgateResource->setValorId($request->id);

        $sucesso = $this->resgateResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}