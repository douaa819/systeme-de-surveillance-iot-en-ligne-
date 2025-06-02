<?php
$servername = "localhost";
$username = "root";  // Remplace par ton utilisateur MySQL
$password = "";      // Remplace par ton mot de passe MySQL si nécessaire
$dbname = "iot_alerts"; // Correspond bien au nom de ta base

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
