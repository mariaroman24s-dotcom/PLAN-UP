<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/conexion.php";

$id_usuario = $_SESSION['usuario']['id'] ?? null;

if (!$id_usuario) {
    echo "<p style='color:red'>No se encontró el ID de usuario.</p>";
    return;
}

// Traer tareas reales
$stmt = $pdo->prepare("
    SELECT id_tarea, titulo, descripcion, estado_tarea, prioridad, fecha_limite
    FROM tareas
    WHERE id_usuario = :id
    ORDER BY fecha_limite ASC
");
$stmt->execute(['id' => $id_usuario]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Agrupar
$pendientes = array_filter($tareas, fn($t) => $t['estado_tarea'] === 'pending');
$proceso     = array_filter($tareas, fn($t) => $t['estado_tarea'] === 'in_progress');
$completadas = array_filter($tareas, fn($t) => $t['estado_tarea'] === 'completed');

?>

<link rel="stylesheet" href="/public/css/tareas_right.css">
<script src="/public/js/tareas_toggle.js"></script>

<div class="tareas-table-wrapper">

    <!-- =============== PENDIENTE =============== -->
    <section class="tareas-section" data-section="pendiente">

        <h3 class="tareas-section-title tareas-section-title--pending toggle-header">
            <span class="arrow">▼</span> Pendiente
        </h3>

        <div class="toggle-content">

            <?php if (count($pendientes) == 0): ?>
                <p class="mensaje-seccion-vacia">Sin tareas pendientes.</p>
            <?php endif; ?>

            <?php foreach ($pendientes as $t): ?>
                <?php include __DIR__ . "/../views/pages/tarea_fila.php"; ?>
            <?php endforeach; ?>

        </div>

    </section>



    <!-- =============== EN PROCESO =============== -->
    <section class="tareas-section" data-section="proceso">

        <h3 class="tareas-section-title tareas-section-title--process toggle-header">
            <span class="arrow">▼</span> En proceso
        </h3>

        <div class="toggle-content">

            <?php if (count($proceso) == 0): ?>
                <p class="mensaje-seccion-vacia">Sin tareas en proceso.</p>
            <?php endif; ?>

            <?php foreach ($proceso as $t): ?>
                <?php include __DIR__ . "/../views/pages/tarea_fila.php"; ?>
            <?php endforeach; ?>

        </div>

    </section>



    <!-- =============== COMPLETADA =============== -->
    <section class="tareas-section" data-section="completada">

        <h3 class="tareas-section-title tareas-section-title--done toggle-header">
            <span class="arrow">▼</span> Completada
        </h3>

        <div class="toggle-content">

            <?php if (count($completadas) == 0): ?>
                <p class="mensaje-seccion-vacia">Sin tareas completadas.</p>
            <?php endif; ?>

            <?php foreach ($completadas as $t): ?>
                <?php include __DIR__ . "/../views/pages/tarea_fila.php"; ?>
            <?php endforeach; ?>

        </div>

    </section>

</div>
