

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cadastroLogin.css">
    <link rel="shortcut icon" href="/img/logo.jpeg" type="image/x-icon">
    <title>CadasPro</title>
    <style>
     
     
    </style>
</head>
<body>
<div class="container">
        
        <div class="text-left my-4">
        <img src="logo.jpeg" alt="Logo" width="300px">
    </div>

    <div class="form-container">
        <form method="GET" action="resultadopesquisa.php">
            <h1>Pesquisa de Produto</h1>

            <div class="mb-3">
                <label for="produto" class="form-label"><strong>Nome do Produto:</strong></label>
                <input type="text" class="form-control" id="produto" name="produto" placeholder="Digite o nome do produto" required>
            </div>

            <div class="text-center">
                <input type="submit" id="butao" class="btn btn-primary" value="Pesquisar">
            </div>

            <p class="text-center mt-3"><a href="gerenciamento.php">Voltar</a></p>
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
