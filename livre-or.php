<?php session_start(); 

$cnx = mysqli_connect("localhost", "root", "", "livreor");

$requete1 = "SELECT * FROM commentaires";


?>

<!DOCTYPE html>

<html>

<head>
    <title>Livre D'OR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
 <header>
        <nav class="nav">
             <section class="undernav">
                <a href="index.php"><img src="img/button.png"></a>
                <a href="index.php">HOME</a>
            </section>
            <?php if(!isset($_SESSION['login'])){ ?>
            <section class="undernav">
                <a href="inscription.php"><img src="img/button.png"></a>
                <a href="inscription.php">INSCRIPTION</a>
            </section>
            <section class="undernav">
                <a href="connexion.php"><img src="img/button.png"></a>
                <a href="connexion.php">CONNEXION</a>
            </section>
            <?php } if(isset($_SESSION['login'])){ ?>
            <section class="undernav">
                <a href="profil.php"><img src="img/button.png"></a>
                <a href="profil.php">USER PROFIL</a>
            </section>
             <section class="undernav">
                <a href="commentaire.php"><img src="img/button.png"></a>
                <a href="commentaire.php">COMMENTAIRE</a>
            </section>
            <section class="undernav">
             <form action="index.php" method="post">
             <input type="submit" class="submit1"  name="deco" value="Deconnexion" />
             </form>
             <a href="#">DECONNEXION</a>
             </section>
            <?php } ?>
            <section class="undernav">
                <a href="livre-or.php"><img src="img/button.png"></a>
                <a href="livre-or.php"><h1>LIVRE D'OR</h1></a>
            </section>
        </nav>
    </header>

    <main>
         <section class="leftsidebar">
             <h1>LIVRE D'OR</h1>
             <table>
        <?php
            $query1 = mysqli_query($cnx, $requete1);

                while ($resultat = mysqli_fetch_assoc($query1)) {
                    $idutilisateur = $resultat['id_utilisateur'];
                    $requete2 = "SELECT login FROM utilisateurs WHERE id=$idutilisateur";
                    $query2 = mysqli_query($cnx, $requete2);
                    $resultat2 = mysqli_fetch_assoc($query2);
        ?>
                    <tr>
                        <td>
                            <?php echo "<b>".$resultat2['login']."</b> le <i>".$resultat['date']."</i>"; ?><br />
                            <?php echo $resultat['commentaire']; ?><br />
                        </td>
                    </tr>
                <?php
                }
            mysqli_close($cnx);
        ?>
        </table>
         </section>
          <section class="rightsidebar">
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

    <footer>
        <nav class="navfooter">
            <a href="index.php">HOME</a>
            <?php if(!isset($_SESSION['login'])){ ?>
            <a href="inscription.php">INSCRIPTION</a>
            <a href="connexion.php">CONNEXION</a>
            <?php } if(isset($_SESSION['login'])){ ?>
            <a href="profil.php">USER PROFIL</a>
            <a href="commentaire.php">COMMENTAIRE</a>
            <?php } ?>
            <a href="livre-or.php">LIVRE D'OR</a>
        </nav>
        <article>
            <p>Copyright 2019 Coding School | All Rights Reserved | Project by Thierry & Nicolas.</p>
        </article>
    </footer>

</body>

</html>