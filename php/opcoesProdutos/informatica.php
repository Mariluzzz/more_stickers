<?php
     // mostra erros do php
   ini_set ( 'display_errors' , 1); 
   error_reporting (E_ALL);   

   // inicia a sessao
   session_start(); 
   
   //include("util.php");

   echo "<html>";   
   
   // seu css
   echo "<head>
        <title>Produtos | A+</title>
        <!-- LINKS -->
        <link rel='stylesheet' href='../css/produtos.css'>
        <!-- CSS HEADER AND FOOTER -->
        <link rel='stylesheet' type='text/css' href='../css/styleBarra.css'>
        <script></script> 
        </head>";

   echo "<body>";

   //include ('cabecalho.php');

   // faz conexao 
   //$conn = conecta(); 
   
   echo "
   <div class='barra'>
        <header>
            <div class='barraNavegacao'>
                <a href='#'> <img src='../headerAndFooter/imagens/logoBarra.svg' alt=' id='logo'></a>
                <div class='barraPesquisa'>
                    <input placeholder='Procurar...' />
                      <button>
                          PESQUISAR
                      </button>
                  </div>
                <nav> 
                    <li> <a href='../php/index.php'> HOME </a> </li>
                    <li> <a href='#'> SOBRE </a> </li>
                    <li> <a href='../produtos/produtos.html'> PRODUTOS </a> </li>
                    <li> <a href='#'> CONTATO </a> </li>
                </nav>
                <div class='imagensBarra'>
                    <a href=''> <img src='../headerAndFooter/imagens/carrinho.svg' alt='> </a>
                    <a href=''> <img src='../headerAndFooter/imagens/perfil.svg' alt='> </a>
                    <a href=''> <img src='../headerAndFooter/imagens/sair.svg' alt=' id='sair'> </a>
                </div>
            </div>
        </header>
    </div>

    <div class='container'>
            <!-- FILTRO DOS PRODUTOS -->
            <div class='filtro'>
            <div class='quadradoFiltro'>
                <div class='categorias'>
                    <h3> Filtrar por: </h3>
                    <a href='produtos.php'> Todos </a>
                    <a href='animes.php'> Animes </a>
                    <a href='desenhos.php'> Desenhos </a>
                    <a href='filmes.php'> Filmes/Séries </a>
                    <a href='informatica.php'> Informática </a>
                    <a href='jogos.php'> Jogos </a>
                    <a href='times.php'> Times </a>
                </div>
            </div>
        </div>

            <!-- DIVS DOS PRODUTOS -->
            <div class='produtos'>
                <!-- PRODUTO 1 -->
                <div class='card' id='1'>
                    <img class='imagemProduto' src='figs informatica/!false.png' />
                    <h4> !False </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 2 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/accept cookies.png ' />
                    <h4> Accept Cookies </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 3 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/css.png ' />
                    <h4> Logo CSS </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 4 -->
                <div class='card' id='4'>
                    <img class='imagemProduto' src='figs informatica/cursor.png ' />
                    <h4> Cursor </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 5 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/gatinho im a computer hacker.png ' />
                    <h4> Gatinho Hacker </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 6 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/hello computador.png ' />
                    <h4> Hello World Computador </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 7 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/hello world.png ' />
                    <h4> Hello World Frase </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 8 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/html5.png ' />
                    <h4> Logo HTML5 </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 9 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/im not a robot.png ' />
                    <h4> Robô da Informática </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 10 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/java.png ' />
                    <h4> Logo Java </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 11 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/javascript.png ' />
                    <h4> Logo javaScript</h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 12 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/let me think.png ' />
                    <h4> Deixe-me Pensar </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 13 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/linux vader.png ' />
                    <h4> Dark Vader/Linux</h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 14 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/pg adm.png ' />
                    <h4> Logo PgAdmin </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 15 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/php.png ' />
                    <h4> Logo PHP </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 16 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/titanic.png ' />
                    <h4> Titanic </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>

                <!-- PRODUTO 17 -->
                <div class='card'>
                    <img class='imagemProduto' src='figs informatica/visual studios.png ' />
                    <h4> Logo Visual Studio </h4>
                    <div class='valorProduto'>
                        <h5> R$4,00</h5>
                    </div>
                    <a> Adicionar ao Carrinho </a>
                </div>
            </div>
        </div>
    </div>
    <!-- RODAPÉ -->
        <div class='rodape'>
            <footer class='footerMain container'>
                <div class='footerConteudo'>
                    <!-- PRIMEIRA COLUNA -->
                    <div class='footerColuna'>
                    <h3 class='tituloFooter'> Menu </h3>
                    <ul>
                        <li><a href='../php/index.php' title='Página Inícial'>Página Inícial</a></li>
                        <li><a href='#' title='Sobre a Empresa'>Sobre a Empresa</a></li>
                        <li><a href='../produtos/produtos.php' title='Galeria de Fotos'>Produtos</a></li>
                        <li><a href='#' title='Fale Conosco'>Contato</a></li>
                        <li><a href='#' title='Ofertas'>Ofertas</a></li>
                    </ul>
                    </div>
                    <!-- SEGUNDA COLUNA -->
                    <div class='footerColuna'>
                        <h3 class='tituloFooter'>Produtos</h3>
                        <ul>
                            <li><a href='../produtos/produtos.php'>TODOS</a></li>
                            <li><a href='../produtos/animes.php'>ANIMES</a></li>
                            <li><a href='../produtos/desenhos.php'>DESENHOS</a></li>
                            <li><a href='../produtos/filmes.php'>FILMES</a></li>
                            <li><a href='../produtos/jogos.php'>JOGOS</a></li>
                            <li><a href='../produtos/times.php'>TIMES</a></li>
                            <li><a href='../produtos/informatica.php'>TECNOLOGIA</a></li>
                        </ul>
                    </div>
                    <!-- TERCEIRA COLUNA --> 
                    <div class='footerColuna'>                   
                        <h3 class='tituloFooter'> Contato</h3>
                        <p> a+adesivos@gmail.com </p>
                        <p> 14 90000-0000</p>
                        <p> 14 90000-0000</p>           
                    </div>

                    <div class='clear'></div>
                
                    <!-- DIREITOS DO SITE -->
                    <div class='footerDireitos'>
                        <p class='m-b-footer'> www.a+adesivos.com.br - 2023, todos os direitos reservados. &copy;</p> 
                        <p class='by'> Desenvolvido por: <a href='#' title='Seu nome'>Luisa Prado|Mariana Godoi|Miguel Bodo|Murillo Robles|Witor Santos</a></p>
                    </div>
                </div>
            </footer>
        </div>
</body>
</html>";
?>

   