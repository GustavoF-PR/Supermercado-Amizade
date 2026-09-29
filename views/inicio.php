<?php

session_start();

if (!isset($_SESSION["id_usuario"])) {

    header("Location: ../index.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Início - Supermercado Amizade</title>

</head>

<body>

    <div class="container py-5">

        <div class="text-center mb-5">

            <h2>Supermercado Amizade</h2>

            <p>
                Olá, <?php echo $_SESSION["nome_usuario"]; ?>!
            </p>

            <p>
                Escolha uma opção:
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h4>Cadastrar Fornecedor</h4>

                        <p>
                            Cadastre um novo fornecedor.
                        </p>

                        <a href="fornecedor.php" class="btn btn-primary">
                            Cadastrar Fornecedor
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h4>Cadastrar Produto</h4>

                        <p>
                            Cadastre um novo produto.
                        </p>

                        <a href="produtos.php" class="btn btn-primary">
                            Cadastrar Produto
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h4>Catálogo</h4>

                        <p>
                            Veja os produtos disponíveis.
                        </p>

                        <a href="catalogo.php" class="btn btn-success">
                            Ver Catálogo
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body text-center">

                        <h4>Carrinho</h4>

                        <p>
                            Veja os produtos selecionados.
                        </p>

                        <a href="carrinho.php" class="btn btn-warning">
                            Ver Carrinho
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>