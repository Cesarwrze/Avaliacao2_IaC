<?php
include('../conexao.php');
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $banco = abrirBanco();
    $id = intval($_POST['id']);

    $stmt = $banco->prepare("DELETE FROM enderecos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Endereço excluído com sucesso.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir.']);
    }
    $banco->close();
}
?>