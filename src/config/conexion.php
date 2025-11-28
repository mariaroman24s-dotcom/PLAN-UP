<?php
$host = "dpg-d4jqmmvdiees73b363j0-a.virginia-postgres.render.com";
$port = "5432";
$dbname = "planu_0etm";
$user = "ferchis";
$password = "vzhkmzImuePlTd5GclZ5yvAKUpXBs7Fq";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // ✅ INICIAR SESIÓN DESPUÉS DE LA CONEXIÓN EXITOSA
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.save_path', __DIR__ . '/../../sessions');
        session_start();
    }

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>