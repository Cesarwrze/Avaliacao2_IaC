<?php
include '../conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || !isset($_POST['grupo'])) {
        echo json_encode(["error" => "Dados insuficientes para atualização."]);
        exit;
    }

    $id = intval($_POST['id']);
    $grupo = trim($_POST['grupo']);

    if (empty($id) || empty($grupo)) {
        echo json_encode(["error" => "Os campos ID e Grupo são obrigatórios."]);
        exit;
    }

    // Define o fuso horário para São Paulo
    date_default_timezone_set('America/Sao_Paulo');
    $ultimaAtualizacao = date("Y-m-d H:i:s"); // Obtém a data e hora atuais

    $banco = abrirBanco();

    if ($banco) {
        $sql = "UPDATE grupos SET grupo = ?, ultima_atualizacao = ? WHERE id = ?";
        $stmt = $banco->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssi", $grupo, $ultimaAtualizacao, $id);

            if ($stmt->execute()) {
                echo json_encode([
                    "success" => "Grupo atualizado com sucesso.",
                    "ultima_atualizacao" => $ultimaAtualizacao
                ]);
            } else {
                echo json_encode(["error" => "Erro ao atualizar os dados: " . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Erro na preparação da consulta SQL."]);
        }

        $banco->close();
    } else {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
    }
} else {
    echo json_encode(["error" => "Requisição inválida."]);
}
