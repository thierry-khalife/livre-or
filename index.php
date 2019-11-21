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
               <?php
        date_default_timezone_set('Europe/Paris');
        if(isset($_SESSION['login']))
        { 
            echo "<img class=\"guirlandehaut\" src=\"img/dividerguirlande.png\">";
            echo "<img id=\"perenoel\" src=\"img/perenoelfloss.gif\">";
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1><img height=35 width=35 src=\"img/candycane.png\">&nbsp Bonjour ".$_SESSION["login"]."&nbsp <img height=35 width=35 src=\"img/snowmanicon.png\"></h1>";
            echo "<p>Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a href=\"profil.php\">PROFIL</a></p>";
            echo "<p>Ajouter un commentaire dans notre : <a href=\"livre-or.php\">LIVRE D'OR</a></p>";
            echo "<form action=\"index.php\" method=\"post\">
            <input class=\"mybutton\"  name=\"deco\" value=\"Deconnexion\" type=\"submit\" />
            </form>";
            echo "<img class=\"guirlandebas\" src=\"img/dividerguirlandebas.png\">";
        }
        else
        {
            echo "<img class=\"guirlandehaut\" src=\"img/dividerguirlande.png\">";
            echo "<img id=\"perenoel\" src=\"img/perenoelfloss.gif\">";
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1><img height=35 width=35 src=\"img/candycane.png\">&nbsp Bonjour Guest &nbsp <img height=35 width=35 src=\"img/snowmanicon.png\"></h1>";
            echo "<p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href=\"connexion.php\">CONNEXION</a></p>";
            echo "<p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href=\"inscription.php\">INSCRIPTION</a></p>";
            echo "<img class=\"guirlandebas\" src=\"img/dividerguirlandebas.png\">";
        }
        
        if (isset($_POST["deco"]))
        {
         session_unset();
         session_destroy();
         header('Location:index.php');
        }
        
        ?>
         </section>
    </main>
    <?php include("footer.php"); ?>
</body>

</html>