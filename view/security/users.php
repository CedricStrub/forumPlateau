<?php

$users = $result["data"]['users'];
    
?>

<h1>liste des Membres</h1>

<?php
foreach($users as $user ){
    ?>
    <p><?=$user->getPseudo()?></p>
    <?php
}