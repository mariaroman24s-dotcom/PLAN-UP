/* ================================
   CAMBIAR MES EN CALENDARIO VERTICAL
==================================*/
function changeMonth(step) {
    const url = new URL(window.location.href);
    const current = url.searchParams.get("dia") || new Date().toISOString().slice(0, 10);

    const date = new Date(current);

    // Cambiar mes
    date.setMonth(date.getMonth() + step);

    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, "0");
    const dd = "01"; // siempre día 1

    url.searchParams.set("dia", `${yyyy}-${mm}-${dd}`);
    window.location.href = url.toString();
}

/* ================================
   DROPDOWN DE AÑOS
==================================*/
function toggleYearDropdown(e) {
    e.stopPropagation();
    document.getElementById("yearDropdown").classList.toggle("hidden");
}

// Cerrar dropdown si clic fuera
document.addEventListener("click", () => {
    document.getElementById("yearDropdown")?.classList.add("hidden");
});

/* ================================
   SELECCIONAR AÑO
==================================*/
document.addEventListener("DOMContentLoaded", () => {
    const yearOptions = document.querySelectorAll(".year-option");

    yearOptions.forEach(opt => {
        opt.addEventListener("click", () => {
            const year = opt.dataset.year;

            const url = new URL(window.location.href);
            const current = url.searchParams.get("dia") || new Date().toISOString().slice(0, 10);

            const d = new Date(current);
            const mm = String(d.getMonth() + 1).padStart(2, "0");
            const dd = String(d.getDate()).padStart(2, "0");

            url.searchParams.set("dia", `${year}-${mm}-${dd}`);
            window.location.href = url.toString();
        });
    });

    /* ================================
       CLIC EN DÍAS DEL CALENDARIO VERTICAL
    ==================================*/
    document.querySelectorAll(".calendar-grid .day").forEach(day => {
        day.addEventListener("click", () => {
            const date = day.dataset.date;
            if (!date) return;

            const url = new URL(window.location.href);
            url.searchParams.set("dia", date);
            window.location.href = url.toString();
        });
    });

    
    document.querySelectorAll(".circle-day").forEach(circle => {
        circle.addEventListener("click", () => {
            const date = circle.dataset.date;
            if (!date) return;

            const url = new URL(window.location.href);
            url.searchParams.set("dia", date);
            window.location.href = url.toString();
        });
    });

});


function moveHorizontalDays(step) {
    const url = new URL(window.location.href);
    const current = url.searchParams.get("dia") || new Date().toISOString().slice(0, 10);

    // Descomponer fecha
    const [year, month, day] = current.split("-");
    const baseDate = new Date(year, month - 1, day);

    // Mover día EXACTAMENTE 1 por click
    baseDate.setDate(baseDate.getDate() + step);

    // Normalizar fecha
    const yyyy = baseDate.getFullYear();
    const mm = String(baseDate.getMonth() + 1).padStart(2, "0");
    const dd = String(baseDate.getDate()).padStart(2, "0");

    url.searchParams.set("dia", `${yyyy}-${mm}-${dd}`);
    window.location.href = url.toString();
}
