<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário se o método for POST
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $celular = $_POST["celular"];
    $dtnascimento = $_POST["dtnascimento"];
    $senha = $_POST["senha"];

    // Armazena para processar
    $_SESSION['nome'] = $nome;

    // Redirecionar para a próxima página
    header("Location: php-Retirada.php");
    exit;
}
?>