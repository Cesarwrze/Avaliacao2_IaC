<?php
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $sql = "INSERT INTO enderecos (rua, numero, cidade, estado, cep) VALUES (?, ?, ?, ?, ?)";
    $stmt = $banco->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $rua, $numero, $cidade, $estado, $cep);
        if ($stmt->execute()) {
            echo "1|Endereço cadastrado com sucesso!";
        } else {
            echo "0|Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "0|Erro no banco de dados.";
    }
    $banco->close();
}
?>