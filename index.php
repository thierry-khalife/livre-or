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
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1>Bonjour ".$_SESSION["login"]."</h1><br>";

            if($_SESSION['login'] == "admin"){
                echo "<p>Vous êtes connecté en tant qu'administrateur et vous avez accès à la page <a href=\"admin.php\">ADMIN PANEL</a></p>";
            }
            else{
                echo "<p>Vous êtes connecté en tant qu'utilisateur. Accédez à votre page de <a href=\"profil.php\">PROFIL</a></p>";
                echo "<p>Ajouter un commentaire dans notre : <a href=\"livre-or.php\">LIVRE D'OR</a></p>";
            }

            echo "<form action=\"index.php\" method=\"post\">
            <input class=\"mybutton\"  name=\"deco\" value=\"Deconnexion\" type=\"submit\" />
            </form>";
        }
        else
        {
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1>Bonjour Guest</h1>";
            echo "<p>Pour pouvoir accéder à votre profil veuillez visiter la page : <a href=\"connexion.php\">CONNEXION</a></p>";
            echo "<p>Pas de compte ? Inscrivez-vous en remplissant le formulaire : <a href=\"inscription.php\">INSCRIPTION</a></p>";
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