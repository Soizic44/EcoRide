<?php
//echo session_save_path();
session_start();

// Traitement du formulaire

// Vérifie si la méthode de la requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //POST n'est pas vide, on vérifie que toutes les données sont présentes
    if(isset($_POST['email'], $_POST['immatriculation'], $_POST['dateImmat'], $_POST['marque'], $_POST['modele'], $_POST['couleur'], $_POST['places'])
        // Vérification si champs remplis
        && !empty($_POST['immatriculation']) && !empty($_POST['immatriculation']) && !empty($_POST['dateImmat']) && !empty($_POST['marque']) && !empty($_POST['modele']) && !empty($_POST['couleur']) && !empty($_POST['places']))
    {
    
        // Les valeurs requises du formulaire sont complètes
        // Assignation et récupération les variables du formulaire en les protégeant
        if(isset($_POST['submit'])){  
            $choixForm = strip_tags($_POST['choix']);
            $emailForm = strip_tags($_POST['email']);
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

        $emailForm = $_POST['email'];
        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorecte");
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

        //Récupérer les utilisateurs
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() == 1){
            $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Récupération de l'id-user de la table users
        //$query = "SELECT id_user FROM users WHERE email = :email";
        //$stmt = $pdo->prepare($query);
        //$stmt->bindParam(':email', $emailForm);
        //$stmt->execute();
        //$reponse = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //$id_user = $reponse;

        //foreach ($stmt as $row) {
        //    print_r($row);
        //}

        // requete 1 Table preferences
        $query1 = "INSERT INTO preferences (tabac, animal, preferences) 
        VALUES (:tabac, :animal, :preferences)";
        //Préparation de la requête d'insertion (SQL) pour Table preferences
        $stmt = $pdo->prepare($query1);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':tabac', $fumeurForm);
        $stmt->bindParam(':animal', $animalForm);
        $stmt->bindParam(':preferences', $ajoutPrefForm);
        // Executer ma requete 1
        $stmt->execute();

        // On récupère l'id preferences
        $last_id_pref = $pdo->lastInsertId();


        // requete 2 Table preferences
        $query2 = "INSERT INTO detailCar (marque, modele, couleur, ecolo, places) 
        VALUES (:marque, :modele, :couleur, :ecolo, :places)";
        //Préparation de la requête d'insertion (SQL) pour Table preferences
        $stmt = $pdo->prepare($query2);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':marque', $marqueForm);
        $stmt->bindParam(':modele', $modeleForm);
        $stmt->bindParam(':couleur', $couleurForm);
        $stmt->bindParam(':ecolo', $electForm);
        $stmt->bindParam(':places', $placesForm);
        // Executer ma requete 2
        $stmt->execute();

        // On récupère l'id preferences
        $last_id_detailCar = $pdo->lastInsertId();


        // Récupération de l'id-user de la table users
        $query = "SELECT id_user FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();
        /* styles PDOStatement::fetch */
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        print $result->id_user;
        print "\n";

        // requete 3 Table voiture
        $query3 = "INSERT INTO voiture (immatriculation, date_immat, idPref, idDetail, idUser) 
        VALUES (:immatriculation, :date_immat, :idPref, :idDetail, :id_user)";

        //Préparation de la requête d'insertion (SQL) pour Table voiture
        $stmt = $pdo->prepare($query3);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':immatriculation', $immatForm);
        $stmt->bindParam(':date_immat', $dateImmatForm);
        $stmt->bindParam(':idPref', $last_id_pref);
        $stmt->bindParam(':idDetail', $last_id_detailCar);
        $stmt->bindValue(':id_user', print $result->id_user);

        // Executer ma requete 3
        $stmt->execute();

        //Redirection vers page 
        header("Location: /profil");

    }else{
        die("Le formulaire est incomplet");
    }
}
?>