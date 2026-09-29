<?php

session_start();

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
    exit;

}

if ($acao == "alterar") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $idFornecedor = $_POST["id_fornecedor"];

    $sql = "UPDATE produto
            SET nome = ?, descricao = ?, preco = ?, id_fornecedor = ?
            WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $descricao,
        $preco,
        $idFornecedor,
        $id
    ]);

    header("Location: ../Views/produtos.php");
    exit;

}

if ($acao == "excluir") {

    $id = $_POST["id"];

    $sql = "DELETE FROM produto WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id
    ]);

    header("Location: ../Views/produtos.php");
    exit;

}

if ($acao == "adicionar") {

    if (!isset($_SESSION["id_usuario"])) {

        header("Location: ../index.php");
        exit;

    }

    if (!isset($_POST["produtos"])) {

        echo "Selecione pelo menos um produto.";

        echo "<br><br>";

        echo "<a href='../Views/catalogo.php'>Voltar para o catálogo</a>";

        exit;

    }

    $idUsuario = $_SESSION["id_usuario"];
    $produtos = $_POST["produtos"];

    $sql = "SELECT id FROM carrinho WHERE id_usuario = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $idUsuario
    ]);

    $carrinho = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$carrinho) {

        $sql = "INSERT INTO carrinho (id_usuario)
                VALUES (?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $idUsuario
        ]);

        $idCarrinho = $pdo->lastInsertId();

    } else {

        $idCarrinho = $carrinho["id"];

    }

    foreach ($produtos as $idProduto) {

        $sql = "INSERT IGNORE INTO item_carrinho
                (id_carrinho, id_produto)
                VALUES (?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $idCarrinho,
            $idProduto
        ]);

    }

    header("Location: ../Views/carrinho.php");
    exit;

}

?>