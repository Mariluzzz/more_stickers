<?php
   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);   

   session_start(); 
   include("cabecario.php");
   include("conexao/conexao.php");

   $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos | A+</title>

    <!-- LINKS -->
    <link rel="stylesheet" href="../css/produtos.css">
    <link rel="stylesheet" href="../css/styleBarra.css">
    <script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
    <div id="barra"></div>
    <div class="container">
        <!-- FILTRO DOS PRODUTOS -->
        <div>
            <div class="filtro">
                <div class="quadradoFiltro">
                    <div class="categorias">
                        <h3> Filtrar por: </h3>
                        <a href="produtos.php?categoria="> Todos </a>
                        <a href="produtos.php?categoria=1"> Animes </a>
                        <a href="produtos.php?categoria=2"> Desenhos </a>
                        <a href="produtos.php?categoria=3"> Filmes/Séries </a>
                        <a href="produtos.php?categoria=4"> Informática </a>
                        <a href="produtos.php?categoria=5"> Jogos </a>
                        <a href="produtos.php?categoria=6"> Times </a> 
                    </div>
                </div>
            </div>

            <!-- DIVS DOS PRODUTOS -->
            <div class="produtos">
                <!-- PRODUTO 1 -->
                <?php
                    $condicao = !empty($categoria) ? "WHERE categoria=$categoria ORDER BY RANDOM()" : "ORDER BY RANDOM()";
                    $result = pesquisar("produtos", $condicao);
                    foreach($result as $infos) {
                        $categoria = pesquisar("categorias", "WHERE id={$infos['categoria']}");
                        ?>
                        <div class="card" id="<?php echo $infos['id'];?>">
                            <img class="imagemProduto" src="../img/produtos/<?php echo $categoria[0]['descricao']; ?>/<?php echo $infos['nome'];?>.png" />
                            <h4><?php echo $infos['nome'];?></h4>
                            <div class="valorProduto">
                                <h5> R$<?php echo $infos['preco'];?></h5>
                            </div>
                            <?php
                            $estoque = pesquisar("estoque", "WHERE produto = {$infos['id']}");
                            if ($estoque[0]['quantidade'] >= 1) {
                                ?>
                                <a> Adicionar ao Carrinho </a>
                                    Restam <?php echo $estoque[0]['quantidade'];?>
                                <?php
                            } else {
                                ?>
                                <h5> Produto esgotado </h5>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>   
    </div> 
    <div id="footer"></div>
</body>
</html>
       

