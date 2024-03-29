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
	if ((SQLGetChamp($SQL) == 1) || (SQLGetChamp($SQL) == 2)) return true;
	return false;
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
	updateLastUpdate($id); // On met à jour la date de dernière mise à jour
	$_SESSION['username'] = $newUsername; // On met à jour la variable de session
	return SQLUpdate($SQL);
}

/**
 * Fonction pour savoir si un utilisateur est bloqué
 * @param int $id
 * @param string $newUsername
 * @return int
 */
function userIsBlocked($id)
{
	$SQL = "SELECT blocked FROM users WHERE id='$id'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de blocage d'un utilisateur
 * @param int $id
 * @return int
 */
function blockUser($id)
{
	$SQL = "UPDATE users SET blocked='1' WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de déblocage d'un utilisateur
 * @param int $id
 * @return int
 */
function unblockUser($id)
{
	$SQL = "UPDATE users SET blocked='0' WHERE id='$id'";
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
	updateLastUpdate($id);
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
	updateLastUpdate($id);
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
	// Telechargement de l'image
	$time = time(); // Rendre l’image unique
    $image_name = $time . $newImage['name'];
    $image_tmp_name = $newImage['tmp_name'];
    $image_destination_path = 'public/img/profil/' . $image_name;

	 // Le fichier est bien une image 
	 $allowed_files = ['png', 'jpg', 'jpeg', 'gif'];
	 $extension = explode('.', $image_name);
	 $extension = end($extension);
	 if (in_array($extension, $allowed_files)) {
		// Upload image
		move_uploaded_file($image_tmp_name, $image_destination_path);
		// On supprime l'ancienne image
		if (file_exists("public/img/profil/" . getProfilPath($id))) {
			unlink("public/img/profil/" . getProfilPath($id));
		}
		// On met à jour la base de données
		$SQL = "UPDATE users SET profil_picture='$image_name' WHERE id='$id'";
		updateLastUpdate($id);
		$_SESSION['profil_picture'] = $image_name;
		return SQLUpdate($SQL);
	} else {
		// Erreur
		$error = 'Le fichier doit être une image';
	}
}

/**
 * Fonction de vérification de l'existence d'un utilisateur
 * @param string $username
 * @return int
 */
function usernameAlreadyExist($username)
{
	$SQL = "SELECT id FROM users WHERE username='$username'";
	return SQLGetChamp($SQL);
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
	if (usernameAlreadyExist($username)) return false;
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
	$SQL = "SELECT `id`, `username`, `profil_picture`, `role`, `created_at`, `updated_at`, `last_connexion` FROM `users`";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération des informations d'un utilisateur
 * @return array
 */
function getUserByID($id)
{
	$SQL = "SELECT `id`, `username`, `profil_picture`, `role`, `created_at`, `updated_at`, `last_connexion` FROM `users` WHERE `id` = '$id'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération des informations d'un utilisateur
 * @return array
 */
function getUserByUsername($username)
{
	$SQL = "SELECT `id`, `username`, `profil_picture`, `role`, `created_at`, `updated_at`, `last_connexion` FROM `users` WHERE `username` = '$username'";
	return parcoursRs(SQLSelect($SQL))[0];
}

/**
 * Fonction de récupération de l'image de profil de profil d'un utilisateur
 * @param int $id
 * @return array
 */
function getProfilPath($id)
{
	$SQL = "SELECT profil_picture FROM users WHERE id='$id'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de mise à jour de la date de dernière connexion
 * @param int $id
 * @return array
 */
function updateLastConnexion($id)
{
	$SQL = "UPDATE users SET last_connexion = NOW() WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de mise à jour de la date de dernière mise à jour
 * @param int $id
 * @return array
 */
function updateLastUpdate($id)
{
	$SQL = "UPDATE users SET updated_at = NOW() WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de récupération du temps passé à regarder des films pour un utilisateur
 * @param int $id
 * @return int
 */
function getMovieTime($userID)
{
	$SQL = "SELECT SUM((watched_movies.multiple * movies.runtime)) AS timeRuntime
				FROM `watched_movies` 
    			INNER JOIN `movies` ON movies.movieID = watched_movies.movieID
   				WHERE `userID` = '$userID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de récupération des genres favoris d'un utilisateur
 * @param int $id
 * @return int
 */
function getFavoriteGenres($userID)
{
	global $API_KEY;
	// Récupération de la liste des films ajoutés par l'utilisateur
	$result = getAllMoviesSeen($userID);

	// Initialisation du tableau associatif pour stocker les genres et leur nombre d'apparitions
	$genres_count = array();

	// Parcours des films de la watchlist
	foreach ($result as $movie) {

		// Récupération des genres associés à ce film
		$genres_url = "https://api.themoviedb.org/3/movie/{$movie['movieID']}?api_key=" . $API_KEY . "&language=fr-FR";
		$genres_json = file_get_contents($genres_url);
		$genres_array = json_decode($genres_json, true);

		// Parcours des genres associés à ce film
		foreach ($genres_array['genres'] as $genre) {
			// Incrémentation du nombre d'apparitions de ce genre dans le tableau associatif
			if (isset($genres_count[$genre['name']])) {
				$genres_count[$genre['name']]++;
			} else {
				$genres_count[$genre['name']] = 1;
			}
		}
	}

	// Tri du tableau associatif en fonction du nombre d'apparitions décroissant
	arsort($genres_count);

	// Récupération des 3 genres les plus fréquents
	//$genres = array_slice($genres_count, 0, 3);
	$genres = array_slice($genres_count, 0);

	// Récupération des clés du tableau associatif
	$genres = array_keys($genres);

	// Renvoi des genres
	return $genres;
}

function getFavoriteGenresWithCount($userID)
{
	global $API_KEY;
	// Récupération de la liste des films ajoutés par l'utilisateur
	$result = getAllMoviesSeen($userID);

	// Initialisation du tableau associatif pour stocker les genres et leur nombre d'apparitions
	$genres_count = array();

	// Parcours des films de la watchlist
	foreach ($result as $movie) {

		// Récupération des genres associés à ce film
		$genres_url = "https://api.themoviedb.org/3/movie/{$movie['movieID']}?api_key=" . $API_KEY . "&language=fr-FR";
		$genres_json = file_get_contents($genres_url);
		$genres_array = json_decode($genres_json, true);

		// Parcours des genres associés à ce film
		foreach ($genres_array['genres'] as $genre) {
			// Incrémentation du nombre d'apparitions de ce genre dans le tableau associatif
			if (isset($genres_count[$genre['name']])) {
				$genres_count[$genre['name']]++;
			} else {
				$genres_count[$genre['name']] = 1;
			}
		}
	}

	// Tri du tableau associatif en fonction du nombre d'apparitions décroissant
	arsort($genres_count);

	// Renvoi des 3 genres les plus fréquents avec leur nombre d'occurrence
	$genres = array_slice($genres_count, 0);

	// Renvoi des genres avec leur nombre d'occurrence
	return $genres;
}

/**
 * Fonction de récupération du nombre de reactions d'un utilisateur
 * @param int $id
 * @return array
 */
function getNumberOfReactionsFromCommentsAndReplies($userID)
{
	$SQL = "SELECT COUNT(*) FROM comments_reactions WHERE userID='$userID'";
	$commentResult = SQLGetChamp($SQL);
	$SQL = "SELECT COUNT(*) FROM replies_reactions WHERE userID='$userID'";
	$replyResult = SQLGetChamp($SQL);
	return $commentResult + $replyResult;
}

/**
 * Fonction de récupération des acteurs préférés d'un utilisateur
 * @param int $userID
 * @return array
 */
function getListOfPreferedActors($userID)
{
	$SQL = "SELECT `movie_favorite_actors`.`actorID`, COUNT( `movie_favorite_actors`.`id`) AS `nbVotes`
		FROM `movie_favorite_actors` 
    	WHERE `movie_favorite_actors`.`userID` = '$userID'
    	GROUP BY `movie_favorite_actors`.`actorID`
    	ORDER BY COUNT( `movie_favorite_actors`.`id`) DESC";
	return parcoursRs(SQLSelect($SQL));
}

/* ******************************** */
/* 		Fonction Notification */
/* ******************************** */

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
function addNotification($userID, $title, $content, $redirection = NULL)
{
	$SQL = "INSERT INTO notifications (userID, title, content, redirection) VALUES ('$userID', '$title', '$content', '$redirection')";
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

function notificationIsUnRead($notificationID) {
	$SQL = "SELECT * FROM `notifications` WHERE `seen_date` IS NULL AND `id` = '$notificationID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de marquage d'une notification comme lue
 * @param int $id
 * @return int
 */
function markAsRead($id)
{
	$SQL = "UPDATE notifications SET seen_date = NOW() WHERE id='$id'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de récupération d'une notification
 * @param int $id
 * @return array
 */
function getNotification($id) {
	$SQL = "SELECT * FROM `notifications` WHERE `id` = '$id'";
	return parcoursRs(SQLSelect($SQL));
}


/* ******************************** */
/* 		Fonction Commentaire */
/* ******************************** */

/**
 * Fonction de récupération du nombre de commentaires d'un utilisateur
 * @param int $userID
 * @return int
 */
function getNumberOfComment($userID)
{
	$SQL = "SELECT COUNT(*) FROM comments WHERE userID='$userID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de récupération de la liste des commentaires d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllCommentsByUser($userID)
{
	$SQL = "SELECT movies.title, comments.* 
			FROM `comments`
    		INNER JOIN `movies` ON comments.movieID = movies.movieID
    		WHERE comments.`userID` = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des commentaires d'un film
 * @param int $movieID
 * @return array
 */
function getCommentsByMovie($movieID)
{
	$SQL = "SELECT comments.*, users.id AS userID, users.username, users.profil_picture, users.role
				FROM `comments` 
    			INNER JOIN `users` ON users.id = comments.userID
    			WHERE `movieID` ='$movieID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des commentaires d'un film
 * @param int $movieID
 * @return array
 */
function getCommentMovie($commentID)
{
	$SQL = "SELECT movieID FROM comments WHERE id='$commentID'";
	return SQLGetChamp($SQL);
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

	$SQL = "DELETE FROM replies WHERE commentID='$id'";
	SQLDelete($SQL);

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
 * Fonction qui vérifie si un utilisateur a déjà réagi à un commentaire
 * @param int $commentID
 * @param int $userID
 * @return array
 */
function userHasAlreadyReacted($commentID, $userID)
{
	$SQL = "SELECT * FROM comments_reactions WHERE commentID='$commentID' AND userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de l'auteur d'un commentaire
 * @param int $commentID
 * @return int
 */
function getCommentAuthor($commentID)
{
	$SQL = "SELECT userID FROM comments WHERE id='$commentID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction d'ajout d'une réaction
 * @param int $commentID
 * @return int
 */
function addReaction($commentID, $userID) {

	// On vérifie si l'utilisateur a déjà réagi à ce commentaire
	if (userHasAlreadyReacted($commentID, $userID) != null) {
		return false;
	}

	$SQL = "INSERT INTO comments_reactions (commentID, userID) VALUES ('$commentID', '$userID')";
	SQLInsert($SQL);

	$SQL = "UPDATE comments SET reactions=reactions+1 WHERE id='$commentID'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de suppression d'une réaction
 * @param int $commentID
 * @param int $userID
 * @return int
 */
function deleteReaction($commentID, $userID){

	// On vérifie si l'utilisateur a déjà réagi à ce commentaire
	if (userHasAlreadyReacted($commentID, $userID) == null) {
		return false;
	}

	$SQL = "DELETE FROM comments_reactions WHERE commentID='$commentID' AND userID='$userID'";
	SQLDelete($SQL);

	$SQL = "UPDATE comments SET reactions=reactions-1 WHERE id='$commentID'";
	return SQLUpdate($SQL);
}

/* ******************************** */
/* 		Fonction Replies */
/* ******************************** */

/**
 * Fonction de récupération de la liste des réponses d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllRepliesByUser($userID)
{
	$SQL = "SELECT movies.title, replies.*
			FROM `replies` 
   			INNER JOIN `comments` ON comments.id = replies.commentID
    		INNER JOIN `movies` ON movies.movieID = comments.movieID
    		WHERE replies.`userID` = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des réponses d'un commentaire
 * @param int $commentID
 * @return array
 */
function getRepliesByComment($commentID)
{
	$SQL = "SELECT replies.*, users.id AS userID, users.username, users.profil_picture, users.role 
			FROM replies 
			INNER JOIN `users` ON users.id = replies.userID
			WHERE commentID='$commentID'";
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
	SQLInsert($SQL);

	$commentAuthor = getCommentAuthor($commentID);

	$movieID = getCommentMovie($commentID);
	$movieTitle = getMovieInfo($movieID)['movie']['title'];

	if ($commentAuthor != $userID) {
		$SQL = "INSERT INTO notifications (userID, title, content, redirection) VALUES ('$commentAuthor', 'Nouvelle réponse', 'Un utilisateur a répondu à votre commentaire sur le film : $movieTitle', '?view=movie&movieID=$movieID')";
		SQLInsert($SQL);
	}
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
 * Fonction qui vérifie si un utilisateur a déjà réagi à une réponse
 * @param int $commentID
 * @param int $userID
 * @return array
 */
function userHasAlreadyReactedReply($replyID, $userID)
{
	$SQL = "SELECT * FROM replies_reactions WHERE replyID='$replyID' AND userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'une réaction
 * @param int $replyID
 * @return int
 */
function addReplyReaction($replyID, $userID) {

	// On vérifie si l'utilisateur a déjà réagi à cette réponse
	if (userHasAlreadyReactedReply($replyID, $userID) != null) {
		return false;
	}

	$SQL = "INSERT INTO replies_reactions (replyID, userID) VALUES ('$replyID', '$userID')";
	SQLInsert($SQL);

	$SQL = "UPDATE replies SET reactions=reactions+1 WHERE id='$replyID'";
	return SQLUpdate($SQL);
}

/**
 * Fonction de suppression d'une réaction
 * @param int $replyID
 * @param int $userID
 * @return int
 */
function deleteReplyReaction($replyID, $userID){
	
	// On vérifie si l'utilisateur a déjà réagi à cette réponse
	if (userHasAlreadyReactedReply($replyID, $userID) == null) {
		return false;
	}

	$SQL = "DELETE FROM replies_reactions WHERE replyID='$replyID' AND userID='$userID'";
	SQLDelete($SQL);

	$SQL = "UPDATE replies SET reactions=reactions-1 WHERE id='$replyID'";
	return SQLUpdate($SQL);
}

/* ******************************** */
/* 		Fonction Movies */
/* ******************************** */

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
	$SQL = "SELECT * FROM movies WHERE movieID='$id'";
	return parcoursRs(SQLSelect($SQL));
}

function getMovieFromAPI($movieID)
{
	// Récupération des informations du film
	global $API_KEY; // Récupération de la clé API
	$api_url = "https://api.themoviedb.org/3/movie/" . $movieID . "?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json = file_get_contents($api_url); // Récupération du JSON
	$api_array = json_decode($api_json, true); // Décodage du JSON

	return $api_array;
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
	// On vérifie si le film n'existe pas déjà
	if (getMovie($movieID) != null) {
		return false;
	}
	$SQL = "INSERT INTO movies (movieID, title, overview, poster_path, runtime, release_date) VALUES ('$movieID', '$title', '$overview', '$poster_path', '$runtime', '$release_date')";
	return SQLInsert($SQL);
}

/**
 * Fonction d'ajout d'un film via l'API
 * @param int $movieID
 * @return array
 */
function addMovieWithAPI($movieID)
{
	if (empty($movieID)) {
		return false;
	}
	if (!empty(getMovie($movieID))) {
		return false;
	}
	$movie = getMovieFromAPI($movieID);

	$movieID = $movie['id'];
	$title = proteger($movie['title']);
	$overview = proteger($movie['overview']);
	$poster_path = $movie['poster_path'];
	$runtime = $movie['runtime'] ? $movie['runtime'] : 0;
	$release_date = $movie['release_date'];

	addMovie($movieID, $title, $overview, $poster_path, $runtime, $release_date);

	return true;
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

/**
 * Fonction de récupération de la liste des acteurs d'un film
 * @param int $movieID
 * @return array
 */
function getActorsByMovie($movieID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/" . $movieID . "/credits?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);

	return $api_array['cast'];
}

/* ******************************** */
/* 		Fonction Vote Acteur	    */
/* ******************************** */

/**
 * Fonction de récupération de la liste des votes d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllVotes($userID)
{
	$SQL = "SELECT * FROM movie_favorite_actors WHERE userID='$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de récupération de la liste des votes d'un film
 * @param int $movieID
 * @return array
 */
function getVotesByMovie($movieID)
{
	$SQL = "SELECT * FROM movie_favorite_actors WHERE movieID='$movieID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de vérification si un utilisateur a déjà voté pour un acteur dans un film
 * @param int $userID
 * @param int $movieID
 * @param int $actorID
 * @return int
 */
function userHasAlreadyForThisActorInThisMovie($userID, $movieID, $actorID)
{
	$SQL = "SELECT * FROM movie_favorite_actors WHERE userID='$userID' AND movieID='$movieID' AND actorID='$actorID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction de vérification si un utilisateur a déjà voté pour un film
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function userHasAlreadyInThisMovie($userID, $movieID)
{
	$SQL = "SELECT * FROM movie_favorite_actors WHERE userID='$userID' AND movieID='$movieID'";
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
function addVoteActor($userID, $movieID, $actorID)
{
	if (userHasAlreadyForThisActorInThisMovie($userID, $movieID, $actorID) != null) {
		return false;
	}
	if (userHasAlreadyInThisMovie($userID, $movieID) != null) {
		deleteVoteActor($userID, $movieID);
	}
	$SQL = "INSERT INTO movie_favorite_actors (userID, movieID, actorID) VALUES ('$userID', '$movieID', '$actorID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un vote
 * @param int $id
 * @return int
 */
function deleteVoteActor($userID, $movieID)
{
	$SQL = "DELETE FROM movie_favorite_actors WHERE userID='$userID' AND movieID='$movieID'";
	return SQLDelete($SQL);
}

/**
 * Fonction de récupération du nombre de votes d'un acteur dans un film
 * @param int $actorID
 * @param int $movieID
 * @return int
 */
function getVoteActorInMovie($actorID, $movieID)
{
	$SQL = "SELECT count(id) FROM movie_favorite_actors WHERE actorID='$actorID' AND movieID='$movieID'";
	return SQLGetChamp($SQL);
}

/* ******************************** */
/* 		Fonction Note Film		    */
/* ******************************** */

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

/* ******************************** */
/* 		Fonction Film Vus 			*/
/* ******************************** */

/**
 * Fonction de récupération du nombre de films vus d'un utilisateur
 * @param int $userID
 * @return int
 */
function getNumberOfSeenMovie($userID)
{
	$SQL = "SELECT COUNT(*) FROM watched_movies WHERE userID='$userID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de récupération de la liste des films vus d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllMoviesSeen($userID)
{
	$SQL = "SELECT watched_movies.userID, watched_movies.seen_date, movies.* 
			FROM `watched_movies` 
			INNER JOIN `movies` ON movies.movieID = watched_movies.movieID 
			WHERE watched_movies.userID = '$userID'";
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

	if (getMovie($movieID) == null) {
		addMovieWithAPI($movieID);
	}

	if (isTheMovieInToWatchList($userID, $movieID) != null) {
		removeMovieToSee($userID, $movieID);
	}
	if (isTheMovieInWatchedList($userID, $movieID) != null) {
		return addMultipleSeen($userID, $movieID);
	}
	$SQL = "INSERT INTO watched_movies (userID, movieID) VALUES ('$userID', '$movieID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film vu
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function removeMovieSeen($userID, $movieID)
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

/**
 * Fonction de récupération du nombre de fois qu'un utilisateur a vu un film
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function getHowManyTimeUserHasSeenMovie($userID, $movieID)
{
	$SQL = "SELECT multiple FROM watched_movies WHERE userID='$userID' AND movieID = '$movieID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de vérification si un film est dans la liste des films vus d'un utilisateur
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function isTheMovieInWatchedList($userID, $movieID)
{
	$SQL = "SELECT * FROM watched_movies WHERE userID='$userID' AND movieID = '$movieID'";
	return SQLGetChamp($SQL);
}

/* ******************************** */
/* 		Fonction Film à voir 	    */
/* ******************************** */

/**
 * Fonction de récupération du nombre de films à voir d'un utilisateur
 * @param int $userID
 * @return int
 */
function getNumberOfToSeeMovie($userID)
{
	$SQL = "SELECT COUNT(*) FROM towatch_movies WHERE userID='$userID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction de récupération de la liste des films à voir d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllMoviesToSee($userID)
{
	$SQL = "SELECT towatch_movies.userID, towatch_movies.add_date, movies.* 
			FROM `towatch_movies` 
			INNER JOIN `movies` ON movies.movieID = towatch_movies.movieID 
			WHERE towatch_movies.userID = '$userID'";
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
	if (getMovie($movieID) == null) {
		addMovieWithAPI($movieID);
	}
	if (isTheMovieInWatchedList($userID, $movieID) != null) return false;
	if (isTheMovieInToWatchList($userID, $movieID) != null) return false;
	$SQL = "INSERT INTO towatch_movies (userID, movieID) VALUES ('$userID', '$movieID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film à voir
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function removeMovieToSee($userID, $movieID)
{
	$SQL = "DELETE FROM towatch_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLDelete($SQL);
}

/**
 * Fonction de vérification si un film est dans la liste à voir d'un utilisateur
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function isTheMovieInToWatchList($userID, $movieID)
{
	$SQL = "SELECT * FROM towatch_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLGetChamp($SQL);
}

/* ******************************** */
/* 		Fonction Film Favori		*/
/* ******************************** */

/**
 * Fonction de récupération du nombre de films favoris d'un utilisateur
 * @param int $userID
 * @return int
 */
function getUserFavoriteMovie($userID)
{
	$SQL = "SELECT favorites_movies.userID, favorites_movies.add_date, movies.* 
				FROM `favorites_movies` 
				INNER JOIN `movies` ON movies.movieID = favorites_movies.movieID 
				WHERE favorites_movies.userID = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction d'ajout d'un film favori
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function addFavoriteMovie($userID, $movieID)
{
	if (getMovie($movieID) == null) {
		addMovieWithAPI($movieID);
	}
	if (isTheMovieInFavoriteList($userID, $movieID) != null) return false;
	$SQL = "INSERT INTO favorites_movies (userID, movieID) VALUES ('$userID', '$movieID')";
	return SQLInsert($SQL);
}

/**
 * Fonction de suppression d'un film favori
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function removeFavoriteMovie($userID, $movieID)
{
	$SQL = "DELETE FROM favorites_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLDelete($SQL);
}

/**
 * Fonction de vérification si un film est dans la liste des favoris d'un utilisateur
 * @param int $userID
 * @param int $movieID
 * @return int
 */
function isTheMovieInFavoriteList($userID, $movieID) {
	$SQL = "SELECT * FROM favorites_movies WHERE userID='$userID' AND movieID='$movieID'";
	return SQLGetChamp($SQL);
}

/* ******************************** */
/* 		Fonction API			    */
/* ******************************** */

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
	$api_url_movie = "https://api.themoviedb.org/3/movie/" . $movieID . "?api_key=" . $API_KEY . "&language=fr-FR"; // Récupération de l'URL de l'API
	$api_json_movie = file_get_contents($api_url_movie); // Récupération du JSON
	$api_array_movie = json_decode($api_json_movie, true); // Décodage du JSON
	$api_url_cast = "https://api.themoviedb.org/3/movie/" . $movieID . "/credits?api_key=" . $API_KEY . "&language=fr-FR"; // Récupération de l'URL de l'API concernant les acteurs
	$api_json_cast = file_get_contents($api_url_cast);
	$api_array_cast = json_decode($api_json_cast, true);

	return [
		'movie' => $api_array_movie,
		'cast' => $api_array_cast
	];
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
function getPopularMovies($page = 1)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/popular?api_key=" . $API_KEY . "&language=fr-FR&page=" . $page ."&region=FR";
	try {
		$api_json = file_get_contents($api_url);
		if ($api_json === false) {
			$api_json = [];
		}
		$api_array = json_decode($api_json, true);
		addPopularMoviesOnDB($api_array["results"]);
		return $api_array["results"];
	} catch (Exception $e) {
		// Gérer l'erreur
		return [];
	}
}

function getNbPagePopularMovie() {
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/movie/popular?api_key=" . $API_KEY . "&language=fr-FR&page=1&region=FR";
	try {
		$api_json = file_get_contents($api_url);
		if ($api_json === false) {
			$api_json = [];
		}
		$api_array = json_decode($api_json, true);
		return $api_array["total_pages"];
	} catch (Exception $e) {
		// Gérer l'erreur
		return [];
	}
}

/**
 * Fonction d'ajout des films populaires dans la base de données
 * @param array $array
 * @return int
 */
function addPopularMoviesOnDB($array)
{
	if (empty($array)) {
		return false;
	}
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

/**
 * Fonction de récupération des informations d'un acteur
 * @param int $actorID
 * @return array
 */
function getActorByID($actorID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/person/" . $actorID . "?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array;
}

/**
 * Fonction de récupération des films d'un acteur
 * @param int $actorID
 * @return array
 */
function getActorMovies($actorID)
{
	global $API_KEY;
	$api_url = "https://api.themoviedb.org/3/person/" . $actorID . "/movie_credits?api_key=" . $API_KEY . "&language=fr-FR";
	$api_json = file_get_contents($api_url);
	$api_array = json_decode($api_json, true);
	return $api_array['cast'];
}

/* ******************************** */
/* 		Fonction REPORT			    */
/* ******************************** */

/**
 * Fonction de report d'un commentaire
 * @param int $commentID
 * @param int $userID
 * @return array
 */
function reportComment($commentID, $authorID, $reporterID) {
	if (ifUserAlreadyReport($commentID, $reporterID)) return;
	$SQL = "INSERT INTO warns (commentID, authorID, reporterID) VALUES ('$commentID', '$authorID', '$reporterID')";
	return SQLInsert($SQL);
}

/**
 * Fonction pour récupérer tous les reports
 * @param int $replyID
 * @param int $userID
 * @return array
 */
function getAllReport() {
	$SQL = "SELECT warns.*, comments.content AS commentContent, comments.movieID, movies.title AS movieTitle, users.username AS authorName, users.profil_picture AS authorPicture, users.role AS authorRole, users2.username AS reporterName, users2.profil_picture AS reporterPicture, users2.role AS reporterRole
			FROM `warns` 
			INNER JOIN `comments` ON comments.id = warns.commentID
			INNER JOIN `movies` ON movies.movieID = comments.movieID
			INNER JOIN `users` ON users.id = warns.authorID
			INNER JOIN `users` AS users2 ON users2.id = warns.reporterID";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction pour récupérer tous les reports d'un utilisateur
 * @param int $userID
 * @return array
 */
function getAllWarningByUser($userID) {
	$SQL = "SELECT movies.title, movies.movieID, warning.*, comments.*
	FROM `warning` 
    INNER JOIN `comments` ON comments.id = warning.commentID
    INNER JOIN `movies` ON movies.movieID = comments.movieID
    WHERE warning.`userID` = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction pour savoir si un utilisateur a déjà report un commentaire
 * @param int $userID
 * @return array
 */
function ifUserAlreadyReport($commentID, $userID) {
	$SQL = "SELECT * FROM warns WHERE commentID = '$commentID' AND reporterID = '$userID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction pour ajouter un avertissement à un utilisateur
 * @param int $commentID
 * @return array
 */
function addWarning($userID, $reason) {
	$SQL = "INSERT INTO warnings (userID, reason) VALUES ('$userID', '$reason')";
	return SQLInsert($SQL);
}

/**
 * Fonction pour supprimmer un report
 * @param int $userID
 * @return array
 */
function deleteReport($reportID) {
	$SQL = "DELETE FROM warns WHERE id = '$reportID'";
	return SQLDelete($SQL);
}

/**
 * Fonction pour récupérer l'ID de l'auteur d'un report
 * @param int $reportID
 * @return array
 */
function getAuthorIDOfReport($reportID) {
	$SQL = "SELECT authorID FROM warns WHERE id = '$reportID'";
	return SQLGetChamp($SQL);
}

function getMovieIDOFReport($reportID) {
	$SQL = "SELECT movieID FROM comments WHERE id = '$reportID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction pour récupérer l'ID du commentaire d'un report
 * @param int $reportID
 * @return array
 */
function getCommentIDOfReport($reportID) {
	$SQL = "SELECT commentID FROM warns WHERE id = '$reportID'";
	return SQLGetChamp($SQL);
}

function getContentOFCOmment($commentID) {
	$SQL = "SELECT content FROM comments WHERE id = '$commentID'";
	return SQLGetChamp($SQL);
}

/**
 * Fonction pour récupérer l'ID du film d'un report
 * @param int $userID
 * @param string $reason
 * @param int $commentID
 * @return array
 */
function addWarn($userID, $reason, $commentID) {
	// Si l'utilisateur à déjà un warn pour ce commentaire on fait rien
	if (ifUserAlreadyWarn($userID, $commentID)) return;
	$SQL = "INSERT INTO warning	(userID, reason, commentID) VALUES ('$userID', '$reason', '$commentID')";
	$movieID = getMovieIDOFReport($commentID);
	$contentOFComment = getContentOFCOmment($commentID);
	addNotification($userID, "Vous avez reçu un avertissement pour un commentaire", "Votre Commentaire : $contentOFComment a été signalé pour la raison suivante : $reason. Vous avez reçu un avertissement. Si vous en recevez 3, votre compte sera supprimé.", "?view=movie&movieID=$movieID");
	return SQLInsert($SQL);
}

/**
 * Fonction pour savoir si un utilisateur a déjà un warn pour un commentaire
 * @param int $userID
 * @param int $commentID
 * @return array
 */
function ifUserAlreadyWarn($userID, $commentID) {
	$SQL = "SELECT * FROM warning WHERE userID = '$userID' AND commentID = '$commentID'";
	return parcoursRs(SQLSelect($SQL));
}

/**
 * Fonction pour caché un commentaire
 * @param int $reportID
 * @return array
 */
function hideComment($commentID) {
	$SQL = "UPDATE comments SET hidden = 1 WHERE id = '$commentID'";
	return SQLUpdate($SQL);
}

/**
 * Fonction pour traiter un report
 * @param int $reportID
 * @return array
 */
function treatReport($reportID) {
	$SQL = "UPDATE warns SET treat_at = NOW() WHERE id = '$reportID'";
	return SQLUpdate($SQL);
}

/**
 * Fonction pour récupérer tous les avertissements non traités
 * @return array
 */
function getAllReportUntreated() {
	$SQL = "SELECT warns.*, comments.content AS commentContent, comments.movieID, movies.title AS movieTitle, users.username AS authorName, users.profil_picture AS authorPicture, users.role AS authorRole, users2.username AS reporterName, users2.profil_picture AS reporterPicture, users2.role AS reporterRole
			FROM `warns` 
			INNER JOIN `comments` ON comments.id = warns.commentID
			INNER JOIN `movies` ON movies.movieID = comments.movieID
			INNER JOIN `users` ON users.id = warns.authorID
			INNER JOIN `users` AS users2 ON users2.id = warns.reporterID
			WHERE warns.treat_at is NULL ";
	return parcoursRs(SQLSelect($SQL));
}


/* ******************************** */
/* 		Fonction GLOBALE		    */
/* ******************************** */

// Définition des niveaux de permission
define("PERMISSION_CREATOR", 4); // Créateur du site
define("PERMISSION_ADMIN", 3); // Administrateur
define("PERMISSION_MODERATOR", 2); // Modérateur
define("PERMISSION_USER", 1); // Utilisateur
define("PERMISSION_GUEST", 0); // Invité

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
