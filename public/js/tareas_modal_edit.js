document.addEventListener("DOMContentLoaded", () => {
    console.log("EDIT JS CARGADO ✔");

    const editModal      = document.getElementById("modal-edit");
    const editBackdrop   = document.getElementById("modal-edit-backdrop");
    const closeEditBtn   = document.getElementById("btn-close-edit");

    // CAMPOS DEL FORMULARIO
    const editFormId     = document.getElementById("edit-id-tarea");
    const editTitulo     = document.getElementById("edit-titulo");
    const editDesc       = document.getElementById("edit-descripcion");
    const editEstado     = document.getElementById("edit-estado");
    const editPrioridad  = document.getElementById("edit-prioridad");
    const editFecha      = document.getElementById("edit-fecha");

    if (!editModal) {
        console.error("❌ No se encontró el modal de edición");
        return;
    }

    // ABRIR MODAL DESDE LA TABLA
    document.querySelectorAll(".js-edit-task").forEach(btn => {

        btn.addEventListener("click", () => {

            const id    = btn.dataset.id;
            const titulo= btn.dataset.titulo || "";
            const desc  = btn.dataset.descripcion || "";
            const estado= btn.dataset.estado || "pending";
            const prio  = btn.dataset.prioridad || "low";
            const fecha = btn.dataset.fecha || "";

            console.log("Abriendo editar ID:", id);

            // ASIGNAR A FORMULARIO
            editFormId.value    = id;
            editTitulo.value    = titulo;
            editDesc.value      = desc;
            editEstado.value    = estado;
            editPrioridad.value = prio;
            editFecha.value     = fecha;

            // MOSTRAR MODAL
            editModal.classList.remove("hidden");
            editBackdrop.classList.remove("hidden");
        });
    });

    // CERRAR MODAL
    function closeEditModal() {
        editModal.classList.add("hidden");
        editBackdrop.classList.add("hidden");
    }

    closeEditBtn.addEventListener("click", closeEditModal);
    editBackdrop.addEventListener("click", closeEditModal);
});
