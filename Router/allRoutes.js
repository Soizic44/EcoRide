import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/visiteur/accueil.html", []),
    new Route("/mentions-legales", "Mentions légales", "/pages/visiteur/mentions-legales.html", []),
    new Route("/formulaire-covoit", "Formulaire de covoiturage", "/pages/visiteur/formulaire-covoit.html", []),
    new Route("/tableau-covoit", "Covoiturage disponibles", "/pages/visiteur/covoiturage/tableau-covoit.html", []),
    new Route("/detail-covoit", "Détail du covoiturage", "/pages/visiteur/covoiturage/detail-covoit.html", []),
    new Route("/contact", "contact", "/pages/visiteur/contact.html", [], "/js/visiteur/contact.js"),
    new Route("/connexion", "connexion", "/pages/authentif/connexion.html", ["disconnected"], "/js/authentif/connexion.js"),
    new Route("/creation-cpt", "Création de compte", "/pages/authentif/creation-cpt.html", ["disconnected"]),
    new Route("/modifier-mp", "Modifier mon mot de passe", "/pages/authentif/modifier-mp.html", ["diconnected"]),
    new Route("/espace-user", "Espace utilisateur", "/pages/user/creat-espace-user.html", ["chauffeur", "passager"], "/js/user/espace-user.js"),
    new Route("/modifier-user", "Modifier utilisateur", "/pages/user/modifier-user.html", ["chauffeur", "passager"]),
    new Route("/creation-voyage", "Créer un voyage", "/pages/user/voyage/creation-voyage.html", ["chauffeur", "passager"]),
    new Route("/modifier-voyage", "Modifier un voyage", "/pages/user/voyage/modifier-voyage.html", ["chauffeur", "passager"]),
    new Route("/historique-cov", "Historique des voyages", "/pages/user/voyage/historique-cov.html", ["chauffeur", "passager", "employe"], "/js/user/historique-cov.js"),
    new Route("/avis", "Avis des covoiturages", "/pages/user/voyage/avis.html", ["chauffeur", "passager"]),
    new Route("/recap-avis", "Récapitulatif des avis", "/pages/user/voyage/recap-avis.html", ["chauffeur", "passager", "employe"]),
];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "EcoRide";