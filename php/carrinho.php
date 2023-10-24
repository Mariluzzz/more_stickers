<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 
 include('conexao/conexao.php');
 include("cabecario.php");
 
 session_start();

 $session_id = session_id();  

 CREATE TABLE public.vendas (
	id serial4 NOT NULL,
	"data" timestamp NOT NULL,
	pedido int4 NOT NULL,
	usuario int4 NOT NULL,
	produto int4 NOT NULL,
	forma_pag int4 NOT NULL,
	valor_total float8 NOT NULL,
	CONSTRAINT vendas_pkey PRIMARY KEY (id),
	CONSTRAINT vendas_forma_pag_fkey FOREIGN KEY (forma_pag) REFERENCES public.formas_pagamento(id),
	CONSTRAINT vendas_pedido_fkey FOREIGN KEY (pedido) REFERENCES public.pedidos_carrinho(id),
	CONSTRAINT vendas_produto_fkey FOREIGN KEY (produto) REFERENCES public.produtos(id),
	CONSTRAINT vendas_usuario_fkey FOREIGN KEY (usuario) REFERENCES public.usuarios(id)

   CREATE TABLE public.pedidos_carrinho (
      id serial4 NOT NULL,
      usuario int4 NOT NULL,
      produto int4 NOT NULL,
      dataentrada timestamp NOT NULL,
      datasaida timestamp NOT NULL,
      CONSTRAINT pedidos_carrinho_pkey PRIMARY KEY (id),
      CONSTRAINT pedidos_carrinho_produto_fkey FOREIGN KEY (produto) REFERENCES public.produtos(id),
      CONSTRAINT pedidos_carrinho_usuario_fkey FOREIGN KEY (usuario) REFERENCES public.usuarios(id)
   );

 switch ($_GET['opc']) {
   case 'incluir':
        if ($quantidade == 0) {
         $infos = [
            'usuario' => date("Y-m-d H:i:m"),
            'produto' => $_GET['produto'],
            'dataentrada' => date("Y-m-d H:i:m"),
            'datasaida' => NULL
         ];
         inserir("pedidos_produtos", $infos);
         ?>
         <body>
         <div class='content'>
         <section>
            <table>
               <thead>
               <tr>
                  <th>Produto</th>
                  <th>Preço</th>
                  <th>Quantidade</th>
                  <th>Total</th>
                  <th>-</th>
               </tr>
               </thead>
      <?php
      $result = consulta("select b.id, b.nome, b.descricao as descProd, b.preco, c.descricao as descCat
                           from 
                              pedidos_carrinho a
                           inner join 
                              produtos b
                           on 
                              b.id = a.produto 
                           inner join 
                              categorias c
                           on 
                              c.id = b.categoria
                           where 
                           a.datasaida is null");
      foreach($result as $infos) {
         $codigoProduto = $infos['id']; 
         $descProd = $linha['nome'];
         $nome = $linha['descProd'];
         $quant = 1;
         $valor  = $linha['preco'];
         ?>
<tbody>
     <tr>
     <td>
       <div>
         <img src="../img/produtos/<?php echo $infos['descCat'];?>/<?php echo $infos['nome'];?>.png" alt=' ' width=50/>
         <div class='info'>
           <div class='name'><?php echo $infos[''];?></div>
           <div class='category'>$descProd</div>
         </div>
       </div>
     </td>
     <td>R$$vunit</td>
     <td>
       <div class='qty'>
         <button><i class='bx bx-minus'></i></button>
         <span>$quant</span>
         <button><i class='bx bx-plus'></i></button>
       </div>
     </td>
     <td>R$$sub</td>
     <td>
        <a href='carrinho.php?operacao=2&codigoProduto=$codigoProduto'>
           <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
           <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
           </svg><i class='bx bx-x'>
           </i>
        </a>
     </td>
   </tr>
 </tbody>
<?php
      }


      break;
   case 'alterar':

      break;
   case 'excluir':

      break;
   case 'concluir':
      
      break;
   default:
      
      break;
 }

 if ( isset($_SESSION['sessaoLogin']) ) {
      $login = $_SESSION['sessaoLogin'];
      $result = pesquisar("usuarios", "where nome_usuario = '$login'");
      $cod_user = $result[0]['id'];
 }
     
 // existe alguma compra associada ao session_id ??
 $existeCompra = intval (pesquisar(" select count(*) from vendas 
                                    inner join tmpcompra
                                    on vendas.id = tmpcompra.fk_id  //querida marilu nesse aqui onde ta escrito id era id_comrpas so q o id msm sendo fk ele pareceu o correto na hora, eu tentei :´) te amo
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