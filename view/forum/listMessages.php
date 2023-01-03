<?php

$messages = $result["data"]['messages'];
$sujet = $result["data"]["sujet"];

$link = "./index.php?ctrl=forum&action=listSujets&id=" . $sujet->getCategorie()->getId();
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
    }

} else {
    echo "Pas de messages";
}