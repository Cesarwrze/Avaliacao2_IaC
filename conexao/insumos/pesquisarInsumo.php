<?php

include '../conexao.php';

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];

    $banco = abrirBanco();


    function formatarData($data)
    {
        return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
    }


    $sql = "SELECT * FROM insumo WHERE nome LIKE ?";
    $stmt = $banco->prepare($sql);
    $nomeLike = "%$nome%";
    $stmt->bind_param("s", $nomeLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    // Retorna o resultado da pesquisa
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {

            // Aplicando a formatação corretamente
            $dataCadastro = formatarData($row['data_cadastro']);


            echo "<tr>
            <td>{$row['nome']}</td>
            <td>{$row['quantidade']}</td>
            <td>{$row['emprestavel']}</td>
<td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
<td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
<td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>          
          </tr>";
        }
    } else {
        echo "<tr><td colspan='12' class='text-center'>Nenhum registro encontrado.</td></tr>";
    }

    $stmt->close();
    $banco->close();
} else {
    echo "<tr><td colspan='12' class='text-center'>Erro: Nenhum nome fornecido.</td></tr>";
}
