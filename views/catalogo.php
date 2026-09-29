<?php

session_start();

require_once "../Config/conexao.php";

if (!isset($_SESSION["id_usuario"])) {

    header("Location: ../index.php");
    exit;

}

$sql = "SELECT produto.id, produto.nome, produto.descricao, produto.preco, fornecedor.nome
        FROM produto, fornecedor
        WHERE produto.id_fornecedor = fornecedor.id";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Catálogo - Supermercado Amizade</title>

</head>

<body>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Catálogo de Produtos</h2>

            <div>

                <a href="inicio.php" class="btn btn-secondary">
                    Início
                </a>

                <a href="carrinho.php" class="btn btn-primary">
                    Carrinho
                </a>

            </div>

        </div>

        <form action="../Ajax/produto.php" method="POST">

            <input type="hidden" name="acao" value="adicionar">

            <div class="row">

                <?php foreach ($produtos as $produto) { ?>

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
                                    <strong>Fornecedor:</strong>
                                    <?php echo $produto["nome"]; ?>
                                </p>

                                <h5>
                                    R$
                                    <?php echo number_format($produto["preco"], 2, ",", "."); ?>
                                </h5>

                                <div class="form-check mt-3">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="produtos[]"
                                        value="<?php echo $produto["id"]; ?>"
                                        id="produto<?php echo $produto["id"]; ?>"
                                    >

                                    <label
                                        class="form-check-label"
                                        for="produto<?php echo $produto["id"]; ?>"
                                    >
                                        Selecionar produto
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

            <div class="text-center mt-3">

                <button type="submit" class="btn btn-success">
                    Adicionar ao carrinho
                </button>

            </div>

        </form>

    </div>

</body>

</html>