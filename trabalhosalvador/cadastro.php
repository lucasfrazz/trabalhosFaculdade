<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redirecionar para a página de login
    header("Location: index.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome_produto = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $codigo = $_POST['Codigo'];
    $data_validade = $_POST['data_validade'];
    $preco_produto = $_POST['preco_produto'];
    $quantidade_estoque = $_POST['Quantidade_de_Estoque'];
    $descricao = $_POST['Descrição'];
    $valor_venda = $_POST['valor_venda'];



        $servername = "viaduct.proxy.rlwy.net"; 
        $username = "root";
        $password = "dhrDjfJEDEVGJBxojvEqjPmDxihrHoEz"; 
        $dbname = "railway";
        $port = "56902"; 
        
        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname, $port);
        
        // Verifica a conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "";
        
    
    // Verifica se já existe um produto com o mesmo código
    $sql_verificar = "SELECT codigo FROM produtos WHERE codigo = '$codigo'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        echo "<script>alert('Já existe um produto com o mesmo código.'); window.location.replace('Cadastroproduto.php');</script>";
    } else {
        // Prepara e executa a query SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO produtos (nome_produto, tipo, codigo, data_validade, preco_produto, quantidade_estoque, valor_venda, descricao)
                VALUES ('$nome_produto', '$tipo', '$codigo', '$data_validade', '$preco_produto', '$quantidade_estoque', '$valor_venda','$descricao')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location.replace('gerenciamento.php');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar produto: " . $conn->error . "'); window.location.replace('Cadastroproduto.php');</script>";
        }
    }

    // Fecha a conexão
    $conn->close();
}
?>



