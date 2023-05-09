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
    <?php if ($error) { ?>
        <div class="error" style="color: red;"><?= $error ?></div>
    <?php } ?>
    <div id="formSignup" class="signup">
        <form action="controleur.php" method="POST">
            <label for="login"> Login : </label><input type="text" id="login" name="login"/><br />
            <label for="passe">Passe : </label><input type="password" id="passe" name="passe"/><br />

            <input type="submit" name="action" value="Inscription" />
        </form>
    </div>
</section>