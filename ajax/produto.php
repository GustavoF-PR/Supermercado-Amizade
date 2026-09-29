<?php

require_once "../Config/conexao.php";
require_once "../Classes/Produto.php";

$acao = $_POST["acao"];

if ($acao == "cadastrar") {

    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $idFornecedor = $_POST["id_fornecedor"];

    $produto = new Produto(
        $nome,
        $descricao,
        $preco,
        $idFornecedor
    );

    $sql = "INSERT INTO produto (nome, descricao, preco, id_fornecedor)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $produto->getNome(),
        $produto->getDescricao(),
        $produto->getPreco(),
        $produto->getIdFornecedor()
    ]);

    header("Location: ../Views/produtos.php");

}

?>