<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$caminhoConexao = __DIR__ . "/../config/conexao.php";
if (!file_exists($caminhoConexao)) {
    $caminhoConexao = __DIR__ . "/../Config/conexao.php";
}
require_once $caminhoConexao;

if (!isset($_SESSION["id_usuario"])) {
    die("Erro: Sessão não encontrada. Faça login novamente.");
}

$id_usuario = $_SESSION["id_usuario"];
$acao = $_POST["acao"] ?? "";

if ($acao === "adicionar") {
    if (isset($_POST["produtos"]) && is_array($_POST["produtos"])) {
        try {
            $sqlBuscaCarrinho = "SELECT id FROM carrinho WHERE id_usuario = ?";
            $stmtBusca = $pdo->prepare($sqlBuscaCarrinho);
            $stmtBusca->execute([$id_usuario]);
            $carrinho = $stmtBusca->fetch(PDO::FETCH_ASSOC);

            if ($carrinho) {
                $id_carrinho = $carrinho["id"];
            } else {
                $sqlNovoCarrinho = "INSERT INTO carrinho (id_usuario) VALUES (?)";
                $stmtNovo = $pdo->prepare($sqlNovoCarrinho);
                $stmtNovo->execute([$id_usuario]);
                $id_carrinho = $pdo->lastInsertId();
            }

            $sqlItem = "INSERT INTO item_carrinho (id_carrinho, id_produto) VALUES (?, ?)";
            $stmtItem = $pdo->prepare($sqlItem);

            foreach ($_POST["produtos"] as $id_produto) {
                $stmtItem->execute([$id_carrinho, $id_produto]);
            }

            header("Location: ../views/carrinho.php");
            exit;
        } catch (PDOException $e) {
            die("Erro ao adicionar: " . $e->getMessage());
        }
    } else {
        echo "<script>alert('Selecione pelo menos um produto!'); window.location.href='../views/catalogo.php';</script>";
        exit;
    }
}

if ($acao === "remover_item") {
    $id_item = $_POST["id_item"] ?? null;
    if ($id_item) {
        try {
            $sql = "DELETE FROM item_carrinho WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_item]);

            header("Location: ../views/carrinho.php");
            exit;
        } catch (PDOException $e) {
            die("Erro ao remover item: " . $e->getMessage());
        }
    }
}

if ($acao === "esvaziar") {
    try {
        $sqlBusca = "SELECT id FROM carrinho WHERE id_usuario = ?";
        $stmtBusca = $pdo->prepare($sqlBusca);
        $stmtBusca->execute([$id_usuario]);
        $carrinho = $stmtBusca->fetch(PDO::FETCH_ASSOC);

        if ($carrinho) {
            $sqlDelete = "DELETE FROM item_carrinho WHERE id_carrinho = ?";
            $stmtDelete = $pdo->prepare($sqlDelete);
            $stmtDelete->execute([$carrinho["id"]]);
        }

        header("Location: ../views/carrinho.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao esvaziar carrinho: " . $e->getMessage());
    }
}

if (isset($_POST["acao"]) && $_POST["acao"] === "finalizar") {
    $id_usuario = $_SESSION["id_usuario"];

    try {
        $sqlBusca = "SELECT id FROM carrinho WHERE id_usuario = ?";
        $stmtBusca = $pdo->prepare($sqlBusca);
        $stmtBusca->execute([$id_usuario]);
        $carrinho = $stmtBusca->fetch(PDO::FETCH_ASSOC);

        if ($carrinho) {
            $sqlLimpar = "DELETE FROM item_carrinho WHERE id_carrinho = ?";
            $stmtLimpar = $pdo->prepare($sqlLimpar);
            $stmtLimpar->execute([$carrinho["id"]]);
        }

        header("Location: ../views/carrinho.php?sucesso=1");
        exit;
    } catch (PDOException $e) {
        die("Erro ao finalizar pedido: " . $e->getMessage());
    }
}

die("Nenhuma ação válida recebida. Ação enviada: '" . htmlspecialchars($acao) . "'");