<link rel="stylesheet" href="/public/css/tareas_modal.css">

<!-- BACKDROP -->
<div id="modal-edit-backdrop" class="modal-backdrop hidden"></div>

<!-- MODAL EDITAR -->
<div id="modal-edit" class="modal hidden">

    <div class="modal-header">
        <h2>Editar tarea</h2>
        <button class="modal-close" id="btn-close-edit">✕</button>
    </div>

    <form method="POST" action="/src/config/tareas_update.php" class="modal-body">

        <input type="hidden" name="id_tarea" id="edit-id-tarea">

        <label>Título de la tarea:</label>
        <input type="text" name="titulo" id="edit-titulo" required class="modal-input">

        <label>Descripción de la tarea:</label>
        <textarea name="descripcion" id="edit-descripcion" class="modal-textarea"></textarea>

        <div class="modal-row">

            <div>
                <label>Estado de la tarea:</label>
                <select name="estado_tarea" id="edit-estado" class="modal-select">
                    <option value="pending">Pendiente</option>
                    <option value="in_progress">En proceso</option>
                    <option value="completed">Completada</option>
                </select>
            </div>

            <div>
                <label>Prioridad de la tarea:</label>
                <select name="prioridad" id="edit-prioridad" class="modal-select">
                    <option value="low">Baja</option>
                    <option value="medium">Media</option>
                    <option value="high">Alta</option>
                </select>
            </div>
        </div>

        <label>Fecha límite:</label>
        <input type="date" name="fecha_limite" id="edit-fecha" required class="modal-input">

        <button type="submit" class="modal-submit">
            Guardar cambios
        </button>

    </form>
</div>
