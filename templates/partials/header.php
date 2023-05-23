<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}

include_once 'libs/modele.php';

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MovieList</title>
    <link rel="icon" type="image/png" href="public/img/favicon.png" />
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".notification-drop").on('click', function() {
                $(this).find('ul').toggle();
            });
        });
    </script>
    <script src="public/js/header.js"></script>

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->

<body onload="init();">
    <?php 
        $namePage = valider("view", 'GET');
    ?>
    <nav class="navbar" onmouseover="popin(event);" onmouseout="popout();">
        <ul>
            <li>
                <a href="/templates/accueil.php"><h1 class="title" id="home">MovieList</a></h1>
            </li>
            <li class="icons">
                <a href="?view=accueil">
                    <div class="home <?= $namePage == "accueil" ? "active" : "" ?>"><i class='bx bxs-home' id="home"></i></div>
                </a>
            </li>
            <li class="icons">
                <a href="?view=popularMovies&page=1">
                    <div class="popular <?= $namePage == "popularMovies" ? "active" : "" ?>"><i class='bx bxs-hot' id="pop"></i></div>
                </a>
            </li>
            <?php if (isset($_SESSION['userID'])) : ?>
                <li class="icons">
                    <a href="?view=favoriteMovies">
                        <div class="favoriteMovies <?= $namePage == "favoriteMovies" ? "active" : "" ?>"><i class='bx bxs-heart' id="fav"></i></div>
                    </a>
                </li>
            <?php endif ?>
            <li>
                <div class="search">
                    <form class="nosubmit" action="index.php?view=results" method="POST">
                        <input class="nosubmit" type="text" placeholder="Tapez ici pour rechercher" name="search">
                    </form>
                </div>
            </li>
            <?php if (isset($_SESSION['userID'])) : ?>
                <li>
                    <div class="calendar notification-drop">
                        <i class='bx bxs-bell'></i>
                        <?php if (getAllNotifications($_SESSION['userID'])) : ?>
                            <?php if (getUnreadNotifications($_SESSION['userID'])) : ?>
                                <div class="badge red"></div>
                            <?php endif ?>
                        <div class="notification-content">
                            <?php if (getUnreadNotifications($_SESSION['userID'])) : ?>
                                <ul>
                                    <h1 class="notifs">Notifications</h1>
                                    <?php foreach (getUnreadNotifications($_SESSION['userID']) as $notification) : ?>
                                        <li>
                                            <a href="controleur.php?action=Notifications&notificationID=<?= $notification['id'] ?>">
                                                <?= $notification['content'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                    <?php foreach (getReadNotifications($_SESSION['userID']) as $notification) : ?>
                                        <li>
                                            <a href="controleur.php?action=Notifications&notificationID=<?= $notification['id'] ?>">
                                                <?= $notification['content'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else : ?>
                                <ul>
                                    <h1 class="notifs">Notifications</h1>
                            
                                    <?php foreach (getAllNotifications($_SESSION['userID']) as $notification) : ?>
                                        <li>
                                            <a href="controleur.php?action=Notifications&notificationID=<?= $notification['id'] ?>">
                                                <?= $notification['content'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="profile-info-name">
                    <img src="public/img/<?= getProfilPath($_SESSION['userID']) ? "profil/" . getProfilPath($_SESSION['userID']) : "default.jpg" ?>" alt="" class="profile-image">
                    <a href="index.php?view=monCompte">
                        <div class="profile-name"><?= $_SESSION['username'] ?></div>
                    </a>
                    <i class='bx bx-chevron-down'></i>
                </li>
            <?php else : ?>
                <li class="profile-info-name">
                    <a href="index.php?view=login">Connexion</a>
                </li>
                <li class="profile-info-name">
                    <a href="index.php?view=signup">Inscription</a>
                </li>
            <?php endif ?>
            <div class="popup" id="popup"></div>
        </ul>
    </nav>