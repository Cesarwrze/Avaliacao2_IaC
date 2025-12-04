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
  <!--LOGO-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">

  <title>Cadastro Usuários</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

  <link rel="stylesheet" href="./emprestimo_files/css@3">
  <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./emprestimo_files/checkout.css" rel="stylesheet">
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <link href="./home_files/starter-template.css" rel="stylesheet">

  <script src="./cadastroGrupos_files/color-modes.js.transferir"></script>
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
      padding-bottom: 20px;
      height: 100%;
      overflow-y: auto;
      /* Permite a rolagem vertical na página */
      padding-bottom: 5px;
    }

    .container {
      min-height: calc(100vh - 20px);
      display: flex;
      justify-content: center;
      align-items: flex-start;
      /* Alinha o conteúdo ao topo */
      padding-bottom: 5px;
      box-sizing: border-box;
      height: 100%;
      flex-direction: column;
      overflow: visible;
      /* Permite o conteúdo transbordar se necessário */
    }

    main {
      width: 100%;
      max-width: 600px;
      padding: 15px;
      box-sizing: border-box;
    }

    .form-control {
      flex-grow: 1;
      /* Faz com que o input ocupe o máximo de espaço possível */
    }



    .table-container {
      width: 100%;
      box-sizing: border-box;
      margin-top: 30px;
      overflow-y: auto;
      /* Mantém a rolagem apenas na tabela */
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
      /* Espaçamento acima da barra de pesquisa */
      margin-bottom: 20px;
      /* Espaçamento abaixo da barra de pesquisa */
    }

    .search-bar .form-control {
      flex: 3;
      /* O input de pesquisa ocupará 75% do espaço */
      margin-right: 10px;
      /* Espaçamento entre o campo e o botão */
    }

    .search-bar .btn {
      flex: 1;
      /* O botão ocupará 25% do espaço */
      white-space: nowrap;
      /* Garante que o texto do botão não quebre */
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
  <!-- Navbar -->
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

  <!-- Formulário de Cadastro -->
  <div class="container" style="height: 100vh;">
    <div class="row h-100 justify-content-center align-items-center">
      <main class="col-md-7 col-lg-8">
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
          <h2>Cadastro de Usuários</h2>
          <p class="lead"><strong>Insira os dados corretamente</strong></p>
        </div>
        <form class="needs-validation" novalidate="" name="frmAddUser" id="frmAddUser" method="post">
          <div class="row g-3">
            <div class="col-12 d-flex justify-content-start">
              <button name="submit" type="submit" id="btnAddUser" class="btn btn-outline-dark btn-sm"
                style="width: 150px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus"
                  viewBox="0 0 16 16" style="margin-right: 5px;">
                  <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>
                Criar Usuário
              </button>
            </div>

            <div class="row g-3">
              <!-- Código e Data -->
              <div class="col-md-6">
                <label for="codigoUsuario" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigoUsuario" name="codigoUsuario" readonly>
              </div>
              <div class="col-md-6">
                <label for="dataCadastroUsuario" class="form-label">Data Cadastro</label>
                <input type="date" class="form-control" id="dataCadastroUsuario" name="dataCadastroUsuario" required=""
                  readonly>
              </div>
              <script>
                function getDataAtual() {
                  const dataCadastroUsuario = new Date();
                  const ano = dataCadastroUsuario.getFullYear();
                  const mes = String(dataCadastroUsuario.getMonth() + 1).padStart(2, '0');
                  const dia = String(dataCadastroUsuario.getDate()).padStart(2, '0');
                  return `${ano}-${mes}-${dia}`;
                }

                document.addEventListener('DOMContentLoaded', function() {
                  const inputData = document.getElementById('dataCadastroUsuario');
                  inputData.value = getDataAtual();
                });
              </script>

              <!-- Nome -->
              <div class="col-12">
                <label for="nomeUsuario" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>

              <!-- RA e Área -->
              <div class="col-md-6 fixed-input">
                <label for="raUsuario" class="form-label">Matrícula (RA)</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">a</span>
                  </div>
                  <input type="text" placeholder="Somente números" class="form-control" id="raUsuario" name="raUsuario"
                    required="" oninput="this.value = this.value.replace(/[^0-9]/g, ''); syncLogin();">
                </div>
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <script>
                function syncLogin() {
                  const raInput = document.getElementById('raUsuario');
                  const loginInput = document.getElementById('loginUsuario');
                  loginInput.value = raInput.value; // Copia o valor de 'RA' para 'Login'
                }
              </script>

              <div class="col-md-6">
                <label class="form-label">Área</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="areaUsuario" id="areaADM" value="ADM" required>
                  <label class="form-check-label" for="areaADM">
                    ADM
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="areaUsuario" id="areaSupervisor" value="Supervisor"
                    required>
                  <label class="form-check-label" for="areaSupervisor">
                    Supervisor
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="areaUsuario" id="areaRequisitante"
                    value="Requisitante" required>
                  <label class="form-check-label" for="areaRequisitante">
                    Requisitante
                  </label>
                </div>
                <div class="invalid-feedback">
                  Obrigatório selecionar uma área.
                </div>
              </div>

              <!-- Email e Telefone -->
              <div class="col-md-6">
                <label for="emailUsuario" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <!-- Campo de telefone -->
              <div class="col-md-6">
                <label for="telefoneUsuario" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefoneUsuario" name="telefoneUsuario" required
                  maxlength="16">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>

              <!-- Login e Senha -->
              <div class="col-md-6">
                <label for="loginUsuario" class="form-label">Login</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">a</span>
                  </div>
                  <input type="text" placeholder="Matrícula (RA)" class="form-control" name="loginUsuario"
                    id="loginUsuario" required="" readonly>
                  <!-- Adiciona o atributo 'readonly' para impedir edição manual -->
                </div>
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
              <div class="col-md-6">
                <label for="senhaUsuario" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senhaUsuario" id="senhaUsuario" required="">
                <div class="invalid-feedback">
                  Obrigatório preenchimento do campo.
                </div>
              </div>
            </div>

        </form>

        <!-- PESQUISAR -->
        <div class="container-fluid">
          <div class="row mt-4">
            <div class="col-12">
              <div class="search-bar d-flex align-items-center">
                <label for="pesquisar" class="form-label me-2">Pesquisar:</label>
                <input id="searchRA" class="form-control w-100" type="search"
                  placeholder="Pesquisar Usuário (Nome ou RA)" aria-label="Pesquisar">
              </div>
            </div>
          </div>
        </div>

        <!-- Tabela -->
        <div class="table-container mt-4">
          <table class="table table-hover table-bordered">
            <thead class="table table-sm">
              <tr>
                <!--<th>ID</th>-->
                <th>Nome</th>
                <th>RA</th>
                <th>E-mail</th>
                <th>Área</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
              </tr>
            </thead>
            <tbody id="dadosTabela">
              <!-- Dados carregados dinamicamente -->
            </tbody>
          </table>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Modal para Visualizar Usuário -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-labelledby="modalVisualizarLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalVisualizarLabel">Detalhes do Usuário</h5>
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

    <!-- Modal para editar usuário -->
    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuário</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formEditarUsuario">
              <input type="hidden" id="edit_id" name="id"> <!-- ID escondido -->

              <!-- Nome -->
              <div class="mb-3">
                <label for="edit_nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="edit_nome" name="nome" required>
              </div>

              <!-- Matrícula (RA) -->
              <div class="mb-3">
                <label for="edit_ra" class="form-label">Matrícula (RA)</label>
                <input type="text" class="form-control" id="edit_ra" name="ra" required>
              </div>

              <!-- Login (atualiza automaticamente com o RA) -->
              <div class="mb-3">
                <label for="edit_login" class="form-label">Login</label>
                <input type="text" class="form-control" id="edit_login" name="login" readonly>
              </div>

              <!-- E-mail -->
              <div class="mb-3">
                <label for="edit_email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="edit_email" name="email" required>
              </div>

              <!-- Telefone -->
              <div class="mb-3">
                <label for="edit_telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="edit_telefone" name="telefone" required>
              </div>

              <!-- Área -->
              <div class="mb-3">
                <label class="form-label">Área</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="edit_area" id="edit_areaADM" value="ADM" required>
                  <label class="form-check-label" for="edit_areaADM">ADM</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="edit_area" id="edit_areaSupervisor"
                    value="Supervisor" required>
                  <label class="form-check-label" for="edit_areaSupervisor">Supervisor</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="edit_area" id="edit_areaRequisitante"
                    value="Requisitante" required>
                  <label class="form-check-label" for="edit_areaRequisitante">Requisitante</label>
                </div>
              </div>

              <!-- Senha -->
              <div class="mb-3">
                <label for="edit_senha" class="form-label">Senha (Deixe em branco para manter a atual)</label>
                <input type="password" class="form-control" id="edit_senha" name="senha">
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




    <!-- INÍCIO DAS FUNÇÕES -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const camposTelefone = ["telefoneUsuario", "edit_telefone"];

        camposTelefone.forEach(id => {
          const input = document.getElementById(id);
          if (!input) return;

          input.addEventListener("input", function() {
            let numero = input.value.replace(/\D/g, ""); // Remove não números

            numero = numero.substring(0, 11); // Limita a 11 dígitos
            let formatado = "";

            if (numero.length >= 1) {
              formatado += "(" + numero.substring(0, 2);
            }
            if (numero.length >= 3) {
              formatado += ") " + numero.substring(2, 3);
            }
            if (numero.length >= 4) {
              formatado += " " + numero.substring(3, 7);
            }
            if (numero.length >= 8) {
              formatado += "-" + numero.substring(7, 11);
            }

            input.value = formatado;
          });
        });
      });

      document.addEventListener("keydown", function(event) {
        const element = document.activeElement;

        // Só bloqueia se NÃO estivermos no formulário
        if (event.key === "Enter" && element.tagName === "INPUT" && !element.form) {
          event.preventDefault();
        }
      });

      $("#frmAddUser input").on("input", function() {
        if (this.checkValidity()) {
          $(this).removeClass("is-invalid");
        } else {
          $(this).addClass("is-invalid");
        }
      });

      // ---------------------------------- CADASTRAR -----------------------------------------------------------

      document.addEventListener('DOMContentLoaded', function() {
        const inputData = document.getElementById('dataCadastroUsuario');
        if (!inputData.value) { // Define a data apenas se o campo estiver vazio
          const dataAtual = new Date();
          const ano = dataAtual.getFullYear();
          const mes = String(dataAtual.getMonth() + 1).padStart(2, '0');
          const dia = String(dataAtual.getDate()).padStart(2, '0');
          inputData.value = `${ano}-${mes}-${dia}`;
        }
      });

      $('#frmAddUser').submit(function(e) {
        e.preventDefault();

        // Verifica se o formulário é válido
        if (!this.checkValidity()) {
          // Se o formulário não for válido, ativa as mensagens nativas do navegador
          //this.reportValidity();
          return;
        }

        $.ajax({
          type: "POST",
          url: "conexao/usuarios/cadastrarUser.php",
          data: $(this).serialize(),
          //data: { usuario: usuario },
          success: function(response) {
            //console.log("Resposta do servidor:", response); //DEBUG
            //const [status, message] = response.split('|'); // Divide a resposta
            const [status, message] = response.split('|').map(s => s.trim());

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

              // Limpa os campos do formulário, exceto o campo de data
              $('#frmAddUser').find('input').not('#dataCadastroUsuario').val(''); // Limpa os inputs (exceto data)
              $('#frmAddUser').find('textarea').val(''); // Limpa textareas
              $('#frmAddUser').find('select').prop('selectedIndex', 0); // Reseta selects
              $('#frmAddUser').find('input[type="radio"]').prop('checked', false); // Desmarca rádios
              $('#frmAddUser').find('input[type="checkbox"]').prop('checked', false); // Desmarca checkbox
            } else {
              Swal.fire('Erro!', message, 'error');
            }
          },
          error: function() {
            Swal.fire('Erro!', 'Ocorreu um erro ao cadastrar o usuário.', 'error');
          }
        });
      });


      // ---------------------------------- PESQUISAR -----------------------------------------------------------

      document.addEventListener("DOMContentLoaded", function() {
        carregarTodosUsuarios();

        document.getElementById("searchRA").addEventListener("input", function() {
          const raUsuario = this.value.trim();

          // Se o campo estiver vazio, carrega todos os registros novamente
          if (raUsuario === "") {
            carregarTodosUsuarios();
            return;
          }

          // Caso contrário, realiza a pesquisa pelo RA digitado
          $.ajax({
            url: "conexao/usuarios/pesquisarUsuario.php",
            method: "POST",
            data: {
              ra: raUsuario
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
      function carregarTodosUsuarios() {
        $.ajax({
          url: "conexao/usuarios/listarUsuarios.php",
          method: "GET",
          success: function(response) {
            document.getElementById("dadosTabela").innerHTML = response;
          },
          error: function() {
            Swal.fire('Erro!', 'Não foi possível carregar os dados.', 'error');
          }
        });
      }


      // ---------------------------------- LISTAR -----------------------------------------------------------
      function carregarUsuarios() {
        $.ajax({
          url: "conexao/usuarios/listarUsuarios.php",
          method: "GET",
          success: function(response) {
            const tabela = $("#dadosTabela");

            if (!response.trim() || response.trim().replace(/\s/g, '') === '') {
              tabela.html(`
          <tr>
            <td colspan="7" class="text-center align-middle text-black py-4">
              Nenhum usuário encontrado.
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


      // Recarregar os dados ao carregar a página
      $(document).ready(function() {
        carregarUsuarios();
      });


      document.addEventListener("keydown", function(event) {
        // Verifica se a tecla pressionada é 'Enter' e o foco está em um campo do formulário
        if (event.key === "Enter") {
          const element = document.activeElement;
          if (element.tagName === "INPUT" || element.tagName === "TEXTAREA") {
            event.preventDefault(); // Impede o comportamento padrão (submissão do formulário)
            return false;
          }
        }
      });



      // --------------------------------- VISUALIZAR ------------------------------------------------------------      

      $(document).ready(function() {
        $(document).on("click", ".btn-visualizar", function() {
          const id = $(this).data("id");

          $.ajax({
            url: "conexao/usuarios/visualizarUsuario.php",
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

        // ---------------------------------------------------------------------------------------------
        $(document).ready(function() {
          $(document).on("click", ".btn-editar", function() {
            const id = $(this).data("id");

            $.ajax({
              url: "conexao/usuarios/editarUsuario.php",
              method: "POST",
              data: {
                id: id
              },
              dataType: "json",
              success: function(response) {
                if (response.error) {
                  Swal.fire("Erro!", response.error, "error");
                } else {
                  // Preenche os campos com os dados recebidos e salva valores originais
                  $("#edit_id").val(response.id);
                  $("#edit_nome").val(response.nome).data("original", response.nome);
                  $("#edit_ra").val(response.ra).data("original", response.ra);
                  $("#edit_login").val(response.ra).data("original", response.ra);
                  $("#edit_email").val(response.email).data("original", response.email);
                  $("#edit_telefone").val(response.telefone).data("original", response.telefone);

                  // Limpa radios e marca o correto, salvando valor original
                  $("input[name='edit_area']").each(function() {
                    $(this).prop("checked", false);
                    if ($(this).val() === response.area) {
                      $(this).prop("checked", true).data("original", true);
                    } else {
                      $(this).data("original", false);
                    }
                  });

                  $("#edit_senha").val("");

                  $("#modalEditarUsuario").modal("show");
                }
              },
              error: function() {
                Swal.fire("Erro!", "Não foi possível carregar os dados do usuário.", "error");
              }
            });
          });

          // Atualizar o Login quando o RA for alterado
          $("#edit_ra").on("input", function() {
            $("#edit_login").val($(this).val());
          });

          // Salvar alterações ao clicar no botão "Salvar Alterações"
          $("#formEditarUsuario").submit(function(e) {
            e.preventDefault();

            const id = $("#edit_id").val();
            const nome = $("#edit_nome").val();
            const ra = $("#edit_ra").val();
            const email = $("#edit_email").val();
            const telefone = $("#edit_telefone").val();
            const area = $("input[name='edit_area']:checked").val();
            const senha = $("#edit_senha").val(); // Senha pode ser vazia

            const houveAlteracao =
              nome !== $("#edit_nome").data("original") ||
              ra !== $("#edit_ra").data("original") ||
              email !== $("#edit_email").data("original") ||
              telefone !== $("#edit_telefone").data("original") ||
              senha !== "" ||
              !$("input[name='edit_area']:checked").data("original");

            if (!houveAlteracao) {
              Swal.fire("Atenção!", "Nenhuma alteração foi feita.", "info");
              return;
            }

            $.ajax({
              url: "conexao/usuarios/salvarEdicaoUsuario.php",
              method: "POST",
              data: {
                id,
                nome,
                ra,
                email,
                telefone,
                area,
                senha
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
                      $("#modalEditarUsuario").modal("hide");
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

        // Função para resetar os campos após salvar
        function resetarCampos() {
          $("#codigoUsuario").val('');
          $("#nomeUsuario").val('');
          $("#raUsuario").val('');
          $("#emailUsuario").val('');
          $("#telefoneUsuario").val('');
          $("input[name='areaUsuario']").prop("checked", false); // Desmarca todos os rádios
          $("#senhaUsuario").val('');
          $("#loginUsuario").val('');
        }

        // --------------------------------- EXCLUIR ------------------------------------------------------------

        $(document).on("click", ".btn-excluir", function() {
          const id = $(this).data("id");

          // Verificar se o ID foi capturado corretamente
          // console.log("ID capturado para exclusão: ", id);//DEBUG


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
                url: "conexao/usuarios/excluirUsuario.php",
                method: "POST",
                data: {
                  id: id
                },
                dataType: "json", // Espera uma resposta JSON
                success: function(response) {
                  //  console.log("Resposta do servidor: ", response); //DEBUG
                  if (response.status === "success") {
                    Swal.fire("Excluído!", response.message, "success");
                    carregarUsuarios(); // Atualiza a tabela
                  } else {
                    Swal.fire("Erro!", response.message, "error");
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  //  console.error("Erro AJAX: ", textStatus, errorThrown);//DEBUG
                  Swal.fire("Erro!", "Não foi possível excluir o registro.", "error");
                }
              });
            }
          });
        });

        // --------------------------------- PREENCHER TABELA ------------------------------------------------------------

        function preencherTabela(dados) {
          const tbody = document.getElementById('dadosTabela');
          tbody.innerHTML = '';

          dados.forEach(usuario => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
          <td>${usuario.id}</td>
          <td>${usuario.nome}</td>
          <td>${usuario.dataCadastroUsuario}</td>
          <td>${usuario.nivel}</td>
          <td><button type="button" class="btn btn-primary">Visualizar</button></td>
          <td><button type="button" class="btn btn-success">Editar</button></td>
          <td><button type="button" class="btn btn-danger">Excluir</button></td>
        `;
            tbody.appendChild(tr);
          });
        }

        // Carrega os dados assim que a página é carregada
        carregarUsuarios();

      });

      // Pressionar Enter dentro do modal de edição envia o formulário
      $('#modalEditarUsuario').on('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          $('#formEditarUsuario').submit();
        }
      });

      // Dispara o envio do formulário ao pressionar Enter
      document.querySelector("#frmAddUser").addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
          event.preventDefault();

          const form = this;

          // Valida se todos os campos obrigatórios estiverem corretos
          if (form.checkValidity()) {
            $('#frmAddUser').submit();
          } else {
            form.classList.add("was-validated");
          }
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