<?php

$sujets = $result["data"]['sujets'];


?>

<h1>liste Sujets</h1>

<?php
if (isset($sujets)) {
    foreach ($sujets as $sujet) {
        $link = "./index.php?ctrl=forum&action=listMessages&id=" . $sujet->getId();
    ?>
    <a href=<?= $link ?>><?= $sujet->getTitre() ?></a><br>
    <?php
    }
}
else{
    ?>
    <p>aucun resultat</p>
    <?php
}
