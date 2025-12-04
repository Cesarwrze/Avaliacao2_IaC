<?php
include '../conexao.php';

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';


if ($isAjax) {
    header('Content-Type: application/json');
}

$banco = abrirBanco();

if (!$banco) {
    $erro = ["error" => "Erro ao conectar ao banco de dados."];
    echo $isAjax ? json_encode($erro) : "<tr><td colspan='4'>{$erro['error']}</td></tr>";
    exit;
}

$sql = "SELECT id, grupo, data_criacao FROM grupos";
$resultado = $banco->query($sql);

if ($resultado) {
    $grupos = [];

    while ($row = $resultado->fetch_assoc()) {
        $dataCadastro = !empty($row['data_criacao'])
            ? DateTime::createFromFormat('Y-m-d', $row['data_criacao'])->format('d/m/Y')
            : 'Não informado';

        if ($isAjax) {
            $grupos[] = [
                "id" => $row["id"],
                "grupo" => $row["grupo"],
                "data_criacao" => $dataCadastro
            ];
        } else {
            echo "<tr>
                    <td>{$row['grupo']}</td>
                    <td><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
                    <td><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
                    <td><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>            
                  </tr>";
        }
    }

    if ($isAjax) {
        echo json_encode($grupos);
    }
} else {
    $erro = ["error" => "Erro ao buscar grupos: " . $banco->error];
    echo $isAjax ? json_encode($erro) : "<tr><td colspan='4'>{$erro['error']}</td></tr>";
}

$banco->close();
