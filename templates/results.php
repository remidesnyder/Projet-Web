<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}

require_once "libs/modele.php";

$search = valider("search", "POST");

if (!$search) {
    header('Location: /');
    exit;
}

$moviesData = searchMovies($search);

?>

<section></section>

<section class="results container">
    <div class="results-content">
        <div class="image-container">
            <?php foreach ($moviesData['results'] as $data) : ?>
                <?php 
					$movieDate = date("Y", strtotime($data['release_date']));
				?>
                <div class="movie-box-result">
                    <?php if ($data['poster_path']) : ?>
                        <img src="https://image.tmdb.org/t/p/original/<?= $data['poster_path'] ?>" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img">
                    <?php else : ?>
                        <img src="public/img/visuel-default.png" alt="Affiche du film <?= $data['title'] ?>" class="movie-box-img">
                    <?php endif ?>
                    <div class="box-text">
                        <h2 class="movie-title">
                            <a class="movie-a" href="index.php?view=movie&movieID=<?= $data['id'] ?>"><?= $data['title'] ?> (<?= $movieDate ?>)</a>
                        </h2>
                        <?php if (isset($_SESSION['userID'])) : ?>
                            <div class="btnResultAdd">
                                <?php if (isTheMovieInWatchedList($_SESSION['userID'], $data['id'])) : ?>
                                    <form action="controleur.php?action=RemoveMovieFromWatchList" method="POST">
                                        <input type="hidden" name="movieID" value="<?= $data['id'] ?>">
                                        <input type="hidden" name="request" value="<?= $search ?>">
                                        <button class="btn btn-red">Retirer vu</button>
                                    </form>
                                <?php else : ?>
                                    <form action="controleur.php?action=AddMovieInWatchList" method="POST">
                                        <input type="hidden" name="movieID" value="<?= $data['id'] ?>">
                                        <input type="hidden" name="request" value="<?= $search ?>">
                                        <button class="btn btn-green">Ajouter vu</button>
                                    </form>
                                <?php endif ?>
                                <?php if (isTheMovieInToWatchList($_SESSION['userID'], $data['id'])) : ?>
                                    <form action="controleur.php?action=RemoveMovieFromToWatchList" method="POST">
                                        <input type="hidden" name="movieID" value="<?= $data['id'] ?>">
                                        <input type="hidden" name="request" value="<?= $search ?>">
                                        <button class="btn btn-red">Retirer à voir</button>
                                    </form>
                                <?php elseif (!isTheMovieInWatchedList($_SESSION['userID'], $data['id'])) : ?>
                                    <form action="controleur.php?action=AddMovieInToWatchList" method="POST">
                                        <input type="hidden" name="movieID" value="<?= $data['id'] ?>">
                                        <input type="hidden" name="request" value="<?= $search ?>">
                                        <button class="btn btn-orange">Ajouter à voir</button>
                                    </form>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                    </div>

                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>