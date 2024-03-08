<?php
//lida com consultas de dados.
class TarefeaService{
    private $conexao;
    private $tarefa;

    //para acessar metodos globais, se chama a classe antes
    public function __construct(Conexao $conexao, Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir(){
        //C - Create
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        //joga no banco os valores, utilizando o metodo prepare.
        $stmt = $this->conexao->prepare($query);
        //insere os valores, dizendo aonde inserir.
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    
    public function recuperar(){
        //R - Read
        $query = '
        select 
            t.id, s.status, t.tarefa 
        from 
            tb_tarefa as t
            left join tb_status as s on (t.id_status = s.id)
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}

?>