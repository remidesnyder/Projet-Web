<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location: ../index.php?view=accueil");
	die("");
}

?>


<section class="MovieTrend">
	<h1>Films tendances</h1>
	<p>La liste ici</p>
</section>

<section class="MovieWatch">
	<h1>Films vus</h1>
	<p>La liste ici</p>
</section>

<section class="MovieToWatch">
	<h1>Films à voir</h1>
	<p>La liste ici</p>
</section>


</div>