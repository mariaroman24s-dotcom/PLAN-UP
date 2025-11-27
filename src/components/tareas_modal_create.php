<link rel="stylesheet" href="/public/css/tareas_modal.css">

<!-- BACKDROP -->
<div id="modal-create-backdrop" class="modal-backdrop hidden"></div>

<!-- MODAL -->
<div id="modal-create" class="modal hidden">

    <div class="modal-header">
        <h2>Agregar tarea</h2>
        <button class="modal-close" id="btn-close-create">✕</button>
    </div>

    <form method="POST" action="/src/config/tareas_create.php" class="modal-body">

        <!-- TÍTULO -->
        <label>Título de la tarea:</label>
        <input type="text" name="titulo" required class="modal-input">

        <!-- DESCRIPCIÓN -->
        <label>Descripción de la tarea:</label>
        <textarea name="descripcion" class="modal-textarea"></textarea>

        <div class="modal-row">

            <!-- ESTADO -->
            <div>
                <label>Estado de la tarea:</label>
                <select name="estado_tarea" class="modal-select">
                    <option value="pending">Pendiente</option>
                    <option value="in_progress">En proceso</option>
                    <option value="completed">Completada</option>
                </select>
            </div>

            <!-- PRIORIDAD -->
            <div>
                <label>Prioridad de la tarea:</label>
                <select name="prioridad" class="modal-select">
                    <option value="low">Baja</option>
                    <option value="medium">Media</option>
                    <option value="high">Alta</option>
                </select>
            </div>
        </div>

        <!-- FECHA -->
        <label>Fecha límite:</label>
        <input type="date" name="fecha_limite" required class="modal-input">

        <!-- BOTÓN GUARDAR -->
        <button type="submit" class="modal-submit">
            <img src="/public/img/icons/tareas/add_white.png" class="w-4 h-4">
            Agregar tarea
        </button>

    </form>
</div>
