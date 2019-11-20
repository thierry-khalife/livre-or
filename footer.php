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
