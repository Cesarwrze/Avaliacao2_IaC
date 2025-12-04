<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<!-- saved from url=(0063)https://getbootstrap.com.br/docs/4.1/examples/starter-template/ -->
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Logo-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Home - Sistema de Gestão de Estoque</title>
  <!-- Principal CSS do Bootstrap -->
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos customizados para esse template -->
  <link href="./home_files/starter-template.css" rel="stylesheet">

</head>

<style>
  html,
  body {
    height: 100%;
  }

  body {
    display: flex;
    flex-direction: column;
  }

  .content {
    flex: 1;
  }

  footer {
    flex-shrink: 0;
  }
</style>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" style="color:white">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="manutencao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Manutenção</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
            <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
            <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
            <!--<a class="dropdown-item" href="cadastroRequisitante.html">Requisitante</a>
              <a class="dropdown-item" href="cadastroSupervisor.html">Supervisor</a>-->
            <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="movimentacao" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Movimentação</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="devolucao.php">Devolução</a>
            <a class="dropdown-item" href="emprestimo.php">Empréstimo</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="relatorios" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Relatórios</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="relatorioMovimentacao.php">Movimentações Gerais</a>
            <a class="dropdown-item" href="inventario.php">Inventário</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contatos.php">Contatos</a>
        </li>
      </ul>

      <!-- Adicionando o botão "Sair" -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <!--<a class="btn btn-outline-light" href="login.html">Sair</a>-->
          <a class="btn btn-outline-light" href="logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </nav>
  <main role="main" class="container">

    <div class="starter-template">
      <h1>Sistema de Gestão de Estoque</h1>
      <p class="lead"><br></p>
    </div>

  </main><!-- /.container -->


  <script src="./home_files/jquery-3.3.1.slim.min.js.transferir" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="./home_files/popper.min.js.transferir"></script>
  <script src="./home_files/bootstrap.min.js.transferir"></script>

</body>

</html>