<?php

$categories = $result["data"]['categories'];
    
?>

<h1>liste Categories</h1>

<?php
foreach($categories as $categorie ){
    $link = "./index.php?ctrl=forum&action=listSujets&id=" . $categorie->getId();
    ?>
    <a href=<?=$link?>><?=$categorie->getNom()?></a><br>
    <?php
}