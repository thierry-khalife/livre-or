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
                <a href="livre-or.php"><img src="img/button.png"></a>
                <a href="livre-or.php">LIVRE D'OR</a>
            </section>
        </nav>
    </header>
