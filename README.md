# IoT Dashboard Web – Simulation en temps réel

Ce projet simule un système de surveillance IoT permettant de suivre en temps réel des capteurs environnementaux (température, humidité, luminosité), de générer des alertes en cas de dépassement de seuils, et de configurer dynamiquement ces seuils via une interface graphique intuitive.

## Fonctionnalités principales

- Surveillance en temps réel des capteurs simulés
- Génération automatique d'alertes en cas de dépassement des seuils critiques
-  Configuration personnalisée des seuils depuis l’interface utilisateur
- Historique des alertes avec stockage en base de données
- Rafraîchissement automatique des données toutes les 2 secondes
- Interface graphique responsive et lisible

##  Structure du site

Le projet est structuré en trois pages principales :

- **Tableau de bord** : affichage dynamique des valeurs simulées
- **Configuration des seuils** : formulaire pour modifier les seuils en base de données
- **Historique des alertes** : affichage des événements enregistrés avec date/heure

##  Technologies utilisées

- **Frontend** : HTML, CSS, JavaScript (rafraîchissement dynamique)
- **Backend** : PHP
- **Base de données** : MySQL (via WAMP ou phpMyAdmin)
- **Serveur local** : WAMP / XAMPP


