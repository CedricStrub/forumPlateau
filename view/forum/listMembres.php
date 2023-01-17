<?php
use Model\Managers\MembreManager;

$users = $result["data"]['users'];
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
        }else $lock = 1;
        foreach($categories as $categorie ){
            $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
            ?>
            <tr>
            <td><a class="lien" href=<?=$link?>><?=$categorie->getNom()?></a></td>
            
            <?php
            if (App\Session::isAdmin() && $lock == 0) {
                ?>
                <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerCategorie&id=<?= $categorie->getId() ?>"> 🗑</a></td>
                <td><a class="lien" href="./index.php?ctrl=forum&action=editCategorie&id=<?= $categorie->getId() ?>">🖉</a></td>
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
    <div class="center">
    <h1>BIENVENUE SUR LE FORUM</h1>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

    <?php
    if(App\Session::getUser()){}
    else{
        ?>
    <p>
        <a class="btn" href="index.php?ctrl=security&action=connexion">Se connecter</a>
        <span>&nbsp;-&nbsp;</span>
        <a class="btn" href="index.php?ctrl=security&action=inscription">S'inscrire</a>
    </p>
    <?php
    }
    ?>
    </div>
    <div class="right  ext_cat">
        <?php
        if(App\Session::isAdmin() && $lock == 0){
            ?>
            <a href="index.php?ctrl=home&action=users">
            <button class="nav_btn">Voir la liste des Membres</button>
            
            </a>
            <table>
            <tbody>
            <?php
            foreach($users as $user ){
                ?>

                <tr>
                    <td><span><?=$user->getPseudo()?></span></td>
                <?php
                if($user->getVerrouiller() == 0){
                    ?>
                    <td><a class="lien" href="index.php?ctrl=home&action=verrouiller&id=<?= $user->getId() ?>"> 🔓</a></td>
                    <?php
                }else{
                    ?>
                    <td><a class="lien" href="index.php?ctrl=home&action=deverrouiller&id=<?= $user->getId() ?>"> 🔒</a></td>
                    <?php
                }
                ?>
                <td><a class="lien" href="index.php?ctrl=security&action=supprimerMembre&id=<?=$user->getId()?>"> 🗑</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            </table>
            <?php
        }
        ?>
    </div>
</div>