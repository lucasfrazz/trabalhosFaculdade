<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: logiin.php");
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome_produto = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $codigo = $_POST['Codigo'];
    $data_validade = $_POST['data_validade'];
    $preco_produto = isset($_POST['Preço_de_compra']) ? $_POST['Preço_de_compra'] : null; // Verifica se o campo foi enviado
    $quantidade_estoque = $_POST['Quantidade_de_Estoque'];
    $descricao = $_POST['Descrição'];
    $valor_venda = $_POST['valor_venda'];

    // Conexão com o banco de dados 
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "estoque_produtos";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se já existe um produto com o mesmo código
    $sql_verificar = "SELECT codigo FROM produtos WHERE codigo = '$codigo'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        echo " Já existe um produto com o mesmo código.";
    } else {
        // Prepara e executa a query SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO produtos (nome_produto, tipo, codigo, data_validade, preco_produto, quantidade_estoque, valor_venda, descricao)
                VALUES ('$nome_produto', '$tipo', '$codigo', '$data_validade', '$preco_produto', '$quantidade_estoque', '$valor_venda','$descricao')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Produto cadastrado com sucesso!'); window.location.replace('index.php');</script>";
        } else {
            echo "Erro ao cadastrar produto: " . $conn->error;
        }
    }

    // Fecha a conexão
    $conn->close();
}
?>

?>
