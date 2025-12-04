<?php
include '../conexao.php';
$banco = abrirBanco();

$filtro = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT 
            emprestimo.id, 
            usuarios.id AS requisitante_id,
            usuarios.nome AS requisitante, 
            usuarios.ra, 
            emprestimo.data_emprestimo, 
            insumo.id AS insumo_id,
            insumo.nome AS insumo, 
            emprestimo.quantidade
        FROM emprestimo
        JOIN usuarios ON emprestimo.requisitante = usuarios.id
        JOIN insumo ON emprestimo.insumo = insumo.id
        WHERE 
            (usuarios.nome LIKE ? OR usuarios.ra LIKE ?)
            AND emprestimo.status = 'ativo'
            AND insumo.emprestavel = 'Sim'";

$stmt = $banco->prepare($sql);
$param = "%{$filtro}%";
$stmt->bind_param("ss", $param, $param);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Selecionar Empréstimo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">

  <div class="container mt-4">
    <h2 class="text-center">Selecionar Empréstimo</h2>

    <div class="mb-3">
      <input id="searchEmprestimo" class="form-control" type="search" placeholder="Pesquisar por Requisitante ou RA">
    </div>

    <ul class="list-group" id="emprestimosLista">
      <?php while ($row = $resultado->fetch_assoc()) { ?>
        <li class="list-group-item text-center emprestimo-item" style="cursor:pointer;"
          data-id="<?= $row['id'] ?>"
          data-idusuario="<?= $row['requisitante_id'] ?>"
          data-requisitante="<?= htmlspecialchars($row['requisitante'], ENT_QUOTES, 'UTF-8') ?>"
          data-ra="<?= htmlspecialchars($row['ra'], ENT_QUOTES, 'UTF-8') ?>"
          data-dataemprestimo="<?= htmlspecialchars($row['data_emprestimo'], ENT_QUOTES, 'UTF-8') ?>"
          data-insumoid="<?= $row['insumo_id'] ?>"
          data-insumo="<?= htmlspecialchars($row['insumo'], ENT_QUOTES, 'UTF-8') ?>"
          data-quantidade="<?= $row['quantidade'] ?>">
          <?= htmlspecialchars($row['requisitante']) ?> (RA: <?= htmlspecialchars($row['ra']) ?>) - <?= htmlspecialchars($row['insumo']) ?> (Qtd: <?= $row['quantidade'] ?>)
        </li>
      <?php } ?>
    </ul>

    <button class="btn btn-danger mt-3 w-100" onclick="window.close()">Fechar</button>
  </div>

  <script>
    $(document).ready(function() {

      // filtra
      $("#searchEmprestimo").on("input", function() {
        const searchText = $(this).val().toLowerCase();
        $(".emprestimo-item").each(function() {
          const requisitante = $(this).data("requisitante").toLowerCase();
          const ra = $(this).data("ra").toLowerCase();
          if (requisitante.includes(searchText) || ra.includes(searchText)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });

      // clique no empréstimo para enviar ao form principal
      $(".emprestimo-item").on("click", function() {
        const idEmprestimo = $(this).data("id");
        const idUsuario = $(this).data("idusuario");
        const nomeRequisitante = $(this).data("requisitante");
        const ra = $(this).data("ra");
        const dataEmprestimo = $(this).data("dataemprestimo");
        const insumoId = $(this).data("insumoid");
        const insumo = $(this).data("insumo");
        const quantidade = $(this).data("quantidade");

        //console.log("Enviando:", { idEmprestimo, idUsuario, nomeRequisitante, ra, dataEmprestimo, insumo, quantidade });

        if (window.opener && typeof window.opener.preencherEmprestimo === 'function') {
          window.opener.preencherEmprestimo(
            idEmprestimo,
            idUsuario,
            nomeRequisitante,
            ra,
            dataEmprestimo,
            insumoId,
            insumo,
            quantidade
          );
          window.close();
        } else {
          alert("Função 'preencherEmprestimo' não encontrada na janela principal.");
        }
      });

    });
  </script>

</body>

</html>

<?php $banco->close(); ?>