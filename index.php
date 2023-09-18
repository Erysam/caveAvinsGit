<?php
include 'styleHead.php';

session_start();
//var_dump($_SESSION["user"]["email"]);
//var_dump($_SESSION);

if (!isset($_SESSION) || !isset($_SESSION["user"]["email"], $_SESSION["user"]["id"])) {
    header('Location: connexion.php');
    exit();
}


?>

<div class="container">


    <div class="titre">
        <h1>Cave à vins</h1>
    </div>
    <div class="botton">
        <a href="ajoutvins.php" class="buttonstyle" type="button">Ajouter vins</a>
        <!--  <a href="formmodifvin.php" class="buttonstyle" type="button">Modifier vins</a><br>
            <a href="formbouteille.php" class="buttonstyle" type="button">Ajouter bouteilles</a>
            <a href="formbouteille.php" class="buttonstyle" type="button">Supprimer bouteilles</a><br>-->

    </div>
    <div class="imageidx">
        <img src="images/cavebouteillesredim.jpg" alt="A wine cellar with barrel, bottles and glasses" class="imageidx">
    </div>


</div>
<?php
include 'footer.php';
?>