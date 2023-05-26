<?php 

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}

?>

<section></section>

<section class="sidebar">
    <h1 class="adminTitle"><a href="?view=adminSearchUser">Rechercher un utilisateur</a></h1>
    <br />
    <h2 class="adminTitle"><a href="?view=adminTreatWarn">Signalements</a></h2>
    <br />
</section>