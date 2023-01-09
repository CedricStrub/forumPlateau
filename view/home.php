<div class="navigation">
    <div class="left">
        <a href="index.php?ctrl=forum&action=listCategories">
        <button class="nav_btn" type="button" >la liste des categories</button>
        </a>
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
