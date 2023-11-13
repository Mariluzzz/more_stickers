<?php
session_start();

include("cabecario.php");

if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];
} else {
    header('Location: FormaPagamento.php');
    exit;
}

// Mostra hora
$data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); // Configura o fuso horário de Brasília
$hora_atual = $data->format("H");
// Determinar a saudação com base na hora atual
if ($hora_atual >= 6 && $hora_atual < 12) {
    $saudacao = "Bom dia 🌄";
} elseif ($hora_atual >= 12 && $hora_atual < 18) {
    $saudacao = "Boa tarde 🌇";
} else {
    $saudacao = "Boa noite 🌆";
}
?>

<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='../../css/retirada.css'>
    <title>Retirar Pedidos</title>
</head>
<body>
    <div class='container'>
        <div class='saudacao'>
            <?php
            echo "<h1>$saudacao, $nome!</h1>";
            ?>
        </div>
        <div class='titulo'>
            <h1>Opções de Retirada</h1>
        </div>
        <div class='escolha-botao'>
            <input type='radio' name='OPCAO' value='fisica' class='radioButton' id='fisica'>
            <label for='fisica' class='label'>LOJA FÍSICA</label>
            <input type='radio' name='OPCAO' value='entrega' class='radioButton' id='entrega'>
            <label for='entrega' class='label'>ENTREGA</label>
            <input type="radio" name='OPCAO' value='gerar' class='radioButton' id='gerar'>
            <label for="gerar" class='label'>DEMOSTRAÇÃO</label>
        </div>
        <form action='FormaPagamento.php' method='post'>
            <div class='form'>
                <input type='text'  placeholder='CEP' id='CEP' class='info'>
                <br><br>
                <input type='text' placeholder='CIDADE' id='cidade' class='info'>
                <br><br>
                <input type='text'  placeholder='BAIRRO' id='bairro' class='info'>
                <br><br>
                <input type='text'  placeholder='NÚMERO' id='numero' class='info'>
                <br><br>
                <input type='text'  placeholder='COMPLEMENTO' id='complemento' class='info'>
                <br><br>
                <!-- Observação do usuário -->
                <div>
                    <textarea class='observacao' rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:'></textarea>
                </div>
                <br><br>
            </div>
            <div class='botoes'>
                <div id='bVoltar'>
                </div>
                <div id='bAvancar'>
                    <input type='submit' id='bAvancar' value=''>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
<script>
        document.getElementById('gerar').addEventListener('click', function() {
            // Gere valores aleatórios fictícios
            document.getElementById('CEP').value = Math.floor(10000000 + Math.random() * 90000000).toString();
            document.getElementById('numero').value = Math.floor(1 + Math.random() * 1000).toString();
            const bairros = ["Centro", "Bairro A", "Bairro B", "Bairro C"];
            const cidades = ["São Paulo", "Rio de Janeiro", "Belo Horizonte", "Porto Alegre"];
            document.getElementById('bairro').value = bairros[Math.floor(Math.random() * bairros.length)];
            document.getElementById('cidade').value = cidades[Math.floor(Math.random() * cidades.length)];
        });
        document.getElementById('bVoltar').addEventListener('click', function() {
            window.location.href = 'php-LoginPagamento.php';
        });
</script>
<!--       _
       .__(.)< (MEOW)
        \___)   
 ~~~~~~~~~~~~~~~~~~-->
