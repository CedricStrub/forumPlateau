<h1>Profil de <?= $_SESSION['user']->getPseudo()?></h1>

<?php
$sujets = $result['data']['sujet'];
$messages = $result['data']['message'];
?>

<h2>Derniers sujet crée :</h2>
<?php
foreach($sujets as $sujet ){
    ?>
    <p><?=$sujet->getTitre()?></p>
    <?php
}
?>


<h2>Derniers messages publié :</h2>
<?php
foreach($messages as $message ){
    ?>
    <p><?=$message->getTexte()?></p>
    <?php
}