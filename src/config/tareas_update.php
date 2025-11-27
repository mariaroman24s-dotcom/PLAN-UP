<?php
require_once "conexion.php";

$id = $_POST["id_tarea"];

if (!$id) {
    die("missing_id");
}

$stmt = $pdo->prepare("
    UPDATE tareas
    SET 
        titulo = :t,
        descripcion = :d,
        estado_tarea = :e,
        prioridad = :p,
        fecha_limite = :f,
        fecha_actualizacion = NOW()
    WHERE id_tarea = :id
");

$stmt->execute([
    "t"  => $_POST["titulo"],
    "d"  => $_POST["descripcion"],
    "e"  => $_POST["estado_tarea"],
    "p"  => $_POST["prioridad"],
    "f"  => $_POST["fecha_limite"],
    "id" => $id
]);

header("Location: /src/views/menu.php?page=tareas");
exit;
