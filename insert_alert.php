<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["sensor"]) && isset($_POST["value"]) && isset($_POST["threshold"])) {
        $sensor = $_POST["sensor"];
        $value = floatval($_POST["value"]);
        $threshold = floatval($_POST["threshold"]);

        // Vérifie si la valeur dépasse le seuil
        if ($value > $threshold) {
            $stmt = $conn->prepare("INSERT INTO alerts (sensor, value, threshold) VALUES (?, ?, ?)");
            $stmt->bind_param("sdd", $sensor, $value, $threshold);

            if ($stmt->execute()) {
                echo "Alerte enregistrée avec succès !";
            } else {
                echo "Erreur lors de l'enregistrement : " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Valeur en dessous du seuil, aucune alerte enregistrée.";
        }
    } else {
        echo "Données incomplètes.";
    }
}

$conn->close();
?>
