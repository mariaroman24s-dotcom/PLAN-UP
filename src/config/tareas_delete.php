<?php
require_once __DIR__ . "/conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../views/menu.php?page=tareas");
    exit;
}

$id_tarea = $_POST["id_tarea"] ?? null;

if (!$id_tarea) {
    header("Location: ../views/menu.php?page=tareas");
    exit;
}

// ⚠️ Opcional: podrías validar también id_usuario con la sesión
$stmt = $pdo->prepare("DELETE FROM tareas WHERE id_tarea = :id");
$stmt->execute(["id" => $id_tarea]);

header("Location: ../views/menu.php?page=tareas");
exit;
