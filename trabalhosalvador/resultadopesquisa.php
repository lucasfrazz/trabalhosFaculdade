<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Se não estiver logado, redirecionar para a página de login
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="/img/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="Resultado.css">
</head>
<body>
<div class="container">
        
        <div class="text-center my-4">
        <img src="logo.jpeg" alt="Logo" width="300px">
    </div>
    <h1>Resultado da Pesquisa</h1>
        <?php
        
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
    
    // Obter o nome do produto da pesquisa
    $produto_nome = isset($_GET['produto']) ? $_GET['produto'] : '';

    // Consultar produtos pelo nome completo
    if (!empty($produto_nome)) {
        $stmt = $conn->prepare("SELECT * FROM produtos WHERE nome_produto = ?");
        $stmt->bind_param("s", $produto_nome);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='product-list'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>";
                echo "<div class='product-info'>";
                echo "<h2>" . htmlspecialchars($row['nome_produto']) . "</h2>";
                echo "<p><strong>Tipo:</strong> " . htmlspecialchars($row['tipo']) . "</p>";
                echo "<p><strong>Código:</strong> " . htmlspecialchars($row['codigo']) . "</p>";
                echo "<p><strong>Data de Validade:</strong> " . htmlspecialchars($row['data_validade']) . "</p>";
                echo "<p><strong>Valor de Compra:</strong> R$ " . number_format($row['preco_produto'], 2, ',', '.') . "</p>";
                echo "<p><strong>Valor de Venda:</strong> R$ " . number_format($row['valor_venda'], 2, ',', '.') . "</p>";
                echo "<p><strong>Quantidade em Estoque:</strong> " . htmlspecialchars($row['quantidade_estoque']) . "</p>";
                echo "<p><strong>Descrição:</strong> " . htmlspecialchars($row['descricao']) . "</p>";
                echo "</div>"; 
                echo "</div>"; 
            }
            echo "</div>"; 
        } else {
            echo "<div class='alert alert-warning'>Nenhum produto encontrado com o nome \"$produto_nome\".</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-warning'>Nome do produto não fornecido.</div>";
    }

    // Fechar conexão
    $conn->close();
    ?>
    </div>
    <p><a href="pesquisa.php">Voltar</a></p>
    <script>
    // Função para destruir a sessão quando a página é fechada
    $(window).on('beforeunload', function() {
        $.ajax({
            url: 'logout.php',
            type: 'POST',
            async: false,
            success: function(response) {
                console.log('Sessão destruída');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao destruir a sessão:', error);
            }
        });
    });
</script>
</body>
</html>
