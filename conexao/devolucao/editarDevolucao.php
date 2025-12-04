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
        // Atualizado para buscar dados da tabela devolucao
        $sql = "SELECT 
                    d.id, 
                    d.dataDevolucao AS dataDevolucao, 
                    d.idEmprestimo, 
                    d.ultima_atualizacao, 
                    d.quantidade AS quantidade_devolvida, 
                    d.obs, 
                    insumo.nome AS insumo_nome, 
                    usuarios_requisitante.nome AS requisitante_nome,
                    e.quantidade AS quantidade_emprestada

                FROM 
                    devolucao d

                LEFT JOIN insumo ON d.insumo = insumo.id
                LEFT JOIN usuarios AS usuarios_requisitante ON d.requisitante = usuarios_requisitante.id
                LEFT JOIN emprestimo e ON d.idEmprestimo = e.id
                WHERE 
                    d.id = ?";

        $stmt = $banco->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($row = $resultado->fetch_assoc()) {
                // Retorna os dados da devolução
                echo json_encode([
                    "id" => $row['id'],
                    "dataDevolucao" => $row['dataDevolucao'],
                    "idEmprestimo" => $row['idEmprestimo'],
                    "ultima_atualizacao" => $row['ultima_atualizacao'],
                    "quantidade_devolvida" => $row['quantidade_devolvida'],
                    "obs" => $row['obs'],
                    "insumo_nome" => $row['insumo_nome'],
                    "requisitante_nome" => $row['requisitante_nome'],
                    "quantidade_emprestada" => $row['quantidade_emprestada']
                ]);
            } else {
                echo json_encode(["error" => "Registro de devolução não encontrado."]);
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
