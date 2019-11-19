<?php session_start() ?>

<!DOCTYPE html>

<html>

<head>
    <title>Inscription - Livre D'OR</title>
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
                <a href="livreor.php"><img src="img/button.png"></a>
                <a href="livreor.php">LIVRE D'OR</a>
            </section>
        </nav>
    </header>


    <main>

        <section class="leftsidebar">

            <?php

            if (isset($_SESSION['login'])) 
            {
                $connexion = mysqli_connect("localhost", "root", "", "livreor"); # Connexion à notre base de données.
                $requete = "SELECT * FROM utilisateurs WHERE login='" . $_SESSION['login'] . "'"; # Préparation de la requête;
                $query = mysqli_query($connexion, $requete); # Execution de la requête;
                $resultat = mysqli_fetch_assoc($query); # Récupération des résultats de la requête;

                ?>

                <form class="form_profil" action="profil.php" method="post">
                    <label> Login </label>
                    <input type="text" name="login" value=<?php echo $resultat['login']; ?> />
                    <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <input class="mybutton" type="submit" name="modifier" value="Modifier" />
                </form>

                <?php 
                    if (isset($_POST['modifier']) ) 
                    {
                         $login = $_POST["login"];
                         $req = "SELECT login FROM utilisateurs WHERE login = '$login'";
                         $req3 = mysqli_query($connexion, $req);
                         $veriflog = mysqli_fetch_all($req3);
                         if(!empty($veriflog))
                            {
                               echo "Login deja utilisé, requete refusé.<br>";
                            }
                        if(empty($veriflog))
                            {
                                $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "' WHERE id = '" . $resultat['id'] . "'";
                                $querylog = mysqli_query($connexion, $updatelog); # Execution de la requête;
                                $_SESSION['login']=$_POST['login'];
                                header("Location:profil.php");
                            }
                    }

                ?>
        </section>

         <section class="rightsidebar"> 
                 <form class="form_profil" action="profil.php" method="post">
                    <label> New Password </label>
                    <input type="password" name="passwordx" />
                    <label> Confirm New Password </label>
                    <input type="password" name="passwordconf" />
                    <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <input class="mybutton" type="submit" name="modifier2" value="Modifier MDP" />
                </form>

         <?php 
                if (isset($_POST['modifier2'])) 
                    {
                       if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                          {
                            echo "Attention ! Mot de passe différents";
                          } 
                       elseif(isset($_POST['passwordx'])){
                            $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                            $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                            $query2 = mysqli_query($connexion, $updatepwd); # Execution de la requête;
                            header('Location:profil.php');
                          }
                    }
    ?>
      </section>
        
    <?php

    } 
    else 
    {
        echo "Veuillez vous connecter pour accéder à votre page !";
    }

    ?>
    
    </main>

    <footer>
        <nav class="navfooter">
            <a href="inscription.php">INSCRIPTION</a>
            <a href="connexion.php">CONNEXION</a>
            <a href="profil.php">MEMBER PROFIL</a>
            <a href="livreor.php">LIVRE D'OR</a>
            <a href="commentaire.php">COMMENTAIRE</a>
        </nav>
        <article>
            <p>Copyright 2019 Coding School | All Rights Reserved | Project by Thierry & Nicolas.</p>
        </article>
    </footer>

</body>

</html>