<?php

$myComment = getAllCommentsByUser($_SESSION['userID']);
$myReplies = getAllRepliesByUser($_SESSION['userID']);

?>

<section></section>

<section>
    <h2>Mes commentaires</h2>
    <?php if (empty($myComment)) : ?>
        <p>Vous n'avez pas encore commenté d'article.</p>
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
                <?php foreach ($myComment as $comment) : ?>
                    <tr>
                        <td><?= $comment['title'] ?></td>
                        <td><?= $comment['content'] ?></td>
                        <td><?= $comment['reactions'] ?></td>
                        <td><a href="index.php?page=editComment&id=<?= $comment['id'] ?>">Modifier</a></td>
                        <td><a href="index.php?page=deleteComment&id=<?= $comment['id'] ?>">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<section>
    <h2>Mes réponses</h2>
    <?php if (empty($myReplies)) : ?>
        <p>Vous n'avez pas encore répondu à un commentaire.</p>
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
                <?php foreach ($myReplies as $reply) : ?>
                    <tr>
                        <td><?= $reply['title'] ?></td>
                        <td><?= $reply['content'] ?></td>
                        <td><?= $reply['reactions'] ?></td>
                        <td><a href="index.php?page=editReply&id=<?= $reply['id'] ?>">Modifier</a></td>
                        <td><a href="index.php?page=deleteReply&id=<?= $reply['id'] ?>">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<!-- 
    TODO
    Add pagination ? 
-->