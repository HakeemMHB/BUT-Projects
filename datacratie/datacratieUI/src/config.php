<?php
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    http_response_code(403);
    die('Accès interdit !');
}

$host = 'localhost';
$dbname = 'saes3-lpivet';
$username = 'saes3-lpivet';
$password = 'uGEinWjCXRrl2B+r';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion :" . $e->getMessage());
}
?>