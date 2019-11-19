<?php

    session_start();
    $ismdpwrong = false;
    $isIDinconnu = false;
    $ischampremplis = false;

    if ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['password']) && strlen($_POST['password']) != 0 ) {
        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        $requete = "SELECT * FROM utilisateurs WHERE login ='".$_POST['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        if ( !empty($resultat) ) {
            if ( password_verify($_POST['password'], $resultat[0][2]) )
                    {
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['password'] = $_POST['password'];
                        header('Location:index.php');
                    }
            else {
                $ismdpwrong = true;
            }
        }
        else {
            $isIDinconnu = true;
        }
        mysqli_close($connexion);
    }
    elseif ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) == 0 || isset($_POST['password']) && strlen($_POST['password']) == 0 ) {
        $ischampremplis = true;
    }

?>

<!DOCTYPE html>

<html>
<head>
    <title>Livre D'OR - Connexion</title>
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
                <a href="connexion.php"><h1>CONNEXION</h1></a>
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
                <a href="livreor.php"><img src="img/button.png"></a>
                <a href="livreor.php">LIVRE D'OR</a>
            </section>
        </nav>
    </header>
    <main>
        <section class="leftsidebar">
    <?php
    if ( !isset($_SESSION['login']) ) {
    ?>
        <form method="post" action="connexion.php">
            <input type="text" placeholder="Identifiant" name="login" ><br />
            <input type="password" placeholder="Mot de passe" name="password" ><br />
            <input type="submit" value="Se connecter" name="connexion" >
        </form>
        <?php
        if ( $ismdpwrong == true ) {
        ?>
            Identifiant ou mot de passe incorrect.
        <?php
        }
        elseif ( $isIDinconnu == true ) {
        ?>
            Cet identifiant n'exsite pas.
        <?php
        }
        elseif ( $ischampremplis == true ) {
        ?>
            Merci de remplir tous les champs!
        <?php
        }
    }

    elseif ( isset($_SESSION['login']) ) {
    ?>
        ERREUR<br />
        Vous êtes déjà connecté !
    <?php
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
            <a href="livreor.php">LIVRE D'OR</a>
        </nav>
        <article>
            <p>Copyright 2019 Coding School | All Rights Reserved | Project by Thierry & Nicolas.</p>
        </article>
    </footer>
</body>
</html>