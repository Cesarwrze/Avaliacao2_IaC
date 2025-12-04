<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$ambiente = $_POST['ambiente'];
    $ambiente = trim($_POST['ambiente']);

    $banco = abrirBanco();

    // Verificar se o ambiente já existe no banco de dados
    $stmtVerifica = $banco->prepare("SELECT COUNT(*) FROM ambientes WHERE ambiente = ?");
    if (!$stmtVerifica) {
        echo "0|Erro na preparação da verificação: " . $banco->error;
        exit;
    }
    $stmtVerifica->bind_param("s", $ambiente);
    $stmtVerifica->execute();
    $stmtVerifica->bind_result($count);
    $stmtVerifica->fetch();
    $stmtVerifica->close();

    if ($count > 0) {
        echo "0|O ambiente informado já está cadastrado!";
        exit;
    }

    // Insere novo ambiente
    $stmtInsert = $banco->prepare("INSERT INTO ambientes (ambiente) VALUES (?)");
    if (!$stmtInsert) {
        echo "0|Erro na preparação do insert: " . $banco->error;
        exit;
    }

    $stmtInsert->bind_param("s", $ambiente);
    if ($stmtInsert->execute()) {
        echo "1|Ambiente cadastrado com sucesso!";
    } else {
        echo "0|Erro ao cadastrar: " . $stmtInsert->error;
    }

    $stmtInsert->close();
    $banco->close();
} else {
    echo "0|Requisição inválida";
}
