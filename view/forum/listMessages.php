<?php

$messages = $result["data"]['messages'];
    
?>

<h1>liste Messages</h1>

<?php
foreach($messages as $message ){
    ?>
    <p><?=$message->getTexte()?></p>
    <?php
}