<?php
//Classe PDO, Conexao com o banco de dados.

class Conexao{
    //dados sensiveis, logo private!
    private $host = 'localhost';
    private $dbname = 'php_com_pdo';
    private $user = 'root';
    private $password = '';

    //trycach -> para tratamento de sessão, quando ocorre um erro em um bloco de codigo,
    //gera um "catch", que devolve uma mensagem de erro.
    public function conectar(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",//nosso root.
                "$this->password",
            );
            return $conexao;
            //lida com o problema da PDO
            //objeto $error que recebe a mensagem de erro.
        } catch(PDOException $error) {
            //printa a mensagem de erro, entre tags HTML
            echo '<p>' .$error->getMessage().'</p>';
        }
    }


}


?>