<!--START : hero-->
<section class="hero_formulaire hero">
    <h1>Modifier mot de passe</h1>
</section>
<!--END : hero-->

<!--START : Modifier mot de passe-->
<section class="recherche"> 
    <div class="containForm padding">
        <form action="" method="POST">
            <div class="titre pad">
                <label for="email">Identifiant (Email) :</label>
                <input class="form-input" id="email" type="email" name="email" placeholder="test@mail.fr" required>
                <div class="feedback" id="feedMail">
                    <p>! Le mail est incorrect !</p>
                </div>
            </div>
            <div class="titre pad">
                <label for="password">Mot de passe :</label>
                <input class="form-input" id="password" type="password" name="mdp" placeholder="Mot de passe" required>
                <div class="feedback" id="feedPw">
                    <p>! Le mot de passe doit contenir 8 caractères minimum dont : 1 lettre minuscule, 1 lettre majuscule, 1 chiffre, 1 caractère spécial !</p>
                </div>
            </div><br/>
            <div class="titre pad">
                <label for="confirmPw">Confirmation du mot de passe :</label>
                <input class="form-input" type="password" id="confirmPw" name="confirmPw" placeholder="Confirmer Mot de passe" required>
                <div class="feedback" id="feedConfPw">
                    <p>! La confirmation doit être identique au mot de passe !</p>
                </div>
            </div>
            <input class="lien" type="submit" value="Changer mot de passe" id="btn-changeMp" name="submit"> 
        </form>
        <div class="info">
            <a href="/modifier-user" class="lien3">Cliquer ici pour "Modifier mes informations personnelles".</a>
        </div>
    </div> 
</section>
<!--END : Modifier mot de passe-->


<?php

// Traitement du formulaire

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
    if(isset($_POST['email'], $_POST['mdp'], $_POST['confirmPw'])
        && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['confirmPw'])
    ){
        // Le formulaire est complet
        // Assignation et récupération des données en les protégeant
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
        if($stmt->rowCount() == 1){
            $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        else{
            "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
        }

        //vérification que les 2 mots de passe sont identique
        if($_POST['mdp'] === $_POST['confirmPw']) {
            
            // Hashage(encryptage) du mot de passe
            $mdpForm = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $confirmPwForm = password_hash($_POST['confirmPw'], PASSWORD_BCRYPT);
        }

        // Modification du mot de passe de la base de données par le nouveau
        $query = "UPDATE users SET password = $mdpForm WHERE email = $mdpForm";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $emailForm);
        $stmt->execute();

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