<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário se o método for POST
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $celular = $_POST["celular"];
    $dtnascimento = $_POST["dtnascimento"];
    $senha = $_POST["senha"];

    // Realize qualquer ação desejada com os dados aqui, como salvar no banco de dados.

    $hora_atual = date("H");

    // Determinar a saudação com base na hora atual
    if ($hora_atual >= 6 && $hora_atual < 12) {
        $saudacao = "Bom dia";
    } elseif ($hora_atual >= 12 && $hora_atual < 18) {
        $saudacao = "Boa tarde";
    } else {
        $saudacao = "Boa noite";
    }

    // Redirecionar para php-Retirada.php com a saudação como parâmetro GET
    header("Location: php-Retirada.php?saudacao=$saudacao&nome=$nome");
    exit;
}

echo "
<!--Primeira Tela de Pagamento-->
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Pagamento</title>
    <link rel='stylesheet' href='Pagamento.css'>
</head>
<body>
<!--Classe do Título-->
        <div class='titulo'>
            <h1>Pagamento</h1>
        </div>
        <!--Classe da Imagem-->
        <div class='imagem'>
            <img src='comprar_sacolinha.png' alt=''>
        </div>
<!--Classe do Form-->
        <div class='forms'>

<form method='post'>
            <input type='text' class='info' placeholder='Nome Completo' id='nome'>
            <br><br>
            <input type='text'  class='info' placeholder='CPF/CNPJ' id='cpf'>
            <br><br>
            <input type='email' class='info' placeholder='E-mail' id='email' >
            <br><br>
            <input type='text' class='info' placeholder='Celular' id='celular'>
            <br><br>
            <input type='text' class='info' id='dtnascimento' placeholder='(DD/MM/AAAA)'>
            <br><br>
            <input type='text' class='info' id='senha' placeholder='Senha'>
            <br><br>
        </div>
</form>
<!--Classe dos Botões VOLTAR E AVANÇAR-->

<div class='botoes'>

    <div id='bAvancar'>
        <a href='php-Retirada.php'>Avançar</a>
    </div>
<!--Voltar para a tela anterior ao pagamento-->
    <div id='bVoltar'>
        <a href=''>Voltar</a>
    </div>
    <input type='submit' value='ir'>
     </div>
</body>
</html>
";

?>

<script>
// Adicionar um ouvinte de evento de entrada para formatar a data no campo de texto
document.getElementById('dtnascimento').addEventListener('input', function () {
    var input = this.value;
    if (input.match(/^\d{2}$/) !== null) {
        this.value = input + '/';
    } else if (input.match(/^\d{2}\/\d{2}$/) !== null) {
        this.value = input + '/';
    }
});
</script>
