<?php

$sujets = $result["data"]['sujets'];
    
?>

<h1>liste Sujets</h1>

<?php
foreach($sujets as $sujet ){
    $link = "./index.php?ctrl=forum&action=listMessages&id=" . $sujet->getId();
    ?>
    <a href=<?=$link?>><?=$sujet->getTitre()?></a><br>
    <?php
}
