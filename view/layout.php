<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
    
        <div id="mainpage">
            <header>
                <div class="topnav">
                <div class="titre"><span>Forum</span>
                    <a href="/CedricStrub/forumPlateau/">Accueil</a>
                    
                    <?php
                    if(App\Session::getUser()){
                        ?>
                        <a class="split" href="index.php?ctrl=security&action=profil">&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                        <a class="split" href="index.php?ctrl=security&action=deconnexion">Déconnexion</a>
                    <?php
                    }
                    else{
                        ?>
                        <a class="split" href="./view/security/register.php">Inscription</a>
                        <a class="split" href="index.php?ctrl=security&action=connexion">Connexion</a>
                    <?php
                    }
                    ?>
                    </div>
                </div>
                </header>
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <?php
                    if(App\Session::isAdmin()){
                        ?>
                        <a class="btn" href="index.php?ctrl=home&action=users">Voir la liste des gens</a>
                    
                        <?php
                    }
                    ?>
                <a class="btn" href="index.php?ctrl=forum&action=listCategories">la liste des categories</a>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2022/23 - Forum CDA - <a class="btn" href="/home/forumRules.html">Règlement du forum</a> - <a class="btn" href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>
</html>