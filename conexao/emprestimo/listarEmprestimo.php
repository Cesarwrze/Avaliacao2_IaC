<?php
include '../conexao.php';
$banco = abrirBanco();

// Definir a função FORA do loop para evitar a redefinição
function formatarData($data)
{
    return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
}

$sql = "
    SELECT 
        e.id, 
        usuarios_requisitante.nome AS requisitante_nome, 
        e.data_emprestimo, 
        i.nome AS insumo_nome,
        usuarios_supervisor.nome AS supervisor_nome,
        e.quantidade

    FROM emprestimo e

    LEFT JOIN usuarios AS usuarios_requisitante ON e.requisitante = usuarios_requisitante.id
    LEFT JOIN usuarios AS usuarios_supervisor ON e.supervisor = usuarios_supervisor.id
    LEFT JOIN insumo i ON e.insumo = i.id";

$resultado = $banco->query($sql);

//debug
if (!$resultado) {
    die("Erro na query: " . $banco->error);
}

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        // Aplicando a formatação corretamente
        $dataEmprestimo = formatarData($row['data_emprestimo']);

        echo "
            <tr>
                <td>{$row['requisitante_nome']}</td>
                <td>{$dataEmprestimo}</td>
                <td>{$row['insumo_nome']}</td>
                <td>{$row['supervisor_nome']}</td>
                <td><button class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
                <td><button class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
                <td><button class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>Nenhum registro encontrado</td></tr>";
}

$banco->close();
