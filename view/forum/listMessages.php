<?php

$messages = $result["data"]['messages'];
$sujet = $result["data"]["sujet"];

$link = "./index.php?ctrl=forum&action=listSujets&id=" . $sujet->getCategorie()->getId();

if(App\Session::getUser()){
    if (App\Session::getUser()->getId() == $sujet->getMembre()->getId()) {
        if($sujet->getVerrouillage() == 0){
            ?>
            <a href="./index.php?ctrl=forum&action=verrouiller&id=<?=$sujet->getId()?>">Verrouiller</a>
            <a href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">Supprimer</a>
            <?php
        }else{
            ?>
            <a href="./index.php?ctrl=forum&action=deverrouiller&id=<?=$sujet->getId()?>">DéVerrouiller</a>
            <a href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">Supprimer</a>
            <?php
        }
    }
}
?>

<h1>Liste Messages</h1>
<h2><a href="./index.php?ctrl=forum&action=listCategories">Categorie</a> : 
    <a href=<?=$link?>><?=$sujet->getCategorie()->getNom()?></a> : <?=$sujet->getTitre()?></h2>


<?php
if($messages){
    foreach($messages as $message ){
        ?>
        <p><?=$message->getTexte()?></p>
        <?php
        if (App\Session::isAdmin()) {
            ?>
            <a href="./index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>">Supprimer</a>
        <?php
        }
        elseif(isset($_SESSION["user"])){
            if($message->getMembre()->getId() == $_SESSION["user"]->getId()){
                ?>
                <a href="./index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>">Supprimer</a>
                <?php
            }
        }
    }

} else {
    echo "Pas de messages";
}

if(App\Session::getUser()){
    if ($sujet->getVerrouillage() == 0) {
        ?>
    <h1>Répondre</h1>
    <form action="index.php?ctrl=forum&action=addMessage" method="post">
    <table>
    <input type = "hidden" name = "sujet" value = <?= $sujet->getId() ?> />
        <tbody>
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
}

?>