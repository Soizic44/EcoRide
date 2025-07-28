<!--START : hero-->
<section class="hero_accueil hero">
    <h1>Compte utilisateur de <?= $_SESSION["users"]["pseudo"] ?></h1>
</section>
<!--END : hero-->

<p>Pseudo : <?= $_SESSION["users"]["pseudo"] ?><p>
<p>Email : <?= $_SESSION["users"]["email"] ?><p>

<?php

?>