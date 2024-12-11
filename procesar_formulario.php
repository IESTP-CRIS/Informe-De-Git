<?php
    include 'bd.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $correo = mysqli_real_escape_string($conn, $_POST['correo']);
        $asunto = mysqli_real_escape_string($conn, $_POST['asunto']);
        $mensaje = mysqli_real_escape_string($conn, $_POST['mensaje']);


    if (empty($nombre) || empty($correo) || empty($asunto) || empty($mensaje)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $sql = "INSERT INTO mensajes_contacto (nombre, correo, asunto, mensaje) 
                VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $nombre, $correo, $asunto, $mensaje);
            if ($stmt->execute()) {
                echo "Mensaje enviado correctamente";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    }
    $conn->close();
}
?>