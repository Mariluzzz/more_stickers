<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Controle de Estoque</title>
<style>
    body {
        background-color: blue;
    }
</style>
</head>
<body>
    <div>
        <div>
            <a href="../php/cadastroProdutosTela.php?acao=adicionar&tela=add"><img src="../img/estoque/addProd.svg"></a>
            add produto
        </div>
        <div>lista de produtos</div>
        <div>
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                    include 'conexao/conexao.php';

                    $return = pesquisar('produtos', 'WHERE situacao=TRUE');
                    foreach($return as $info) {
                        ?>
                <tr>
                    <td><?php echo $info['nome']?></td>
                    <td><?php echo $info['descricao']?></td>
                    <td><?php echo $info['qntd']?></td>
                    <td><a href='<?php echo "cadastroProdutosTela.php?tela=edt&id=".$info['id']?>'><img src="../img/estoque/editar.svg"></a></td>
                    <td><a href='<?php echo "cadastroProdutosTela.php?acao=excluir&id=".$info['id']?>'><img src="../img/estoque/excluir.svg"></a></td>
                </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>