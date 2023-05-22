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

$movietrendData = null !== getPopularMovies() ? getPopularMovies() : [];

if (isset($_SESSION['userID'])) {
	$watchData = getAllMoviesSeen($_SESSION['userID']);
	$toWatchData = getAllMoviesToSee($_SESSION['userID']);
}

?>

<section class="home-content"></section>

<!-- Movie Trend Section Start -->
<section class="movietrend container" id="movietrend">
	<!-- Heading -->
	<div class="heading">
		<a href="" class="movie-a">
			<h2 class="heading-title">
				Films populaires
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
				<?php 
					$movieDate = date("Y", strtotime($data['release_date']));
				?>
				<div class="swiper-slide">
					<div class="movie-box">
						<?php if ($data['poster_path']) : ?>
							<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
						<?php else : ?>
							<img src="public/img/visuel-default.png" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img">
						<?php endif ?>
						<div class="box-text">
							<h2 class="movie-title">
								<a class="movie-a" href="index.php?view=movie&movieID=<?= $data['id'] ?>"><?= $data['title'] ?></a>
							</h2>
							<span class="movie-type"><?= $movieDate ?></span>
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

<?php if (isset($_SESSION['userID'])) : ?>

	<?php if (count($watchData) > 0) : ?>

		<!-- Movie Watch Section Start -->
		<section class="watch container" id="watch">
			<!-- Heading -->
			<div class="heading">
				<a href="" class="movie-a">
					<h2 class="heading-title">
						Films vus (<?= count($watchData); ?>)
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
						<?php 
							$movieDate = date("Y", strtotime($data['release_date']));
						?>
						<div class="swiper-slide">
							<div class="movie-box">
								<?php if ($data['poster_path']) : ?>
									<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
								<?php else : ?>
									<img src="public/img/visuel-default.png" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img">
								<?php endif ?>
								<div class="box-text">
									<h2 class="movie-title">
										<a class="movie-a" href="index.php?view=movie&movieID=<?= $data['movieID'] ?>"><?= $data['title'] ?></a>
									</h2>
									<span class="movie-type"><?= $movieDate ?></span>
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

	<?php endif ?>

	<?php if (count($toWatchData) > 0) : ?>

		<!-- Movie ToWatch Section Start -->
		<section class="towatch container" id="towatch">
			<!-- Heading -->
			<div class="heading">
				<a href="" class="movie-a">
					<h2 class="heading-title">
						Films à voir (<?= count($toWatchData); ?>)
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
						<?php 
							$movieDate = date("Y", strtotime($data['release_date']));
						?>
						<div class="swiper-slide">
							<div class="movie-box">
								<?php if ($data['poster_path']) : ?>
									<img src="https://image.tmdb.org/t/p/original<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img" />
								<?php else : ?>
									<img src="public/img/visuel-default.png" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img">
								<?php endif ?>
								<div class="box-text">
									<h2 class="movie-title">
										<a class="movie-a" href="index.php?view=movie&movieID=<?= $data['movieID'] ?>"><?= $data['title'] ?></a>
									</h2>
									<span class="movie-type"><?= $movieDate ?></span>
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

	<?php endif ?>

<?php endif ?>

</div>