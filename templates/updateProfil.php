<?php 

if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location: ../index.php?view=accueil");
	die("");
}

include_once "libs/modele.php";

$usersData = getUserByID($_SESSION['userID']);

?>

<section></section>

<section class="home-content">
    <h1 class="home-title">Modifier mon profil</h1>
    <br />
    <div id="formUsername">
        <form action="controleur.php?action=UpdateProfile" method="POST">
            <input type="hidden" name="whatUpdate" value="username">
            <input type="text" id="login" placeholder="Nom d'utilisateur" name="login" value="<?= $usersData[0]['username'] ?>" /><br />
            <input type="submit" value="Modifier" />
        </form>
    </div>
    <div id="formPassword">
        <form action="controleur.php?action=UpdateProfile" method="POST">
            <input type="hidden" name="whatUpdate" value="password">
            <input type="password" id="passe" placeholder="Mot de passe" name="passe"/><br />
            <input type="submit" value="Modifier" />
        </form>
    </div>
    <div id="formImage">
        <form action="controleur.php?action=UpdateProfile" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="whatUpdate" value="image">
            <input type="file" id="image" name="image"/><br />
            <input type="submit" value="Modifier" />
        </form>
    </div>
</section>
