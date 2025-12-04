<?php
include 'conexao.php';

$banco = abrirBanco();

$modoEdicao = isset($_GET['modo']) && $_GET['modo'] === 'edicao';

// Consulta para buscar todos os insumos disponíveis
$sql = "SELECT id, nome, quantidade, emprestavel FROM insumo WHERE quantidade > 0 ORDER BY nome";
$resultado = $banco->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selecionar Insumos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Definir altura fixa para a tabela */
        .tabela-container {
            max-height: 300px;
            /* Altura ajustada para 5 registros */
            overflow-y: auto;
            /* Ativa a rolagem */
        }

        /* Garantir que a tabela ocupe toda a largura */
        .tabela-container table {
            width: 100%;
        }

        /* Fixar o botão na parte inferior */
        .btn-container {
            position: sticky;
            bottom: 0;
            background: white;
            /* Fundo branco para não sobrepor conteúdo */
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="text-center">Selecionar Insumos</h2>

        <!-- Campo de pesquisa -->
        <input type="text" id="pesquisaInsumo" class="form-control mb-3" placeholder="Pesquisar insumo...">

        <!-- Container com barra de rolagem -->
        <div class="tabela-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade Disponível</th>
                        <th>Emprestável</th>
                        <th>Selecionar</th>
                    </tr>
                </thead>
                <tbody id="listaInsumos">
                    <?php while ($row = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td><?= (int)$row['quantidade'] ?></td>
                            <td><?= htmlspecialchars($row['emprestavel']) ?></td>
                            <td>
                                <input type="number" class="form-control qtd-insumo"
                                    data-id="<?= (int)$row['id'] ?>"
                                    data-nome="<?= htmlspecialchars($row['nome']) ?>"
                                    data-emprestavel="<?= htmlspecialchars($row['emprestavel']) ?>"
                                    max="<?= floatval($row['quantidade']) ?>"
                                    step="0.01"
                                    value="0">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Botão fixo -->
        <div class="btn-container">
            <button id="confirmarSelecao" class="btn btn-success">Adicionar ao Empréstimo</button>
        </div>
    </div>

    <script>
        // 🔍 Filtrar insumos ao digitar no campo de pesquisa
        $('#pesquisaInsumo').on('input', function() {
            var pesquisa = $(this).val().toLowerCase();
            $('#listaInsumos tr').each(function() {
                const nome = $(this).find('td:first').text().toLowerCase();
                $(this).toggle(nome.includes(pesquisa));
            });
        });
    </script>

    <?php if ($modoEdicao): ?>
        <script>
            // 🔧 MODO EDIÇÃO — retorna insumo único para o modal
            $('#confirmarSelecao').on('click', function() {
                let selecionado = null;
                let erroEstoque = false;

                $('.qtd-insumo').each(function() {
                    const quantidade = parseInt($(this).val(), 10);
                    const quantidadeDisponivel = parseInt($(this).attr('max'), 10);
                    const nome = $(this).data('nome');

                    if (quantidade > 0) {
                        if (quantidade > quantidadeDisponivel) {
                            alert(`Quantidade selecionada para "${nome}" excede o estoque disponível!`);
                            erroEstoque = true;
                            return false; // Para o loop
                        }

                        selecionado = {
                            id: $(this).data('id'),
                            nome: nome,
                            emprestavel: $(this).data('emprestavel'),
                            quantidade: quantidade
                        };
                        return false;
                    }
                });

                if (erroEstoque) return;

                if (!selecionado) {
                    alert("Selecione um insumo para continuar.");
                    return;
                }

                if (window.opener) {
                    window.opener.document.getElementById('editInsumoId').value = selecionado.id;
                    window.opener.document.getElementById('insumo').value = selecionado.nome;
                    window.opener.document.getElementById('editQuantidade').value = selecionado.quantidade;

                    if (selecionado.emprestavel === 'Sim') {
                        window.opener.document.getElementById('editEmprestavelSim').checked = true;
                        window.opener.document.getElementById('editPrevisaoDevolucao').disabled = false;
                    } else {
                        window.opener.document.getElementById('editEmprestavelNao').checked = true;
                        window.opener.document.getElementById('editPrevisaoDevolucao').value = '';
                        window.opener.document.getElementById('editPrevisaoDevolucao').disabled = true;
                    }

                    window.close();
                } else {
                    alert("Erro ao retornar o insumo para o formulário.");
                }
            });
        </script>
    <?php else: ?>
        <script>
            // 📦 MODO NORMAL — usa localStorage
            $('#confirmarSelecao').on('click', function() {
                let insumosSelecionados = JSON.parse(localStorage.getItem('insumosSelecionados')) || [];

                $('.qtd-insumo').each(function() {
                    let id = $(this).data('id');
                    let nome = $(this).data('nome');
                    let emprestavel = $(this).data('emprestavel');
                    const quantidadeSelecionada = parseFloat($(this).val()) || 0;
                    const quantidadeDisponivel = parseFloat($(this).attr('max'));


                    if (quantidadeSelecionada > 0) {
                        let insumoExistente = insumosSelecionados.find(i => i.id == id);

                        if (insumoExistente) {
                            let novaQuantidade = insumoExistente.quantidade + quantidadeSelecionada;
                            if (novaQuantidade > quantidadeDisponivel) {
                                alert(`Quantidade excede o disponível para ${nome}.`);
                            } else {
                                insumoExistente.quantidade = novaQuantidade;
                            }
                        } else {
                            insumosSelecionados.push({
                                id,
                                nome,
                                emprestavel,
                                quantidade: quantidadeSelecionada
                            });
                        }
                    }
                });

                localStorage.setItem('insumosSelecionados', JSON.stringify(insumosSelecionados));

                if (window.opener && typeof window.opener.carregarInsumosSelecionados === 'function') {
                    window.opener.carregarInsumosSelecionados();
                }

                window.close();
            });
        </script>
    <?php endif; ?>


</body>

</html>