<?php
session_start();
include 'conexao.php';

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$banco = abrirBanco();

if ($banco->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Erro na conexão com o banco de dados.']);
    exit();
}

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $banco->real_escape_string($_POST['usuario']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM usuarios WHERE login = ? LIMIT 1";
    $stmt = $banco->prepare($query);

    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao preparar a consulta.']);
        exit();
    }

    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario_db = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario_db['senha'])) {
            // ✅ Cria a sessão corretamente aqui
            $_SESSION['usuario'] = $usuario_db['login'];

            echo json_encode(['status' => 'success', 'message' => 'Login bem-sucedido']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Senha incorreta']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuário não encontrado']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Dados incompletos']);
}

$banco->close();
