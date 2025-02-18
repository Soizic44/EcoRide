export default class Route {
    constructor(url, title, pathHtml, authorize, pathJS = "") {
        this.url = url;
        this.title = title;
        this.pathHtml = pathHtml;
        this.pathJS = pathJS;
        this.authorize = authorize
    }
}

/*
[] -> Tout le monde peut y accéder
["diconnected"] -> Réserver aux utilisateurs déconnecté
["chauffeur"] -> Réserver aux utilisateurs avec le rôle chauffeur
["passager"] -> Réserver aux utilisateurs avec le rôle passager
["employe"] -> Réserver aux utilisateurs avec le rôle employé
["admin"] -> Réserver aux utilisateurs avec le rôle admin
["admin", "employe", "chauffeur", "passager"] -> Réserver aux utilisateurs avec le rôle admin OU employé OU chauffeur OU passager
*/

