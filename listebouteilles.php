<?php include 'styleHead.php';
session_start(); ?>

<div class="container">

    <div class="titre">
        <h1>Liste des bouteilles</h1>
    </div>
    <img src="images/vins.png" alt="vins" class="imageidx">
    <div>
        <a href="index.php" class="buttonstyle" type="button">Retour</a>
    </div>



    <?php
    $mysqli = new mysqli("localhost", "root", "", "caveavins");

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {

        if (isset($_POST["nom"]) && isset($_POST["type"]) && isset($_POST["annee"]) && isset($_POST["region"]) && isset($_POST["quantite"]) && isset($_POST["description"])) {

            $q = "INSERT INTO vins (ref, nom, type, annee, region, quantite, description) VALUES ('0', ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($q);
            $stmt->bind_param("ssisis", $_POST["nom"], $_POST["type"], $_POST["annee"], $_POST["region"], $_POST["quantite"], $_POST["description"]);
            $stmt->execute();
            $stmt->close();

            if ($_POST['quantite'] > 0) {
                $refvininsert;
                $q = 'SELECT ref from vins WHERE nom = ? AND type = ?';
                $stmt = $mysqli->prepare($q);
                $stmt->bind_param("ss", $_POST["nom"], $_POST["type"]);
                $stmt->execute();
                $stmt->bind_result($vinref);

                if ($stmt->fetch()) {
                    $refvininsert = $vinref;
                }
                $stmt->close();


                for ($i = 0; $i < $_POST['quantite']; $i++) {
                    $datejour = date("Y-m-d"); //obtient la date du jour
                    $q = "INSERT INTO bouteille (refvins, bouteille, datedepot) VALUES (?,'0', ?)";
                    $stmt = $mysqli->prepare($q);
                    $stmt->bind_param("is", $refvininsert, $datejour,);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Mauvaise données !</div>';
        }
    }

    echo "<form class= 'formulaire' method=\"POST\" action=\"form.php\">";
    echo '<div> <label for="name">Nom :</label> <input type="text" id="name" name="nom"> </div>';
    echo '<div> <label for="type">Type:</label>';

    echo '<select name="type" id="type"><option value="rouge">rouge</option><option value="2">blanc</option><option value="3">rose</option></select>';
    echo '</div>'; // on peut mettre des chiffres dans value car le enum se gere comme cela, on peut egalemlent mettre le nom de la valeur enum dans la BD comme rouge

    echo '<div> <label for="annee">Année :</label> <input type="number" id="annee" name="annee"> </div>';
    echo '<div> <label for="region">Région :</label> <input type="text" id="region" name="region"> </div>';
    echo '<div> <label for="quantite">Quantite bouteilles :</label> <input type="number" id="quantite" name="quantite"> </div>';
    echo '<div> <label for="description">Description :</label> <textarea id="descrition" name="description"></textarea> </div>';

    echo '<input type="submit" value="Valider" class="btn btn-primary mb-2">';
    echo '</form>';

    ?>
</div>
<?php
include 'footer.php';
?>