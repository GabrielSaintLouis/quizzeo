<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "fonction-ban.php" ?>
    <?php include "header.php" ?><br>
    <?php include "style.php" ?><br>
    <h1>Neuille </h1>
    <button onclick="copyPageLink()">Copier le lien de la page</button>
    <?php include "footer.php" ?>
</body>
<script>
        function copyPageLink() {
            var dummyInput = document.createElement("input");
            dummyInput.value = window.location.href;
            document.body.appendChild(dummyInput);
            dummyInput.select();
            document.execCommand("copy");
            document.body.removeChild(dummyInput);
            alert("Lien de la page copié dans le presse-papiers : " + window.location.href);
        }

</script>
</html>