<?php
   /////////////////////////////////////////////////////////////
   ////// ENVIAR SENHA
   /////////////////////////////////////////////////////////////

   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);   

   include "util.php";
   include 'conexao/conexao.php';
   $conn  = conecta();
   $erro  = "";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/esqueci.css">
    <link rel="stylesheet" href="../css/styleBarra.css">
   <script type="text/javascript" src="../js/script.js"></script>
    <title>A+ | Esqueci a Senha</title>
</head>
<body>
<div id="barra"></div>
    <div class='container'>
        <div class='titulo'>
            <h1>Esqueci a Senha</h1>
        </div>
        <form name="formSenha" method="post" action ="" class="forms">
            <input type="text" id="login-usuario" name="login" class="info" placeholder="Digite o usuário...">
            <input type="email" name="email" class="info" placeholder="Digite o Email...">
	        <br>
            <a href="login/login.php" class="link">Já tenho uma senha</a>
            <br> <br>
            <input type="submit" name="entrar" value="Nova senha" class="button">
        </form>
    </div>
     <!-- BOTÕES CARRINHO/VOLTAR AO TOPO -->
     <div class="botoes">
        <div class="botaoCarrinho">
        <a href="carrinho.php"> <img src="../img/fixos/carrinhoOriginal.svg"> </a>
        </div>
        <div class="voltaTopo">
            <a href="#"> <img src="../img/fixos/voltaTopo.svg"> </a>
        </div>
        <div class="botaoHome">
            <a href="home.php"> <img src="../img/fixos/homeOriginal.svg"> </a>
        </div>
    </div>
    <div id="footer"></div>
</body>
</html>

<?php 
   if ($_POST) {
      
      $login = $_POST['login'];
      $email = $_POST['email'];

      if (confirmaLogin($login, $email))
      {
      
         //echo "<br>Recuperando a senha...";    
         $NovaSenha = GeraSenha();
         //echo "<br>Senha gerada: $NovaSenha";

         if (EnviaEmail ( $email, 
                        "Recuperacao de Senha", 
                        "<html><body>Sua nova senha: <b>$NovaSenha</b></body></html>",
                        $erro ))  {

            if (ExecutaSQL($conn, "update usuarios set senha='$NovaSenha' 
                           where nome='$login'")) 
               {      
                    echo '<script>';
                    echo 'setTimeout(function() { alert("Email de recuperação enviado com sucesso!"); ';
                    echo 'window.location.href = "login/login.php"; }, 0);'; 
                    echo '</script>';
                    //header('Location: login/login.php');
               } 
               
            
            } else echo "<br>Erro ao enviar email";
      }
   }  
?>