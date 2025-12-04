<?php
include '../conexao.php';
$banco = abrirBanco();

$sql = "
    SELECT 
        d.id AS devolucao_id, 
        u.nome AS requisitante_nome, 
        d.dataDevolucao, 
        i.nome AS insumo_nome,
        d.idEmprestimo AS emprestimo_id,
        d.quantidade AS quantidade_devolvida,
        d.ultima_atualizacao,
        d.obs,
        e.quantidade AS quantidade_emprestada,
        e.previsao_devolucao
    FROM 
        devolucao d
    LEFT JOIN emprestimo e ON d.idEmprestimo = e.id
    LEFT JOIN usuarios u ON d.requisitante = u.id
    LEFT JOIN insumo i ON d.insumo = i.id
    ORDER BY d.dataDevolucao DESC
";

$resultado = $banco->query($sql);

// formata datas 
function formatarData($data)
{
    return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
}

// Verifica os registros
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {

        $dataDevolucao = formatarData($row['dataDevolucao']);
        $previsaoDevolucao = formatarData($row['previsao_devolucao']);

        echo "
        <tr>
            <td>{$row['requisitante_nome']}</td>
            <td>{$dataDevolucao}</td>
            <td>{$row['insumo_nome']}</td>
            <td>{$row['obs']}</td>
            <td><button class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['devolucao_id']}'>Visualizar</button></td>
            <td><button class='btn btn-success btn-sm btn-editar' data-id='{$row['devolucao_id']}'>Editar</button></td>
            <td><button class='btn btn-danger btn-sm btn-excluir' data-id='{$row['devolucao_id']}'>Excluir</button></td>
        </tr>
        ";
    }
} else {
    echo "<tr><td colspan='7'>Nenhum registro encontrado</td></tr>";
}

$banco->close();
