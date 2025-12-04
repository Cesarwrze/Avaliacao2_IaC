<?php
include 'conexao.php'; // Inclua a conexão ao banco de dados

header('Content-Type: application/json'); // Define o retorno como JSON

if (isset($_POST['ra']) && !empty($_POST['ra'])) {
    $ra = $_POST['ra'];

    try {
        // Consulta para verificar se o RA já existe
        $query = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE ra = ?");
        $query->execute([$ra]);

        $count = $query->fetchColumn();

        if ($count > 0) {
            echo json_encode([
                "status" => "error",
                "message" => "O RA informado já está cadastrado no sistema."
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "O RA está disponível para cadastro."
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Erro ao consultar o banco de dados: " . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "RA não informado ou vazio."
    ]);
}
