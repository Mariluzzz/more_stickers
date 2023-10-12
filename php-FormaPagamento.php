<?php

echo "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='testeretirada.css'>
    <title>Formas de Pagamento</title>
</head>
<body>
<div class='titulo'>
    <h1>Formas de Pagamento</h1>
</div>

<form action='' method='post'>
<label>Escolha a forma para pagar:</label>
<div class='escolha-botao'>
    <input type='radio' name='OPCAO' value='pix'> PIX
    <input type='radio' name='OPCAO' value='cartao' onclick='preencherCamposCartao()'> CARTÃO
    <input type='radio' name='OPCAO' value='dinheiro'> DINHEIRO
</div>

<div class='form'>
    <input type='text' placeholder='NÚMERO DO CARTÃO' id='cartao' name='cartao'>
    <br><br>
    <input type='text' placeholder='CVV' id='cvv' name='cvv'>
    <br><br>
    <input type='text' placeholder='DATA DE VALIDADE' id='data_validade' name='data_validade'>
    <br><br>
    <label>Valor para Pagar:</label>
    <br><br>
    <label>Data do Pagamento:</label>
    <br><br>
    <textarea id='observacao' name='observacao' rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:'></textarea>
    <br><br>
</div>

<div class='botoes'>
    <div id='bVoltar'>
        <a href='php-Retirada.php'>Voltar</a>
    </div>
</div>
</form>

<script>
function preencherCamposCartao() {
    // Gere valores aleatórios para os campos do cartão
    var cartao = generateRandomCardNumber();
    var cvv = generateRandomCVV();
    var dataValidade = generateRandomExpirationDate();

    // Preencha os campos com os valores gerados
    document.getElementById('cartao').value = cartao;
    document.getElementById('cvv').value = cvv;
    document.getElementById('data_validade').value = dataValidade;
}

// Função para gerar um número de cartão de crédito aleatório de 16 dígitos
function generateRandomCardNumber() {
    var cardNumber = '4';
    for (var i = 1; i <= 15; i++) {
        cardNumber += Math.floor(Math.random() * 10);
    }
    return cardNumber;
}

// Função para gerar um CVV aleatório de 3 dígitos
function generateRandomCVV() {
    return Math.floor(Math.random() * 1000).toString().padStart(3, '0');
}

// Função para gerar uma data de validade aleatória no formato MM/YY (mês/ano)
function generateRandomExpirationDate() {
    var month = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
    var year = new Date().getFullYear() + 2;
    return month + '/' + String(year).substr(2);
}
</script>

</body>
</html>
";
?>
