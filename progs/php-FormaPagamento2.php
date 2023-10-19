<?php

echo "
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='retirada.css'>
        <title>Formas de Pagamento</title>
    </head>
    <body>
    <div class='container'>

        <!--Classe do Título-->
        <div class='titulo'>
            <h1>Formas de Pagamento</h1>
        </div>

        <!--Classe das formas de pagamento-->
        <div class='escolha-botao'>
            <label>Escolha a forma para pagar:</label><br><br>
            <input type='radio' name='OPCAO' value='pix' class='radioButton' id='pix'>
            <label for='pix' class='label'>PIX</label>
            <input type='radio' name='OPCAO' value='cartao' class='radioButton' id='cartao'>
            <label for='cartao' class='label'>CARTÃO</label>
            <input type='radio' name='OPCAO' value='dinheiro' class='radioButton' id='dinheiro'>
            <label for='dinheiro' class='label'>DINHEIRO</label>
        </div>
        
        <!--Classe do Form-->
        <form action=' method='post'>
        <div class='form'>
            <input type='text'  placeholder='NÚMERO DO CARTÃO' class='info'>
            <br><br>
            <input type='text' placeholder='CVV' class='info'>
            <br><br>
            <input type='text'  placeholder='DATA DE VALIDADE' class='info'>
            <br><br>
            <div class='infoPagamento'>
                <label>Valor para Pagar:</label>
                <!--PHP do valor a pagar-->
                <br><br>
                <!--PHP da data de pagamento-->
                <label>Data do Pagamento:</label>
            </div>
            <br><br>
            <!--Obsevação do usuário-->
            <div>
                <textarea rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:' class='observacao'></textarea>
            </div>
            <br><br>
        </div>
        <!--Classe dos Botões VOLTAR E AVANÇAR-->
        <div class='botoes'>
            <div id='bVoltar'>
                <a href='Retirada.html' >Voltar</a>
            </div>    
            <div id='bAvancar'>
                <a href='>Avançar</a>
            </div>
        </div>
    </div>

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
