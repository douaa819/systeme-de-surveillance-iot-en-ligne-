<?php
//  Définit le type de contenu de la réponse HTTP : ici ce sera du JSON
header("Content-Type: application/json");

//  Inclut le fichier de configuration pour se connecter à la base de données
require_once 'config.php';

//  Prépare une requête SQL pour récupérer tous les seuils enregistrés
$sql = "SELECT * FROM thresholds";

//  Exécute la requête SQL
$result = $conn->query($sql);

//  Crée un tableau vide pour stocker les seuils
$thresholds = [];

//  Si des résultats sont trouvés (au moins une ligne dans la table)
if ($result->num_rows > 0) {
    //  Parcourt chaque ligne du résultat
    while ($row = $result->fetch_assoc()) {
        //  Ajoute la ligne (sous forme associative) au tableau $thresholds
        $thresholds[] = $row;
    }
}

//  Convertit le tableau des seuils en format JSON et l'envoie comme réponse
echo json_encode($thresholds);

//  Ferme la connexion à la base de données
$conn->close();
?>
