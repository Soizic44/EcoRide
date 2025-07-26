<?php
//Récuperation de mes variables de connexion
$dsn = 'mysql:host=localhost;dbname=ecoride';
$username = 'user_php';
$password = '5f7zfgIo8SF25R';

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
    ){
        // Le formulaire est complet
        // Assignation et récupération des données en les protégeant
        $pseudoForm = strip_tags($_POST['pseudo']);
        $nomForm = strip_tags($_POST['nom']);
        $prenomForm = strip_tags($_POST['prenom']);
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
            header("Location: /creation-cpt");
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
        $newfilename = __DIR__ . "/photos/$newname.$extension";

        // Et déplacer mon image dans dossier créé
        if(!move_uploaded_file($_FILES['image']['tmp_name'], $newfilename)){
            die("L'upload a échoué");
        }

        // Protection du dossier pour limiter la lecture, eciture et éxecution
        chmod($newfilename, 0644);

        //Insertion des données saisies en base de données
        $requete = $pdo->prepare("INSERT INTO users VALUES (0, :pseudo, :nom, :prenom, :image, :email, :mdp, :confirmPw)");
        $requete->execute(
            array(
                "pseudo" => $pseudoForm,
                "nom" => $nomForm,
                "prenom" => $prenomForm,
                "image" => $newname.$extension,
                "email" => $emailForm,
                "mdp" => $mdpForm,
                "confirmPw" => $confirmPwForm
            )   
        );

        // Récupération de l'id de nouvel utilisateur
        $id_user = $pdo->lastIsertId();

        //Redirection vers page 
        header("Location: /espace-user");

    }else{
        die("Le formulaire est imcomplet");
    }
}
?>