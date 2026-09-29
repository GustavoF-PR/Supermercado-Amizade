<?php

require_once "../Config/conexao.php";

$sql = "SELECT * FROM fornecedor";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Fornecedor - Supermercado Amizade</title>

</head>

<body>

    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2>Cadastro de Fornecedor</h2>

            <a href="inicio.php" class="btn btn-secondary">
                Voltar
            </a>

        </div>

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-3">Cadastrar fornecedor</h4>

                <form action="../Ajax/fornecedor.php" method="POST">

                    <input type="hidden" name="acao" value="cadastrar">

                    <div class="mb-3">

                        <label for="nome" class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control"
                            placeholder="Digite o nome do fornecedor"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label for="cnpj" class="form-label">
                            CNPJ
                        </label>

                        <input
                            type="text"
                            id="cnpj"
                            name="cnpj"
                            class="form-control"
                            placeholder="Digite o CNPJ"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label for="telefone" class="form-label">
                            Telefone
                        </label>

                        <input
                            type="text"
                            id="telefone"
                            name="telefone"
                            class="form-control"
                            placeholder="Digite o telefone"
                        >

                    </div>

                    <div class="mb-3">

                        <label for="email" class="form-label">
                            E-mail
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            placeholder="Digite o e-mail"
                        >

                    </div>

                    <button type="submit" class="btn btn-primary">
                        Cadastrar Fornecedor
                    </button>

                </form>

            </div>

        </div>

        <h4 class="mb-3">Fornecedores cadastrados</h4>

        <div class="row">

            <?php foreach ($fornecedores as $fornecedor) { ?>

                <div class="col-md-6 mb-4">

                    <div class="card shadow-sm">

                        <div class="card-body">

                            <form action="../Ajax/fornecedor.php" method="POST">

                                <input type="hidden" name="acao" value="alterar">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo $fornecedor["id"]; ?>"
                                >

                                <div class="mb-3">

                                    <label class="form-label">
                                        Nome
                                    </label>

                                    <input
                                        type="text"
                                        name="nome"
                                        class="form-control"
                                        value="<?php echo $fornecedor["nome"]; ?>"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        CNPJ
                                    </label>

                                    <input
                                        type="text"
                                        name="cnpj"
                                        class="form-control"
                                        value="<?php echo $fornecedor["cnpj"]; ?>"
                                        required
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        Telefone
                                    </label>

                                    <input
                                        type="text"
                                        name="telefone"
                                        class="form-control"
                                        value="<?php echo $fornecedor["telefone"]; ?>"
                                    >

                                </div>

                                <div class="mb-3">

                                    <label class="form-label">
                                        E-mail
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="<?php echo $fornecedor["email"]; ?>"
                                    >

                                </div>

                                <button type="submit" class="btn btn-warning">
                                    Alterar
                                </button>

                            </form>

                            <form
                                action="../Ajax/fornecedor.php"
                                method="POST"
                                class="mt-2"
                            >

                                <input type="hidden" name="acao" value="excluir">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo $fornecedor["id"]; ?>"
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