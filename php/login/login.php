<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

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

if ($_SESSION['errorSession']) {
    ?>
    <script>
        alert("Usuário não encontrado, favor cadastrar-se :)");
    </script>
    <?php
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "../../css/login.css">
    <title>Login lindo</title>
</head>

<body id="divFundo">
  
    <div style="background-color: white; width: 60%; height: 50%; border-radius: 20px; justify-content: center; margin-top: -40px; margin-left: 18%; ">
                        
                  
        <center><h1><font color=black>LOGIN</font></h1></center>
   
        <section>
            <form method="POST" name="Loginform" action="login_sessao.php">

                <div id="divImg"><img src="../img/perfil.png" width="55%" height="70%"></div>
                        <br>
                <div class="divCampos">
                    <input type="text" name="usuario" id="usuario" placeholder="Nome de Usuário" required>
                        <br>
                        <br>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>

                <div id="divVersenha">
                    <button type="button" onclick="mostrarOcultar()" style="background: transparent; border: none; cursor:pointer;">
                        <img src="../img/foto.png" height="30px" width="30px" style="margin-right: 50px;">
                    </button>
                </div>
                
                <script type="text/javascript" src="../js/login.js"></script>
                </div>
     
                        <br>
                        <div id="divForget">
                            <a href="../../html/cadastro.html" style="color: blue;">Realizar cadastro</a>
                        </div>
                        <div id="divForget">
                            <a href="../html/esqueci.html" style="color: blue;">Esqueci a senha</a>
                        </div>
                        <br>
                     
                <center><button type="submit" name="enviar" id="divEnviar">LOGAR ➜</button></center>
                        <br>
                        <br>
                      
            </form>
        </section>
    </div>

</body>
</html>
