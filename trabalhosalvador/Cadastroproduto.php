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
    <link rel="shortcut icon" href="logo.jpeg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="cadastroProduto.css">
    <title>CadasPro - Cadastrar Produto</title>
</head>

<body>
<div class="container">
        
        <div class="text-center my-4">
        <img src="fundo.jpeg" alt="Logo" width="300px">
   
        <form id="cadastroForm" action="cadastro.php" method="post">

            <h1>Cadastrar Produto</h1>

            <label for=""><strong>Nome:</strong></label>
            <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" required><br>

            <label for=""><strong>Tipo:</strong></label>
            <input type="text" class="form-control" name="tipo" placeholder="Tipo de Produto" required><br>

            <label for=""><strong>Código:</strong></label>
            <input type="number" class="form-control" name="Codigo" placeholder="Código do Produto" required><br>

            <label for=""><strong>Validade:</strong></label>
            <input type="date" class="form-control" name="data_validade" placeholder="Validade do Produto" required><br>

            <label for=""><strong>Valor de Compra:</strong></label>
            <input type="number" class="form-control" name="preco_produto" placeholder="Valor de Compra" required><br>

            <label for=""><strong>Valor de Venda:</strong></label>
            <input type="number" class="form-control" name="valor_venda" placeholder="Valor de Venda" required><br>

            <label for=""><strong>Quantidade:</strong></label>
            <input type="number" class="form-control" name="Quantidade de Estoque" placeholder="Quantidade no Estoque" required><br>

            <label for=""><strong>Descrição:</strong></label>
            <input type="text" class="form-control" name="Descrição" placeholder="Descrição do Produto (OPCIONAL)"><br>

            <input type="submit" id="butao" class="btn btn-primary" value="Salvar Produto">

            <p><a href="javascript:history.go(-1)">Voltar</a></p>

        </form>

    </div>
    </div>
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
