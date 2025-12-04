<?php
include '../conexao.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $banco = abrirBanco();

    if ($banco) {
        $sql = "SELECT i.id, i.nome, i.emprestavel, i.ambiente AS ambiente_id, a.ambiente AS ambiente_nome,
                       i.grupo AS grupo_id, g.grupo AS grupo_nome, 
                       i.container, i.divisao, i.quantidade, i.descricao, i.detalhes
                FROM insumo i
                LEFT JOIN ambientes a ON i.ambiente = a.id
                LEFT JOIN grupos g ON i.grupo = g.id
                WHERE i.id = ?";

        $stmt = $banco->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            if ($row = $resultado->fetch_assoc()) {
                echo json_encode($row);
            } else {
                echo json_encode(["error" => "Insumo não encontrado."]);
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
    echo json_encode(["error" => "ID inválido ou não fornecido."]);
}
