<?php

include 'conexao/conexao.php';

try {
    $infos = [
        'nome' => $_POST['username'],
        'nome_usuario' => $_POST['username'],
        'email' => $_POST['email'],
        'data_nasc' => $_POST['data_nasc'],
        'senha' => $_POST['password']
    ];
    
    $result = inserir('usuarios', $infos);
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
	//header('Location: login/login.php');
?>
	<script>
    setTimeout(function() { alert("Cadastro concluído com sucesso!");
    window.location.href = "login/login.php"; }, 0);
    </script>
