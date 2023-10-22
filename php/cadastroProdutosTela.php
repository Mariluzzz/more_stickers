<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <style>
        body {
            background-color: grey;
        }
    </style>
</head>
<body>
    <div>
        <?php
            if(isset($_GET['tela']) && $_GET['tela'] === 'add') {
                ?>
                <div>Cadastro de produtos</div>
                    <div>
                        <form action="../php/cadastroProdutos.php" method="POST">
                            <input type="hidden" id="situacao" name="situacao" value="TRUE">
                            <input type="hidden" id="acao" name="acao" value="incluir">
                            <label for="imagem">Selecione uma imagem:</label>
                            <img src="../img/addImg.svg">
                            <input type="file" id="imagem" name="imagem">
                            <label>Nome</label>
                            <input type="text" id="nome" name="nome">
                            <label>Descrição</label>
                            <input type="text" id="desc" name="desc">
                            <label>Categoria</label>
                            <input type="number" id="categoria" name="categoria">
                            <label>Preço</label>
                            <input type="text" id="preco" name="preco">
                            <label>Quantidade</label>
                            <input type="number" id="qtd" name="qtd">
                            <div>
                                <div>
                                    <button type="submit" class="button" id="button">Salvar</button>
                                </div>
                                <div>
                                    <button type="submit" class="button" id="button">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php
            } else {
                include 'conexao/conexao.php'; 

                $result = pesquisar("produtos", "WHERE id =".$_GET['id']);

                ?>
                <div>Alteração de produtos</div>
                <div>
                    <form action="cadastroProdutos.php" method="POST">
                        <input type="hidden" id="situacao" name="situacao" value="TRUE">
                        <input type="hidden" id="acao" name="acao" value="alterar">
                        <input type="hidden" id="id" name="id" value="<?php echo $result[0]['id']?>">
                        <label for="imagem">Selecione uma imagem:</label>
                        <img src="../img/addImg.svg">
                        <input type="file" id="imagem" name="imagem"  value="<?php echo $result[0]['imagem']?>">
                        <label>Nome</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $result[0]['nome']?>">
                        <label>Descrição</label>
                        <input type="text" id="desc" name="desc"  value="<?php echo $result[0]['descricao']?>">
                        <label>Categoria</label>
                        <input type="number" id="categoria" name="categoria"  value="<?php echo $result[0]['categoria']?>">
                        <label>Preço</label>
                        <input type="text" id="preco" name="preco"  value="<?php echo $result[0]['preco']?>">
                        <label>Quantidade</label>
                        <input type="number" id="qtd" name="qtd"  value="<?php echo $result[0]['qntd']?>">
                        <div>
                            <div>
                                <button type="submit" class="button" id="button">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php
            }
        ?>
    </div>
</body>
</html>