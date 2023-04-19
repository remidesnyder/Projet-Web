<?php

require_once 'libs/modele.php';

$data = testApi();

$timeRuntime = getMovieTime($_SESSION['userID']);

foreach ($data as $key => $value) {
    echo $key . " : " . $value . "<br>";
}

echo "<br><br>";
echo "Temps total de visionnage : " . $timeRuntime . " minutes";

?>