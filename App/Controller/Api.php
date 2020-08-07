<?php
require_once "../App/Model/Bd.php";

class Api{

    public function listaDeProdutos(){

        $bd = new Bd();
        $produtos = $bd-> listarDados("produtos");
       
            $nome = json_encode($produtos);
     
        echo $nome;
        return json_encode($produtos);
    }
}