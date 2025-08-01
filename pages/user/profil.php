<!--START : hero-->
<section class="hero_accueil hero">
    <h1>Compte utilisateur de <?= $_SESSION["users"]["pseudo"] ?></h1>
</section>
<!--END : hero-->

<!--START : Modifier voyage-->
<form class="formulaire bgcolor">
    <div class="containForm padding card">
        <h2>12/03/2025</h2>
        <table class="tableau">
            <thead>
                <tr>
                    <th>Durée</th>
                    <th>Prix €</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1:20</td>
                    <td>10</td>
                </tr>
            </tbody>
        </table>
        <div class="depart">
            <a href="#"></a>
                <img class="icone-search" src="/assets/mapred.png" alt="map-depart"/>
                <span>Nantes</span> |
                <span>8:10</span>  
            </a>
        </div>
        <div class="arrivée">
            <a href="#">
                <img class="icone-search" src="/assets/mapvert.png" alt="map-arrivee"/>
                <span>Vannes</span> |
                <span>9:30</span>  
            </a>
        </div><br>
        <table>
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Immatriculation</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Citroën</td>
                    <td>C5</td>
                    <td>BG-825-YY</td>
                </tr>
            </tbody>
        </table>
        <input class="bgcolor2 lien" type="submit" value="Modifier">
    </div>
</section>
<!--END : Modifier voyage-->
