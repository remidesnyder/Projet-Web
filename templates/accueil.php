<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location: ../index.php?view=accueil");
	die("");
}

include_once "libs/modele.php";

$movietrendData = getPopularMovies();
$watchData = getAllMoviesSeen($_SESSION['userID']);
$toWatchData = getAllMoviesToSee($_SESSION['userID']);

?>


<!-- Movie Trend Section Start -->
<section class="movietrend container" id="movietrend">
	<!-- Heading -->
	<div class="heading">
		<a href="/all/moviesWanted" class="movie-a">
			<h2 class="heading-title">
				Film populaire (<?= count($movietrendData); ?>)
			</h2>
		</a>

		<!-- Swiper Buttons -->
		<div class="swiper-btn">
			<div class="swiper-button-prev" id="movietrend-prev"></div>
			<div class="swiper-button-next" id="movietrend-next"></div>
		</div>
	</div>

	<!-- Content -->
	<div class="movietrend-content swiper">
		<div class="swiper-wrapper">
			<!-- Movies Box -->
			<?php foreach ($movietrendData as $data) : ?>
			<div class="swiper-slide">
				<div class="movie-box">
					<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
					<div class="box-text">
						<h2 class="movie-title">
							<a class="movie-a" href="/movie/<?= $data['id'] ?>"><?= $data['title'] ?></a>
						</h2>
						<span class="movie-type">NaN</span>
						<a href="#" class="watch-btn play-btn">
							<i class="bx bx-right-arrow"></i>
						</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- Movie Trend Section End -->

<!-- Movie Watch Section Start -->
<section class="watch container" id="watch">
	<!-- Heading -->
	<div class="heading">
		<a href="/all/moviesWatch" class="movie-a">
			<h2 class="heading-title">
				Film vus (<?= count($watchData); ?>)
			</h2>
		</a>

		<!-- Swiper Buttons -->
		<div class="swiper-btn">
			<div class="swiper-button-prev" id="watch-prev"></div>
			<div class="swiper-button-next" id="watch-next"></div>
		</div>
	</div>

	<!-- Content -->
	<div class="watch-content swiper">
		<div class="swiper-wrapper">
			<!-- Movies Box -->
			<?php foreach ($watchData as $data) : ?>
			<div class="swiper-slide">
				<div class="movie-box">
					<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
					<div class="box-text">
						<h2 class="movie-title">
							<a class="movie-a" href="/movie/<?= $data['movieID'] ?>"><?= $data['title'] ?></a>
						</h2>
						<span class="movie-type">NaN</span>
						<a href="#" class="watch-btn play-btn">
							<i class="bx bx-right-arrow"></i>
						</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- Movie Watch Section End -->

<!-- Movie ToWatch Section Start -->
<section class="towatch container" id="towatch">
	<!-- Heading -->
	<div class="heading">
		<a href="/all/moviesWanted" class="movie-a">
			<h2 class="heading-title">
				Film à voir (<?= count($toWatchData); ?>)
			</h2>
		</a>

		<!-- Swiper Buttons -->
		<div class="swiper-btn">
			<div class="swiper-button-prev" id="towatch-prev"></div>
			<div class="swiper-button-next" id="towatch-next"></div>
		</div>
	</div>

	<!-- Content -->
	<div class="towatch-content swiper">
		<div class="swiper-wrapper">
			<!-- Movies Box -->
			<?php foreach ($toWatchData as $data) : ?>
			<div class="swiper-slide">
				<div class="movie-box">
					<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
					<div class="box-text">
						<h2 class="movie-title">
							<a class="movie-a" href="/movie/<?= $data['movieID'] ?>"><?= $data['title'] ?></a>
						</h2>
						<span class="movie-type">NaN</span>
						<a href="#" class="watch-btn play-btn">
							<i class="bx bx-right-arrow"></i>
						</a>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>
<!-- Movie ToWatch Section End -->


</div>