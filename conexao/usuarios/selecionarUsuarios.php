<?php
include '../conexao.php';

$banco = abrirBanco();
$area = $_GET['area'] ?? '';
$busca = $_GET['busca'] ?? '';

// Query com ou sem filtro de nome
if (!empty($busca)) {
    $sql = "SELECT id, nome FROM usuarios WHERE area = ? AND nome LIKE ?";
    $buscaParam = "%" . $busca . "%";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("ss", $area, $buscaParam);
} else {
    $sql = "SELECT id, nome FROM usuarios WHERE area = ?";
    $stmt = $banco->prepare($sql);
    $stmt->bind_param("s", $area);
}
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Selecionar <?= htmlspecialchars($area) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .tabela-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .tabela-container table {
            width: 100%;
        }

        .btn-container {
            position: sticky;
            bottom: 0;
            background: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="text-center">Selecionar <?= htmlspecialchars($area) ?></h2>

        <!-- Campo de busca -->
        <input type="text" id="pesquisaUsuario" class="form-control mb-3" placeholder="Pesquisar <?= strtolower($area) ?>...">

        <!-- Tabela com scroll -->
        <div class="tabela-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Selecionar</th>
                    </tr>
                </thead>
                <tbody id="listaUsuarios">
                    <?php while ($row = $resultado->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nome']) ?></td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm"
                                    onclick="selecionarUsuario(<?= $row['id'] ?>, '<?= addslashes($row['nome']) ?>', '<?= htmlspecialchars($area) ?>')">
                                    Selecionar
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Botão de fechar -->
        <div class="btn-container">
            <button class="btn btn-danger mt-3 w-100" onclick="window.close()">Fechar</button>
        </div>
    </div>

    <script>
        // Campo de pesquisa
        $('#pesquisaUsuario').on('input', function() {
            var pesquisa = $(this).val().toLowerCase();
            $('#listaUsuarios tr').each(function() {
                const nome = $(this).find('td:first').text().toLowerCase();
                $(this).toggle(nome.includes(pesquisa));
            });
        });

        // Seleção do usuário
        function selecionarUsuario(id, nome, area) {
            if (window.opener && typeof window.opener.selecionarUsuario === 'function') {
                window.opener.selecionarUsuario(id, nome, area);
                window.close();
            } else {
                alert("Erro: A janela principal não está acessível.");
            }
        }
    </script>
</body>

</html>

<?php $banco->close(); ?>