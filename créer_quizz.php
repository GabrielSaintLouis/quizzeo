<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Créer un quiz</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h1>Créer un nouveau quiz</h1>
    <form action="save_quiz.php" method="post">
        <input type="text" name="quizName" placeholder="Nom du quiz">
        <div id="questionsContainer"></div><br> 
        <button type="button" onclick="ajouterQuestion()">Ajouter une question</button>
        <button type="button" onclick="supprimerQuestion()">Supprimer la dernière question</button><br>
        <button type="submit">Valider</button>
    </form>
</div>
<script src="script.js"></script>
</body>
<style>

    h1  {
        display: flex;
        justify-content: center;
        align-items: center;
    }
        .container {
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input, button {
    margin: 5px;
}

.question {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
}

.question input, .question textarea {
    margin-bottom: 5px;
}

</style>
</html>

