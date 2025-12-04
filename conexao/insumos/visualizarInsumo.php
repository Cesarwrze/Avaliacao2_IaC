<?php
include '../conexao.php';

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "ID inválido ou não fornecido.";
    exit;
}

$id = $_POST['id'];
$banco = abrirBanco();

$sql = "
    SELECT 
        insumo.id, 
        insumo.data_cadastro, 
        insumo.nome, 
        insumo.emprestavel, 
        ambientes.ambiente AS ambiente_nome, 
        grupos.grupo AS grupo_nome, 
        insumo.container, 
        insumo.divisao, 
        insumo.descricao, 
        insumo.detalhes, 
        insumo.quantidade,
        insumo.ultima_atualizacao
    FROM 
        insumo
    LEFT JOIN 
        ambientes ON insumo.ambiente = ambientes.id
    LEFT JOIN 
        grupos ON insumo.grupo = grupos.id
    WHERE 
        insumo.id = ?";

$stmt = $banco->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($row = $resultado->fetch_assoc()) {

    function formatarData($data, $temHora = false)
    {
        if (!$data) return "Não informada"; // Caso a data seja NULL ou vazia
        $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y'; // Define o formato baseado na presença da hora
        return (new DateTime($data))->format($formato);
    }

    //echo "<p><strong>ID:</strong> {$row['id']}</p>";
    echo "<p><strong>Data Cadastro:</strong> " . formatarData($row['data_cadastro'], false) . "</p>";
    echo "<p><strong>Nome:</strong> {$row['nome']}</p>";
    echo "<p><strong>Emprestável:</strong> {$row['emprestavel']}</p>";
    echo "<p><strong>Quantidade:</strong> {$row['quantidade']}</p>";
    echo "<p><strong>Ambiente:</strong> {$row['ambiente_nome']}</p>";
    echo "<p><strong>Grupo:</strong> {$row['grupo_nome']}</p>";
    echo "<p><strong>Container:</strong> {$row['container']}</p>";
    echo "<p><strong>Divisão:</strong> {$row['divisao']}</p>";
    echo "<p><strong>Descrição:</strong> {$row['descricao']}</p>";
    echo "<p><strong>Detalhes:</strong> {$row['detalhes']}</p>";
    echo "<p><strong>Última Atualização:</strong> " . formatarData($row['ultima_atualizacao'], true) . "</p>";
} else {
    echo "Registro não encontrado.";
}


$stmt->close();
$banco->close();
