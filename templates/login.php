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
<label for="login"> Login : </label><input type="text" id="login" name="login" value="<?php echo $login;?>" /><br />
<label for="passe">Passe : </label><input type="password" id="passe" name="passe" value="<?php echo $passe;?>" /><br />
<input type="checkbox" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <label for="remember"> Se souvenir de moi</label><br />

<input type="submit" name="action" value="Connexion" />
</form>
</div>


</section>