<?php
// Iniciar a sessão
session_start();

// Definir uma variável para armazenar mensagens de erro
$error = '';

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados (substitua essas informações com as suas)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "estoque_produtos";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Escape special characters to avoid SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Verificar se o resultado da consulta possui pelo menos uma linha
    if ($result->num_rows > 0) {
        // As credenciais estão corretas, então iniciar a sessão
        $_SESSION['username'] = $username;
        // Redirecionar para a página principal
        header("Location: index.php");
        exit();
    } else {
        // As credenciais estão incorretas, definir mensagem de erro
        $error = '<span style="color: white;">Usuário ou senha incorretos. Por favor, tente novamente.</span>';
    }
    

    // Fechar conexão
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>CadasPro</title>
</head>
<body>
    

<form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <h1>Area de acesso</h1>
        <?php if(isset($error_message)) echo '<p style="color: red;">'.$error_message.'</p>'; ?>
        <label for=""><strong>Login:</strong> </label>
        <input type="text" class="form-control" name="username" placeholder="Login de acesso" required><br>

        <label for=""><strong>Senha:</strong> </label>
        <input type="password" class="form-control" name="password" placeholder="Senha de acesso" required><br>

        <input type="submit" id="butao" value="Entrar">

        <?php if (!empty($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
        <p><a href="cadastroLogin.html">Não tenho cadastro ainda </a></p>
        
    </form>

    
</body>
</html>
    