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
        
        $result = inserir("produtos", $infos);
        if (!$result) {
            ?>
            <script>
                alert("Erro ao inserir produto");
            </script>
            <?php
            break;
        }
        $produto = pesquisar("produtos", "WHERE nome={$_POST['nome']}");
        $infosEstoque = [
            'produto' => $produto['id'],
            'quantidade' => $_POST['qtd'],
            'data' => date("Y-m-d H:i:m"),
            'tipo_acao' => 1
        ];
        $estoque = inserir('estoque', $infosEstoque);
        if (!$estoque) {
            ?>
            <script>
                alert("Erro ao inserir no estoque");
            </script>
            <?php
            break;
        }
        header('Location: estoque.php');

    break;

    case 'alterar':
        $campos = ['nome', 'descricao', 'preco', 'categoria', 'qntd', 'situacao'];
        $valores = [$_POST['nome'], $_POST['desc'], $_POST['preco'], $_POST['categoria'], $_POST['qtd'] , $_POST['situacao']];
        $condicao = "id=".$_POST['id'];
        $result = alterar('produtos', $campos, $valores, $condicao);
        if (!$result) {
            ?>
            <script>
                alert("Erro ao alterar tabela");
            </script>
            <?php
            break;
        }
        // $campos = ['quantidade'];
        // $valores = [$_POST['qtd']];
        // $condicao = "produto=".$_POST['id'];
        // $estoque = alterar("estoque", $campos, $valores, $condicao);
        header('Location: estoque.php');

    break;

    case 'excluir':
        $result = alterar('produtos', ['situacao'], ['FALSE'],'id ='.$_GET['id']);
        if(!$result) {
            ?>
            <script>
                alert("Erro ao alterar tabela");
            </script>
            <?php
            break;
        }
        header('Location: estoque.php');

    break;
}


?>