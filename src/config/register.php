<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "conexion.php";

$nombre = $_POST['nombre'] ?? null;
$email = $_POST['correo'] ?? null;
$password = $_POST['contrasena'] ?? null;
$confirmar = $_POST['confirmar'] ?? null;

if(!$nombre || !$email || !$password || !$confirmar){
    echo "Faltan datos";
    exit;
}

if($password !== $confirmar){
    echo "no_coinciden";
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contrasena)
                           VALUES (:nombre, :correo, :contrasena)");

    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":correo", $email);
    $stmt->bindParam(":contrasena", $password);

    $stmt->execute();

    // ✅ INICIAR SESIÓN AUTOMÁTICAMENTE DESPUÉS DEL REGISTRO
    $usuario_id = $pdo->lastInsertId();
    
    $_SESSION['usuario'] = [
        'id' => $usuario_id,
        'nombre' => $nombre,
        'correo' => $email,
        'zona_horaria' => 'UTC'
    ];

    // ✅ REDIRECCIÓN CORRECTA (RUTA ABSOLUTA)
    header("Location: /src/views/menu.php");
    exit;

} catch (PDOException $e){
    if ($e->getCode() == 23505) {
        echo "correo_duplicado";
    } else {
        echo "error_bd: " . $e->getMessage();
    }
}
?>