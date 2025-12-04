<?php
include '../conexao.php';

//if (isset($_POST['requisitante'])) {
//    $insumo = $_POST['requisitante'];
if (isset($_POST['requisitante']) && !empty(trim($_POST['requisitante']))) {
    $requisitante = trim($_POST['requisitante']);
    $requisitanteLike = "%$requisitante%";

    $banco = abrirBanco();

    $sql = "
        SELECT 
            devolucao.id AS devolucao_id,
            devolucao.dataDevolucao AS dataDevolucao,
            devolucao.insumo AS insumo_id,
            insumo.nome AS insumo_nome,
            devolucao.requisitante AS requisitante_id,
            usuarios_requisitante.nome AS requisitante_nome,
            devolucao.ultima_atualizacao AS devolucao_atualizacao,
            devolucao.idEmprestimo AS idEmprestimo,
            devolucao.obs AS obs
        FROM 
            devolucao
        JOIN usuarios AS usuarios_requisitante ON devolucao.requisitante = usuarios_requisitante.id
        JOIN insumo ON devolucao.insumo = insumo.id
        WHERE 
            usuarios_requisitante.nome LIKE ?

    ";

    $stmt = $banco->prepare($sql);
    $stmt->bind_param("s", $requisitanteLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
            <td>{$row['requisitante_nome']}</td/>
<td>{$row['dataDevolucao']}</td>
<td>{$row['insumo_nome']}</td>
<td>{$row['obs']}</td>
<td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['devolucao_id']}'>Visualizar</button></td>
<td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['devolucao_id']}'>Editar</button></td>
<td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['devolucao_id']}'>Excluir</button></td>
</tr>";
        }
    } else {
        echo "<tr><td colspan='9' class='text-center'>Nenhum registro encontrado para o requisitante informado.</td></tr>";
    }

    $stmt->close();
    $banco->close();
} else {
    echo "<tr><td colspan='9' class='text-center'>Erro: Nenhum requisitante fornecido.</td></tr>";
}
