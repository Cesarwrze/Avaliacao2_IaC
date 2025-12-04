<?php
require '../dompdf/autoload.inc.php';
include 'conexao.php';

use Dompdf\Dompdf;

function formatarData($data, $formato = 'd/m/Y')
{
    return $data ? date($formato, strtotime($data)) : 'Não informada';
}

$filtro = $_GET['filtro'] ?? null;

function gerarHTMLInventario($filtro)
{
    $banco = abrirBanco();

    $sql = "SELECT 
                i.id, i.nome, i.data_cadastro,
                a.ambiente AS ambiente,
                i.container, i.divisao,
                g.grupo AS grupo,
                i.descricao, i.detalhes,
                i.emprestavel, i.quantidade,
                COALESCE(SUM(e.quantidade), 0) AS movimentacoes
            FROM insumo i
            LEFT JOIN ambientes a ON i.ambiente = a.id
            LEFT JOIN grupos g ON i.grupo = g.id
            LEFT JOIN emprestimo e ON e.insumo = i.id";

    if ($filtro === 'zerados') {
        $sql .= " WHERE i.quantidade = 0";
    }

    $sql .= " GROUP BY i.id";

    switch ($filtro) {
        case 'opcao1':
            $sql .= " ORDER BY i.quantidade ASC";
            break;
        case 'opcao2':
            $sql .= " ORDER BY movimentacoes DESC";
            break;
        case 'opcao3':
            $sql .= " ORDER BY i.quantidade DESC";
            break;
        case 'zerados':
            $sql .= " ORDER BY i.nome ASC";
            break;
        default:
            $sql .= " ORDER BY i.data_cadastro DESC";
    }

    $resultado = $banco->query($sql);

    date_default_timezone_set('America/Sao_Paulo');
    $dataGeracao = date('d/m/Y H:i');
    $html = "
    <div style='text-align: center;'>
        <h2>Inventário de Insumos</h2>
        <p style='font-size: 12px;'>Gerado em: <strong>{$dataGeracao}</strong></p>
    </div>
";

    $html .= "<table border='1' width='100%' style='border-collapse: collapse; font-size: 12px;'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data Cadastro</th>
                        <th>Ambiente</th>
                        <th>Container</th>
                        <th>Divisão</th>
                        <th>Grupo</th>
                        <th>Descrição</th>
                        <th>Detalhe</th>
                        <th>Emprestável</th>
                        <th>Qtd Estoque</th>
                        <th>Qtd Movimentada</th>
                    </tr>
                </thead><tbody>";

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $quantidadeStyle = ($row['quantidade'] == 0) ? "style='color:red;'" : "";
            $html .= "<tr>
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
        $html .= "<tr><td colspan='11'>Nenhum dado encontrado.</td></tr>";
    }

    $html .= "</tbody></table>";
    $banco->close();
    return $html;
}

$dompdf = new Dompdf();
$dompdf->loadHtml(gerarHTMLInventario($filtro));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("inventario.pdf", ["Attachment" => true]);
