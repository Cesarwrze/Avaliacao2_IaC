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
  <!-- Logo -->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Relatórios Gerais</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./emprestimo_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <!-- CSS do Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <meta name="theme-color" content="#712cf9">

  <!-- Principal CSS do Bootstrap -->
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos customizados para esse template -->
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <style>
    thead.thead-dark th {
      background-color: black;
      color: white;
    }

    body {
      padding-top: 56px;
      /* Ajusta a altura do navbar fixo */
    }

    .table {
      margin-top: 0;
      /* Remove a margem superior da tabela */
    }

    .navbar {
      margin-bottom: 0;
      /* Remove a margem inferior da navbar */
    }
  </style>
  <!-- Inclua jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
      <!--     <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <form class="form-inline my-2 my-lg-0 ml-auto"> -->
      <div class="d-flex align-items-center ms-auto">
        <!-- Formulário de filtro -->
        <form class="form-inline d-flex align-items-center">

          <label for="selectPesquisa" style="color:white" class="mr-2">Filtrar por: </label>
          <select class="form-control mr-2" id="selectPesquisa">
            <option value="" disabled selected>Selecione uma opção</option>
            <option value="insumo">Insumo</option>
            <option value="requisitante">Requisitante</option>
            <option value="supervisor">Supervisor</option>
            <option value="status">Status</option>
          </select>
          <input type="text" class="form-control mr-2" id="valorFiltro" name="valorFiltro" placeholder="Digite o valor">
        </form>
      </div>
      <!--      <button type="button" class="btn btn-primary ml-2" id="btnGerarPDF">
        <i class="bi bi-file-earmark-arrow-down-fill"></i>
      </button>-->
      <!-- Botão ícone para PDF  -->
      <a href="#" id="btnGerarPDF" class="me-3" title="Download PDF">
        <i class="bi bi-file-earmark-arrow-down-fill fs-4 text-light" style="cursor: pointer;"></i>
      </a>

      <!--<a class="btn btn-outline-light" href="login.html">Sair</a>-->
      <a class="btn btn-outline-light" href="logout.php">Sair</a>




      <!-- Adicionando o botão "Sair" -->
      <!--      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="btn btn-outline-light" href="login.html">Sair</a>
        </li>
      </ul>-->
    </div>
  </nav>


  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Requisitante</th>
        <th scope="col">Insumo</th>
        <th scope="col">Data<br>Empréstimo</th>
        <th scope="col">Previsão<br>Devolução</th>
        <th scope="col">Data<br>Devolução</th>
        <th scope="col">Quantidade<br>Saída</th>
        <th scope="col">Quantidade<br>Devolvida</th>
        <th scope="col">Supervisor</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody id="tabelaMovimentacoes">
      <!-- Os dados serão carregados aqui dinamicamente -->
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      function carregarDados(filtroPor = '', valorFiltro = '') {
        $.ajax({
          url: 'conexao/listarMovimentacoes.php',
          method: 'GET',
          data: {
            filtroPor: filtroPor,
            valorFiltro: valorFiltro
          },
          success: function(response) {
            $('#tabelaMovimentacoes').html(response);
          },
          error: function() {
            alert('Erro ao carregar os dados.');
          }
        });
      }

      carregarDados();

      $('#valorFiltro').on('input', function() {
        const filtroPor = $('#selectPesquisa').val();
        const valorFiltro = $(this).val();
        if (filtroPor) {
          carregarDados(filtroPor, valorFiltro);
        } else if (valorFiltro === '') {
          carregarDados();
        }
      });

      $('#selectPesquisa').on('change', function() {
        const filtroPor = $(this).val();
        const valorFiltro = $('#valorFiltro').val();
        carregarDados(filtroPor, valorFiltro);
      });

      $('#btnGerarPDF').click(function() {
        const filtroPor = $('#selectPesquisa').val();
        const valorFiltro = $('#valorFiltro').val();

        const url = `conexao/gerarPDF.php?filtroPor=${encodeURIComponent(filtroPor)}&valorFiltro=${encodeURIComponent(valorFiltro)}`;
        window.open(url, '_blank'); // Abre nova aba com o PDF
      });

    });
  </script>

</body>

</html>