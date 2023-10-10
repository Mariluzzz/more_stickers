<?php
// Configuração para exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicializa a sessão
session_start();

// Variáveis para armazenar dados do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$adm = false;

// Verifica se o formulário foi enviado
if (!empty($usuario) && !empty($senha)) {
    // Define o cookie e verifica a autenticação
    DefineCookie('loginCookie', $usuario, 60); 
    $_SESSION['sessaoConectado'] = funcaoLogin($usuario, $senha, $adm); 
    $_SESSION['sessaoAdmin'] = $adm;   
}

// Função para conexão com o banco de dados
function conecta($params = "")
{
    
}

// Função para login de administrador
function funcaoLogin($paramLogin, $paramSenha, &$paramAdmin)
{
    $paramAdmin = ($paramLogin == 'morestickers' && $paramSenha == '123');
    return $paramAdmin;
}

// Verifica se há alguém logado
if (isset($_SESSION['sessaoConectado'])) {
    $sessaoConectado = $_SESSION['sessaoConectado'];
} else {
    $sessaoConectado = false;
}

if ($sessaoConectado) {
    // Logout
    $_SESSION['sessaoConectado'] = false;
    $_SESSION['sessaoAdmin'] = false;
}

if ($_SESSION['sessaoAdmin']) {
    echo "<p align='right'>Oi adms lindos<br>";
} else {
    echo "<p align='right'>Bom dia, $usuario<br></p>";
}

// Função para definir um cookie
function DefineCookie($paramNome, $paramValor, $paramMinutos)
{
    echo "Cookie: $paramNome Valor: $paramValor";
    // Define um cookie com o nome, valor e tempo de expiração
    setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); // Note que aqui converti minutos para segundos
}
?>