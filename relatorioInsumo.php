<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Relatório - Mais Consumidos</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./emprestimo_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <meta name="theme-color" content="#712cf9">

  <style>
    thead.thead-dark th {
      background-color: black;
      color: white;
    }

    body {
      padding-top: 56px;
    }

    .table {
      margin-top: 0;
    }

    .navbar {
      margin-bottom: 0;
    }
    
    @media print {
        .navbar, .btn-imprimir {
            display: none !important;
        }
        body {
            padding-top: 0;
        }
    }
  </style>
</head>

<body class="bg-body-tertiary">

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php" style="color:white">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="manutencao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="color:white;">Manutenção</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
            <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
            <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
            <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
            <a class="dropdown-item" href="cadastroEnderecos.php">Endereços</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="movimentacao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="color:white;">Movimentação</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="devolucao.php">Devolução</a>
            <a class="dropdown-item" href="emprestimo.php">Empréstimo</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="relatorios" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false" style="color:white;">Relatórios</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="relatorioMovimentacao.php">Movimentações Gerais</a>
            <a class="dropdown-item" href="inventario.php">Inventário</a>
            <a class="dropdown-item" href="relatorioInsumo.php">Mais Consumidos</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contatos.php" style="color:white;">Contatos</a>
        </li>
      </ul>

      <div class="d-flex align-items-center ms-auto">
         <span class="text-white mr-3" style="margin-right: 15px;">TOP 20 Insumos</span>
         
         <button onclick="window.print()" class="btn btn-outline-light btn-sm me-3 btn-imprimir" title="Imprimir Relatório">
            <i class="bi bi-printer-fill"></i> Imprimir
         </button>
      </div>

      <a class="btn btn-outline-light" href="logout.php">Sair</a>
    </div>
  </nav>

  <div class="container-fluid mt-3 mb-3 text-center">
      <h4>Insumos Mais Consumidos (Ranking)</h4>
  </div>

  <table class="table table-hover table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-center">Ranking</th>
        <th scope="col">Insumo</th>
        <th scope="col">Grupo</th>
        <th scope="col" class="text-center">Total Consumido (Qtd)</th>
      </tr>
    </thead>
    <tbody id="tabelaConsumo">
      </tbody>
  </table>

  <script>
    $(document).ready(function() {
      function carregarDados() {
        $.ajax({
          url: 'conexao/listarInsumosMaisConsumidos.php', 
          method: 'GET',
          success: function(response) {
            $('#tabelaConsumo').html(response);
          },
          error: function() {
            $('#tabelaConsumo').html('<tr><td colspan="4" class="text-center text-danger">Erro ao carregar os dados.</td></tr>');
          }
        });
      }

      carregarDados();
    });
  </script>

</body>
</html>