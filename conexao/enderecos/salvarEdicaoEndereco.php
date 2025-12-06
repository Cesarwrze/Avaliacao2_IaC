<?php
include('../conexao.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    $id = intval($_POST['id']);
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $sql = "UPDATE enderecos SET rua=?, numero=?, cidade=?, estado=?, cep=? WHERE id=?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("sssssi", $rua, $numero, $cidade, $estado, $cep, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Endereço atualizado com sucesso!']);
    } else {
        echo json_encode(['error' => 'Erro ao atualizar: ' . $stmt->error]);
    }
    $banco->close();
}
?>