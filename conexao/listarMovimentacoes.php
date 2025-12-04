<?php
include 'conexao.php';

// Configurar o cabeçalho de resposta para HTML
header('Content-Type: text/html; charset=UTF-8');

// Captura os filtros enviados via GET
$filtroPor = $_GET['filtroPor'] ?? null;
$valorFiltro = $_GET['valorFiltro'] ?? null;

function listarMovimentacoes($filtroPor = null, $valorFiltro = null)
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

    -- Lógica para determinar o status
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

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {

            // Aplique a classe 'text-danger' ao status "Emprestado - vencido"
            $status = $row['status'];
            $statusClass = '';
            if (strpos($status, 'Emprestado - vencido') !== false) {
                $statusClass = 'text-danger'; // Classe para a cor vermelha
            }

            // Formatar as datas no formato dd/MM/yyyy
            $data_emprestimo = date("d/m/Y", strtotime($row['data_emprestimo']));


            if ($status === 'Doado') {
                $data_devolucao = '-';
                $previsao_devolucao = '-';
                $quantidade_devolvida = '-';
            } else {
                // Data devolução
                if ($row['data_devolucao'] == '0000-00-00' || is_null($row['data_devolucao'])) {
                    $data_devolucao = '';
                } else {
                    $data_devolucao = date("d/m/Y", strtotime($row['data_devolucao']));
                }

                // Previsão devolução
                if ($row['previsao_devolucao'] == '0000-00-00' || is_null($row['previsao_devolucao'])) {
                    $previsao_devolucao = '';
                } else {
                    $previsao_devolucao = date("d/m/Y", strtotime($row['previsao_devolucao']));
                }

                // Quantidade devolvida
                $quantidade_devolvida = $row['quantidade_devolvida'];
            }




            // Exibição das informações na tabela
            echo "<tr>
                    <td>{$row['requisitante_nome']}</td>
                    <td>{$row['insumo_nome']}</td>
                    <td>{$data_emprestimo}</td> 
                    <td>{$previsao_devolucao}</td>
                    <td>{$data_devolucao}</td> 
                    <td>{$row['quantidade_emprestada']}</td> 
                    <td>{$quantidade_devolvida}</td>
                    <td>{$row['supervisor_nome']}</td>
                    <td class='{$statusClass}'>{$status}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>Nenhuma movimentação encontrada.</td></tr>";
    }


    $banco->close();
}

listarMovimentacoes($filtroPor, $valorFiltro);
