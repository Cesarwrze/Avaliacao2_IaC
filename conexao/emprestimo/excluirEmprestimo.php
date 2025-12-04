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

// Verificar se há devoluções vinculadas
$checkDevolucoes = $banco->prepare("SELECT COUNT(*) AS total FROM devolucao WHERE idEmprestimo = ?");
$checkDevolucoes->bind_param("i", $id);
$checkDevolucoes->execute();
$devolucaoResult = $checkDevolucoes->get_result();
$totalDevolucoes = $devolucaoResult->fetch_assoc()['total'];
$checkDevolucoes->close();

if ($totalDevolucoes > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Este empréstimo possui devoluções registradas e não pode ser excluído."
    ]);
    exit;
}

// Obter insumo e quantidade do empréstimo
$select = $banco->prepare("SELECT insumo, quantidade FROM emprestimo WHERE id = ?");
$select->bind_param("i", $id);
$select->execute();
$result = $select->get_result();

if ($row = $result->fetch_assoc()) {
    $insumo = $row['insumo'];
    $quantidade = $row['quantidade'];
} else {
    echo json_encode(["status" => "error", "message" => "Registro de empréstimo não encontrado."]);
    exit;
}
$select->close();

// Excluir o registro de empréstimo
$stmt = $banco->prepare("DELETE FROM emprestimo WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Repor o estoque
    $update = $banco->prepare("UPDATE insumo SET quantidade = quantidade + ? WHERE id = ?");
    $update->bind_param("ii", $quantidade, $insumo);
    $update->execute();
    $update->close();

    echo json_encode(["status" => "success", "message" => "Empréstimo excluído e estoque ajustado."]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao excluir empréstimo: " . $stmt->error]);
}

$stmt->close();
$banco->close();
