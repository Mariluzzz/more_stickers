<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../conexao/conexao.php';

session_start();

if ($_POST['usuario'] != '') {

    DefineCookie('loginCookie', $_POST['usuario'], 60); 

    $_SESSION['sessaoConectado'] = funcaoLogin($_POST, $admin); 
    $_SESSION['sessaoAdmin'] = $admin;   

    if(!$_SESSION['sessaoConectado']) {
        $_SESSION['errorSession'] = true;
        header('Location: login.php');
    } else {
        header('Location: ../home.php');
    }
} 
    
