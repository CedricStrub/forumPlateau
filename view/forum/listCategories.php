<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $categorie ){
    $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
    ?>
    <a href=<?=$link?>><?=$categorie->getNom()?></a>
    <?php
    if (App\Session::isAdmin()) {
        ?>
        <a href="./index.php?ctrl=forum&action=supprimerCategorie&id=<?= $categorie->getId() ?>">Supprimer</a>
    <?php
    }
    ?>
    <br>
    <?php
}

if(App\Session::isAdmin()){
    ?>
    <h1>Ajouter Catégorie</h1>
    <form action="index.php?ctrl=forum&action=addCategorie" method="post">
    <table>
        <tbody>
            <tr>
                <td><span>Nom</span></td>
            </tr>
            <tr>
                <td><input type="text" id="nom" name="nom" placeholder="nom"></td>
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