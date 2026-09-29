<?php

    session_start();

    header("Location: views/catalogo.php");

    $email = $_POST["email"];
    $senha = hash("sha256", $_POST["senha"]);

    $sql = "SELECT * FROM usuario WHERE email = ? AND senha = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $email,
        $senha
    ]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["nome_usuario"] = $usuario["nome"];

        header("Location: Views/inicio.php");
        exit;

    } else {

        echo "E-mail ou senha incorretos.";

        echo "<br><br>";

        echo "<a href='index.php'>Voltar</a>";

    }

?>