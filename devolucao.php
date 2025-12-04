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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Devolução</title>
  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

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
  </style>


  <!-- Custom styles for this template -->
  <link href="./cadastroGrupos_files/checkout.css" rel="stylesheet">
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


        <div class="text-center">
          <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
          <h2>Cadastro de Devolução</h2>
          <p class="lead"><strong>Insira os dados corretamente</strong></p>
          <br>
        </div>
        <form class="needs-validation" novalidate="" name="frmAddDevolucao" id="frmAddDevolucao" method="post">
          <div class="row g-3">
            <div class="row g-3">
              <div class="col-12 d-flex justify-content-start">
                <button type="submit" class="btn btn-outline-dark btn-sm" style="width: 150px;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                    viewBox="0 0 16 16" style="margin-right: 5px;">
                    <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                  </svg>
                  Criar Devolução
                </button>
              </div>

              <!-- Código -->
              <div class="col-md-6">
                <label for="codigoDevolucao" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigoDevolucao" readonly>
              </div>

              <!-- Data Devolução -->
              <div class="col-md-6">
                <label for="dataDevolucao" class="form-label">Data Devolução</label>
                <input type="date" class="form-control" id="dataDevolucao" name="dataDevolucao" required="" readonly>
                <script>
                  function getDataAtual() {
                    const dataDevolucao = new Date();
                    const ano = dataDevolucao.getFullYear();
                    const mes = String(dataDevolucao.getMonth() + 1).padStart(2, '0');
                    const dia = String(dataDevolucao.getDate()).padStart(2, '0');
                    return `${ano}-${mes}-${dia}`;
                  }
                  document.addEventListener('DOMContentLoaded', function() {
                    const inputData = document.getElementById('dataDevolucao');
                    inputData.value = getDataAtual();
                  });
                </script>
              </div>


              <!-- ID Empréstimo (Dinâmico) -->

              <!-- Campo para Selecionar o Empréstimo -->
              <!--<div class="col-md-6">-->
              <div class="col-12">
                <label class="form-label">Empréstimo</label>

                <!-- Botão para abrir o form de seleção -->
                <button type="button" class="btn btn-outline-dark btn-sm w-100 mb-2"
                  onclick="abrirSelecaoEmprestimos()">
                  + Selecionar
                </button>

                <!-- Campo que exibe os dados do empréstimo selecionado -->
                <input type="text" class="form-control" id="emprestimo_info" readonly required>

                <!-- Campos ocultos para armazenar os valores -->
                <input type="hidden" id="emprestimo_id" name="emprestimo_id">
                <input type="hidden" id="requisitante_id" name="requisitante">
                <!--<input type="hidden" id="requisitante" name="requisitante">-->
                <input type="hidden" id="dataEmprestimoOculta" name="dataEmprestimo">
                <input type="hidden" id="ra" name="ra">
                <input type="hidden" id="insumo" name="insumo">
                <input type="hidden" id="quantidade_emprestada" name="quantidade_emprestada">
              </div>



              <!-- Quantidade Devolvida -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="quantidade_devolvida" class="form-label">Quantidade Devolvida</label>
                  <input type="number" step="0.01" class="form-control" id="quantidade_devolvida"
                    name="quantidade_devolvida" required>
                  <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
                </div>
              </div>

              <!-- Detalhes -->
              <div class="col-md-6">
                <label for="obs" class="form-label">Observações</label>
                <input type="text" class="form-control" id="obs" name="obs">
                <div class="invalid-feedback">Obrigatório preenchimento do campo.</div>
              </div>
            </div>

          </div>


        </form>

        <!-- Barra de Pesquisa -->
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">
              <div class="search-bar d-flex align-items-center">
                <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
                <input id="searchDevolucao" class="form-control w-100" type="search"
                  placeholder="Pesquisar por Requisitante" aria-label="Pesquisar">
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
                <th>Data Devolução</th>
                <th>Insumo</th>
                <th>Observação</th>
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


    <!-- Modal para Visualizar devolucao -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVisualizarLabel">Detalhes da Devolução</h5>
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

    <!-- Modal de Edição de Devolução -->
    <div class="modal fade" id="modalEditarDevolucao" tabindex="-1" aria-labelledby="modalEditarDevolucaoLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarDevolucaoLabel">Editar Devolução</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formEditarDevolucao">
              <input type="hidden" id="editDevolucaoId">
              <div class="mb-3">
                <label for="editDataDevolucao" class="form-label">Data Devolução</label>
                <input type="date" class="form-control" id="editDataDevolucao" required>
              </div>
              <div class="mb-3">
                <label for="editEmprestimoId" class="form-label">ID Empréstimo</label>
                <input type="text" class="form-control" id="editEmprestimoId" readonly>
              </div>
              <div class="mb-3">
                <label for="editInsumo" class="form-label">Insumo</label>
                <input type="text" class="form-control" id="editInsumo" readonly>
              </div>
              <div class="mb-3">
                <label for="editRequisitante" class="form-label">Requisitante</label>
                <input type="text" class="form-control" id="editRequisitante" readonly>
              </div>
              <div class="mb-3">
                <label for="editQuantidadeEmprestada" class="form-label">Quantidade Emprestada</label>
                <input type="number" class="form-control" id="editQuantidadeEmprestada" readonly>
              </div>
              <div class="mb-3">
                <label for="editQuantidadeDevolvida" class="form-label">Quantidade Devolvida</label>
                <input type="number" class="form-control" id="editQuantidadeDevolvida" min="1" required>
              </div>
              <div class="mb-3">
                <label for="editObs" class="form-label">Observações</label>
                <input type="text" class="form-control" id="editObs">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("keydown", function(event) {
        // Verifica se a tecla pressionada é 'Enter' e o foco está no campo de pesquisa
        if (event.key === "Enter") {
          const activeElement = document.activeElement;

          // Impede a ação padrão apenas se o foco estiver no campo de pesquisa
          if (activeElement.id === "searchDevolucao") {
            event.preventDefault();
          }
        }
      });

      $("#frmAddDevolucao input").on("input", function() {
        if (this.checkValidity()) {
          $(this).removeClass("is-invalid");
        } else {
          $(this).addClass("is-invalid");
        }
      });


      $(document).ready(function() {
        carregarEmprestimos();
      });

      // ----------------- SELEÇÃO DE EMPRÉSTIMOS ----------------------------
      function abrirSelecaoEmprestimos() {
        window.open('conexao/emprestimo/selecionarEmprestimos.php', '_blank', 'width=600,height=600');
      }

      function carregarEmprestimos() {
        $.ajax({
          url: 'conexao/devolucao/listarEmprestados.php',
          method: 'GET',
          dataType: 'json',
          success: function(response) {
            //  console.log("Debug - Empréstimos carregados:", response);//debug
            const emprestimosSelect = $('#idEmprestimo');
            emprestimosSelect.empty();
            emprestimosSelect.append('<option value="" disabled selected>Selecione um empréstimo</option>');

            response.forEach(emprestimo => {
              //  console.log(`Debug -> Insumo recebido: ${emprestimo.insumo} | Quantidade: ${emprestimo.quantidade}`);

              emprestimosSelect.append(`
                    <option value="${emprestimo.id}" 
                        data-requisitante="${emprestimo.requisitante}" 
                        data-ra="${emprestimo.ra || 'N/A'}" 
                        data-insumo="${emprestimo.insumo}" 
                        data-quantidade="${emprestimo.quantidade}">
                        ${emprestimo.requisitante} (RA: ${emprestimo.ra}) - ${emprestimo.insumo} (Qtd: ${emprestimo.quantidade})
                    </option>
                `);
            });
          },
          error: function() {
            Swal.fire('Erro!', 'Não foi possível carregar os empréstimos.', 'error');
          }
        });
      }

      //function preencherEmprestimo(id, requisitante, ra, insumo, quantidade) {
      function preencherEmprestimo(idEmprestimo, idUsuario, nomeRequisitante, ra, dataEmprestimo, insumoId, insumo, quantidade) {

        //  console.log("Debug - Emprestimo Selecionado:");
        //  console.log("ID correto:", idEmprestimo);
        //  console.log("Requisitante correto:", nomeRequisitante);
        //  console.log("ID do Requisitante:", idUsuario);
        //  console.log("RA correto:", ra);
        //  console.log("ID do Insumo:", insumoId);
        //  console.log("Insumo recebido (debug):", insumo);
        //  console.log("Quantidade correta:", quantidade);

        if (!insumo || !isNaN(insumo) || insumo.includes("-")) {
          //  console.error(" Erro! Insumo está como data ou indefinido! Insumo recebido:", insumo);//debug
          insumo = "Erro no nome do insumo";
        }

        $("#emprestimo_id").val(idEmprestimo);
        $("#requisitante_id").val(idUsuario);
        $("#emprestimo_info").val(`${nomeRequisitante} (RA: ${ra}) - ${insumo} (Qtd: ${quantidade})`);
        $("#ra").val(ra || "N/A");
        $("#insumo").val(insumoId);
        //$("#insumo").val(insumo);
        $("#quantidade_emprestada").val(quantidade);
        $("#dataEmprestimoOculta").val(dataEmprestimo);
      }

      $("#quantidade_devolvida").on("input", function() {
        let quantidadeEmprestada = parseFloat($("#quantidade_emprestada").val()) || 0;
        let quantidadeDevolvida = parseFloat($(this).val()) || 0;

        //  console.log("Debug -> Emprestado:", quantidadeEmprestada, "Devolvido:", quantidadeDevolvida);//debug

        if (quantidadeEmprestada === 0) {
          Swal.fire('Erro!', 'Erro ao obter a quantidade emprestada. Selecione novamente o empréstimo.', 'error');
          $(this).val('');
          return;
        }

        if (quantidadeDevolvida > quantidadeEmprestada) {
          Swal.fire('Erro!', 'A quantidade devolvida não pode ser maior que a emprestada!', 'error');
          $(this).val(quantidadeEmprestada);
        } else if (quantidadeDevolvida < 1) {
          Swal.fire('Erro!', 'A quantidade devolvida precisa ser pelo menos 1!', 'error');
          $(this).val('');
        }

        // mensagem automática na obs caso devolução seja parcial
        if (quantidadeDevolvida < quantidadeEmprestada) {
          $("#obs").val(`Devolução parcial: ${quantidadeDevolvida} de ${quantidadeEmprestada}.`);
        } else {
          $("#obs").val("");
        }
      });


      // --------------------------- CADASTRAR --------------------

      $('#frmAddDevolucao').submit(function(e) {
        e.preventDefault();

        const idEmprestimo = $('#emprestimo_id').val();
        const dataDevolucao = $('#dataDevolucao').val();
        const quantidadeDevolvida = $('#quantidade_devolvida').val();
        //const requisitante = $('#requisitante').val();
        const requisitante = $('#requisitante_id').val();
        const obs = $('#obs').val();
        const insumoId = $('#insumo').val();

        if (!idEmprestimo) {
          Swal.fire('Erro!', 'Selecione um empréstimo antes de continuar.', 'error');
          return;
        }

        let quantidadeEmprestada = parseFloat($("#quantidade_emprestada").val()) || 0;
        if (parseFloat(quantidadeDevolvida) > quantidadeEmprestada) {
          Swal.fire('Erro!', 'A quantidade devolvida não pode ser maior que a emprestada!', 'error');
          return;
        }

        // Criar objeto de dados para envio
        const formData = {
          dataDevolucao: dataDevolucao,
          idEmprestimo: idEmprestimo,
          requisitante: requisitante,
          insumo: insumoId,
          quantidade_devolvida: quantidadeDevolvida,
          obs: obs
        };


        $.ajax({
          type: "POST",
          url: "conexao/devolucao/cadastrarDevolucao.php",
          data: $.param(formData),
          dataType: "json",
          beforeSend: function() {
            // Desativa botão para evitar clique duplo
            $('button[type="submit"]').prop("disabled", true);
          },
          success: function(response) {
            //  console.log("Resposta do servidor:", response);//debug

            if (response.status === "success") {
              //Swal.fire('Sucesso!', response.message, 'success');
              Swal.fire({
                title: 'Sucesso!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  location.reload(); // Atualiza a página após clicar em OK
                }
              });

              // Resetar formulário
              $('#frmAddDevolucao')[0].reset();

              // Atualizar data
              const hoje = new Date();
              const dia = String(hoje.getDate()).padStart(2, '0');
              const mes = String(hoje.getMonth() + 1).padStart(2, '0');
              const ano = hoje.getFullYear();
              $('#dataDevolucao').val(`${ano}-${mes}-${dia}`);

              // atualiza a lista de devoluções e empréstimos
              carregarDevolucao();
              carregarEmprestimos(); //remove o devolvido

            } else {
              Swal.fire('Erro!', response.message, 'error');
            }
          },
          error: function(xhr, status, error) {
            Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar a devolução.', 'error');
          },
          complete: function() {
            $('button[type="submit"]').prop("disabled", false);
          }
        });

      });

      // --------------------------------- EDITAR ------------------------------------------------------------

      $(document).ready(function() {
        function preencherCampos(response) {
          $("#codigoDevolucao").val(response.id);
          $("#dataDevolucao").val(response.dataDevolucao);
          $("#idEmprestimo").val(response.idEmprestimo);
          $("#requisitante").val(response.requisitante);

          Swal.fire("Pronto!", "Edite os campos e pressione Enter para salvar as alterações.", "info"); // Mensagem de instrução

          // Adiciona evento para salvar ao pressionar Enter
          $(document).off("keydown").on("keydown", function(e) {
            if (e.key === "Enter") {
              e.preventDefault();
              salvarDados(response.id); // Salva os dados com o ID atual
              resetarCampos(); // Reseta os campos após salvar
            }
          });
        }

        $(document).ready(function() {

          //click abremodal e carregar os dados da devolução
          $(document).on("click", ".btn-editar", function() {
            const id = $(this).data("id");

            $.ajax({
              url: "conexao/devolucao/editarDevolucao.php",
              method: "POST",
              data: {
                id: id
              },
              success: function(response) {
                if (response.error) {
                  Swal.fire("Erro!", response.error, "error");
                } else {
                  // Preenche os campos no modal
                  //$("#editDevolucaoId").val(response.id);
                  //$("#editDataDevolucao").val(response.dataDevolucao);
                  //$("#editEmprestimoId").val(response.idEmprestimo);
                  //$("#editInsumo").val(response.insumo_nome);
                  //$("#editRequisitante").val(response.requisitante_nome);
                  //$("#editQuantidadeEmprestada").val(response.quantidade_emprestada);
                  //$("#editQuantidadeDevolvida").val(response.quantidade_devolvida);
                  //$("#editObs").val(response.obs);
                  $("#editDevolucaoId").val(response.id);
                  $("#editDataDevolucao").val(response.dataDevolucao).data("original", response.dataDevolucao);
                  $("#editEmprestimoId").val(response.idEmprestimo);
                  $("#editInsumo").val(response.insumo_nome);
                  $("#editRequisitante").val(response.requisitante_nome);
                  $("#editQuantidadeEmprestada").val(response.quantidade_emprestada);
                  $("#editQuantidadeDevolvida").val(response.quantidade_devolvida).data("original", response.quantidade_devolvida);
                  $("#editObs").val(response.obs).data("original", response.obs || "");

                  $("#modalEditarDevolucao").modal("show");
                }
              },
              error: function() {
                Swal.fire("Erro!", "Não foi possível carregar os dados.", "error");
              }
            });
          });

          $("#formEditarDevolucao").on("submit", function(e) {
            e.preventDefault();

            const id = $("#editDevolucaoId").val();
            const dataDevolucao = $("#editDataDevolucao").val();
            const quantidade = $("#editQuantidadeDevolvida").val();
            const obs = $("#editObs").val();

            const originalData = $("#editDataDevolucao").data("original");
            const originalQtd = $("#editQuantidadeDevolvida").data("original");
            const originalObs = $("#editObs").data("original");

            // Nenhuma alteração detectada
            if (
              dataDevolucao === originalData &&
              quantidade == originalQtd && // pode ser número ou string
              obs.trim() === originalObs.trim()
            ) {
              Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
              return;
            }

            const dados = {
              id: id,
              dataDevolucao: dataDevolucao,
              quantidade: quantidade,
              obs: obs
            };

            $.ajax({
              url: "conexao/devolucao/salvarEdicaoDevolucao.php",
              method: "POST",
              data: dados,
              dataType: "json",
              success: function(response) {
                if (response.status === "success") {
                  Swal.fire("Sucesso!", response.message, "success");
                  $("#modalEditarDevolucao").modal("hide");
                  carregarDevolucao(); // atualiza a tabela principal
                } else if (response.status === "warning") {
                  Swal.fire("Atenção!", response.message, "warning");
                } else {
                  Swal.fire("Erro!", response.message, "error");
                }
              },
              error: function(xhr, status, error) {
                console.error("Erro na requisição:", status, error);
                console.warn("Resposta completa:", xhr.responseText);
                Swal.fire("Erro!", "Erro de comunicação com o servidor.", "error");
              }
            });
          });


        });

        // Função para resetar os campos após salvar
        function resetarCampos() {
          const hoje = new Date();
          const dataAtual = `${hoje.getFullYear()}-${String(hoje.getMonth() + 1).padStart(2, '0')}-${String(hoje.getDate()).padStart(2, '0')}`;
          $("#codigoDevolucao").val(''); // Reseta o campo Código do Empréstimo
          $("#dataDevolucao").val(dataAtual); // Reseta o campo Data Empréstimo para a data atual
          $("#idEmprestimo").val(''); // Reseta o campo Insumo
          $("#requisitante").val(''); // Reseta o campo Nome Requisitante
        }
      });


      // ---------------------------------- PESQUISAR -----------------------------------------------------------

      document.addEventListener("DOMContentLoaded", function() {
        carregarDevolucao();

        // filtra a tabela ao digitar
        document.getElementById("searchDevolucao").addEventListener("input", function() {
          const requisitante = this.value.trim();

          // Se o campo estiver vazio, carrega todos os registros novamente
          if (requisitante === "") {
            carregarDevolucao();
            return;
          }

          // Caso contrário, realiza a pesquisa pelo Insumo digitado
          $.ajax({
            url: "conexao/devolucao/pesquisarDevolucao.php",
            method: "POST",
            data: {
              requisitante: requisitante
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


      // ------------------------- LISTAR ----------------------------------

      function carregarDevolucao() {
        $.ajax({
          url: "conexao/devolucao/listarDevolucao.php",
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
        carregarDevolucao();
      });

      // --------------------------------- EXCLUIR ------------------------------------------------------------

      $(document).on("click", ".btn-excluir", function() {
        const id = $(this).data("id");

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
              url: "conexao/devolucao/excluirDevolucao.php",
              method: "POST",
              data: {
                id: id
              },
              dataType: "json",
              success: function(response) {
                if (response.status === "success") {
                  Swal.fire("Excluído!", response.message, "success");
                  carregarDevolucao();
                } else {
                  Swal.fire("Erro!", response.message, "error");
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
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
            url: "conexao/devolucao/visualizarDevolucao.php",
            method: "POST",
            data: {
              id: id
            },
            success: function(response) {
              $("#modal-body-content").html(response);
              $("#modalVisualizar").modal("show"); // Abre o modal com os detalhes
            },
            error: function() {
              Swal.fire("Erro!", "Não foi possível visualizar os dados.", "error");
            }
          });
        });
      });

      // --------------------------------- PREENCHER TABELA ------------------------------------------------------------

      function preencherTabela(dados) {
        const tbody = document.getElementById('dadosTabela');
        tbody.innerHTML = '';

        dados.forEach(devolucao => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
          <td>${devolucao.requisitante}</td>
          <td>${devolucao.dataDevolucao}</td>
          <td>${devolucao.insumo_nome}</td>
          <td>${devolucao.obs}</td>
          <td><button type="button" class="btn btn-primary">Visualizar</button></td>
          <td><button type="button" class="btn btn-success">Editar</button></td>
          <td><button type="button" class="btn btn-danger">Excluir</button></td>
        `;
          tbody.appendChild(tr);
        });
      }

      carregarDevolucao();

      // Pressionar Enter dentro do modal de edição envia
      $('#modalEditarDevolucao').on('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault(); // Impede envio duplicado
          $('#formEditarDevolucao').submit(); // Força o envio
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