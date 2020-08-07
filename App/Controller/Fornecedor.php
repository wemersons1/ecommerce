<?php
require_once "../App/Model/Bd.php";

class Fornecedor{

    public function listarAction(){
        $dados = new Bd();
        
        $fornecedores = $dados->listarDados('fornecedores');
        
        require_once "../App/View/listarfornecedores.phtml";
    }

    public function cadastrarAction(){
      
        require_once "../App/View/cadastrarfornecedor.phtml";
    }

    public function salvarAction(){

        $dados = $_POST;
        $imagem = new Auxiliar();
        $caminhoImagem = $imagem->moverImagem($_FILES['logo'], "fornecedores");
        $dados['logo'] = $caminhoImagem;
        $bd = new Bd();
        $bd->salvarFornecedor($dados);
 
        require_once "../App/View/sucesso.phtml";
    }

    public function todosProdutosAction(){
        $id = $_GET['id'];
        $bd = new Bd();
        
        $produtos = $bd->listarDados('0',$id);//qualquer parametro só cair em else
   
        require_once "../App/View/exibirprodutosfornecedor.phtml";
    }

}