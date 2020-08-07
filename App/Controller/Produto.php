<?php
require_once "../App/Model/Bd.php";
require_once "../App/Class/Auxiliar.php";


class Produto{

    public function listarAction(){
        
        $bd = new Bd();
        $produtos = $bd->listarDados('produtos');

        require_once "../App/View/listarprodutos.phtml";
    }

    public function cadastrarAction(){
        $bd = new Bd();
        $fornecedores = $bd->getFornecedores();
         
        require_once "../App/View/cadastrarproduto.phtml";
    } 

    public function salvarAction(){
        $bd = new Bd();
        $dados = $_POST;
        $Imagem = new Auxiliar();
        $caminhoImagem = $Imagem->moverImagem($_FILES['imagem']);
        $dados['imagem'] = $caminhoImagem;

        $bd->cadastrarProduto($dados);
        require_once "../App/View/sucesso.phtml";

    }

    public function exibirAction(){
        $bd = new Bd();
        $id = $_GET['id'];
        $produto = $bd->recuperaProdutoId($id);  
        
        require_once "../App/View/exibirproduto.phtml";

    }

    public function editarAction(){

        $bd = new Bd();
        $id_produto = $_GET['id'];
        $produto = $bd->recuperaProdutoId($id_produto);
        $fornecedores = $bd->getFornecedores();
        $fornecdores['id'] = $id_produto;//para que seja enviado também no form
        
        require_once "../App/View/editarproduto.phtml";

    }

    public function editarFinalizadoAction(){
 
  
        $bd = new Bd();
        $produto = $_POST;
        $Imagem = new Auxiliar();
        $caminhoImagem = $Imagem->moverImagem($_FILES['imagem']);

        $produto['imagem'] = $caminhoImagem;

  
        $bd->editarProduto($produto);
        require_once "../App/View/sucesso.phtml";


    }
    public function excluirAction(){
        $id = $_GET['id'];
        
        $bd = new Bd();
        $bd->excluirProduto($id);

        require_once "../App/View/sucesso.phtml";
    }
}