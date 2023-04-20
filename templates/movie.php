<?php

require_once 'libs/modele.php';

$movieID = valider('movieID', 'GET', 'int', 0);

if ($movieID == 0) {
    header('Location: /');
    exit;
}

$multipleSeen = getHowManyTimeUserHasSeenMovie($_SESSION['userID'], $movieID) ? getHowManyTimeUserHasSeenMovie($_SESSION['userID'], $movieID) : 0;


$data = getMovieInfo($movieID, $API_KEY);
$movie = $data['movie'];
$actors = $data['cast']['cast'];

//$actors = getActorsByMovie($movieID);
//$movie = getMovieFromAPI($movieID);

$comments = getCommentsByMovie($movieID);

?>

<section class="moviecontent">
<img src="https://image.tmdb.org/t/p/original<?= $movie['backdrop_path'] ?>" class="movie-backdrop">
</section>

<section class="">
    <div class="about-movie container">
        <div class="about-movie-content">
            <h2 class="title"><?= $movie['title'] ?></h2>
            <div class="tags">
                <?php foreach ($movie['genres'] as $genre) : ?>
                    <span><?= $genre['name'] ?></span>
                <?php endforeach; ?>
            </div>
            <div class="about-movie content">
                <p><?= $movie['overview'] ?></p>
            </div>
        </div>

        <button class="round-button addMultipleMovie">
            <span>x<?= $multipleSeen ?></span>
        </button>
    </div>
</section>

<!-- Section Cast, rating & comments Starts -->
<section class="movie-container container">
    <div class="left-container">
        <div class="comment-section">
            <div class="comment-header">
                <div class="comment-form">
                    <form action="controleur.php?action=AddComment" method="post">
                        <input type="hidden" name="movieID" value="<?= $movieID ?>">
                        <textarea name="content" id="comment-content" placeholder="Ajouter un commentaire"></textarea>
                        <button type="submit">Commenter</button>
                    </form>
                </div>
            </div>
            <div class="comments">
                <?php foreach ($comments as $comment) : ?>
                    <?php $reply = getRepliesByComment($comment['id']); ?>
                    <div class="comment">
                        <div class="comment1">
                            <div class="comment-author">
                                <img src="public/img/<?= $comment['profil_picture'] ?>" alt="Profil">
                                <div class="author-info">
                                    <h4><?= $comment['username'] ?></h4>
                                    <?php
                                    $date = new DateTime($comment['created_at']);
                                    $current_time = new DateTime();
                                    $time_diff = abs($current_time->getTimestamp() - $date->getTimestamp());

                                    $formatted_date = "Ecrit le " . $date->format("d/m/Y");
                                    if ($time_diff < 60) {
                                        $formatted_date .= " (Il y a " . $time_diff . " seconde(s))";
                                    } else if ($time_diff < 3600) {
                                        $time_diff = round($time_diff / 60);
                                        $formatted_date .= " (Il y a " . $time_diff . " minute(s))";
                                    } else if ($time_diff < 86400) {
                                        $time_diff = round($time_diff / 3600);
                                        $formatted_date .= " (Il y a " . $time_diff . " heure(s))";
                                    } else if ($time_diff < 604800) {
                                        $time_diff = round($time_diff / 86400);
                                        $formatted_date .= " (Il y a " . $time_diff . " jour(s))";
                                    } else if ($time_diff < 2592000) {
                                        $time_diff = round($time_diff / 604800);
                                        $formatted_date .= " (Il y a " . $time_diff . " semaine(s))";
                                    } else if ($time_diff < 31536000) {
                                        $time_diff = round($time_diff / 2592000);
                                        $formatted_date .= " (Il y a " . $time_diff . " mois)";
                                    } else {
                                        $time_diff = round($time_diff / 31536000);
                                        $formatted_date .= " (Il y a " . $time_diff . " an(s))";
                                    }

                                    ?>
                                    <span><?= $formatted_date ?></span>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p><?= $comment['content'] ?></p>
                                <div class="comment-actions">
                                    <span><?= count($reply) ?> <?= count($reply) > 1 ? 'Réponses' : 'Réponse' ?></span>
                                    <span><?= $comment['reactions'] ?> <?= $comment['reactions'] > 1 ? 'Likes' : 'Like' ?></span>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($reply as $rep) : ?>
                            <div class="comment-reply">
                                <div class="comment-author">
                                    <img src="public/img/<?= $rep['profil_picture'] ?>" alt="Profil">
                                    <div class="author-info">
                                        <h4><?= $rep['username'] ?></h4>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p><?= $rep['content'] ?></p>
                                    <div class="comment-actions">
                                        <span><?= $rep['reactions'] ?> <?= $rep['reactions'] > 1 ? 'Likes' : 'Like' ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="reply-container">
                            <div class="profile-pic">
                                <img src="public/img/default.jpg" alt="Profile picture">
                            </div>
                            <div class="comment-form">
                                <form action="controleur.php?action=AddReply" method="post">
                                    <input type="hidden" name="movieID" value="<?= $movieID ?>">
                                    <input type="hidden" name="commentID" value="<?= $comment['id'] ?>">
                                    <input type="text" id="input-reply" name="reply" placeholder="Entrez une réponse ici">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="right-container">
        <div class="actors-container">
            <!-- Heading -->
            <div class="heading">
                <h2 class="heading-title">Acteurs du film</h2>
                <!-- Swiper Buttons -->
                <div class="swiper-btn">
                    <div class="swiper-button-prev" id="casting-prev"></div>
                    <div class="swiper-button-next" id="casting-next"></div>
                </div>
            </div>
            <!-- Content -->
            <div class="casting-content swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($actors as $actor) : ?>
                        <!-- Movies Box -->
                        <div class="swiper-slide swiper-actor">
                            <div class="movie-box-right">
                                <img src="https://image.tmdb.org/t/p/original<?= $actor['profile_path'] ?>" alt="Image de <?= $actor['name'] ?>" class="movie-box-img-right">
                                <div class="box-text-right">
                                    <h2 class="movie-title">
                                        <a class="cast-name" href="?view=actor&actorID=<?= $actor['id'] ?>"><?= $actor['name'] ?></a>
                                    </h2>
                                    <span class="movie-type"><?= $actor['character'] ?></span>
                                    <span class="actor-nbvote votes-count">0 vote</span>
                                    <a class="watch-btn play-btn">
                                        <i class='bx bxs-upvote'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section Cast, rating & comments End -->