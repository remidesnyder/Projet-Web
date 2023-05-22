<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}

require_once "libs/modele.php";

// On détermine sur quelle page on se trouve
$page = valider('page', 'GET');
if($page){
    $currentPage = (int) strip_tags($page);
}else{
    $currentPage = 1;
}

$nbPages = getNbPagePopularMovie();

$popularMovies = getPopularMovies($page);

?>

<section></section>

<section class="results container">
    <div class="results-content">
        <br />
        <h1 class="filmpop">Films tendances</h1>
        <br />
        <div class="image-container">
            <?php foreach ($popularMovies as $data) : ?>
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
    <nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="?view=popularMovies&page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = $page; $page <= $currentPage + 5; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="?view=popularMovies&page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $nbPages) ? "disabled" : "" ?>">
            <a href="?view=popularMovies&page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>
</section>