<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion.php";

// Validar sesión del usuario
$id_usuario = $_SESSION["usuario"]["id"] ?? null;

if (!$id_usuario) {
    echo "no_session";
    exit;
}

// Validar ID recibido
$id_evento = $_GET["id"] ?? null;

if (!$id_evento) {
    echo "no_id";
    exit;
}

try {
    // Borrar SOLO si el evento pertenece al usuario
    $stmt = $pdo->prepare("
        DELETE FROM eventos
        WHERE id_evento = :id_evento
        AND id_usuario = :id_usuario
    ");

    $stmt->execute([
        "id_evento" => $id_evento,
        "id_usuario" => $id_usuario
    ]);

    // Si no se borró ninguna fila → el evento NO era del usuario
    if ($stmt->rowCount() === 0) {
        echo "not_allowed";
        exit;
    }

    echo "deleted";

} catch (PDOException $e) {
    echo "error";
}
