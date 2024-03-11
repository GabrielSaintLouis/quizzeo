<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $userData = [$type, $email, $password];
    
    $file = fopen('users.csv', 'a'); // Utilisation du mode 'a' pour ajouter à la fin du fichier
    if ($file !== false) {
        fputcsv($file, $userData);
        fclose($file);
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="container">
<h1>Page de d'inscription</h1>
<form action="inscription.php" method="post">
    <label for="type">Type: </label><br>
    <select name="type" id="option_type" required>
        <option value="entreprise">Entreprise</option>
        <option value="ecole">Ecole</option>
        <option value="utilisateur">Utilisateur</option>
    </select><br><br>
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button>
    <label for="captcha">Êtes-vous un robot ?</label>
    <input type="checkbox" id="checkbox" name="checkbox" required>
    </button><br><br>
    <button type="submit" id = "inscription">S'inscrire</button><br><br> 
</form>
<p>Vous avez déjà un compte ? <a href="index.php">Connexion</a></p>
</div>
<?php include 'footer.php'; ?>

</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@100;300;400;500&display=swap');

body {
    font-family: "Roboto", sans-serif;
    padding: 150px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.container {
    width: 500px;
    text-align: center;
    background-color: lightblue;
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

button {
    background: white;
    color: black;
    width: 200px;
    height: 50px;
}
#inscription {
    width: 170px;
    height: 50px;
    font-family: "Anton", sans-serif;
    font-size: 15px;
    background: transparent;
    border: 1px solid black;
    border-radius: 50px;
}
header {
        background-color: lightblue;
        top: 0px;
        position: fixed;
        width: 100%;
        text-align: center;
    }


label {
    font-size: 18px;
}

select {
    height: 25px;
    width: 150px;
    text-align: center;
    border: 1px solid black;
}

form select {
    background: transparent ;
}

a {
    text-decoration: none;
    color: black
}

a:hover {
    text-decoration: underline;
}

</style>
</html>
