<?php

include('../conexao.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    // Dados do formulário
    $id = $_POST['id'] ?? null;
    $data_emprestimo = $_POST['data_emprestimo'] ?? null;
    $insumo_novo = $_POST['insumo'] ?? null;
    $insumo_anterior = $_POST['insumo_anterior'] ?? null;
    $emprestavel = $_POST['emprestavel'] ?? null;
    $previsao_devolucao = $_POST['previsao_devolucao'] ?? null;
    $supervisor = $_POST['supervisor'] ?? null;
    $requisitante = $_POST['requisitante'] ?? null;
    $quantidade_nova = isset($_POST['quantidade'])
        ? floatval(str_replace(',', '.', $_POST['quantidade']))
        : null;

    if (!$id || !$data_emprestimo || !$insumo_novo || !$supervisor || !$requisitante) {
        echo json_encode(["status" => "error", "message" => "Por favor, preencha todos os campos obrigatórios!"]);
        exit;
    }

    if ($emprestavel === 'Sim' && empty($previsao_devolucao)) {
        echo json_encode(["status" => "error", "message" => "A previsão de devolução é obrigatória para itens emprestáveis."]);
        exit;
    }

    if ($emprestavel === 'Não') {
        $previsao_devolucao = null;
    }

    // Buscar empréstimo anterior
    $stmt = $banco->prepare("SELECT insumo, quantidade FROM emprestimo WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($insumo_antigo, $quantidade_antiga);
    $stmt->fetch();
    $stmt->close();


    if ($insumo_antigo != $insumo_novo) {
        // Devolve o estoque antigo
        $stmt = $banco->prepare("UPDATE insumo SET quantidade = quantidade + ? WHERE id = ?");
        $stmt->bind_param("di", $quantidade_antiga, $insumo_antigo);
        $stmt->execute();
        $stmt->close();

        //Verifica estoque do novo insumo
        $stmt = $banco->prepare("SELECT quantidade FROM insumo WHERE id = ?");
        $stmt->bind_param("i", $insumo_novo);
        $stmt->execute();
        $stmt->bind_result($estoque_atual);
        $stmt->fetch();
        $stmt->close();

        if ($quantidade_nova > floatval($estoque_atual)) {
            echo json_encode([
                "status" => "error",
                "message" => "Estoque insuficiente para o novo insumo.",
                "debug" => [
                    "solicitado" => $quantidade_nova,
                    "disponivel" => $estoque_atual,
                    "id_insumo" => $insumo_novo
                ]
            ]);
            exit;
        }

        // Baixa do novo insumo
        $stmt = $banco->prepare("UPDATE insumo SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->bind_param("di", $quantidade_nova, $insumo_novo);
        $stmt->execute();
        $stmt->close();
    } else {
        // Se manteve o mesmo insumo, ajusta a diferença de quantidade
        $diferenca = $quantidade_nova - $quantidade_antiga;

        if ($diferenca != 0) {
            // Validar se pode tirar mais
            if ($diferenca > 0) {
                $stmt = $banco->prepare("SELECT quantidade FROM insumo WHERE id = ?");
                $stmt->bind_param("i", $insumo_novo);
                $stmt->execute();
                $stmt->bind_result($estoque_atual);
                $stmt->fetch();
                $stmt->close();

                if ($diferenca > floatval($estoque_atual)) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Quantidade solicitada maior do que o estoque disponível!",
                        "debug" => [
                            "diferenca" => $diferenca,
                            "estoque_atual" => $estoque_atual,
                            "id_insumo" => $insumo_novo
                        ]
                    ]);
                    exit;
                }
            }

            $operacao = $diferenca > 0 ? "-" : "+";
            $absDiff = abs($diferenca);
            $stmt = $banco->prepare("UPDATE insumo SET quantidade = quantidade {$operacao} ? WHERE id = ?");
            $stmt->bind_param("di", $absDiff, $insumo_novo);
            $stmt->execute();
            $stmt->close();
        }
    }


    // Atualizar empréstimo
    $stmt = $banco->prepare("
        UPDATE emprestimo 
        SET data_emprestimo = ?, 
            insumo = ?, 
            emprestavel = ?, 
            previsao_devolucao = ?, 
            supervisor = ?, 
            requisitante = ?, 
            quantidade = ?, 
            ultima_atualizacao = NOW() 
        WHERE id = ?
    ");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Erro na preparação da consulta: " . $banco->error]);
        exit;
    }

    $stmt->bind_param(
        "ssssssii",
        $data_emprestimo,
        $insumo_novo,
        $emprestavel,
        $previsao_devolucao,
        $supervisor,
        $requisitante,
        $quantidade_nova,
        $id
    );

    if ($stmt->execute()) {
        //    echo json_encode(["status" => "success", "message" => "Registro de empréstimo atualizado com sucesso!"]);
        echo json_encode([
            "status" => "success",
            "message" => "Registro de empréstimo atualizado com sucesso!"
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erro ao atualizar o registro: " . $stmt->error]);
    }

    $stmt->close();
    $banco->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método não permitido!"]);
    exit;
}
