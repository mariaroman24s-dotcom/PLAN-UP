<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "conexion.php";

// Obtener ID REAL del usuario logueado
$id_usuario = $_SESSION["usuario"]["id"] ?? null;

// Validar sesión
if (!$id_usuario) {
    echo "no_session";
    exit;
}

// Obtener datos del POST
$titulo      = $_POST["titulo"] ?? null;
$descripcion = $_POST["descripcion"] ?? null;
$inicio      = $_POST["fecha_inicio"] ?? null;
$fin         = $_POST["fecha_fin"] ?? null;
$ubicacion   = $_POST["ubicacion"] ?? null;

// Validación básica
if (!$titulo || !$inicio || !$fin) {
    echo "missing_fields";
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO eventos (id_usuario, titulo, descripcion, fecha_inicio, fecha_fin, ubicacion)
        VALUES (:id, :t, :d, :fi, :ff, :u)
    ");

    $stmt->execute([
        "id" => $id_usuario,
        "t" => $titulo,
        "d" => $descripcion,
        "fi" => $inicio,
        "ff" => $fin,
        "u" => $ubicacion
    ]);

    echo "success";

} catch (Exception $e) {
    echo "error: " . $e->getMessage();
}
