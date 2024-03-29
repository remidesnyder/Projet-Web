<?php 

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php");
    die("");
}

include_once 'libs/modele.php';

$getAllReportUntreated = getAllReportUntreated();

?>

<section></section>

<section class="sidebar">
    <h1 class="adminTitle"><a href="?view=adminSearchUser">Rechercher un utilisateur</a></h1>
    <br />
    <h2 class="adminTitle"><a href="?view=adminTreatWarn">Signalements</a></h2>
    <br />
</section>

<section>
    <h1 class="adminTitle">Administration</h1>
    <br />
    <h2 class="adminTitle">Signalements</h2>
    <br />
    <?php if(empty($getAllReportUntreated)) { ?>
        <p class="adminText">Il n'y a aucun signalement à traiter.</p>
    <?php } else { ?>
        <div class="adminTitle">
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Commentaire</th>
                    <th>Signalé le</th>
                    <th>Supprimer le report</th>
                    <th>Supprimer le commentaire et avertir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($getAllReportUntreated as $data) : ?>
                    <tr>
                        <td><?= $data['authorName'] ?></td>
                        <td><?= $data['commentContent'] ?></td>
                        <td><?= $data['reported_at'] ?></td>
                        <td>
                            <a href="controleur.php?action=deleteReport&reportID=<?= $data['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                        <td>
                            <a href="controleur.php?action=TreatReport&reportID=<?= $data['id'] ?>" class="btn btn-danger">Supprimer le commentaire</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php } ?>
</section>