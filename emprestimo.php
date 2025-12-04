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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">

  <!--LOGO-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />

  <title>Empréstimo</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
  <link href="./emprestimo_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JavaScript do Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <meta name="theme-color" content="#712cf9">

  <style>
    .bi-pencil:hover {
      color: #ff0000 !important;
    }


    body {
      margin: 0;
      padding-bottom: 5px;
      height: 100%;
      overflow-y: auto;
      overflow-x: hidden;
      /* Evita rolagem horizontal */
    }

    .container {
      min-height: calc(100vh - 20px);
      padding-bottom: 5px;
      padding-top: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      /* Centraliza o conteúdo verticalmente */
      box-sizing: border-box;
      height: 100%;
      flex-direction: column;
      max-width: 1200px;
      /* Limita a largura máxima do conteúdo */
      margin: 0 auto;
      /* Centraliza horizontalmente */
    }

    main {
      width: 100%;
      max-width: 800px;
      /* Aumenta a largura máxima do conteúdo */
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

    #editarInsumoBtn {
      padding: 0;
      /* Remove o padding */
      border: none;
      /* Remove a borda */
      background: transparent;
      /* Fundo transparente */
    }

    #editarInsumoBtn i {
      color: #6c757d;
      /* Cor do ícone */
      font-size: 1rem;
      /* Tamanho do ícone igual aos outros campos */
      margin-top: auto;
      /* Alinha verticalmente o ícone */
      margin-bottom: auto;
    }

    #editarInsumoBtn:hover i {
      color: #007bff;
      /* Cor do ícone ao passar o mouse */
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./cadastroGrupos_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

  <!-- NAV -->
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

        <div class="text-center">
          <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
          <h2>Cadastro de Empréstimo</h2>
          <p class="lead"><strong>Insira os dados corretamente</strong></p>
          <br>
        </div>

        <form class="needs-validation" novalidate="" name="frmAddEmprestimo" id="frmAddEmprestimo" method="post">

          <div class="row g-3">
            <div class="col-12 d-flex justify-content-start">
              <button type="submit" class="btn btn-outline-dark btn-sm" style="width: 150px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                  viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Criar Empréstimo
              </button>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="codigoEmprestimo" class="form-label">Código do Empréstimo</label>
                <input type="text" class="form-control" id="codigoEmprestimo" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="data_emprestimo" class="form-label">Data Empréstimo</label>
                <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" required=""
                  readonly>
              </div>
              <script>
                function getDataAtual() {
                  const data_emprestimo = new Date();
                  const ano = data_emprestimo.getFullYear();
                  const mes = String(data_emprestimo.getMonth() + 1).padStart(2, '0');
                  const dia = String(data_emprestimo.getDate()).padStart(2, '0');
                  return `${ano}-${mes}-${dia}`;
                }
                document.addEventListener('DOMContentLoaded', function() {
                  const inputData = document.getElementById('data_emprestimo');
                  inputData.value = getDataAtual();
                });
              </script>
            </div>

            <!--<div class="col-md-4">
              <div class="form-group">
                <label for="previsaoDevolucao" class="form-label">Previsão Devolução</label>
                <input type="date" class="form-control" id="previsaoDevolucao" name="previsao_devolucao">
                <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
              </div>
            </div> -->

            <!-- Container da Tabela de Insumos -->
            <div class="form-group">
              <label class="form-label">Insumos</label>
              <div style="margin-top: 5px; margin-bottom: 10px;">
                <button type="button" class="btn btn-outline-dark btn-sm custom-btn selecionar-insumo-btn"
                  style="width: 150px;" onclick="abrirSelecaoInsumos()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16" style="margin-right: 5px;">
                    <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                  </svg>
                  Selecionar
                </button>
              </div>

              <!-- Tabela de Insumos Selecionados -->
              <div id="insumosSelecionadosContainer">
                <table class="table table-dark table-bordered">
                  <!-- Cabeçalho da Tabela -->
                  <thead>
                    <tr>
                      <th>Insumo</th>
                      <th style="width: 80px; text-align: center;">Qtde</th>
                      <th style="width: 120px; text-align: center;">Emprestável</th>
                      <th style="width: 120px; text-align: center;">Devolução</th>
                      <th style="width: 60px; text-align: center;">Excluir</th>
                    </tr>
                  </thead>
                  <!-- Corpo da Tabela -->
                  <tbody id="insumosSelecionadosBody"></tbody>
                </table>
              </div>
            </div>

            <!--</div>-->
            <!-- Requisitante -->
            <div class="col-md-6">
              <label class="form-label">Requisitante</label>
              <button type="button" class="btn btn-outline-dark btn-sm w-100 mb-2"
                onclick="abrirSelecaoUsuarios('Requisitante')">
                + Selecionar
              </button>
              <input type="text" class="form-control" id="requisitante" readonly required>
              <input type="hidden" id="requisitante_id" name="requisitante_id"> <!-- Armazena o ID -->
            </div>
            <!-- Supervisor -->
            <div class="col-md-6">
              <label class="form-label">Supervisor</label>
              <button type="button" class="btn btn-outline-dark btn-sm w-100 mb-2"
                onclick="abrirSelecaoUsuarios('Supervisor')">
                + Selecionar
              </button>
              <input type="text" class="form-control" id="supervisor" readonly required>
              <input type="hidden" id="supervisor_id" name="supervisor_id"> <!-- Armazena o ID -->
            </div>

          </div>

        </form>

        <!-- Barra de Pesquisa -->
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">
              <div class="search-bar d-flex align-items-center">
                <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
                <input id="searchEmprestimo" class="form-control w-100" type="search" placeholder="Pesquisar por Insumo"
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
                <th>Requisitante</th>
                <th>Data</th>
                <th>Insumo</th>
                <!--<th>Quantidade</th>-->
                <th>Supervisor</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody id="dadosTabela">
              <!-- dados -->
            </tbody>
          </table>
        </div>
      </main>
    </div>

    <script src="./emprestimo_files/bootstrap.bundle.min.js.transferir"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
    <script src="./emprestimo_files/checkout.js.transferir"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Modal para visualizar emprestimo -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVisualizarLabel">Detalhes do Empréstimo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modal-body-content">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Edição de Empréstimos -->
    <div class="modal fade" id="modalEditarEmprestimo" tabindex="-1" aria-labelledby="modalEditarEmprestimoLabel"
      aria-hidden="true">

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarEmprestimoLabel">Editar Empréstimo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formEditarEmprestimo">
              <!--<input type="hidden" id="editId">-->
              <div class="mb-3">
                <label for="editDataEmprestimo" class="form-label">Data Empréstimo</label>
                <input type="date" class="form-control" id="editDataEmprestimo" required readonly>
              </div>

              <div class="position-relative">
                <input type="text" class="form-control pe-4" id="insumo" readonly required style="padding-right: 2rem;">
                <input type="hidden" id="editInsumoId">
                <button type="button" id="editarInsumoBtn" class="position-absolute top-50 translate-middle-y"
                  style="right: 10px; border: none; background: none; padding: 0;">
                  <i class="bi bi-pencil" style="font-size: 1rem; color: #6c757d;"></i>
                </button>
              </div>

              <div class="mb-3">
                <label class="form-label">Emprestável</label>
                <div>
                  <input type="radio" id="editEmprestavelSim" name="editEmprestavel" value="Sim" disabled>
                  <label for="editEmprestavelSim">Sim</label>

                  <input type="radio" id="editEmprestavelNao" name="editEmprestavel" value="Não" disabled>
                  <label for="editEmprestavelNao">Não</label>
                </div>
              </div>
              <div class="mb-3">
                <label for="editQuantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="editQuantidade" min="1" required>
                <small id="estoqueAtualText" class="form-text text-muted"></small>
              </div>
              <div class="mb-3">
                <label for="editPrevisaoDevolucao" class="form-label">Previsão de Devolução</label>
                <input type="date" class="form-control" id="editPrevisaoDevolucao">
              </div>
              <!-- Supervisor -->
              <div class="mb-3">
                <label for="editSupervisor" class="form-label">Supervisor</label>
                <div class="position-relative">
                  <input type="text" class="form-control pe-4" id="editSupervisor" readonly required
                    style="padding-right: 2rem;">
                  <input type="hidden" id="editSupervisorId">
                  <button type="button" class="position-absolute top-50 translate-middle-y"
                    onclick="abrirSelecaoUsuarios('Supervisor')"
                    style="right: 10px; border: none; background: none; padding: 0;">
                    <i class="bi bi-pencil" style="font-size: 1rem; color: #6c757d;"></i>
                  </button>
                </div>
              </div>

              <!-- Requisitante -->
              <div class="mb-3">
                <label for="editRequisitante" class="form-label">Requisitante</label>
                <div class="position-relative">
                  <input type="text" class="form-control pe-4" id="editRequisitante" readonly required
                    style="padding-right: 2rem;">
                  <input type="hidden" id="editRequisitanteId">
                  <button type="button" class="position-absolute top-50 translate-middle-y"
                    onclick="abrirSelecaoUsuarios('Requisitante')"
                    style="right: 10px; border: none; background: none; padding: 0;">
                    <i class="bi bi-pencil" style="font-size: 1rem; color: #6c757d;"></i>
                  </button>
                </div>
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


    <!-------- INICIO DAS FUNÇÕES -------->

    <script>
      // var global
      let insumoAnteriorId = null;
      let insumoAnteriorQuantidade = null;
      let idEmprestimoAtual = null;

      let dadosEmprestimoOriginal = {}; // Armazena os dados originais para verificação


      function preencherInsumoParaEdicao(insumo) {
        //console.log("Insumo recebido para edição:", insumo);//debug

        // Atualiza os campos do modal de edição
        $("#insumo").val(insumo.nome);
        $("#editQuantidade").val(insumo.quantidade);

        // Define se é emprestável
        if (insumo.emprestavel === "Sim") {
          $("#editEmprestavelSim").prop("checked", true);
          $("#editPrevisaoDevolucao").prop("disabled", false);
        } else {
          $("#editEmprestavelNao").prop("checked", true);
          $("#editPrevisaoDevolucao").val('');
          $("#editPrevisaoDevolucao").prop("disabled", true);
        }
      }


      $(document).ready(function() {
        // Função para definir a data atual no campo "Data Empréstimo"
        function definirDataAtual() {
          const hoje = new Date();
          const ano = hoje.getFullYear();
          const mes = String(hoje.getMonth() + 1).padStart(2, '0'); // Garantir dois dígitos
          const dia = String(hoje.getDate()).padStart(2, '0'); // Garantir dois dígitos
          $("#data_emprestimo").val(`${ano}-${mes}-${dia}`);


        }



        // ---------------------------------------- RESETAR ----------------------------------------------

        function resetarFormulario() {
          $('#frmAddEmprestimo')[0].reset();

          // Limpa a tabela de insumos
          localStorage.removeItem('insumosSelecionados');
          carregarInsumosSelecionados(); // Atualiza a tabela vazia
          definirDataAtual(); // Reaplicar a data do empréstimo
        }

        // Impede que o campo de pesquisa seja submetido
        $("#searchEmprestimo").on("keypress", function(e) {
          if (e.key === "Enter") {
            e.preventDefault();
          }
        });

        resetarFormulario();

        // ---------------------------------------- CADASTRAR ----------------------------------------------
        $('#frmAddEmprestimo').on('keydown', function(e) {
          if (e.key === "Enter") { // Detecta a tecla Enter
            e.preventDefault(); // Previne a ação padrão de submit ao pressionar Enter
            $(this).submit(); // Submete o formulário
          }
        });

        // submissão do formulário
        $('#frmAddEmprestimo').submit(function(e) {
          e.preventDefault();


          let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];
          if (insumos.length === 0) {
            Swal.fire('Erro!', 'Selecione pelo menos um insumo para o empréstimo.', 'error');
            return;
          }

          let formData = $(this).serializeArray().filter(field => field.name !== "searchEmprestimo");

          formData.push({
            name: "insumos",
            value: JSON.stringify(insumos)
          });

          $.ajax({
            url: 'conexao/emprestimo/cadastrarEmprestimo.php',
            method: 'POST',
            data: $.param(formData),
            dataType: 'json',
            success: function(response) {
              if (response.status === "success") {
                //Swal.fire('Sucesso!', response.message, 'success');
                Swal.fire({
                  title: 'Sucesso!',
                  text: response.message,
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload(); //Atualiza a página após clicar em OK
                  }
                });
              } else {
                Swal.fire('Erro!', response.message, 'error');
              }
            },
            error: function(xhr, status, error) {
              //console.log("Erro bruto:", xhr.responseText);//debug
              Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar o empréstimo.', 'error');
            }
          });

        });
      });


      // ---------------------------------- PESQUISAR -----------------------------------------------------------

      document.addEventListener("DOMContentLoaded", function() {
        carregarEmprestimos();

        document.getElementById("searchEmprestimo").addEventListener("input", function() {
          const insumo = this.value.trim();

          // Se o campo estiver vazio, carrega todos os registros novamente
          if (insumo === "") {
            carregarEmprestimos();
            return;
          }

          // Caso contrário, realiza a pesquisa pelo Insumo digitado
          $.ajax({
            url: "conexao/emprestimo/pesquisarEmprestimo.php",
            method: "POST",
            data: {
              insumo: insumo
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


      function carregarEmprestimos() {
        $.ajax({
          url: "conexao/emprestimo/listarEmprestimo.php",
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

      function carregarEmprestimos() {
        $.ajax({
          url: "conexao/emprestimo/listarEmprestimo.php",
          method: "GET",
          success: function(response) {
            $("#dadosTabela").html(response);
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados.", "error");
          }
        });
      }

      $(document).ready(function() {
        carregarEmprestimos();
      });

      $(document).on("click", ".btn-editar", function() {
        const id = $(this).data("id");
        idEmprestimoAtual = id;

        $.ajax({
          url: "conexao/emprestimo/editarEmprestimo.php",
          method: "POST",
          data: {
            id: id
          },
          success: function(response) {
            if (response.error) {
              Swal.fire("Erro!", response.error, "error");
              return;
            }

            if (response.tem_devolucao) {
              Swal.fire(
                "Ação não permitida!",
                "Este empréstimo já possui uma devolução registrada e não pode ser editado.",
                "warning"
              );
              return;
            }

            // Preenche campos do modal
            $("#editDataEmprestimo").val(response.data_emprestimo);
            $("#editInsumoId").val(response.insumo_id);
            $("#insumo").val(response.insumo);
            $("#editSupervisorId").val(response.supervisor_id);
            $("#editSupervisor").val(response.supervisor);
            $("#editRequisitanteId").val(response.requisitante_id);
            $("#editRequisitante").val(response.requisitante);
            $("#editQuantidade").val(response.quantidade);

            if (response.emprestavel === "Sim") {
              $("#editEmprestavelSim").prop("checked", true);
              $("#editPrevisaoDevolucao").prop("disabled", false).val(response.previsao_devolucao);
            } else {
              $("#editEmprestavelNao").prop("checked", true);
              $("#editPrevisaoDevolucao").prop("disabled", true).val('');
            }

            // Salva dados originais para comparação
            dadosEmprestimoOriginal = {
              data_emprestimo: response.data_emprestimo,
              insumo_id: response.insumo_id,
              supervisor_id: response.supervisor_id,
              requisitante_id: response.requisitante_id,
              quantidade: response.quantidade,
              emprestavel: response.emprestavel,
              previsao_devolucao: response.emprestavel === "Sim" ? response.previsao_devolucao : "",
            };

            insumoAnteriorId = response.insumo_id;
            insumoAnteriorQuantidade = response.quantidade;

            $("#modalEditarEmprestimo").modal("show");
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados para edição.", "error");
          }
        });
      });

      $(document).on("click", "#editarInsumoBtn", function() {
        if (!idEmprestimoAtual) {
          Swal.fire("Erro!", "ID do empréstimo não encontrado.", "error");
          return;
        }

        $("#editInsumoId").val("");
        $("#insumo").val("");
        $("#editQuantidade").val("");
        $("input[name='editEmprestavel']").prop("checked", false);
        $("#editPrevisaoDevolucao").val("").prop("disabled", true);

        $("#insumo").addClass("bg-warning");
        setTimeout(() => $("#insumo").removeClass("bg-warning"), 1000);

        window.open('conexao/selecionarInsumos.php?modo=edicao', '_blank', 'width=600,height=600');
      });

      $(document).on("submit", "#formEditarEmprestimo", function(e) {
        e.preventDefault();

        const insumoId = $("#editInsumoId").val();
        if (!insumoId) {
          Swal.fire("Atenção!", "Você deve selecionar um insumo para continuar.", "warning");
          return;
        }

        const dadosAtuais = {
          data_emprestimo: $("#editDataEmprestimo").val(),
          insumo_id: insumoId,
          supervisor_id: $("#editSupervisorId").val(),
          requisitante_id: $("#editRequisitanteId").val(),
          quantidade: $("#editQuantidade").val(),
          emprestavel: $("input[name='editEmprestavel']:checked").val(),
          previsao_devolucao: $("#editPrevisaoDevolucao").val()
        };

        // Se não for emprestável, zera devolução para comparar corretamente
        if (dadosAtuais.emprestavel === "Não") {
          dadosAtuais.previsao_devolucao = "";
        }

        const houveAlteracao = Object.keys(dadosAtuais).some(
          key => dadosAtuais[key] != dadosEmprestimoOriginal[key]
        );

        if (!houveAlteracao) {
          Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
          return;
        }

        const dadosEmprestimo = {
          id: idEmprestimoAtual,
          data_emprestimo: dadosAtuais.data_emprestimo,
          insumo: dadosAtuais.insumo_id,
          insumo_original_id: insumoAnteriorId,
          quantidade_original: insumoAnteriorQuantidade,
          emprestavel: dadosAtuais.emprestavel,
          previsao_devolucao: dadosAtuais.previsao_devolucao,
          supervisor: dadosAtuais.supervisor_id,
          requisitante: dadosAtuais.requisitante_id,
          quantidade: dadosAtuais.quantidade,
        };

        $.ajax({
          url: "conexao/emprestimo/salvarEdicaoEmprestimo.php",
          method: "POST",
          data: dadosEmprestimo,
          success: function(response) {
            if (response.status === "success") {
              Swal.fire({
                title: "Sucesso!",
                text: response.message || "Registro atualizado com sucesso!",
                icon: "success",
                confirmButtonText: "OK"
              }).then(() => {
                $("#modalEditarEmprestimo").modal("hide");
                location.reload();
              });
            } else {
              Swal.fire("Erro!", response.message, "error");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível salvar as alterações.", "error");
          }
        });
      });
      // --------------------------------- EXCLUIR ------------------------------------------------------------

      $(document).on("click", ".btn-excluir", function() {
        const id = $(this).data("id");

        //  console.log("ID capturado para exclusão: ", id);//debug

        // Verificar se o ID é válido
        if (!id) {
          Swal.fire("Erro!", "Nenhum ID foi capturado para exclusão.", "error");
          return;
        }

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
              url: "conexao/emprestimo/excluirEmprestimo.php",
              method: "POST",
              data: {
                id: id
              },
              dataType: "json",
              success: function(response) {
                //  console.log("Resposta do servidor: ", response);//debug
                if (response.status === "success") {
                  Swal.fire("Excluído!", response.message, "success");
                  carregarEmprestimos();
                } else {
                  // Exibe alerta mais informativo se a resposta for erro
                  Swal.fire({
                    title: "Atenção!",
                    text: response.message,
                    icon: "warning",
                  });
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
            url: "conexao/emprestimo/visualizarEmprestimo.php",
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

      // -------------- SELECT INSUMOS --------------------------

      function abrirSelecaoInsumos() {
        window.open('conexao/selecionarInsumos.php', '_blank', 'width=600,height=600');
      }

      // Função para carregar os insumos na tabela/lista
      function carregarInsumosSelecionados() {
        let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];
        let tbody = document.getElementById("insumosSelecionadosBody");

        tbody.innerHTML = ""; // Limpa a tabela antes de adicionar os itens corretos

        insumos.forEach((insumo, index) => {
          let row = document.createElement("tr");

          // Criando a coluna de Data de Devolução
          let dataDevolucaoInput = `<input type="date" class="form-control form-control-sm previsao_devolucao" 
    data-index="${index}" data-id="${insumo.id}" value="${insumo.previsao_devolucao || ''}" 
    onchange="atualizarDataDevolucao(this)"
    ${insumo.emprestavel === "Não" ? 'disabled' : ''} />`;


          row.innerHTML = `
            <td>${insumo.nome}</td>
            <td style="text-align: center;">
                <input type="number" class="form-control form-control-sm" value="${insumo.quantidade}" 
                       min="1" max="99" data-index="${index}" onchange="atualizarQuantidade(this)">
            </td>
            <td style="text-align: center;">${insumo.emprestavel}</td>
            <td style="text-align: center;">${dataDevolucaoInput}</td>
            <td style="text-align: center;">
                <button class="btn btn-danger btn-sm" onclick="removerInsumo(${index})">X</button>
            </td>
        `;

          tbody.appendChild(row);
        });
      }

      // Atualiza a quantidade
      function atualizarQuantidade(input) {
        let index = input.getAttribute("data-index");
        let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];

        let novaQuantidade = parseInt(input.value, 10) || 1;

        // Se a quantidade for 0, remove o insumo
        if (novaQuantidade === 0) {
          insumos.splice(index, 1);
        } else {
          insumos[index].quantidade = novaQuantidade;
        }

        localStorage.setItem('insumosSelecionados', JSON.stringify(insumos));
        carregarInsumosSelecionados(); // Atualiza a tabela
      }

      // Remove um insumo da lista
      function removerInsumo(index) {
        let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];
        insumos.splice(index, 1); // Remove o item da lista

        localStorage.setItem('insumosSelecionados', JSON.stringify(insumos));
        carregarInsumosSelecionados(); // Atualiza a tabela
      }

      // Atualiza a lista automaticamente quando os dados do `localStorage` mudam
      window.addEventListener("storage", function(event) {
        if (event.key === "insumosSelecionados") {
          carregarInsumosSelecionados();
        }
      });

      // Carrega os insumos ao abrir a página
      document.addEventListener('DOMContentLoaded', carregarInsumosSelecionados);

      // Evento de alteração no campo de "Emprestável"
      $(document).on("change", "input[name='emprestavel']", function() {
        let index = $(this).closest('tr').index();
        let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];

        let insumo = insumos[index];

        // Desabilita ou habilita o campo de Data de Devolução com base em "Emprestável"
        let dataDevolucaoInput = $(this).closest('tr').find('.previsao_devolucao');
        if ($(this).val() === "Não") {
          dataDevolucaoInput.prop('disabled', true); // Desabilita se não for emprestável
          insumo.previsao_devolucao = ''; // Remove a data de devolução se não for emprestável
        } else {
          dataDevolucaoInput.prop('disabled', false); // Habilita se for emprestável
        }

        // Atualiza os dados
        insumos[index] = insumo;
        localStorage.setItem('insumosSelecionados', JSON.stringify(insumos));
        carregarInsumosSelecionados(); // Atualiza a tabela
      });


      $('#confirmarSelecao').on('click', function() {
        let insumosSelecionados = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];

        // Adicionando dados aos insumos
        $('.qtd-insumo').each(function() {
          let id = $(this).data('id');
          let nome = $(this).data('nome');
          let emprestavel = $(this).data('emprestavel'); // Aqui estamos pegando o valor "Sim" ou "Não"
          let quantidadeDisponivel = parseInt($(this).attr('max'), 10);
          let quantidadeSelecionada = parseInt($(this).val(), 10) || 0;
          let previsaoDevolucao = $(`input[type="date"].previsao_devolucao[data-id="${id}"]`).val() || null;


          // Verificando se a quantidade é maior que zero
          if (quantidadeSelecionada > 0) {
            let insumoExistente = insumosSelecionados.find(i => i.id == id);

            if (insumoExistente) {
              let novaQuantidade = insumoExistente.quantidade + quantidadeSelecionada;

              if (novaQuantidade > quantidadeDisponivel) {
                alert(`Quantidade selecionada para "${nome}" excede o estoque disponível!`);
              } else {
                insumoExistente.quantidade = novaQuantidade; // Atualiza a quantidade
                insumoExistente.previsao_devolucao = previsaoDevolucao; // Atualiza previsão de devolução
                insumoExistente.emprestavel = emprestavel; // Atualiza o status de emprestável
              }
            } else {
              // Adicionando novo insumo
              insumosSelecionados.push({
                id,
                nome,
                emprestavel,
                quantidade: quantidadeSelecionada,
                previsao_devolucao: previsaoDevolucao
              });
            }
          }
        });

        // Atualizando os dados no localStorage
        localStorage.setItem('insumosSelecionados', JSON.stringify(insumosSelecionados));

      });

      carregarEmprestimos();



      // -------------- SELECT SUPERVISOR/REQUISITANTE --------------------------

      function abrirSelecaoUsuarios(area) {
        window.open('conexao/usuarios/selecionarUsuarios.php?area=' + encodeURIComponent(area),
          '_blank',
          'width=500,height=600');
      }

      function selecionarUsuario(id, nome, area) {
        const emEdicao = $('#modalEditarEmprestimo').is(':visible');

        if (area === 'Supervisor') {
          if (emEdicao) {
            $('#editSupervisor').val(nome);
            $('#editSupervisorId').val(id);
            $('#editSupervisor').addClass('is-valid');
          } else {
            $('#supervisor').val(nome);
            $('#supervisor_id').val(id);
            $('#supervisor').addClass('is-valid');
          }
        } else if (area === 'Requisitante') {
          if (emEdicao) {
            $('#editRequisitante').val(nome);
            $('#editRequisitanteId').val(id);
            $('#editRequisitante').addClass('is-valid');
          } else {
            $('#requisitante').val(nome);
            $('#requisitante_id').val(id);
            $('#requisitante').addClass('is-valid');
          }
        }
      }

      function atualizarDataDevolucao(input) {
        let index = input.getAttribute("data-index");
        let novaData = input.value;

        let insumos = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];

        if (insumos[index]) {
          insumos[index].previsao_devolucao = novaData;
          localStorage.setItem('insumosSelecionados', JSON.stringify(insumos));
        }
      }

      // --------------------------------- PREENCHER TABELA ------------------------------------------------------------

      function preencherTabela(dados) {
        const tbody = document.getElementById('dadosTabela');
        tbody.innerHTML = '';

        dados.forEach(emprestimo => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
          <td>${emprestimo.requisitante}</td>
          <td>${emprestimo.data_emprestimo}</td>
          <td>${emprestimo.insumo}</td>
          <td>${emprestimo.quantidade}</td>
          <td>${emprestimo.supervisor}</td>
          <td><button type="button" class="btn btn-primary">Visualizar</button></td>
          <td><button type="button" class="btn btn-success">Editar</button></td>
          <td><button type="button" class="btn btn-danger">Excluir</button></td>
        `;
          tbody.appendChild(tr);
        });
      }

      carregarEmprestimos();

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