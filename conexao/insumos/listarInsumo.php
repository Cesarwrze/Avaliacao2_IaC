<?php

include '../conexao.php';
$banco = abrirBanco();

function formatarData($data)
{
  return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
}

$sql = "SELECT * FROM insumo";
$resultado = $banco->query($sql);

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

$banco->close();
