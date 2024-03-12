<?php
//Logica e instancias vem deste arquivo
//require para puxar outros arquivos
require "tarefa.model.php";
require "tarefa.service.php";
require "conexao.php";

//variavel ação que ouve o usuario.
//primeiro checa com isset se há alguma ação dentro dele.
//isset é um teste logico, suas condiçoes -> apos o ? (quando for verdadeira), e apos o : (quando for falsa).
//se ja tiver, ela continua a mesma, pois ja possui um valor.
$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao;

if ($acao == "inserir") { ////INSERIR
    //cria instnacias de Tarefa e Construção para o metodo construtor da tarefa.service.
    $tarefa = new Tarefa();
    //pega com o set o valor do usuario.
    //armazena o valor utilizando metodo global _post[]
    $tarefa->__set("tarefa", $_POST['tarefa']);

    $conexao = new Conexao();
    //metodo construtor do tarefa.service
    $tarefaService = new TarefaService($conexao, $tarefa);
    //chama a função de inserir do tarefa.service.
    $tarefaService->inserir();

    header('Location: (proximos passos)');
} else if ($acao == 'recuperar') {  ////RECUPERAR
    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    //Como a função recuperar tem Return, ela precisa de alguma variavel para recebeder os dados.
    //neste caso "tarefas".
    $tarefas = $tarefaService->recuperar();
} else if ($acao == 'atualizar') { ////UPDATE
    $tarefa = new Tarefa();
    //seta os valores a serem atualizados.
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->atualizar();
}  else if( $acao == 'remover') {  ////DELETAR

    $tarefa = new Tarefa();
    //pega o ID com GET para saber qual deletar.
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();
}   else if( $acao == 'recuperarPendentes') {   ////RECUPERAR PENDENTE
    $tarefa = new Tarefa();
    //pega o ID com GET para saber qual deletar.
    $tarefa->__set('id_status', 0); // para pendentes
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->recuperarPendentes();
}   else if ( $acao == 'marcarRealizada') {     ////MARCAR REALIZADO
    $tarefa = new Tarefa();
    $conexao = new Conexao();
    //pega o id com SET e GET e o seta o id_status para concluida!
    $tarefa->__set('id', $_GET['id']->__set('id_status', 1));

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();
    


}

?>