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

        mysqli_close($connexion);
    }
    elseif ( isset($_POST['envoyer']) == true && isset($_POST['message']) && strlen($_POST['message']) < 10 ) {
        $is10car = true;
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
                <a href="connexion.php">CONNEXION</a>
            </section>
            <?php } if(isset($_SESSION['login'])){ ?>
            <section class="undernav">
                <a href="profil.php"><img src="img/button.png"></a>
                <a href="profil.php">USER PROFIL</a>
            </section>
             <section class="undernav">
                <a href="commentaire.php"><img src="img/button.png"></a>
                <a href="commentaire.php"><h1>COMMENTAIRE</h1></a>
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
                <a href="livre-or.php">LIVRE D'OR</a>
            </section>
        </nav>
    </header>
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