<?php
include '../conexao.php';
$banco = abrirBanco();
$sql = "SELECT * FROM usuarios";
$resultado = $banco->query($sql);

function formatarData($data, $temHora = false)
{
  if (!$data) return "Não informada"; // Caso a data seja NULL ou vazia
  $formato = $temHora ? 'd/m/Y H:i:s' : 'd/m/Y'; // Define o formato baseado na presença da hora
  return (new DateTime($data))->format($formato);
}

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


$banco->close();
