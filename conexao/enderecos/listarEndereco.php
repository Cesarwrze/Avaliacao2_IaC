<?php
include('../conexao.php');
$banco = abrirBanco();

$sql = "SELECT * FROM enderecos ORDER BY id DESC";
$resultado = $banco->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$row['rua']}</td>
                <td>{$row['numero']}</td>
                <td>{$row['cidade']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['cep']}</td>
                <td class='text-center'>
                    <button class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button>
                    <button class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button>
                    <button class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Nenhum endereço encontrado.</td></tr>";
}
$banco->close();
?>