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

    <title>Cadastro - Supermercado Amizade</title>

</head>

<body>

    <div class="container">

        <div class="row min-vh-100 justify-content-center align-items-center">

            <div class="col-md-6 col-lg-5">

                <div class="card shadow-sm">

                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">
                            Criar conta
                        </h3>

                        <form id="form-cadaastro"action="../ajax/usuario.php" method="POST">

                            <input type="hidden" name="acao" value="cadastrar">

                            <div class="mb-3">

                                <label for="nome" class="form-label">
                                    Nome
                                </label>

                                <input
                                    type="text"
                                    id="nome"
                                    class="form-control"
                                    name="nome"
                                    placeholder="Digite seu nome"
                                    required
                                >

                            </div>

                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    E-mail
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="seuemail@exemplo.com"
                                    required
                                >

                            </div>

                            <div class="mb-3">

                                <label for="senha" class="form-label">
                                    Senha
                                </label>

                                <input
                                    type="password"
                                    id="senha"
                                    class="form-control"
                                    name="senha"
                                    placeholder="Digite sua senha"
                                    required
                                >

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Criar conta
                            </button>

                        </form>

                        <div class="text-center mt-3">

                            <a href="../index.php">
                                Voltar para o login
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script src="../assets/js/script.js"></script>
</body>

</html>