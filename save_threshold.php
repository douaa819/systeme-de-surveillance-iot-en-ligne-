<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["sensor"]) && !empty($_POST["threshold"])) {
        $sensor = $_POST["sensor"];
        $threshold = floatval($_POST["threshold"]); // Assure que c'est bien un float

        // Requête SQL pour insérer ou mettre à jour le seuil
        $stmt = $conn->prepare("INSERT INTO thresholds (sensor, threshold_value) VALUES (?, ?) 
                                ON DUPLICATE KEY UPDATE threshold_value = ?");
        $stmt->bind_param("sdd", $sensor, $threshold, $threshold);

        if ($stmt->execute()) {
            echo "Seuil enregistré avec succès.";
        } else {
            echo "Erreur lors de l'enregistrement : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur : données manquantes.";
    }
}

$conn->close();
?>
