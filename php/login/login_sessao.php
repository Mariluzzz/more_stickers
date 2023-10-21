<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../conexao/conexao.php';

session_start();

if ($_POST['usuario'] != '') {
    try {
        DefineCookie('loginCookie', $_POST['usuario'], 60); 
        $_SESSION['sessaoConectado'] = funcaoLogin($_POST, $admin); 
        $_SESSION['sessaoAdmin'] = $admin;   
    } catch (\Exception $th) {
        ?>
        <script>
            alert("<?php echo $th->getMessage();?>")
        </script>
        <?php
    }
}

// header('Location: index.php');