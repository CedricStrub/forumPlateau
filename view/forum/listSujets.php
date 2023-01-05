<?php

$sujets = $result["data"]['sujets'];
$categorie = $result["data"]["categorie"];

?>


<h1>liste Sujets</h1>
<h2><a href="./index.php?ctrl=forum&action=listCategories">Categorie</a><?=" : ".$categorie->getNom()?></h2>

<?php
if (isset($sujets)) {
    foreach ($sujets as $sujet) {
        $link = "./index.php?ctrl=forum&action=listMessages&id=" . $sujet->getId();
    ?>
    <a href=<?= $link ?>><?= $sujet->getTitre() ?></a>
        <?php
        if(App\Session::isAdmin()){
            ?>
            <a href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">Supprimer</a>
            <?php
        }elseif(isset($_SESSION["user"])){
            if($sujet->getMembre()->getId() == $_SESSION["user"]->getId()){
                ?>
                <a href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">Supprimer</a>
                <?php
            }
        }
        ?>
        <br>
    <?php
    }
}
else{
    ?>
    <p>aucun resultat</p>
    <?php
}

if(App\Session::getUser()){
    ?>
    <h1>Nouveau Sujet</h1>
    <form action="index.php?ctrl=forum&action=addSujet" method="post">
    <table>
    <input type = "hidden" name = "categorie" value = <?=$categorie->getId()?> />
        <tbody>
            <tr>
                <td><span>Titre</span></td>
            </tr>
            <tr>
                <td><input type="text" id="titre" name="titre" placeholder="titre"></td>
            </tr>
            <tr>
                <td><span>Message</span></td>
            </tr>
            <tr>
                <td><input type="textarea" id="message" name="message" placeholder="message"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
    </form>
    <?php
}
?>

