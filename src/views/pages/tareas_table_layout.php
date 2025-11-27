<link rel="stylesheet" href="/public/css/tareas_right.css">

<div class="tareas-panel-right">

    <!-- ================= PENDIENTE ================= -->
    <section class="tareas-section">
        <h3 class="tareas-section-title tareas-section-title--pending" onclick="toggleSection('pending')">
            <span id="arrow-pending" class="tareas-section-bullet tareas-section-bullet--pending">▼</span>
            Pendiente
        </h3>

        <div id="section-pending" class="tareas-section-content">
            <?php include __DIR__ . "/tareas_table_head.php"; ?>

            <?php if (count($pendientes) === 0): ?>
                <p class="tareas-section-empty">Sin tareas pendientes.</p>
            <?php else: ?>
                <?php foreach ($pendientes as $t): ?>
                    <?php include __DIR__ . "/tarea_fila.php"; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- ================= EN PROCESO ================= -->
    <section class="tareas-section">
        <h3 class="tareas-section-title tareas-section-title--process" onclick="toggleSection('process')">
            <span id="arrow-process" class="tareas-section-bullet tareas-section-bullet--process">▼</span>
            En proceso
        </h3>

        <div id="section-process" class="tareas-section-content">
            <?php include __DIR__ . "/tareas_table_head.php"; ?>

            <?php if (count($proceso) === 0): ?>
                <p class="tareas-section-empty">Sin tareas en proceso.</p>
            <?php else: ?>
                <?php foreach ($proceso as $t): ?>
                    <?php include __DIR__ . "/tarea_fila.php"; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- ================= COMPLETADAS ================= -->
    <section class="tareas-section">
        <h3 class="tareas-section-title tareas-section-title--done" onclick="toggleSection('done')">
            <span id="arrow-done" class="tareas-section-bullet tareas-section-bullet--done">▼</span>
            Completada
        </h3>

        <div id="section-done" class="tareas-section-content">
            <?php include __DIR__ . "/tareas_table_head.php"; ?>

            <?php if (count($completadas) === 0): ?>
                <p class="tareas-section-empty">Sin tareas completadas.</p>
            <?php else: ?>
                <?php foreach ($completadas as $t): ?>
                    <?php include __DIR__ . "/tarea_fila.php"; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

</div>
