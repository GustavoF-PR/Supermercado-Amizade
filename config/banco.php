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

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS fornecedor (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            cnpj VARCHAR(18) NOT NULL,
            telefone VARCHAR(20),
            email VARCHAR(100)
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS produto (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            descricao VARCHAR(255),
            preco DECIMAL(10,2) NOT NULL,
            id_fornecedor INT NOT NULL,
            FOREIGN KEY (id_fornecedor) REFERENCES fornecedor(id)
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS carrinho (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT NOT NULL,
            FOREIGN KEY (id_usuario) REFERENCES usuario(id)
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS item_carrinho (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_carrinho INT NOT NULL,
            id_produto INT NOT NULL,
            FOREIGN KEY (id_carrinho) REFERENCES carrinho(id),
            FOREIGN KEY (id_produto) REFERENCES produto(id),
            UNIQUE (id_carrinho, id_produto)
        )
    ");

} catch (PDOException $e) {

    echo "Erro: " . $e->getMessage();

}

?>