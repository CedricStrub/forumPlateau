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
    <table> 
    <tr>
    
    <h1>Liste Messages : <?=$sujet->getTitre()?> </h1>
    <?php
    if(App\Session::getUser()){
        if (App\Session::getUser()->getId() == $sujet->getMembre()->getId()) {
            if($sujet->getVerrouillage() == 0){
                ?>
                <td> <div class="sw1"></div> </td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=editerSujet&id=<?=$sujet->getId()?>"> 🖉</a></td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=verrouiller&id=<?=$sujet->getId()?>"> 🔓</a></td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>"> 🗑</a></td>
                <?php
            }else{
                ?>
                <td> <div class="sw1"></div> </td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=editerSujet&id=<?=$sujet->getId()?>"> 🖉</a></td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=deverrouiller&id=<?=$sujet->getId()?>"> 🔒</a></td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerSujet&id=<?=$sujet->getId()?>"> 🗑</a></td>
                <?php
            }
        }
    }
    ?>
    </tr>
    </table>
    </div>
    <?php
    if($messages){
        foreach($messages as $message ){
            if(isset($_SESSION["user"])){
                if($message->getMembre()->getId() == $_SESSION["user"]->getId() && $message->getMembre()->getId() == $sujet->getMembre()->getId()){
                    ?>
                        <div class="msgl">
                            <?=$message->getMembre()->getPseudo()?> le : 
                            <?=$message->getDateCreation()?>
                            <a class="lien" href="./index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>">🗑</a>
                        </div>
                        <div class="msgL"><?=$message->getTexte()?>
                    <?php
                }elseif(App\Session::isAdmin()) {
                    ?>
                        <div class="msgr">
                            <?=$message->getMembre()->getPseudo()?> le : 
                            <?=$message->getDateCreation()?>
                            <a class="lien" href="./index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>">🗑</a>
                        </div>
                        <div class="msgR"><?=$message->getTexte()?>
                    <?php
                }else{
                    if($message->getMembre()->getId() == $sujet->getMembre()->getId()){
                        ?>
                        <div class="msgl">
                            <?=$message->getMembre()->getPseudo()?> le : 
                            <?=$message->getDateCreation()?>
                        </div>
                        <div class="msgL"><?=$message->getTexte()?>
                        <?php
                    }else{
                        if($message->getMembre()->getId() == $_SESSION["user"]->getId()){
                            ?>
                            <div class="msgr">
                                <?=$message->getMembre()->getPseudo()?> le : 
                                <?=$message->getDateCreation()?>
                                <a class="lien" href="./index.php?ctrl=forum&action=supprimerMessage&id=<?= $message->getId() ?>">🗑</a>
                            </div>
                            <div class="msgR">
                                <form action="index.php?ctrl=forum&action=editerMessage" method="post">
                                    <span id="txt_edit" class="textarea" role="textbox" contenteditable><?=$message->getTexte()?></span>
                                    <input id="texte" name="texte" type='text' class='input' hidden/>
                                    <input id="msg" name="msg" type='text' class='input' value="<?= $message->getId() ?>" hidden/>
                                    <button class="edit_btn" type="submit" >Envoyer</button>
                                </form>
                            <?php
                        }else{
                            ?>
                            
                            <div class="msgr">
                                <?=$message->getMembre()->getPseudo()?> le : 
                                <?=$message->getDateCreation()?>
                            </div>
                            <div class="msgR"><?=$message->getTexte()?>
                            <?php
                        }
                    }
                }
            }else{
                if($message->getMembre()->getId() == $sujet->getMembre()->getId()){
                    ?>
                    <div class="msgl">
                        <?=$message->getMembre()->getPseudo()?> le : 
                        <?=$message->getDateCreation()?>
                    </div>
                    <div class="msgL"><?=$message->getTexte()?>
                    <?php
                }else{
                    ?>
                    <div class="msgr">
                        <?=$message->getMembre()->getPseudo()?> le : 
                        <?=$message->getDateCreation()?>
                    </div>
                    <div class="msgR"><?=$message->getTexte()?>
                    <?php
                }
            }
            ?>
            </div>
            <?php
        }

    } else {
        echo "Pas de messages";
    }
    ?>
    <script>
        const edit = document.getElementById("txt_edit")
        edit.addEventListener('keyup', (event) =>{
            console.log(document.getElementById("txt_edit").innerHTML)
            document.getElementById("texte").value = document.getElementById("txt_edit").innerHTML;
        })
    </script>
    <?php
    if(App\Session::getUser()){
        if ($sujet->getVerrouillage() == 0) {
            ?>
        <h1>Répondre</h1>
        <form action="index.php?ctrl=forum&action=addMessage" method="post">
        <table>
        <input type = "hidden" name = "sujet" value = <?= $sujet->getId() ?> />
            <tbody>
                <tr>
                    <td><span class="f_titre">Message</span></td>
                </tr>
                <tr>
                    <td><textarea id="message" name="message" row="10" cols="100" placeholder="message"></textarea></td>
                </tr>
                <tr>
                    <td><input class="nav_btn limit_btn" type="submit" value="Submit"></td>
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