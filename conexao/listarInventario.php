<?php
include 'conexao.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

function formatarData($data, $formato = 'd/m/Y')
{
    return $data ? date($formato, strtotime($data)) : 'Não informada';
}

function listarInventario($filtro = null)
{
    echo "<!-- Debug: Filtro recebido na função listarInventario: {$filtro} -->";

    $banco = abrirBanco();

    // Base da consulta
    $sql = "SELECT 
                i.id,
                i.nome,
                i.data_cadastro,
                a.ambiente AS ambiente,
                i.container,
                i.divisao,
                g.grupo AS grupo,
                i.descricao,
                i.detalhes,
                i.emprestavel,
                i.quantidade,
                COALESCE(SUM(e.quantidade), 0) AS movimentacoes,
                COALESCE(COUNT(DISTINCT e.id), 0) AS total_emprestimos
            FROM insumo i
            LEFT JOIN ambientes a ON i.ambiente = a.id
            LEFT JOIN grupos g ON i.grupo = g.id
            LEFT JOIN emprestimo e ON e.insumo = i.id";

    // Condição WHERE (apenas para zerados)
    if ($filtro === 'zerados') {
        $sql .= " WHERE i.quantidade = 0";
    }

    // Agrupamento (necessário por conta das funções agregadas)
    $sql .= " GROUP BY i.id";

    // Ordenação conforme o filtro
    switch ($filtro) {
        case 'opcao1': // Menores Quantidades
            $sql .= " ORDER BY i.quantidade ASC";
            break;

        case 'opcao2': // Maiores Movimentações
            $sql .= " ORDER BY movimentacoes DESC";
            break;

        case 'opcao3': // Maiores Quantidades Disponíveis
            $sql .= " ORDER BY i.quantidade DESC";
            break;

        case 'zerados': // Nome dos zerados
            $sql .= " ORDER BY i.nome ASC";
            break;

        default: // Sem filtro - mais recentes primeiro
            $sql .= " ORDER BY i.data_cadastro DESC";
    }

    // Debug da consulta
    echo "<!-- Debug: Consulta SQL executada: {$sql} -->";

    $resultado = $banco->query($sql);

    if (!$resultado) {
        die("<p style='color: red;'>Erro na consulta: {$banco->error}</p>");
    }

    echo "<!-- Debug: Número de resultados: {$resultado->num_rows} -->";

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $quantidadeStyle = ($row['quantidade'] == 0) ? "style='background-color: red; color: white;'" : "";

            echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>" . formatarData($row['data_cadastro']) . "</td>
                    <td>{$row['ambiente']}</td>
                    <td>{$row['container']}</td>
                    <td>{$row['divisao']}</td>
                    <td>{$row['grupo']}</td>
                    <td>{$row['descricao']}</td>
                    <td>{$row['detalhes']}</td>
                    <td>{$row['emprestavel']}</td>
                    <td {$quantidadeStyle}>{$row['quantidade']}</td>
                    <td>{$row['movimentacoes']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='12'>Nenhum dado encontrado.</td></tr>";
    }

    $banco->close();
}
