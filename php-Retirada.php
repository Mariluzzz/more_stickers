<?php
// Receba a saudação e o nome do usuário da URL
$saudacao = $_GET["saudacao"];
$nome = $_GET["nome"];
?>
<?php

 echo "
<!--Opção de Retirada/Endereço-->
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='testeretirada.css'>
    <title>Retirar Pedidos</title>
</head>
<body>
<!--Classe da Saudação-->
<div class='saudacao'>
<?php
    // Exibe a saudação e o nome
    echo "<p>$saudacao, $nome</p>";
?>
</div>
<!--Classe do Título-->
    <div class='titulo'>
        <h1>Opções de Retirada</h1>
    </div>
    <!--Classe dos Botões (NAME=OPCAO)-->
    <div class='escolha-botao'>
        <input type='radio' name='OPCAO' value='fisica'> LOJA FÍSICA
        <input type='radio' name='OPCAO' value='entrega'> ENTREGA
    </div>
<!--Classe do Form-->
<form action='' method='post'>
    <div class='form'>
        <input type='text'  placeholder='CEP' id='CEP'>
        <br><br>
        <input type='text' placeholder='CIDADE' id='cidade'>
        <br><br>
        <input type='text'  placeholder='BAIRRO' id='bairro'>
        <br><br>
        <input type='text'  placeholder='NÚMERO' id='numero'>
        <br><br>
        <input type='text'  placeholder='COMPLEMENTO' id='complemento'>
        <br><br>
        <!--Obsevação do usuário-->
        <textarea id='obsevacao' rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:'></textarea>
        <br><br>
    </div>
    <!--Classe dos Botões VOLTAR E AVANÇAR-->
    <div class='botoes'>

    <div id='bAvancar'>
        <a href='php-FormaPagamento.php'>Avançar</a>
    </div>

    <div id='bVoltar'>
            <a href='php-telaPagamento.php'>Voltar</a>
    </div>
    </div>
</body>
</html>
 ";

?>