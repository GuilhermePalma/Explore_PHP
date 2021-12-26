<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
{
    /**
     * URL raiz do Projeto
     *
     * @var string
     */
    private $url = '';

    /**
     * Prefixo Padrão das Rotas
     *
     * @var string
     */
    private $prefix_url = '';

    /**
     * Armazenará todas as Rotas do Projeto
     *
     * @var array
     */
    private $routes = [];

    /**
     * Uma instancia da Classe Request
     *
     * @var Request
     */
    private $request;

    public function __construct($url)
    {
        $this->request = new Request();
        $this->url     = $url;
        $this->setPrefix();
    }

    /**
     * Define o Prefixo das Rotas
     *
     * @return void
     */
    private function setPrefix()
    {
        $parse_url        = parse_url($this->url);
        $this->prefix_url = $parse_url['path'] ?? '';
    }

    /**
     * Responsavel por Adicionar Novas Rotas à Classe
     *
     * @param  string $method
     * @param  string $route
     * @param  array $params_route
     * @return void
     */
    private function addRoute($method, $route, $params_route = [])
    {
        // Validação dos Parametros
        foreach ($params_route as $key => $value) {
            if ($value instanceof Closure) {
                $params_route['controller'] = $value;
                unset($params_route[$key]);
            }
        }

        // Variaveis da rota
        $params_route['variables'] = [];

        //Valida as Variaveis da Rota
        $pattern_variable = '/{(.*?)}/';
        if (preg_match_all($pattern_variable, $route, $matches)) {
            $route                     = preg_replace($pattern_variable, '(.*?)', $route);
            $params_route['variables'] = $matches[1];
        }

        // A Rota deve começar e Terminar com "/" e Substituir "/" por "\/"
        $pattern_route = '/^' . str_replace('/', '\/', $route) . '$/';

        // Adiciona a Rota à Classe
        $this->routes[$pattern_route][$method] = $params_route;

    }

    /**
     * Metodo Responsavel por definir uma rota GET
     *
     * @param  string $route
     * @param  array $param_execute
     * @return void
     */
    public function httpGET($route, $param_execute = [])
    {
        return $this->addRoute('GET', $route, $param_execute);
    }

    /**
     * Metodo Responsavel por definir uma rota POST
     *
     * @param  string $route
     * @param  array $param_execute
     * @return void
     */
    public function httpPOST($route, $param_execute = [])
    {
        return $this->addRoute('POST', $route, $param_execute);
    }

    /**
     * Metodo Responsavel por definir uma rota PUT
     *
     * @param  string $route
     * @param  array $param_execute
     * @return void
     */
    public function httpPUT($route, $param_execute = [])
    {
        return $this->addRoute('PUT', $route, $param_execute);
    }

    /**
     * Metodo Responsavel por definir uma rota DELETE
     *
     * @param  string $route
     * @param  array $param_execute
     * @return void
     */
    public function httpDELETE($route, $param_execute = [])
    {
        return $this->addRoute('DELETE', $route, $param_execute);
    }

    private function getURI()
    {
        $uri = $this->request->getUri();

        $uri_without_prefix = strlen($this->prefix_url)
        ? explode($this->prefix_url, $uri) : [$uri];

        // Retorna apenas o Final da URI (Sem o Prefixo)
        return end($uri_without_prefix);
    }

    /**
     * Retorna um Array de dados da Rota Atual
     *
     * @return array
     */
    private function getRoute()
    {
        $uri         = $this->getURI();
        $http_method = $this->request->getHttpMethod();

        foreach ($this->routes as $pattern_route => $methods) {

            // Verifica se a URI está dentro do Padrão
            if (preg_match($pattern_route, $uri, $matches)) {

                // Verifica se o Metodo Existe e Retorna os Parametros da Rota
                if (isset($methods[$http_method])) {

                    // Exclui a Primeira Posição (URL Completa);
                    unset($matches[0]);

                    // Obtem as Chaves da Rota/URL
                    $keys = $methods[$http_method]['variables'];

                    // Substitui as Chaves das Variaveis pelo seu Nome e Valor
                    $methods[$http_method]['variables'] = array_combine($keys, $matches);

                    // Insere os Valores da Request (Header, Post, Metodo HTTPs)
                    $methods[$http_method]['request'] = $this->request;

                    return $methods[$http_method];
                } else {
                    throw new Exception("Metodo não é Permitido", 405);
                }
            }
        }
        throw new Exception("URL não Encontrada", 404);
    }

    public function run()
    {
        try {
            // Obtem a Rota da Solicitação
            $route = $this->getRoute();

            if (!isset($route['controller'])) {
                throw new Exception("A URL não pode ser Processada", 500);
            } else {

                // Argumentos da Função e Espelho da Função Controller
                $args = [];
                $reflection = new ReflectionFunction($route['controller']);

                // Obtem as Variaveis de Forma Dinamica
                foreach ($reflection->getParameters() as $parameters) {
                    $name        = $parameters->getName();
                    $args[$name] = $route['variables'][$name] ?? '';
                }

                // Retorna a execução da Função no Controllador
                return call_user_func_array($route['controller'], $args);
            }
        } catch (Exception $ex) {
            return new Response($ex->getCode(), $ex->getMessage());
        }
    }

}
