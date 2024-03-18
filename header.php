<!--- header à inclure dans chaque page --->
<?php session_start();?>
<header>
    <nav>
        <ul>
            <?php
            // Vérifie si une session est déjà démarrée et si l'utilisateur est connecté
            if (isset($_SESSION["type"])) {
                if ($_SESSION['type'] === "entreprise") {
                    echo '<li><a href="dashboard_business.php">Dashboard</a></li>';
                    echo '<li><a href="créer_quiz.php">Créer un Quizz</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "ecole") {
                    echo '<li><a href="dashboard_school.php">Dashboard</a></li>';
                    echo '<li><a href="créer_quiz.php">Créer un Quizz</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "utilisateur") {
                    echo '<li><a href="dashboard_pnj.php">Dashboard</a></li>';
                    echo '<li><a href="#">Participer à un Quizz</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } elseif ($_SESSION["type"] === "admin") {
                    echo '<li><a href="créer_quizz.php">Dashboard</a></li>';
                    echo '<li><a href="#">Les Utilisateurs</a></li>';
                    echo '<li><a href="#">Les Quizz</a></li>';
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

<style>
     @import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@100;300;400;500&display=swap');

header {
    top: 0px;
    position: fixed;
    background-color: lightblue;
    width: 100%;
}

nav ul {
    list-style-type: none; 
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; 
    align-items: center; 
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    text-decoration: none;
    font-family: "Poppins", sans-serif;
    color: black;
}

nav ul li a:hover {
    text-decoration: underline;
}

body {
        font-family: "Poppins", sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

footer {
    bottom: 0px;
    position: fixed;
    width: 100%;
    text-align: center;
    height: 50px;
    background-color: lightblue;
}

</style>