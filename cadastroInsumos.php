<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <title>Cadastro Insumos</title>
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

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <meta name="theme-color" content="#712cf9">

  <style>
    body {
      margin: 0;
      padding-bottom: 5px;
      height: 100%;
      overflow-y: auto;
    }

    .container {
      min-height: calc(100vh - 20px);
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-bottom: 5px;
      box-sizing: border-box;
      height: 100%;
      flex-direction: column;
      overflow: visible;
    }

    main {
      width: 100%;
      max-width: 600px;
      padding: 15px;
      box-sizing: border-box;
    }

    .form-control {
      flex-grow: 1;
    }

    .table-container {
      width: 100%;
      box-sizing: border-box;
      margin-top: 30px;
      overflow-y: auto;
      max-height: 300px;
    }

    .table-container table {
      width: 100%;
      border-collapse: collapse;
      table-layout: auto;
    }

    .table-container th,
    .table-container td {
      text-align: left;
      padding: 8px;
      border: 1px solid #dee2e6;
    }

    .search-bar {
      display: flex;
      align-items: center;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .search-bar .form-control {
      flex: 3;
      margin-right: 10px;
    }

    .search-bar .btn {
      flex: 1;
      white-space: nowrap;
    }

    .btn {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
    }

    .custom-btn {
      background-color: transparent;
      color: black;
      border-color: black;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .custom-btn:hover {
      background-color: black;
      color: white;
    }
  </style>

  <!--<link href="./cadastroGrupos_files/checkout.css" rel="stylesheet">-->
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">
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

  <div class="container" style="height: 100vh;">
    <div class="row h-100 justify-content-center align-items-center">
      <main class="col-md-7 col-lg-8">
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
          <h2>Cadastro de Insumos</h2>
          <p class="lead"><strong>Insira os dados corretamente</strong></p>
        </div>

        <form class="needs-validation" novalidate="" name="frmAddInsumo" id="frmAddInsumo" method="post">

          <div class="row g-3">
            <div class="col-12 d-flex justify-content-start">
              <button type="submit" class="btn btn-outline-dark btn-sm" style="width: 150px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                  viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Criar Insumo
              </button>
            </div>

            <!-- Código e Data -->
            <div class="col-md-6">
              <label for="codigoInsumo" class="form-label">Código</label>
              <input type="text" class="form-control" id="codigoInsumo" name="codigo" readonly>
            </div>
            <div class="col-md-6">
              <label for="dataCadastroInsumo" class="form-label">Data cadastro</label>
              <input type="date" class="form-control" id="dataCadastroInsumo" name="data_cadastro" required="" readonly>
            </div>

            <!-- Nome e Emprestável -->
            <div class="col-md-6">
              <label for="nomeInsumo" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nomeInsumo" name="nome" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Emprestável</label>
              <div>
                <input type="radio" name="emprestavel" id="emprestavel-sim" value="Sim" required>
                <label for="emprestavel-sim">Sim</label>
              </div>
              <div>
                <input type="radio" name="emprestavel" id="emprestavel-nao" value="Não">
                <label for="emprestavel-nao">Não</label>
              </div>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Ambiente e Grupo -->
            <div class="col-md-6">
              <label for="ambiente" class="form-label">Ambiente</label>
              <!--<input type="text" class="form-control" id="ambiente-input" name="ambiente" required>-->
              <select class="form-control" id="ambiente" name="ambiente" required>
                <option value="" disabled selected>Selecione um ambiente</option>
              </select>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>
            <div class="col-md-6">
              <label for="grupo" class="form-label">Grupo</label>
              <!--<input type="text" class="form-control" id="grupo-input" name="grupo" required>-->
              <select class="form-control" id="grupo" name="grupo" required>
                <option value="" disabled selected>Selecione um grupo</option>
              </select>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Container, Divisão e Quantidade-->
            <!--            <div class="col-md-6">
              <label for="container" class="form-label">Container</label>
              <input type="text" class="form-control" id="container" name="container" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div> -->
            <!--             <div class="col-md-6">
              <label for="divisao" class="form-label">Divisão</label>
              <input type="text" class="form-control" id="divisao" name="divisao" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div> -->
            <div class="col-md-4">
              <label for="container" class="form-label">Container</label>
              <input type="text" class="form-control" id="container" name="container" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Divisão -->
            <div class="col-md-4">
              <label for="divisao" class="form-label">Divisão</label>
              <input type="text" class="form-control" id="divisao" name="divisao" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Quantidade -->
            <div class="col-md-4">
              <label for="quantidade" class="form-label">Quantidade</label>
              <input type="number" step="0.01" class="form-control" id="quantidade" name="quantidade" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Descrição -->
            <div class="col-12">
              <label for="descricao" class="form-label">Descrição</label>
              <input type="text" class="form-control" id="descricao" name="descricao" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>

            <!-- Detalhes -->
            <div class="col-12">
              <label for="detalhes" class="form-label">Detalhes</label>
              <input type="text" class="form-control" id="detalhes" name="detalhes" required>
              <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
            </div>
          </div>

          <!--          <div class="search-bar">
            <input id="searchInsumo" class="form-control" type="search" placeholder="Pesquisar Insumo"
              aria-label="Pesquisar">
            <button id="btnPesquisar" class="btn btn-outline-success" type="button">Pesquisar</button>
          </div> -->


        </form>

        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">
              <div class="search-bar d-flex align-items-center">
                <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
                <input id="searchInsumo" class="form-control w-100" type="search" placeholder="Pesquisar Insumo"
                  aria-label="Pesquisar">
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela -->
        <div class="table-container">
          <table class="table table-hover">
            <thead class="table table-sm">
              <tr>
                <!--<th>ID</th>-->
                <th>Insumo</th>
                <th>Quantidade</th>
                <th>Emprestável</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody id="dadosTabela">
              <!-- Dados serão inseridos aqui pelo JavaScript -->
            </tbody>
          </table>
        </div>

      </main>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./emprestimo_files/checkout.js"></script>


  <!-- Modal para visualizar insumo -->
  <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVisualizarLabel">Detalhes do Insumo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body-content">
          <!-- Os detalhes do usuário serão carregados aqui -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar insumo -->
  <div class="modal fade" id="modalEditarInsumo" tabindex="-1" aria-labelledby="modalEditarInsumoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarInsumoLabel">Editar Insumo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditarInsumo">
            <input type="hidden" id="edit_id" name="id"> <!-- ID escondido -->

            <!-- Nome -->
            <div class="mb-3">
              <label for="edit_insumo" class="form-label">Nome do Insumo</label>
              <input type="text" class="form-control" id="edit_insumo" name="insumo" required>
            </div>

            <!-- Emprestável -->
            <div class="mb-3">
              <label class="form-label">Emprestável</label>
              <div>
                <input type="radio" id="edit_emprestavel_sim" name="emprestavel" value="Sim"> <label
                  for="edit_emprestavel_sim">Sim</label>
                <input type="radio" id="edit_emprestavel_nao" name="emprestavel" value="Não"> <label
                  for="edit_emprestavel_nao">Não</label>
              </div>
            </div>
            <!-- Ambiente e Grupo -->
            <div class="mb-3">
              <label for="edit_ambiente" class="form-label">Ambiente</label>
              <select class="form-control" id="edit_ambiente" name="ambiente">
                <option value="">Selecione um ambiente</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="edit_grupo" class="form-label">Grupo</label>
              <select class="form-control" id="edit_grupo" name="grupo">
                <option value="">Selecione um grupo</option>
              </select>
            </div>

            <!-- Container, Divisão e Quantidade -->
            <div class="row">
              <div class="col">
                <label for="edit_container" class="form-label">Container</label>
                <input type="text" class="form-control" id="edit_container" name="container">
              </div>
              <div class="col">
                <label for="edit_divisao" class="form-label">Divisão</label>
                <input type="text" class="form-control" id="edit_divisao" name="divisao">
              </div>
              <div class="col">
                <label for="edit_quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="edit_quantidade" name="quantidade">
              </div>
            </div>

            <!-- Descrição e Detalhes -->
            <div class="mb-3">
              <label for="edit_descricao" class="form-label">Descrição</label>
              <input type="text" class="form-control" id="edit_descricao" name="descricao">
            </div>

            <div class="mb-3">
              <label for="edit_detalhes" class="form-label">Detalhes</label>
              <input type="text" class="form-control" id="edit_detalhes" name="detalhes">
            </div>

            <!-- Botões -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Scripts adicionais -->
  <script>
    document.addEventListener("keydown", function(event) {
      // Verifica se a tecla pressionada é 'Enter' e o foco está no campo de pesquisa
      if (event.key === "Enter") {
        const activeElement = document.activeElement;

        // Impede a ação padrão apenas se o foco estiver no campo de pesquisa
        if (activeElement.id === "searchInsumo") {
          event.preventDefault();
        }
      }
    });

    $("#frmAddInsumo input").on("input", function() {
      if (this.checkValidity()) {
        $(this).removeClass("is-invalid");
      } else {
        $(this).addClass("is-invalid");
      }
    });

    // ---------------------------------- CADASTRAR -----------------------------------------------------------

    document.addEventListener('DOMContentLoaded', function() {
      const inputData = document.getElementById('dataCadastroInsumo');
      if (!inputData.value) { // Define a data apenas se o campo estiver vazio
        const dataAtual = new Date();
        const ano = dataAtual.getFullYear();
        const mes = String(dataAtual.getMonth() + 1).padStart(2, '0');
        const dia = String(dataAtual.getDate()).padStart(2, '0');
        inputData.value = `${ano}-${mes}-${dia}`;
      }
    });

    $('#frmAddInsumo').submit(function(e) {
      e.preventDefault();


      let hasError = false;

      $('#frmAddInsumo input, #frmAddInsumo select').each(function() {
        if ($(this).prop('required') && !$(this).val()) {
          $(this).addClass('is-invalid');
          hasError = true;
        } else {
          $(this).removeClass('is-invalid'); // Remove classe de erro caso esteja preenchido
        }
      });

      // Se houver erros, para o envio
      if (hasError) {
        return; // Não envia o formulário
      }

      const formData = $(this).serialize();

      $.ajax({
        type: "POST",
        url: "conexao/insumos/cadastrarInsumo.php",
        data: $(this).serialize(),
        success: function(response) {
          // console.log("Resposta do servidor:", response); // depuração
          const [status, message] = response.split('|');
          if (status === "1") {
            //Swal.fire('Sucesso!', response.message, 'success');
            Swal.fire({
              title: 'Sucesso!',
              ///text: response.message,
              text: message,
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload(); // Atualiza a página após clicar em OK
              }
            });
          } else {
            Swal.fire('Erro!', message, 'error');
          }
        },
        error: function() {
          Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar o insumo.', 'error');
        }
      });
    });


    // // ---------------------------------- PESQUISAR -----------------------------------------------------------

    document.addEventListener("DOMContentLoaded", function() {
      carregarInsumos();

      // Evento para filtrar a tabela ao digitar
      document.getElementById("searchInsumo").addEventListener("input", function() {
        const nome = this.value.trim();

        // Se o campo estiver vazio, carrega todos os registros novamente
        if (nome === "") {
          carregarInsumos();
          return;
        }

        $.ajax({
          url: "conexao/insumos/pesquisarInsumo.php",
          method: "POST",
          data: {
            nome: nome
          },
          success: function(response) {
            document.getElementById("dadosTabela").innerHTML = response;
          },
          error: function() {
            Swal.fire('Erro!', 'Não foi possível buscar os dados.', 'error');
          }
        });
      });
    });

    // Função para carregar todos os usuários
    function carregarInsumos() {
      $.ajax({
        url: "conexao/insumos/listarInsumo.php",
        method: "GET",
        success: function(response) {
          document.getElementById("dadosTabela").innerHTML = response;
        },
        error: function() {
          Swal.fire('Erro!', 'Não foi possível carregar os dados.', 'error');
        }
      });
    }


    // ------------------------- LISTAR ----------------------------------

    function carregarInsumos() {
      $.ajax({
        url: "conexao/insumos/listarInsumo.php",
        method: "GET",
        success: function(response) {
          const tabela = $("#dadosTabela");

          if (!response.trim() || response.trim().replace(/\s/g, '') === '') {
            // Se resposta vazia ou só com espaços
            tabela.html(`
  <tr>
    <td colspan="6" class="text-center align-middle text-black py-4">
      Nenhum insumo encontrado.
    </td>
  </tr>
`);

          } else {
            tabela.html(response);
          }
        },
        error: function() {
          Swal.fire("Erro!", "Não foi possível carregar os dados.", "error");
        }
      });
    }

    $(document).ready(function() {
      carregarInsumos();
    });


    // ------------------------- EDITAR ----------------------------------

    $(document).ready(function() {
      let originalInsumo = {}; // Armazena os dados originais

      $(document).on("click", ".btn-editar", function() {
        const id = $(this).data("id");

        $.ajax({
          url: "conexao/insumos/editarInsumo.php",
          method: "POST",
          data: {
            id: id
          },
          dataType: "json",
          success: function(response) {
            if (response.error) {
              Swal.fire("Erro!", response.error, "error");
            } else {
              $("#edit_id").val(response.id);
              $("#edit_insumo").val(response.nome);
              $("#edit_container").val(response.container);
              $("#edit_divisao").val(response.divisao);
              $("#edit_quantidade").val(response.quantidade);
              $("#edit_descricao").val(response.descricao);
              $("#edit_detalhes").val(response.detalhes);

              // Marcar radios
              $("input[name='emprestavel']").prop("checked", false);
              if (response.emprestavel.trim() === "Sim") {
                $("#edit_emprestavel_sim").prop("checked", true);
              } else if (response.emprestavel.trim() === "Não") {
                $("#edit_emprestavel_nao").prop("checked", true);
              }

              // Carregar selects e armazenar original após carregamento
              carregarAmbientesEdicao(response.ambiente_id);
              carregarGruposEdicao(response.grupo_id);

              // Salva os valores originais em objeto
              setTimeout(() => {
                originalInsumo = {
                  nome: $("#edit_insumo").val(),
                  emprestavel: $("input[name='emprestavel']:checked").val(),
                  ambiente: $("#edit_ambiente").val(),
                  grupo: $("#edit_grupo").val(),
                  container: $("#edit_container").val(),
                  divisao: $("#edit_divisao").val(),
                  quantidade: $("#edit_quantidade").val(),
                  descricao: $("#edit_descricao").val(),
                  detalhes: $("#edit_detalhes").val()
                };
              }, 300); // delay para garantir que os selects foram atualizados

              $("#modalEditarInsumo").modal("show");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados do insumo.", "error");
          }
        });
      });

      // Salvar alterações ao clicar no botão "Salvar Alterações"
      $("#formEditarInsumo").submit(function(e) {
        e.preventDefault();

        const id = $("#edit_id").val();
        const nome = $("#edit_insumo").val();
        const emprestavel = $("input[name='emprestavel']:checked").val();
        const ambiente = $("#edit_ambiente").val();
        const grupo = $("#edit_grupo").val();
        const container = $("#edit_container").val();
        const divisao = $("#edit_divisao").val();
        const quantidade = $("#edit_quantidade").val();
        const descricao = $("#edit_descricao").val();
        const detalhes = $("#edit_detalhes").val();

        // Verificar alterações
        const houveAlteracao =
          nome !== originalInsumo.nome ||
          emprestavel !== originalInsumo.emprestavel ||
          ambiente !== originalInsumo.ambiente ||
          grupo !== originalInsumo.grupo ||
          container !== originalInsumo.container ||
          divisao !== originalInsumo.divisao ||
          quantidade !== originalInsumo.quantidade ||
          descricao !== originalInsumo.descricao ||
          detalhes !== originalInsumo.detalhes;

        if (!houveAlteracao) {
          Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
          return;
        }

        // Enviar os dados
        $.ajax({
          url: "conexao/insumos/salvarEdicaoInsumo.php",
          method: "POST",
          data: {
            id,
            nome,
            emprestavel,
            ambiente,
            grupo,
            container,
            divisao,
            quantidade,
            descricao,
            detalhes
          },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              Swal.fire({
                title: "Sucesso!",
                text: response.success,
                icon: "success",
                confirmButtonText: "OK"
              }).then((result) => {
                if (result.isConfirmed) {
                  $("#modalEditarInsumo").modal("hide");
                  location.reload();
                }
              });
            } else {
              Swal.fire("Erro!", response.error, "error");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível salvar as alterações.", "error");
          }
        });
      });
    });




    // -------------------- SELECT AMBIENTES/GRUPOS -------------------- 
    //function carregarAmbientes(selectedAmbiente = null) {
    function carregarAmbientesPrincipal() {
      $.ajax({
        url: 'conexao/ambientes/listarAmbientes.php',
        method: 'GET',
        dataType: "json",
        success: function(response) {
          //const ambienteSelect = $('#edit_ambiente, #ambiente'); // Aplica para cadastro e edição
          const ambienteSelect = $('#ambiente');
          ambienteSelect.empty();
          ambienteSelect.append('<option value="" selected disabled>Selecione um ambiente</option>');

          response.forEach(ambiente => {
            //const isSelected = (ambiente.id == selectedAmbiente) ? "selected" : "";
            //ambienteSelect.append(`<option value="${ambiente.id}" ${isSelected}>${ambiente.ambiente}</option>`);
            ambienteSelect.append(`<option value="${ambiente.id}">${ambiente.ambiente}</option>`);
          });

          //ambienteSelect.prop('disabled', false);
        },
        error: function() {
          Swal.fire('Erro!', 'Não foi possível carregar os ambientes.', 'error');
        }
      });
    }
    // Carrega ambientes no MODAL DE EDIÇÃO
    function carregarAmbientesEdicao(selectedAmbiente = null) {
      $.ajax({
        url: 'conexao/ambientes/listarAmbientes.php',
        method: 'GET',
        dataType: "json",
        success: function(response) {
          const ambienteSelect = $('#edit_ambiente');
          ambienteSelect.empty();
          ambienteSelect.append('<option value="" selected disabled>Selecione um ambiente</option>');

          response.forEach(ambiente => {
            const isSelected = (ambiente.id == selectedAmbiente) ? "selected" : "";
            ambienteSelect.append(`<option value="${ambiente.id}" ${isSelected}>${ambiente.ambiente}</option>`);
          });
        },
        error: function() {
          Swal.fire('Erro!', 'Não foi possível carregar os ambientes.', 'error');
        }
      });
    }

    function carregarGruposPrincipal() {
      $.ajax({
        url: 'conexao/grupos/listarGrupos.php',
        method: 'GET',
        dataType: "json",
        success: function(response) {
          const grupoSelect = $('#grupo');
          grupoSelect.empty();
          grupoSelect.append('<option value="" selected disabled>Selecione um grupo</option>');

          response.forEach(grupo => {
            grupoSelect.append(`<option value="${grupo.id}">${grupo.grupo}</option>`);
          });
        },
        error: function() {
          Swal.fire('Erro!', 'Não foi possível carregar os grupos.', 'error');
        }
      });
    }

    function carregarGruposEdicao(selectedGrupo = null) {
      $.ajax({
        url: 'conexao/grupos/listarGrupos.php',
        method: 'GET',
        dataType: "json",
        success: function(response) {
          const grupoSelect = $('#edit_grupo');
          grupoSelect.empty();
          grupoSelect.append('<option value="" selected disabled>Selecione um grupo</option>');

          response.forEach(grupo => {
            const isSelected = (grupo.id == selectedGrupo) ? "selected" : "";
            grupoSelect.append(`<option value="${grupo.id}" ${isSelected}>${grupo.grupo}</option>`);
          });
        },
        error: function() {
          Swal.fire('Erro!', 'Não foi possível carregar os grupos.', 'error');
        }
      });
    }

    $(document).ready(function() {
      carregarAmbientesPrincipal(); // Carrega ambiente no formulário principal
      carregarGruposPrincipal(); // Carrega grupo no formulário principal
    });

    // --------------------------------- EXCLUIR ------------------------------------------------------------

    $(document).on("click", ".btn-excluir", function() {
      const id = $(this).data("id");

      //console.log("ID capturado para exclusão: ", id);//debug

      if (!id) {
        Swal.fire("Erro!", "Nenhum ID foi capturado para exclusão.", "error");
        return;
      }

      // Exibir confirmação antes de excluir
      Swal.fire({
        title: "Tem certeza?",
        text: "Essa ação não poderá ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, excluir!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "conexao/insumos/excluirInsumo.php",
            method: "POST",
            data: {
              id: id
            },
            dataType: "json",
            success: function(response) {
              //  console.log("Resposta do servidor: ", response);//debug
              if (response.status === "success") {
                Swal.fire("Excluído!", response.message, "success");
                carregarInsumos();
              } else {
                Swal.fire("Erro!", response.message, "error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              //  console.error("Erro AJAX: ", textStatus, errorThrown);//debug
              Swal.fire("Erro!", "Não foi possível excluir o registro.", "error");
            }
          });
        }
      });
    });

    // --------------------------------- VISUALIZAR ------------------------------------------------------------      

    $(document).ready(function() {
      $(document).on("click", ".btn-visualizar", function() {
        const id = $(this).data("id");

        $.ajax({
          url: "conexao/insumos/visualizarInsumo.php",
          method: "POST",
          data: {
            id: id
          },
          success: function(response) {
            $("#modal-body-content").html(response);
            $("#modalVisualizar").modal("show");
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível visualizar os dados.", "error");
          }
        });
      });
    });


    // Pressionar Enter dentro do modal de edição envia o formulário
    $('#modalEditarInsumo').on('keydown', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        $('#formEditarInsumo').submit();
      }
    });

    document.addEventListener("keydown", function(e) {
      if (e.key === "Enter") {
        const confirmBtn = document.querySelector(".swal2-confirm");
        if (confirmBtn && confirmBtn.offsetParent !== null) {
          confirmBtn.click(); // força o click no OK se o Swal estiver visível
        }
      }
    });
  </script>

</body>

</html>