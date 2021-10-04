<?php
/**
 * HandlerController - Gerencia Models, Controllers e Views
 */
class HandlerController
{

	/**
	 * $controller: Valor do Controller/Controladar da URL
     *
	 * exemplo.com/controlador/
	 *
	 * @access private
	 */
	private $controlador;

	/**
	 * $action: Valor da Action/Ação da URL
     *
	 * exemplo.com/controlador/acao
	 *
	 * @access private
	 */
	private $acao;

	/**
	 * $parameters: array dos Parametros da URL
	 *
	 * exemplo.com/controller/action/param1/param2/param50
	 *
	 * @access private
	 */
	private $parametros;

	/**
	 * $not_found: Caminho da página não encontrada
	 *
	 * @access private
	 */
	private $not_found = VIEWS_PATH . "\\error\\not_found.php";



    /**
	 * Obtém parâmetros de $_GET['path'] e instancia os Itens $controller,
     * $action e $parameters
	 *
	 * A URL deverá ter o seguinte formato:
	 * http://www.example.com/controller/action/parameter1/parameter2/...
     *
	 */
	public function get_url_data() {
		// Verifica se o parâmetro path foi enviado
		if (isset($_GET['path'])) {

			// Captura o valor de $_GET['path']
			$path = $_GET['path'];

			// Limpa os dados
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);

			// Cria um array de Parâmetros (Controller, Action, Parameters)
			$array_url = explode('/', $path);

			// Configura as propriedades
			$this->controlador = chk_array($array_url, 0);

            // Formata o Nome Recebido
            $this->formatted_controller($this->controlador);

			$this->controlador .= 'Controller';
			$this->acao = chk_array($array_url, 1);

            // Verifica se a URL possui Parametros
			if (chk_array($array_url, 2)) {

                // Remove os 2 primeiros itens do Array URL
                $array_parameters = array_splice($array_url, 1, 2);

                // Os parâmetros sempre virão após a ação
				$this->parametros = $array_parameters;
			}
		}
	}


	/**
	 * Construtor para essa classe
	 *
	 * Obtém os valores do controlador, ação e parâmetros. Configura
	 * o controlado e a ação (método).
	 */
	public function __construct () {

        // Executa o Metodo 'get_url_data' para Obter os Itens usados
		$this->get_url_data();

        // Caso na Url não tenha o Controller, obtem o Padrão (Home)
		if (!$this->controlador) {

            // Adiciona o controlador padrão e exibe a pagina padrão
            require_once CONTROLLER_PATH . '\\HomeController.php';
            $this->controlador = new HomeController();
            $this->controlador->index();
            return;

		} else if (!file_exists(CONTROLLER_PATH."\\".$this->controlador.".php")) {
            // Verifica se o Controller Informado existe
			require_once $this->not_found;
			return;
		}

        // Importa e Verifica se a Classe com o nome do Controllador Existe
        require_once CONTROLLER_PATH."\\".$this->controlador.".php";
        if (!class_exists($this->controlador)) {
            // Página não encontrada
            require_once $this->not_found;
            return;
        }

        // Cria um objeto da ClasseController
		$this->controlador = new $this->controlador();

		// Normaliza o nome da Action
		$this->acao = preg_replace('/[^a-zA-Z]/i', '', $this->acao);

		// Se o metodo Existir, envia os Parametros
		if (method_exists($this->controlador, $this->acao)) {
			$this->controlador->{$this->acao}($this->parametros);
			return;
		} else if (!$this->acao && method_exists($this->controlador, 'index') ) {
            // Caso não Informe a ação, chamamos o metodo Index do Controller
			$this->controlador->index($this->parametros);
			return;
		} else{
            // Solicitação não Encontrada no Sistema
            require_once $this->not_found;
            return;
        }
    }

    public function formatted_controller($name_controller){

        if(!$this->controlador){
            return;
        }

        // Coloca a Letra incial Maiuscula (Padrão dos Controllers)
        $final_name = ucfirst($name_controller);

        // converte alguns nomes para o Portugues
        switch($final_name){
            case 'Inicio':
                $this->controlador = "Home";
                break;
            case 'Usuario':
                $this->controlador = "User";
                break;
            default:
                $this->controlador = $final_name;
                break;
        }
    }

}















?>