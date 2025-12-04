<?php

include '../conexao.php';

if (isset($_POST['insumo'])) {
    $insumo = $_POST['insumo'];

    $banco = abrirBanco();

    // Definir a função FORA do loop para evitar a redefinição
    function formatarData($data)
    {
        return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
    }

    $sql = "
        SELECT 
            emprestimo.id, 
            usuarios_requisitante.nome AS requisitante_nome, 
            emprestimo.data_emprestimo, 
            insumo.nome AS insumo_nome,
            usuarios_supervisor.nome AS supervisor_nome,
            emprestimo.quantidade
        FROM 
            emprestimo
        JOIN usuarios AS usuarios_requisitante ON emprestimo.requisitante = usuarios_requisitante.id
        JOIN usuarios AS usuarios_supervisor ON emprestimo.supervisor = usuarios_supervisor.id
        JOIN insumo ON emprestimo.insumo = insumo.id
        
        WHERE 
            insumo.nome LIKE ?
    ";

    $stmt = $banco->prepare($sql);
    $insumoLike = "%$insumo%";
    $stmt->bind_param("s", $insumoLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    // Retorna o resultado da pesquisa
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {

            // Aplicando a formatação corretamente
            $dataEmprestimo = formatarData($row['data_emprestimo']);

            echo "<tr>
<td>{$row['requisitante_nome']}</td>
<td>{$dataEmprestimo}</td>
<td>{$row['insumo_nome']}</td>
<td>{$row['supervisor_nome']}</td>
<td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
<td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
<td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>
</tr>";
        }
    } else {
        echo "<tr><td colspan='10' class='text-center'>Nenhum registro encontrado.</td></tr>";
    }

    $stmt->close();
    $banco->close();
} else {
    echo "<tr><td colspan='10' class='text-center'>Erro: Nenhum insumo fornecido.</td></tr>";
}
