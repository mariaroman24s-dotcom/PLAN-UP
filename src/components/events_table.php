<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/conexion.php";

// ID REAL DEL USUARIO LOGUEADO
$id_usuario = $_SESSION["usuario"]["id"] ?? null;

// Debug opcional
// echo "<!-- ID_USER_TABLE = $id_usuario -->";

if (!$id_usuario) {
    echo "<p style='color:red; font-weight:bold;'>No hay usuario logueado.</p>";
    return;
}

$stmt = $pdo->prepare("
    SELECT *
    FROM eventos
    WHERE id_usuario = :id
    ORDER BY fecha_inicio ASC
");

$stmt->execute(["id" => $id_usuario]);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/public/css/events_table.css">
<script src="/public/js/events_table.js" defer></script>

<div class="events-table-box">
    <h3 class="table-title">Próximos eventos</h3>

    <table class="events-table">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Lugar</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($eventos as $e): ?>
                <tr>
                    <!-- Evento -->
                    <td><?= htmlspecialchars($e["titulo"]) ?></td>

                    <!-- Fecha -->
                    <td>
                        <?= date("d-m-Y H:i", strtotime($e["fecha_inicio"])) ?>
                        <br>
                        <strong><?= date("H:i", strtotime($e["fecha_fin"])) ?></strong>
                    </td>

                    <!-- Descripción -->
                    <td>
                        <?= !empty($e["descripcion"]) 
                            ? htmlspecialchars($e["descripcion"])
                            : "<span style='color:#aaa;'>Sin descripción</span>" ?>
                    </td>

                    <!-- Lugar -->
                    <td><?= htmlspecialchars($e["ubicacion"]) ?></td>

                    <!-- Opciones -->
                    <td>
                        <button 
                            class="edit-btn js-edit-event"
                            data-id="<?= $e['id_evento'] ?>"
                            data-titulo="<?= htmlspecialchars($e['titulo'], ENT_QUOTES) ?>"
                            data-descripcion="<?= htmlspecialchars($e['descripcion'] ?? '', ENT_QUOTES) ?>"
                            data-inicio="<?= $e['fecha_inicio'] ?>"
                            data-fin="<?= $e['fecha_fin'] ?>"
                            data-ubicacion="<?= htmlspecialchars($e['ubicacion'], ENT_QUOTES) ?>"
                        >Editar</button>

                        <button class="delete-btn" onclick="deleteEvent(<?= $e['id_evento'] ?>)">
                            Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
