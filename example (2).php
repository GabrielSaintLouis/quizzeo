<header>
    <nav>
        <ul>
            <?php
            if(isset($_SESSION['email'])) {
                echo '<li><a href="accueil.php">Accueil</a></li>';
                echo '<li><a href="liste.php">Liste</a></li>';
                echo '<li><a href="logout.php">Déconnexion</a></li>';
            } else {
                echo '<li><a href="index.php">Connexion</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
