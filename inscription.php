<?php
include 'styleHead.php';
session_start();
?>


<div class="titre">
    <h1>S'enregistrer</h1>
</div>

<div class="container">

    <form class='formulaire' method="POST" action="inscription.php">
        <div> <label for="name">Nom :</label> <input type="text" id="name" name="nom"> </div>
        <br>
        <div> <label for="subname">Prénom :</label><input type="text" id="subname" name="prenom"> </div>
        <br>
        <div> <label for="email">Email :</label> <input type="email" id="email" name="email"> </div>
        <br>
        <div> <label for="mdp">Mot de passe :</label> <input type="password" id="mdp" name="mdp"> </div>
        <br>
        <input type="submit" value="S'enregistrer" class="buttonstyle">
    </form>


    <?php
    if (!empty($_POST)) { //si formulaire envoyé >cela permet de ne pas aller direct sur le else quand on charge la page
        if ((!empty($_POST)) && (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["mdp"])) && (!empty($_POST["nom"])) && (!empty($_POST["prenom"]))
            && (!empty($_POST["email"])) && (!empty($_POST["mdp"]))
        ) {
            $nomU = strip_tags($_POST["nom"]); //on peut utiliser un array map
            $prenomU = strip_tags($_POST["prenom"]); //strip_tags enlève les balises, il existe aussi htmlentities
            $emailU = strip_tags($_POST["email"]);
            var_dump($emailU);
            if (!filter_var($emailU, FILTER_VALIDATE_EMAIL)) { //filter_var permet de verif l'email, on peut lke faire aussi avec les regex
                die("Le mail est incorrect");
            }
            $pass = password_hash($_POST["mdp"], PASSWORD_ARGON2ID); //hasher le MDP ; ARGON2ID est une constante
            $roleU = "user"; //on part du principe que l admin ne d 'enregistre pas par le site, donc tous ceux qui s'enregistrent, sont user par defaut
            $mysqli = new mysqli("localhost", "root", "", "caveavins");
            $stmt = $mysqli->prepare("INSERT INTO user (nom, prenom, email, mdp, role) VALUES (?, ?, ?, ?,?)");
            $stmt->bind_param("sssss", $nomU, $prenomU, $emailU, $pass, $roleU);
            $stmt->execute();


            header('Location: connexion.php');
            //exit();
        } else {
            die('le formulaire est incomplet');
            // echo  '<a href="inscription.php" class="buttonstyle" type="button">Retourner au formulaire</a>';
        }
    }



    ?>


</div>
<?php
include 'footer.php';
?>