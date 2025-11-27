<?php
$host = getenv("DB_HOST") ?: "localhost";
$port = getenv("DB_PORT") ?: "5432";
$dbname = getenv("DB_NAME") ?: "planu";
$user = getenv("DB_USER") ?: "postgres";
$password = getenv("DB_PASS") ?: "3312";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Error de conexión (" . $e->getCode() . "): " . $e->getMessage());
}
?>