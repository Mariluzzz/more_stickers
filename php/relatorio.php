<?php
// mostra erros do php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("util.php");
include("conexao/conexao.php");

// calcula hoje
$hoje = date('Y-m-d');
// calcula ontem
$ontem = date('Y-m-d', (strtotime('-1 day', strtotime($hoje))));

echo "<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Carrinho</title>

<link rel='stylesheet' href='../css/relatorio.css'>
<link rel='stylesheet' href='../css/styleBarra.css'>
<script type='text/javascript' src='../js/script.js'></script>
</head>
<body>
<div id='barra'></div>
  <div class='container'>
    <div class='titulo'>
      <h1>Relatório</h1>
    </div>
    <form action='' method='POST' class='forms'>
      Data inicial<br><input type='date' name='datai' value='$ontem' class='info'><br>
      Data final<br><input type='date' name='dataf' value='$ontem' class='info'><br>
      <input type='radio' name='format' value='html'> Mostrar HTML
      <input type='radio' name='format' value='pdf'> Gerar PDF
      <br>
      <input type='checkbox' name='preview'> Pré-visualizar PDF
      <br>
      <input type='submit' value='Gerar' class='button'>
    </form>
  </div>
  <!-- BOTÕES CARRINHO/VOLTAR AO TOPO -->
  <div class='botoes'>
      <div class='botaoCarrinho'>
      <a href='carrinho.php'> <img src='../img/fixos/carrinhoOriginal.svg'> </a>
      </div>
      <div class='voltaTopo'>
          <a href='#'> <img src='../img/fixos/voltaTopo.svg'> </a>
      </div>
      <div class='botaoHome'>
          <a href='home.php'> <img src='../img/fixos/homeOriginal.svg'> </a>
      </div>
  </div>
  <div id='footer'></div>
</body>";

if ($_POST) {
    // faz conexao
    $conn = conecta();

    $datai = $_POST['datai'];
    $dataf = $_POST['dataf'];
    $outputFormat = isset($_POST['format']) ? $_POST['format'] : 'html';
    $previewPDF = isset($_POST['preview']);

    $SQLCompra = "select compra.id, compra.dt_compra, usuarios.nome_usuario, 
                  sum ( produtos.preco::double precision * compra_produto.quantidade ) as total  
                from compra 
                  inner join usuarios on compra.clienteid = usuarios.id
                  inner join compra_produto on compra_produto.idcompra = compra.id
                  inner join produtos on produtos.id = compra_produto.idproduto
                where 
                  compra.dt_compra >= :datai and compra.dt_compra <= :dataf and 
                  compra.status = 'Finalizado'  
                group by 
                  compra.id, compra.dt_compra, usuarios.nome_usuario 
                order by compra.dt_compra";

    $SQLItensCompra = "select produtos.descricao, compra_produto.quantidade, produtos.preco, 
                  produtos.preco::double precision * compra_produto.quantidade as subtotal 
                from compra_produto  
                  inner join produtos on produtos.id = compra_produto.idproduto
                where 
                  compra_produto.idcompra = :idcompra   
                order by produtos.descricao "; 

    /*   m o d e l o
    Cod  Data        Cliente               $ Total
      1  20/10/2023  JOAO DA SILVA        10000,00
        Produto      Qt   Unit        Sub
        CHAVEIRO      2   50,00    100,00
        BOTOM         1   10,00     10,00
    */

    // formata valores em reais
    setlocale(LC_ALL, 'pt_BR.utf-8',);

    $html = "<html>";

    // abre a consulta de COMPRA do periodo
    $compra = $conn->prepare($SQLCompra);
    $compra->execute(['datai' => $datai, 'dataf' => $dataf]);
    // prepara os ITENS
    $itens_compra = $conn->prepare($SQLItensCompra);

    // fetch significa carregar proxima linha
    // qdo nao tiver mais nenhuma retorna FALSE pro while

    /////////////  M E S T R E //////////////////// carrega a proxima linha COMPRA
    $html .= "<br><br>
              <b>" .
        sprintf('%3s', 'Id') .
        sprintf('%12s', 'Data') .
        sprintf('%50s', 'Nome') .
        sprintf('%10s', '$ tot') .
        "</b>
              <br>";

    while ($linha_compra = $compra->fetch()) {
        $cod_compra = sprintf('%03s', $linha_compra['cod_compra']);
        $data = sprintf('%12s', $linha_compra['data']);
        $cliente = sprintf('%50s', $linha_compra['usuario']);
        $total = sprintf('%10s', number_format($linha_compra['total'], 2, ',', '.'));

        $html .= $cod_compra . $data . $cliente . $total . "<br>";

        // executa ITENS passando o codigo da COMPRA atual
        $itens_compra->execute(['cod_compra' => $linha_compra['cod_compra']]);

        $html .= "<b>" .
            sprintf('%20s', 'Prod') .
            sprintf('%5s', 'Qtd') .
            sprintf('%10s', '$ unit') .
            sprintf('%10s', '$ sub') .
            "</b><br>";

        /////////////  D E T A L H E  ////////////////////
        // carrega a proxima linha ITENS_COMPRA
        while ($linha_itens_compra = $itens_compra->fetch()) {
            $produto = sprintf('%20s', $linha_itens_compra['descricao']);
            $qtd = sprintf('%5s', $linha_itens_compra['quantidade']);
            $unit = sprintf('%10s', number_format($linha_itens_compra['preco'], 2, ',', '.'));
            $subtotal = sprintf('%10s', number_format($linha_itens_compra['subtotal'], 2, ',', '.'));

            $html .= $produto . $qtd . $unit . $subtotal . "<br>";
        }
    }

    $html .= "</html>";

    if ($outputFormat === 'pdf') {
        if (CriaPDF('Relatorio de Vendas', $html, 'relatorios/relatorio.pdf')) {
            echo 'Gerado com sucesso';
        }

        if ($previewPDF && file_exists('relatorios/relatorio.pdf')) {
            header('Location: relatorios/relatorio.pdf');
            exit;
        }
    } else {
        echo $html;
    }

    echo "<br><a href='home.php' class='link'>Home</a>";
}
?>
