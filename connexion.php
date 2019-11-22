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
    <?php include("header.php"); ?>
    <main>
        <section class="leftsidebar">
    <?php
    echo "<img class=\"guirlandehaut\" src=\"img/dividerguirlande.png\">";
    if ( !isset($_SESSION['login']) ) {
    ?>
        <form class="form_site" method="post" action="connexion.php">
            <label>IDENTIFIANT</label>
            <input type="text" name="login" ><br />
            <label>MOT DE PASSE</label>
            <input type="password" name="password" ><br />
            <input class="mybutton" type="submit" value="Se connecter" name="connexion" >
        </form>
        <?php
        if ( $ismdpwrong == true ) {
        ?>
            <p>Identifiant ou mot de passe incorrect.</p>
        <?php
        }
        elseif ( $isIDinconnu == true ) {
        ?>
            <p>Cet identifiant n'exsite pas.</p>
        <?php
        }
        elseif ( $ischampremplis == true ) {
        ?>
            <p>Merci de remplir tous les champs!</p>
        <?php
        }
    }

    elseif ( isset($_SESSION['login']) ) {
    ?>
        <center><img src="img/erreurnoel.gif"><br />
        <p>ERREUR<br />
        Vous êtes déjà connecté !</p></center>
    <?php
    }
    ?>
        <img class="guirlandebas" src="img/dividerguirlandebas.png">
        </section>
    </main>
   <?php include("footer.php"); ?>
</body>
</html>