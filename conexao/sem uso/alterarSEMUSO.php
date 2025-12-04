<?php
include("conexao.php");

// Função para carregar os dados da tabela correspondente
if (isset($_POST["tabela"])) {
    $tabela = $_POST["tabela"];
    $id = $_POST["id"];
    
    // Verifica qual tabela foi passada e seleciona o registro correto
    switch ($tabela) {
        case 'ambientes':
            $registro = selecionarAmbienteId($id);
            break;
        case 'devolucao':
            $registro = selecionarDevolucaoId($id);
            break;
        case 'emprestimo':
            $registro = selecionarEmprestimoId($id);
            break;
        case 'grupos':
            $registro = selecionarGrupoId($id);
            break;
        case 'insumo':
            $registro = selecionarInsumoId($id);
            break;
        case 'usuarios':
            $registro = selecionarUsuarioId($id);
            break;
        default:
            echo "Tabela desconhecida.";
            exit;
    }
} else {
    echo "Tabela não foi definida.";
    exit;
}
?>

<meta charset="UTF-8">

<!-- Formulário adaptável para múltiplas tabelas -->
<form name="dadosTabela" action="conexao.php" method="POST">
    <table border="1">
        <tbody>
        
        <?php if ($tabela == 'ambientes') { ?>
            <tr>
                <td>Ambiente</td>
                <td><input type="text" name="ambiente" value ='<?=$registro["ambiente"]?>' size="35"/></td>
            </tr>

        <?php } elseif ($tabela == 'devolucao') { ?>
            <tr>
                <td>Data</td>
                <td><input type="date" name="data" value ='<?=$registro["data"]?>'/></td>
            </tr>
            <tr>
                <td>Insumo</td>
                <td><input type="text" name="insumo" value ='<?=$registro["insumo"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Requisitante</td>
                <td><input type="text" name="requisitante" value ='<?=$registro["requisitante"]?>' size="35"/></td>
            </tr>

        <?php } elseif ($tabela == 'emprestimo') { ?>
            <tr>
                <td>Data Empréstimo</td>
                <td><input type="date" name="data_emprestimo" value ='<?=$registro["data_emprestimo"]?>'/></td>
            </tr>
            <tr>
                <td>Insumo</td>
                <td><input type="text" name="insumo" value ='<?=$registro["insumo"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Empréstimo</td>
                <td><input type="text" name="emprestimo" value ='<?=$registro["emprestimo"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Previsão de Devolução</td>
                <td><input type="date" name="previsao_devolucao" value ='<?=$registro["previsao_devolucao"]?>'/></td>
            </tr>
            <tr>
                <td>Supervisor</td>
                <td><input type="text" name="supervisor" value ='<?=$registro["supervisor"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Requisitante</td>
                <td><input type="text" name="requisitante" value ='<?=$registro["requisitante"]?>' size="35"/></td>
            </tr>

        <?php } elseif ($tabela == 'grupos') { ?>
            <tr>
                <td>Grupo</td>
                <td><input type="text" name="nome" value ='<?=$registro["nome"]?>' size="35"/></td>
            </tr>

        <?php } elseif ($tabela == 'insumo') { ?>
            <tr>
                <td>Data Cadastro</td>
                <td><input type="date" name="data_cadastro" value ='<?=$registro["data_cadastro"]?>'/></td>
            </tr>
            <tr>
                <td>Nome</td>
                <td><input type="text" name="nome" value ='<?=$registro["nome"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Emprestável</td>
                <td><input type="checkbox" name="emprestavel" <?=($registro["emprestavel"] == 1) ? "checked" : ""?> /></td>
            </tr>
            <tr>
                <td>Ambiente</td>
                <td><input type="text" name="ambiente" value ='<?=$registro["ambiente"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Grupo</td>
                <td><input type="text" name="grupo" value ='<?=$registro["grupo"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Container</td>
                <td><input type="text" name="container" value ='<?=$registro["container"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Divisão</td>
                <td><input type="text" name="divisao" value ='<?=$registro["divisao"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><textarea name="descricao" rows="4" cols="50"><?=$registro["descricao"]?></textarea></td>
            </tr>
            <tr>
                <td>Detalhe</td>
                <td><textarea name="detalhe" rows="4" cols="50"><?=$registro["detalhe"]?></textarea></td>
            </tr>

        <?php } elseif ($tabela == 'usuarios') { ?>
            <tr>
                <td>Data Cadastro</td>
                <td><input type="date" name="data_cadastro" value ='<?=$registro["data_cadastro"]?>'/></td>
            </tr>
            <tr>
                <td>Nome</td>
                <td><input type="text" name="nome" value ='<?=$registro["nome"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>RA</td>
                <td><input type="text" name="ra" value ='<?=$registro["ra"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Área</td>
                <td><input type="text" name="area" value ='<?=$registro["area"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value ='<?=$registro["email"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Telefone</td>
                <td><input type="text" name="telefone" value ='<?=$registro["telefone"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Login</td>
                <td><input type="text" name="login" value ='<?=$registro["login"]?>' size="35"/></td>
            </tr>
            <tr>
                <td>Senha</td>
                <td><input type="password" name="senha" value ='<?=$registro["senha"]?>' size="35"/></td>
            </tr>
        <?php } ?>
        
        <tr>
            <td><input type="hidden" name="acao" value="alterar"/></td>
            <td><input type="hidden" name="id" value="<?=$registro["id"]?>"/></td>
        </tr>
        <tr>
            <td><input type="hidden" name="tabela" value="<?=$tabela?>"/></td>
            <!-- Envia o nome da tabela no campo oculto -->
            <td><input type="submit" value="Enviar" name="enviar"></td>
        </tr>
        </tbody>
    </table>
</form>
