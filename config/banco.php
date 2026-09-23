<?php

$servidor = "localhost";
$porta = "3306";
$usuario = "root";
$senha = "";
$banco = "sistema_produtos";

try {

    $pdo = new PDO(
        "mysql:host=$servidor;port=$porta",
        $usuario,
        $senha
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS $banco");

    $pdo->exec("USE $banco");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuario (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(64) NOT NULL
        )
    ");

} catch (PDOException $e) {

    echo "Erro: " . $e->getMessage();

}

?>