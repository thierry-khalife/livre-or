<?php session_start() ?>

<!DOCTYPE html>

<html>

<head>
    <title>Inscription - Livre D'OR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <section class="leftsidebar">
            <?php 
            echo "<img class=\"guirlandehaut\" src=\"img/dividerguirlande.png\">";
            if (isset($_SESSION["login"])) 
            {
                echo "Bonjour, " . $_SESSION["login"] . " vous êtes déja connecté impossible de s'inscrire.<br>";
                echo "<form action=\"index.php\" method=\"post\">
                    <input class=\"mybutton\"  name=\"deco\" value=\"Deconnexion\" type=\"submit\" />
                    </form>";
            } 
            else 
            {
                echo "<article id=\"titreinscription\"><h1>Veuillez rentrer vos informations</h1></article>
                    <form action=\"inscription.php\" method=\"post\" class=\"form_profil\">
                    <label>Login</label>
                    <input type=\"text\" name=\"login\" required>
                    <label>Password</label>
                    <input type=\"password\" name=\"mdp\" required>
                    <label>Password confirmation</label>
                    <input type=\"password\" name=\"mdpval\" required>
                    <input class=\"mybutton\"  type=\"submit\" value=\"S'inscire\" name=\"valider\">
                    </form>";

                if (isset($_POST["valider"])) 
                {
                    $login = $_POST["login"];
                    $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT, array('cost' => 12));
                    $connexion = mysqli_connect("localhost", "root", "", "livreor");
                    $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
                    $query3 = mysqli_query($connexion, $requete3);
                    $resultat3 = mysqli_fetch_all($query3);

                    if (!empty($resultat3)) 
                    {
                        echo "Ce Login est déjà prit";
                    } 
                    elseif ($_POST["mdp"] != $_POST["mdpval"]) 
                    {
                        echo "Attention ! Mot de passe différents";
                    } 
                    else 
                    {
                        $requete = "INSERT INTO utilisateurs (login, password) VALUES ('$login','$mdp')";
                        $query = mysqli_query($connexion, $requete);
                        header('Location:connexion.php');
                    }
                }
            }
            echo "<img class=\"guirlandebas\" src=\"img/dividerguirlandebas.png\">";
            ?>

        </section>
    </main>
<?php include("footer.php"); ?>
</body>

</html>