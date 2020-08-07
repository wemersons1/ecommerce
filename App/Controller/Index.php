<?php

class Index{

    public function indexAction(){
        $bd = new \BD\bd;
        
        
        require_once "../App/View/index.phtml";

    }

}