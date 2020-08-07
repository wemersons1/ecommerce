<?php
require './Bd.php';

class Produtos extends Bd {
    public function find(int $id) {

    }

    public function index() {
        $query = "SELECT  * from produtos inner join fornecedores on produtos.id_fornecedor = fornecedores.id_fornecedor";
        $stmt = $this->conexao->prepare($query);
        
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $dados;
    }

    public function create($product) {
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
}

$produtos = new Produtos->create([
    'name' => 'Mario'
]);