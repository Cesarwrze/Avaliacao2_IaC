<?php

include '../conexao.php';
header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode(["status" => "error", "message" => "ID não enviado."]);
    exit;
}

$id = intval($_POST['id']);
$banco = abrirBanco();

if (!$banco) {
    echo json_encode(["status" => "error", "message" => "Erro ao conectar ao banco de dados."]);
    exit;
}

// Verifica se existem insumos vinculados a esse ambiente
$verifica = $banco->prepare("SELECT COUNT(*) AS total FROM insumo WHERE ambiente = ?");
$verifica->bind_param("i", $id);
$verifica->execute();
$result = $verifica->get_result();
$total = $result->fetch_assoc()['total'];
$verifica->close();

if ($total > 0) {
    echo json_encode(["status" => "error", "message" => "Não é possível excluir: existem insumos vinculados a este ambiente."]);
    exit;
}

// Excluir
$stmt = $banco->prepare("DELETE FROM ambientes WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Ambiente excluído com sucesso."]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao excluir: " . $stmt->error]);
}

$stmt->close();
$banco->close();
