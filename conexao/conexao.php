<?php


function abrirBanco()
{
    $conexao = new mysqli("localhost", "root", "", "db_lab_eletronica");
    return $conexao;
}




### Função para redirecionar
function voltarIndex()
{
    header("location:home.php");
}
