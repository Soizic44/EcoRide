<?php
// Empêche les utilisateurs connectés d'accéder à l'inscription
if(isset($_SESSION["users"])){
    header("Location: /");
    exit;   
}

//Récuperation de mes variables de connexion
$dsn = 'mysql:host=localhost;dbname=ecoride';
$username = 'root';
$password = '';

//Création connexion PDO
try{
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    die("Erreur de connexion à la base de données : ". $e->getMessage());
}

//Soumission du formulaire
if(isset($_POST['submit'])){   

    // Vérification que tous les champs requis sont remplis
    if(isset($_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['confirmPw'])
        && !empty($_POST['pseudo']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['confirmPw'])
        //Vérification si un fichier a été envoyé
        && isset($_FILES['image']) && $_FILES['image']['error'] === 0
    ){
        // Le formulaire est complet
        // Assignation et récupération des données en les protégeant
        $pseudoForm = strip_tags($_POST['pseudo']);
        $nomForm = strip_tags($_POST['nom']);
        $prenomForm = strip_tags($_POST['prenom']);
        $roleForm = $_POST['role'];
        $emailForm = $_POST['email'];
        $_SESSION["error"] = [];
        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"][] = "L'adresse email est incorecte";
        }

        //Vérifier l’unicité de l’adresse mail
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() > 0){ 
            $_SESSION["error"][] = "Cette adresse email est déjà utilisée"; 
            //Redirection vers page 
            header("Location: /");
        }

        //vérification que les 2 mots de passe sont identique
        if($_POST['mdp'] === $_POST['confirmPw']) {
            
            // Hashage(encryptage) du mot de passe
            $mdpForm = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $confirmPwForm = password_hash($_POST['confirmPw'], PASSWORD_BCRYPT);
        }

        // Vérifications de l'image
        // Vérification de l'extension de l'image et le type Mime
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png",
        ];
        // Récupération des informations de l'image
        $filename = $_FILES['image']['name'];
        $filetype = $_FILES['image']['type'];
        $filesize = $_FILES['image']['size'];

        // Pour insertion image dans dossier protégé
        // Puis vérification que l'image est bien nommé (récupération info puis vérification)
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        // Vérification de l'absence d'extension dans les clés de $allowed
        if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)){
            // Si l'extension et/ou le type est incorrect
            $_SESSION["error"][] = "Erreur, format de fichier incorrect";
        }

        // Si le type est incorrect --> On le limite à 1Mo
        if($filesize > 1024 * 1024){
            $_SESSION["error"][] = "Fichier trop volumineux";
        }

        // Après création fichier "htaccess" --> Copier l'ancier fichier dans dossier "photos"
        // Génération d'un nom unique des images
        $newname = md5(uniqid());
        // Génération du chemin complet de l'image
        $newfilename = __DIR__ . "/../../photos/$newname.$extension";

        // Et déplacer mon image dans dossier créé
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)){
            $_SESSION["error"][] = "L'upload a échoué";
        }

        // Protection du dossier pour limiter la lecture, eciture et éxecution
        chmod($newfilename, 0644);

        // Récupérer l'id_role en fonction de la valeur saisie dans le formulaire
        $roleForm = $_POST['role'];
        switch ($roleForm) {
        case "passager":
            $role = "passager";
            break;
        case "chauffeur/passager":
            $role = "chauffeur/passager";
            break;
        case "employe":
            $role = "employe";
            break;
        default:
            $role = "chauffeur";
        }

        // Insertion des données saisies en base de données
        $requete = $pdo->prepare("INSERT INTO users VALUES (0, :pseudo, :nom, :prenom, :photo, :email, :password)");
        $requete->execute(
            array(
                "pseudo" => $pseudoForm,
                "nom" => $nomForm,
                "prenom" => $prenomForm,
                "photo" => $newname.$extension,
                "email" => $emailForm,
                "password" => $mdpForm
            )   
        );

        // Récupération de l'id de nouvel utilisateur
        $id_user = $pdo->lastInsertId();

        // requete 2 Table role
        $query2 = "INSERT INTO role (libelle, idUser) 
        VALUES (:libelle, :idUser)";

        //Préparation de la requête d'insertion (SQL) pour Table preferences
        $stmt = $pdo->prepare($query2);
        //Insertion des données saisies en base de données
        $stmt->bindParam(':libelle', $role);
        $stmt->bindParam(':idUser', $id_user, PDO::PARAM_INT);
        // Executer ma requete 2
        $stmt->execute();


        // On démarre la session PHP
        //--> Ici c'est Javascript qui est programmer pour le faire
        session_start();

        //Stocker dans $_SESSION les informations de l'utilisateur
        $_SESSION["users"] = [
            "idUser" => $id_user,
            "pseudo" => $pseudoForm,
            "email" => $emailForm,
            "role" => $role
        ];

        //Redirection vers page 
        header("Location: /connexion");

    }else{
        $_SESSION["error"][] = "Le formulaire est imcomplet";
    }
}
?>       