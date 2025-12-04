<?php
include '../conexao.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = $_POST['nome'];
    $ra = $_POST['ra'];
    $login = $ra; // O login sempre será igual ao RA
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $area = $_POST['area'];
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_BCRYPT) : null;

    // Validação básica
    if (empty($id) || empty($nome) || empty($ra) || empty($email) || empty($telefone) || empty($area)) {
        echo json_encode(["error" => "Todos os campos obrigatórios devem ser preenchidos."]);
        exit;
    }

    $banco = abrirBanco();

    $sql = "UPDATE usuarios SET nome = ?, ra = ?, login = ?, email = ?, telefone = ?, area = ?, ultima_atualizacao = NOW()";
    $params = [$nome, $ra, $login, $email, $telefone, $area];

    if ($senha) {
        $sql .= ", senha = ?";
        $params[] = $senha;
    }

    $sql .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $banco->prepare($sql);

    if ($stmt) {
        $types = str_repeat("s", count($params) - 1) . "i";
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Usuário atualizado com sucesso."]);
        } else {
            echo json_encode(["error" => "Erro ao atualizar usuário."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Erro ao preparar a consulta: " . $banco->error]);
    }

    $banco->close();
}
