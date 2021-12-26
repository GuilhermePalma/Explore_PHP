<?php

namespace App\Http;

class Response
{

    /**
     * Codigo de Retorno da Resposta HTTP
     *
     * @var int
     */
    private $http_code = 200;

    /**
     * Header de Respota
     *
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de Conteudo que será Retornado
     *
     * @var string
     */
    private $content_type = 'text/html';

    /**
     * Armazenará o Conteudo de Retorno da Resposta
     *
     * @var mixed
     */
    private $content;

    /**
     * Metodo Responsavel por Iniciar a Classe e definir seus Valores
     *
     * @param  mixed $http_code
     * @param  mixed $content
     * @param  mixed $content_type
     * @return void
     */
    public function __construct($http_code, $content, $content_type = 'text/html')
    {
        $this->http_code    = $http_code;
        $this->content      = $content;
        $this->content_type = $content_type;
        $this->setContentType($content_type);
    }

    /**
     * Metodo Responsavel por Setar e Configurar o Tipo de Retorno no Header
     *
     * @param  mixed $content_type
     * @return void
     */
    public function setContentType($content_type)
    {
        $this->content_type = $content_type;
        $this->addHeader('Content-Type', $content_type);
    }

    /**
     * Metodo responsavel por Adicionar Parametros ao Header
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return void
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Envia a Resposta para o Usuario
     *
     * @return void
     */
    public function sendResponse()
    {
        $this->sendHeaders();
        switch ($this->content_type) {
            case 'text/html':
                echo $this->content;
                exit;

            default:
                break;
        }
    }

    /**
     * Envia os Headers para a Requisição
     *
     * @return void
     */
    private function sendHeaders()
    {
        // Define o Codigo de Resposta do APP
        http_response_code($this->http_code);

        // Define o Header e Seus Valores
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }
}
