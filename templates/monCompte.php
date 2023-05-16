<?php 
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=profil");
    die("");
}

?>

<section></section>

<section>
    <div class="mc-sidebar">
        <h1>Paramètres</h1>
        <ul>
            <li>Modifier mon profil</li>
            <li>Mon compte</li>
            <li>Notifications</li>
            <li>Utilisateurs bloqués</li>
            <li>Mes messages</li>
            <li>Supprimer mon compte</li>
        </ul>
    </div>
    <div class="mc-main">
        <div class="total_temps">
            <h1>Total temps passé</h1>
        </div>
        <div class="stats">
            <p>0 commentaires</p>
            <p>0 réactions</p>
            <p>0 film vu</p>
            <p>0 film à voir</p>
        </div>
        <div class="genres_favoris"></div>
        <div class="acteurs_pref">
            <!-- SLIDER ici -->
        </div>
    </div>
</section>