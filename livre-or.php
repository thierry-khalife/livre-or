<?php session_start(); 

$cnx = mysqli_connect("localhost", "root", "", "livreor");
$requete1 = "SELECT * FROM commentaires";
$query1 = mysqli_query($cnx, $requete1);
$resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);



?>

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
          <h1>LIVRE D'OR</h1>
          <?php

          $taille = sizeof($resultat) - 1;
          $a = 0;
          while ($a <= $taille) {
              $datesql = $resultat[$a]['date'];
              $newdate = date('d-m-Y à H:i:s', strtotime($datesql));
              $iduser = $resultat[$a]['id_utilisateur'];
              $requetelogin = "SELECT login FROM utilisateurs WHERE id=$iduser";
              $query2 = mysqli_query($cnx, $requetelogin);
              $resultatlogin = mysqli_fetch_all($query2, MYSQLI_ASSOC);
              echo "<article id=\"commentaire\">";
              echo "<b><i>Posté le : </i></b>".$newdate;
              echo "<b><i> par : </i></b><u>".$resultatlogin[0]["login"]."</u><br>";
              echo $resultat[$a]['commentaire']."<br><img id=\"divider\" src=\"img/div.png\">";
              echo "<br>";
              echo "</article>";
              $a++;
          }
          if (!empty($_SESSION['login'])) 
          {
            echo "<p>Vous êtes connecté en tant qu'utilisateur. Ajouter un commentaire en visitant la page <a href=\"commentaire.php\">COMMENTAIRE</a></p>";
          }
        echo "<img class=\"guirlandebas\" src=\"img/dividerguirlandebas.png\">";
        ?>
        </section>
        <section class="rightsidebar">
       
        <?php
    
        date_default_timezone_set('Europe/Paris');
        if(isset($_SESSION['login']))
        { 
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1><img id=\"icones\" src=\"img/candycane.png\">&nbsp Bonjour ".$_SESSION["login"]."&nbsp <img id=\"icones\" src=\"img/snowmanicon.png\"></h1>";
            echo "<p>Vous êtes connecté en tant qu'utilisateur :</p>";
            echo "<p>Accédez à votre page de <a href=\"profil.php\">PROFIL</a>&nbsp&nbsp&nbsp&nbsp</p>";
            echo "<p>Ajouter un commentaire en visitant la page <a href=\"commentaire.php\">COMMENTAIRE</a></p><br>";
            echo "<form action=\"index.php\" method=\"post\">
            <input class=\"mybutton\"  name=\"deco\" value=\"Deconnexion\" type=\"submit\" />
            </form>";
        }
        else
        {
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<h1><img id=\"icones\" src=\"img/candycane.png\">&nbsp Bonjour Guest&nbsp <img id=\"icones\" src=\"img/snowmanicon.png\"></h1>";
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
<?php include("footer.php"); 
mysqli_close($cnx);?>
</body>

</html>