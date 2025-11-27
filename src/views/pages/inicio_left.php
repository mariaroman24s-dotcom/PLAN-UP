<h2 class="text-2xl font-bold text-[#0C2C58] mb-4">Bienvenido</h2>
<p class="text-gray-600 mb-6">Aquí tienes un resumen de tus tareas y eventos.</p>

<!-- CONTENEDOR IZQUIERDO (Tareas + Eventos) -->
<div class="flex flex-col gap-8">

    <!-- MIS TAREAS -->
    <?php include "tareas_left.php"; ?>

    <!-- MIS EVENTOS -->
    <?php include "../components/events_small_list.php"; ?>

</div>
