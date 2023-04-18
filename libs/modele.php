<?php

include_once "config.php";
require_once 'libs/maLibSQL.pdo.php';
require_once 'libs/maLibUtils.php';
/* Fonction utilisateur */

/**
 * Fonction de vérification des informations de connexion pour un utilisateur
 * @param string $login
 * @param string $passe
 * @return int | false
 */
function verifUserBdd($login, $passe)
{
	$SQL = "SELECT id FROM users WHERE username='$login' AND password='$passe'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de vérification du rôle d'un utilisateur
 * @param int $id
 * @return boolean
 */

function isAdmin($id)
{
	$SQL = "SELECT role FROM users WHERE id='$id'";
	if (SQLGetChamp($SQL) == 1 || 2) return true;
	else return false;
}

/**
 * Fonction de récupération du rôle d'un utilisateur
 * @param int $id
 * @return int
 */
function getPermissionLevel($id)
{
	$SQL = "SELECT roles.permission_level FROM `users` INNER JOIN `roles` ON users.role = roles.id WHERE users.id = '$id'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de changement de nom d'utilisateur
 * @param int $id
 * @param string $newUsername
 * @return int
 */

function changeUsername($id, $newUsername)
{
	$SQL = "UPDATE users SET username='$newUsername' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de changement de mot de passe
 * @param int $id
 * @param string $newPassword
 * @return int
 */

function changePassword($id, $newPassword)
{
	$SQL = "UPDATE users SET password='$newPassword' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de changement de rôle d'un utilisateur
 * @param int $id
 * @param int $newRole
 * @return int
 */
function changeRole($id, $newRole)
{
	$SQL = "UPDATE users SET role='$newRole' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de changement de l'image de profil
 * @param int $id
 * @param string $newImage
 * @return int
 */
function changeProfilImage($id, $newImage)
{
	$SQL = "UPDATE users SET profil_image='$newImage' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction d'ajout d'un utilisateur
 * @param string $username
 * @param string $password
 * @param int $role
 * @return int
 */
function addUser($username, $password, $role)
{
	$SQL = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un utilisateur
 * @param int $id
 * @return int
 */
function deleteUser($id)
{
	$SQL = "DELETE FROM users WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de récupération de la liste des utilisateurs
 * @return array
 */
function getUsers()
{
	$SQL = "SELECT * FROM users";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de mise à jour de la date de dernière connexion
 * @param int $id
 * @return array
 */
function updateLastConnexion($id)
{
	$SQL = "UPDATE users SET last_connexion=NOW() WHERE id='$id'";
	return SQLUpdate($SQL);
}

/* Fonction Notification */

/**
 * Fonction de récupération de la liste des notifications d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllNotifications($userID)
{
	$SQL = "SELECT * FROM notifications WHERE userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des notifications non lues d'un utilisateur
 * @param int $userID
 * @return array
 */
function getUnreadNotifications($userID)
{
	$SQL = "SELECT * FROM notifications WHERE userID='$userID' AND seen_date is null";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des notifications lues d'un utilisateur
 * @param int $userID
 * @return array
 */
function getReadNotifications($userID)
{
	$SQL = "SELECT * FROM notifications WHERE userID='$userID' AND seen_date is not null";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'une notification
 * @param int $id
 * @param string $title
 * @param string $content
 * @return int
 */
function addNotification($userID, $title, $content)
{
	$SQL = "INSERT INTO notifications (userID, title, content) VALUES ('$userID', '$title', '$content')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'une notification
 * @param int $id
 * @return int
 */
function deleteNotification($id)
{
	$SQL = "DELETE FROM notifications WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de marquage d'une notification comme lue
 * @param int $id
 * @return int
 */
function markAsRead($id)
{
	$SQL = "UPDATE notifications SET seen_date=NOW() WHERE id='$id'";
	return SQLUpdate($SQL);
}


/* Fonction COMMENTAIRES */

/**
 * Fonction de récupération de la liste des commentaires d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllComments($userID)
{
	$SQL = "SELECT * FROM comments WHERE userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des commentaires d'un film
 * @param int $movieID
 * @return array
 */
function getCommentsByMovie($movieID)
{
	$SQL = "SELECT * FROM comments WHERE movieID='$movieID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un commentaire
 * @param int $userID
 * @param int $movieID
 * @param string $content
 * @return int
 */

function addComment($userID, $movieID, $content)
{
	$SQL = "INSERT INTO comments (userID, movieID, content) VALUES ('$userID', '$movieID', '$content')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un commentaire
 * @param int $id
 * @return array
 */
function deleteComment($id)
{
	$SQL = "DELETE FROM comments WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de modification d'un commentaire
 * @param int $id
 * @param string $content
 * @return int
 */
function editComment($id, $content)
{
	$SQL = "UPDATE comments SET content='$content' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction d'ajout d'une réaction
 * @param int $commentID
 * @return int
 */
function addReaction($commentID)
{
	$SQL = "UPDATE comments SET reactions=reactions+1 WHERE id='$commentID'";
	return SQLUpdate($SQL);
}

/* Fonctions REPLIES */

/**
 * Fonction de récupération de la liste des réponses d'un commentaire
 * @param int $commentID
 * @return array
 */
function getRepliesByComment($commentID)
{
	$SQL = "SELECT * FROM replies WHERE commentID='$commentID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'une réponse
 * @param int $userID
 * @param int $commentID
 * @param string $content
 * @return int
 */
function addReply($userID, $commentID, $content)
{
	$SQL = "INSERT INTO replies (userID, commentID, content) VALUES ('$userID', '$commentID', '$content')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'une réponse
 * @param int $id
 * @return int
 */
function deleteReply($id)
{
	$SQL = "DELETE FROM replies WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de modification d'une réponse
 * @param int $id
 * @param string $content
 * @return int
 */
function editReply($id, $content)
{
	$SQL = "UPDATE replies SET content='$content' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction d'ajout d'une réaction
 * @param int $replyID
 * @return int
 */
function addReplyReaction($replyID)
{
	$SQL = "UPDATE replies SET reactions=reactions+1 WHERE id='$replyID'";
	return SQLUpdate($SQL);
}

/* Fonctions MOVIES */

/**
 * Fonction de récupération de la liste des films
 * @return array
 */
function getAllMovies()
{
	$SQL = "SELECT * FROM movies";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération d'un film
 * @param int $id
 * @return array
 */
function getMovie($id)
{
	$SQL = "SELECT * FROM movies WHERE id='$id'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un film
 * @param int $movieID
 * @param string $title
 * @param string $overview
 * @param string $poster_path
 * @param int $runtime
 * @param string $release_date
 * @return array
 */
function addMovie($movieID, $title, $overview, $poster_path, $runtime, $release_date)
{
	if (empty(getMovie($movieID))) {
		return false;
	}
	$SQL = "INSERT INTO movies (movieID, title, overview, poster_path, runtime, release_date) VALUES ('$movieID', '$title', '$overview', '$poster_path', '$runtime', '$release_date')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film
 * @param int $id
 * @return int
 */
function deleteMovie($id)
{
	$SQL = "DELETE FROM movies WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de modification d'un film
 * @param int $id
 * @param string $title
 * @param string $overview
 * @param string $poster_path
 * @param int $runtime
 * @param string $release_date
 * @return int
 */
function editMovie($id, $title, $overview, $poster_path, $runtime, $release_date)
{
	$SQL = "UPDATE movies SET title='$title', overview='$overview', poster_path='$poster_path', runtime='$runtime', release_date='$release_date' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/* Fonctions VOTE ACTEURS */

/**
 * Fonction de récupération de la liste des votes d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllVotes($userID)
{
	$SQL = "SELECT * FROM votes WHERE userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des votes d'un film
 * @param int $movieID
 * @return array
 */
function getVotesByMovie($movieID)
{
	$SQL = "SELECT * FROM votes WHERE movieID='$movieID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un vote
 * @param int $userID
 * @param int $movieID
 * @param int $actorID
 * @param int $vote
 * @return int
 */
function addVote($userID, $movieID, $actorID, $vote)
{
	$SQL = "INSERT INTO votes (userID, movieID, actorID, vote) VALUES ('$userID', '$movieID', '$actorID', '$vote')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un vote
 * @param int $id
 * @return int
 */
function deleteVote($id)
{
	$SQL = "DELETE FROM votes WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de modification d'un vote
 * @param int $id
 * @param int $vote
 * @return int
 */
function editVote($id, $vote)
{
	$SQL = "UPDATE votes SET vote='$vote' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/* Fonctions NOTE FILMS */

/**
 * Fonction de récupération de la liste des notes d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllNotes($userID)
{
	$SQL = "SELECT * FROM notes WHERE userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des notes d'un film
 * @param int $movieID
 * @return array
 */
function getNotesByMovie($movieID)
{
	$SQL = "SELECT * FROM notes WHERE movieID='$movieID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'une note
 * @param int $userID
 * @param int $movieID
 * @param int $note
 * @return int
 */
function addNote($userID, $movieID, $note)
{
	$SQL = "INSERT INTO notes (userID, movieID, note) VALUES ('$userID', '$movieID', '$note')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'une note
 * @param int $id
 * @return int
 */
function deleteNote($id)
{
	$SQL = "DELETE FROM notes WHERE id='$id'";
	return SQLDelete($SQL);
}

/**
 * Fonction de modification d'une note
 * @param int $id
 * @param int $note
 * @return int
 */
function editNote($id, $note)
{
	$SQL = "UPDATE notes SET note='$note' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/* Fonctions FILMS VUS */

/**
 * Fonction de récupération de la liste des films vus d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllMoviesSeen($userID)
{
	//$SQL = "SELECT * FROM watched_movies WHERE userID='$userID'";
	$SQL = "SELECT watched_movies.userID, watched_movies.seen_date, movies.* FROM `watched_movies` INNER JOIN `movies` ON movies.movieID = watched_movies.movieID WHERE watched_movies.userID = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un film vu
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function addMovieSeen($userID, $movieID)
{
	$SQL = "INSERT INTO watched_movies (userID, movieID) VALUES ('$userID', '$movieID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film vu
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function deleteMovieSeen($userID, $movieID)
{
	$SQL = "DELETE FROM watched_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLDelete($SQL);
}

/**
 * Fonction d'ajout d'un film vu plusieurs fois
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function addMultipleSeen($userID, $movieID)
{
	$SQL = "UPDATE watched_movies SET multiple = multiple + 1 WHERE userID='$userID' AND movieID = '$movieID'";
	return SQLUpdate($SQL);
}

/* Fonctions FILMS A VOIR */

/**
 * Fonction de récupération de la liste des films à voir d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllMoviesToSee($userID)
{
	//$SQL = "SELECT * FROM towatch_movies WHERE userID='$userID'";
	$SQL = "SELECT towatch_movies.userID, towatch_movies.add_date, movies.* FROM `towatch_movies` INNER JOIN `movies` ON movies.movieID = towatch_movies.movieID WHERE towatch_movies.userID = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un film à voir
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function addMovieToSee($userID, $movieID)
{
	$SQL = "INSERT INTO towatch_movies (userID, movieID) VALUES ('$userID', '$movieID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film à voir
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function deleteMovieToSee($userID, $movieID)
{
	$SQL = "DELETE FROM towatch_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLDelete($SQL);
}

/* Fonctions API */

/**
 * Fonction de test de l'API
 * @return array
 */
function testApi()
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/512195?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);

	$backdrop_path = $api_array["backdrop_path"];
	$genres = $api_array["genres"];
	$id = $api_array["id"];
	$overview = $api_array["overview"];
	$release_date = $api_array["release_date"];
	$runtime = $api_array["runtime"];
	$title = $api_array["title"];

	// Les clés du tableau associatif
	$keys = ["id", "title", "overview", "backdrop_path", "release_date", "runtime", "genres"];

	// Le tableau associatif résultant
	$data = array_combine($keys, [$id, $title, $overview, $backdrop_path, $release_date, $runtime, $genres]);
	return $data;
}

/**
 * Fonction de récupération des informations d'un film
 * @param int $movieID
 * @return array
 */
function getMovieInfo($movieID)
{
	global $API_KEY;
	$api_url_movie = "https://api.themoviedb.org/3/movie/" . $movieID . "?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json_movie = file_get_contents($api_url_movie);
	$api_array_movie = json_decode($api_json_movie, true);
	$api_url_cast = "https://api.themoviedb.org/3/movie/" . $movieID . "/credits?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json_cast = file_get_contents($api_url_cast);
	$api_array_cast = json_decode($api_json_cast, true);
}

/**
 * Fonction de récupération des films recommandés
 * @param int $movieID
 * @return array
 */
function getRecommendationMovies($movieID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/" . $movieID . "/recommendations?api_key=" . $API_KEY . "&language=fr-FR&page=1";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/**
 * Fonction de récupération des films similaires
 * @param int $movieID
 * @return array
 */
function getSimilarMovies($movieID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/" . $movieID . "/similar?api_key=" . $API_KEY . "&language=fr-FR&page=1";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/**
 * Fonction de récupération des films populaires
 * @return array
 */
function getPopularMovies()
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/popular?api_key=" . $API_KEY . "&language=fr-FR&page=1&region=FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	addPopularMoviesOnDB($api_array["results"]);
	return $api_array["results"];
}

/**
 * Fonction d'ajout des films populaires dans la base de données
 * @param array $array
 * @return int
 */
function addPopularMoviesOnDB($array) {
	foreach ($array as $movie) {
		$movieID = $movie["id"];
		$title = proteger($movie["title"]);
		$overview = proteger($movie["overview"]);
		$poster_path = $movie["poster_path"];
		$release_date = $movie["release_date"];
		$runtime = 0;
		addMovie($movieID, $title, $overview, $poster_path, $runtime, $release_date);
	}
}


/**
 * Fonction de récupération des diffuseurs d'un film
 * @return array
 */
function getProviders($movieID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/" . $movieID . "/watch/providers?api_key=" . $API_KEY;
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/**
 * Fonction de récupération des films en fonction de la recherche
 * @param string $query
 * @return array
 */
function searchMovies($query)
{
	global $API_KEY;
	$query = urlencode($query);
	$api_url = "https://api.themoviedb.org/3/search/movie?api_key=" . $API_KEY . "&language=fr-FR&query=" . $query . "&page=1&include_adult=false&region=FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/**
 * Fonction de récupération des acteurs en fonction de la recherche
 * @param string $query
 * @return array
 */
function searchActors($query)
{
	global $API_KEY;
	$query = urlencode($query);
	$api_url = "https://api.themoviedb.org/3/search/person?api_key=" . $API_KEY . "&language=fr-FR&query=" . $query . "&page=1&include_adult=false";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/* Fonction GLOBALE */

// Définition des niveaux de permission
define("PERMISSION_CREATOR", 4);
define("PERMISSION_ADMIN", 3);
define("PERMISSION_MODERATOR", 2);
define("PERMISSION_USER", 1);
define("PERMISSION_GUEST", 0);

/**
 * Fonction de vérification de la permission d'un utilisateur
 * @param int $requiredPermission
 * @return boolean
 */
function checkPermission($requiredPermission)
{
	// Vérification de la session de l'utilisateur
	session_start();
	if (!isset($_SESSION["user_id"]) || !isset($_SESSION["permission_level"])) {
		header("Location: login.php");
		exit();
	}

	// Vérification de la permission de l'utilisateur
	$userPermission = $_SESSION["permission_level"];
	if ($userPermission < $requiredPermission) {
		return false;
	} else {
		return true;
	}
}

/**	
 * Exemple d'utilisation
 * if (checkPermission(PERMISSION_ADMIN)) {
 *  (Affichage de la vue réservée aux administrateurs ...)
 * } else {
 *   die("Vous n'avez pas la permission d'accéder à cette page");
 * }
 */


/**
 * Fonction de remplissage des variables d'environnement à partir d'un fichier .env
 * @return void
 */
function fillEnvVarFromFile()
{
	$envFile = dirname(__DIR__) . '/.env';
	if (file_exists($envFile)) {
		// Récupérer le contenu du fichier .env
		$envFile = file_get_contents($envFile);
		// Diviser le fichier en lignes
		$envLines = explode("\n", $envFile);
		// Parcourir chaque ligne et définir la variable d'environnement correspondante
		foreach ($envLines as $line) {
			// Ignorer les lignes vides ou commentées
			if (empty($line) || strpos(trim($line), '#') === 0) {
				continue;
			}
			// Diviser la ligne en clé et valeur
			list($key, $value) = explode('=', $line, 2);
			// Définir la variable d'environnement correspondante
			putenv("$key=$value");
		}
	} else {
		die("Le fichier .env n'existe pas");
	}
}
