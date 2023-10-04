<?php
 <?php 
 // mostra erros do php
 ini_set ( 'display_errors' , 1); 
 error_reporting (E_ALL);

 include("util.php");

 // pra nao ter que em todo arquivo colocar a mesma linha de conexao
 // manda vazio e no util.php deixa fixa    
 $conn = conecta();

 $linha = [ 'id'        => $_POST['id'],
            'nome'      => $_POST['nome'],
            'celular' => $_POST['matricula'], 
            'nasc'      => $_POST['nasc'],
            'email'     => $_POST['email']   ];

 $sql = "update aluno set 
           nome      = :nome, 
           matricula = :matricula,   
           datanasc  = :nasc, 
           email     = :email   
         where id = :id"; 
 
 // prepara!
 $update = $conn->prepare($sql); 
 $update->execute($linha);

 // volta pra home 
 header('Location: index.php');     

?>



?>