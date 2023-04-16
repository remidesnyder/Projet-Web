<?php

require_once 'libs/modele.php';

$data = testApi();

foreach ($data as $key => $value) {
    echo $key . " : " . $value . "<br>";
}

?>