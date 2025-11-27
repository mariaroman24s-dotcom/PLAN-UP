document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("eventEditModal");
    const backdrop = document.getElementById("eventEditBackdrop");

    const inputId = document.getElementById("edit-event-id");
    const inputTitulo = document.getElementById("edit-event-titulo");
    const inputDesc = document.getElementById("edit-event-desc");
    const inputInicio = document.getElementById("edit-event-inicio");
    const inputFin = document.getElementById("edit-event-fin");
    const inputUbicacion = document.getElementById("edit-event-ubicacion");

    // 🔥 ABRIR MODAL AL CLIC EN EDITAR
    document.querySelectorAll(".js-edit-event").forEach(btn => {
        btn.addEventListener("click", () => {

            inputId.value = btn.dataset.id;
            inputTitulo.value = btn.dataset.titulo;
            inputDesc.value = btn.dataset.descripcion;
            inputInicio.value = btn.dataset.inicio;
            inputFin.value = btn.dataset.fin;
            inputUbicacion.value = btn.dataset.ubicacion;

            modal.classList.remove("hidden");
            backdrop.classList.remove("hidden");
        });
    });

    // 🔥 CERRAR MODAL
    window.closeEventEditModal = function () {
        modal.classList.add("hidden");
        backdrop.classList.add("hidden");
    };

    backdrop?.addEventListener("click", closeEventEditModal);

    // 🔥 GUARDAR CAMBIOS
    const form = document.getElementById("eventEditForm");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        let data = new FormData(form);

        const res = await fetch("/src/config/event_update.php", {
            method: "POST",
            body: data
        });

        const msg = await res.text();

        if (msg === "updated") {
            alert("Evento actualizado");
            location.reload();
        } else {
            alert("Error: " + msg);
        }
    });
});
