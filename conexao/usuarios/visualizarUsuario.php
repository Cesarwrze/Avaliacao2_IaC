<?php
include '../conexao.php';

//if (isset($_POST['id'])) {
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "ID inválido ou não fornecido.";
    exit;
}

$id = $_POST['id'];
$banco = abrirBanco();

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $banco->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($row = $resultado->fetch_assoc()) {
    
// Função para formatar datas corretamente
function formatarData($data, $temHora = false) {
    if (!$data) return "Não informada"; // Caso a data seja NULL ou vazia
    $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y'; // Define o formato baseado na presença da hora
    return (new DateTime($data))->format($formato);
}

    //echo "<p><strong>ID:</strong> {$row['id']}</p>";
    echo "<p><strong>Data Cadastro:</strong> " . formatarData($row['data_cadastro'], false) . "</p>";
    echo "<p><strong>Nome:</strong> {$row['nome']}</p>";
    echo "<p><strong>RA:</strong> {$row['ra']}</p>";
    echo "<p><strong>Área:</strong> {$row['area']}</p>";
    echo "<p><strong>Email:</strong> {$row['email']}</p>";
    echo "<p><strong>Telefone:</strong> {$row['telefone']}</p>";
    echo "<p><strong>Login:</strong> {$row['login']}</p>";
    echo "<p><strong>Última Atualização:</strong> " . formatarData($row['ultima_atualizacao'], true) . "</p>"; // Data + Hora
} else {
    echo "Registro não encontrado.";
}

$stmt->close();
$banco->close();
?>

