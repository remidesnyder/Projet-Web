<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";
require_once "libs/config.php";

$qs = "";

if ($action = valider("action")) {
	ob_start();
	echo "Action = '$action' <br />";
	
	switch ($action) {
		case 'Connexion':
			// On verifie la presence des champs login et passe
			if ($login = valider("login"))
				if ($passe = valider("passe")) {
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					if (verifUser($login, $passe)) {
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) {
							setcookie("login", $login, time() + 60 * 60 * 24 * 30);
							setcookie("passe", $password, time() + 60 * 60 * 24 * 30);
							setcookie("remember", true, time() + 60 * 60 * 24 * 30);
						} else {
							setcookie("login", "", time() - 3600);
							setcookie("passe", "", time() - 3600);
							setcookie("remember", false, time() - 3600);
						}
					}
				}

			// On redirigera vers la page index automatiquement
			break;
		case 'Inscription':
			// On verifie la presence des champs login et passe
			if ($login = valider("login"))
				if ($passe = valider("passe")) {
					if (usernameAlreadyExist($login)) {
						// L'utilisateur existe déjà
						$qs = "?view=signup&error=" . urldecode("Le nom d'utilisateur existe déjà");
						break;
					}
					// L'utilisateur n'existe pas, on l'ajoute
					addUser($login, $passe, 4);
					$qs = "?view=login";
					break;
				}

			// On redirigera vers la page index automatiquement
			break;
		case 'Logout':
			// On détruit les variables de session
			session_destroy();
			// On redirigera vers la page index automatiquement
			break;
		case 'AddMovieInWatchList':
			$movieID = valider("movieID", 'POST');
			$request = valider("request", 'POST');

			// On vérifie que l'utilisateur est connecté et que le film existe
			if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0 && $movieID > 0)
				addMovieSeen($_SESSION['userID'], $movieID);

			$qs = "?view=movie&movieID=$movieID&request=$request";
			// On redirigera vers la page index automatiquement
			break;
		case 'RemoveMovieFromWatchList':
			$movieID = valider("movieID", 'POST');
			if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0 && $movieID > 0)
				removeMovieSeen($_SESSION['userID'], $movieID);
			// On redirigera vers la page index automatiquement
			break;
		case 'AddMovieInToWatchList':
			$movieID = valider("movieID", 'POST');
			$request = valider("request", 'POST');

			if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0 && $movieID > 0)
				addMovieToSee($_SESSION['userID'], $movieID);

			// On redirigera vers la page index automatiquement
			break;
		case 'RemoveMovieFromToWatchList':
			$movieID = valider("movieID", 'POST');

			if (isset($_SESSION['userID']) && $_SESSION['userID'] > 0 && $movieID > 0)
				removeMovieToSee($_SESSION['userID'], $movieID);

			// On redirigera vers la page index automatiquement
			break;
		case 'UpdateProfile':
			// On redirigera vers la page index automatiquement
			break;
		case 'DeleteProfile':
			// On redirigera vers la page index automatiquement
			break;
		case 'AddComment':
			$movieID = valider("movieID", 'POST');
			$comment = valider("content", 'POST');

			// On vérifie que le commentaire n'est pas vide
			if ($movieID && isset($_SESSION['userID']) && $comment && $comment != "") {
				// On ajoute le commentaire
				addComment($_SESSION['userID'], $movieID, $comment);
			}
			$qs = "?view=movie&movieID=$movieID";
			break;
		case 'DeleteComment':
			$commentID = valider("commentID", 'POST');
			$movieID = valider("movieID", 'POST');
			
			if ($commentID && isset($_SESSION['userID'])) {
				// On supprime le commentaire
				deleteComment($commentID);
			}
			$qs = "?view=movie&movieID=$movieID";
			break;
		case 'UpdateComment':
			// On redirigera vers la page index automatiquement
			break;
		case 'UpdateReaction' : 
			$commentID = valider("commentID", 'POST');
			$movieID = valider("movieID", 'POST');

			if ($commentID && isset($_SESSION['userID'])) {
				// On ajoute le commentaire
				if (userHasAlreadyReacted($commentID, $_SESSION['userID']))
					deleteReaction($commentID, $_SESSION['userID']);
				else
				addReaction($commentID, $_SESSION['userID']);
			}
			$qs = "?view=movie&movieID=$movieID";
			break;
		case 'AddReply':
			$movieID = valider("movieID", 'POST');
			$commentID = valider("commentID", 'POST');
			$reply = valider("reply", 'POST');

			// On vérifie que le commentaire n'est pas vide
			if ($commentID && isset($_SESSION['userID']) && $reply && $reply != "") {
				// On ajoute le commentaire
				addReply($_SESSION['userID'], $commentID, $reply);
			}
			$qs = "?view=movie&movieID=$movieID";

			// On redirigera vers la page index automatiquement
			break;
		case 'DeleteReply':
			$replyID = valider("replyID", 'POST');
			$movieID = valider("movieID", 'POST');

			if ($replyID && isset($_SESSION['userID'])) {
				// On ajoute le commentaire
				deleteReply($replyID);
			}

			$qs = "?view=movie&movieID=$movieID";
			// On redirigera vers la page index automatiquement
			break;
		case 'UpdateReply':
			// On redirigera vers la page index automatiquement
			break;
		case 'UpdateReactionReply':
			$replyID = valider("replyID", 'POST');
			$movieID = valider("movieID", 'POST');

			if ($replyID && isset($_SESSION['userID'])) {
				// On ajoute le commentaire
				if (userHasAlreadyReactedReply($replyID, $_SESSION['userID']))
					deleteReplyReaction($replyID, $_SESSION['userID']);
				else
				addReplyReaction($replyID, $_SESSION['userID']);
			}
			$qs = "?view=movie&movieID=$movieID";
			break;
		case 'EditCommentFromMesMessages':
			/*// L'id du commentaire sera dans le lien : ?action=EditCommentFromMesMessages&commentID=...
			$commentID = valider("commentID", "GET");

			if ($commentID && isset($_SESSION['userID'])) {
				// On supprime le commentaire
				$comment = getComment($commentID);
				$qs = "?view=editComment&commentID=$commentID&movieID=" . $comment['movieID'];
			}*/
			$qs = "?view=mesMessages";
			break;
		case 'DeleteCommentFromMesMessages':
			// L'id du commentaire sera dans le lien : ?action=DeleteCommentFromMesMessages&commentID=...
			$commentID = valider("commentID", "GET");

			if ($commentID && isset($_SESSION['userID'])) {
				// On supprime le commentaire
				deleteComment($commentID);
			}
			$qs = "?view=mesMessages";
			break;
		case 'EditReplyFromMesMessages':
			// L'id du commentaire sera dans le lien : ?action=EditReplyFromMesMessages&replyID=...
			$replyID = valider("replyID", "GET");

			$qs = "?view=mesMessages";
			break;
		case 'DeleteReplyFromMesMessages':
			// L'id du commentaire sera dans le lien : ?action=DeleteReplyFromMesMessages&replyID=...
			$replyID = valider("replyID", "GET");

			if ($replyID && isset($_SESSION['userID'])) {
				// On supprime le commentaire
				deleteReply($replyID);
			}
			$qs = "?view=mesMessages";
			break;
	}
}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat
$urlBase = dirname($_SERVER["HTTP_HOST"]) . dirname($_SERVER["PHP_SELF"]) . "index.php";
// On redirige vers la page index avec les bons arguments
header("Location:" . $urlBase . $qs);
// On écrit seulement après cette entête
ob_end_flush();
