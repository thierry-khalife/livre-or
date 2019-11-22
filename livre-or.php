<?php
session_start();
ob_start();

$cnx = mysqli_connect("localhost", "root", "", "livreor");
$requete1 = "SELECT * FROM commentaires ORDER BY date DESC";
$query1 = mysqli_query($cnx, $requete1);
$resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);

if ( isset($_SESSION['login']) ) {
$requete2 = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
$query2 = mysqli_query($cnx, $requete2);
$resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);
}

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
                $idcom = $resultat[$a]['id'];
                $intidcom = intval($idcom);
                $requetelogin = "SELECT login FROM utilisateurs WHERE id=$iduser";
                $query2 = mysqli_query($cnx, $requetelogin);
                $resultatlogin = mysqli_fetch_all($query2, MYSQLI_ASSOC);
                if ( isset($_SESSION['login']) ) {
                    $idmoi = $resultat2[0]['id'];
                    $intidmoi = intval($idmoi);
                    $requetecount = "SELECT COUNT(*) FROM votes WHERE id_utilisateur=$intidmoi  AND id_commentaire=$intidcom AND valeur=1";
                    $query3 = mysqli_query($cnx, $requetecount);
                    $resultat3 = mysqli_fetch_all($query3, MYSQLI_ASSOC);
                    $requetecountdislike = "SELECT COUNT(*) FROM votes WHERE id_utilisateur=$intidmoi  AND id_commentaire=$intidcom AND valeur=-1";
                    $query4 = mysqli_query($cnx, $requetecountdislike);
                    $resultat4 = mysqli_fetch_all($query4, MYSQLI_ASSOC);
                }
                $requetecountlikeall = "SELECT COUNT(*) FROM votes WHERE id_commentaire=$intidcom AND valeur=1";
                $query5 = mysqli_query($cnx, $requetecountlikeall);
                $resultat5 = mysqli_fetch_all($query5, MYSQLI_ASSOC);
                $requetecountdislikeall = "SELECT COUNT(*) FROM votes WHERE id_commentaire=$intidcom AND valeur=-1";
                $query6 = mysqli_query($cnx, $requetecountdislikeall);
                $resultat6 = mysqli_fetch_all($query6, MYSQLI_ASSOC);
                ?>
                <article id="commentaire">
                <?php
                echo "<b><i>Posté le : </i></b>".$newdate;
                echo "<b><i> par : </i></b><u>".$resultatlogin[0]["login"]."</u><br>";
                echo $resultat[$a]['commentaire']."<br />";
                ?>
                </article>
                <article id="vote">
                    <form method="post" action="livre-or.php">
                        <div id="formvote">
                        <?php
                        if ( isset($_SESSION['login']) && $resultat3[0]['COUNT(*)'] != "0" ) {
                            echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"likev\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                            echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislike\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                        }
                        elseif ( isset($_SESSION['login']) && $resultat4[0]['COUNT(*)'] != "0" ) {
                            echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"like\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                            echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislikev\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                        }
                        else {
                            echo "<input type=\"submit\" name=\"likebutton".$a."\" id=\"like\" value=\"like\"><div class=\"resultatvotes\">".$resultat5[0]['COUNT(*)']."</div>";
                            echo "<input type=\"submit\" name=\"dislikebutton".$a."\" id=\"dislike\" value=\"dislike\"><div class=\"resultatvotes\">".$resultat6[0]['COUNT(*)']."</div>";
                        }
                        ?>
                        </div>
                    </form>
                </article>
                <article id="poubelle">
                    <?php
                    if(isset($_SESSION['login']) && $_SESSION['login'] == "admin")
                    {
                        echo "<form action=\"livre-or.php\" method=\"post\">
                        <br><input type=\"submit\" class=\"submit2\"  name=\"delete".$a."\" value=\"$idcom\" />
                        </form>";
                    }
                    ?>
                </article>
                <img id="divider" src="img/div.png">
                <?php
                if ( isset($_SESSION['login']) && isset($_POST['likebutton'.$a]) && $resultat3[0]['COUNT(*)'] == "0" ) {
                    if ( $resultat4[0]['COUNT(*)'] == "1" ) {
                        $requeteresetlike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                        $queryresetlike = mysqli_query($cnx, $requeteresetlike);
                    }
                    $requetelike = "INSERT INTO votes (id_utilisateur, id_commentaire, valeur) VALUES ($intidmoi, $intidcom, 1)";
                    $querylike = mysqli_query($cnx, $requetelike);
                    header('Location: livre-or.php');
                }
                if ( isset($_SESSION['login']) && isset($_POST['likebutton'.$a]) && $resultat3[0]['COUNT(*)'] != "0" ) {
                    $requeteresetlike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                    $queryresetlike = mysqli_query($cnx, $requeteresetlike);
                    header('Location: livre-or.php');
                }
                if ( isset($_SESSION['login']) && isset($_POST['dislikebutton'.$a]) && $resultat4[0]['COUNT(*)'] == "0" ) {
                    if ( $resultat3[0]['COUNT(*)'] == "1" ) {
                        $requeteresetdislike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                        $queryresetdislike = mysqli_query($cnx, $requeteresetdislike);
                    }
                    $requetedislike = "INSERT INTO votes (id_utilisateur, id_commentaire, valeur) VALUES ($intidmoi, $intidcom, -1)";
                    $querydislike = mysqli_query($cnx, $requetedislike);
                    header('Location: livre-or.php');
                }
                if ( isset($_SESSION['login']) && isset($_POST['dislikebutton'.$a]) && $resultat4[0]['COUNT(*)'] != "0" ) {
                    $requeteresetlike = "DELETE FROM votes WHERE id_commentaire=$intidcom AND id_utilisateur=$intidmoi";
                    $queryresetlike = mysqli_query($cnx, $requeteresetlike);
                    header('Location: livre-or.php');
                }
                if (isset($_POST["delete".$a])) {
                    $todel = $_POST["delete".$a];
                    $requetedel = "DELETE FROM commentaires WHERE id=$todel";
                    $querydel = mysqli_query($cnx, $requetedel);
                    $requetedellike = "DELETE FROM votes WHERE id_commentaire=$todel";
                    $querydellike = mysqli_query($cnx, $requetedellike);
                    header('Location:livre-or.php');
                }
                $a++;
            }
            if (!empty($_SESSION['login'])) 
            {
                ?>
                <p>Vous êtes connecté en tant qu'utilisateur. Ajouter un commentaire en visitant la page <a href=\"commentaire.php\">COMMENTAIRE</a></p>
                <?php
            }
            ?>
            <img class="guirlandebas" src="img/dividerguirlandebas.png">

        </section>
        <section class="rightsidebar">
       
        <?php
        date_default_timezone_set('Europe/Paris');
        if(isset($_SESSION['login']))
        { 
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            echo "<div id=\"phrasebvn\"><img id=\"icones\" src=\"img/candycane.png\">&nbsp Bonjour ".$_SESSION["login"]."&nbsp <img id=\"icones\" src=\"img/snowmanicon.png\"></div>";
            ?>
            <p>Vous êtes connecté en tant qu'utilisateur :</p>
            <p>Accédez à votre page de <a href="profil.php">PROFIL</a>&nbsp&nbsp&nbsp&nbsp</p>
            <p>Ajouter un commentaire en visitant la page <a href="commentaire.php">COMMENTAIRE</a></p><br />
            <form action="index.php" method="post">
                <input class="mybutton"  name="deco" value="Deconnexion" type="submit" />
            </form>
        <?php
        }
        else
        {
            echo "Nous sommes le ".date('d-m-Y')." et il est ".date('H:i:s');
            ?>
            <h1><img id="icones" src="img/candycane.png">&nbsp Bonjour Guest&nbsp <img id="icones" src="img/snowmanicon.png"></h1>
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
         </section>
    </main>
<?php include("footer.php"); 
mysqli_close($cnx);
ob_end_flush();
?>
</body>

</html>