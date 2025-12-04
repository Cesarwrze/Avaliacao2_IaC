<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    // Dados recebidos do formulário
    $data_cadastro = $_POST['data_cadastro'];
    $nome = $_POST['nome'];
    $emprestavel = $_POST['emprestavel'];
    $ambiente = $_POST['ambiente'] ?? null;
    $grupo = $_POST['grupo'] ?? null;
    $container = $_POST['container'];
    $divisao = $_POST['divisao'];
    $quantidade = $_POST['quantidade'];
    $descricao = $_POST['descricao'];
    $detalhes = $_POST['detalhes'];


    //error_log("Valor recebido para emprestável: $emprestavel"); //debug

    // Verificar se o nome do insumo já existe no banco de dados
    $stmt = $banco->prepare("SELECT COUNT(*) FROM insumo WHERE nome = ?");
    if (!$stmt) {
        echo "0|Erro na preparação da consulta: " . $banco->error;
        exit;
    }

    $stmt->bind_param("s", $nome);
    if (!$stmt->execute()) {
        echo "0|Erro na execução da consulta: " . $stmt->error;
        exit;
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // Insumo já existe
        echo "0|O insumo informado já está cadastrado!";
        exit;
    }

    // Inserir novo insumo
    $stmt = $banco->prepare("INSERT INTO insumo (data_cadastro, nome, emprestavel, ambiente, grupo, container, divisao, quantidade, descricao, detalhes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "0|Erro na preparação da consulta de inserção: " . $banco->error;
        exit;
    }

    $stmt->bind_param("ssssssdsss", $data_cadastro, $nome, $emprestavel, $ambiente, $grupo, $container, $divisao, $quantidade, $descricao, $detalhes);
    if ($stmt->execute()) {
        echo "1|Insumo cadastrado com sucesso!";
    } else {
        echo "0|Erro ao cadastrar o insumo: " . $stmt->error;
    }

    $stmt->close();
    $banco->close();
} else {
    echo "0|Método não permitido!";
    exit;
}
