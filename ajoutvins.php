<?php include 'styleHead.php';
session_start();


if (!isset($_SESSION) || !isset($_SESSION["user"]["email"], $_SESSION["user"]["id"])) {
    header('Location: connexion.php');
}
?>


<div class="container">

    <div class="titre">
        <h1>Ajouter vin</h1>
    </div>
    <img src="images/vins.png" alt="vins" class="imageidx">
    <div class="botton">
        <a href="index.php" class="buttonstyle" type="button">Retour</a>
    </div>



    <?php
    $idsession = $_SESSION["user"]["id"];
    require_once 'RequetesSql.php';
    $maConnexBD = new RequetesSql();
    $mysqli = $maConnexBD->connexBd("caveavins");
    // $mysqli = new mysqli("localhost", "root", "", "caveavins");
    $refvininsert;

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == "POST") {
        var_dump($_POST, $idsession);
        if (isset($_POST["nom"]) && isset($_POST["type"]) && isset($_POST["annee"]) && isset($_POST["region"]) && isset($_POST["quantite"]) && isset($_POST["description"]) && isset($idsession)) {

            $q = "INSERT INTO vins (ref, nom, type, annee, region, quantite, description, userid) VALUES ('0', ?, ?, ?, ?, ?, ?,?)";
            $stmt = $mysqli->prepare($q);
            var_dump('test', $idsession);
            $stmt->bind_param("ssisisi", $_POST["nom"], $_POST["type"], $_POST["annee"], $_POST["region"], $_POST["quantite"], $_POST["description"], $idsession);
            $stmtbool = $stmt->execute();
            var_dump($stmtbool);
            $stmt->close();

            if ($_POST['quantite'] > 0) {

                $q = 'SELECT ref from vins WHERE nom = ? AND type = ?';
                $stmt = $mysqli->prepare($q);
                $stmt->bind_param("ss", $_POST["nom"], $_POST["type"]);
                $stmt->execute();
                $stmt->bind_result($vinref);

                if ($stmt->fetch()) {
                    $refvininsert = $vinref;
                }
                $stmt->close();


                for ($i = 0; $i < $_POST["quantite"]; $i++) {
                    $datejour = date("Y-m-d"); //obtient la date du jour
                    $q = "INSERT INTO bouteille (refvins, bouteille, datedepot, userid) VALUES (?,'0', ?, ?)";
                    $stmt = $mysqli->prepare($q);
                    $stmt->bind_param("ssi", $refvininsert, $datejour, $idsession);
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

    echo '<select name="type" id="type"><option value="rouge">rouge</option><option value="blanc">blanc</option><option value="rose">rose</option></select>';
    echo '</div>'; // on peut mettre des chiffres dans value car le enum se gere comme cela, on peut egalemlent mettre le nom de la valeur enum dans la BD comme rouge

    echo '<div> <label for="annee">Année :</label> <input type="number" id="annee" name="annee"> </div>';
    echo '<div> <label for="region">Région :</label> <input type="text" id="region" name="region"> </div>';
    echo '<div> <label for="quantite">Quantite bouteilles :</label> <input type="number" id="quantite" name="quantite"> </div>';
    echo '<div> <label for="description">Description :</label> <textarea id="descrition" name="description"></textarea> </div>';

    echo '<input type="submit" value="Valider" class="btn btn-primary mb-2">';
    echo '</form>';

    ?>
</div>


<?php include 'footer.php'; ?>