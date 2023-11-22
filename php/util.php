<?php
  // funcao para confirmar email no banco
  function confirmaLogin($paramLogin, $paramEmail) {
    $conn = conecta();
    $varSQL = "SELECT email from usuarios where nome = '$paramLogin';";
    $select = $conn->query($varSQL)->fetch();

    $autenticado = ($paramEmail == $select['email']); //retorna true ou false

    return $autenticado;
  }

  function ValorSQL( $pConn, $pSQL) 
  {
   $linhas = $pConn->query($pSQL)->fetch();

   if ($linhas > 0) { 
       return $linhas[0]; 
   } else { 
       return "0"; 
   }  
  }

  function ExecutaSQL( $paramConn, $paramSQL ) 
  {
    // exec eh usado para update, delete, insert
    // eh um metodo da conexao
    // retorna o nro de linhas afetadas
    $linhas = $paramConn->exec($paramSQL);
  
    if ($linhas > 0) { 
        return TRUE; 
    } else { 
        return FALSE; 
    }  
  }

  function CriaPDF ( $paramTitulo, $paramHtml, $paramArquivoPDF )
  {
   $arq = false;     
   try {  
    require 'fpdf/html_table.php'; 
    // abre classe fpdf estendida com recurso que converte <table> em pdf
  
    $pdf = new PDF();  
    // cria um novo objeto $pdf da classe 'pdf' que estende 'fpdf' em 'html_table.php'
    $pdf->AddPage();  // cria uma pagina vazia
    $pdf->SetFont('helvetica','B',20);       
    $pdf->Write(5,$paramTitulo);    
    $pdf->SetFont('helvetica','',8);     
    $pdf->WriteHTML($paramHtml); // renderiza $html na pagina vazia
    ob_end_clean();    
    // fpdf requer tela vazia, essa instrucao 
    // libera a tela antes do output
    
    // gerando um arquivo 
    $pdf->Output($paramArquivoPDF,'F');
    // gerando um download 
    $pdf->Output('D',$paramArquivoPDF);  // disponibiliza o pdf gerado pra download
    $arq = true;
   } catch (Exception $e) {
     echo $e->getMessage(); // erros da aplica��o - gerais
   }
   return $arq;
  }

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  ////////////////////////////////////////////////////////////////
   // Envio de emails
  // Marcelo C Peres / Heitor Lima, 2023
  /* Exemplo: 
     if ( EnviaEmail ('fulano@fulano','Feliz Aniversario',
                      '<html><body>Feliz niver</body></html>') 
     {
      echo 'enviado com sucesso';
     }
  */   

  ////////////////////////////////////////////////////////////////
  function EnviaEmail ( $paramEmailDestino, 
                        $paramAssunto, 
                        $paramHtml, 
                        &$paramErro,  
                        $paramUsuario = "marcelocabello@projetoscti.com.br", 
                        $paramSenha = "MarceloC@belo", 
                        $paramSMTP = "smtp.projetoscti.com.br" )   
  {

    // troque usuario e senha !!!! 
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
 
   require '../PHPMailer/src/PHPMailer.php';
   require '../PHPMailer/src/Exception.php';
   require '../PHPMailer/src/SMTP.php';
        
   try {
     $enviado = false;

     //cria instancia de phpmailer
     //echo "<br>Tentando enviar para $paramEmailDestino...";
     $mail = new PHPMailer(); 
     $mail->IsSMTP();  
      
     /*
     //Configuração dos emails do remetente e do destinatário
      $mail->setFrom($pRemetente, 'ByteCraft'); //email do remetente
    //  $mail->addReplyTo($pUsuario); //Email para respossta, caso não queira que o usuário responda, coloque no.reply@...
     
      */
     // servidor smtp
     $mail->Host = $paramSMTP;
     $mail->SMTPAuth = true;      // requer autenticacao com o servidor                         
     $mail->SMTPSecure = 'tls';                            
      
     $mail-> SMTPOptions = array (
       'ssl' => array (
       'verificar_peer' => false,
       'verify_peer_name' => false,
       'allow_self_signed' => true ) );
      
     $mail->Port = 587;      
      
     $mail->Username = $paramUsuario; 
     $mail->Password = $paramSenha; 
     $mail->From = $paramUsuario; 
     $mail->FromName = "Suporte de senhas"; 
  
     //Conteúdo do email
     $mail->CharSet = 'UTF-8'; //Codificação do email
     $mail->AltBody = 'seu email nao suporta html'; //Uma mensagem avisando destinatário que o seu email não suporta HTML
  
     $mail->AddAddress($paramEmailDestino, "Usuario"); 
     $mail->IsHTML(true); 
     $mail->Subject = $paramAssunto; 
     $mail->Body = $paramHtml;
     
     $enviado = $mail->Send(); 
       
     if (!$enviado) {
        echo "<br>Erro: " . $mail->ErrorInfo;
     } else {
        //echo "<br><b>Enviado!</b>";
     }
      
   } catch (phpmailerException $e) {
     echo $e->errorMessage(); // erros do phpmailer
     $paramErro = $e->errorMessage();
   } catch (Exception $e) {
     echo $e->getMessage(); // erros da aplicação - gerais
     $paramErro = $e->getMessage();    
   }      

   return $enviado;         
  }

  /**
  * Função para gerar senhas aleatórias
  *
  * @author    Thiago Belem <contato@thiagobelem.net>
  *
  * @param integer $tamanho Tamanho da senha a ser gerada
  * @param boolean $maiusculas Se terá letras maiúsculas
  * @param boolean $numeros Se terá números
  * @param boolean $simbolos Se terá símbolos
  *
  * @return string A senha gerada
  */

  /*
  * Função para executasql frases sql
  * marcelo c peres - 2023
  */

  function GeraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
  {
    //$lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    //$caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros)    $caracteres .= $num;
    if ($simbolos)   $caracteres .= $simb;

    $len = strlen($caracteres);
    
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
    }
    
    return $retorno;
  }


?>
