<?php
include '../conexao.php';
header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode(["status" => "error", "message" => "Nenhum ID foi enviado para exclusão."]);
    exit;
}

$id = intval($_POST['id']);
$banco = abrirBanco();

if (!$banco) {
    echo json_encode(["status" => "error", "message" => "Erro ao conectar ao banco de dados."]);
    exit;
}

// Verificar se o insumo está em empréstimos ou devoluções
$check = $banco->prepare("
    SELECT 
        (SELECT COUNT(*) FROM emprestimo WHERE insumo = ?) AS emprestimos,
        (SELECT COUNT(*) FROM devolucao WHERE insumo = ?) AS devolucoes
");
$check->bind_param("ii", $id, $id);
$check->execute();
$res = $check->get_result();
$row = $res->fetch_assoc();
$check->close();

if ($row['emprestimos'] > 0 || $row['devolucoes'] > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Insumo vinculado a empréstimos ou devoluções. Exclusão não permitida."
    ]);
    $banco->close();
    exit;
}

// Preparar a query de exclusão
$stmt = $banco->prepare("DELETE FROM insumo WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Insumo com ID $id excluído com sucesso."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao executar a exclusão: " . $stmt->error
    ]);
}

$stmt->close();
$banco->close();
