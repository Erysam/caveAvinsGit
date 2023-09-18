<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <link rel="stylesheet" href="cavstyle.css" />
    <link rel="icon" type="images/favicon.ico" sizes="16x16" href="images/favicon.ico" />
    <title>Bouteilles</title>
</head>

<body>

    <div class="container">

        <nav class="Cave à vin">
            <ol>
                <li class="navigbar"><a href="listevins.php?type=rouge">Vins rouges</a></li>
                <li class="navigbar"><a href="listevins.php?type=blanc">Vins blancs</a></li>
                <li class="navigbar"><a href="listevins.php?type=rose">Vins rosés</a></li>
            </ol>
        </nav>
        <div class="titre">
            <h1>Cave à vins</h1>
        </div>
        <img src="images/cave.png" alt="vins" class="imageidx">

        <?php
        $method = $_SERVER['REQUEST_METHOD'];
        $mysqli = new mysqli("localhost", "root", "", "caveavins");

        ?>
        <div class="botton">
            <a href="index.php" class="buttonstyle" type="button">Retour</a>
        </div>
</body>

</html>