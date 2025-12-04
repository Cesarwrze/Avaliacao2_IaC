<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();
    $grupo = $_POST['grupo'];

    // Verificar se o grupo já existe no banco de dados
    $stmt = $banco->prepare("SELECT COUNT(*) FROM grupos WHERE grupo = ?");
    if (!$stmt) {
        echo "0|Erro na preparação da consulta: " . $banco->error;
        exit;
    }

    $stmt->bind_param("s", $grupo);
    if (!$stmt->execute()) {
        echo "0|Erro na execução da consulta: " . $stmt->error;
        exit;
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "0|O grupo informado já está cadastrado!";
        exit;
    }

    // Inserir novo grupo
    $stmt = $banco->prepare("INSERT INTO grupos (grupo) VALUES (?)");
    if (!$stmt) {
        echo "0|Erro na preparação da consulta de inserção: " . $banco->error;
        exit;
    }

    $stmt->bind_param("s", $grupo);
    if ($stmt->execute()) {
        echo "1|Grupo cadastrado com sucesso!";
    } else {
        echo "0|Erro ao cadastrar o grupo: " . $stmt->error;
    }

    $stmt->close();
    $banco->close();
} else {
    echo "0|Método não permitido!";
    exit;
}
