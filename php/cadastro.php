<?php

require_once 'classes/conexao.php';

$con = new Conexao();
try {
    
    $infos = [
        'nome' => $_POST['username'],
        'nome_usuario' => $_POST['username'],
        'email' => $_POST['email'],
        'data_nasc' => $_POST['data_nasc'],
        'senha' => $_POST['password']
    ];
    
    $result = $con->inserir('usuarios', $infos);
    if (!$result) {
       throw new Exception("Erro ao inserir usuário");
    }
} catch (\Throwable $th) {
    ?>
    <script>
        alert("<?php echo $th->getMessage();?>");
    </script>
    <?php
}
?>