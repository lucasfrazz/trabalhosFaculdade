<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redirecionar para a página de login
    header("Location: index.php");
    exit();
}

// Verificar se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar se há produtos selecionados para exclusão
    if(isset($_POST['produtos']) && !empty($_POST['produtos'])) {

        // Conexão com o banco de dados
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
        

        // Preparar e executar a exclusão de cada produto selecionado
        foreach($_POST['produtos'] as $produto_id) {
            $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
            $stmt->bind_param("i", $produto_id);
            $stmt->execute();
        }

        // Fechar a declaração e a conexão
        $stmt->close();
        $conn->close();

        // Redirecionar de volta à página de gerenciamento ou exibir uma mensagem de sucesso
        header("Location: gerenciamento.php");
        exit();
    } else {
        echo "<script>alert('Nenhum produto selecionado para exclusão.'); window.location.href = 'gerenciamento.php';</script>";
    }
} else {
    echo "<script>alert('Requisição inválida.'); window.location.href = 'gerenciamento.php';</script>";
}
?>
