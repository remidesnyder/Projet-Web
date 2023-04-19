<?php

require_once 'libs/modele.php';

$movieID = valider('movieID', 'GET', 'int', 0);

if ($movieID == 0) {
    header('Location: /');
    exit;
}

$actors = getActorsByMovie($movieID);
$movie = getMovieFromAPI($movieID);

?>

<section>
    <img src="https://image.tmdb.org/t/p/original<?= $movie['backdrop_path'] ?>" class="movie-backdrop">
    <div class="about-movie container">
        <h2 class="title"><?= $movie['title'] ?></h2>
        <div class="tags">
            <?php foreach ($movie['genres'] as $genre) : ?>
                <span><?= $genre['name'] ?></span>
            <?php endforeach; ?>
        </div>
        <div class="about-movie content">
            <p><?= $movie['overview'] ?></p>
        </div>
        <button class="round-button addMultipleMovie">
            <span>x1</span>
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
                <div class="comment">
                    <div class="comment1">
                        <div class="comment-author">
                            <img src="public/img/default.jpg" alt="Profil">
                            <div class="author-info">
                                <h4>John Doe</h4>
                                <span>Ecrit le 19/04/2023 (Il y a 2 secondes)</span>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam dolorum tempore nesciunt voluptate consequatur animi non provident sit eligendi labore, doloribus consequuntur amet ducimus corporis maxime dolorem? Fugiat, vel saepe.</p>
                            <div class="comment-actions">
                                <span>1 Réponse</span>
                                <span>0 Like</span>
                            </div>
                        </div>
                    </div>
                    <div class="comment-reply">
                        <div class="comment-author">
                            <img src="public/img/default.jpg" alt="Profil">
                            <div class="author-info">
                                <h4>John Doe</h4>
                            </div>
                        </div>
                        <div class="comment-content">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Commodi exercitationem sed quasi laborum animi sapiente dolorum magnam architecto voluptas earum fugiat aspernatur fuga, consequuntur quisquam debitis doloribus aut corrupti. Laboriosam.</p>
                            <div class="comment-actions">
                                <span>0 Like</span>
                            </div>
                        </div>
                    </div>
                    <div class="reply-container">
                        <div class="profile-pic">
                            <img src="public/img/default.jpg" alt="Profile picture">
                        </div>
                        <div class="comment-form">
                            <form>
                                <input type="text" id="input-reply" name="reply" placeholder="Entrez une réponse ici">
                            </form>
                        </div>
                    </div>
                </div>
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
                    <?php foreach($actors as $actor) : ?>
                    <!-- Movies Box -->
                    <div class="swiper-slide swiper-actor">
                        <div class="movie-box-right">
                            <img src="https://image.tmdb.org/t/p/original<?= $actor['profile_path'] ?>" alt="Image de <?= $actor['name'] ?>" class="movie-box-img-right">
                            <div class="box-text-right">
                                <h2 class="movie-title">
                                    <a class="cast-name" href="/person/<?= $actor['id'] ?>"><?= $actor['name'] ?></a>
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