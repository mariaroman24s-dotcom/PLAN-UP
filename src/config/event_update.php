<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion.php";

// ID real del usuario logueado
$id_usuario = $_SESSION["usuario"]["id"] ?? null;

if (!$id_usuario) {
    echo "no_session";
    exit;
}

// Datos recibidos del formulario
$id_evento  = $_POST["id_evento"] ?? null;
$titulo     = $_POST["titulo"] ?? null;
$descripcion= $_POST["descripcion"] ?? null;
$inicio     = $_POST["fecha_inicio"] ?? null;
$fin        = $_POST["fecha_fin"] ?? null;
$ubicacion  = $_POST["ubicacion"] ?? null;

if (!$id_evento) {
    echo "no_id";
    exit;
}

try {
    // EDITAR SOLO SI EL EVENTO PERTENECE AL USUARIO
    $stmt = $pdo->prepare("
        UPDATE eventos
        SET titulo = :t,
            descripcion = :d,
            fecha_inicio = :fi,
            fecha_fin = :ff,
            ubicacion = :u
        WHERE id_evento = :id_evento
        AND id_usuario = :id_usuario
    ");

    $stmt->execute([
        "id_evento"  => $id_evento,
        "id_usuario" => $id_usuario,
        "t"  => $titulo,
        "d"  => $descripcion,
        "fi" => $inicio,
        "ff" => $fin,
        "u"  => $ubicacion
    ]);

    if ($stmt->rowCount() === 0) {
        echo "not_allowed";
        exit;
    }

    echo "updated";

} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
