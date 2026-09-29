<?php

session_start();

require_once "../Config/conexao.php";

if (!isset($_SESSION["id_usuario"])) {

    header("Location: ../index.php");
    exit;

}

$idUsuario = $_SESSION["id_usuario"];

$sql = "SELECT produto.id, produto.nome, produto.descricao, produto.preco
        FROM carrinho, item_carrinho, produto
        WHERE carrinho.id = item_carrinho.id_carrinho
        AND item_carrinho.id_produto = produto.id
        AND carrinho.id_usuario = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $idUsuario
]);

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Carrinho - Supermercado Amizade</title>

</head>

<body>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Meu Carrinho</h2>

            <a href="catalogo.php" class="btn btn-secondary">
                Voltar para o catálogo
            </a>

        </div>

        <?php if (count($produtos) == 0) { ?>

            <div class="alert alert-info">
                Seu carrinho está vazio.
            </div>

        <?php } else { ?>

            <div class="row">

                <?php foreach ($produtos as $produto) { ?>

                    <?php $total = $total + $produto["preco"]; ?>

                    <div class="col-md-4 mb-4">

                        <div class="card h-100 shadow-sm">

                            <div class="card-body">

                                <h5 class="card-title">
                                    <?php echo $produto["nome"]; ?>
                                </h5>

                                <p class="card-text">
                                    <?php echo $produto["descricao"]; ?>
                                </p>

                                <p>
                                    <strong>Preço:</strong>
                                    R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?>
                                </p>

                                <p>
                                    <strong>Quantidade:</strong>
                                    1
                                </p>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

            <div class="card mt-3">

                <div class="card-body">

                    <h5>
                        Total de produtos:
                        <?php echo count($produtos); ?>
                    </h5>

                    <h4>
                        Total:
                        R$ <?php echo number_format($total, 2, ",", "."); ?>
                    </h4>

                </div>

            </div>

        <?php } ?>

    </div>

</body>

</html>