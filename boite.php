<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Boîte de dialogue</title>
<link rel="stylesheet" href="boitedialogue.css">
</head>
<body>
<?php include "header.php" ?>
<?php include "style.php" ?>
<?php include "footer.php" ?>

<div id="boite_d" class="boite_d">
  <div class="content">
    <span class="close">&times;</span>
    <!--Ici les informations de la boîte dialogue seront recupérées et envoyées vers la page de création -->
    <h2>Informations du quiz</h2>
    <form id="myForm" action="quiz.php" method="post">
      <input type="number"  name="nbq" placeholder = "Entrer le nombre de questions " required><br/>
      <input type="number"  name="np" placeholder = "Entrer le nombre de propositions par question  " required><br/>
      <input type="submit"  value="Soumettre">
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var boite_d = document.getElementById('boite_d');
    var openButton = document.getElementById('open-boite_d');
    var closeButton = boite_d.querySelector('.close');
    var form = document.getElementById('myForm');

    openButton.addEventListener('click', function() {
        boite_d.style.display = 'block';  //Ouvre la boîte de dialogue
    });

    closeButton.addEventListener('click', function() {
        boite_d.style.display = 'none'; //Ferme la boîte de dialogue
    });

    form.addEventListener('submit', function() {
        boite_d.style.display = 'none'; // Ferme la boîte de dialogue
        window.location.href = this.action;  // Redirige vers la page quiz.php
    });
});
</script>
<style>
  /* boîte de dialogue */
  .content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 500px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
  }

  /* champs du form */
  .content input[type="number"],
  .content input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  /* style du button submit */
  .content input[type="submit"] {
    background-color: orange;
    color: white;
    border: none;
    cursor: pointer;
  }

  .content input[type="submit"]:hover {
    background-color: #45a049;
  }

  /* Style pour le lien de fermeture */
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
<body>
</html>