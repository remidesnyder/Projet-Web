<?php

include_once "modele.php";

fillEnvVarFromFile();

/*
* Configuration de la base de données
*/
$BDD_host="localhost";
$BDD_user="root";
$BDD_password="root";
$BDD_base="db_projet_web";

/* 
* Configuration de l'application
*/
$API_KEY = getenv("API_KEY");

?>
