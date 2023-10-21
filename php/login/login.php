<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['sessaoConectado'])) {
    $sessaoConectado = $_SESSION['sessaoConectado'];
} else {    
    $sessaoConectado = false; 
}

if (!$sessaoConectado) { 
    $loginCookie = '';
    
    if (isset($_COOKIE['loginCookie'])) {
       $loginCookie = $_COOKIE['loginCookie']; 
    }
}
?>