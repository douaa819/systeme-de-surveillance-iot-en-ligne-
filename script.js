//  Génération et affichage des valeurs aléatoires de capteurs
function generateRandomSensorValues() {
    const temp = (Math.random() * 10 + 20).toFixed(1); // Température entre 20 et 30
    const humidity = (Math.random() * 40 + 30).toFixed(1); // Humidité entre 30% et 70%
    const light = Math.floor(Math.random() * 1000); // Luminosité entre 0 et 1000 lx

    document.getElementById("temp-value").textContent = `${temp} °C`;
    document.getElementById("humidity-value").textContent = `${humidity} %`;
    document.getElementById("light-value").textContent = `${light} lx`;
}

//  Mise à jour des valeurs simulées toutes les 5 secondes
setInterval(generateRandomSensorValues, 2000);
generateRandomSensorValues(); // Lancer immédiatement à l'ouverture

//  Récupération des seuils pour affichage
function fetchThresholds() {
    fetch("get_thresholds.php")
    .then(response => response.json())
    .then(data => {
        console.log("📊 Seuils récupérés :", data);

        let thresholdList = document.getElementById("threshold-list");
        if (thresholdList) {
            thresholdList.innerHTML = "";

            if (Array.isArray(data)) {
                data.forEach(threshold => {
                    let li = document.createElement("li");
                    li.textContent = `${threshold.sensor} : ${threshold.threshold_value}`;
                    thresholdList.appendChild(li);
                });
            } else {
                console.error("❌ Erreur : format de données incorrect pour les seuils", data);
            }
        }
    })
    .catch(error => console.error("❌ Erreur lors de la récupération des seuils :", error));
}

//  Récupération des alertes
function fetchAlerts() {
    fetch("get_alerts.php")
    .then(response => response.json())
    .then(data => {
        console.log("🚀 Données des alertes récupérées :", data);

        let alertMessage = document.getElementById("alert-message");
        if (alertMessage) {
            alertMessage.innerHTML = "";

            if (Array.isArray(data)) {
                data.forEach(alert => {
                    let div = document.createElement("div");
                    div.textContent = `⚠️ Alerte ! ${alert.sensor} : ${alert.value} dépasse ${alert.threshold}`;
                    alertMessage.appendChild(div);
                });
            } else {
                console.error("❌ Erreur : format de données incorrect pour les alertes", data);
            }
        }
    })
    .catch(error => console.error("❌ Erreur lors de la récupération des alertes :", error));
}

//  Vérification périodique
setInterval(() => {
    fetch("check_alerts.php")
        .then(response => response.text())
        .then(data => console.log("🔄 Mise à jour des alertes :", data))
        .catch(error => console.error("❌ Erreur lors de la mise à jour des alertes :", error));
}, 2000); 

//  Rafraîchir les seuils et alertes
setInterval(fetchThresholds, 2000);
setInterval(fetchAlerts, 2000);
