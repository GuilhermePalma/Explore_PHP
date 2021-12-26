<?php

namespace App\Http;

class Request
{
    /**
     * Metodo HTTP da Requisição
     */
    private $http_method;

    /**
     * URI da Pagina
     */
    private $uri;

    /**
     * Parametros da Chamada HTTP
     */
    private $query_param = [];

    /**
     * Parametros Recebido do Body
     */
    private $post_param = [];

    /**
     * Parametros Recebido do Header
     */
    private $header_param = [];

    public function __construct()
    {
        $this->query_param  = $_GET ?? [];
        $this->post_param   = $_POST ?? [];
        $this->header_param = getallheaders();
        $this->http_method  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Retorna o Metodo HTTP da Requisição
     */
    public function getHttpMethod()
    {
        return $this->http_method;
    }
    /**
     * Retorna a URI da Requisição
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Retorna os Headers da Requisição
     */
    public function getHeaders()
    {
        return $this->header_param;
    }

    /**
     * Retorna os Parametros da Requisição
     */
    public function getQueryParam()
    {
        return $this->query_param;
    }

    /**
     * Retorna as Variaveis do POST da Requisição
     */
    public function getPostParam()
    {
        return $this->header_param;
    }

}
