<?php

class Auxiliar{

    public function moverImagem($arr, $tipo="produtos"){
        $temp = $arr['tmp_name'];
        $pasta = "imagens_".$tipo;
        if(!is_dir($pasta)){
            mkdir($pasta, 0777);
        }
        $caminhoSalvar = $pasta.DIRECTORY_SEPARATOR.$arr['name'];

        if(!move_uploaded_file($temp, $caminhoSalvar)){
            throw new Exception("Não foi possível cadastrar!, tente novamente mais tarde");
        }
        return $caminhoSalvar;
    }

}

