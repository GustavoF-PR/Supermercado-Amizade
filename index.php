<?php

require_once "config/banco.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <title>Supermercado Amizade</title>
    </head>
    <body>
        <div class="container">
            <div class="row min-vh-100 justify-content-center align-items-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="text-center mb-4">Supermercado Amizade</h3>
                            
                            <form id="form-login" action="Tela_Login.php" method="POST">

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="seuemail@exemplo.com" required>
                                </div>

                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" id="senha" class="form-control" name="senha" placeholder="Digite sua senha" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
                            </form>

                            <div class="text-center mt-3">
                                <a href="Views/cadastro.php">Criar uma conta</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>