<?php
 /**
  * Arquivo de Configurações Globais do Projeto
  */

  // Caminho do Diretorio atual (Raiz) do Projeto
  define('ROOT_PROJECT', dirname( __FILE__ ));

  // Caminho dos Arquivos CSS
  define('CSS_PATH', ROOT_PROJECT."\\Content\\Css");

  // Caminho dos Arquivos JS
  define('SCRIPT_PATH', ROOT_PROJECT."\\Content\\Scripts");

  // Caminho das Imagens Usadas
  define('IMAGES_PATH', ROOT_PROJECT."\\Content\\Images");

  // Caminho das Views
  define('VIEWS_PATH', ROOT_PROJECT."\\View");

  // Caminho dos Views
  define('CONTROLLER_PATH', ROOT_PROJECT."\\Controller");

  // Configurações do Banco de Dados Local
  // Nome do host da base de dados
  define('HOSTNAME', 'localhost');
  // Nome do DB
  define('DB_NAME', 'crud_php');
  // Usuário do DB
  define('DB_USER', 'admin');
  // Senha do DB
  define('DB_PASSWORD', 'admin');

  // Charset da conexão PDO
  define('DB_CHARSET', 'utf8');

  // todo: Variavel para Controlar Mensagens de Erro no Develop X Production
  define('DEBUG', true);

  // Carrega o Loader.php p/ Controlar as Ações Seguintes
  require_once ROOT_PROJECT."\\loader.php"

?>