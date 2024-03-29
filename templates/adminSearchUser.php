<?php 

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}

include_once 'libs/modele.php';

// Une barre de recherche permettra de chercher un utilisateur par son nom
// Et de recuperer la liste de ses commentaires, son profil et ses warns

$userName = valider('username', 'GET');

if ($userName) {
    $user = getUserByUsername($userName);
    if (isset($user)) {
        $comments = getAllCommentsByUser($user['id']);
        $replies = getAllRepliesByUser($user['id']);
        $warns = getAllWarningByUser($user['id']);
        $blocked = userIsBlocked($user['id']);
    }
    
}

?>

<section></section>

<section class="sidebar">
    <h1 class="adminTitle"><a href="?view=adminSearchUser">Rechercher un utilisateur</a></h1>
    <br />
    <h2 class="adminTitle"><a href="?view=adminTreatWarn">Signalements</a></h2>
    <br />
</section>

<section>
    <h1 class="admin">Rechercher un utilisateur</h1>
    <div class="form recherche">
        <form action="controleur.php" method="GET">
            <input type="hidden" name="action" value="AdminSearch">
            <input type="text" id="username" name="username" placeholder="Nom d'utilisateur" value="<?php echo $userName;?>" /><br />
            <input type="submit" value="Rechercher" />
        </form>
    </div>
    <?php  if (isset($user)) : ?>
        <div class="result">
            <div class="actionsUser">
                <h2 class="inf">Actions</h2>
                <br />
                <?php if ($blocked) : ?>
                    <p>Utilisateur bloqué</p>
                    <a href="controleur.php?action=AdminUnblockUser&userID=<?= $user['id'] ?>&pseudo=<?= $userName ?>" class="btn-green btnadmin">Débloquer</a>
                <?php else : ?>
                    <p>Utilisateur non bloqué</p>
                    <a href="controleur.php?action=AdminBlockUser&userID=<?= $user['id'] ?>&pseudo=<?= $userName ?>" class="btn-red btnadmin">Bloquer</a>
                <?php endif; ?>
        
            </div>
            <br>
            <div class="listComments">
                <br />
                <h2 class="inf">Commentaires de <?= $user['username'] ?></h2>
                <br />
                <?php if (empty($comments)) : ?>
                    <p>Il n'a pas encore commenté de film.</p>
                <?php else : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Contenu</th>
                                <th>Like</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment) : ?>
                                <tr>
                                    <td><?= $comment['title'] ?></td>
                                    <td><?= $comment['content'] ?></td>
                                    <td><?= $comment['reactions'] ?></td>
                                    <td><a href="controleur.php?action=EditCommentFromMesMessages&commentID=<?= $comment['id'] ?>" class="btn-orange btnadmin">Modifier</a></td>
                                    <td><a href="controleur.php?action=DeleteCommentFromMesMessages&commentID=<?= $comment['id'] ?>" class="btn-red btnadmin">Supprimer</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <br>
            <div class="listReplies">
                <h2 class="inf">Réponses de <?= $user['username'] ?></h2>
                <br />
                <?php if (empty($replies)) : ?>
                    <p>Il n'a pas encore répondu à un commentaire.</p>
                <?php else : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Contenu</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($replies as $reply) : ?>
                                <tr>
                                    <td><?= $reply['title'] ?></td>
                                    <td><?= $reply['content'] ?></td>
                                    <td><?= $reply['reactions'] ?></td>
                                    <td><a href="controleur.php?action=EditReplyFromMesMessages&replyID=<?= $reply['id'] ?>" class="btn-orange btnadmin">Modifier</a></td>
                                    <td><a href="controleur.php?action=DeleteReplyFromMesMessages&replyID=<?= $reply['id'] ?>" class="btn-red btnadmin">Supprimer</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <div class="profile">
                <h1 class="inf">Photo de profil de <?= $user['username'] ?></h1>
                <br />
                <img src="public/img/<?= getProfilPath($user['id']) ? "profil/" . getProfilPath($user['id']) : "profil/default.jpg" ?>" alt="">
                <h1><?= $user['username'] ?></h1>
            </div>
            <div class="warns">
                <h2 class="inf">Avertissements de <?= $user['username'] ?></h2>
                <br />
                <?php if (empty($warns)) : ?>
                    <p>Il n'a pas encore été averti.</p>
                <?php else : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Contenu</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($warns as $warn) : ?>
                                <tr>
                                    <td><?= $warn['title'] ?></td>
                                    <td><?= $warn['content'] ?></td>
                                    <td><a href="controleur.php?action=DeleteWarnFromMesMessages&warnID=<?= $warn['id'] ?>" class="btn-red btnadmin">Supprimer</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
