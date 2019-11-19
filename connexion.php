<?php

    $ismdpwrong = false;
    $isIDinconnu = false;
    $ischampremplis = false;

    if ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['password']) && strlen($_POST['password']) != 0 ) {
        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        $requete = "SELECT * FROM utilisateurs WHERE login ='".$_POST['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        if ( !empty($resultat) ) {
            if ( password_verify($_POST['password'], $resultat['password']) )
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
        Copyright 2019 LaPlateforme_
    </footer>
</body>
</html>