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
    <link rel="stylesheet" href="editarproduto.css">
   <link rel="shortcut icon" href="/img/logo.jpeg" type="image/x-icon">
    <title>Editar Produto</title>
</head>
<body>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $produto_id = $_GET['id'];

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
        

        // Consultar o produto pelo id
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se o produto foi encontrado
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <div class="container">
        
    <div class="text-center my-4">
    <img src="logo.jpeg" alt="Logo" width="300px">
</div>
    <form action="atualizar_produto.php" method="POST">

        <h1>Editar Produto</h1>

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="nome"><strong>Nome do Produto:</strong></label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome_produto']; ?>" required><br>

        <label for="tipo"><strong>Tipo:</strong></label>
        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $row['tipo']; ?>" required><br>

        <label for="codigo"><strong>Código:</strong></label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $row['codigo']; ?>" required><br>

        <label for="data_validade"><strong>Data de Validade:</strong></label>
        <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?php echo $row['data_validade']; ?>" required><br>

        <label for="preco_produto"><strong>Valor de Compra (R$):</strong></label>
        <input type="text" class="form-control" id="preco_produto" name="preco_produto" value="<?php echo number_format($row['preco_produto'], 2, ',', '.'); ?>" required><br>

        <label for="valor_venda"><strong>Valor de Venda (R$):</strong></label>
        <input type="text" class="form-control" id="valor_venda" name="valor_venda" value="<?php echo number_format($row['valor_venda'], 2, ',', '.'); ?>" required><br>


        <label for="quantidade_estoque"><strong>Quantidade em Estoque:</strong></label>
        <input type="text" class="form-control" id="quantidade_estoque" name="quantidade_estoque" value="<?php echo $row['quantidade_estoque']; ?>" required><br>

        <label for="descricao"><strong>Descrição:</strong></label>
        <textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo $row['descricao']; ?></textarea><br>

        <input type="submit" id="butao" value="Salvar Alterações">

        <p><a href="javascript:history.go(-1)">Voltar</a></p>
    </form>
    <?php
        } else {
            echo "<p>Produto não encontrado.</p>";
        }

        // Fechar conexão
        $conn->close();
    } else {
        echo "<p>Produto não especificado.</p>";
    }
    
    ?>
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
