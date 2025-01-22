<?php
$host = "localhost";
$user = "root";
$password = "root";
$db = "excel";

function conectar() {
    global $host, $user, $password, $db;

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_errno) {
        die('Falha na conexão: ' . $conn->connect_error);
    }

    return $conn;
}


$colunas =  "id, nome, descricao , preco , quantidade, categoria , status";


function getDados($conn) {
    global $colunas;
    $query = "SELECT $colunas FROM produtos";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
?>
