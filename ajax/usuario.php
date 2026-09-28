<?php

require_once "../config/conexao.php";
require_once "../classes/usuario.php";

$acao = $_POST["acao"];

if ($acao == "cadastrar") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = hash("sha256", $_POST["senha"]);

    $usuario = new Usuario($nome, $email, $senha);

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

?>