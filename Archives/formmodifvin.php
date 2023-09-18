<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <link rel="stylesheet" href="cavstyle.css" />
    <link rel="icon" type="images/favicon.ico" sizes="16x16" href="images/favicon.ico" />
    <title>Modifier vin</title>
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
        <img src="images/vins.png" alt="vins" class="imageidx">

        <?php
        $method = $_SERVER['REQUEST_METHOD'];
        $mysqli = new mysqli("localhost", "root", "", "caveavins");

        if ($method == "POST") {

            if (isset($_POST["nom"]) && isset($_POST["annee"]) && isset($_POST["type"])) {
                var_dump($_POST["annee"]);
                $q = 'SELECT nom, annee, region, quantite, type from vins where nom = ? and annee = ? and type = ?';
                $stmt = $mysqli->prepare($q);
                $stmt->bind_param("sss", $_POST["nom"], $_POST["annee"], $_POST["type"]);
                $stmt->execute();
            } else {

                echo '<div class="alert alert-danger" role="alert">';
                echo 'Mauvaise données !</div>';
            }
        }



        echo "<form class= 'formulaire' method=\"POST\" action=\"formmodifvin.php\">";
        echo '<div> <label for="name">Nom :</label> <input type="text" id="name" name="nom"> </div>';
        echo '<div> <label for="annee">Année :</label> <input type="number" id="annee" name="annee"> </div>';

        echo '<div> <label for="type">Type:</label><input type="text" id="type" name="type"> </div>';
        echo '<input type="submit" value="Valider" class="btn btn-primary mb-2">';
        echo '</form>';

        ?>
        <div class="botton">
            <a href="index.php" class="buttonstyle" type="button">Retour</a>
        </div>
</body>

</html>