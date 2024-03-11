<!--- header à inclure dans chaque page --->

<header>
    <nav>
        <ul>
            <?php
            // Vérifie si une session est déjà démarrée et si l'utilisateur est connecté
            if (isset($_SESSION["type"])) {
                if ($_SESSION['type'] === "entreprise") {
                    echo '<li><a href="dashboard_business.php">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "ecole") {
                    echo '<li><a href="dashboard_school.php">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "utilisateur") {
                    echo '<li><a href="dashboard_pnj.php">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "admin") {
                    echo '<li><a href="dashboard_admin.php">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                }
            } else {
                // Si l'utilisateur n'est pas connecté, affiche le lien de connexion
                echo '<li><a href="index.php">Connexion</a></li>';
            }
            ?>
        </ul>
        </div>
    </nav>
</header>
