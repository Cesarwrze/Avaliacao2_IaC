<?php
require '../dompdf/autoload.inc.php';
include 'conexao.php';

use Dompdf\Dompdf;

$filtroPor = $_GET['filtroPor'] ?? null;
$valorFiltro = $_GET['valorFiltro'] ?? null;

function gerarHTML($filtroPor = null, $valorFiltro = null)
{
    $banco = abrirBanco();

    $sql = "
    SELECT 
        i.nome AS insumo_nome,
        e.insumo AS insumo_id,
        e.quantidade AS quantidade_emprestada,
        d.quantidade AS quantidade_devolvida,
        e.data_emprestimo AS data_emprestimo,
        d.dataDevolucao AS data_devolucao,
        r.nome AS requisitante_nome,
        s.nome AS supervisor_nome,
        e.previsao_devolucao,
        CASE
            WHEN i.emprestavel = 'não' THEN 'Doado'
            WHEN e.previsao_devolucao IS NOT NULL 
                 AND (d.dataDevolucao IS NULL OR d.dataDevolucao = '') THEN 
                CASE
                    WHEN CURRENT_DATE <= e.previsao_devolucao THEN 'Emprestado'
                    ELSE 'Emprestado - vencido'
                END
            WHEN d.dataDevolucao IS NOT NULL THEN
                CASE
                    WHEN d.dataDevolucao = e.previsao_devolucao THEN 'Devolvido na data'
                    WHEN d.dataDevolucao < e.previsao_devolucao THEN 
                        CONCAT('Devolvido com antecedência (', DATEDIFF(e.previsao_devolucao, d.dataDevolucao), ' dias)')
                    WHEN d.dataDevolucao > e.previsao_devolucao THEN 
                        CONCAT('Devolvido com atraso (', DATEDIFF(d.dataDevolucao, e.previsao_devolucao), ' dias)')
                END
            ELSE 'Sem status'
        END AS status
    FROM emprestimo e
    LEFT JOIN devolucao d ON d.idEmprestimo = e.id
    LEFT JOIN insumo i ON i.id = e.insumo
    LEFT JOIN usuarios r ON e.requisitante = r.id
    LEFT JOIN usuarios s ON e.supervisor = s.id
    ";

    if ($filtroPor && $valorFiltro) {
        $valorFiltro = $banco->real_escape_string($valorFiltro);
        switch ($filtroPor) {
            case 'insumo':
                $sql .= " WHERE i.nome LIKE '%$valorFiltro%'";
                break;
            case 'requisitante':
                $sql .= " WHERE r.nome LIKE '%$valorFiltro%'";
                break;
            case 'supervisor':
                $sql .= " WHERE s.nome LIKE '%$valorFiltro%'";
                break;
            case 'status':
                $sql .= " HAVING status LIKE '%$valorFiltro%'";
                break;
        }
    }

    $sql .= " ORDER BY e.data_emprestimo DESC";
    $resultado = $banco->query($sql);



    date_default_timezone_set('America/Sao_Paulo');
    $dataGeracao = date('d/m/Y H:i');
    $html = "
    <div style='text-align: center;'>
        <h2>Relatório de Movimentações</h2>
        <p style='font-size: 12px;'>Gerado em: <strong>{$dataGeracao}</strong></p>
    </div>
";


    $html .= "<table border='1' width='100%' style='border-collapse: collapse; font-size:12px;'>
        <thead>
            <tr>
                <th>Requisitante</th>
                <th>Insumo</th>
                <th>Data Empréstimo</th>
                <th>Previsão Devolução</th>
                <th>Data Devolução</th>
                <th>Qtd. Saída</th>
                <th>Qtd. Devolvida</th>
                <th>Supervisor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
    ";

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $data_emprestimo = date("d/m/Y", strtotime($row['data_emprestimo']));

            $data_devolucao = ($row['data_devolucao'] == '0000-00-00' || is_null($row['data_devolucao']))
                ? '' : date("d/m/Y", strtotime($row['data_devolucao']));

            $previsao_devolucao = ($row['previsao_devolucao'] == '0000-00-00' || is_null($row['previsao_devolucao']))
                ? '' : date("d/m/Y", strtotime($row['previsao_devolucao']));

            $quantidade_devolvida = ($row['status'] === 'Doado') ? '-' : $row['quantidade_devolvida'];
            if ($row['status'] === 'Doado') {
                $data_devolucao = '-';
                $previsao_devolucao = '-';
            }

            $html .= "<tr>
                <td>{$row['requisitante_nome']}</td>
                <td>{$row['insumo_nome']}</td>
                <td>{$data_emprestimo}</td>
                <td>{$previsao_devolucao}</td>
                <td>{$data_devolucao}</td>
                <td>{$row['quantidade_emprestada']}</td>
                <td>{$quantidade_devolvida}</td>
                <td>{$row['supervisor_nome']}</td>
                <td>{$row['status']}</td>
            </tr>";
        }
    } else {
        $html .= "<tr><td colspan='9'>Nenhuma movimentação encontrada.</td></tr>";
    }

    $html .= "</tbody></table>";
    $banco->close();
    return $html;
}

$dompdf = new Dompdf();
$dompdf->loadHtml(gerarHTML($filtroPor, $valorFiltro));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("relatorio_movimentacoes.pdf", array("Attachment" => true));
exit;
