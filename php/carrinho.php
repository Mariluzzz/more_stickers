<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
 include('conexao/util.php');

 $conn = conecta();   
 
 session_start();

 include ('cabecalho.php');

 $session_id = session_id();  
 $conn = conecta();  

 // se estiver logado pega o codigo do usuario atraves do $login 
 if ( isset($_SESSION['sessaoLogin']) ) {
      $login = $_SESSION['sessaoLogin'];
      $codigoUsuario = ValorSQL($conn, " select id from usuarios 
                                         where nome_usuario = '$login'");
 }
     
 // existe alguma compra associada ao session_id ??
 $existe = intval ( ValorSQL($conn," select count(*) from vendas 
                                    inner join tmpcompra
                                    on venas.id = tmpcompra.fk_id  //querida marilu nesse aqui onde ta escrito id era id_comrpas so q o id msm sendo fk ele pareceu o correto na hora, eu tentei :´) te amo
                                    where tmpcompra.session = '$session_id' ") ) == 1;
 // se nao existe
 if (!$existe) {   

    $dataHoje = date('Y/m/d');
 
    $statusCompra = 'Pendente';

    // cria um registro de compras com o usuario nulo
    ExecutaSQL($conn," insert into compras (data, status) 
                       values ('$dataHoje','$statusCompra') ");

    // recupera o codigo usado no auto-incremento
    $codigoCompra = $conn->lastInsertId();

    // insere o tmpcompra
    ExecutaSQL($conn," insert into tmpcompra (fk_id, session) 
                       values ($codigoCompra,'$session_id') ");  
 
 } else {

    // como o teste mostrou que ja existe um registro de compra
    // retorna esse codigo de compra
    $codigoCompra = intval ( ValorSQL($conn," select id from compras
                                              inner join tmpcompra on vendas.id = 
                                              pedidos.fk_id 
                                              where tmpcompra.session = '$session_id' "));

    // obtem o status dessa compra, se criou agora, entao eh 'pendente'
    $statusCompra = ValorSQL($conn, " select status from vendas 
                                      where vendas.id = $codigoCompra ");
        
 } 

 ////////////// se estiver logado atualiza e 'liga' a compra com o 
 ////////////// usuario

 if (isset($codigoUsuario)) {
    ExecutaSQL($conn,"update vendas 
                         set fk_id = $codigoUsuario 
                      where 
                         fk_id is null and 
                         pedido = $codigoCompra"); 
 }

 // se o carrinho foi chamado por COMPRAR, EXCLUIR ou FECHAR

 if ($_GET) { 
     
    $operacao      = $_GET['operacao'];
    $codigoProduto = $_GET['codigoProduto'];

    // obtem a qtd atual desse produto no carrinho  
    $quantidade = intval ( ValorSQL($conn," select produto 
                                            from vendas 
                                            where 
                                               fk_id_produto = $codigoProduto and 
                                               fk_id_compra = $codigoCompra ") );  
    if ($operacao == 'incluir') {
        echo "<br> >> Vamor incluir...<br>";
        if ($quantidade == 0) {
            ExecutaSQL($conn,
                      " insert into  venda_produto 
                           (fk_id_produto,fk_id_vendas,pedido) 
                        values ($codigoProduto,$codigoCompra,1) "); 
        } else {
            ExecutaSQL($conn,
                      " update  
                           set quantidade = quantidade + 1 
                        where 
                           fk_id_vendas_produto = $codigoProduto and 
                           fk_id_vendas = $codigoCompra "); 
                       
        }
    } else 
    if ($operacao == 'excluir') {
        echo "<br> >> Vamor excluir...<br>";     
        if ($quantidade == 1) { 
            ExecutaSQL($conn," delete from 
                                  compra_produto 
                               where 
                                  fk_id_produto = $codigoProduto and 
                                  fk_id_vendas = $codigoCompra ");         
        } else {
            ExecutaSQL($conn," update compra_produto 
                                   set quantidade = quantidade - 1 
                               where 
                                  fk_id_produto = $codigoProduto and 
                                  fk_id_pedido = $codigoCompra ");       
        }
    } else 
    if ($operacao == 'fechar') {
       echo "<br> >> Vamor fechar...<br>";  
       // muda o status da compra pra concluida
       // faz um form pra colocar forma de pagamento
       // colocar opcao de pix, cartao, etc, etc
       // conforme orientacao da professora jovita, 
       // exclua fisicamente o tmpcompra referente a essa compra
       // ...   
    }
 } 
 
   
 // faz a selecao pra montar a tabela
 $sql = " select produtos.cod_produto, 
                 produtos.descricao as descprod, 
                 compra_produto.quantidade, 
                 produtos.valor, 
                 produtos.valor * compra_produto.quantidade as sub  
          from produtos 
               inner join compra_produto on 
                  produtos.cod_produto = compra_produto.fk_cod_produto 
          where compra_produto.fk_cod_compra = $codigoCompra  
          order by produtos.descricao ";
   
 $select = $conn->query($sql);
   
 // cria table com itens no carrinho e seus subtotais
 while ( $linha = $select->fetch() ) {
      
      $codigoProduto = $linha['cod_produto']; 
      $descProd      = $linha['descprod'];
      $quant         = $linha['quantidade'];
      $vunit         = $linha['valor'];
      $sub           = $linha['sub'];

      // vc poderia incluir links para 'incluir' alem dos 'excluir'
      // com isso, o usuario nao precisaria voltar na home pra incrementar 
      // a quantidade do mesmo produto

      echo "<tr>
             <td>$descProd</td>
             <td>$quant</td>
             <td>$vunit</td>
             <td>$sub</td>
             <td><a href='carrinho.php?operacao=excluir&codigoProduto=$codigoProduto'>Excluir</a></td>
            </tr>";    
 }
 
 echo "</table>";
 
 // calcula o total e mostra junto com o status da compra     
 $total = ValorSQL($conn," select sum (produtos.valor_total * valor_total.quantidade)  
                           from produtos 
                                inner join compra_produto on 
                                   produtos.id = compra_produto.fk_id                           
                           where compra_produto.fk_cod_compra = $codigoCompra "); 

 echo "Status da compra: $statusCompra<br>";
 echo "Total: $total <br><br>";
 
 // se o login foi obtido (se esta logado), mostra link 'fechar carrinho' 
 if ( isset($login) ) 
 {
   if ($statusCompra == 'Pendente' && $login <> '') {
     echo "<a href='carrinho.php?operacao=fechar&codigoProduto=0'>Fechar o carrinho</a>";         
   }
 }

 // link pra voltar pra home
 echo "<br>
       <a href='index.php'>Home</a>";
?>