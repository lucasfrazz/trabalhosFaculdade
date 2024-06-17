<?php

// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redirecionar para a página de login
    header("Location: index.php");
    exit();
}

// Verificar se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    // Obter os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $codigo = $_POST['codigo'];
    $data_validade = $_POST['data_validade'];
    $preco_produto = str_replace(',', '.', $_POST['preco_produto']); // Converte vírgula para ponto
    $valor_venda = str_replace(',', '.', $_POST['valor_venda']); // Converte vírgula para ponto
    $quantidade_estoque = $_POST['quantidade_estoque'];
    $descricao = $_POST['descricao'];

    // Atualizar o produto no banco de dados usando consulta preparada
    $sql = "UPDATE produtos SET 
            nome_produto = ?, 
            tipo = ?, 
            codigo = ?, 
            data_validade = ?, 
            preco_produto = ?, 
            valor_venda = ?, 
            quantidade_estoque = ?, 
            descricao = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssdssi", $nome, $tipo, $codigo, $data_validade, $preco_produto, $valor_venda, $quantidade_estoque, $descricao, $id);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Produto atualizado com sucesso.'); window.location.replace('gerenciamento.php');</script>";
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }

    // Fechar conexão
    $stmt->close();
    $conn->close();
}
?>
