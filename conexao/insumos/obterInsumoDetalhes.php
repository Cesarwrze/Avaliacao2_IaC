<?php

include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();
    $id = intval($_POST['id']); // Sanitiza o ID recebido

    // Consulta SQL para buscar o insumo pelo ID
    $sql = "SELECT id, nome, data_cadastro, emprestavel, quantidade FROM insumo WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $insumo = $resultado->fetch_assoc();
        echo json_encode($insumo); // Retorna os dados em JSON
    } else {
        echo json_encode(['error' => 'Insumo não encontrado.']);
    }

    $stmt->close();
    $banco->close();
}
