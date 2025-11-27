<?php
// Recibe $t desde tareas_table.php
?>

<div class="tareas-row">

    <!-- NOMBRE -->
    <div class="col col-nombre">
        <?= htmlspecialchars($t["titulo"]) ?>
    </div>

    <!-- DESCRIPCIÓN -->
    <div class="col col-descripcion">
        <?= htmlspecialchars($t["descripcion"] ?? "") ?>
    </div>

    <!-- PRIORIDAD -->
    <div class="col col-prioridad">
        <span class="chip-prioridad chip-prioridad--<?= $t["prioridad"] ?>">
            <?php
                if ($t["prioridad"] === "low")   echo "Baja";
                if ($t["prioridad"] === "medium") echo "Media";
                if ($t["prioridad"] === "high")  echo "Alta";
            ?>
        </span>
    </div>

    <!-- FECHA LÍMITE -->
    <div class="col col-fecha">
        <?= date("d/m/Y", strtotime($t["fecha_limite"])) ?>
    </div>

    <!-- ACCIONES -->
    <div class="col col-acciones">

        <!-- EDITAR -->
        <button
    class="btn-accion btn-accion-editar js-edit-task"
    data-id="<?= $t["id_tarea"] ?>"
    data-titulo="<?= htmlspecialchars($t["titulo"], ENT_QUOTES) ?>"
    data-descripcion="<?= htmlspecialchars($t["descripcion"] ?? "", ENT_QUOTES) ?>"
    data-estado="<?= $t["estado_tarea"] ?>"
    data-prioridad="<?= $t["prioridad"] ?>"
    data-fecha="<?= date("Y-m-d", strtotime($t["fecha_limite"])) ?>"
>
    Editar
</button>


        <!-- ELIMINAR -->
        <button
            class="btn-accion btn-accion-eliminar js-open-delete"
            data-id="<?= $t["id_tarea"] ?>"
            data-titulo="<?= htmlspecialchars($t["titulo"], ENT_QUOTES) ?>"
        >
            Eliminar
        </button>

    </div>

</div>
