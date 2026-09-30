<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../index.php");
    exit;
}
require_once "../Config/conexao.php";

$sql = "SELECT * FROM fornecedor";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT produto.id, produto.nome, produto.descricao, produto.preco, produto.id_fornecedor, fornecedor.nome fornecedor
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

    <title>Produtos - Supermercado Amizade</title>

</head>

<body>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Cadastro de Produtos</h2>

            <a href="inicio.php" class="btn btn-secondary">
                Voltar
            </a>

            <a href="../ajax/usuario.php?acao=sair" class="btn btn-outline-danger btn-sm">
                Sair
            </a>

        </div>

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-3">Cadastrar produto</h4>

                <form action="../Ajax/produto.php" method="POST">

                    <input type="hidden" name="acao" value="cadastrar">

                    <div class="mb-3">

                        <label for="nome" class="form-label">
                            Nome do produto
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control"
                            placeholder="Digite o nome do produto"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label for="descricao" class="form-label">
                            Descrição
                        </label>

                        <textarea
                            id="descricao"
                            name="descricao"
                            class="form-control"
                            placeholder="Digite a descrição do produto"
                        ></textarea>

                    </div>

                    <div class="mb-3">

                        <label for="preco" class="form-label">
                            Preço
                        </label>

                        <input
                            type="number"
                            id="preco"
                            name="preco"
                            class="form-control"
                            step="0.01"
                            min="0"
                            placeholder="0,00"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label for="id_fornecedor" class="form-label">
                            Fornecedor
                        </label>

                        <select
                            id="id_fornecedor"
                            name="id_fornecedor"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Selecione um fornecedor
                            </option>

                            <?php foreach ($fornecedores as $fornecedor) { ?>

                                <option value="<?php echo $fornecedor["id"]; ?>">
                                    <?php echo $fornecedor["nome"]; ?>
                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        Cadastrar Produto
                    </button>

                </form>

            </div>

        </div>

        <h4 class="mb-3">Produtos cadastrados</h4>

        <div class="row">

            <?php foreach ($produtos as $produto) { ?>

                <div class="col-md-6 mb-4">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <form action="../Ajax/produto.php" method="POST">

                                <input type="hidden" name="acao" value="alterar">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo $produto["id"]; ?>"
                                >

                                <div class="mb-3">

                                    <label class="form-label">
                                        Nome
                                    </label>

                                    <input
                                        type="text"
                                        name="nome"
                                        class="form-control"
                                        value="<?php echo $produto["nome"]; ?>"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Descrição
                                    </label>

                                    <textarea
                                        name="descricao"
                                        class="form-control"
                                    ><?php echo $produto["descricao"]; ?></textarea>

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Preço
                                    </label>

                                    <input
                                        type="number"
                                        name="preco"
                                        class="form-control"
                                        step="0.01"
                                        min="0"
                                        value="<?php echo $produto["preco"]; ?>"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Fornecedor
                                    </label>

                                    <select
                                        name="id_fornecedor"
                                        class="form-select"
                                        required
                                    >

                                        <?php foreach ($fornecedores as $fornecedor) { ?>

                                            <option
                                                value="<?php echo $fornecedor["id"]; ?>"
                                                <?php
                                                if ($fornecedor["id"] == $produto["id_fornecedor"]) {
                                                    echo "selected";
                                                }
                                                ?>
                                            >
                                                <?php echo $fornecedor["nome"]; ?>
                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <p>
                                    <strong>Fornecedor atual:</strong>
                                    <?php echo $produto["fornecedor"]; ?>
                                </p>

                                <button type="submit" class="btn btn-warning">
                                    Alterar
                                </button>

                            </form>

                            <form
                                action="../Ajax/produto.php"
                                method="POST"
                                class="mt-2"
                            >

                                <input type="hidden" name="acao" value="excluir">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo $produto["id"]; ?>"
                                >

                                <button type="submit" class="btn btn-danger">
                                    Excluir
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</body>

</html>