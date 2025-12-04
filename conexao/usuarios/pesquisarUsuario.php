<?php

include '../conexao.php';

if (isset($_POST['ra'])) {
    $input = $_POST['ra'];

    $banco = abrirBanco();

    $sql = "SELECT * FROM usuarios WHERE ra LIKE ? OR nome LIKE ?";
    $stmt = $banco->prepare($sql);
    $inputLike = "%$input%";
    $stmt->bind_param("ss", $inputLike, $inputLike);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Retorna o resultado da pesquisa
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$row['nome']}</td>
                <td>{$row['ra']}</td>
                <td>{$row['email']}</td>
                <td>{$row['area']}</td>
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
    echo "<tr><td colspan='8' class='text-center'>Erro: Nenhum dado fornecido para pesquisa.</td></tr>";
}
