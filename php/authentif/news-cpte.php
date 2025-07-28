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
        $roleForm = strip_tags($_POST['role']);
        $emailForm = $_POST['email'];
        // Vérification que la valeur est bien un email
        if(!filter_var($emailForm, FILTER_VALIDATE_EMAIL)){
            die("L'adresse email est incorecte");
        }

        //Vérifier l’unicité de l’adresse mail
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

        //Est-ce que l’utilisateur (mail) existe ?
        if($stmt->rowCount() > 0){  
            die("Cette adresse email est déjà utilisée");
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
            die("Erreur, format de fichier incorrect");
        }

        // Si le type est incorrect --> On le limite à 1Mo
        if($filesize > 1024 * 1024){
            die("Fichier trop volumineux");
        }

        // Après création fichier "htaccess" --> Copier l'ancier fichier dans dossier "photos"
        // Génération d'un nom unique des images
        $newname = md5(uniqid());
        // Génération du chemin complet de l'image
        $newfilename = __DIR__ . "/../../photos/$newname.$extension";

        // Et déplacer mon image dans dossier créé
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)){
            die("L'upload a échoué");
        }

        // Protection du dossier pour limiter la lecture, eciture et éxecution
        chmod($newfilename, 0644);

        // Récupérer l'id_role en fonction de la valeur saisie dans le formulaire
        $roleForm = $_POST['role'];
        switch ($roleForm) {
        case "passager":
            $id_role = 4;
            break;
        case "chauffeur/passager":
            $id_role = 5;
            break;
        case "employe":
            $id_role = 2;
            break;
        default:
            $id_role = 3;
        }

        // Insertion des données saisies en base de données
        $requete = $pdo->prepare("INSERT INTO users VALUES (0, :pseudo, :nom, :prenom, :photo, :email, :password, :id_role)");
        $requete->execute(
            array(
                "pseudo" => $pseudoForm,
                "nom" => $nomForm,
                "prenom" => $prenomForm,
                "photo" => $newname.$extension,
                "email" => $emailForm,
                "password" => $mdpForm,
                "id_role" => $id_role
            )   
        );

        // Récupération de l'id de nouvel utilisateur
        $id_user = $pdo->lastInsertId();

        // On démarre la session PHP
        //--> Ici c'est Javascript qui est programmer pour le faire
        session_start();

        //Stocker dans $_SESSION les informations de l'utilisateur
        $_SESSION["users"] = [
            "idUser" => $id_user,
            "pseudo" => $pseudoForm,
            "nom" => $nomForm,
            "prenom" => $prenomForm,
            "email" => $emailForm,
            "role" => $roleForm
        ];

        //Redirection vers page 
        header("Location: /connexion");

    }else{
        die("Le formulaire est imcomplet");
    }
}
?>       