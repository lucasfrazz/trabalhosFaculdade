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
        <img src="logo.jpeg" alt="Logo" width="300px">
   
        <form id="cadastroForm" action="cadastro.php" method="post">

            <h1>Cadastrar Produto</h1>

            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Produto" required><br>

            <label for="tipo"><strong>Tipo:</strong></label>
            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo de Produto" required><br>

            <label for="Codigo"><strong>Código:</strong></label>
            <input type="number" class="form-control" id="Codigo" name="Codigo" placeholder="Código do Produto" required><br>

            <label for="data_validade"><strong>Validade:</strong></label>
            <input type="date" class="form-control" id="data_validade" name="data_validade" placeholder="Validade do Produto" required><br>

            <label for="preco_produto"><strong>Valor de Compra (R$):</strong></label>
            <input type="text" class="form-control" id="preco_produto" name="preco_produto" placeholder="Valor de Compra " required><br>

            <label for="valor_venda"><strong>Valor de Venda (R$):</strong></label>
            <input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor de Venda " required><br>

            <label for="quantidade"><strong>Quantidade:</strong></label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade no Estoque" required><br>

            <label for="descricao"><strong>Descrição:</strong></label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto (OPCIONAL)"><br>

            <input type="submit" id="butao" class="btn btn-primary" value="Salvar Produto">

            <p><a href="javascript:history.go(-1)">Voltar</a></p>

        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#cadastroForm').submit(function(e) {
       
        var precoCompra = $('#preco_produto').val();
        var precoVenda = $('#valor_venda').val();

        
        if (!isValidNumber(precoCompra) || !isValidNumber(precoVenda)) {
            alert('Por favor, insira valores numéricos válidos nos campos de preço.');
            e.preventDefault();
        }
    });

    // Função para validar números com vírgula
    function isValidNumber(value) {
        return /^-?\d{1,3}(?:\.?\d{3})*(?:,\d{1,2})?$/.test(value);
    }
});
</script>

</body>

</html>
