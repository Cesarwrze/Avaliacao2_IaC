<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Logo -->
    <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
    <title>Inventário</title>

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
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contatos.php" style="color:white;">Contatos</a>
                </li>
            </ul>
            <div class="d-flex align-items-center ms-auto" style="gap: 0.75rem;">
                <form class="form-inline d-flex align-items-center gap-2" method="POST" style="margin: 0;">
                    <label for="selectPesquisa" class="me-2 text-white">Filtrar por:</label>

                    <select class="form-control bg-dark text-white border-0" id="selectPesquisa" name="selectPesquisa">
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="opcao1" <?= (isset($_POST['selectPesquisa']) && $_POST['selectPesquisa'] === 'opcao1') ? 'selected' : '' ?>>Menores Quantidades</option>
                        <option value="opcao2" <?= (isset($_POST['selectPesquisa']) && $_POST['selectPesquisa'] === 'opcao2') ? 'selected' : '' ?>>Maiores Movimentações</option>
                        <option value="opcao3" <?= (isset($_POST['selectPesquisa']) && $_POST['selectPesquisa'] === 'opcao3') ? 'selected' : '' ?>>Quantidade Disponível</option>
                        <option value="zerados" <?= (isset($_POST['selectPesquisa']) && $_POST['selectPesquisa'] === 'zerados') ? 'selected' : '' ?>>Insumos Zerados</option>
                    </select>

                    <button class="btn btn-outline-success text-white" type="submit" name="btnFiltrar">Filtrar</button>

                    <button class="btn btn-outline-danger" type="submit" name="btnLimpar" style="border: none; background: none;">
                        <img width="24" height="24" src="https://img.icons8.com/ios-filled/50/ffffff/clear-filters.png" alt="clear-filters" />
                    </button>
                </form>

                <!-- Ícone PDF centralizado -->
                <a href="#" id="btnGerarPDF" title="Download PDF">
                    <i class="bi bi-file-earmark-arrow-down-fill fs-4 text-light" style="cursor: pointer;"></i>
                </a>

                <!-- Botão sair -->
                <!--<a class="btn btn-outline-light" href="login.html">Sair</a>-->
                <a class="btn btn-outline-light" href="logout.php">Sair</a>
            </div>

    </nav>


    <div class="container mt-4">
        <h2 class="text-center">Inventário de Insumos</h2>
        <p class="text-center">
            Esta tabela apresenta o inventário atual de insumos, listando detalhes como nome, data de cadastro, ambiente, localização, grupo e quantidade disponível.
            Você pode aplicar filtros para visualizar menores quantidades, maiores movimentações ou disponibilidade de itens.
        </p>
    </div>

    <table class="table">
        <thead style="color:black" class="thead-dark">
            <tr>
                <!--<th scope="col">Código</th>-->
                <th scope="col">Nome</th>
                <th scope="col">Data Cadastro</th>
                <th scope="col">Ambiente</th>
                <th scope="col">Container</th>
                <th scope="col">Divisão</th>
                <th scope="col">Grupo</th>
                <th scope="col">Descrição</th>
                <th scope="col">Detalhe</th>
                <th scope="col">Emprestável</th>
                <th scope="col">Quantidade<br>em Estoque</th>
                <th scope="col">Quantidade<br>Movimentada</th>

            </tr>
        </thead>

        <tbody>


            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            require_once 'conexao/listarInventario.php';

            if (isset($_POST['btnLimpar'])) {
                echo "<script>window.location.href = 'inventario.php';</script>";
                exit;
            }

            $filterOption = $_POST['selectPesquisa'] ?? null;
            echo "<!-- Debug: Filtro recebido: {$filterOption} -->";

            listarInventario($filterOption);

            ?>

        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#btnGerarPDF').click(function(e) {
                e.preventDefault();
                const filtro = $('#selectPesquisa').val() || '';
                const url = `conexao/gerarInventarioPDF.php?filtro=${encodeURIComponent(filtro)}`;
                window.open(url, '_blank');
            });
        });
    </script>


</body>

</html>