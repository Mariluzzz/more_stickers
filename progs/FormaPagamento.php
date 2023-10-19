<?php
session_start();

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
} else {
    header("Location: Concluido.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='forma.css'>
    <title>Formas de Pagamento</title>
</head>
<body>
    <div class='container'>
        <div class='titulo'>
            <h1><?php echo $nome; ?>, hora de pagar! 😎💸</h1>
            <h1>Formas de Pagamento</h1>
        </div>

        <form action='Concluido.php' method='post'>
            <div class='escolha-botao'>
                <div class='escolha-botao'>
                    <input type='radio' name='OPCAO' value='pix' class='radioButton' id='pix'>
                    <label for='pix' class='label'>PIX</label>
                    <input type='radio' name='OPCAO' value='cartao' class='radioButton' onclick='preencherCamposCartao()' id='cartao'>
                    <label for='cartao' class='label'>CARTÃO</label>
                    <input type='radio' name='OPCAO' value='dinheiro' class='radioButton' id='dinheiro'>
                    <label for ='dinheiro' class='label'>DINHEIRO</label>
                </div>
            </div>

            <div class='form'>
                <input type='text' placeholder='NÚMERO DO CARTÃO' id='numcartao' name='numcartao'>
                <br><br>
                <input type='text' placeholder='CVV' id='cvv' name='cvv'>
                <br><br>
                <input type='text' placeholder='DATA DE VALIDADE' id='data_validade' name='data_validade'>
                <br><br>
                
                <div class='infoPagamento'>
                    <label>Valor para Pagar:</label>
                    <!-- PHP do valor a pagar -->
                    <br><br>
                    <!-- PHP da data de pagamento -->
                    <label>Data do Pagamento:</label>
                </div>
                <br><br>
                <textarea id='observacao' name='observacao' rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:'></textarea>
                <br><br>
                <div class='botoes'>
                    <div id='bVoltar'>
                    <div></div>
                    </div>
                    <div id='bAvancar'>
                        <input type='submit' id='bAvancar' value=''>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!-- SCRIPT DE FUNÇÕES -->
    <script>
        function preencherCamposCartao() {
            var cartao = generateRandomCardNumber();
            var cvv = generateRandomCVV();
            var dataValidade = generateRandomExpirationDate();

            document.getElementById('numcartao').value = cartao;
            document.getElementById('cvv').value = cvv;
            document.getElementById('data_validade').value = dataValidade;
        }

        function generateRandomCardNumber() {
            var cardNumber = '4';
            for (var i = 1; i <= 15; i++) {
                cardNumber += Math.floor(Math.random() * 10);
            }
            return cardNumber;
        }

        function generateRandomCVV() {
            return Math.floor(Math.random() * 1000).toString().padStart(3, '0');
        }

        function generateRandomExpirationDate() {
            var month = String(Math.floor(Math.random() * 12) + 1).padStart(2, '0');
            var year = new Date().getFullYear() + 2;
            return month + '/' + String(year).substr(2);
        }
        document.getElementById('bVoltar').addEventListener('click', function() {
            window.location.href = 'Retirada.php';
        });
</script>
</body>
</html>