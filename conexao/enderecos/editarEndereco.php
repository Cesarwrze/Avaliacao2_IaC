<?php
include('../conexao.php');
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $banco = abrirBanco();
    $stmt = $banco->prepare("SELECT * FROM enderecos WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Endereço não encontrado']);
    }
    $banco->close();
}
?>