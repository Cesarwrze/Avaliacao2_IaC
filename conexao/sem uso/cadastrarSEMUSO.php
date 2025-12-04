<?php
header('Content-Type: application/json');

// Conexão com o banco
$con = new mysqli("localhost", "root", "", "gestao_estoque");

if ($con->connect_error) {
    echo json_encode(["erro" => "Erro de conexão: " . $con->connect_error]);
    exit;
}

// Pega os dados enviados em JSON
$data = json_decode(file_get_contents("php://input"), true);

// Valida se o campo ambiente foi enviado
$ambiente = $data['ambiente'] ?? null;

if (empty($ambiente)) {
    echo json_encode(["erro" => "O campo 'ambiente' é obrigatório."]);
    exit;
}

// Inserção no banco
$sql = "INSERT INTO ambientes (ambiente) VALUES (?)";
$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode(["erro" => "Erro na preparação da query: " . $con->error]);
    exit;
}

$stmt->bind_param("s", $ambiente);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => "Ambiente cadastrado com sucesso!"]);
} else {
    echo json_encode(["erro" => "Erro ao cadastrar: " . $stmt->error]);
}

$stmt->close();
$con->close();
?>
