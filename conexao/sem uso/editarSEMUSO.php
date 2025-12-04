<?php
header('Content-Type: application/json');

$con = new mysqli("localhost", "root", "", "gestao_estoque");

if ($con->connect_error) {
    echo json_encode(["erro" => "Erro de conexão: " . $con->connect_error]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? null;
$ambiente = $data['ambiente'] ?? null;

if (empty($id) || empty($ambiente)) {
    echo json_encode(["erro" => "ID e ambiente são obrigatórios."]);
    exit;
}

$sql = "UPDATE ambientes SET ambiente = ? WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $ambiente, $id);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => "Ambiente atualizado com sucesso!"]);
} else {
    echo json_encode(["erro" => "Erro ao editar: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
