<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Conexao 
{
    private $conn;

    public function  __construct() {
        try {
            $this->conn = new PDO('pgsql:host=pgsql.projetoscti.com.br;dbname=projetoscti31', 'projetoscti31', '722317');
            // echo "Conex�o bem-sucedida!";
        } catch (PDOException $e) {
            echo "Erro na conex�o: " . $e->getMessage();
        }
    } 

    // Ex:
    // $tabela = 'nome da tabela';
    // $condicao = 'Where id= 56';

    public function pesquisar($tabela, $condicao = '') {
        $stmt = $this->conn->prepare("SELECT * FROM $tabela $condicao");
        $stmt->execute();
        $i = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (empty($result) || $result === false) {
                return false;
            }
            $resultsArray[$i] = $result;
            $i ++;
        }

        return $resultsArray;
    }


    // Ex:
    // $tabela = 'nome da tabela';
    // $insert = ['nome do campo' => 'valor a ser inserido'];

    public function inserir($tabela, $insert) {
        $colunas = implode(',', array_keys($insert));
        $valores = ':' . implode(',:', array_keys($insert));
        $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($insert);
        if (!$stmt) {
            return false;
        }
        return true;
    }

    // Ex:
    // $tabela = 'nome da tabela';
    // $condicao = 'id = 4';

    public function excluir($tabela, $condicao) {
        $sql = "DELETE FROM $tabela WHERE $condicao";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if (!$stmt) {
            return false;
        }

        return true;;
    }

    // Ex: 
    // $campos = ['nome', 'descricao', 'preco', 'categoria', 'criacao'];
    // $valores = ['mariuzz', 'mariluzzzinha', 900, 1, date("Y-m-d H:i:s")];
    // $condicao = 'id = 2';

    public function alterar($tabela, $campos, $valores, $condicao) {
        $set = '';
        foreach ($campos as $campo) {
            $set .= "$campo = ?, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE $tabela SET $set WHERE $condicao";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($valores);
        $linhasAlteradas = $stmt->rowCount();
        if ($linhasAlteradas < 1) {
            return false;
        } 
        return true;
    }
    
}
?>