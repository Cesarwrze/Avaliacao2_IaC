<?php
include '../conexao.php';

if (isset($_POST['grupo'])) {
    $grupo = $_POST['grupo'];

    $banco = abrirBanco();

    $sql = "SELECT * FROM grupos WHERE grupo LIKE ?";
    $stmt = $banco->prepare($sql);
    $grupoLike = "%$grupo%";
    $stmt->bind_param("s", $grupoLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    // Retorna o resultado da pesquisa
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$row['grupo']}</td>
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
    echo "<tr><td colspan='8' class='text-center'>Erro: Nenhum Grupo fornecido.</td></tr>";
}
