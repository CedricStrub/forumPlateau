<div class="navigation">
    <div class="left">
        <a href="index.php?ctrl=forum&action=listCategories">
        <button class="nav_btn" type="button" >la liste des categories</button>
        </a>
    </div>
    <div class="center">
    <div class="C_content">
    <h1>Connexion</h1>
    </div>
    <div class="C_content">
    <form action="index.php?ctrl=security&action=login" method="post">
    <table>
        <tbody>
            <tr>
                <td><span class="f_titre">Pseudo</span></td>
            </tr>
            <tr>
                <td><input type="text" id="pseudo" name="pseudo" placeholder="pseudo"></td>
            </tr>
            <tr>
                <td><span class="f_titre">Password</span></td>
            </tr>
            <tr>
                <td><input type="password" id="password" name="password" placeholder="password"></td>
            </tr>
            <tr>
                <td><input class="nav_btn" type="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
    </form>
    </div>
    <div class="spacer2"></div>
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