<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$dataCadastro = $_POST['dataCadastroUsuario'];
$nomeUsuario = $_POST['nomeUsuario'];
$raUsuario = $_POST['raUsuario'];
$areaADM = $_POST['areaUsuario'];
$emailUsuario = $_POST['emailUsuario'];
$telefoneUsuario = $_POST['telefoneUsuario'];
$loginUsuario = $_POST['loginUsuario'];
$senhaUsuario = $_POST['senhaUsuario'];

$con = new mysqli("localhost", "root", "", "gestao_estoque");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Verifica se o RA já existe no banco
$checkRA = "SELECT COUNT(*) AS total FROM usuarios WHERE raUsuario = '$raUsuario'";
$result = $con->query($checkRA);
$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    echo "0|RA já cadastrado!";
} else {
    // Insere o novo usuário
    $qli = "INSERT INTO usuarios VALUES (NULL,'$dataCadastro','$nomeUsuario','$raUsuario','$areaADM','$emailUsuario','$telefoneUsuario','$loginUsuario','$senhaUsuario')";

    if ($con->query($qli) === TRUE) {
        echo "1|Cadastro realizado com sucesso";
    } else {
        echo "0|Erro ao cadastrar: " . $con->error;
    }
}

$con->close();
?>
