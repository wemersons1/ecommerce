<?php
require_once "../App/Controller/Index.php";
require_once "../App/Controller/Produto.php";
require_once "../App/Controller/Fornecedor.php";
require_once "../App/Controller/Api.php";

class Init{

    private $rotas;



    public function __construct(){
        
        $this->initRoutes();
        $this->run();

    }

    public function initRoutes(){

        $rotas['home'] = ["rota" => '/', "controller" => "index", "action" => "indexAction"];
        $rotas['listar-produtos'] = ["rota" => '/listarprodutos', "controller" => "produto", "action" => "listarAction"];
        
        $rotas['listar-fornecedores'] = ["rota" => '/listarfornecedores', "controller" => "fornecedor", "action" => "listarAction"];

        $rotas['cadastrar-produto'] = ["rota" => '/cadastrarproduto', "controller" => "produto", "action" => "cadastrarAction"];
        $rotas['cadastrar-fornecedor'] = ["rota" => '/cadastrarfornecedor', "controller" => "fornecedor", "action" => "cadastrarAction"];
        
        $rotas['salvar-produto'] = ["rota" => '/salvarproduto', "controller" => "produto", "action" => "salvarAction"];
        $rotas['salvar-fornecedor'] = ["rota" => '/salvarfornecedor', "controller" => "fornecedor", "action" => "salvarAction"];
        
        $rotas['exibir-produto'] = ["rota" => '/produto', "controller" => "produto", "action" => "exibirAction"];
       
        $rotas['editar'] = ["rota" =>"/editar", "controller" => "produto", "action"=> "editarAction"];
        $rotas['editar-produto'] = ["rota" =>"/editarproduto", "controller" => "produto", "action"=> "editarFinalizadoAction"];

        $rotas['excluir'] = ["rota" =>"/excluir", "controller" => "produto", "action"=> "excluirAction"];
        $rotas['todos-produtos'] = ["rota" =>"/fornecedores/todosprodutos", "controller" => "fornecedor", "action"=> "todosProdutosAction"];
        
        $rotas['api'] = ["rota" =>"/api/v1/listadeprodutos", "controller" => "api", "action"=> "listaDeProdutos"];
        
        
        $this->setRotas($rotas);
        
    }

    public function setRotas($rotas){
        $this->rotas = $rotas;
    }
  
    
    public function getUrl(){

        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
    }

    public function run(){

        foreach($this->rotas as $rota){
            if($rota['rota'] === $this->getUrl())
            {

                $class = ucfirst($rota['controller']);
                $controller = new $class();
                $action = $rota['action'];
                $controller->$action();
          
            }
        }

    }


}