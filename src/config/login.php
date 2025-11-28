<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "conexion.php";

$email = $_POST['correo'] ?? null;
$password = $_POST['contrasena'] ?? null;

if(!$email || !$password){
    echo "faltan_datos";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
    $stmt->bindParam(":correo", $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario && $usuario['contrasena'] === $password){
        
        // ✅ SESIÓN INICIADA CORRECTAMENTE
        $_SESSION['usuario'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'correo' => $usuario['correo'],
            'zona_horaria' => $usuario['zona_horaria'] ?? 'UTC'
        ];

        echo "success";

    } else {
        echo "error_credenciales";
    }
    
} catch (PDOException $e) {
    echo "error_bd";
}
?>