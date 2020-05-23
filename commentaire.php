<?php

    session_start();
    date_default_timezone_set('Europe/Paris');
    $is10car = false;

    if ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) >= 10 ) {
        $connexion = mysqli_connect("localhost", "nicolas", "Nicoju13", "nicolas-camilloni_livre-or");        
        $requete = "SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        $msg = $_POST['message'];
        $remsg = addslashes($msg);
        $requete2 = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$remsg', ".$resultat[0][0].", '".date("Y-m-d H:i:s")."')";
        $query2 = mysqli_query($connexion, $requete2);

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
 <?php include("header.php"); ?>
    <main>
        <section class="leftsidebar">
            <img class="guirlandehaut" src="img/dividerguirlande.png">
    <?php
    if ( isset($_SESSION['login']) ) {
    ?>
        <img id="pncom" src="img/perenoelcom.gif">
        <form method="post" action="commentaire.php" class="form_site">
            <label>VOTRE MESSAGE</label>
            <textarea name="message" ></textarea><br />
            <input class= "mybutton" type="submit" value="Envoyer" name="envoyer" >
        </form>
        <?php
        if ( $is10car == true ) {
        ?>
            <p>Votre message doit comporter au moins 10 caractères.</p>
        <?php
        }
    }

    elseif ( !isset($_SESSION['login']) ) {
    ?>
        <center><img src="img/erreurnoel.gif"><br />
        <p><b>ERREUR</b><br />
        Vous devez être connecté pour accéder à cette page.</p></center>
    <?php
    }
    ?>
        <img class="guirlandebas" src="img/dividerguirlandebas.png">
        </section>
    </main>
<?php include("footer.php"); ?>
</body>
</html>