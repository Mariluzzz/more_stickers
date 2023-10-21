<?php
ini_set ( 'display_errors' , 1); 
error_reporting (E_ALL);   

session_start(); 
$_SESSION['sessaoConectado'] = false; 
$_SESSION['sessaoAdmin'] = false; 
$_SESSION['sessaoDeslogada'] = true;
    
header('Location: ../home.php');
?>