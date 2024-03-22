<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        /* CSS personnalisé */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-top: 50px;
            color: #007bff;
        }

        p {
            font-size: 18px;
            color: white;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php session_start();?>
    <?php include "header.php" ?>
    <?php include "style.php" ?>
    <?php include "footer.php" ?>
    <h1>Bienvenue sur Quizzeo !</h1>
    <p>Quizzeo est une plateforme de quiz en ligne passionnante. Testez vos connaissances et défiez vos amis !</p>
</body>
</html>
