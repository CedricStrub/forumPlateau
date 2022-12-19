<?php

$topics = $result["data"]['sujets'];
    
?>

<h1>liste Sujets</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitre()?></p>
    <?php
}
