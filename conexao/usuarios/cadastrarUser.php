
<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    $dataCadastro = $_POST['dataCadastroUsuario'];
    $nomeUsuario = $_POST['nomeUsuario'];
    $raUsuario = $_POST['raUsuario'];
    $areaADM = $_POST['areaUsuario']; // ADM, Supervisor ou Requisitante
    $emailUsuario = $_POST['emailUsuario'];
    $telefoneUsuario = $_POST['telefoneUsuario'];
    $loginUsuario = $_POST['loginUsuario'];
    $senhaUsuario = $_POST['senhaUsuario'];

    // Verifica se o RA já existe
    $stmt = $banco->prepare("SELECT COUNT(*) FROM usuarios WHERE ra = ?");
    $stmt->bind_param("s", $raUsuario);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "0|O RA informado já está cadastrado!";
        exit;
    }

    // Criptografa a senha antes de salvar no banco
    $senhaHash = password_hash($senhaUsuario, PASSWORD_DEFAULT);

    // Prepara a consulta de inserção
    $stmt = $banco->prepare(
        "INSERT INTO usuarios (data_cadastro, nome, ra, area, email, telefone, login, senha) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    // Verifica se a preparação foi bem-sucedida
    if (!$stmt) {
        echo "0|Erro na preparação da consulta: " . $banco->error;
        exit;
    }

    // Associa os parâmetros à consulta
    $stmt->bind_param("ssssssss", $dataCadastro, $nomeUsuario, $raUsuario, $areaADM, $emailUsuario, $telefoneUsuario, $loginUsuario, $senhaHash);

    // Executa a consulta e verifica o resultado
    if ($stmt->execute()) {
        echo "1|Usuário cadastrado com sucesso!";
    } else {
        echo "0|Erro ao cadastrar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $banco->close();
} else {
    echo "0|Método não permitido!";
    exit;
}

?>

