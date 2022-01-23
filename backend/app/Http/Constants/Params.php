<?php
namespace App\Http\Constants;

class Params{

    /**
     * constants para responses
     */
    const STATUS_HTTP_200 = 200;
    const STATUS_HTTP_500 = 500;
    const STATUS_HTTP_401 = 401;
    const STATUS_HTTP_400 = 400;

    const TYPE_JSON = "application/json";
    
    /**
     * constants para valores padrões
     */
    const DEFAULT_LIMIT_TABLES = 1000;

    /**
     * constants para mensagens
     */
    const MSG_SUCCESS = "Operação realizada com sucesso...";
    const MSG_WARNING = "Não foi possível concluir a operação...";
    const MSG_ERROR = "Erro ao tentar executar a operação...";

    /**
     * constants para aportes
     */
    const RENDA_FIXA = 1;
    const RENDA_VARIAVEL = 2;
    const APORTE_INATIVO = 2;
    const APORTE_ATIVO = 1;

    const TAXA_SOBRE_LUCRO = 20;

    /**
     * constants para autenticação
     */
    const VALOR_TOKEN = "valor_token";
    const X_ACCESS_TOKEN = "x-access-token";
    const USER = "user";
    
    /**
     * constant para coluna usuario padrão
     */
    const CD_USUARIO = "cdUsuario";
}