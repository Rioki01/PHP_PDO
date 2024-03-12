<?php
//lida com consultas de dados.
//Metodos CRUD
class TarefaService{
    private $conexao;
    private $tarefa;

    //para acessar metodos globais, se chama a classe antes
    public function __construct(Conexao $conexao, Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    //CRUDE
    public function inserir(){
        //C - Create
        //cria uma query, e joga no banco de dados, preparando ela para ser executada em uma conexao.!
        //campos com "?" ou ":" não sao jogados e deve ser inseridos manualmente com bindValue.
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
        //fecha a conexao, somente em SELECT
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizar(){
        //U - Update
        //valores para atualizar devem ser em ?, e para atualizar duplas, é necessaria um ID.
        //chama e numera a função bindValue.
        $query = "update tb_tarefas set tarefa = ? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        //executa
        return $stmt->execute();
    }

    public function remover(){
        //D - Delete
        $query = 'delete from tb_tarefas where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();
    }
    public function marcarRealizada(){
        //Igual a U - Update
        //somente muda tarefa para id_status
        //valores para atualizar devem ser em ?, e para atualizar duplas, é necessaria um ID.
        //chama e numera a função bindValue.
        $query = "update tb_tarefas set id_status = ? where id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        //executa
        return $stmt->execute();
    }
    public function recuperarPendentes(){
        $query = 'select t.id, s.status, t.tarefa
        from tb_tarefas as t
        left join tb_status as s on (t.id_status = s.id)
        where 
            t.id_status = :id_status
        ';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        //fecha a conexao, somente em SELECT
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}

?>