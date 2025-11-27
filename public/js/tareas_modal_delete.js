document.addEventListener("DOMContentLoaded", () => {
    const backdrop   = document.getElementById("modal-delete-backdrop");
    const modal      = document.getElementById("modal-delete");
    const closeBtn   = document.getElementById("btn-close-delete");
    const cancelBtn  = document.getElementById("btn-cancel-delete");
    const inputId    = document.getElementById("delete-id-tarea");
    const titleLabel = document.getElementById("delete-task-title");

    if (!modal) return; // por si no estamos en la página de tareas

    function openDeleteModal(id, titulo) {
        inputId.value = id;
        titleLabel.textContent = titulo;

        backdrop.classList.remove("hidden");
        modal.classList.remove("hidden");
    }

    function closeDeleteModal() {
        backdrop.classList.add("hidden");
        modal.classList.add("hidden");
    }

    // Botones "Eliminar" en la tabla
    document.querySelectorAll(".js-open-delete").forEach(btn => {
        btn.addEventListener("click", () => {
            const id     = btn.dataset.id;
            const titulo = btn.dataset.titulo || "";
            openDeleteModal(id, titulo);
        });
    });

    // Cerrar al dar clic en la X o en "Cancelar"
    [closeBtn, cancelBtn].forEach(el => {
        if (!el) return;
        el.addEventListener("click", () => {
            closeDeleteModal();
        });
    });

    // Cerrar al hacer clic en el fondo
    if (backdrop) {
        backdrop.addEventListener("click", (e) => {
            if (e.target === backdrop) {
                closeDeleteModal();
            }
        });
    }
});
