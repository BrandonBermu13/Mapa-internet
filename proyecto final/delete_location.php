<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "map_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];

// Eliminar pin
$stmt = $conn->prepare("DELETE FROM locations WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
