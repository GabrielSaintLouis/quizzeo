<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pseudo = $_POST['pseudo'];
    
    $userData = [$type, $email, $password, $pseudo];
    
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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<header>
    <nav>
        <ul>
            <?php
            if (isset($_SESSION["type"])) {
                header("Location: accueil.php");
            }
            ?>
            <img src="quizzeo.png" alt="quizzeo">
        </ul>
    </nav>
</header>
<div class="container">
<h1>Page d'inscription</h1>
<form action="inscription.php" method="post" onsubmit="validateForm()">
    <label for="type">Type: </label><br>
    <select name="type" id="option_type" required>
        <option value="entreprise">Entreprise</option>
        <option value="ecole">Ecole</option>
        <option value="utilisateur">Utilisateur</option>
    </select><br><br>
    <label for="pseudo">Pseudonyme :</label><br>
    <input type="text" id="pseudo" name="pseudo" required maxlength="30"><br><br>
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required maxlength="30"><br><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required maxlength="30">
    <span id="togglePassword" onclick="togglePasswordVisibility()">
    <i class='bx bx-show'></i>
    </span><br><br>
    <button type="submit" id = "inscription">S'inscrire</button><br><br> 
    <div class="g-recaptcha" data-sitekey="6LfPd5wpAAAAAB6yVgL3sSJvW7nGkH8u6vsrWskv"></div>
</form>
<p id="connexion">Vous avez déjà un compte ? <a href="index.php">Connexion</a></p>
<div id="delai"></div>
</div>
<?php include 'footer.php'; ?>
<script src="script.js"></script>
<script>
function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var toggleButton = document.getElementById("togglePassword");
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleButton.innerHTML = '<i class="bx bx-hide"></i>';
    } else {
        passwordField.type = "password";
        toggleButton.innerHTML = '<i class="bx bx-show"></i>';
    }
}
</script>

</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@100;300;400;500&display=swap');
/* keyframes  */

/* Définition des @keyframes pour l'animation de secousse */
@keyframes bounce {
        0%, 20%,50%,80%,100% {
                transform: translateY(0);
            }
        40% {
            transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
        
/* Application de l'animation de secousse à l'élément */
#connexion {
    animation: bounce 0.5s ease infinite ;
    animation-duration:1.5s  ;
}

/* body */
body {
    font-family: "Roboto", sans-serif;
    padding: 150px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-image: url(fond.gif);
}

.container {
    border: 1px solid black;
    width: 600px;
    text-align: center;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius:  20px;
    background-color: rgba(255, 255, 255, 0.8);
}
footer {
    bottom: 0px;
    position: fixed;
    width: 100%;
    height: 50px;
    background-color: rgba(255, 255, 255, 0.8);
    color: black;
}

button {
    background: white;
    color: black;
    width: 170px;
    height: 50px;
}
#inscription {
    width: 170px;
    height: 50px;
    font-family: "Anton", sans-serif;
    font-size: 15px;
    background: red;
    color: white;
    border: 1px solid black;
}
header {
        top: 0px;
        position: fixed;
        background-color: rgba(255, 255, 255, 0.8);
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

    nav ul img {
        width: auto;
        height: 50px;
    }


label {
    font-size: 18px;
    font-weight: bold;
}

form {
    width: 100%; /* S'assurer que le formulaire occupe toute la largeur du conteneur */
    max-width: 300px; /* Limitation de la largeur pour éviter un étirement excessif */
    display: flex;
    flex-direction: column;
    align-items: center;
}

input {
    margin-bottom: 4px;
    width: 100%; 
    padding: 8px; 
    box-sizing: border-box; 
    text-align: center;
}
select {
    margin-bottom: 10px;
    width: 100%;
    padding: 8px;
    text-align: center;
    border: 1px solid black;
}

form select {
    background: transparent ;
}

a {
    text-decoration: none;
    color: black;
}

a:hover {
    text-decoration: underline;
}

</style>
</html>
