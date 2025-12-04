<?php
ob_start();
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 0);
header('Content-Type: application/json');
date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    $id = $_POST['id'] ?? null;
    $dataDevolucao = $_POST['dataDevolucao'] ?? null;
    $quantidade = $_POST['quantidade'] ?? null;
    $obs = $_POST['obs'] ?? '';

    // Validar se os campos obrigatórios estão preenchidos
    if (!$id || !$dataDevolucao || !$quantidade) {
        echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos obrigatórios!"]);
        exit;
    }

    // quantidade anterior e insumo
    $stmtAntigo = $banco->prepare("SELECT quantidade, insumo FROM devolucao WHERE id = ?");
    $stmtAntigo->bind_param("i", $id);
    $stmtAntigo->execute();
    $resAntigo = $stmtAntigo->get_result();

    if (!$resAntigo || $resAntigo->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Devolução não encontrada."]);
        exit;
    }

    $dadosAntigos = $resAntigo->fetch_assoc();
    $quantidadeAntiga = (float)$dadosAntigos['quantidade'];
    $insumo = (int)$dadosAntigos['insumo'];
    $stmtAntigo->close();

    // nenhuma mudança, não salva nem ajusta estoque
    $quantidadeNova = (float)$quantidade;
    if ($quantidadeAntiga == $quantidadeNova && $obs === $dadosAntigos['obs']) {
        echo json_encode(["status" => "warning", "message" => "Nenhuma alteração foi detectada."]);
        exit;
    }

    // Calcula diferença entre quantidades
    $diferenca = (float)$quantidadeNova - $quantidadeAntiga;

    // Atualizar devolução
    $stmt = $banco->prepare("UPDATE devolucao SET dataDevolucao = ?, quantidade = ?, obs = ?, ultima_atualizacao = NOW() WHERE id = ?");
    $stmt->bind_param("sssi", $dataDevolucao, $quantidadeNova, $obs, $id);

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Erro ao atualizar o registro: " . $stmt->error]);
        $stmt->close();
        $banco->close();
        exit;
    }
    $stmt->close();

    // Ajustar estoque pela diferença
    if ($diferenca != 0) {
        $updateEstoque = $banco->prepare("UPDATE insumo SET quantidade = quantidade + ?, ultima_atualizacao = NOW() WHERE id = ?");
        $updateEstoque->bind_param("di", $diferenca, $insumo);
        if (!$updateEstoque->execute()) {
            echo json_encode(["status" => "error", "message" => "Erro ao ajustar o estoque: " . $updateEstoque->error]);
            $updateEstoque->close();
            $banco->close();
            exit;
        }
        $updateEstoque->close();
    }

    echo json_encode(["status" => "success", "message" => "Devolução atualizada com sucesso."]);
    $banco->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método não permitido!"]);
}
