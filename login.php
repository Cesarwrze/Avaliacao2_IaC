<?php
session_start();
if (isset($_SESSION['usuario'])) {
  header("Location: home.php");
  exit();
}
?>


<!DOCTYPE html>
<!-- saved from url=(0051)https://getbootstrap.com/docs/5.3/examples/sign-in/ -->
<html lang="en" data-bs-theme="light">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <!-- Logo-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS (including Popper.js) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom styles for this template -->
  <link href="./login_files/sign-in.css" rel="stylesheet">


  <style>
    #error-message {
      color: red;
      font-size: 14px;
      font-weight: bold;
      margin-top: 10px;
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

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    .fixed-input {
      display: flex;
    }

    .fixed-input input {
      flex-grow: 1;
    }

    .fixed-input .fixed-char {
      background-color: #eee;
      padding: 5px;
      display: flex;
      align-items: center;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./login_files/sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

  <main class="form-signin w-100 m-auto">
    <form id="login-form">
      <img class="d-block mx-auto mb-4" src="./assets/img/thumbnail_logo_TSI.png" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Login</h1>

      <div class="fixed-input">
        <span class="input-group-text">a</span>
        <input type="text" id="ra" placeholder="RA" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
      </div>


      <div class="form-floating">
        <input type="password" class="form-control" id="senha" placeholder="Senha" required>
        <label for="senha">Senha</label>
      </div>

      <!-- Adicione esta div para a mensagem de erro -->
      <div id="error-message" style="color: red; font-weight: bold; display: none; margin-top: 10px;">
        <!-- A mensagem será preenchida dinamicamente -->
      </div>

      <div class="form-check text-start my-3">
        <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Lembre-me
        </label>
      </div>
      <button id="loginButton" class="btn btn-secondary w-100 py-2" type="submit">Login</button>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script>
        $(document).ready(function() {

          //// teste
          $(function() {
            const lembrar = localStorage.getItem('lembrar') === 'true';

            if (lembrar) {
              $('#ra').val(localStorage.getItem('ra'));
              $('#senha').val(localStorage.getItem('senha'));
              $('#flexCheckDefault').prop('checked', true);
            }
          });
          ///////


          $('#login-form').on('submit', function(e) {
            e.preventDefault(); // Evita que o formulário seja enviado de forma tradicional

            var ra = $('#ra').val();
            var senha = $('#senha').val();

            if (ra === "" || senha === "") {
              $('#error-message').text('Por favor, preencha todos os campos.');
              $('#error-message').show();
              return;
            }

            $.ajax({
              type: "POST",
              url: "conexao/consultarUser.php",
              data: {
                usuario: ra,
                senha: senha
              },
              dataType: "json",

              //              success: function (response) {
              //                console.log(response);  // Adicione esta linha para verificar a resposta do servidor
              //                if (response.status === "success") {
              //                  // Redireciona para a página home
              //                  window.location.href = "home.html";
              //                } else {
              //                  // Exibe a mensagem de erro corretamente
              //                  $('#error-message').text(response.message);
              //                  $('#error-message').show();
              //                }
              //              },
              success: function(response) {
                if (response.status === "success") {
                  // Se "Lembre-me" estiver marcado, salva no localStorage
                  if ($('#flexCheckDefault').is(':checked')) {
                    localStorage.setItem('ra', $('#ra').val());
                    localStorage.setItem('senha', $('#senha').val());
                    //sessionStorage.setItem('senha', $('#senha').val()); // apaga a senha ao fechar navegador
                    localStorage.setItem('lembrar', 'true');
                  } else {
                    // Se desmarcado, limpa o armazenamento
                    localStorage.removeItem('ra');
                    localStorage.removeItem('senha');
                    localStorage.setItem('lembrar', 'false');
                  }

                  window.location.href = "home.php";
                } else {
                  $('#error-message').text(response.message).show();
                }
              }


            });
          });
        });
      </script>
    </form>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6D4gU5JQ7gN3F5oxn3A5iQvCkHxVZl6U2UZNE2wZ2lJo"
    crossorigin="anonymous"></script>





</body>

</html>