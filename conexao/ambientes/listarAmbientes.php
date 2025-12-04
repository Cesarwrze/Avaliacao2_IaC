<?php
include '../conexao.php';

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($isAjax) {
    header('Content-Type: application/json');
}

$banco = abrirBanco();

if ($banco) {
    $sql = "SELECT id, ambiente, data_criacao FROM ambientes";
    $resultado = $banco->query($sql);

    if ($resultado) {
        $ambientes = [];

        while ($row = $resultado->fetch_assoc()) {
            $dataCadastro = !empty($row['data_criacao'])
                ? (new DateTime($row['data_criacao']))->format('d/m/Y H:i')
                : 'Não informado';

            if ($isAjax) {
                $ambientes[] = [
                    "id" => $row["id"],
                    "ambiente" => $row["ambiente"],
                    "data_criacao" => $dataCadastro
                ];
            } else {
                echo "<tr>
                        <td>{$row['ambiente']}</td>
                        <td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
                        <td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
                        <td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>            
                      </tr>";
            }
        }

        if ($isAjax) {
            echo json_encode($ambientes);
        }
    } else {
        if ($isAjax) {
            echo json_encode(["error" => "Erro ao buscar ambientes: " . $banco->error]);
        } else {
            echo "<tr><td colspan='4'>Erro ao buscar ambientes: " . $banco->error . "</td></tr>";
        }
    }

    $banco->close();
} else {
    if ($isAjax) {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
    } else {
        echo "<tr><td colspan='4'>Erro ao conectar ao banco de dados.</td></tr>";
    }
}
