<?php
include '../conexao.php';

if (isset($_POST['ambiente'])) {
    $ambiente = $_POST['ambiente'];

    $banco = abrirBanco();

    function formatarData($data)
    {
        return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
    }

    $sql = "SELECT * FROM ambientes WHERE ambiente LIKE ?";
    $stmt = $banco->prepare($sql);
    $ambienteLike = "%$ambiente%";
    $stmt->bind_param("s", $ambienteLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$row['ambiente']}</td>
                <td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
                <td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
                <td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Nenhum registro encontrado.</td></tr>";
    }

    $stmt->close();
    $banco->close();
} else {
    echo "<tr><td colspan='8' class='text-center'>Erro: Nenhum ambiente fornecido.</td></tr>";
}
