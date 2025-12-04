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

// Verificar se o usuário está vinculado a algum empréstimo
$check = $banco->prepare("SELECT COUNT(*) AS total FROM emprestimo WHERE requisitante = ?");
$check->bind_param("i", $id);
$check->execute();
$res = $check->get_result();
$total = $res->fetch_assoc()['total'];
$check->close();

if ($total > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Usuário vinculado a empréstimos. Exclusão não permitida."
    ]);
    $banco->close();
    exit;
}

// Preparar a query de exclusão
$stmt = $banco->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Usuário com ID $id excluído com sucesso."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Erro ao executar a exclusão: " . $stmt->error
    ]);
}

$stmt->close();
$banco->close();
