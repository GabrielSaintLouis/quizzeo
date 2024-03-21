<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "style.php" ?>
    <?php include "footer.php" ?>
    <?php include "fonction-ban.php" ?>

    <header>
        <nav>
            <ul>
                <?php
                    if ($_SESSION['type'] === "ecole" || $_SESSION["type"] === "entreprise") {
                        echo "<li><a href='accueil.php'>Accueil</a></li>";
                        echo "<li><a href='dashboard_pnj.php'>Dashboard</a></li>";
                        echo "<li><a href='créer_quizz.php'>Créer un quizz</a></li>";
                        echo "<li><a href='logout.php'>Déconnexion</a></li>";
                    }
                    else {
                        header("Location: accueil.php");
                    }
                ?>
            </ul>
        </nav>
    </header>

</body>
<style>
    header {
        background-color: rgba(255,255,255,0.8);
        font-family: "Poppins", sans-serif;
        top: 0px;
        position: fixed;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    nav ul li {
        list-style-type: none;
        display: inline;
        margin-right: 20px;
    }

    nav ul a {
        text-decoration: none;
        color: black
    }

    nav ul a:hover {
        text-decoration: underline;
    }
</style>
</html>