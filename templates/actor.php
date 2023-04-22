<?php

require_once 'libs/modele.php';

$actorID = valider('actorID', 'GET', 'int', 0);

if ($actorID == 0) {
    header('Location: /');
    exit;
}

$actor = getActorByID($actorID);
$actorMovies = getActorMovies($actorID);

$biographyLimite = 350; // Nombre de caractères maximum pour la biographie

?>

<section>
    <img src="https://image.tmdb.org/t/p/original<?= $actor['profile_path'] ?>" class="actor-profile">
    <div class="about-actor container">
        <div class="about-actor-content">
            <h2 class="title"><?= $actor['name'] ?></h2>
            <div class="about-actor content">
                <p>
                    <?php if (strlen($actor['biography']) > $biographyLimite) {
                        $biography = substr($actor['biography'], 0, $biographyLimite) . "...";
                        echo $biography;
                    } ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php if (count($actorMovies) > 0) : ?>

    <!-- Section Movies Starts -->
    <section class="movies container" id="actorMovies">
        <!-- Heading -->
        <div class="heading">
            <a href="" class="movie-a">
                <h2 class="heading-title">
                    Filmographie (<?= count($actorMovies); ?>)
                </h2>
            </a>

            <!-- Swiper Buttons -->
            <div class="swiper-btn">
                <div class="swiper-button-prev" id="actorMovies-prev"></div>
                <div class="swiper-button-next" id="actorMovies-next"></div>
            </div>
        </div>

        <!-- Content -->
        <div class="actorMovies-content swiper">
            <div class="swiper-wrapper">
                <!-- Movies Box -->
                <?php foreach ($actorMovies as $data) : ?>
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
    <!-- Section Movies End -->

<?php endif; ?>