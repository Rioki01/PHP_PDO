<?php

//classe "mae".
class Tarefa{
    private $id;
    private $id_status;
    private $tarefa;
    private $date_cadastro;

    //encapsulamento
    public function __get($atributo){
        return $this->$atributo;
    }
    //atributo set precisa de um valor, pois ele adiciona algo.
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
}




?>