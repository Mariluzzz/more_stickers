<?php

require_once 'conexao/conexao.php';

$acao = isset($_POST['acao']) ? $_POST['acao'] : $_GET['acao']; 

switch ($acao) {
    case 'incluir':
        $infos = [
            'imagem' => $_POST['imagem'],
            'nome' => $_POST['nome'],
            'descricao' => $_POST['desc'],
            'categoria' => $_POST['categoria'],
            'preco' => $_POST['preco'],
            'criacao' => date("Y-m-d H:i:m"),
            'qntd' => $_POST['qtd'],
            'situacao' => $_POST['situacao']
        ];
        
        $result = inserir('produtos', $infos);
        if (!$result) {
            ?>
            <script>
                alert("Erro ao inserir usuário");
            </script>
            <?php
        }

    break;

    case 'alterar':
        $campos = ['nome', 'descricao', 'preco', 'categoria', 'qntd', 'situacao'];
        $valores = [$_POST['nome'], $_POST['desc'], $_POST['preco'], $_POST['categoria'], $_POST['qtd'] , $_POST['situacao']];
        $condicao = "id=".$_POST['id'];
        $result = $con->alterar('produtos', $campos, $valores, $condicao);
        if (!$result) {
            ?>
            <script>
                alert("Erro ao alterar tabela");
            </script>
            <?php
        }

    break;

    case 'excluir':
        $result = $con->excluir('produtos', ['situcao'], ['FALSE'],'id ='.$_GET['id']);
        if(!$result) {
            ?>
            <script>
                alert("Erro ao alterar tabela");
            </script>
            <?php
        }

    break;
}


?>