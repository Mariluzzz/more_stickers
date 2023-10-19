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
            <a href="../php/acao.php?acao=adicionar&id="><img src="../img/estoque/addProd.svg"></a>
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
                    require_once 'classes/conexao.php';
                    
                    $con = new Conexao();

                    $return = $con->pesquisar('produtos');
                    foreach($return as $key => $info) {
                        ?>
                <tr>
                    <td><?php echo $info['nome']?></td>
                    <td><?php echo $info['descricao']?></td>
                    <td><?php echo $info['qntd']?></td>
                    <td><a href='<?php echo "acao.php?acao=editar&id=".$info['id']?>'><img src="../img/estoque/editar.svg"></a></td>
                    <td><a href='<?php echo "acao.php?acao=excluir&id=".$info['id']?>'><img src="../img/estoque/excluir.svg"></a></td>
                </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>