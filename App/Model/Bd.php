<?php

namespace BD;

class Bd{

    protected $conexao;

    public function __construct(){
        echo "teste!";
       
        try{
            $this->conexao = new \PDO("mysql:host=localhost;dbname=loja", "andre", "122951");
            
        }catch(\PDOException $e){
            
            throw new Exception("Erro ao conectar no banco");
        }
    
    }

    public function listarDados($tabela=null, $id=null){

        if($tabela === "produtos"){
            
        }
        else if($tabela === "fornecedores"){
                $query = "SELECT * FROM ".$tabela;  
                $stmt = $this->conexao->prepare($query);  
                
        }
        else{
            
            $query = "SELECT * FROM produtos where id_fornecedor = :ID";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(":ID", $id);     
        }
        
        
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }
        
    public function getFornecedores(){
        $query = "SELECT (nome_fornecedor) FROM fornecedores";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarProduto($dados){
        $id_fornecedor = $this->idFornecedor($dados);
        
        $query = "INSERT INTO produtos (nome, preco, id_fornecedor, descricao, imagem) values (:NOME, :PRECO, :ID_FORNECEDOR, :DESCRICAO, :IMAGEM)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $dados['nome']);
        $stmt->bindValue(":PRECO", $dados['preco']);
        $stmt->bindValue(":ID_FORNECEDOR",$id_fornecedor);
        $stmt->bindValue(":DESCRICAO",$dados['descricao']);
        $stmt->bindValue(":IMAGEM", $dados['imagem']);
        try{
            $stmt->execute();
            ECHO "cadastrado com sucesso!";
        }catch(PDOException $e){
            echo "Erro ao salvar cadastro!";
        }
        
    }
        
    public function salvarFornecedor($dados){
        $query = "INSERT INTO fornecedores (nome_fornecedor, logo, descricao_fornecedor, site) values (:NOME, :LOGO, :DESCRICAO, :SITE)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $dados['nome']);
        $stmt->bindValue(":LOGO", $dados['logo']);
        $stmt->bindValue(":DESCRICAO", $dados['descricao']);
        $stmt->bindValue(":SITE", $dados['site']);
        try{
            $stmt->execute();
        }catch(PDOException $e){
            echo "Erro ao salvar cadastro!";
        }
            

    }

    public function recuperaProdutoId($id){
        $query = "SELECT  * from produtos inner join fornecedores on produtos.id_fornecedor = fornecedores.id_fornecedor where id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        return $produto;
    }

    public function editarProduto($produto){
        $query = "UPDATE produtos
        SET nome = :NOME,
        preco = :PRECO,
        id_fornecedor = :FORNECEDOR,
        descricao = :DESCRICAO,
        imagem = :IMAGEM

        WHERE id = :ID";
        $id_fornecedor = $this->idFornecedor($produto);
   
            
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(":NOME", $produto['nome']);
        $stmt->bindValue(":PRECO", $produto['preco']);
        $stmt->bindValue(":FORNECEDOR", $id_fornecedor);
        $stmt->bindValue(":DESCRICAO", $produto['descricao']);
        $stmt->bindValue(":IMAGEM", $produto['imagem']);
        $stmt->bindValue(":ID", $produto['id']);

        $stmt->execute();
    
    }

    public function excluirProduto($id){
       $query = " DELETE FROM produtos
       WHERE id=:ID";
       $stmt = $this->conexao->prepare($query);
       $stmt->bindValue(":ID", $id);
       $stmt->execute();
    }
    
  

    private function idFornecedor($dados){
            $query = "SELECT (id_fornecedor) from fornecedores where nome_fornecedor = :fornecedor";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(":fornecedor", $dados['fornecedor']); 
            $stmt->execute();
            $id_fornecedor = $stmt->fetch(PDO::FETCH_ASSOC)['id_fornecedor'];
          
            return $id_fornecedor;
        }        

        
}