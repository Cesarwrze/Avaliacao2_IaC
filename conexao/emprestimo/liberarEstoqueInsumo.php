<?php
include('../conexao.php');
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEmprestimo = intval($_POST['id'] ?? 0);

    if ($idEmprestimo <= 0) {
        echo json_encode(["status" => "error", "message" => "ID inválido do empréstimo."]);
        exit;
    }

    $banco = abrirBanco();

    // Recupera insumo e quantidade original
    $sql = "SELECT insumo, quantidade FROM emprestimo WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("i", $idEmprestimo);
    $stmt->execute();
    $stmt->bind_result($insumo_id, $quantidade);
    $stmt->fetch();
    $stmt->close();

    if (!$insumo_id || !$quantidade) {
        echo json_encode(["status" => "error", "message" => "Insumo ou quantidade não encontrados."]);
        $banco->close();
        exit;
    }

    // Devolve ao estoque
    $sql = "UPDATE insumo SET quantidade = quantidade + ? WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("di", $quantidade, $insumo_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Estoque restaurado com sucesso."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao restaurar o estoque."]);
    }

    $stmt->close();
    $banco->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método não permitido."]);
}
