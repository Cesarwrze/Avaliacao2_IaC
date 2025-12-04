<?php

if (isset($_POST["acao"]) && isset($_POST["tabela"])) {
    $acao = $_POST["acao"];
    $tabela = $_POST["tabela"];

    switch ($tabela) {
        case 'ambientes':
            if ($acao == "inserir") {
                inserirAmbiente();
            } elseif ($acao == "alterar") {
                alterarAmbiente();
            } elseif ($acao == "excluir") {
                excluirAmbiente();
            }
            break;

        case 'grupos':
            if ($acao == "inserir") {
                inserirGrupo();
            } elseif ($acao == "alterar") {
                alterarGrupo();
            } elseif ($acao == "excluir") {
                excluirGrupo();
            }
            break;

        case 'insumo':
            if ($acao == "inserir") {
                inserirInsumo();
            } elseif ($acao == "alterar") {
                alterarInsumo();
            } elseif ($acao == "excluir") {
                excluirInsumo();
            }
            break;

        case 'usuarios':
            if ($acao == "inserir") {
                inserirUsuario();
            } elseif ($acao == "alterar") {
                alterarUsuario();
            } elseif ($acao == "excluir") {
                excluirUsuario();
            }
            break;

        case 'devolucao':
            if ($acao == "inserir") {
                inserirDevolucao();
            } elseif ($acao == "alterar") {
                alterarDevolucao();
            } elseif ($acao == "excluir") {
                excluirDevolucao();
            }
            break;

        case 'emprestimo':
            if ($acao == "inserir") {
                inserirEmprestimo();
            } elseif ($acao == "alterar") {
                alterarEmprestimo();
            } elseif ($acao == "excluir") {
                excluirEmprestimo();
            }
            break;

        default:
            echo "Tabela desconhecida.";
            break;
    }
}

function abrirBanco() {
    $conexao = new mysqli("localhost", "root", "", "gestao_estoque");
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }
    return $conexao;
}

### Funções para a tabela `ambientes`
function inserirAmbiente() {
    $banco = abrirBanco();
    $sql = "INSERT INTO ambientes (ambiente) VALUES (?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("s", $_POST["ambiente"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();

    header('Content-Type: application/json');
    echo json_encode(["status" => "success", "message" => "Operação bem-sucedida!"]);
    exit;
}
function alterarAmbiente() {
    $banco = abrirBanco();
    $sql = "UPDATE ambientes SET ambiente = ? WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("si", $_POST["ambiente"], $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}
function excluirAmbiente() {
    $banco = abrirBanco();
    $sql = "DELETE FROM ambientes WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("i", $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Funções para a tabela `grupos`
function inserirGrupo() {
    $banco = abrirBanco();
    $sql = "INSERT INTO grupos (grupos) VALUES (?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("s", $_POST["grupos"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}
function alterarGrupo() {
    $banco = abrirBanco();
    $sql = "UPDATE grupos SET grupos = ? WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("si", $_POST["grupos"], $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}
function excluirGrupo() {
    $banco = abrirBanco();
    $sql = "DELETE FROM grupos WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("i", $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Funções para a tabela `insumo`
function inserirInsumo() {
    $banco = abrirBanco();
    $sql = "INSERT INTO insumo (data_cadastro, nome, emprestavel, ambiente, grupo, container, divisao, descricao, detalhes) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("ssissssss", $_POST["data_cadastro"], $_POST["nome"], $_POST["emprestavel"], $_POST["ambiente"], $_POST["grupo"], $_POST["container"], $_POST["divisao"], $_POST["descricao"], $_POST["detalhes"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}
function alterarInsumo() {
    $banco = abrirBanco();
    $sql = "UPDATE insumo SET data_cadastro = ?, nome = ?, emprestavel = ?, ambiente = ?, grupo = ?, container = ?, divisao = ?, descricao = ?, detalhes = ? WHERE id = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("ssissssssi", $_POST["data_cadastro"], $_POST["nome"], $_POST["emprestavel"], $_POST["ambiente"], $_POST["grupo"], $_POST["container"], $_POST["divisao"], $_POST["descricao"], $_POST["detalhes"], $_POST["id"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Funções para a tabela `usuarios`
function inserirUsuario() {
    $banco = abrirBanco();
    $sql = "INSERT INTO usuarios (data_cadastro, nome, ra, area, email, telefone, login, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("ssssssss", $_POST["data_cadastro"], $_POST["nome"], $_POST["ra"], $_POST["area"], $_POST["email"], $_POST["telefone"], $_POST["login"], $_POST["senha"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Funções para a tabela `devolucao`
function inserirDevolucao() {
    $banco = abrirBanco();
    $sql = "INSERT INTO devolucao (data, insumo, requisitante) VALUES (?, ?, ?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("sss", $_POST["data"], $_POST["insumo"], $_POST["requisitante"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Funções para a tabela `emprestimo`
function inserirEmprestimo() {
    $banco = abrirBanco();
    $sql = "INSERT INTO emprestimo (data_emprestimo, insumo, emprestimo, previsao_devolucao, supervisor, requisitante) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("ssisss", $_POST["data_emprestimo"], $_POST["insumo"], $_POST["emprestimo"], $_POST["previsao_devolucao"], $_POST["supervisor"], $_POST["requisitante"]);
    $stmt->execute();
    $stmt->close();
    $banco->close();
}

### Função para redirecionar
//function voltarIndex() {
//    header("Location: home.html");
//    exit;
//}
