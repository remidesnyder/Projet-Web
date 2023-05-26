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
					$userID = getUserByUsername($login)['id'];
					if (userIsBlocked($userID)) {
						$qs = "?view=login&error=" . urldecode("Votre compte est bloqué");
						break;
					}
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
			$whatUpdate = valider("whatUpdate", 'POST');
			
			if ($_SESSION['userID'] && $whatUpdate) {
				switch ($whatUpdate) {
					case 'username':
						$username = valider("login", 'POST');
						if ($username && $username != "")
							changeUsername($_SESSION['userID'], $username);
						break;
					case 'password':
						$password = valider("passe", 'POST');
						if ($password && $password != "")
							changePassword($_SESSION['userID'], $password);
						break;
					case 'image':
						$image = $_FILES['image'];
						if (isset($image) && $image['error'] == 0)
							changeProfilImage($_SESSION['userID'], $image);
						break;
				}
			}

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
		case 'VoteForActor':
			$movieID = valider("movieID", "GET");
			$actorID = valider("actorID", "GET");

			if ($movieID && $actorID && isset($_SESSION['userID'])) {
				addVoteActor($_SESSION['userID'], $movieID, $actorID);
			}
			$qs = "?view=movie&movieID=$movieID";
			break;
		case 'Notifications':
			$notificationID = valider("notificationID", "GET");

			if (notificationIsUnRead($notificationID)) {
				markAsRead($notificationID);
			}

			$notification = getNotification($notificationID)[0];

			if (isset($notification['redirection'])) {
				$qs = $notification['redirection'];
			} else {
				$qs = "?view=notifications";
			}

			break;
		case 'DeleteNotification':
			$notificationID = valider("notificationID", "GET");

			if ($notificationID && isset($_SESSION['userID'])) {
				deleteNotification($notificationID);
			}
			$qs = "?view=notifications";
			break;
		case 'AdminSearch':
			$username = valider('username', 'GET');
			if (!$username) { $qs="?view=admin"; break; }
			$qs = "?view=adminSearchUser&username=$username";
			break;
		case 'ReportComment':
			$commentID = valider("commentID", "GET");
			$movieID = valider("movieID", "GET");
			$authorID = valider("authorID", "GET");

			if ($commentID && $authorID && isset($_SESSION['userID'])) {
				reportComment($commentID, $authorID ,$_SESSION['userID']);
			}

			$qs = "?view=movie&movieID=$movieID";

			break;
		case 'RemoveMovieFromFavoriteList':
			$movieID = valider("movieID", "POST");

			if ($movieID && isset($_SESSION['userID'])) {
				removeFavoriteMovie($_SESSION['userID'], $movieID);
			}

			$qs = "?view=movie&movieID=$movieID";

			break;
		case 'AddMovieInFavoriteList':
			$movieID = valider("movieID", "POST");

			if ($movieID && isset($_SESSION['userID'])) {
				addFavoriteMovie($_SESSION['userID'], $movieID);
			}

			$qs = "?view=movie&movieID=$movieID";

			break;
		case 'deleteReport':
			$reportID = valider("reportID", "GET");

			if ($reportID && isset($_SESSION['userID'])) {
				deleteReport($reportID);
			}

			$qs = "?view=adminTreatWarn";

			break;
		case 'TreatReport':
			// On ajoute un warn à l'utilisateur du commentaire
			// On cache le commentaire

			$reportID = valider("reportID", "GET");
			$authorID = getAuthorIDOfReport($reportID);
			$commentID = getCommentIDOfReport($reportID);

			if ($reportID && $authorID && $commentID && isset($_SESSION['userID']) && isAdmin($_SESSION['userID'])) {
				addWarn($authorID, "Votre commentaire a été signalé et caché par un modérateur.", $commentID);
				hideComment($commentID);
				treatReport($reportID);
			}

			$qs = "?view=adminTreatWarn";
			break;
		case 'AdminUnblockUser':
			$userID = valider("userID", "GET");
			$pseudo = valider("pseudo", "GET");

			if ($userID && isset($_SESSION['userID']) && isAdmin($_SESSION['userID'])) {
				unblockUser($userID);
			}

			$qs = "?view=adminSearchUser&username=$pseudo";
			break;
		case 'AdminBlockUser':
			$userID = valider("userID", "GET");
			$pseudo = valider("pseudo", "GET");

			if ($userID && isset($_SESSION['userID']) && isAdmin($_SESSION['userID'])) {
				blockUser($userID);
			}

			$qs = "?view=adminSearchUser&username=$pseudo";
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
