<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php");
	die("");
}

?>

<section id="pied">
	<p>&copy All Right Reserved</p>
	<?= tprint($_SESSION); ?>
</section>

<!-- Link to JS -->
<script src="public/js/swiper-bundle.min.js"></script>
<script src="public/js/index.js"></script>

</body>

</html>