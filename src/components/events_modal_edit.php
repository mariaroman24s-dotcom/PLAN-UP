<link rel="stylesheet" href="/public/css/event_new.css">

<!-- BACKDROP -->
<div id="eventEditBackdrop" class="event-modal hidden"></div>

<!-- MODAL -->
<div id="eventEditModal" class="event-modal hidden">
    <div class="event-modal-content">

        <h2 class="modal-title">Editar evento</h2>

        <form id="eventEditForm">

            <input type="hidden" name="id_evento" id="edit-event-id">

            <label>Título del evento</label>
            <input type="text" id="edit-event-titulo" name="titulo" required>

            <label>Descripción</label>
            <textarea id="edit-event-desc" name="descripcion"></textarea>

            <label>Fecha de inicio</label>
            <input type="datetime-local" id="edit-event-inicio" name="fecha_inicio" required>

            <label>Fecha de fin</label>
            <input type="datetime-local" id="edit-event-fin" name="fecha_fin" required>

            <label>Lugar</label>
            <input type="text" id="edit-event-ubicacion" name="ubicacion">

            <div class="modal-buttons">
                <button type="button" class="cancel" onclick="closeEventEditModal()">Cancelar</button>
                <button type="submit" class="save">Guardar cambios</button>
            </div>

        </form>
    </div>
</div>
