<?php
$host = 'localhost';
$dbname = 'e5-formation';
$user = 'root';
$pass = 'matthis49';
$dsn = "mysql:host=$host;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
try {
    global $pdo;
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    dd('Connexion échouée : ' . $e->getMessage());
}
