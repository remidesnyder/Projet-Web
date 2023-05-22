<?php 
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=profil");
    die("");
}

$favorite_genres = getFavoriteGenresWithCount($_SESSION['userID']);
$genresJson = json_encode($favorite_genres);

$nbComments = getNumberOfComment($_SESSION['userID']);
$nbReactions = getNumberOfReactionsFromCommentsAndReplies($_SESSION['userID']);
$nbMovieSeen = getNumberOfSeenMovie($_SESSION['userID']);
$nbMovieToSee = getNumberOfToSeeMovie($_SESSION['userID']);

$namePage = valider("view", 'GET');

?>

<section></section>
<br />
<br />
<h1 class="monCompte">Mon compte</h1>
<section class="profile">
    <div class="profile-container mc-sidebar">
        <h1 class="param">Paramètres du compte</h1>
        <aside>
            <ul>
                <li class="elemCompte"><a href="?view=updateProfil" class="<?= $namePage == "updateProfil" ? "active" : "" ?>">Modifier mon profil</a></li>
                <li class="elemCompte"><a href="?view=monCompte" class="<?= $namePage == "monCompte" ? "active" : "" ?>">Mon compte</a></li>
                <li class="elemCompte"><a href="?view=notifications" class="<?= $namePage == "notifications" ? "active" : "" ?>">Notifications</a></li>
                <li class="elemCompte"><a href="?view=blockedUsers" class="<?= $namePage == "blockedUsers" ? "active" : "" ?>">Utilisateurs bloqués</a></li>
                <li class="elemCompte"><a href="?view=mesMessages" class="<?= $namePage == "mesMessages" ? "active" : "" ?>">Mes messages</a></li>
                <li class="elemCompte"><a href="controleur.php?action=Logout" class="btn-orange">Se déconnecter</a></li>
                <li class="elemCompte"><a href="" class="btn-red">Supprimer mon compte</a></li>
            </ul>
        </aside>
        <main>
        <br />
        <div class="total_temps">
            <h1 class="temps">Temps de visionnage total : </h1>
            <br />
        </div>
        <div class="stats">
            <br />
            <h1 class="stats">Statistiques</h1>
            <p><?= $nbComments ?> commentaires</p>
            <p><?= $nbReactions ?> réactions</p>
            <p><?= $nbMovieSeen ?> films vus</p>
            <p><?= $nbMovieToSee ?> films à voir</p>
        </div>
        <div class="genres_favoris">
            <h1>Genres favoris</h1>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="acteurs_pref">
            <!-- SLIDER ici -->
        </div>
    </main>
    </div>
</section>

<script>
    // Récupération des données JSON créées en PHP
    var genresData = <?php echo $genresJson; ?>;

    // Récupération des clés et des valeurs du tableau associatif
    var genresLabels = Object.keys(genresData);
    var genresValues = Object.values(genresData);

    // Création du graphique avec Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: genresLabels,
            datasets: [{
                label: 'Genres favoris',
                data: genresValues,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(25, 120, 92)'
                ]
            }]
        },
        options: {}
    });
</script>