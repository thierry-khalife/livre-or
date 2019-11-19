<?php

    session_start();
    $is10car = false;

    if ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) >= 10 ) {
        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        
        $requete = "SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        $msg = $_POST['message'];
        $requete2 = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$msg', ".$resultat[0][0].", '".date('Y-m-d')."')";
        $query2 = mysqli_query($connexion, $requete2);
        header('Location: livre-or.php');

        mysqli_close($connexion);
    }
    elseif ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) < 10 ) {
        $is10car = true;
    }
?>

<!DOCTYPE html>

<html>
<head>
    <title>Livre D'OR - Commentaire</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <main>
        <section class="leftsidebar">
    <?php
    if ( isset($_SESSION['login']) ) {
    ?>
        <form method="post" action="commentaire.php">
            <textarea placeholder="Votre message" name="message" ></textarea><br />
            <input type="submit" value="Envoyer" name="envoyer" >
        </form>
        <?php
        if ( $is10car == true ) {
        ?>
            Votre message doit comporter au moins 10 caractères.
        <?php
        }
    }

    elseif ( !isset($_SESSION['login']) ) {
    ?>
        ERREUR<br />
        Vous devez être connecté pour accéder à cette page.
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