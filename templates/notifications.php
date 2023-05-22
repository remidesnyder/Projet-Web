<?php

if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location: ../index.php?view=accueil");
	die("");
}

$myNotifications = getAllNotifications($_SESSION['userID']);

?>

<section></section>

<section>
    <h2>Mes Notifications</h2>
    <?php if (empty($myNotifications)) : ?>
        <p>Vous n'avez pas encore de notification.</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($myNotifications as $notification) : ?>
                    <tr>
                        <td><?= $notification['title'] ?></td>
                        <td><?= $notification['content'] ?></td>
                        <td><a href="controleur.php?action=DeleteNotification&notificationID=<?= $notification['id'] ?>">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>