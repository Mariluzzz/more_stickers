<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class conexao 
{
    public $conn;

    public function  __construct() {
        try {
            $this->conn = new PDO('pgsql:host=pgsql.projetoscti.com.br; dbname=projetoscti31; user=projetoscti31; password=722317');
            if (empty($this->conn) || $this->conn === false) {
                throw new Exception("Erro ao conectar ao banco de dados");
            }
        } catch (Exception $e) {
            var_dump("ERRO", $e);
            return [
                'error' => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }    

    public function pesquisar($tabela, $condicao = '') {
        try {
            $sql = "SELECT * FROM $tabela $condicao";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            if (empty($result) || $result === false) {
                throw new Exception("Erro ao pesquisar em $tabela");
            }
            return $result;
        } catch (Exception $e) {
            return [
                'error' => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }

    public function inserir($tabela, $insert) {
        try {
            $colunas = implode(',', array_keys($insert));
            $valores = ':' . implode(',:', array_keys($insert));
            $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($insert);
            if (!$stmt) {
                throw new Exception("Erro ao inserir em $tabela");
            }
            return true;
        } catch (Exception $e) {
            return [
                'error' => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }

    public function excluir($tabela, $condicao) {
        try {
            $sql = "DELETE FROM $tabela WHERE $condicao";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if (!$stmt) {
                throw new Exception("Erro ao deletar em $tabela");
            }

            return true;
        } catch (Exception $e) {
            return [
                'error' => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }

    public function alterar($tabela, $campos, $condicao) {
        try {
            $sql = "UPDATE $tabela SET $campos WHERE $condicao";  
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $retorno = $stmt->fetch();
            if (empty($retorno) || $retorno === false) {
                throw new Exception("Erro ao atualizar em $tabela");
            }

            return $retorno;
        } catch (Exception $e) {
            return [
                'error' => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }
}
?>