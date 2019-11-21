<?php

    session_start();
    date_default_timezone_set('Europe/Paris');
    $is10car = false;

    if ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) >= 10 ) {
        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        
        $requete = "SELECT * FROM utilisateurs WHERE login ='".$_SESSION['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        $msg = $_POST['message'];
        $requete2 = "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$msg', ".$resultat[0][0].", '".date("Y-m-d H:i:s")."')";
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
    <?php
     echo "<img class=\"guirlandehaut\" src=\"img/dividerguirlande.png\">";
    if ( isset($_SESSION['login']) ) {
    ?>
        <form method="post" action="commentaire.php" class="form_site">
            <label>VOTRE MESSAGE</label>
            <textarea name="message" ></textarea><br />
            <input class= "mybutton" type="submit" value="Envoyer" name="envoyer" >
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
    echo "<img class=\"guirlandebas\" src=\"img/dividerguirlandebas.png\">";
    ?>
        </section>
    </main>
<?php include("footer.php"); ?>
</body>
</html>