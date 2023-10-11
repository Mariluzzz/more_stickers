<?php
// Configuração para exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../php/classes/conexao.php';

$conn = new Conexao();

$infos = ['nome' => 'luisa_teste',
          'nome_usuario' => 'lululu',
          'documento' => '25569693656',
          'tipo_pessoa' => 'F',
          'data_nasc' => '2023-09-25',
          'sexo' => 'F',
          'email' => 'teste@gmail.com',
          'senha' => '12340',
          'telefone' => '14997145613'];

$result = $conn->inserir('usuarios', $infos);
if($result) {
    echo "isso ai";
} 

$result = $conn->pesquisar("usuarios", "WHERE nome = 'marilu'");
echo $result[0]['nome'];
echo $result[0]['nome_usuario'];
echo $result[0]['senha'];

?>