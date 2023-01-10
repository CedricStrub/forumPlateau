<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/template.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&display=swap" rel="stylesheet"> 
    <title>FORUM</title>
</head>
<body>

            <header>
                <div class="topnav">
                <div class="titre"><span>Forum</span>
                    <a class="btn" href="/CedricStrub/forumPlateau/index.php">Accueil</a>
                    
                    <?php
                    if(App\Session::getUser()){
                        ?>
                        <a class="split btn" href="index.php?ctrl=security&action=profil">&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                        <a class="split btn" href="index.php?ctrl=security&action=deconnexion">Déconnexion</a>
                    <?php
                    }
                    else{
                        ?>
                        <a class="split btn" href="index.php?ctrl=security&action=inscription">Inscription</a>
                        <a class="split btn" href="index.php?ctrl=security&action=connexion">Connexion</a>
                    <?php
                    }
                    ?>
                    </div>
                </div>
                </header>
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <div class="botnav" id="botnav">
                <span>2022/23 - Forum CDA</span>
                <a class="btn" href="/home/forumRules.html">Règlement du forum</a>
                <a class="btn" href="">Mentions légales</a>
                <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
            </div>
        </footer>
        <script>
            var prevScrollpos = window.pageYOffset;
            window.onscroll = function() {
                var currentScrollPos = window.pageYOffset;
                if (prevScrollpos > currentScrollPos) {
                    document.getElementById("botnav").style.bottom = "0";
                } else {
                    document.getElementById("botnav").style.bottom = "-100px";
                }
                prevScrollpos = currentScrollPos;
            }
        </script>

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