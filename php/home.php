<?php
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL);
    session_start();
    unset($_SESSION['errorSession']);
    
    if (isset($_SESSION['sessaoDeslogada']) && $_SESSION['sessaoDeslogada']) {
        ?> 
        <script>
            alert("Usuário deslogado com sucesso");
        </script>
        <?php
        unset($_SESSION['sessaoDeslogada']);
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME | A+</title>

    <!-- LINKS -->
   <link rel="stylesheet" href="../css/home.css"> 
   <link rel="stylesheet" href="../css/styleBarra.css">
   <script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
    <div id="barra"></div>
    <!-- BANNER CARROSSEL -->
    <div class="bannerHome">
        <img src="../img/home/banner.png" alt="banner">
    </div>
        
    <div class="linha"></div>
    
    <!-- CATEGORIAS DOS PRODUTOS -->
    <div class="categorias">
        <a href="/">TODOS</a>
        <a href="/">JOGOS</a>
        <a href="/">FILMES</a>
        <a href="/">ANIMES</a>
        <a href="/">TIMES</a>
        <a href="/">TECNOLOGIA</a>
    </div>  

    <div class="linha"></div>
    <!-- PRODUTOS ALEATÓRIOS -->
    <h2>PRODUTOS EM DESTAQUE </h2> 
    <div class="produtosCarrossel">
        <div class="card">
            <img class="imagemProduto" src="../img/home/lulaMolusco.png" />
            <h4> Lula Molusco</h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>

        <div class="card">
            <img class="imagemProduto" src="../img/home/imnotaRobot.png" />
            <h4> Robô da Informatica</h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>

        <div class="card">
            <img class="imagemProduto" src="../img/home/helloWorld.png" />
            <h4> Hello World </h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>
    </div>

    <div class="linhaVideo"></div>
    <!-- VIDEO E SOBRE A EMPRESA -->
    <div class="infoEmpresa">
        <div class="videoProdutos"> 
            <iframe width="800" height="450" src="https://www.youtube.com/embed/-iKL-xEsWzo?si=C40OAIZLrVbOCUSP" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="sobreNos">
            <a>
                <img src="../img/home/sobreNosBlack.png" alt="Uma mensagem sobre a empresa">
            </a>    
        </div>
    </div>
    <div class="linhaVideo"></div>

    <!-- PRODUTOS ALEATÓRIOS --> 
    <div class="produtosCarrosselBaixo">
        <div class="card">
            <img class="imagemProduto" src="../img/home/pgadminDarkWader.png" />
            <h4> Darth Vader </h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>

        <div class="card">
            <img class="imagemProduto" src="../img/home/imnotaRobot.png" />
            <h4> Robô da Informatica</h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>

        <div class="card">
            <img class="imagemProduto" src="../img/home/garfield.png" />
            <h4> Garfield</h4>
            <div class="valorProduto">
                <h5> R$4,00</h5>
            </div>
            <a> Adicionar ao Carrinho </a>
        </div>
    </div>

    <!-- BOTÕES CARRINHO/VOLTAR AO TOPO -->
    <div class="botoes">
        <div class="botaoCarrinho">
            <a href="/"> <img src="carrinhoOriginal.png"> </a>
        </div>
        <div class="voltaTopo">
            <a href="#"> <img src="voltaTopo.png"> </a>
        </div>
        <div class="botaoHome">
            <a href="home.html"> <img src="homeOriginal.png"> </a>
        </div>
    </div>
    <div id="footer"></div>
</body>
</html>