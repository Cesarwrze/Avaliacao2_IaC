<?php
include '../conexao.php';

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "ID inválido ou não fornecido.";
    exit;
}

$id = intval($_POST['id']);
$banco = abrirBanco();

$sql = "
    SELECT 
        emprestimo.id, 
        emprestimo.data_emprestimo, 
        insumo.nome AS insumo_nome, 
        insumo.emprestavel, 
        emprestimo.previsao_devolucao, 
        usuarios_supervisor.nome AS supervisor_nome, 
        usuarios_requisitante.nome AS requisitante_nome,
        emprestimo.quantidade,
        d.id AS devolucao_id,
        emprestimo.ultima_atualizacao
    FROM 
        emprestimo
    LEFT JOIN insumo ON emprestimo.insumo = insumo.id
    LEFT JOIN usuarios AS usuarios_supervisor ON emprestimo.supervisor = usuarios_supervisor.id
    LEFT JOIN usuarios AS usuarios_requisitante ON emprestimo.requisitante = usuarios_requisitante.id
    LEFT JOIN devolucao AS d ON d.idEmprestimo = emprestimo.id
    WHERE 
        emprestimo.id = ?";

$stmt = $banco->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {


        // FORMATAÇÃO DE DATAS
        function formatarData($data, $temHora = false, $campo = '')
        {
            if ($campo === 'previsao_devolucao' && (!$data || $data === '0000-00-00' || $data === '0000-00-00 00:00:00')) {
                return "Sem data de devolução"; // Retorna "Sem data de devolução" apenas para o campo de devolução
            }

            // Caso específico para a Última Atualização
            if ($campo === 'ultima_atualizacao' && ($data === null || $data === '')) {
                return ''; // Retorna vazio se o valor da data for NULL ou vazio
            }

            // Se não for para data de devolução ou última atualização, formata a data normalmente
            $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y';
            return (new DateTime($data))->format($formato);
        }

        // echo "<p><strong>ID:</strong> {$row['id']}</p>";
        echo "<p><strong>Data de Empréstimo:</strong> " . formatarData($row['data_emprestimo'], false) . "</p>";
        echo "<p><strong>Insumo:</strong> {$row['insumo_nome']}</p>";
        echo "<p><strong>Emprestável:</strong> {$row['emprestavel']}</p>";
        echo "<p><strong>Previsão de Devolução:</strong> " . formatarData($row['previsao_devolucao'], false, 'previsao_devolucao') . "</p>";
        echo "<p><strong>Supervisor:</strong> {$row['supervisor_nome']}</p>";
        echo "<p><strong>Requisitante:</strong> {$row['requisitante_nome']}</p>";
        echo "<p><strong>Quantidade:</strong> {$row['quantidade']}</p>";

        if (!empty($row['devolucao_id'])) {
            echo "<p><strong>Devolução:</strong> Há devolução vinculada</p>";
        } else {
            echo "<p><strong>Devolução:</strong> Nenhuma devolução registrada</p>";
        }

        echo "<p><strong>Última Atualização:</strong> " . formatarData($row['ultima_atualizacao'], true, 'ultima_atualizacao') . "</p>";
    } else {
        echo "Registro não encontrado.";
    }

    $stmt->close();
} else {
    echo "Erro ao preparar a consulta: " . $banco->error;
}

$banco->close();
