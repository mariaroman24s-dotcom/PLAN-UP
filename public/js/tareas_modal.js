const btnOpen = document.getElementById("btn-open-create");
const btnClose = document.getElementById("btn-close-create");

const modal = document.getElementById("modal-create");
const backdrop = document.getElementById("modal-create-backdrop");

// =========================
// ABRIR MODAL CREAR
// =========================
if (btnOpen) {
    btnOpen.addEventListener("click", () => {
        modal.classList.remove("hidden");
        backdrop.classList.remove("hidden");
    });
}

// =========================
// CERRAR MODAL CREAR
// =========================
if (btnClose) {
    btnClose.addEventListener("click", () => {
        modal.classList.add("hidden");
        backdrop.classList.add("hidden");
    });
}

// =========================
// ABRIR MODAL DE EDICIÓN
// =========================
function openEditModal(id) {

    document.getElementById("modal-edit").classList.remove("hidden");
    document.getElementById("modal-edit-backdrop").classList.remove("hidden");

    fetch(`/src/config/tareas_get.php?id=` + id)
        .then(res => res.json())
        .then(data => {

            document.getElementById("edit-id").value = data.id_tarea;
            document.getElementById("edit-titulo").value = data.titulo;
            document.getElementById("edit-descripcion").value = data.descripcion;
            document.getElementById("edit-estado").value = data.estado_tarea;
            document.getElementById("edit-prioridad").value = data.prioridad;
            document.getElementById("edit-fecha").value = data.fecha_limite.split(" ")[0];
        });
}

// =========================
// CERRAR MODAL EDITAR
// =========================
document.getElementById("btn-close-edit").addEventListener("click", () => {
    document.getElementById("modal-edit").classList.add("hidden");
    document.getElementById("modal-edit-backdrop").classList.add("hidden");
});

// =========================
// ABRIR MODAL ELIMINAR
// =========================
function openDeleteModal(id) {

    document.getElementById("modal-delete").classList.remove("hidden");
    document.getElementById("modal-delete-backdrop").classList.remove("hidden");

    document.getElementById("delete-id").value = id;
}

// =========================
// CERRAR MODAL ELIMINAR
// =========================
document.getElementById("btn-close-delete").addEventListener("click", () => {
    document.getElementById("modal-delete").classList.add("hidden");
    document.getElementById("modal-delete-backdrop").classList.add("hidden");
});

document.getElementById("cancel-delete").addEventListener("click", () => {
    document.getElementById("modal-delete").classList.add("hidden");
    document.getElementById("modal-delete-backdrop").classList.add("hidden");
});
