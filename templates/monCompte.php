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

$tempsEnMinutes = getMovieTime($_SESSION['userID']);

// Conversion en secondes
$tempsEnSecondes = $tempsEnMinutes * 60;

// Conversion en date
$date = new DateTime("@$tempsEnSecondes");
$annees = $date->format('Y') - 1970; // Récupère le nombre d'années
$mois = $date->format('n') - 1; // Récupère le nombre de mois
$jours = $date->format('j') - 1; // Récupère le nombre de jours
$heures = $date->format('G'); // Récupère le nombre d'heures
$minutes = $date->format('i'); // Récupère le nombre de minutes
$secondes = $date->format('s'); // Récupère le nombre de secondes

$timeRuntime = "";

if ($annees > 0) {
    $timeRuntime .= $annees . " ans ";
}
if ($mois > 0) {
    $timeRuntime .= $mois . " mois ";
}
if ($jours > 0) {
    $timeRuntime .= $jours . " jours ";
}
if ($heures > 0) {
    $timeRuntime .= $heures . " heures ";
}
if ($minutes > 0) {
    $timeRuntime .= $minutes . " minutes ";
}
if ($secondes > 0) {
    $timeRuntime .= $secondes . " secondes ";
}

$preferedActors = getListOfPreferedActors($_SESSION['userID']);
$preferedActorsWithInfo = array();
foreach ($preferedActors as $actor) {
    $actorInfo = getActorByID($actor['actorID']);
    $actorNbVotes = $actor['nbVotes'];
    array_push($preferedActorsWithInfo, array($actorInfo, $actorNbVotes));
}

// die(var_dump($preferedActorsWithInfo));

?>

<section></section>

<?php
include_once "partials/profileSidebar.php";
?>

<section class="profile">
<h1 class="monCompte">Mon compte</h1>
    <div class="profile-container">
        <main class="mc-content">
        <div>
            <h1 class="temps">Temps de visionnage total : </h1>
            <h2><?= $timeRuntime ?></h2>
        </div>
        <div>
            <h1 class="stats">Statistiques</h1>
            <p><?= $nbComments ?> commentaires</p>
            <p><?= $nbReactions ?> réactions</p>
            <p><?= $nbMovieSeen ?> films vus</p>
            <p><?= $nbMovieToSee ?> films à voir</p>
            <br />
        </div>
        <div class="genres_favoris">
            <h1 class="genres">Genres favoris</h1>
            <br />
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>
    </div>
</section>

            <!-- Actor Section Start -->
            <section class="actorPref container" id="actorPref">
	<!-- Heading -->
	<div class="heading">
		<a href="" class="movie-a">
			<h2 class="heading-title">
                Acteurs préférés
			</h2>
		</a>

		<!-- Swiper Buttons -->
		<div class="swiper-btn">
			<div class="swiper-button-prev" id="actorPref-prev"></div>
			<div class="swiper-button-next" id="actorPref-next"></div>
		</div>
	</div>

	<!-- Content -->
	<div class="actorPref-content swiper">
		<div class="swiper-wrapper">
			<!-- Movies Box -->
			<?php foreach ($preferedActorsWithInfo as $data) : ?>
				<div class="swiper-slide">
					<div class="movie-box">
						<?php if ($data[0]['profile_path']) : ?>
							<img src="https://image.tmdb.org/t/p/original<?= $data[0]['profile_path'] ?>" alt="Affiche du film <?= $data[0]['name'] ?>" class="movie-box-img" />
						<?php else : ?>
							<img src="public/img/visuel-default.png" alt="Affiche du film <?= $data[0]['name'] ?>" class="movie-box-img">
						<?php endif ?>
						<div class="box-text">
							<h2 class="movie-title">
								<a class="movie-a" href="index.php?view=actor&actorID=<?= $data[0]['id'] ?>"><?= $data[0]['name'] ?></a>
							</h2>
							<span class="movie-type"><?= $data[1] ?></span>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- Actor Section End -->

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