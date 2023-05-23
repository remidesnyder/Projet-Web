<?php
session_start();

/*
Cette page génère les différentes vues de l'application en utilisant des templates situés dans le répertoire "templates". Un template ou 'gabarit' est un fichier php qui génère une partie de la structure XHTML d'une page. 

La vue à afficher dans la page index est définie par le paramètre "view" qui doit être placé dans la chaîne de requête. En fonction de la valeur de ce paramètre, on doit vérifier que l'on a suffisamment de données pour inclure le template nécessaire, puis on appelle le template à l'aide de la fonction include

Les formulaires de toutes les vues générées enverront leurs données vers la page controleur.php pour traitement. La page controleur.php redirigera alors vers la page index pour réafficher la vue pertinente, généralement la vue dans laquelle se trouvait le formulaire. 
*/


	include_once "libs/maLibUtils.php";

	// on récupère le paramètre view éventuel 
	$view = valider("view"); 

	// S'il est vide, on charge la vue accueil par défaut
	if (!$view) $view = "accueil"; 

	// NB : il faut que view soit défini avant d'appeler l'entête

	// Dans tous les cas, on affiche l'entete, 
	// qui contient les balises de structure de la page, le logo, etc. 
	// Le formulaire de recherche ainsi que le lien de connexion 
	// si l'utilisateur n'est pas connecté 

	if (($view == "login" || $view == "inscription") && isset($_SESSION['userID']) && $_SESSION['userID'] != 0)
		$view = "accueil";

	// La page est interdit aux utilisateurs pas connecté et au non admin
	if ($view == "admin" && (!isset($_SESSION['userID']) || $_SESSION['userID'] == 0 || !$_SESSION['isAdmin']))
		$view = "accueil";

	include("templates/partials/header.php");

	// En fonction de la vue à afficher, on appelle tel ou tel template
	switch($view)
	{		

		case "accueil" : 
			include("templates/accueil.php");
		break;


		default : // si le template correspondant à l'argument existe, on l'affiche
			if (file_exists("templates/$view.php"))
				include("templates/$view.php");

	}


	// Dans tous les cas, on affiche le pied de page
	// Qui contient les coordonnées de la personne si elle est connectée
	include("templates/partials/footer.php");


/**
 * Ce qui manque au projet web : (TODO)
 * - Ajouter l'icône vote aux acteurs [OK]
 * - Ajouter la possibilité de voter pour un acteur [OK]
 * - Statistiques sur le profil [OK]
 * - Changer les icons du header [OK]
 * - Modifier le profil [OK]
 * - Finir le système de notifications [OK]
 * 
 * - Ajotuer dropdown pour les notifications
 * - Ajouter dropdown pour le profil
 * - Utilisateurs bloqués
 * - Supprimer mon compte
 * - Design
 */