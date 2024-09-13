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

// Obtener los datos enviados por POST
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "Ubicación sin nombre";

// Si se proporciona un ID, se realiza una actualización
if ($id > 0) {
    $sql = "UPDATE locations SET nombre = '$nombre' WHERE id = $id";
} else {
    // De lo contrario, se realiza una inserción
    $sql = "INSERT INTO locations (nombre, latitude, longitude) VALUES ('$nombre', '$lat', '$lng')";
}

if ($conn->query($sql) === TRUE) {
    // Devolver el ID de la ubicación recién creada o actualizada
    if ($id > 0) {
        echo json_encode(['status' => 'actualizado']);
    } else {
        echo json_encode(['id' => $conn->insert_id]);
    }
} else {
    echo json_encode(['error' => "Error: " . $sql . "<br>" . $conn->error]);
}

$conn->close();
?>
