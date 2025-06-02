<?php
require_once 'config.php';

// Supprimer l’historique si le bouton est cliqué
if (isset($_POST['delete_history'])) {
    $conn->query("DELETE FROM alerts");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Alertes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Historique des Alertes</h1>
        <nav>
            <a href="index.html">Tableau de bord</a>
            <a href="config.html">Configuration</a>
        </nav>
    </header>

    <main>
        <!-- Formulaire pour supprimer l'historique -->
        <form method="post" style="margin-bottom: 20px;">
            <button type="submit" name="delete_history" onclick="return confirm('Voulez-vous vraiment supprimer tout l’historique ?')">
                Supprimer l’historique
            </button>
        </form>

        <!-- Tableau des alertes -->
        <table border="1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Capteur</th>
                    <th>Valeur Mesurée</th>
                    <th>Seuil Dépassé</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM alerts ORDER BY alert_time DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['alert_time']}</td>
                                <td>{$row['sensor']}</td>
                                <td>{$row['value']}</td>
                                <td>{$row['threshold']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune alerte enregistrée</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
