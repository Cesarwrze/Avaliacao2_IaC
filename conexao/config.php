<?php
// config.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_lab_eletronica";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
