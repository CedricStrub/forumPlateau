<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<?php
if(App\Session::getUser()){}
else{
    ?>
<p>
    <a href="./view/security/login.php">Se connecter</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="./view/security/register.php">S'inscrire</a>
</p>
<?php
}
?>