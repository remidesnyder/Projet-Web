<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php");
	die("");
}

?>

<div id="pied">
	<p>&copy All Right Reserved</p>
</div>

</body>
</html>
