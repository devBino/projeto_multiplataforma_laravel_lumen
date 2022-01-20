<?php
namespace App\Http\Constants;

class Params{

    /**
     * constants para responses
     */
    const STATUS_HTTP_200 = 200;
    const STATUS_HTTP_500 = 500;
    const STATUS_HTTP_401 = 401;

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

    
}