<?php
header('Content-Type: application/json');

$con = new mysqli("localhost", "root", "", "gestao_estoque");

if ($con->connect_error) {
    echo json_encode(["erro" => "Erro de conexão: " . $con->connect_error]);
    exit;
}

$id = $_POST['id'] ?? null;

if (empty($id)) {
    echo json_encode(["erro" => "ID não informado."]);
    exit;
}

$sql = "DELETE FROM ambientes WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => "Ambiente excluído com sucesso!"]);
} else {
    echo json_encode(["erro" => "Erro ao excluir: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
