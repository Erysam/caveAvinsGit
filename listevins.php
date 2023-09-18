<?php include 'styleHead.php';
session_start();
if (isset($_GET['type'])) {
    $typecouleurvin = $_GET['type'];
}
if (isset($_POST['type'])) {
    $typecouleurvin = $_POST['type'];
};

if (!isset($_SESSION) || !isset($_SESSION["user"]["email"], $_SESSION["user"]["id"])) {
    header('Location: connexion.php');
}

?>

<div class="container">

    <div class="titre">
        <h1>Vins
            <?php
            $idsession = $_SESSION["user"]["id"];
            //var_dump($idsession);
            if ($typecouleurvin === 'rose') {
                $typecouleurvin = 'rosé';
            }
            if ($typecouleurvin === 'all') {
                $typecouleurvin = '';
                echo $typecouleurvin;
            } else {
                echo $typecouleurvin . 's';
            }

            ?>
        </h1>
    </div>
    <div class="imageidx">
        <img src="images/cave.png" alt="cave à vins" class="imageidx">
    </div>
    <!-- <div class="botton">
        <a href="form.php" class="buttonstyle" type="button">+ ajouter vins</a>
    </div>-->
    <div class="botton">
        <a href="index.php" class="buttonstyle" type="button">Retour</a>
    </div>
    <?php

    $mysqli = new mysqli("localhost", "root", "", "caveavins");
    $nomvin;
    $method = $_SERVER['REQUEST_METHOD'];
    //si j'ai un type de vins en get, j affiche la liste de vins du user et du même type  (rouge, blanc...) >onglet vins rouge || blanc || rosé
    if ($method == "GET" && isset($_GET["type"]) && $_GET["type"] != "all") {
        // $couleur = $_GET["type"];
        $typecolor = "'" . $_GET["type"] . "'";

        if (isset($typecolor)) {
            $q = "SELECT * from vins where type = $typecolor and userid = $idsession";
            $r = $mysqli->query($q);

            $tab = array();

            while ($row = $r->fetch_assoc()) {
                $tab[] = $row; // stock chaq ligne dans le tableau
            }
            echo '<div class="titre"> <h1>Liste des Vins ' . $typecouleurvin . 's </h1> </div>';
            echo "<table>";
            echo "<tr><th>Nom</th><th>Année</th><th>Type</th><th>Région</th><th>Ref</th><th>Quantité</th></tr>";

            foreach ($tab as $row) {
                echo "<tr>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['annee'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['region'] . "</td>";
                echo "<td>" . $row['ref'] . "</td>";
                echo "<td>" . $row['quantite'] . "</td>";

                echo '<td><form method="POST" style= "display: inline-block;" action="listevins.php">';
                echo '<input type="hidden" name="ref" value="' . $row['ref'] . '">';
                echo '<input type="hidden" name="quantite" value="' . $row['quantite'] . '">';
                echo '<input type="hidden" name="type" value="' . $row['type'] . '">';
                echo '<input type="submit" name="ajout" value="+"class="buttonstyle">';
                echo '<input type="submit" name="supp" value="-" class="buttonstyle"></input>' . "</form></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    if (isset($_GET["type"]) && $_GET["type"] == "all") { // j affiche tous les vins du user si type == all > onglet liste vins

        $q = "SELECT * from vins where userid = $idsession";
        $r = $mysqli->query($q);

        $tab = array();

        while ($row = $r->fetch_assoc()) {
            $tab[] = $row; // stock chaq ligne dans le tableau
        }
        echo '<div class="titre"> <h1>Liste des Vins</h1> </div>';
        echo "<table>";
        echo "<tr><th>Nom</th><th>Année</th><th>type</th><th>Région</th><th>Quantité</th><th>Code vin</th></tr>";

        foreach ($tab as $row) {
            echo "<tr>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['annee'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['region'] . "</td>";
            echo "<td>" . $row['quantite'] . "</td>";
            echo "<td>" . $row['ref'] . "</td>";
            echo '<td><form method="POST" style= "display: inline-block;" action="listevins.php">';
            echo '<input type="hidden" name="ref" value="' . $row['ref'] . '">';
            echo '<input type="hidden" name="quantite" value="' . $row['quantite'] . '">';
            echo '<input type="hidden" name="type" value="' . $row['type'] . '">';
            echo '<input type="submit" name="ajout" value="+"class="buttonstyle">';
            echo '<input type="submit" name="supp" value="-" class="buttonstyle"></input>' . "</form></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    //si j'ajoute une quantite à un vin, j incremente quantité du vin referencé
    if (isset($_POST["ref"]) && isset($_POST["quantite"]) && isset($_POST["ajout"]) && empty($_POST["supp"])) {

        $quantiteplusun = $_POST["quantite"] + 1;
        $q = "UPDATE vins SET quantite = ? WHERE ref = ?";
        $stmt = $mysqli->prepare($q);
        $stmt->bind_param("ii", $quantiteplusun, $_POST["ref"]);
        $stmt->execute();

        //je cree une bouteille dans la table bouteille, avec un date de depot(date du jour)
        $datejour = date("Y-m-d"); //obtient la date du jour
        $stmt = $mysqli->prepare("INSERT INTO bouteille (refvins, bouteille, datedepot,userid) VALUES (?, '0', ?, ?)");
        $stmt->bind_param("isi", $_POST["ref"], $datejour, $idsession);
        $stmt->execute();


        $ref = $_POST['ref'];
        $q = "SELECT * from vins where ref = $ref";
        $r = $mysqli->query($q);

        $tab = array();

        while ($row = $r->fetch_assoc()) {
            $tab[] = $row; // stock chaq ligne dans le tableau
        }

        $nomvin = $tab[0]['nom'];

        echo '<div class="titre"> <h1>Vin ' . $nomvin  . ' ajouté :' . ' </h1> </div>';
        echo "<table>";
        echo "<tr><th>Nom</th><th>Année</th><th>Type</th><th>Région</th><th>Ref</th><th>Quantité</th></tr>";

        foreach ($tab as $row) {
            echo "<tr>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['annee'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['region'] . "</td>";
            echo "<td>" . $row['ref'] . "</td>";
            echo "<td>" . $row['quantite'] . "</td>";
            echo '<td><form method="POST" style= "display: inline-block;" action="listevins.php">';
            echo '<input type="hidden" name="ref" value="' . $row['ref'] . '">';
            echo '<input type="hidden" name="quantite" value="' . $row['quantite'] . '">';
            echo '<input type="hidden" name="type" value="' . $row['type'] . '">';
            echo '<input type="submit" name="ajout" value="+" class="buttonstyle"></input>';
            echo '<input type="submit" name="supp" value="-" class="buttonstyle"></input>' . "</form></td>";
            echo "</tr>";
        }
        echo "</table>";
    }



    //si je supp une quantite à un vin, je la decremente
    if (isset($_POST["ref"]) && isset($_POST["quantite"]) && isset($_POST["supp"]) && empty($_POST["ajout"])) {
        if ($_POST["quantite"]) {
            $refvinsupp = $_POST["ref"];
            $refBout;
            $quantitemoinsun = $_POST["quantite"] - 1;


            $q = "UPDATE vins SET quantite = ? WHERE ref = ?";
            $stmt = $mysqli->prepare($q);
            $stmt->bind_param("ii", $quantitemoinsun, $refvinsupp);
            $stmt->execute();
            $stmt->close();


            $stmt = $mysqli->prepare("SELECT bouteille FROM bouteille WHERE refvins = ? and dateretrait IS NULL ORDER BY datedepot ASC; ");
            $stmt->bind_param("i", $refvinsupp);
            $stmt->execute();
            $stmt->bind_result($refbouteille);
            if ($stmt->fetch()) {
                // Stockage de la première bouteille dans une var
                $refBout = $refbouteille;
            }
            $stmt->close();

            $datejour = date("Y-m-d"); //obtient la date du jour
            $stmt = $mysqli->prepare("UPDATE bouteille SET dateretrait =? WHERE bouteille = ?");
            $stmt->bind_param("si", $datejour, $refBout,);
            $stmt->execute();



            $q = "SELECT * from vins where ref = $refvinsupp";
            $r = $mysqli->query($q);

            $tab = array();

            while ($row = $r->fetch_assoc()) {
                $tab[] = $row; // stock chaq ligne dans le tableau
            }

            $nomvin = $tab[0]['nom'];

            echo '<div class="titre"> <h1>Vin  ' . $nomvin . ' supprimé :' . ' </h1> </div>';
            echo "<table>";
            echo "<tr><th>Nom</th><th>Année</th><th>Type</th><th>Région</th><th>Ref</th><th>Quantité</th></tr>";

            foreach ($tab as $row) { // pourquoi remettre $tab as row alors que j ai une ligne qui le fait avec le while?
                echo "<tr>";
                echo "<td>" . $row['nom'] . "</td>";
                echo "<td>" . $row['annee'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['region'] . "</td>";
                echo "<td>" . $row['ref'] . "</td>";
                echo "<td>" . $row['quantite'] . "</td>";
                echo '<td><form method="POST" style= "display: inline-block;" action="listevins.php">';
                echo '<input type="hidden" name="ref" value="' . $row['ref'] . '">';
                echo '<input type="hidden" name="quantite" value="' . $row['quantite'] . '">';
                echo '<input type="hidden" name="type" value="' . $row['type'] . '">';
                echo '<input type="submit" name="ajout" value="+" class="buttonstyle">';
                echo '<input type="submit" name="supp" value="-" class="buttonstyle">' . "</form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "impossible de supprimé le vin designé, car quantité inferieur à 1";
        }
    }

    include 'footer.php';
    ?>