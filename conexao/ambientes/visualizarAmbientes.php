<?php
include '../conexao.php';

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "ID inválido ou não fornecido.";
    exit;
}

$id = $_POST['id'];
$banco = abrirBanco();

$sql = "SELECT * FROM ambientes WHERE id = ?";
$stmt = $banco->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($row = $resultado->fetch_assoc()) {
    // Função para formatar datas corretamente
    function formatarData($data, $temHora = false)
    {
        if (!$data) return ""; // Data NULL ou vazia
        $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y';
        return (new DateTime($data))->format($formato);
    }

    //echo "<p><strong>ID:</strong> {$row['id']}</p>";
    echo "<p><strong>Ambiente:</strong> {$row['ambiente']}</p>";
    echo "<p><strong>Data Cadastro:</strong> " . formatarData($row['data_criacao'], false) . "</p>";
    echo "<p><strong>Última Atualização:</strong> " . formatarData($row['ultima_atualizacao'], true) . "</p>";
} else {
    echo "Registro não encontrado.";
}

$stmt->close();
$banco->close();
