<?php
require_once "conexion.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    echo json_encode(["error" => "missing_id"]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT id_tarea, titulo, descripcion, estado_tarea, prioridad, fecha_limite
    FROM tareas
    WHERE id_tarea = :id
    LIMIT 1
");
$stmt->execute(["id" => $id]);

$tarea = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($tarea);
