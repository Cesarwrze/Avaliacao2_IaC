<?php
include("conexao.php");

if (isset($_GET['tabela']) && $_GET['tabela'] == 'ambientes') {
    $banco = abrirBanco();
    $sql = "SELECT * FROM ambientes";
    $resultado = $banco->query($sql);

    $dados = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $dados[] = $row;
    }
    echo json_encode($dados);
    $banco->close();
} else {
    echo json_encode(["erro" => "Tabela não especificada."]);
}
?>
