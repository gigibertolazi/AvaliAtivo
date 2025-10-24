<?php
 include_once('conexao.php');
if (!empty($_POST['senha']) && !empty($_POST['email'])) {
   
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            header("Location: paginaprof.php");
            exit;
        } else {
            echo "Não foi possível logar! Email ou senha incorretos.";
        }
    } else {
        echo "Não foi possível logar! Email ou senha incorretos.";
    }
}
?>
