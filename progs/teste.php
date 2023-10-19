
<?php
// Receba a saudação e o nome do usuário da URL
$saudacao = $_GET["saudacao"];
$nome = $_GET["nome"];
?>
<?php

 echo "
 <html>
 <head>
     <meta charset='UTF-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <link rel='stylesheet' href='retirada.css'>
     <title>Retirar Pedidos</title>
 </head>
 <body>
     <!--Classe da Saudação-->
     <div class='saudacao'>
         <?php
             // Exibe a saudação e o nome
             echo '<p>$saudacao, $nome</p>';
         ?>
         </div>
     <div class='container'>
         <!--Classe do Título-->
         <div class='titulo'>
             <h1>Opções de Retirada</h1>
         </div>
         <!--Classe dos Botões (NAME=OPCAO)-->
         <div class='escolha-botao'>
             <label>Escolha a forma para entrega:</label><br><br>
             <input type='radio' name='OPCAO' value='fisica' class='radioButton' id='fisica'>
             <label for='fisica' class='label'>LOJA FÍSICA</label>
             <input type='radio' name='OPCAO' value='entrega' class='radioButton' id='entrega'>
             <label for='entrega' class='label'>ENTREGA</label>
         </div>
         <!--Classe do Form-->
         <form action=' method='post'>
             <div class='form'>
                 <input type='text'  placeholder='CEP' id='CEP' class='info'>
                 <br><br>
                 <input type='text' placeholder='CIDADE' id='cidade' class='info'>
                 <br><br>
                 <input type='text'  placeholder='BAIRRO' id='bairro' class='info'>
                 <br><br>
                 <input type='text'  placeholder='NÚMERO' id='numero' class='info'>
                 <br><br>
                 <input type='text'  placeholder='COMPLEMENTO' id='complemento' class='info'>
                 <br><br>
                 <!--Obsevação do usuário-->
                 <div>
                     <textarea class='observacao' rows='4' cols='50' placeholder='Alguma observação? Escreva aqui:'></textarea>
                 </div>
                 <br><br>
             </div>
         <!--Classe dos Botões VOLTAR E AVANÇAR-->
         <div class='botoes'>
             <div id='bVoltar'>
                 <a href='telaPagamento.html'>Voltar</a>
             </div>
             <div id='bAvancar'>
                 <a href='FormaPagamento.html'>Avançar</a>
             </div>
         </div>
     </div>
 </body>
 </html>
 ";

?>