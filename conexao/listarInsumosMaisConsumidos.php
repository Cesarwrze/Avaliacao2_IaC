<?php
include 'conexao.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$banco = abrirBanco();

$sql = "SELECT 
            i.nome, 
            g.grupo, 
            SUM(e.quantidade) as total_consumido 
        FROM emprestimo e
        INNER JOIN insumo i ON e.insumo = i.id
        LEFT JOIN grupos g ON i.grupo = g.id
        GROUP BY i.id, i.nome, g.grupo
        ORDER BY total_consumido DESC
        LIMIT 20";

$resultado = $banco->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $rank = 1;
    while ($row = $resultado->fetch_assoc()) {

        $total = $row['total_consumido'];

        $destaqueClass = ($rank <= 3) ? 'fw-bold text-dark' : '';
        $medalha = '';

        echo "<tr>";
        echo "<td class='text-center {$destaqueClass}'>{$medalha}#{$rank}</td>";
        echo "<td class='{$destaqueClass}'>{$row['nome']}</td>";
        echo "<td>" . ($row['grupo'] ? $row['grupo'] : 'Sem Grupo') . "</td>";
        echo "<td class='text-center text-danger fw-bold'>{$total}</td>";
        echo "</tr>";

        $rank++;
    }
} else {
    echo "<tr><td colspan='4' class='text-center py-3'>Nenhum insumo foi movimentando até o momento.</td></tr>";
}

$banco->close();
?>