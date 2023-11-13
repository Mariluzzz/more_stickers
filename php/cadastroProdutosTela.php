<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>

    <!-- LINK CSS -->
    <link rel="stylesheet" href="../css/cadastroProduto.css">
</head>
<body>
    <div>
        <?php
            if(isset($_GET['tela']) && $_GET['tela'] === 'add') {
                ?>
                <div class="titulo"> <h1>Cadastro de Produtos</h1></div>
                <div class="container">
                        <div class="forms">
                            <form action="../php/cadastroProdutos.php" method="POST">
                                <input type="hidden" id="situacao" name="situacao" value="TRUE">
                                <input type="hidden" id="acao" name="acao" value="incluir">
                                <label for="imagem"> <h3>Selecione uma imagem: </h3> </label>
                                <img src="../img/addImg.svg"> <br>
                                <input type="file" id="imagem" name="imagem" class="info"><br>
                                <input type="text" id="nome" name="nome" placeholder="Digite o nome..." class="info">
                                <input type="text" id="desc" name="desc" placeholder="Digite a descrição..." class="info">
                                <input type="number" id="categoria" name="categoria" placeholder="Digite a categoria.." class="info">
                                <input type="text" id="preco" name="preco"  placeholder="Digite o preço..."class="info">
                                <input type="number" id="qtd" name="qtd"  placeholder="Digite a quantidade..." class="info">
                                <div class="botoes">
                                    <div class="salvar">
                                        <button type="submit" class="button" id="button">Salvar</button>
                                    </div>
                                    <div class="editar">
                                        <button type="submit" class="button" id="button">Editar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
            } else {
                include 'conexao/conexao.php'; 

                $result = pesquisar("produtos", "WHERE id =".$_GET['id']);

                ?>
                <div class="container">
                    <div class="titulo">Alteração de produtos</div>
                    <div class="forms">
                        <form action="cadastroProdutos.php" method="POST">
                            <input type="hidden" id="situacao" name="situacao" value="TRUE">
                            <input type="hidden" id="acao" name="acao" value="alterar">
                            <input type="hidden" id="id" name="id" value="<?php echo $result[0]['id']?>">
                            <label for="imagem">Selecione uma imagem:</label>
                            <img src="../img/addImg.svg">
                            <input type="file" id="imagem" name="imagem"  value="<?php echo $result[0]['imagem']?>">
                            <label>Nome</label>
                            <input type="text" id="nome" class="info" name="nome" value="<?php echo $result[0]['nome']?>">
                            <label>Descrição</label>
                            <input type="text" id="desc" class="info" name="desc"  value="<?php echo $result[0]['descricao']?>">
                            <label>Categoria</label>
                            <input type="number" id="categoria" class="info" name="categoria"  value="<?php echo $result[0]['categoria']?>">
                            <label>Preço</label>
                            <input type="text" id="preco" class="info" name="preco"  value="<?php echo $result[0]['preco']?>">
                            <label>Quantidade</label>
                            <input type="number" id="qtd" class="info" name="qtd"  value="<?php echo $result[0]['qntd']?>">
                            <div class="botoes">
                                <div>
                                    <button type="submit" class="button" id="button">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
        ?>
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