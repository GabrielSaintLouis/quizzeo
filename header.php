<!--- header à inclure dans chaque page --->

<header>
    <nav>
        <ul>
            <?php
            if (isset($_SESSION["email"])){
                if (isset($_SESSION["type"])) {
                    if ($_SESSION['type'] === "entreprise"){
                        echo '<li><a href="dashboard_business.php">Dashboard</a></li>';
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                        header('Location: dashboard_business.php')
                    }
                    else if ($_SESSION["type"] === "ecole"){
                        echo '<li><a href="dashboard_school">Dashboard</a></li>';
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                        header('Location: dashboard_school.php')
                    }
                    else if ($_SESSION["type"] === "utilisateur") {
                        echo '<li><a href="dashboard_pnj">Dashboard</a></li>';
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                        header('Location: dashboard_pnj.php')
                    }
                    else if ($_SESSION["type"] === "admin") {
                        echo '<li><a href="dashboard_admin">Dashboard</a></li>';
                        echo '<li><a href="logout.php">Déconnexion</a></li>';
                        header('Location: dashboard_admin.php')
                    }
                } 
                else {
                    echo '<li><a href="index.php">Connexion</a></li>';
                }
            }
            else {
                header("Location: index.php");
            }
            
            ?>
        </ul>
    </nav>
</header>
