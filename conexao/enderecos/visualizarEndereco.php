<?php
include('../conexao.php');
if (isset($_POST['id'])) {
    $banco = abrirBanco();
    $stmt = $banco->prepare("SELECT * FROM enderecos WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        echo "<p><strong>ID:</strong> {$row['id']}</p>";
        echo "<p><strong>Rua:</strong> {$row['rua']}</p>";
        echo "<p><strong>Número:</strong> {$row['numero']}</p>";
        echo "<p><strong>CEP:</strong> {$row['cep']}</p>";
        echo "<p><strong>Cidade:</strong> {$row['cidade']}</p>";
        echo "<p><strong>Estado:</strong> {$row['estado']}</p>";
    } else {
        echo "Endereço não encontrado.";
    }
    $banco->close();
}
?>