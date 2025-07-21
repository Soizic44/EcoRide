<!--START : hero-->
<section class="pad margeTop">
    <h1 class="h1Mail">Réponse mail</h1>
    <h2 class="padBas h2Form">Le covoiturage pour tous</h2>
</section>
<!--END : hero-->

<!--START : Contact-->
<section class="bgcolor2">
    <h2 class="titre_h2 pad">Réponse formulaire de contact envoyé par mail</h2>
</section>
<!--END : Contact-->

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Déclaration des variables
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $objet = htmlspecialchars($_POST["objet"]);
    $message = htmlspecialchars($_POST["message"]);
    $msg = ["msg"];
    $_POST["envoyer"];

    //Vérification des entrés issues du formulaire
    //Vérification que les différents champs sont correctement rempli 
    
    if (empty($nom) || empty($prenom) || empty($email) || empty($objet) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
        $success = false;
        exit;

        //Vérification que l'adresse email est correcte
    } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        echo "L'adresse mail entrée est incorrecte !";
        $success = false;
        exit;

    } else {
        $success = true;

        //formatage du message envoyé par mail
        $destinataire = "fetiveau.soizic1@hotmail.fr";
        $from = $email . "\r\n" . "Reply-to:" . $email;
        $sujet = 'Nouveau message';

        $headers = "Content-type: text/html; charset=UTF-8\r\n";
        $headers = "Reply-to: . $email";

        $message = "
            Un nouveau message en provenance du site web, EcoRide, est arrivé.
                
            Nom : $nom
            Prénom : $prenom
            Email: $email

                Objet : $objet

            Message: $message
        ";
        //envoi des données saisies par mail
        if (mail($destinataire, $sujet, $message, $headers)) {
            echo "<p class='msgMail success'>Votre message a été envoyé avec succès.</p>";
        }else{
            echo "<p class='msgMail error'>! Erreur : votre message n'a pas pu être envoyé !</p>";
        }  
    }
}
?>