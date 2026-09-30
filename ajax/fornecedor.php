<?php

require_once "../Config/conexao.php";
require_once "../Classes/Fornecedor.php";

$acao = $_POST["acao"];

if ($acao == "cadastrar") {

    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $fornecedor = new Fornecedor(
        $nome,
        $cnpj,
        $telefone,
        $email
    );

    $sql = "INSERT INTO fornecedor (nome, cnpj, telefone, email)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $fornecedor->getNome(),
        $fornecedor->getCnpj(),
        $fornecedor->getTelefone(),
        $fornecedor->getEmail()
    ]);

    header("Location: ../Views/fornecedor.php");
    exit;

}

if ($acao == "alterar") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $sql = "UPDATE fornecedor
            SET nome = ?, cnpj = ?, telefone = ?, email = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $cnpj,
        $telefone,
        $email,
        $id
    ]);

    header("Location: ../Views/fornecedor.php");
    exit;

}

if ($acao == "excluir") {

    $id = $_POST["id"];

    $sql = "DELETE FROM fornecedor WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id
    ]);

    header("Location: ../Views/fornecedor.php");
    exit;


}

if ($acao == "listar") {
    $fornecedores = Fornecedor::listarTodos($pdo);
    
    echo json_encode($fornecedores);
}

?>