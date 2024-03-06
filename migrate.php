<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "diplomado";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Nombre del archivo SQL
$sql_file = "diplomado.sql";

// Leer el contenido del archivo SQL
$sql = file_get_contents($sql_file);

// Ejecutar las consultas contenidas en el archivo SQL
if ($conn->multi_query($sql) === TRUE) {
    echo "Archivo SQL ejecutado correctamente";
} else {
    echo "Error al ejecutar el archivo SQL: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
