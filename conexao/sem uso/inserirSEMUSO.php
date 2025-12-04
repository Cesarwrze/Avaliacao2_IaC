<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Formulário Dinâmico</title>
</head>

<body>

<div class="container mt-5">
    <h2>Selecione a Tabela</h2>

    <form id="selectTableForm" class="mb-4">
        <div class="form-group">
            <label for="tabela">Escolha a tabela:</label>
            <select class="form-control" id="tabela" name="tabela">
                <option value="ambientes">Ambientes</option>
                <option value="devolucao">Devolução</option>
                <option value="emprestimo">Empréstimo</option>
                <option value="grupos">Grupos</option>
                <option value="insumo">Insumos</option>
                <option value="usuarios">Usuários</option>
            </select>
        </div>
    </form>

    <form name="dadosFormulario" action="conexao.php" method="post">
        <div id="formCampos">
            <!-- Campos serão gerados dinamicamente aqui -->
        </div>

        <input type="hidden" name="acao" value="inserir"/>
        <input type="hidden" id="tabelaSelecionada" name="tabela" value="ambientes"/>
        <input type="submit" value="Enviar" class="btn btn-primary mt-3"/>
    </form>
</div>

<script>
    document.getElementById("tabela").addEventListener("change", function() {
        var tabelaSelecionada = this.value;
        var formCampos = document.getElementById("formCampos");
        var hiddenTabela = document.getElementById("tabelaSelecionada");

        // Atualiza o valor do campo oculto com a tabela selecionada
        hiddenTabela.value = tabelaSelecionada;

        // Limpa os campos anteriores
        formCampos.innerHTML = "";

        // Gera os campos com base na tabela selecionada
        if (tabelaSelecionada === "ambientes") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Ambiente</label>
                    <input type="text" class="form-control" name="ambiente" value=""/>
                </div>`;
        } else if (tabelaSelecionada === "devolucao") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Data</label>
                    <input type="date" class="form-control" name="data" value=""/>
                </div>
                <div class="form-group">
                    <label>Insumo</label>
                    <input type="text" class="form-control" name="insumo" value=""/>
                </div>
                <div class="form-group">
                    <label>Requisitante</label>
                    <input type="text" class="form-control" name="requisitante" value=""/>
                </div>`;
        } else if (tabelaSelecionada === "emprestimo") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Data Empréstimo</label>
                    <input type="date" class="form-control" name="data_emprestimo" value=""/>
                </div>
                <div class="form-group">
                    <label>Insumo</label>
                    <input type="text" class="form-control" name="insumo" value=""/>
                </div>
                <div class="form-group">
                    <label>Empréstimo</label>
                    <input type="text" class="form-control" name="emprestimo" value=""/>
                </div>
                <div class="form-group">
                    <label>Previsão de Devolução</label>
                    <input type="date" class="form-control" name="previsao_devolucao" value=""/>
                </div>
                <div class="form-group">
                    <label>Supervisor</label>
                    <input type="text" class="form-control" name="supervisor" value=""/>
                </div>
                <div class="form-group">
                    <label>Requisitante</label>
                    <input type="text" class="form-control" name="requisitante" value=""/>
                </div>`;
        } else if (tabelaSelecionada === "grupos") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Grupo</label>
                    <input type="text" class="form-control" name="nome" value=""/>
                </div>`;
        } else if (tabelaSelecionada === "insumo") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Data Cadastro</label>
                    <input type="date" class="form-control" name="data_cadastro" value=""/>
                </div>
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value=""/>
                </div>
                <div class="form-group">
                    <label>Emprestável</label>
                    <input type="checkbox" class="form-check-input" name="emprestavel"/>
                </div>
                <div class="form-group">
                    <label>Ambiente</label>
                    <input type="text" class="form-control" name="ambiente" value=""/>
                </div>
                <div class="form-group">
                    <label>Grupo</label>
                    <input type="text" class="form-control" name="grupo" value=""/>
                </div>
                <div class="form-group">
                    <label>Container</label>
                    <input type="text" class="form-control" name="container" value=""/>
                </div>
                <div class="form-group">
                    <label>Divisão</label>
                    <input type="text" class="form-control" name="divisao" value=""/>
                </div>
                <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" name="descricao" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>Detalhe</label>
                    <textarea class="form-control" name="detalhe" rows="4"></textarea>
                </div>`;
        } else if (tabelaSelecionada === "usuarios") {
            formCampos.innerHTML += `
                <div class="form-group">
                    <label>Data Cadastro</label>
                    <input type="date" class="form-control" name="data_cadastro" value=""/>
                </div>
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="nome" value=""/>
                </div>
                <div class="form-group">
                    <label>RA</label>
                    <input type="text" class="form-control" name="ra" value=""/>
                </div>
                <div class="form-group">
                    <label>Área</label>
                    <input type="text" class="form-control" name="area" value=""/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value=""/>
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" class="form-control" name="telefone" value=""/>
                </div>
                <div class="form-group">
                    <label>Login</label>
                    <input type="text" class="form-control" name="login" value=""/>
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input type="password" class="form-control" name="senha" value=""/>
                </div>`;
        }
    });

    // Dispara o evento de mudança para carregar os campos iniciais da tabela selecionada
    document.getElementById("tabela").dispatchEvent(new Event("change"));
</script>

</body>
</html>
