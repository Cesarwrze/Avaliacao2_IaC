<?php
include '../conexao.php';
$banco = abrirBanco();

try {
    $banco->set_charset("utf8mb4");

    $sql = "
        SELECT 
            e.id AS emprestimo_id,
            i.nome AS insumo_nome,
            r.nome AS requisitante_nome,
            e.quantidade AS quantidade_emprestada
        FROM 
            emprestimo e
        LEFT JOIN usuarios r ON e.requisitante = r.id
        LEFT JOIN insumo i ON e.insumo = i.id

        WHERE e.status = 'ativo' AND i.emprestavel = 'Sim'
    ";

    $resultado = $banco->query($sql);

    $emprestimos = [];

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $emprestimos[] = [
                'id' => $row['emprestimo_id'],
                'requisitante' => $row['requisitante_nome'] ?: 'Sem Nome',
                'insumo' => $row['insumo_nome'] ?: 'Sem Insumo',
                'quantidade' => intval($row['quantidade_emprestada'])
            ];
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($emprestimos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
} catch (Exception $e) {
    echo json_encode(['error' => 'Erro ao buscar empréstimos: ' . $e->getMessage()]);
} finally {
    $banco->close();
}
