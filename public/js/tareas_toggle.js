document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".toggle-header").forEach(header => {
        header.addEventListener("click", () => {
            const section = header.closest(".tareas-section");
            const content = section.querySelector(".toggle-content");
            const arrow = header.querySelector(".arrow");

            content.classList.toggle("hidden");

            if (content.classList.contains("hidden")) {
                arrow.textContent = "▲"; // flechita arriba
            } else {
                arrow.textContent = "▼"; // flechita abajo
            }
        });
    });
});
