<?php
//  Inclusion du fichier de configuration contenant la connexion à la base de données
require_once 'config.php';

//  Génération de valeurs aléatoires simulées pour chaque capteur
$sensor_values = [
    "Température" => rand(20, 60),      // Température entre 20°C et 60°C
    "Humidité" => rand(10, 100),        // Humidité entre 10% et 100%
    "Luminosité" => rand(100, 1000)     // Luminosité entre 100 et 1000 lx
];

//  Requête SQL pour récupérer tous les seuils enregistrés dans la table "thresholds"
$sql = "SELECT * FROM thresholds";
$result = $conn->query($sql);

//  Vérifie si des seuils sont trouvés
if ($result->num_rows > 0) {
    //  Parcours de chaque seuil enregistré
    while ($row = $result->fetch_assoc()) {
        $sensor = $row['sensor'];                  // Nom du capteur (ex: Température)
        $threshold = $row['threshold_value'];      // Seuil défini pour ce capteur
        $value = $sensor_values[$sensor];          // Valeur actuelle simulée du capteur

        //  Affichage des informations du capteur
        echo "Capteur : $sensor | Valeur : $value | Seuil : $threshold <br>";

        //  Si la valeur dépasse le seuil, on génère une alerte
        if ($value > $threshold) {
            //  Requête pour insérer l'alerte dans la table "alerts"
            $insert_sql = "INSERT INTO alerts (sensor, value, threshold) VALUES ('$sensor', $value, $threshold)";
            
            //  Exécution de l'insertion et vérification de réussite
            if ($conn->query($insert_sql)) {
                echo "🚀 Alerte insérée pour $sensor <br>";  // Alerte enregistrée avec succès
            } else {
                echo "❌ Erreur MySQL : " . $conn->error . "<br>";  // Erreur SQL affichée
            }
        } else {
            // ✅ Si la valeur ne dépasse pas le seuil, aucune alerte
            echo "✅ Pas d'alerte pour $sensor <br>";
        }
    }
} else {
    // ⚠️ Aucun seuil enregistré dans la base de données
    echo "❌ Aucun seuil trouvé dans la base de données.";
}

//  Fermeture de la connexion à la base de données
$conn->close();
?>
