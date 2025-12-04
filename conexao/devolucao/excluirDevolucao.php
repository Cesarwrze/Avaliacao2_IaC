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

// Obter insumo e quantidade da devolução
$select = $banco->prepare("SELECT insumo, quantidade, idEmprestimo FROM devolucao WHERE id = ?");
$select->bind_param("i", $id);
$select->execute();
$result = $select->get_result();

if ($row = $result->fetch_assoc()) {
    $insumo = $row['insumo'];
    $quantidade = $row['quantidade'];
    $idEmprestimo = $row['idEmprestimo'];
} else {
    echo json_encode(["status" => "error", "message" => "Registro de devolução não encontrado."]);
    exit;
}
$select->close();

// Excluir devolução
$stmt = $banco->prepare("DELETE FROM devolucao WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Ajustar o estoque: remove a devolução (volta ao estado anterior)
    $update = $banco->prepare("UPDATE insumo SET quantidade = quantidade - ?, ultima_atualizacao = NOW() WHERE id = ?");
    $update->bind_param("ii", $quantidade, $insumo);
    $update->execute();
    $update->close();

    // Verifica se ainda existem devoluções para este empréstimo
    $check = $banco->prepare("SELECT COUNT(*) as total FROM devolucao WHERE idEmprestimo = ?");
    $check->bind_param("i", $idEmprestimo);
    $check->execute();
    $checkResult = $check->get_result()->fetch_assoc();
    $check->close();

    // Se não houver mais nenhuma devolução, reativa o empréstimo
    if ($checkResult['total'] == 0) {
        $reactivar = $banco->prepare("UPDATE emprestimo SET status = 'ativo' WHERE id = ?");
        $reactivar->bind_param("i", $idEmprestimo);
        $reactivar->execute();
        $reactivar->close();
    }

    echo json_encode(["status" => "success", "message" => "Devolução excluída e estoque ajustado."]);
} else {
    echo json_encode(["status" => "error", "message" => "Erro ao excluir devolução: " . $stmt->error]);
}

$stmt->close();
$banco->close();
