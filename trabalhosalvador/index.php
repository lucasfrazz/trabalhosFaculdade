<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Se não estiver logado, redirecionar para a página de login
    $error_message = "Você precisa estar logado para acessar esta página.";
    header("Location: logiin.php");
    exit();
} else {
    // Exibir mensagem de erro se as credenciais estiverem incorretas
    $error_message = "Usuário ou senha incorretos.";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="gerenciamento.css">
    <title>CadasPro</title>
 
</head>
<body>


    <div class="container">
    <div class="corner">
        <?php
    

        // Verificar se o usuário está logado
        if(isset($_SESSION['username'])) {
            echo '<span style="color: white;">Usuário logado: ' . $_SESSION['username'] . '</span>';
        }
        ?>
        <button class="logout-button" onclick="window.location.href='logout.php'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16" alt="Logout">
                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>
        </button>
    </div>
        <h1>Bem-vindo ao CodProduto</h1>
        <p id="apresentacao">Este é o sistema CodProduto, onde você pode cadastrar e gerenciar produtos.</p>
    </div>

   

    <main>

        <h1>Gerenciamento</h1>

        <p><a href='Cadastroproduto.html'><button>Cadastrar Produto</button></a></p>
        <p><a href='pesquisa.html'><button>Pesquisar Produto</button></a></p>
        <p><a href='#'><button>Alterar Produto</button></a></p>
        
    </main>
    </style>
</body>
</html>
