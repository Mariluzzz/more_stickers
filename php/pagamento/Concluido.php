<?php
session_start();

include("cabecario.php");

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
} else {
    ?>
    <script>
        alert("Faça login para continuar com o pagamento!");
    </script>
    <?php
    header("Location: ../../login/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/forma.css">
    <title>Pagamento Concluido</title>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Pagamento Efetuado!🤑🥳</h1>
        </div>
        <div class="imagem">
            <img src="../../img/pagamento/img_correta.png" alt="imagem_correta">
        </div>
        <div class="titulo">
            <h1>+ADESIVOS AGRADECE PELA SUA COMPRA, <?php echo strtoupper($nome); ?>!</h1>
        </div>
        <div class='botao'>
            <form action="LoginPagamento.php" method="post">
                <input type="submit" id='volta_tudo' name="submit_button" value=''>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('volta_tudo').addEventListener('click', function() {
            window.location.href = "LoginPagamento.php";
        });
    </script>
</body>
</html>
