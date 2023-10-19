<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="stylesheet" href="pagamento.css">
</head>
<body>
    <div class="container">
        <!-- Título -->
        <div class="titulo">
            <h1>Pagamento</h1>
        </div>

        <!-- Imagem -->
        <div class="imagem">
            <img src="/more_stickers/imgs/comprar_sacolinha.png" alt="sacolinha">
        </div>

        <!-- Formulário -->
        <div class="forms">
            <form action="processo.php" method="post">
                <input type="text" class="info" placeholder="Nome Completo" id="nome" name="nome">
                <br><br>
                <input type="text" class="info" placeholder="CPF/CNPJ" id="cpf" name="cpf">
                <br><br>
                <input type="email" class="info" placeholder="E-mail" id="email" name="email">
                <br><br>
                <input type="text" class="info" placeholder="Celular" id="celular" name="celular">
                <br><br>
                <input type="text" class="info" id="dtnascimento" placeholder="(DD/MM/AAAA)" name="dtnascimento">
                <br><br>
                <input type="text" class="info" id="senha" placeholder="Senha" name="senha">
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
