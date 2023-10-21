<?php
ini_set ( 'display_errors' , 1); 
error_reporting (E_ALL);  

if (isset($_SESSION['sessaoConectado'])) {
    $sessaoConectado = $_SESSION['sessaoConectado'];
} else { 
    $sessaoConectado = false; 
}

if ($sessaoConectado) {

    if($_SESSION['sessaoAdmin']) {
        '<ul>'+
            '<li>'+
                '<a href="../php/cadastroProdutosTela.php?tela=add" id="cadClient" >Cadastrar</a>'+
            '</li>'+
            '<li>'+
                '<a href="../php/estoque.php" id="listClient">Estoque</a>'+
            '</li>'+
            '<li>'+
                '<a href="#" id="listClient" >Relatório</a>'+
            '</li>'+
        '</ul>'+
    } else {

    }
    /*
    aqui vc coloca opcoes de 
    - fechar o carrinho e pagar
    - opcoes de perfil do usuario
      1. forma de pagamentos padrão por exemplo ...
      2. compras anteriores, etc
    */
    echo "<p align='right'><a href='logout.php'>Sair</a></p>";

    // caso seja administrador
    if ( $_SESSION['sessaoAdmin'] ) {
       echo "<p align='right'>Bom dia, Administrador<br>";
       /*
        aqui vc colocar opcoes de administracao
        - cadastro de produtos
        - cadastro de usuarios 
        ...
       */   
    // caso seja um usuario comum
    } else {   
      echo "<p align='right'>Bom dia, Fulano<br></p>";
    }
// caso nao esteja logado    
} else {
    /*
     aqui vc pode
     - ver o carrinho
     - procurar produtos
    */
    echo "<p align='right'><a href='login.php'>Login</a></p>";
}

?>