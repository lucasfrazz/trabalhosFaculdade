<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados (substitua as credenciais e o nome do banco de dados conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "estoque_produtos";

    // Criar uma conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Limpar e validar os dados do formulário
    $username = clean_input($_POST['nome']);
    $password = password_hash(clean_input($_POST['senha']), PASSWORD_DEFAULT); // Hash da senha

    // Preparar a consulta SQL para inserir o usuário no banco de dados
    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página de login após o cadastro
        header("Location: logiin.php");
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
