<?php
class Cadastro {
    private $con;

    // Construtor para criar a conexão com o banco de dados
    public function __construct() {
        $this->con = new mysqli("localhost", "root", "", "gestao_estoque");
        if ($this->con->connect_error) {
            die("Erro de conexão: " . $this->con->connect_error);
        }
    }

    // Métodos para Ambientes
    public function cadastrarAmbiente($ambiente) {
        $sql = "INSERT INTO ambientes (ambiente) VALUES (?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $ambiente);
        return $stmt->execute() ? "1|Cadastro de ambiente realizado" : "0|Erro: " . $stmt->error;
    }

    public function listarAmbientes() {
        $sql = "SELECT * FROM ambientes";
        return $this->con->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function editarAmbiente($id, $ambiente) {
        $sql = "UPDATE ambientes SET ambiente = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $ambiente, $id);
        return $stmt->execute() ? "1|Ambiente atualizado" : "0|Erro: " . $stmt->error;
    }

    public function excluirAmbiente($id) {
        $sql = "DELETE FROM ambientes WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute() ? "1|Ambiente excluído" : "0|Erro: " . $stmt->error;
    }

    // Métodos para Grupos
    public function cadastrarGrupo($grupo) {
        $sql = "INSERT INTO grupos (grupos) VALUES (?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $grupo);
        return $stmt->execute() ? "1|Cadastro de grupo realizado" : "0|Erro: " . $stmt->error;
    }

    public function listarGrupos() {
        $sql = "SELECT * FROM grupos";
        return $this->con->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function editarGrupo($id, $grupo) {
        $sql = "UPDATE grupos SET grupos = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $grupo, $id);
        return $stmt->execute() ? "1|Grupo atualizado" : "0|Erro: " . $stmt->error;
    }

    public function excluirGrupo($id) {
        $sql = "DELETE FROM grupos WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute() ? "1|Grupo excluído" : "0|Erro: " . $stmt->error;
    }

    // Métodos para Devolução
    public function cadastrarDevolucao($data, $insumo, $requisitante) {
        $sql = "INSERT INTO devolucao (data, insumo, requisitante) VALUES (?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $data, $insumo, $requisitante);
        return $stmt->execute() ? "1|Cadastro de devolução realizado" : "0|Erro: " . $stmt->error;
    }

    public function listarDevolucoes() {
        $sql = "SELECT * FROM devolucao";
        return $this->con->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function editarDevolucao($id, $data, $insumo, $requisitante) {
        $sql = "UPDATE devolucao SET data = ?, insumo = ?, requisitante = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssi", $data, $insumo, $requisitante, $id);
        return $stmt->execute() ? "1|Devolução atualizada" : "0|Erro: " . $stmt->error;
    }

    public function excluirDevolucao($id) {
        $sql = "DELETE FROM devolucao WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute() ? "1|Devolução excluída" : "0|Erro: " . $stmt->error;
    }

    // Métodos para Empréstimos
    public function cadastrarEmprestimo($dataEmprestimo, $insumo, $emprestimo, $previsaoDevolucao, $supervisor, $requisitante) {
        $sql = "INSERT INTO emprestimo (data_emprestimo, insumo, emprestimo, previsao_devolucao, supervisor, requisitante) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssisss", $dataEmprestimo, $insumo, $emprestimo, $previsaoDevolucao, $supervisor, $requisitante);
        return $stmt->execute() ? "1|Cadastro de empréstimo realizado" : "0|Erro: " . $stmt->error;
    }

    public function listarEmprestimos() {
        $sql = "SELECT * FROM emprestimo";
        return $this->con->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function editarEmprestimo($id, $dataEmprestimo, $insumo, $emprestimo, $previsaoDevolucao, $supervisor, $requisitante) {
        $sql = "UPDATE emprestimo SET data_emprestimo = ?, insumo = ?, emprestimo = ?, previsao_devolucao = ?, supervisor = ?, requisitante = ? WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssisssi", $dataEmprestimo, $insumo, $emprestimo, $previsaoDevolucao, $supervisor, $requisitante, $id);
        return $stmt->execute() ? "1|Empréstimo atualizado" : "0|Erro: " . $stmt->error;
    }

    public function excluirEmprestimo($id) {
        $sql = "DELETE FROM emprestimo WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute() ? "1|Empréstimo excluído" : "0|Erro: " . $stmt->error;
    }

    // Destrutor para fechar a conexão com o banco de dados
    public function __destruct() {
        $this->con->close();
    }
}

?>
