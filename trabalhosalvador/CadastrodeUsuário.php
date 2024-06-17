


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
</head>
<body>
    
    <div><img src="/img/logo.jpeg" alt="" width="300px"></div>   

    <form id="cadastroForm" action="cadastrousuario.php" method="post">

        <h1>Área de Cadastro</h1>
    
        <label for="nome"><strong>Login:</strong> </label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Crie seu nome de login" required><br>
    
        <label for="senha"><strong>Senha:</strong> </label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie sua senha de acesso" required><br>
    
        <input type="submit" id="butao" value="Cadastrar">
    
        <p> <strong>Já possui uma conta?</strong> <a href="index.php">Faça login</a></p>
        
    </form>
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