<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// require_once '../php/classes/conexao.php';

// $conn = new Conexao();


$conn = conecta(); 

if (isset($_SESSION['sessaoConectado'])) {
    $sessaoConectado = $_SESSION['sessaoConectado'];
} else { 
  $sessaoConectado = false; 
}

if (!$sessaoConectado) { 
     
    $loginCookie = '';

    // recupera o valor do cookie com o usuario    
    if (isset($_COOKIE['loginCookie'])) {
       $loginCookie = $_COOKIE['loginCookie']; 
    }
}


function conecta ($params = "")  // igual a nada pra indicar q aceita vazio !! 
{
  if ($params == "") {
      $params="pgsql:host=pgsql.projetoscti.com.br; dbname=projetoscti31; 
               user=projetoscti31; password=cabs2023";
  }

  $varConn = new PDO($params);

  if (!$varConn) {
      echo "Nao foi possivel conectar";
  } else { return $varConn; }
}


//isso eh luisa
$infosAdm = ['nome' => 'luisa',
          'senha' => '12340'];

$infos = [  'nome' => $_POST['usuario'],
            'senhapessoa' => $_POST['senha'] ];


//luisa+-aqui
function funcaoLogin ($infosAdm, $infos)  
  {
    $infosAdm = ['usuario' => 'luisa',
                 'senha' => '123'];

    $infos = ['nome' => $_POST['usuario'],
            'senhapessoa' => $_POST['senha'] ];

     return true;
  }

  function DefineCookie($infosAdm, $infos) 
  {
   echo "Cookie: $paramNome Valor: $paramValor";  
   setcookie($paramNome, $paramValor, time() + $paramMinutos * 60); 
  }


  session_start();   

  $Amd = false;

  if ($infos<>'') {
    DefineCookie('loginCookie', $login, 60); 
    $_SESSION['sessaoConectado'] = funcaoLogin($infosAdm,$senha,$Adm); 
    $_SESSION['sessaoAdmin']     = $infosAdm;   
}





//isso eh luisa
$result = $conn -> pesquisar('nome', 'senhapessoa');
if ($result->num_rows > 0){
    echo 'bem-vindo', $usuario;
}
$result = $conn -> pesquisar( 'nome' => $infosAdm, 'senha' = $infosAdm)
if ( )


// $result = $conn->inserir('usuarios', $infosAdm);
// if($result) {
//     echo "isso ai";
// } else{
//     echo'usuario nao encontrado';
// }

// $result = $conn->pesquisar("usuarios", "WHERE nome = 'marilu'");
// echo $result[0]['nome'];
// echo $result[0]['nome_usuario'];
// echo $result[0]['senha'];

?>