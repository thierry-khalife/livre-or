<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>
    <title>Livre D'OR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <section class="leftsidebar">
            <img class="guirlandehaut" src="img/dividerguirlande.png">
        <?php
        date_default_timezone_set('Europe/Paris');
        if(isset($_SESSION['login']))
        {
            ?>
            <img id="perenoel" src="img/perenoelfloss.gif">
            <?php
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1><img id=\"icones\" src=\"img/candycane.png\">&nbsp Bonjour ".$_SESSION["login"]."&nbsp <img id=\"icones\" src=\"img/snowmanicon.png\"></h1>";
            echo "<p>Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a href=\"profil.php\">PROFIL</a></p>";
            ?>
            <p>Ajouter un <a href="commentaire.php">COMMENTAIRE</a> dans notre : <a href="livre-or.php">LIVRE D'OR</a></p>
            <form action="index.php" method="post">
                <input class="mybutton"  name="deco" value="Deconnexion" type="submit" />
            </form>
            <?php
        }
        else
        {
            ?>
            <img id="perenoel" src="img/perenoelfloss.gif">
            <?php
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            ?>
            <div id="phrasebvn"><img height=35 width=35 src="img/candycane.png">&nbsp Bonjour Guest &nbsp <img height=35 width=35 src="img/snowmanicon.png"></div>
            <p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href="connexion.php">CONNEXION</a></p>
            <p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href="inscription.php">INSCRIPTION</a></p>
        <?php
        }
        
        if (isset($_POST["deco"]))
        {
         session_unset();
         session_destroy();
         header('Location:index.php');
        }
        ?>
        <img class="guirlandebas" src="img/dividerguirlandebas.png">
         </section>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>