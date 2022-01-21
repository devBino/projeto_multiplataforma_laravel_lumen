<?php
namespace App\Http\Controllers;

use App\Http\Repositories\Resources\ResgateResource;
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
    private $aporteResource;
    private $montanteCalculoBuilder;

    public function __construct(){
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

    /**
     * @todo
     *  Precisa concluir a lógica de um resgate
     *  no método abaixo
     */
    public function salvar(Request $request){
        
        $reqBody = $request->all();

        $this->aporteResource->setValorId( $reqBody['aporte'] );
        $dadosAporte = $this->aporteResource->buscarId();

        $params = [];

        $params['cdPapel'] = $reqBody['papel'];
        $params['cdAporte'] = $reqBody['aporte'];
        $params['valor'] = $reqBody['valor'];
        $params['qtde'] = $reqBody['quantidade'];
        $params['subTotal'] = $reqBody['subTotal'];

        $params['capitalInicial'] = floatval($dadosAporte[0]->subTotal);
        $params['diasCorridos'] = DATACALC::diffDays($dadosAporte[0]->dtAporte, date('Y-m-d'));
        
        $montanteCalculo = $this->montanteCalculoBuilder
            ->setDiasCorridos($params['diasCorridos'])
            ->setTipo(Params::RENDA_FIXA)
            ->setValorAporte($dadosAporte[0]->subTotal)
            ->setTaxaRetorno($dadosAporte[0]->taxaRetorno)
            ->setTaxaIr()
            ->setTaxaIof()
            ->builder();
        
        echo "<pre>";print_r($montanteCalculo);die;

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseListagem(
            $params
        ));

        
        /*$params['montanteBruto'] = 1353.40;
        $params['montanteLiquido'] = 1353.40;
        $params['lucroBruto'] = 0;
        $params['lucroLiquido'] = 0;
        $params['taxaRetorno'] = 0;
        $params['taxaAdmin'] = 0;
        $params['taxaIof'] = 0;
        $params['taxaIr'] = 0;
        $params['descontoIof'] = 0;
        $params['descontoIr'] = 0;
        $params['descontoAdmin'] = 0;
        $params['cdUsuario'] = $reqBody['usuario'];

        $this->resgateResource->setParams($params);

        $sucesso = $this->resgateResource->salvar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );*/

    }

    public function deletar(Request $request){

        $this->resgateResource->setValorId($request->id);

        $sucesso = $this->resgateResource->deletar();

        return HttpResponse::httpStatus200( HttpResponse::prepareResponseOperacao($sucesso) );

    }

}