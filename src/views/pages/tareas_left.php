<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// IMPORTANTE: aquí usamos la estructura CORRECTA de la sesión
$id_usuario = $_SESSION['usuario']['id'] ?? null;

// usa la misma conexión que en el resto del proyecto
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/config/conexion.php";

if (!$id_usuario) {
    echo "<p style='color:red; font-weight:bold;'>No se encontró el ID de usuario en la sesión.</p>";
    return;
}

// Traer tareas del usuario (todas)
$stmt = $pdo->prepare("
    SELECT id_tarea, titulo, estado_tarea 
    FROM tareas
    WHERE id_usuario = :id
    ORDER BY fecha_limite ASC
");
$stmt->execute(['id' => $id_usuario]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- PANEL IZQUIERDO DE TAREAS -->
<h2 class="text-2xl font-bold text-[#1C1F53] mb-6">Tareas</h2>

<div class="flex items-center justify-between mb-4">
    <div class="flex items-center gap-2">
        <img src="/public/img/icons/tareas_icon.png" class="w-6">
        <span class="text-xl font-semibold text-[#1C1F53]">Mis tareas</span>
    </div>

    <!-- BOTÓN MÁS PEQUEÑO (manteniendo tu estilo) -->
    <button class="bg-[#0C2C58] text-white px-4 py-1.5 rounded-full shadow-md hover:brightness-110 transition flex items-center gap-1"
            style="height:29px"
            onclick="window.location.href='menu.php?page=tareas&action=create'">
        <span class="text-base font-semibold">+</span> Agregar
    </button>
</div>

<!-- Línea vertical estilo Figma -->
<div class="border-l-4 border-[#1C1F53] ml-3 pl-6">

    <?php if (count($tareas) === 0): ?>

        <!-- MENSAJE CUANDO NO HAY TAREAS -->
        <p class="text-gray-500 font-semibold mt-2">
            No tienes tareas pendientes
        </p>

    <?php else: ?>

        <?php foreach ($tareas as $t): ?>
            <div class="flex items-center gap-3 mb-4">

                <!-- Icono según estado -->
                <?php if ($t['estado_tarea'] == 'pending'): ?>
                    <img src="/public/img/icons/tarea_pendiente.png" class="w-6 h-6">
                <?php elseif ($t['estado_tarea'] == 'in_progress'): ?>
                    <img src="/public/img/icons/tarea_proceso.png" class="w-6 h-6">
                <?php else: ?>
                    <img src="/public/img/icons/tarea_completada.png" class="w-6 h-6">
                <?php endif; ?>

                <!-- Título -->
                <span class="text-[#1C1F53] text-lg font-medium">
                    <?= htmlspecialchars($t['titulo']) ?>
                </span>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>
