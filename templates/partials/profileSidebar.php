<section>
<div class="profile-container">
    <h1 class="param">Paramètres du compte</h1>
        <aside class="mc-sidebar">
            <ul>
                <li class="elemCompte"><a href="?view=updateProfil" class="<?= $namePage == "updateProfil" ? "active" : "" ?>">Modifier mon profil</a></li>
                <li class="elemCompte"><a href="?view=monCompte" class="<?= $namePage == "monCompte" ? "active" : "" ?>">Mon compte</a></li>
                <li class="elemCompte"><a href="?view=notifications" class="<?= $namePage == "notifications" ? "active" : "" ?>">Notifications</a></li>
                <li class="elemCompte"><a href="?view=mesMessages" class="<?= $namePage == "mesMessages" ? "active" : "" ?>">Mes messages</a></li>
                <li class="elemCompte"><a href="controleur.php?action=Logout" class="btn-orange">Se déconnecter</a></li>
                <li class="elemCompte"><a href="" class="btn-red">Supprimer mon compte</a></li>
            </ul>
        </aside>
    </div>
</section>