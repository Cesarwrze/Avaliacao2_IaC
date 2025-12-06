<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Endereços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="./home_files/starter-template.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            padding-top: 56px;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="home.php" style="color:white; margin-left: 20px;">HOME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        style="color:white;">Manutenção</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
                        <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
                        <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
                        <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
                        <a class="dropdown-item" href="cadastroEnderecos.php">Endereços</a>
                    </div>
                </li>
            </ul>
            <a class="btn btn-outline-light me-3 ms-auto" href="logout.php">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2>Cadastro de Endereços</h2>
            <p class="lead">Gerencie os endereços do sistema</p>
        </div>

        <form id="frmAddEndereco" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="rua" name="rua" required>
                </div>
                <div class="col-md-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
                <div class="col-md-4">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
                <div class="col-md-6">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-dark w-100">Cadastrar Endereço</button>
                </div>
            </div>
        </form>

        <div class="table-container">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>CEP</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="dadosTabela">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalVisualizar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalhes do Endereço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-body-content"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Endereço</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label class="form-label">Rua</label>
                            <input type="text" class="form-control" id="edit_rua" name="rua" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" id="edit_numero" name="numero" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CEP</label>
                            <input type="text" class="form-control" id="edit_cep" name="cep" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="edit_cidade" name="cidade" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <input type="text" class="form-control" id="edit_estado" name="estado" required>
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
        $(document).ready(function () {
            carregarEnderecos();

            $('#frmAddEndereco').submit(function (e) {
                e.preventDefault();
                if (!this.checkValidity()) return;

                $.ajax({
                    url: 'conexao/enderecos/cadastrarEndereco.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        const [status, msg] = response.split('|');
                        if (status === '1') {
                            Swal.fire('Sucesso!', msg, 'success').then(() => {
                                $('#frmAddEndereco')[0].reset();
                                carregarEnderecos();
                            });
                        } else {
                            Swal.fire('Erro!', msg, 'error');
                        }
                    },
                    error: function () { Swal.fire('Erro!', 'Falha na requisição.', 'error'); }
                });
            });

            $('#searchEndereco').on('input', function () {
                let termo = $(this).val();
                let url = termo === '' ? 'conexao/enderecos/listarEnderecos.php' : 'conexao/enderecos/pesquisarEndereco.php';
                let data = termo === '' ? {} : { rua: termo };

                $.ajax({
                    url: url,
                    method: termo === '' ? 'GET' : 'POST',
                    data: data,
                    success: function (response) { $('#dadosTabela').html(response); }
                });
            });

            $(document).on('click', '.btn-editar', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: 'conexao/enderecos/editarEndereco.php',
                    method: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {
                        if (data.error) {
                            Swal.fire('Erro', data.error, 'error');
                        } else {
                            $('#edit_id').val(data.id);
                            $('#edit_rua').val(data.rua);
                            $('#edit_numero').val(data.numero);
                            $('#edit_cidade').val(data.cidade);
                            $('#edit_estado').val(data.estado);
                            $('#edit_cep').val(data.cep);
                            $('#modalEditar').modal('show');
                        }
                    }
                });
            });

            $('#formEditar').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'conexao/enderecos/salvarEdicaoEndereco.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Sucesso!', response.success, 'success').then(() => {
                                $('#modalEditar').modal('hide');
                                carregarEnderecos();
                            });
                        } else {
                            Swal.fire('Erro!', response.error, 'error');
                        }
                    }
                });
            });

            $(document).on('click', '.btn-excluir', function () {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Não será possível reverter!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'conexao/enderecos/excluirEndereco.php',
                            method: 'POST',
                            data: { id: id },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire('Excluído!', response.message, 'success');
                                    carregarEnderecos();
                                } else {
                                    Swal.fire('Erro!', response.message, 'error');
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '.btn-visualizar', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: 'conexao/enderecos/visualizarEndereco.php',
                    method: 'POST',
                    data: { id: id },
                    success: function (response) {
                        $('#modal-body-content').html(response);
                        $('#modalVisualizar').modal('show');
                    }
                });
            });
        });

        function carregarEnderecos() {
            $.ajax({
                url: 'conexao/enderecos/listarEndereco.php',
                method: 'GET',
                success: function (response) {
                    $('#dadosTabela').html(response);
                }
            });
        }
    </script>
</body>

</html>