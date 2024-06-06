<!DOCTYPE html>
<html>
<head>
    <title>Resultados da Pesquisa</title>
    <style>
        body {
            background: linear-gradient(135deg, black, orange);
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .result {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            margin-bottom: 10px;
        }

        .result p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
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

        // Escapa caracteres especiais para evitar injeção de SQL
        $produto = $conn->real_escape_string($_GET['produto']);

        // Query para pesquisar produtos
        $sql = "SELECT * FROM produtos WHERE nome_produto LIKE '%$produto%'";

        // Executa a query
        $resultado = $conn->query($sql);

        // Verifica se há resultados
        if ($resultado->num_rows > 0) {
            // Exibe os resultados
            while ($row = $resultado->fetch_assoc()) {
                echo "<div class='result'>
                        <p>Codigo: " . $row['codigo'] . "<br>
                        Nome: " . $row['nome_produto'] . "<br>
                        Descrição: " . $row['descricao'] . "<br>
                        Preço: " . $row['preco_produto'] . "<br>
                        Data de Validade: " . $row['data_validade'] . "<br>
                        Quantidade no Estoque: " . $row['quantidade_estoque'] . "</p>
                      </div>";
            }
            
        } else {
            echo "Nenhum resultado encontrado.";
        }

        // Fecha a conexão
        $conn->close();
        ?>
    </div>
    <button onclick="window.location.href='index.php'">Voltar</button>
</body>
</html>
