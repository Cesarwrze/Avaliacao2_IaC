<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    // Dados recebidos do formulário
    $data_emprestimo = $_POST['data_emprestimo'] ?? null;
    $supervisor_id = $_POST['supervisor_id'] ?? null;
    $requisitante_id = $_POST['requisitante_id'] ?? null;
    $insumosJson = $_POST['insumos'] ?? null;

    $insumos = json_decode($insumosJson, true);

    // Validar campos obrigatórios
    if (!$data_emprestimo || !$supervisor_id || !$requisitante_id || empty($insumos)) {
        echo json_encode(["status" => "error", "message" => "Preencha todos os campos obrigatórios!"]);
        exit;
    }

    // Começa uma transação para garantir consistência no banco
    $banco->begin_transaction();

    try {
        foreach ($insumos as $insumo) {
            $insumoId = $insumo['id'];
            $quantidade = (int) $insumo['quantidade'];
            $emprestavel = $insumo['emprestavel'];
            //$previsao_devolucao = $insumo['previsao_devolucao'];  // A data de devolução
            $previsao_devolucao = ($insumo['emprestavel'] === 'Sim' && !empty($insumo['previsao_devolucao']))
                ? $insumo['previsao_devolucao']
                : null;

            // Verifica estoque disponível
            $stmt = $banco->prepare("SELECT quantidade FROM insumo WHERE id = ?");
            $stmt->bind_param("i", $insumoId);
            $stmt->execute();
            $stmt->bind_result($estoque_atual);
            $stmt->fetch();
            $stmt->close();

            if ($quantidade > $estoque_atual) {
                throw new Exception("Quantidade solicitada maior do que o estoque disponível para o insumo ID: $insumoId!");
            }

            // Insere o empréstimo na tabela
            $stmt = $banco->prepare("INSERT INTO emprestimo (data_emprestimo, insumo, emprestavel, previsao_devolucao, supervisor, requisitante, quantidade) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)");
            // Formatação do banco de dados: a data de devolução pode ser nula se o item não for emprestável
            $stmt->bind_param("sisssii", $data_emprestimo, $insumoId, $emprestavel, $previsao_devolucao, $supervisor_id, $requisitante_id, $quantidade);
            $stmt->execute();
            $stmt->close();

            // Atualiza o estoque do insumo
            $updateStmt = $banco->prepare("UPDATE insumo SET quantidade = quantidade - ? WHERE id = ?");
            $updateStmt->bind_param("ii", $quantidade, $insumoId);
            $updateStmt->execute();
            $updateStmt->close();
        }

        // Confirmar a transação no banco
        $banco->commit();

        echo json_encode(["status" => "success", "message" => "Empréstimo cadastrado com sucesso!"]);
    } catch (Exception $e) {
        $banco->rollback();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

    $banco->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método não permitido!"]);
}
