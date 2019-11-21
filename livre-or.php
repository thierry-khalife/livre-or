<?php session_start(); 

$cnx = mysqli_connect("localhost", "root", "", "livreor");
$requete1 = "SELECT * FROM commentaires";
$query1 = mysqli_query($cnx, $requete1);
$resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);
var_dump($resultat);

$requete2 = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
$query2 = mysqli_query($cnx, $requete2);
$resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
var_dump($resultat2);

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
              $idmoi = $resultat2[0]['id'];
              $idcom = $resultat[$a]['id'];
              $intidmoi = intval($idmoi);
              $intidcom = intval($idcom);
              var_dump($intidcom);
              $requetelogin = "SELECT login FROM utilisateurs WHERE id=$iduser";
              $query2 = mysqli_query($cnx, $requetelogin);
              $resultatlogin = mysqli_fetch_all($query2, MYSQLI_ASSOC);
              $requetecount = "SELECT COUNT(*) FROM votes WHERE id_utilisateur=$intidmoi  AND id_commentaire=$intidcom AND valeur=1";
              $query3 = mysqli_query($cnx, $requetecount);
              $resultat3 = mysqli_fetch_all($query3, MYSQLI_ASSOC);
              $requetecountdislike = "SELECT COUNT(*) FROM votes WHERE id_utilisateur=$intidmoi  AND id_commentaire=$intidcom AND valeur=-1";
              $query4 = mysqli_query($cnx, $requetecountdislike);
              $resultat4 = mysqli_fetch_all($query4, MYSQLI_ASSOC);
              $requetecountlikeall = "SELECT COUNT(*) FROM votes WHERE id_commentaire=$intidcom AND valeur=1";
              $query5 = mysqli_query($cnx, $requetecountlikeall);
              $resultat5 = mysqli_fetch_all($query5, MYSQLI_ASSOC);
              $requetecountdislikeall = "SELECT COUNT(*) FROM votes WHERE id_commentaire=$intidcom AND valeur=-1";
              $query6 = mysqli_query($cnx, $requetecountdislikeall);
              $resultat6 = mysqli_fetch_all($query6, MYSQLI_ASSOC);
              var_dump($resultat3);
              var_dump($resultat4);
              var_dump($resultat5);
              var_dump($resultat6);
              echo "<article id=\"commentaire\">";
              echo "<b><i>Posté le : </i></b>".$newdate;
              echo "<b><i> par : </i></b><u>".$resultatlogin[0]["login"]."</u><br>";
              echo $resultat[$a]['commentaire'];
              echo "<br>";
              echo "</article>";
              echo "<article id=\"vote\">";
              echo "<form method=\"post\" action=\"livre-or.php\">";
              echo "<input type=\"submit\" name=\"likebutton".$a."\" value=\"like\">".$resultat5[0]['COUNT(*)'];
              echo "<input type=\"submit\" name=\"dislikebutton".$a."\" value=\"dislike\">".$resultat6[0]['COUNT(*)'];
              echo "</form>";
              echo "</article>";
              echo "<img id=\"divider\" src=\"img/div.png\">";
                if ( isset($_SESSION['login']) && isset($_POST['likebutton'.$a]) && $resultat3[0]['COUNT(*)'] == "0" ) {
                    if ( $resultat4[0]['COUNT(*)'] == "1" ) {
                        $requeteresetlike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                        $queryresetlike = mysqli_query($cnx, $requeteresetlike);
                    }
                    $requetelike = "INSERT INTO votes (id_utilisateur, id_commentaire, valeur) VALUES ($intidmoi, $intidcom, 1)";
                    $querylike = mysqli_query($cnx, $requetelike);
                    $refresh = true;
                }
                if ( isset($_SESSION['login']) && isset($_POST['dislikebutton'.$a]) && $resultat4[0]['COUNT(*)'] == "0" ) {
                    if ( $resultat3[0]['COUNT(*)'] == "1" ) {
                        $requeteresetdislike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                        $queryresetdislike = mysqli_query($cnx, $requeteresetdislike);
                    }
                    $requetedislike = "INSERT INTO votes (id_utilisateur, id_commentaire, valeur) VALUES ($intidmoi, $intidcom, -1)";
                    $querydislike = mysqli_query($cnx, $requetedislike);
                    $refresh = true;
                break;
                }
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