<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <title>Profil - Livre D'OR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
 <?php include("header.php"); ?>
    <main>

        <section class="leftsidebar">
            <img class="guirlandehaut" src="img/dividerguirlande.png">
            <?php
            if (isset($_SESSION['login']))
            {
                $connexion = mysqli_connect("localhost", "root", "", "livreor"); # Connexion à notre base de données.
                $requete = "SELECT * FROM utilisateurs WHERE login='" . $_SESSION['login'] . "'"; # Préparation de la requête;
                $query = mysqli_query($connexion, $requete); # Execution de la requête;
                $resultat = mysqli_fetch_assoc($query); # Récupération des résultats de la requête;

                ?>

                <form class="form_site" action="profil.php" method="post">
                    <label> Login </label>
                    <input type="text" name="login" value=<?php echo $resultat['login']; ?> />
                    <label> New Password </label>
                    <input type="password" name="passwordx" />
                    <label> Confirm New Password </label>
                    <input type="password" name="passwordconf" />
                    <input id="prodId" name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <br>
                    <input class="mybutton" type="submit" name="modifier" value="Modifier" />
                </form>

                <?php 
                    /*------------------2 REQUETES UPDATE--------------------
                    if (isset($_POST['modifier']) ) 
                    {
                         if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                         {
                             ?>
                            <p>Attention ! Mot de passe différents</p>
                        <?php
                        } 
                        elseif(isset($_POST['passwordx']) && !empty($_POST['passwordx'])){
                            $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                            $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                            $query2 = mysqli_query($connexion, $updatepwd); # Execution de la requête;
                            header('Location:profil.php');
                        }
                        $login = $_POST["login"];
                        $req = "SELECT login FROM utilisateurs WHERE login = '$login'";
                        $req3 = mysqli_query($connexion, $req);
                        $veriflog = mysqli_fetch_all($req3);
                            if(!empty($veriflog))
                            {
                                ?>
                                <p>Login deja utilisé, requete refusé.<br /></p>
                                <?php
                            }
                        if(empty($veriflog))
                            {
                                $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "' WHERE id = '" . $resultat['id'] . "'";
                                $querylog = mysqli_query($connexion, $updatelog); # Execution de la requête;
                                $_SESSION['login']=$_POST['login'];
                                header("Location:profil.php");
                            }
                    }*/
                    //------------------1 REQUETE UPDATE--------------------
                    if (isset($_POST['modifier']) ) 
                    {
                        if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                        {
                        ?>
                            <p>Attention ! Mot de passe différents</p>
                        <?php
                        } 
                        else{
                        $login = $_POST["login"];
                        $req = "SELECT login FROM utilisateurs WHERE login = '$login'";
                        $req3 = mysqli_query($connexion, $req);
                        $veriflog = mysqli_fetch_all($req3);
                            if(!empty($veriflog))
                            {
                                ?>
                                <p>Login deja utilisé, requete refusé.</p><br />
                                <?php
                            }
                            elseif(empty($veriflog) || $_POST['login'] == $_SESSION['login'] )
                            {
                                if(isset($_POST['passwordx']) && !empty($_POST['passwordx'])){
                                    $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                                }
                                else{
                                    $pwdx =$resultat['password'];
                                }
                                $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "', password = '$pwdx'  WHERE id = '" . $resultat['id'] . "'";
                                $querylog = mysqli_query($connexion, $updatelog); # Execution de la requête;
                                $_SESSION['login']=$_POST['login'];
                                header("Location:profil.php");
                            }
                        }
                       
                    }

                ?>
            <img class="guirlandebas" src="img/dividerguirlandebas.png">
        </section>

    <?php

    } 
    else 
    {
        ?>
        <p>Veuillez vous connecter pour accéder à votre page !</p>
        <?php
    }
    ?>

    </main>
<?php include("footer.php"); ?>
</body>

</html>