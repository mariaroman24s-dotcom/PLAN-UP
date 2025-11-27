<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/conexion.php";

// ID REAL DEL USUARIO LOGUEADO
$id_usuario = $_SESSION["usuario"]["id"] ?? null;

// Debug opcional
// echo "<!-- ID_SMALL_LIST = $id_usuario -->";

if (!$id_usuario) {
    echo "<p class='no-events'>No hay sesión activa.</p>";
    return;
}

// Consulta: próximos 5 eventos del usuario logueado
$stmt = $pdo->prepare("
    SELECT titulo, fecha_inicio
    FROM eventos
    WHERE id_usuario = :id
    ORDER BY fecha_inicio ASC
    LIMIT 5
");

$stmt->execute(["id" => $id_usuario]);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/public/css/events_small_list.css">

<div class="small-events-box">
    <h3 class="small-events-title">Mis eventos</h3>

    <?php if (count($eventos) === 0): ?>
        <p class="no-events">No tienes eventos próximos.</p>

    <?php else: ?>
        <ul class="small-events-list">
            <?php foreach ($eventos as $e):
                $fecha = date("d-M-Y", strtotime($e["fecha_inicio"]));
            ?>
                <li>
                    <span class="event-icon">🔔</span>
                    <span class="event-title"><?= htmlspecialchars($e["titulo"]) ?></span>
                    <span class="event-date">— <?= $fecha ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
