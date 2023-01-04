<?php

$sujets = $result["data"]['sujets'];
$categorie = $result["data"]["categorie"];

if(App\Session::getUser()){
    ?>
    <a href="./index.php?ctrl=forum&action=newSujet">Nouveau</a>
    <?php
}
?>


<h1>liste Sujets</h1>
<h2><a href="./index.php?ctrl=forum&action=listCategories">Categorie</a><?=" : ".$categorie->getNom()?></h2>

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
