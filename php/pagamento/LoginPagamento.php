<?php
session_start();

if (isset($_SESSION['sessaoConectado'])) {
    $sessaoConectado = $_SESSION['sessaoConectado'];
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="../../css/pagamento.css">
</head>
<body>
    <div class="container">
        <!-- Título -->
        <div class="titulo">
            <h1>Pagamento</h1>
        </div>

        <!-- Imagem -->
        <div class="imagem">
            <img src="../../img/pagamento/comprar_sacolinha.png" alt="sacolinha">
        </div>

        <!-- Formulário -->
        <div class="forms">
            <form action="processo.php" method="post">
                <input type="text" class="info" placeholder="Nome Completo" id="nome" name="nome" required>
                <br><br>
                <input type="text" class="info" placeholder="CPF/CNPJ" id="cpf" name="cpf" required>
                <br><br>
                <input type="email" class="info" placeholder="E-mail" id="email" name="email" required>
                <br><br>
                <input type="text" class="info" placeholder="Celular" id="celular" name="celular" required>
                <br><br>
                <input type="text" class="info" id="dtnascimento" placeholder="(DD/MM/AAAA)" name="dtnascimento" required>
                <br><br>
                <input type="text" class="info" id="senha" placeholder="Senha" name="senha"required>
                <br><br>
                <div class='botoes'>
                    <div>
                        <input type='submit' id='bVoltar' class='botao-voltar' value='' id='volta_pagina'>
                    </div>
                    <div id='bAvancar'>
                        <input type='submit' class='botao-avancar' value='' id="submitButton">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
// Adicionar um ouvinte de evento de entrada para formatar a data no campo de texto
document.getElementById('dtnascimento').addEventListener('input', function () {
    var input = this.value;
    if (input.match(/^\d{2}$/) !== null) {
        this.value = input + '/';
    } else if (input.match(/^\d{2}\/\d{2}$/) !== null) {
        this.value = input + '/';
    } else if (input.match(/^\d{2}\/\d{2}\/\d{4,}$/) !== null) {
        // Limitar o ano a 4 dígitos
        this.value = input.slice(0, 10);
    }
});
</script>
</html>
<!--       _
       .__(.)< (MEOW)
        \___)
 ~~~~~~~~~~~~~~~~~~-->
