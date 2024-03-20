<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="text-align: center; font-family: Arial, sans-serif;"><br><br>
    <?php session_start() ?>
    <?php echo $_SESSION['email']  . "<h1>Ton compte a été désactivé.</h1>"  ?>
    <img id="ban" src="https://i.pinimg.com/736x/de/86/01/de86018e4c2e3b8d2a896c815026aa4e.jpg" alt="cheh">
    <h3>Demande de révocation</h3>
    <textarea cols="30" rows="10"></textarea><br>
    <button type="submit">Envoyer</button><br><br>
    <a href="logout.php">Me déconnecter</a>
    <?include "footer.php" ?>
</body>
<style>
    a {
        text-decoration: none;
        color: black;
    }
    a:hover {
        text-decoration: underline;
    }
    body {
        background-image: url("fond.gif");
    }
    .ban
     {
        width: 500px;
        height: 500px;
    }
</style>
</html>