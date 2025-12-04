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
        -- Dados da devolução
        d.id AS devolucao_id,
        d.dataDevolucao,
        d.idEmprestimo,
        d.quantidade,
        d.obs,
        d.ultima_atualizacao AS ultima_atualizacao,
        i_devolucao.nome AS insumo_devolvido_nome,
        u_devolucao.nome AS requisitante_devolucao_nome,
        
        -- Dados do empréstimo
        e.data_emprestimo,
        e.previsao_devolucao,
        e.quantidade AS quantidade_emprestada,
        i_emprestimo.nome AS insumo_emprestimo_nome,
        u_emprestimo.nome AS requisitante_emprestimo_nome,
        s.nome AS supervisor_nome
        
    FROM 
        devolucao d
    LEFT JOIN emprestimo e ON d.idEmprestimo = e.id
    LEFT JOIN insumo i_devolucao ON d.insumo = i_devolucao.id
    LEFT JOIN usuarios u_devolucao ON d.requisitante = u_devolucao.id
    LEFT JOIN insumo i_emprestimo ON e.insumo = i_emprestimo.id
    LEFT JOIN usuarios u_emprestimo ON e.requisitante = u_emprestimo.id
    LEFT JOIN usuarios s ON e.supervisor = s.id
    WHERE 
        d.id = ?";

$stmt = $banco->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($row = $resultado->fetch_assoc()) {

        function formatarData($data, $temHora = false)
        {
            if (!$data) return ""; // Caso a data seja NULL ou vazia
            $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y'; // Define o formato baseado na presença da hora
            return (new DateTime($data))->format($formato);
        }

        echo "<h4>Dados da Devolução</h4>";
        //echo "<p><strong>ID Devolução:</strong> {$row['devolucao_id']}</p>";
        echo "<p><strong>Data da Devolução:</strong> " . formatarData($row['dataDevolucao'], false) . "</p>";
        echo "<p><strong>Insumo (Devolução):</strong> {$row['insumo_devolvido_nome']}</p>";
        //echo "<p><strong>ID Empréstimo:</strong> {$row['idEmprestimo']}</p>";
        echo "<p><strong>Quantidade Devolvida:</strong> {$row['quantidade']}</p>";
        echo "<p><strong>Observação:</strong> {$row['obs']}</p>";
        echo "<p><strong>Última Atualização:</strong> " . formatarData($row['ultima_atualizacao'], true) . "</p>"; // Data + Hora

        echo "<h4>Dados do Empréstimo</h4>";
        echo "<p><strong>Data do Empréstimo:</strong> " . formatarData($row['data_emprestimo'], false) . "</p>";
        echo "<p><strong>Previsão de Devolução:</strong> " . formatarData($row['previsao_devolucao'], false) . "</p>";
        echo "<p><strong>Insumo (Empréstimo):</strong> {$row['insumo_emprestimo_nome']}</p>";
        echo "<p><strong>Quantidade Emprestada:</strong> {$row['quantidade_emprestada']}</p>";
        echo "<p><strong>Requisitante (Empréstimo):</strong> {$row['requisitante_emprestimo_nome']}</p>";
        echo "<p><strong>Supervisor:</strong> {$row['supervisor_nome']}</p>";
    } else {
        echo "Registro não encontrado.";
    }

    $stmt->close();
} else {
    echo "Erro ao preparar a consulta: " . $banco->error;
}

$banco->close();
