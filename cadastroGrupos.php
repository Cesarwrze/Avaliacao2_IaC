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
  <script src="./cadastroGrupos_files/color-modes.js.transferir"></script>

  <!--LOGO-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">

  <title>Cadastro Grupos</title>

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
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: auto;
      padding-bottom: 5px;
    }

    .container {
      height: 100vh;
      padding-bottom: 5px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-y: auto;
      padding-top: 50px;
    }

    main {
      width: 100%;
      max-width: 600px;
      padding: 15px;
      box-sizing: border-box;
    }

    .form-control {
      width: 100%;
    }

    .table-container {
      width: 100%;
      max-width: 600px;
      box-sizing: border-box;
      margin-top: 30px;
      overflow-y: auto;
      max-height: 300px;
    }

    table {
      width: 100%;
    }

    .btn {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
    }

    .btn-small {
      padding: 2px 5px;
      font-size: 0.875rem;
    }

    .search-bar {
      display: flex;
      align-items: center;
      margin-top: 20px;
    }

    .search-bar .form-control {
      flex: 3;
      margin-right: 10px;
    }

    .search-bar .btn {
      flex: 1;
      white-space: nowrap;
    }

    h4 {
      font-weight: bold;
    }

    .form-row {
      margin-bottom: 1rem;
    }

    .form-row .form-control {
      margin-right: 10px;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
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
            <a class="dropdown-item" href="relatorioInsumo.php">Mais Consumidos</a>
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

  <div class="container">
    <main>
      <div class="text-center">
        <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
        <h2>Cadastro de Grupos</h2>
        <p class="lead"><strong>Insira os dados corretamente</strong></p>
        <br>
      </div>

      <form class="needs-validation" novalidate="" name="frmAddGrupos" id="frmAddGrupos" method="post">
        <div class="row g-3">
          <div class="col-md-3 d-flex justify-content-start align-items-center">
            <button name='submit' type="submit" id="btnAddGrupos" class="btn btn-outline-dark btn-sm"
              style="width: 150px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16" style="margin-right: 5px;">
                <path
                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
              </svg>
              Criar Grupo
            </button>
          </div>
        </div>

        <div class="row g-3 mt-2">
          <div class="col-md-3">
            <label for="codigoGrupo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigoGrupo" readonly>
          </div>

          <div class="col-md-9">
            <label for="grupo" class="form-label">Grupo</label>
            <input type="text" class="form-control" id="grupo" required="">
            <div class="invalid-feedback">
              Obrigatório preenchimento do campo.
            </div>
          </div>
        </div>


      </form>


      <!--PESQUISAR-->
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            <div class="search-bar d-flex align-items-center">
              <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
              <input id="searchGrupo" class="form-control w-100" type="search" placeholder="Pesquisar Grupo"
                aria-label="Pesquisar">
            </div>
          </div>
        </div>
      </div>



    </main>

    <div class="table-container">
      <table class="table table-hover">
        <thead class="table table-sm">
          <tr>
            <!--<th>ID</th>-->
            <th>Grupo</th>
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

  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="./emprestimo_files/bootstrap.bundle.min.js.transferir"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="./emprestimo_files/checkout.js.transferir"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Modal para visualizar grupo -->
  <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVisualizarLabel">Detalhes do Grupo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body-content">
          <!-- detalhes grupo -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar grupo -->
  <div class="modal fade" id="modalEditarGrupo" tabindex="-1" aria-labelledby="modalEditarGrupoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarGrupoLabel">Editar Grupo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formEditarGrupo">
            <input type="hidden" id="edit_id" name="id"> <!-- ID escondido -->
            <div class="mb-3">
              <label for="edit_grupo" class="form-label">Nome do Grupo</label>
              <input type="text" class="form-control" id="edit_grupo" name="grupo" required>
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
        if (activeElement.id === "searchGrupo") {
          event.preventDefault();
        }
      }
    });

    $("#frmAddGrupos input").on("input", function() {
      if (this.checkValidity()) {
        $(this).removeClass("is-invalid");
      } else {
        $(this).addClass("is-invalid");
      }
    });

    // ------------------- CADASTRAR --------------------------------------
    $("#frmAddGrupos").submit(function(e) {
      e.preventDefault();

      const grupo = $("#grupo").val().trim();

      // Verifica se o formulário é válido
      if (!this.checkValidity()) {
        return;
      }

      $.ajax({
        type: "POST",
        url: "conexao/grupos/cadastrarGrupos.php",
        data: {
          grupo: grupo
        },
        success: function(response) {
          //console.log("Resposta do servidor:", response); // DEBUG
          const [status, message] = response.split('|');
          if (status === "1") {
            //Swal.fire('Sucesso!', response.message, 'success');
            Swal.fire({
              title: 'Sucesso!',
              //text: response.message,
              text: message,
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload(); // Atualiza a página após clicar em OK
              }
            });
          } else {
            $("#grupo").removeClass("is-valid").addClass("is-invalid");
            Swal.fire('Erro!', message, 'error');
            $("#grupo").val(""); // limpa o campo

          }
        },
        error: function() {
          Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar o grupo.', 'error');
        }
      });
    });

    // ---------------------------------- PESQUISAR -----------------------------------------------------------

    $(document).ready(function() {
      $("#searchGrupo").on("input", function() {
        const grupo = $(this).val().trim(); // Pega o valor do input

        if (grupo === "") {
          carregarGrupos(); // Se estiver vazio, carrega tudo
          return;
        }

        //console.log("Pesquisando por:", grupo); // DEBUG

        $.ajax({
          url: "conexao/grupos/pesquisarGrupo.php",
          method: "POST",
          data: {
            grupo: grupo
          },
          success: function(response) {
            //console.log("Resposta da pesquisa:", response); // DEBUG
            $("#dadosTabela").html(response); // Atualiza os resultados na tabela
          },
          error: function(xhr, status, error) {
            //console.error("Erro na pesquisa:", status, error); // DEBUG
            Swal.fire("Erro!", "Não foi possível buscar os dados.", "error");
          }
        });
      });
    });


    // ---------------------------------- LISTAR -----------------------------------------------------------

    function carregarGrupos() {
      //console.log("Enviando requisição para listarGrupos.php...");// DEBUG

      $.ajax({
        url: "conexao/grupos/listarGrupos.php",
        method: "GET",
        dataType: "json",
        success: function(dados) {
          // console.log("Debug - Grupos carregados:", dados);// DEBUG

          const tabela = $("#dadosTabela"); // Obtém o tbody da tabela
          tabela.empty(); // Limpa a tabela antes de inserir os novos dados

          // Verifica se há dados
          if (dados.length === 0) {
            // console.warn("Nenhum grupo encontrado.");// DEBUG
            tabela.html("<tr><td colspan='4' class='text-center'>Nenhum grupo encontrado.</td></tr>");
            return;
          }

          // Percorre os dados e insere na tabela
          dados.forEach(grupo => {
            tabela.append(`
                    <tr>
                        <td>${grupo.grupo}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm btn-visualizar"
                                data-id="${grupo.id}">Visualizar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm btn-editar"
                                data-id="${grupo.id}">Editar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm btn-excluir"
                                data-id="${grupo.id}">Excluir</button>
                        </td>
                    </tr>
                `);
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //console.error("Erro ao carregar grupos:", textStatus, errorThrown);// DEBUG
          Swal.fire("Erro!", "Não foi possível carregar os grupos.", "error");
        }
      });
    }

    // Atualiza a tabela ao carregar a página
    $(document).ready(function() {
      carregarGrupos();
    });


    // --------------------------------- EDITAR ------------------------------------------------------------

    $(document).ready(function() {
      let grupoOriginal = ""; // Salva o valor original do grupo

      $(document).on("click", ".btn-editar", function() {
        const id = $(this).data("id");

        $.ajax({
          url: "conexao/grupos/editarGrupos.php",
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
              $("#edit_grupo").val(response.grupo);

              // Salva valor original para comparação posterior
              grupoOriginal = response.grupo;

              // Abrir modal
              $("#modalEditarGrupo").modal("show");
            }
          },
          error: function() {
            Swal.fire("Erro!", "Não foi possível carregar os dados.", "error");
          }
        });
      });

      $("#formEditarGrupo").submit(function(e) {
        e.preventDefault();

        const id = $("#edit_id").val();
        const grupo = $("#edit_grupo").val().trim();

        if (grupo === "") {
          Swal.fire("Erro!", "O campo Grupo não pode estar vazio.", "error");
          return;
        }

        // Verificação de alteração
        if (grupo === grupoOriginal) {
          Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
          return;
        }

        $.ajax({
          url: "conexao/grupos/salvarEdicaoGrupos.php",
          method: "POST",
          data: {
            id: id,
            grupo: grupo
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
                  $("#modalEditarGrupo").modal("hide");
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


    // Resetar os campos do formulário de edição após salvar
    function resetarCampos() {
      $("#edit_id").val('');
      $("#edit_grupo").val('');
    }

    // --------------------------------- EXCLUIR ------------------------------------------------------------

    $(document).on("click", ".btn-excluir", function() {
      const id = $(this).data("id");

      // Verificar se o ID foi capturado corretamente
      //console.log("ID capturado para exclusão: ", id);// DEBUG

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
            url: "conexao/grupos/excluirGrupo.php",
            method: "POST",
            data: {
              id: id
            },
            dataType: "json",
            success: function(response) {
              //console.log("Resposta do servidor: ", response);// DEBUG
              if (response.status === "success") {
                Swal.fire("Excluído!", response.message, "success");
                carregarGrupos(); // Atualiza a tabela
              } else {
                Swal.fire("Erro!", response.message, "error");
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              //  console.error("Erro AJAX: ", textStatus, errorThrown);// DEBUG
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
          url: "conexao/grupos/visualizarGrupo.php",
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