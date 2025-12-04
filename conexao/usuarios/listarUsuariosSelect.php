<?php
include '../conexao.php';

$banco = abrirBanco();
$sql = "SELECT id, nome, area FROM usuarios WHERE area IN ('Supervisor', 'Requisitante')";
$resultado = $banco->query($sql);

$usuarios = [];

while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

$banco->close();

header('Content-Type: application/json');
echo json_encode($usuarios);
