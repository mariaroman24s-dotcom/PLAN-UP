<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/conexion.php";

// No permitir acceso sin POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /src/views/menu.php?page=tareas");
    exit;
}

// Validar que haya usuario logueado REAL
if (!isset($_SESSION['usuario']['id'])) {
    die("Error: no hay un usuario logueado.");
}

$id_usuario = $_SESSION['usuario']['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = $_POST["titulo"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $fecha_limite = $_POST["fecha_limite"] ?? "";
    $estado = $_POST["estado_tarea"] ?? "pending";
    $prioridad = $_POST["prioridad"] ?? "low";

    // Validación básica
    if ($titulo === "" || $fecha_limite === "") {
        header("Location: /src/views/menu.php?page=tareas&error=incomplete");
        exit;
    }

    $sql = "INSERT INTO tareas (id_usuario, titulo, descripcion, fecha_limite, estado_tarea, prioridad)
            VALUES (:id_usuario, :titulo, :descripcion, :fecha_limite, :estado_tarea, :prioridad)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "id_usuario"   => $id_usuario,
        "titulo"       => $titulo,
        "descripcion"  => $descripcion,
        "fecha_limite" => $fecha_limite,
        "estado_tarea" => $estado,
        "prioridad"    => $prioridad
    ]);

    // Regresar al panel de tareas
    header("Location: /src/views/menu.php?page=tareas");
    exit;
}
?>
