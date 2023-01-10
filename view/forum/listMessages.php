<?php

$messages = $result["data"]['messages'];
$sujet = $result["data"]["sujet"];
$categories = $result["data"]['categories'];

$link = "./index.php?ctrl=forum&action=listSujets&id=" . $sujet->getCategorie()->getId();
?>

<div class="navigation">
    <div class="left ext_cat">
        <a href="index.php?ctrl=forum&action=listCategories">
        <button class="nav_btn" type="button" >la liste des categories</button>
        </a>
        <div class="spacer2"></div>
        <div class="C_content">
        <table>
        <tbody>
        <?php
        foreach($categories as $categorie ){
            $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
            ?>
            <tr>
            <td><a class="lien" href=<?=$link?>><?=$categorie->getNom()?></a></td>
            
            <?php
            if (App\Session::isAdmin()) {
                ?>
                <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerCategorie&id=<?= $categorie->getId() ?>"> 🗑</a></td>
            <?php
            }
            ?>
            </tr>
            <br>
            <?php
        }
        ?>
        </tbody> 
        </table>
        </div>
        <div class="spacer2"></div>
        <?php
        if(App\Session::isAdmin()){
            ?>
            <div class="C_content  ext_cat">
            <h1>Ajouter Catégorie</h1>
            </div>
            <div class="C_content">
            <form action="index.php?ctrl=forum&action=addCategorie" method="post">
            <table>
                <tbody>
                    <tr>
                        <td><span class="f_titre">Nom</span></td>
                    </tr>
                    <tr>
                        <td><input type="text" id="nom" name="nom" placeholder="nom"></td>
                    </tr>
                    <tr>
                        <td><input class="nav_btn" type="submit" value="Submit"></td>
                    </tr>
                </tbody>
            </table>
            </form>
            </div>
            <div class="spacer2"></div>
            <?php
        }

        ?>
    </div>
    <div class="center">
    <div class="C_content  ext_cat">
    <h1>Liste Messages : <?=$sujet->getTitre()?></h1>
    <?php
    if(App\Session::getUser()){
        if (App\Session::getUser()->getId() == $sujet->getMembre()->getId()) {
            if($sujet->getVerrouillage() == 0){
                ?>
                <a class="lien" href="./index.php?ctrl=forum&action=verrouiller&id=<?=$sujet->getId()?>">🔓</a>
                <a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">🗑</a>
                <?php
            }else{
                ?>
                <a class="lien" href="./index.php?ctrl=forum&action=deverrouiller&id=<?=$sujet->getId()?>">🔒</a>
                <a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>">🗑</a>
                <?php
            }
        }
    }
    ?>
    </div>
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
                    <td><input class="nav_btn" type="submit" value="Submit"></td>
                </tr>
            </tbody>
        </table>
        </form>
        <?php
        }
    }

    ?>

    </div>
    <div class="right">
        <?php
        if(App\Session::isAdmin()){
            ?>
            <a href="index.php?ctrl=home&action=users">
            <button class="nav_btn">Voir la liste des Membres</button>
            </a>
            <?php
        }
        ?>
    </div>
</div>