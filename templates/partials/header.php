<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Projet Web</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/swiper-bundle.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->

<body>
    <nav class="navbar">
        <ul>
            <li class="icons">
                <a href="/">
                    <div class="home"><i class='bx bxs-home'></i></div>
                </a>
            </li>
            <li class="icons">
                <a href="">
                    <div class="calendar"><i class='bx bxs-calendar'></i></div>
                </a>
            </li>
            <li class="icons">
                <a href="">
                    <div class="calendar"><i class='bx bxs-calendar'></i></div>
                </a>
            </li>
            <li class="icons">
                <a href="">
                    <div class="calendar"><i class='bx bxs-calendar'></i></div>
                </a>
            </li>
            <li class="icons">
                <a href="">
                    <div class="calendar"><i class='bx bxs-calendar'></i></div>
                </a>
            </li>
            <li>
                <div class="search">
                    <form class="nosubmit">
                        <input class="nosubmit" type="search" placeholder="Tapez ici pour chercher.">
                    </form>
                </div>
            </li>
            <?php if (isset($_SESSION['userID'])) : ?>
                <li>
                    <a href="">
                        <div class="calendar"><i class='bx bxs-bell'></i>
                            <div class="badge red"></div>
                        </div>
                    </a>
                </li>
                <li class="profile-info-name">
                    <img src="public/img/default.jpg" alt="" class="profile-image">
                    <a href="">
                        <div class="profile-name"><?= $_SESSION['username'] ?></div>
                    </a>
                    <i class='bx bx-chevron-down'></i>
                </li>
            <?php else : ?>
                <li class="profile-info-name">
                    <a href="index.php?view=login">Connexion</a>
                </li>
                <li class="profile-info-name">
                    <a href="index.php?view=register">Inscription</a>
                </li>
            <?php endif ?>
        </ul>
    </nav>