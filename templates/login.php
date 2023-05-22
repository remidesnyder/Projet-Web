<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

// Chargement eventuel des données en cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 

?>
<section>
</section>
<section id="corps">

<h1 class="login">Connexion</h1>
<br />
<div id="formLogin" class="login">
<form action="controleur.php" method="GET">
<input type="text" id="login" name="login" placeholder="Nom d'utilisateur" value="<?php echo $login;?>" /><br />
<input type="password" id="passe" name="passe" placeholder="Mot de passe" value="<?php echo $passe;?>" /><br />
<input type="checkbox" <?php echo $checked;?> class="checkmark" name="remember" id="remember" value="ok"/> <label for="remember" class="remember"> Se souvenir de moi</label><br />

<input type="submit" name="action" value="Connexion" />
</form>
</div>
<br />
<div class="comptePasCompte">
	<h4>Pas encore de compte ?</h4>
	<a href="index.php?view=signup" id="creer">Créer un compte</a>
</div>


</section>