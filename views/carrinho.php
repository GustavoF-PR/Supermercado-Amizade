<?php
    session_start();
    require_once "../config/conexao.php";

    if (!isset($_SESSION["id_usuario"])) {
        header("Location: ../index.php");
        exit;
    }

    $id_usuario = $_SESSION["id_usuario"];

    $sql = "SELECT item_carrinho.id AS id_item, produto.nome AS nome_produto, produto.preco, fornecedor.nome AS nome_fornecedor
            FROM item_carrinho
            JOIN carrinho ON item_carrinho.id_carrinho = carrinho.id
            JOIN produto ON item_carrinho.id_produto = produto.id
            JOIN fornecedor ON produto.id_fornecedor = fornecedor.id
            WHERE carrinho.id_usuario = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total = 0;
    foreach ($itens as $item) {
        $total += $item["preco"];
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cesta de Compras - Supermercado Amizade</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Cesta de Compras</h2>
                <?php if (isset($_GET["sucesso"]) && $_GET["sucesso"] == 1) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Pedido realizado com sucesso!</strong> A sua compra foi registada e a cesta foi concluída.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?> 
                <div>
                    <a href="catalogo.php" class="btn btn-outline-secondary">Continuar a Comprar</a>
                    <a href="inicio.php" class="btn btn-secondary">Início</a>
                    <a href="../ajax/usuario.php?acao=sair" class="btn btn-outline-danger btn-sm">Sair</a>
                </div>
            </div>

            <?php if (empty($itens)) { ?>
                <div class="alert alert-info text-center py-4">
                    A sua cesta está vazia no momento.
                    <br><br>
                    <a href="catalogo.php" class="btn btn-primary btn-sm">Ver Catálogo</a>
                </div>
            <?php } else { ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Produto</th>
                                    <th>Fornecedor</th>
                                    <th>Preço Unitário</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($itens as $item) { ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $item["nome_produto"]; ?></td>
                                        <td class="align-middle"><?php echo $item["nome_fornecedor"]; ?></td>
                                        <td class="align-middle">R$ <?php echo number_format($item["preco"], 2, ",", "."); ?></td>
                                        <td class="text-center align-middle">
                                            <form action="../ajax/carrinho.php" method="POST" class="d-inline">
                                                <input type="hidden" name="acao" value="remover_item">
                                                <input type="hidden" name="id_item" value="<?php echo $item["id_item"]; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm">
                    <h4 class="mb-0">Total: <span class="text-success">R$ <?php echo number_format($total, 2, ",", "."); ?></span></h4>
                    <div>
                        <form action="../ajax/carrinho.php" method="POST" class="d-inline">
                            <input type="hidden" name="acao" value="esvaziar">
                            <button type="submit" class="btn btn-outline-danger me-2">Esvaziar Cesta</button>
                        </form>
                        <form action="../ajax/carrinho.php" method="POST" class="d-inline">
                            <input type="hidden" name="acao" value="finalizar">
                            <button type="submit" class="btn btn-success" onclick="return confirm('Confirma a finalização da sua compra?')">
                                Finalizar Compra
                            </button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>