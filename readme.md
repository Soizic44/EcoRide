# EcoRide ![logo-ecoride](image.png)
Ce site est une plateforme de covoiturage pour la Startup "EcoRide", sous forme d'application web de recherche et d'échange de service de covoiturage.

Ce site web est une plateforme de covoiturage pour la Startup "EcoRide", sous forme d'application web de recherche et d'échange de service de covoiturage.
Cette application est développée dans le cadre de l'ECF du Titre Professionnel Développeur Web et Web Mobile.

# Description du projet 
La startup "EcoRide", a pour objectif de réduire l'impact environnemental des déplacements en encourageant le covoiturage. L'application permet aux utilisateurs de proposer ou de rechercher des trajets en voiture, avec un système de crédits intégré.

# Installation et Configuration
## Prérequis 
Avoir installé XAMPP ou Stack AMP
•	Serveur local : Apache/2.4.58 (Win64)
•	PHP : Version 7/8.2.12
•	MariaDB : Version 10.4.32 ou supérieure
•	Navigateur : Chrome, Firefox, Safari

## Étapes d'installation
1.	Cloner le projet
git clone [URL_DU_DEPOT]
cd ecoride
2.	Configuration de la base de données
•	Ouvrir phpMyAdmin
•	Importer le fichier SQL fournie dans le git : bdd-ecoride.sql

3.	Configuration PHP
•	Vérifier que config/database.php pointe vers votre base MySQL
•	Paramètres par défaut XAMPP :
o	Host: localhost
o	Database: ecoride
o	User: root
o	Password: (vide)

4.	Lancer l'application
•	Démarrer XAMPP
•	Accéder à http://localhost/ecoride
👥 Comptes de Test

Passager
•	Email : test@gmail.com
•	Mot de passe : Password123.

Chauffeur
•	Email : christophe.chazal@gmail.com
•	Mot de passe : Password123.

Emplyé
•	Email : admin@ecoride.fr
•	Mot de passe : Password123.

Administrateur
•	Email : admin@ecoride.fr
•	Mot de passe : Password123.

# Fonctionnalités Implémentées
✅ US Réalisées (80% du projet)
•	US 1 : Page d'accueil avec présentation entreprise ✅

•	US 2 : Menu de navigation responsive ✅

•	US 3 : Vue des covoiturages avec recherche ✅

•	US 4 : Filtres des covoiturages (prix, type véhicule) ✅

•	US 5 : Vue détaillée d'un covoiturage ✅

•	US 6 : Participer à un covoiturage : (Module de réservation en cours) ⚠️

•	US 7 : Création de compte et authentification ✅

•	US 8 : Espace utilisateur avec profil (en cours)

•	US 9 : Saisir un voyage ✅

•	US 10 : historique des covoiturages visuel✅ / fonctionnel (liaison avec Bdd en cours)

•	US 11 : Démarrer et arrêter un covoiturage (en cours)

•	US 12 : Espace employé (en cours)

•	US 13 : Espace administrateur (en cours)

⚠️ Fonctionnalités principales non finalisées
1.	Authentification sécurisée
	- Connexion avec sessions PHP
	- Hachage des mots de passe
2.	Recherche de itinéraire 
	Filtres sur résultat de la recherche par date, , durée, prix, aspect écologique et note chauffeur
	Tri des résultats
3.	Espace utilisateur
	Profil avec infos personnelles
	Récapitulatif Véhicules
	Historique des covoiturage (chauffeur)
	Historique des voyage (passager)
	Gestion des réservations
	Récapitulatif des crédits
4.	Récapitulatif de crédits
	Module de paiement (fictif)
	Remboursement automatique en cas d'annulation
5.	Espace administrateur
	Tableau de gestion des employés
	Un graphique affichant le nombre de covoiturage par jour
	Un graphique affichant combien la plateforme gagne de crédit en fonction des jours
	
# Architecture Technique
## Stack Technologique
•	Frontend : HTML5, CSS, JavaScript
•	Backend : PHP 8.x avec PDO
•	Base de données relationnelle : SQL (MariaDB),
•	Base de données NoSQL : MariaDB
•	Serveur : Apache
•	Hebergement : AlwaysData
•	Déploiement : FileZilla


## Charte Graphique
Couleurs principales
•	Primaire : #324400 (Vert foncé)
•	Secondaire : #96B63E (Vert clair)

## Typography
•	Police : Arial, Helvetica, sans-serif

## Sécurité
•	Protection CSRF : Tokens de session
•	Injection SQL : Requêtes préparées PDO
•	XSS : Échappement avec htmlspecialchars(), strip_tags()
•	Mots de passe : Hachage password_hash() BCRYPT
•	email : filtre de vérification d'email filter_var()

## Responsive Design
L'application est entièrement responsive :
•	Mobile : < 768px
•	Tablette : 850px - 1200px
•	Desktop : > 1200px

## Tests
Parcours utilisateur testés
1.	Inscription → Connexion → Création profil
Vérification avant de comite
Puis à la fin de la branche développement vérification de l'intégralité des fonctionnalités intégrés pour envoi sur branche principale Git (Merge)

## Support / Licence
Projet ECF : Titre Professionnel DWWM 2025
Projet éducatif - ECF Studi 2025

