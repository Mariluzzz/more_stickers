<?php 
    
    ini_set ( 'display_errors' , 1); 
    error_reporting (E_ALL);

    include 'conexao/conexao.php';
    include 'util.php';

    session_start();

    $sessao_id = session_id();

    $conn = conecta();

    if(isset($_SESSION['sessaoConectado'])){
        $usuario = $_SESSION['sessaoConectado'];
        $codigoUsuario = ValorSQL($conn, " select id from usuarios where nome = '$usuario'");
    }

    $compraExiste = intval((ValorSQL($conn, "select count(*) from compra inner join tmpcompra on compra.id = tmpcompra.id where tmpcompra.sessao = '$sessao_id'")) == 1);

    if(!$compraExiste) {
        $dataHoje = date('Y/m/d');

        $statusCompra = 'Pendente';

        ExecutaSQL($conn, " insert into compra (dt_compra, status) values ('$dataHoje', '$statusCompra')");
        
        $codigoCompra = $conn->lastInsertId();

        ExecutaSQL($conn, " insert into tmpcompra (id, sessao) values ($codigoCompra, '$sessao_id')");
    } else {
        $codigoCompra = intval(ValorSQL($conn, " select compra.id from compra inner join tmpcompra on compra.id = tmpcompra.id where tmpcompra.sessao = '$sessao_id'"));

        $statusCompra = ValorSQL($conn, " select status from compra where id = $codigoCompra");
    }

    if(isset($codigoUsuario)){
        ExecutaSQL($conn, "update compra set clienteid = $codigoUsuario where clienteid is null and id = $codigoCompra");
    }
        //SEGUIR DAQUI
    if($_GET) {
        $operacao = $_GET['operacao'];
        $codigoProduto = $_GET['codigoProduto']; 

        $quantidade = intval (ValorSQL($conn, "select quantidade from compra_produto where idproduto = $codigoProduto and idcompra = $codigoCompra"));

        if($operacao == 'incluir') {
            if($quantidade == 0) {
                ExecutaSQL($conn, "insert into compra_produto (idproduto, idcompra, quantidade) values ($codigoProduto, $codigoCompra, 1) ");
            } else {
                ExecutaSQL($conn, "update compra_produto set quantidade = quantidade + 1 where idproduto = $codigoProduto and idcompra = $codigoCompra");
            }
        } else 
        if ($operacao == 'excluir') {
            if ($quantidade == 1) { 
                ExecutaSQL($conn," delete from compra_produto where idproduto = $codigoProduto and idcompra = $codigoCompra ");         
            } else {
                ExecutaSQL($conn," update compra_produto set quantidade = quantidade - 1 where idproduto = $codigoProduto and idcompra = $codigoCompra ");       
            }
        } else 
        if ($operacao == 'fechar') {

            ExecutaSQL($conn, "delete from tmpcompra where id = $codigoCompra and sessao = '$sessao_id'");

            $statusCompra = 'Finalizado';
            if($statusCompra == 'Finalizado') {
                ExecutaSQL($conn, "update compra set status = '$statusCompra' where id = $codigoCompra");

            }
            
            $operacao = ''; 
           // exclua fisicamente o tmpcompra referente a essa compra
           // ...   
           header("Location: carrinho.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>

    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/styleBarra.css">
   <script type="text/javascript" src="../js/script.js"></script>
</head>
<body>
<div id="barra"></div>
        <div class="titulo">
            <h2>Carrinho</h2>
        </div>
        <div class="produto">
            <?php 
                $sql = "select produtos.id, produtos.descricao, 
                        compra_produto.quantidade, produtos.preco, 
                        produtos.preco::double precision * compra_produto.quantidade as total,
                        produtos.imagem
                        from produtos 
                        inner join compra_produto on produtos.id = compra_produto.idproduto
                        where compra_produto.idcompra = $codigoCompra 
                        order by produtos.descricao";
                    
                $select = $conn->query($sql);

                while($linha = $select->fetch()) {
                    $codigoProduto      = $linha['id'];
                    $descricao          = $linha['descricao'];
                    $quantidade         = $linha['quantidade'];
                    $vunit              = $linha['preco'];
                    $total              = $linha['total'];
                    $img                = $linha['imagem'];

                    echo "
                        <h3>$descricao</h3>
                        <p><b>R$ $vunit</b></p>
                        <p><b>Quantidade: $quantidade </b></p>
                        <a href='../php/carrinho.php?operacao=excluir&codigoProduto=$codigoProduto' class='link'>Excluir</a>
                    ";
                }
            ?>
        </div>
            <?php 
            
            $total = ValorSQL($conn, "SELECT SUM(produtos.preco::double precision * compra_produto.quantidade) FROM produtos INNER JOIN compra_produto ON produtos.id = compra_produto.idproduto WHERE compra_produto.idcompra = $codigoCompra");


                echo "
                    <div class='finalizar'>
                        <p class='txtFinalizar'><b>$statusCompra</b></p>
                        <p>Total: <span id='total'>R$ $total</span></p>  
                    ";
                        if(isset($usuario)) {
                            $totalQuantity = ValorSQL($conn, "SELECT COUNT(*) FROM compra_produto WHERE idcompra = $codigoCompra");
                            if($totalQuantity > 0 and $statusCompra == 'Pendente' and $usuario <> ''){
                                echo "<a href='carrinho.php?operacao=fechar&codigoProduto=0'>Fechar o carrinho</a>";
                            }
                        }
                echo"</div>";
            ?>
    <!-- BOTÕES CARRINHO/VOLTAR AO TOPO -->
    <div class="botoes">
        <div class="voltaTopo">
            <a href="#"> <img src="../img/fixos/voltaTopo.svg"> </a>
        </div>
        <div class="botaoHome">
            <a href="home.php"> <img src="../img/fixos/homeOriginal.svg"> </a>
        </div>
    </div>
    <div id="footer"></div>
</body>
</html>
