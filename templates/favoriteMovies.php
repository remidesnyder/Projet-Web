<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}

$favoriteMovie = null !== getUserFavoriteMovie($_SESSION['userID']) ? getUserFavoriteMovie($_SESSION['userID']) : [];

?>

<section></section>

<!-- Movie Trend Section Start -->
<section class="favoritemovie container" id="favoritemovie">
	<!-- Heading -->
	<div class="heading">
		<a href="" class="movie-a">
			<h2 class="heading-title">
				Films favoris (<?= count($favoriteMovie) ?>)
			</h2>
		</a>

		<!-- Swiper Buttons -->
		<div class="swiper-btn">
			<div class="swiper-button-prev" id="favoritemovie-prev"></div>
			<div class="swiper-button-next" id="favoritemovie-next"></div>
		</div>
	</div>

	<!-- Content -->
	<div class="favoritemovie-content swiper">
		<div class="swiper-wrapper">
			<!-- Movies Box -->
			<?php foreach ($favoriteMovie as $data) : ?>
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
<!-- Movie Trend Section End -->