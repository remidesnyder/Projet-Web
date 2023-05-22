<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=login");
    die("");
}

$error = valider("error");

?>
<section></section>
<section>
    <h1 class="signup">Inscription</h1>
    <br />
    <?php if ($error) { ?>
        <div class="error" style="color: red;"><?= $error ?></div>
    <?php } ?>
    <div id="formSignup" class="signup">
        <form action="controleur.php" method="POST">
            <input type="text" id="login" placeholder="Nom d'utilisateur" name="login"/><br />
            <input type="password" id="passe" placeholder="Mot de passe" name="passe"/><br />

            <input type="submit" name="action" value="Inscription" />
        </form>
    </div>
    <br />
    <div class="comptePasCompte">
    <h4 class="comptePasCompte">Déjà inscrit ?</h4>
    <a class="comptePasCompte" href="index.php?view=login">Se connecter</a>
    </div>
</section>