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
  
function pesquisar($tabela, $condicao = '') {
    $conn = conecta();
    $stmt = $conn->prepare("SELECT * FROM $tabela $condicao");
    $stmt->execute();
    $i = 0;
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (empty($result) || $result === false) {
            throw new Exception("Erro ao pesquisar em $tabela");
        }
        $resultsArray[$i] = $result;
        $i ++;
    }

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
        throw new Exception("Erro ao inserir em $tabela");
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

function alterar($tabela, $campos, $condicao) {
    $conn = conecta();
    $sql = "UPDATE $tabela SET $campos WHERE $condicao";  
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $retorno = $stmt->fetch();
    if (empty($retorno) || $retorno === false) {
        throw new Exception("Erro ao atualizar em $tabela");
    }

    return $retorno;
}