<?php
    use Model\Managers\MembreManager;

    $categories = $result["data"]['categories'];
    $edit = $result["data"]["edit"]
        
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
                
                ?>
                <tr>
                    <?php
                    if ($categorie->getId() == $edit) {
                        ?>
                        <td><form action="index.php?ctrl=forum&action=editerCategorie" method="post">
                            <span id="txt_edit" class="txt-input" role="textbox" contenteditable><?= $categorie->getNom() ?></span>
                            <input id="texte" name="texte" type='text' class='input' hidden/>
                            <input id="msg" name="msg" type='text' class='input' value="<?= $categorie->getId() ?>" hidden/>
                            <td><button class="edit_btn" type="submit">Envoyer</button></td>
                        </form></td>
                        <script>
                            const edit = document.getElementById("txt_edit")
                            document.getElementById("texte").value = edit.innerText;
                            edit.addEventListener('keyup', (event) =>{
                                document.getElementById("texte").value = edit.innerText;
                                console.log(edit.innerText)
                            })
                        </script>
                    <?php
                    }else{
                        $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
                        ?>
                        <td><a class="lien" href=<?=$link?>><?=$categorie->getNom()?></a></td>
                        <?php
                    }
                    if (App\Session::isAdmin() && $lock == 0) {
                        if ($categorie->getId() != $edit) {
                            ?>
                        <td><a class="lien" href="./index.php?ctrl=forum&action=editCategorie&id=<?= $categorie->getId() ?>">????</a></td>
                        <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerCategorie&id=<?= $categorie->getId() ?>"> ????</a></td>
                        <?php
                        } else {
                            ?>
                        <td><a class="lien" href="./index.php?ctrl=forum&action=supprimerCategorie&id=<?= $categorie->getId() ?>"> ????</a></td>
                        <?php
                        }
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
                <h1>Ajouter Cat??gorie</h1>
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