<link rel="stylesheet" href="/public/css/tareas_modal.css">

<!-- BACKDROP -->
<div id="modal-delete-backdrop" class="modal-backdrop hidden"></div>

<!-- MODAL ELIMINAR -->
<div id="modal-delete" class="modal hidden">

    <div class="modal-header">
        <h2>Eliminar tarea</h2>
        <button type="button" class="modal-close" id="btn-close-delete">✕</button>
    </div>

    <form method="POST" action="/src/config/tareas_delete.php" class="modal-body">

        <p>¿Seguro que deseas eliminar esta tarea?</p>
        <p id="delete-task-title" class="font-semibold mb-3"></p>

        <input type="hidden" name="id_tarea" id="delete-id-tarea">

        <div class="modal-row" style="justify-content: flex-end; gap: 10px; margin-top: 10px;">
            <button type="button" class="modal-secondary" id="btn-cancel-delete">
                Cancelar
            </button>

            <button type="submit" class="modal-submit modal-submit-delete">
                Eliminar
            </button>
        </div>

    </form>

</div>
