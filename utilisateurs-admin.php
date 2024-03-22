<?php
// vérifie si l'utilisateur a les permissions
session_start();
if ($_SESSION["type"] != "admin") {
    header("Location: accueil.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "header.php" ?><br>
    <?php include "style.php" ?><br>
    <title>Liste des utilisateurs</title>
</head>
<body>
<div class="container">
<h2>Liste des utilisateurs</h2>

<table>
    <tr>
        <th>Type</th>
        <th>Mail</th>
        <th>Mot de passe</th>
        <th>Pseudo</th>
        <th>État</th> <!-- Nouvelle colonne pour l'état -->
        <th>Action</th> <!-- Nouvelle colonne pour les boutons -->
    </tr>
    
    <?php
    // Traitement des formulaires
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Traitement de la désactivation
        if (isset($_POST['disable'])) {
            $email = $_POST['email'];
            addToBanList($email);
        }
        // Traitement de la réactivation
        if (isset($_POST['enable'])) {
            $email = $_POST['email'];
            removeFromBanList($email);
        }
    }

    // Lecture du fichier users.csv
    $file = fopen('users.csv', 'r');
    if ($file !== false) {
        // Parcourir chaque ligne du fichier
        while (($data = fgetcsv($file, 1000, ",")) !== false) {
            echo "<tr>";
            // Afficher chaque champ dans une cellule
            foreach ($data as $value) {
                // Vérifier si la valeur est définie avant de l'afficher
                if(isset($value)){
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                } else {
                    echo "<td></td>";
                }
            }
            // Vérifier si le tableau $data contient au moins deux éléments
            if(count($data) >= 2){
                // Afficher l'état (Activé/Désactivé)
                echo "<td>";
                if (!in_array($data[1], getUserEmailsFromBanList())) {
                    echo "Activé";
                } else {
                    echo "Désactivé";
                }
                echo "</td>";
                // Boutons Désactiver ou Réactiver
                echo "<td>";
                if (!in_array($data[1], getUserEmailsFromBanList())) {
                    echo "<form method='post'><input type='hidden' name='email' value='" . $data[1] . "'><input type='submit' name='disable' value='Désactiver'></form>";
                } else {
                    echo "<form method='post'><input type='hidden' name='email' value='" . $data[1] . "'><input type='submit' name='enable' value='Réactiver'></form>";
                }
                echo "</td>";
            } else {
                echo "<td></td><td></td>"; // Ajouter des cellules vides
            }
            echo "</tr>";
        }
        fclose($file);
    }

    // Fonction pour obtenir la liste des e-mails bannis
    function getUserEmailsFromBanList() {
        $emails = array();
        $file = fopen('ban.csv', 'r');
        if ($file !== false) {
            while (($data = fgetcsv($file, 1000, ",")) !== false) {
                $emails[] = $data[0];
            }
            fclose($file);
        }
        return $emails;
    }

    // Fonction pour ajouter un e-mail à la liste des bannis
    function addToBanList($email) {
        $banFile = fopen('ban.csv', 'a');
        if ($banFile !== false) {
            fputcsv($banFile, array($email));
            fclose($banFile);
            echo "<script>alert('Utilisateur désactivé avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de la désactivation de l'utilisateur.');</script>";
        }
    }

    // Fonction pour enlever un e-mail de la liste des bannis
    function removeFromBanList($email) {
        $tempFile = fopen('temp.csv', 'w');
        if ($tempFile !== false) {
            $banFile = fopen('ban.csv', 'r');
            if ($banFile !== false) {
                while (($data = fgetcsv($banFile, 1000, ",")) !== false) {
                    if ($data[0] !== $email) {
                        fputcsv($tempFile, $data);
                    }
                }
                fclose($banFile);
            }
            fclose($tempFile);
            // Renommer temp.csv à ban.csv
            rename('temp.csv', 'ban.csv');
            echo "<script>alert('Utilisateur réactivé avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de la réactivation de l'utilisateur.');</script>";
        }
    }
    ?>

</table>
</div>
<?php include "footer.php"?>
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

/* Styles pour la table */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
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
    width: auto;
    text-align: center;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius:  20px;
    background-color: rgba(255, 255, 255, 0.8);
}

button {
    background-color: rgba(255, 255, 255, 0.8);
    color: black;
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
            background-color: #f44336;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
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
