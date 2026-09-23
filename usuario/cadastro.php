<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Cadastro</title>

</head>

<body>

    <h1>Cadastro de Usuário</h1>

    <form action="salvar.php" method="post">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <br><br>

        <input type="submit" value="Cadastrar">

    </form>

    <br>

    <a href="login.php">Já tenho uma conta</a>

</body>

</html>