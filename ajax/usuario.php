<?php

require_once "../Config/conexao.php";
require_once "../Classes/Usuario.php";

$acao = $_POST["acao"];

if ($acao == "cadastrar") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = hash("sha256", $_POST["senha"]);

    $usuario = new Usuario(
        $nome,
        $email,
        $senha
    );

    $sql = "INSERT INTO usuario (nome, email, senha)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    try {

        $stmt->execute([
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getSenha()
        ]);

        echo "Usuário cadastrado com sucesso!";

        echo "<br><br>";

        echo "<a href='../index.php'>Ir para o login</a>";

    } catch (PDOException $e) {

        echo "Erro ao cadastrar usuário.";

    }

}

if ($acao == "alterar") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $sql = "UPDATE usuario
            SET nome = ?, email = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $email,
        $id
    ]);

    header("Location: ../Views/inicio.php");
    exit;

}

if ($acao == "excluir") {

    $id = $_POST["id"];

    $sql = "DELETE FROM usuario WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id
    ]);

    session_start();

    session_destroy();

    header("Location: ../index.php");
    exit;

}

if ($acao == "logar") {

    session_start();

    $email = $_POST["email"];
    $senha = hash("sha256", $_POST["senha"]);

    $sql = "SELECT id, nome
            FROM usuario
            WHERE email = ? AND senha = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $email,
        $senha
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["nome_usuario"] = $usuario["nome"];

        header("Location: ../Views/inicio.php");
        exit;

    } else {

        echo "E-mail ou senha incorretos.";

        echo "<br><br>";

        echo "<a href='../index.php'>Voltar</a>";

    }

}

?>