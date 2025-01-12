# Documentation

## Architecture

Ce projet utilise Docker pour orchestrer plusieurs services :

- **Client** : Un serveur apache pour servir les fichiers HTML statiques.
- **Serveur** : Un serveur PHP avec Apache pour traiter les requêtes.
- **Base de Données** : MySQL pour la persistance des données.
- **Admin** : phpMyAdmin pour gérer la base de données.
- **Mailcatcher** : MailHog pour tester l'envoi d'emails.

## Instructions

### Installation

1. **Clonez le dépôt** : 

git clone https://github.com/Matthieu24/docker_tp_m_matthieu.git

2. **Copiez les fichier .env.example en .env pour la configuration de l’environnement** :

cp .env.example .env && cp .env.prod.example .env.prod && cp .env.dev.example .env.dev

## Lancement en Environnement de Développement

docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d

## Lancement en Environnement de Production

docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

## Construire l'images

docker-compose -f docker-compose.yml -f docker-compose.prod.yml build

## Accéder à l'application

1. **Accéder à l'application** : Ouvrez votre navigateur à `http://localhost` pour le client et `http://localhost:8081` pour phpMyAdmin.
2. **Tester les emails** : Accédez à `http://localhost:8025` pour voir les emails capturés par MailHog.