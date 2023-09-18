<?php
include 'styleHead.php';
session_start();
?>

<div class="titre">
    <h1>Se connecter</h1>
</div>

<div class="container">


    <form class='formulaire' method="POST" action="connexion.php">
        <div> <label for="email">Email :</label> <input type="email" id="email" name="email"> </div>
        <br>
        <div> <label for="mdp">Mot de passe :</label> <input type="password" id="mdp" name="mdp"> </div>
        <br>
        <input type="submit" value="Se connecter" class="buttonstyle">
    </form>
    <br>
    <h5>Si vous n'avez pas de compte, vous pouvez vous enregistrer :</h5>

    <div class="botton">
        <a href="inscription.php" class="buttonstyle" type="button">S'enregistrer</a>
    </div>


    <?php

    if (!empty($_POST)) { //si formulaire envoyé >cela permet de ne pas aller direct sur le else quand on charge la page
        if (isset($_POST["email"], $_POST["mdp"]) && !empty($_POST["email"]) && !empty($_POST["mdp"])) {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                die("Ceci n'est pas un email");
            }
            $mysqli = new mysqli("localhost", "root", "", "caveavins");
            $stmt = $mysqli->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->bind_param("s", $_POST["email"]);
            $stmt->execute();
            $stmt->bind_result($uid, $userN, $userP, $userE, $userM, $userR);
            $stmt->fetch();
            $stmt->close();

            if ($userE != $_POST["email"]) {
                die("données erronées1");
            }
            if (!password_verify($_POST['mdp'], $userM)) {
                die("Données erronées2");
            }

            session_start();  //session start permet de demarrer la session
            //ma session est un tableau dans lequel on stock ce dont on a besoin tt au long de la durée de session
            $_SESSION["user"] = [
                "email" => $userE,
                "nom" => $userN,
                "id" => $uid
            ];
            header("Location: index.php"); //pas d 'espace entre Location et : sinon error 404
        }
    }



    ?>


</div>
<?php
include 'footer.php';
?>