document.addEventListener("DOMContentLoaded", function() {

    let adm = '';
    if(document.getElementById('adm').value == 1) {
        adm = '<ul>'+
                '<li>'+
                    '<a href="../php/cadastroProdutosTela.php?tela=add" id="cadClient" >Cadastrar</a>'+
                '</li>'+
                '<li>'+
                    '<a href="../php/estoque.php" id="listClient">Estoque</a>'+
                '</li>'+
                '<li>'+
                    '<a href="#" id="listClient" >Relatório</a>'+
                '</li>'+
            '</ul>';
    }
    
    let cabecario = '<!DOCTYPE html>'+
    '<html lang="pt-br">'+
    '<head>'+
        '<link rel="stylesheet" href="../css/styleBarra.css">'+
        '<script type="text/javascript" src="script.js"></script>'+
    '</head>'+
    '<body>'+
            '<div class="barra">'+
                '<header>'+
                    '<div class="barraNavegacao">'+
                        '<a href="../php/home.php"> <img src="../img/fixos/logoBarra.png" alt="" id="logo"></a>'+
                        '<div class="barraPesquisa">'+
                            '<input placeholder="Procurar..." />'+
                            '<button>'+
                                'PESQUISAR'+
                            '</button>'+
                        '</div>'+
                        '<nav>' +
                            '<li> <a href="home.php"> HOME </a> </li>'+
                            '<li> <a href="../html/sobreNos.html"> SOBRE </a> </li>'+
                            '<li>'+
                                '<a href="produtos.php" id="client" class="button">PRODUTOS</a>'+
                                adm +
                            '</li>'+
                            '<li> <a href="#"> CONTATO </a> </li>'+
                        '</nav>'+
                        '<div class="imagensBarra">'+
                            '<a href="../php/carrinho.php"> <img src="../img/fixos/carrinho.svg" alt=""> </a>'+
                            '<a href="../php/login/login.php"> <img src="../img/fixos/perfil.svg" alt=""> </a>'+
                            '<a href="../php/login/logout.php"> <img src="../img/fixos/sair.svg" alt="" id="sair"> </a>'+
                        '</div>'+
                    '</div>'+
                '</header>'+
            '</div>'+
    '</body>'+
    '</hmtl>';

    let rodape = '<div class="rodape">'+
    '<footer class="footerMain container">'+
        '<div class="footerConteudo">'+
            '<div class="footerColuna">'+
                '<h3 class="tituloFooter"> Menu </h3>'+
                '<ul>'+
                    '<li><a href="#" title="Página Inícial">Página Inícial</a></li>'+
                    '<li><a href="#" title="Sobre a Empresa">Sobre a Empresa</a></li>'+
                    '<li><a href="#" title="Galeria de Fotos">Produtos</a></li>'+
                    '<li><a href="#" title="Fale Conosco">Contato</a></li>'+
                    '<li><a href="#" title="Ofertas">Ofertas</a></li>'+
                '</ul>'+
            '</div>'+
            '<div class="footerColuna">'+
                '<h3 class="tituloFooter">Produtos</h3>'+
                '<ul>'+
                    '<li><a href="#" title="Todos">Todos</a></li>'+
                    '<li><a href="#" title="Jogos">Jogos</a></li>'+
                    '<li><a href="#" title="Filmes">Filmes</a></li>'+
                    '<li><a href="#" title="Animes">Animes</a></li>'+
                    '<li><a href="#" title="Times">Times</a></li>'+
                    '<li><a href="#" title="Tecnologia">Tecnologia</a></li>'+
                '</ul>'+
           '</div>'+
           ' <div class="footerColuna">'+                 
                '<h3 class="tituloFooter"> Contato</h3>'+
                '<p> a+adesivos@gmail.com </p>'+
                '<p> 14 90000-0000</p>'+
               ' <p> 14 90000-0000</p>'+       
            '</div>'+
            '<div class="clear"></div>'+
            '<div class="footerDireitos">'+
                '<p class="m-b-footer"> www.a+adesivos.com.br - 2023, todos os direitos reservados. &copy;</p>'+
                '<p class="by"> Desenvolvido por: Luisa Prado|Mariana Godoi|Miguel Bodo|Murillo Robles|Witor Santos. </p>'+
            '</div>' +
        '</div>' +
    '</footer>'+
'</div>';
    document.getElementById('barra').innerHTML = cabecario
    document.getElementById('footer').innerHTML = rodape
});
