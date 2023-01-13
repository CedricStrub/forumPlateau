<?php
use Model\Managers\MembreManager;

$sujets = $result["data"]['sujets'];
$cat = $result["data"]["categorie"];
$categories = $result["data"]['categories'];

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
        if(App\Session::getUser()){
            $managerMembre = new MembreManager;
            $lock = $managerMembre->findOneById($_SESSION["user"]->getId())->getVerrouiller();
        }
        foreach($categories as $categorie ){
            $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
            ?>
            <tr>
            <td><a class="lien" href=<?=$link?>><?=$categorie->getNom()?></a></td>
            
            <?php
            if (App\Session::isAdmin() && $lock == 0) {
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
            if(App\Session::isAdmin() && $lock == 0){
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
        <div class="spacer2"></div>
        <div class="center">
        <div class="C_content  ext_cat">
        <h1>Sujets dans la Categorie <?=" : ".$cat->getNom()?></h1>
        </div>
        <div class="spacer2"></div>
        <table>
        <tbody>
        <?php
        if (isset($sujets)) {
            foreach ($sujets as $sujet) {
                $link = "./index.php?ctrl=forum&action=listMessages&id=" . $sujet->getId();
            ?>
            <tr>
                <td><a class="lien" href=<?= $link ?>><?= $sujet->getTitre() ?></a></td>
                <?php
                if(App\Session::isAdmin() && $lock == 0){
                    ?>
                    <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>"> 🗑</a></td>
                    <?php
                    if($sujet->getVerrouillage()){
                        ?>
                        <td><a href="./index.php?ctrl=forum&action=deverrouiller&id=<?=$sujet->getId()?>">🔒</a></td>
                        <?php
                    }else{
                        ?>
                        <td><a href="./index.php?ctrl=forum&action=verrouiller&id=<?=$sujet->getId()?>">🔓</a></td>
                        <?php
                    }
                }elseif(isset($_SESSION["user"]) && $lock == 0){
                    if($sujet->getMembre()->getId() == $_SESSION["user"]->getId()){
                        ?>
                        <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>"> 🗑</a></td>
                        <?php
                    if($sujet->getVerrouillage()){
                        ?>
                        <td><a href="./index.php?ctrl=forum&action=deverrouiller&id=<?=$sujet->getId()?>">🔒</a></td>
                        <?php
                    }else{
                        ?>
                        <td><a href="./index.php?ctrl=forum&action=verrouiller&id=<?=$sujet->getId()?>">🔓</a></td>
                        <?php
                    }
                    }
                }
                ?>
                </tr>
            <?php
            }
            ?>
        </table>
        </tbody>
            <?php
        }
        else{
            ?>
            <p>aucun resultat</p>
            <?php
        }

        if(App\Session::getUser() && $lock == 0){
            ?>
            <div class="spacer2"></div>
            <div class="C_content  ext_cat">
            <h1>Nouveau Sujet</h1>
            </div>
            <form action="index.php?ctrl=forum&action=addSujet" method="post">
            <table>
            <input type = "hidden" name = "categorie" value = <?=$cat->getId()?> />
                <tbody>
                    <tr>
                        <td><span class="f_titre">Titre</span></td>
                    </tr>
                    <tr>
                        <td><input type="text" id="titre" name="titre" placeholder="titre"></td>
                    </tr>
                    <tr>
                        <td><span class="f_titre">Message</span></td>
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
        <div class="spacer2"></div>
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