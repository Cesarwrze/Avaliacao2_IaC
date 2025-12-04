<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $banco = abrirBanco();

    if ($banco) {
        $sql = "SELECT id, grupo FROM grupos WHERE id = ?";
        $stmt = $banco->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($row = $resultado->fetch_assoc()) {
                echo json_encode($row);
            } else {
                echo json_encode(["error" => "Grupo não encontrado."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Erro ao preparar a consulta: " . $banco->error]);
        }

        $banco->close();
    } else {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
    }
} else {
    echo json_encode(["error" => "ID inválido ou não fornecido."]);
}
