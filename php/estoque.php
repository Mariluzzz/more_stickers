<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="../css/estoque.css">
</head>
<body>
    <div>
        <div class="titulo"> <h1> ESTOQUE </h1> </div>
        <div class="add">
            <h3>Add Produto</h3>
            <a href="../php/cadastroProdutosTela.php?acao=adicionar&tela=add"><img src="../img/estoque/addProd.svg"></a>
        </div>
        <div class="produtos">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
                <?php
                    include 'conexao/conexao.php';
                    include("cabecario.php");

                    $return = pesquisar('produtos', 'WHERE situacao=TRUE ORDER BY categoria ASC');
                    foreach($return as $info) {
                        ?>
                <tr>
                    <td><?php echo $info['nome']?></td>
                    <td><?php echo $info['descricao']?></td>
                    <td><?php echo $info['qntd']?></td>
                    <td>
                    <a href='<?php echo "cadastroProdutosTela.php?tela=edt&id=".$info['id']?>'><img src="../img/estoque/editar.svg"></a>
                    <a href='<?php echo "cadastroProdutosTela.php?acao=excluir&id=".$info['id']?>'><img src="../img/estoque/excluir.svg"></a>
                    </td>
                </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- BOTÕES CARRINHO/VOLTAR AO TOPO -->
    <div class="botoes">
        <div class="botaoCarrinho">
            <a href="/"> <img src="../img/fixos/carrinhoOriginal.svg"> </a>
        </div>
        <div class="voltaTopo">
            <a href="#"> <img src="../img/fixos/voltaTopo.svg"> </a>
        </div>
        <div class="botaoHome">
            <a href="home.php"> <img src="../img/fixos/homeOriginal.svg"> </a>
        </div>
    </div>
</body>
</html>
