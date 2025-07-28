<?php
// Traitement du formulaire

// Vérifie si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //POST n'est pas vide, on vérifie que toutes les données sont présentes
    if(isset($_POST['immatriculation'], $_POST['dateImmat'], $_POST['marque'], $_POST['modele'], $_POST['couleur'], $_POST['places'])
        // Vérification si champs remplis
        && !empty($_POST['immatriculation']) && !empty($_POST['dateImmat']) && !empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['couleur']) && !empty($_POST['places']))
    {
    
        // Les valeurs requises du formulaire sont complètes
        // Assignation et récupération les variables du formulaire en les protégeant
        if(isset($_POST['submit'])){  
            $choixForm = strip_tags($_POST['choix']);
            $immatForm = strip_tags($_POST['immatriculation']);
            $dateImmatForm = strip_tags($_POST['dateImmat']);
            $marqueForm = strip_tags($_POST['marque']);
            $modeleForm = strip_tags($_POST['modele']);
            $couleurForm = strip_tags($_POST['couleur']);
            $electForm = strip_tags($_POST['ecolo']);
            $placesForm = strip_tags($_POST['places']);
            $fumeurForm = strip_tags($_POST['fumeur']);
            $animalForm = strip_tags($_POST['animal']);
        }

        // Récupération des données en les protégeant(failles xxs)
        // On neutralise toute balise des ajouts de préférences
        if(isset($_POST['ajoutPref'])){
            $ajoutPrefForm = htmlspecialchars($_POST['ajoutPref']);
        }

        // Connexion à la base de données
        // Récuperation de mes variables de connexion
        $dsn = 'mysql:host=localhost;dbname=ecoride';
        $username = 'root';
        $password = '';

        // Connexion PDO à la base de données
        try{
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Erreur de connexion à la base de données : ". $e->getMessage();
        }

        // Selectionner l'id de l'utilisateur concerné en récupérant de dernier id_user créé
        $stmt = $pdo->query("SELECT LAST_INSERT_ID()");
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $lastIdUser = $row[0];

        // requete 1 Table voiture
        $query1 = "INSERT INTO voiture (immatriculation, date_immat, marque, modele, couleur, ecolo, place_dispo, id_user) 
        VALUES (:immatriculation, :dateImmat, :marque, :modele, :couleur, :ecolo, :places, :id_user)
        INNER JOIN users ON voiture.id_user = id_user";
        //Préparation de la requête d'insertion (SQL) pour Table role
        $stmt = $pdo->prepare($query1);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':immatriculation', $immatForm);
        $stmt->bindParam('::dateImmat', $dateImmatForm);
        $stmt->bindParam(':marque', $marqueForm);
        $stmt->bindParam(':modele', $modeleForm);
        $stmt->bindParam(':couleur', $couleurForm);
        $stmt->bindParam(':ecolo',$electForm);
        $stmt->bindParam(':places',$placesForm);
        $stmt->bindParam(':id_user',$id_user, PDO::PARAM_INT);
        // Executer ma requete 1
        $stmt->execute();
        // On récupère l'id voiture
        $last_id_voiture = $pdo->lastInsertId();

        // requete 2 Table preferences
        $query2 = "INSERT INTO preferences (tabac, animal, preferences, id_voiture) VALUES (:fumeur, :animal, :ajoutPref, :id_voiture)
        INNER JOIN voiture ON preferences.id_voiture = $last_id_voiture";
        //Préparation de la requête d'insertion (SQL) pour Table role
        $stmt = $pdo->prepare($query2);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':fumeur', $fumeurForm, PDO::PARAM_INT);
        $stmt->bindParam(':animal',$animalForm, PDO::PARAM_INT);
        $stmt->bindParam(':ajoutPref', $ajoutPrefForm, PDO::PARAM_INT);
        $stmt->bindParam(':id_voiture', $last_id_voiture, PDO::PARAM_INT);
        // Executer ma requete 2
        $stmt->execute();

        //Redirection vers page 
        header("Location: /profil");

    }else{
        die("Le formulaire est incomplet");
    }
}
?>