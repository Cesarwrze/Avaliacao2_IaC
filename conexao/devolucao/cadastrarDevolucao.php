<?php
include('../conexao.php');
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    // Captura e validação dos dados
    $dataDevolucao = $_POST['dataDevolucao'] ?? null;
    $idEmprestimo = $_POST['idEmprestimo'] ?? null;
    $requisitanteId = $_POST['requisitante'] ?? null;
    $insumoId = $_POST['insumo'] ?? null;
    $quantidade_devolvida = $_POST['quantidade_devolvida'] ?? null;
    $obs = $_POST['obs'] ?? null;
    $obs = trim($obs);


    if (!$dataDevolucao || !$idEmprestimo || !$requisitanteId || !$insumoId || !$quantidade_devolvida) {
        echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos obrigatórios.']);
        exit;
    }

    // Verifica a quantidade emprestada para garantir que não ultrapassa
    $stmt = $banco->prepare("SELECT quantidade FROM emprestimo WHERE id = ?");
    $stmt->bind_param("i", $idEmprestimo);
    $stmt->execute();
    $result = $stmt->get_result();
    $emprestimo = $result->fetch_assoc();
    $stmt->close();

    if (!$emprestimo) {
        echo json_encode(['status' => 'error', 'message' => 'Empréstimo não encontrado.']);
        exit;
    }

    $quantidadeEmprestada = $emprestimo['quantidade'];

    if ($quantidade_devolvida > $quantidadeEmprestada) {
        echo json_encode(['status' => 'error', 'message' => 'A quantidade devolvida não pode ser maior que a emprestada.']);
        exit;
    }

    $stmt = $banco->prepare("
        INSERT INTO devolucao (dataDevolucao, idEmprestimo, requisitante, insumo, quantidade, obs, ultima_atualizacao) 
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");


    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Erro na preparação da consulta: ' . $banco->error]);
        exit;
    }

    $obs = $_POST['obs'] ?? '';
    $obs = trim($obs);

    $stmt->bind_param("siiiss", $dataDevolucao, $idEmprestimo, $requisitanteId, $insumoId, $quantidade_devolvida, $obs);
    //$stmt->bind_param("siiiss", $dataDevolucao, $idEmprestimo, $requisitante, $insumo, $quantidade_devolvida, $obs);


    if ($stmt->execute()) {
        $stmt->close(); // IMPORTANTE: feche antes de reutilizar qualquer variável!

        // Atualiza o estoque
        $updateEstoque = $banco->prepare("UPDATE insumo SET quantidade = quantidade + ?, ultima_atualizacao = NOW() WHERE id = ?");
        if ($updateEstoque) {
            $updateEstoque->bind_param("ii", $quantidade_devolvida, $insumoId);
            if (!$updateEstoque->execute()) {
                error_log("Falha ao atualizar estoque: " . $updateEstoque->error);
            }
            $updateEstoque->close();
        } else {
            error_log("Erro no prepare() do UPDATE insumo: " . $banco->error);
        }

        echo json_encode(['status' => 'success', 'message' => 'Devolução registrada e atualizações concluídas!']);
    } else {
        http_response_code(500);
        error_log("Falha ao inserir devolução: " . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => 'Erro ao registrar devolução.']);
    }

    // Soma todas as devoluções já feitas desse empréstimo
    $stmt = $banco->prepare("SELECT SUM(quantidade) AS total_devolvido FROM devolucao WHERE idEmprestimo = ?");
    $stmt->bind_param("i", $idEmprestimo);
    $stmt->execute();
    $result = $stmt->get_result();
    $devolvidoTotal = $result->fetch_assoc()['total_devolvido'] + $quantidade_devolvida;
    $stmt->close();

    if ($quantidade_devolvida == $quantidadeEmprestada) {
        $marcarDevolvido = $banco->prepare("UPDATE emprestimo SET status = 'devolvido' WHERE id = ?");
        if ($marcarDevolvido) {
            $marcarDevolvido->bind_param("i", $idEmprestimo);
            $marcarDevolvido->execute();
            $marcarDevolvido->close();
        } else {
            error_log("Erro no prepare() do UPDATE emprestimo: " . $banco->error);
        }
    }

    $banco->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
