import Route from "./Route.js";

//Définir ici vos routes
export const allRoutes = [
    new Route("/", "Accueil", "/pages/visiteur/accueil.html", [], "/js/visiteur/accueil.js"),
    new Route("/mentions-legales", "Mentions légales", "/pages/visiteur/mentions-legales.html", []),
    new Route("/formulaire-covoit", "Formulaire de covoiturage", "/pages/visiteur/formulaire-covoit.html", [], "/js/visiteur/formulaire-covoit.js"),
    new Route("/tableau-covoit", "Covoiturage disponibles", "/pages/visiteur/covoiturage/tableau-covoit.html", []),
    new Route("/detail-covoit", "Détail du covoiturage", "/pages/visiteur/covoiturage/detail-covoit.html", []),
    new Route("/contact", "contact", "/pages/visiteur/contact.html", [], "/js/visiteur/contact.js"),
    new Route("/connexion", "connexion", "/pages/authentif/connexion.html", ["disconnected"], "/js/authentif/connexion.js"),
    new Route("/creation-cpt", "Création de compte", "/pages/authentif/creation-cpt.html", ["disconnected"], "/js/authentif/creation-cpte.js"),
    new Route("/modifier-mp", "Modifier mon mot de passe", "/pages/authentif/modifier-mp.html", [], "/js/authentif/modifier-mp.js"),
    new Route("/espace-user", "Espace utilisateur", "/pages/user/creat-espace-user.html", ["user", "chauffeur", "passager"], "/js/user/espace-user.js"),
    new Route("/modifier-user", "Modifier utilisateur", "/pages/user/modifier-user.html", ["user", "chauffeur", "passager"], "/js/user/modifier-user.js"),
    new Route("/table-employe", "Table employé", "/pages/user/table-employe.html", ["admin"]),
    new Route("/creat-employe", "creation employé", "/pages/user/creat-employe.html", ["admin"], "/js/user/creat-employe.js"),
    new Route("/modif-employe", "modification employé", "/pages/user/modif-employe.html", ["admin"], "/js/user/modif-employe.js"),
    new Route("/creation-voyage", "Créer un voyage", "/pages/user/voyage/creation-voyage.html", ["user", "chauffeur", "passager"], "/js/user/creation-voyage.js"),
    new Route("/modifier-voyage", "Modifier un voyage", "/pages/user/voyage/modifier-voyage.html", ["user", "chauffeur", "passager"]),
    new Route("/historique-cov", "Historique des voyages", "/pages/user/voyage/historique-cov.html", ["user", "chauffeur", "passager", "employe"], "/js/user/historique-cov.js"),
    new Route("/avis", "Avis des covoiturages", "/pages/user/voyage/avis.html", ["user", "chauffeur", "passager"], "/js/user/creation-avis.js"),
    new Route("/recap-avis", "Récapitulatif des avis", "/pages/user/voyage/recap-avis.html", ["user", "chauffeur", "passager", "employe"]),
    new Route("/credit", "Récapitulatif des crédits", "/pages/user/voyage/credit.html", ["connected"]),
];

//Le titre s'affiche comme ceci : Route.titre - websitename
export const websiteName = "EcoRide";