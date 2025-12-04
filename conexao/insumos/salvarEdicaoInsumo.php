<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexao.php';
header('Content-Type: application/json');

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nome = trim($_POST['nome'] ?? '');
    $emprestavel = trim($_POST['emprestavel'] ?? '');
    $ambiente = intval($_POST['ambiente'] ?? 0);
    $grupo = intval($_POST['grupo'] ?? 0);
    $container = trim($_POST['container'] ?? '');
    $divisao = trim($_POST['divisao'] ?? '');
    $quantidade = floatval($_POST['quantidade'] ?? 0);
    $descricao = trim($_POST['descricao'] ?? '');
    $detalhes = trim($_POST['detalhes'] ?? '');
    $ultima_atualizacao = date('Y-m-d H:i:s');

    if ($id <= 0 || empty($nome) || empty($emprestavel) || $ambiente <= 0 || $grupo <= 0) {
        echo json_encode(["error" => "Preencha todos os campos obrigatórios."]);
        exit;
    }

    $banco = abrirBanco();

    if (!$banco) {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
        exit;
    }

    $sql = "UPDATE insumo 
            SET nome = ?, emprestavel = ?, ambiente = ?, grupo = ?, container = ?, divisao = ?, quantidade = ?, descricao = ?, detalhes = ?, ultima_atualizacao = ?
            WHERE id = ?";

    $stmt = $banco->prepare($sql);

    if (!$stmt) {
        echo json_encode(["error" => "Erro ao preparar a consulta: " . $banco->error]);
        $banco->close();
        exit;
    }

    $stmt->bind_param(
        "sssissdsssi",
        $nome,
        $emprestavel,
        $ambiente,
        $grupo,
        $container,
        $divisao,
        $quantidade,
        $descricao,
        $detalhes,
        $ultima_atualizacao,
        $id
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => "Insumo atualizado com sucesso!",
            "ultima_atualizacao" => $ultima_atualizacao
        ]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar os dados: " . $stmt->error]);
    }

    $stmt->close();
    $banco->close();
} else {
    echo json_encode(["error" => "Requisição inválida."]);
}
