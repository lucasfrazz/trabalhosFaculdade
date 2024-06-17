<?php
// Iniciar a sessão
session_start();

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "monorail.proxy.rlwy.net"; 
$username = "root";
$password = "tQvieeKcCRvSJCFhJCuhgvbPMaphwwzx"; 
$dbname = "railway"; 
$port = "25492"; 
    
    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    
    // Verifica a conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "";
    

    // Limpar e validar os dados do formulário
    $email = clean_input($_POST['email']); 
    $username = clean_input($_POST['nome']);
    $password = password_hash(clean_input($_POST['senha']), PASSWORD_DEFAULT);

    // Preparar a consulta SQL para inserir o usuário no banco de dados
    $sql = "INSERT INTO usuarios (email,username, password) VALUES ('$email','$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de login após o cadastro
        header("Location: index.php"); 
        exit();
    } else {
        echo "Erro ao cadastrar o usuário: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

// Função para limpar os dados de entrada
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
