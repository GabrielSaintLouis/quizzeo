<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "fonction-ban.php"?>
    <?php include "header.php" ?>
    <div class = "container">
    <form action="chercher_quizz.php">
        <h1>Participer à un Quizz</h1>
        <h3>Rentrer l'Identifiant du Quizz</h3>
        <label for="id-quizz"><input type="number"></label><br><br><br>
        <button type = "submit">Participer</button><br><br>
    </form>
    </div>
    <?php include "footer.php" ?>
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

input{
    width: 200px;
    height: 60px;
    text-align: center;
    font-size: 50px;
}
.container {
    border: 1px solid black;
    width: 500px;
    text-align: center;
    background-color: white;
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
    color: black;
    width: 200px;
    height: 50px;
    font-family: "Anton", sans-serif;
    font-size: 15px;
    background: lightblue;
    color: white;
    border: 1px solid black;
}
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

    nav ul img {
        width: auto;
        height: 50px;
    }


label {
    font-size: 25px;
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