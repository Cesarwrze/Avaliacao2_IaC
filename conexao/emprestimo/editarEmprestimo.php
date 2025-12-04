<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $banco = abrirBanco();

    if ($banco) {
        $sql = "SELECT 
                    e.id, 
                    e.data_emprestimo, 
                    i.id AS insumo_id,
                    i.nome AS insumo_nome, 
                    e.emprestavel, 
                    e.previsao_devolucao, 
                    s.id AS supervisor_id,
                    s.nome AS supervisor_nome, 
                    r.id AS requisitante_id,
                    r.nome AS requisitante_nome, 
                    e.quantidade, 
                    i.quantidade AS estoque_atual,
                    d.id AS devolucao_id
                FROM emprestimo e
                LEFT JOIN insumo i ON e.insumo = i.id
                LEFT JOIN usuarios s ON e.supervisor = s.id
                LEFT JOIN usuarios r ON e.requisitante = r.id
                LEFT JOIN devolucao d ON d.idEmprestimo = e.id
                WHERE e.id = ?";

        $stmt = $banco->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            //if ($row = $resultado->fetch_assoc()) {
            if ($row = $resultado->fetch_assoc()) {
                //verifica se tem devolução
                $temDevolucao = isset($row['devolucao_id']) && $row['devolucao_id'] !== null;

                echo json_encode([
                    "id" => $row['id'],
                    "data_emprestimo" => $row['data_emprestimo'],
                    "insumo_id" => $row['insumo_id'],
                    "insumo" => $row['insumo_nome'],
                    "insumo_anterior" => $row['insumo_id'],
                    "emprestavel" => $row['emprestavel'],
                    "previsao_devolucao" => $row['previsao_devolucao'],
                    "supervisor_id" => $row['supervisor_id'],
                    "requisitante_id" => $row['requisitante_id'],
                    "supervisor" => $row['supervisor_nome'],
                    "requisitante" => $row['requisitante_nome'],
                    "quantidade" => $row['quantidade'],
                    "estoque_atual" => $row['estoque_atual'],
                    "tem_devolucao" => $temDevolucao

                ]);
            } else {
                echo json_encode(["error" => "Registro de empréstimo não encontrado."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Erro ao preparar a consulta: " . $banco->error]);
        }

        $banco->close();
    } else {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
    }
} else {
    echo json_encode(["error" => "ID inválido ou não fornecido."]);
}
