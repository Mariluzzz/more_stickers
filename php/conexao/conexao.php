<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function conecta ($params = "") {
    if ($params == "") {
        $params="pgsql:host=pgsql.projetoscti.com.br;dbname=projetoscti31;user=projetoscti31;password=722317";
    }

    $conn = new PDO($params);

    if (!$conn) {
        throw new Exception("Nao foi possivel conectar");
    } else { 
        return $conn; 
    }
}

function funcaoLogin ($params, &$admin) {
    $admin = false;
    $verificaUsuario = pesquisar("usuarios", "where nome_usuario = '{$params['usuario']}' and senha = '{$params['senha']}'");  
    if (empty($verificaUsuario)) {
        return false;
    }

    if ($verificaUsuario[0]['admin']) {
        $admin = true;
    }
    
    return true;
}

function DefineCookie($nomeCookie, $nomeUser, $temp) 
{
    setcookie($nomeCookie, $nomeUser, time() + $temp * 60); 
}

function pesquisar($tabela, $condicao = '') {
    $conn = conecta();
    $stmt = $conn->prepare("SELECT * FROM $tabela $condicao");
    $stmt->execute();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $resultsArray[$i] = $result;
        $i ++;
    }

    $resultsArray = !empty($resultsArray) ? $resultsArray : [];
    return $resultsArray;
}

function inserir($tabela, $insert) {
    $conn = conecta();
    $colunas = implode(',', array_keys($insert));
    $valores = ':' . implode(',:', array_keys($insert));
    $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($insert);
    if (!$stmt) {
        return false;
    }
    return true;

}

function excluir($tabela, $condicao) {
    $conn = conecta();
    $sql = "DELETE FROM $tabela WHERE $condicao";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if (!$stmt) {
        throw new Exception("Erro ao deletar em $tabela");
    }

    return true;
}

function alterar($tabela, $campos, $valores, $condicao) {
    $conn = conecta();
    $set = '';
    foreach ($campos as $campo) {
        $set .= "$campo = ?, ";
    }
    $set = rtrim($set, ', ');

    $sql = "UPDATE $tabela SET $set WHERE $condicao";
    $stmt = $conn->prepare($sql);
    $stmt->execute($valores);
    $linhasAlteradas = $stmt->rowCount();
    if ($linhasAlteradas < 1) {
        return false;
    } 
    return true;
}

function consulta($sql) {
    $conn = conecta();
    $result = $conn->query($sql);
    $i = 0;
    while ($line = $result->fetch(PDO::FETCH_ASSOC)) {
        $resultsArray[$i] = $line;
        $i ++;
    }

    $resultsArray = !empty($resultsArray) ? $resultsArray : [];
    return $resultsArray;
}
