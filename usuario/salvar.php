<?php

require_once "../conexao.php";
require_once "../salvar/Usuario.php";


$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = hash("sha256", $_POST["senha"]);

$usuario = new Usuario($nome, $email, $senha);

$sql = "INSERT INTO usuario (nome, email, senha)
        VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $usuario->getNome(),
    $usuario->getEmail(),
    $usuario->getSenha()
]);

echo "Usuário cadastrado com sucesso!";
?>