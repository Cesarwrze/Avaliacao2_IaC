<?php
include '../conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $banco = abrirBanco();

    if ($banco) {
        $sql = "SELECT id, ambiente FROM ambientes WHERE id = ?";
        $stmt = $banco->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($row = $resultado->fetch_assoc()) {
                echo json_encode($row);
            } else {
                echo json_encode(["error" => "Ambiente não encontrado."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Erro na consulta SQL: " . $banco->error]);
        }

        $banco->close();
    } else {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
    }
} else {
    echo json_encode(["error" => "Requisição inválida."]);
}
