<?php
namespace App\Http\Repositories\Calculos;

use DateTime;

/**
 * @author Fernando Bino Machado
 * Classe para facilitar recuperar diferença entre datas
 */
class DataCalculo{

    /**
     * @example
     
     *  diffDays('2001-02-22', date('Y-m-d'))
     *  diffDays('2001-02-22','2022-01-20')
     */
    public static function diffDays($pDataIni, $pDataFim){
        
        
        $dtIni = new DateTime($pDataIni);
        $dtFim = new DateTime($pDataFim);
        
        $intervalo = $dtIni->diff($dtFim);

        return $intervalo->days;

    }
    
    /**
     * @example
     
     *  diffMonths('2001-02-22', date('Y-m-d'))
     *  diffMonths('2001-02-22','2022-01-20')
     */
    public static function diffMonths($pDataIni, $pDataFim){

        $dtIni = new DateTime($pDataIni);
        $dtFim = new DateTime($pDataFim);

        $intervalo = $dtIni->diff($dtFim);

        $dias = $intervalo->days;
        $meses = $dias / 30;
        
        return floatval($meses);

    }

    /**
     * @example
     
     *  diffYears('2001-02-22', date('Y-m-d'))
     *  diffYears('2001-02-22','2022-01-20')
     */
    public static function diffYears($pDataIni, $pDataFim){

        $dtIni = new DateTime($pDataIni);
        $dtFim = new DateTime($pDataFim);

        $intervalo = $dtIni->diff($dtFim);

        $dias = $intervalo->days;
        $anos = $dias / 365;

        return floatval($anos);

    }

}