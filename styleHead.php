<!DOCTYPE html>
<html lang="fr">

<head>



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cave à vins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="cavstyle.css" />
    <link rel="icon" type="images/favicon.ico" sizes="16x16" href="images/favicon.ico" />

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            <img src="images/brandlogo2.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Cave à vins
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="listevins.php?type=rouge">Vins rouges</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listevins.php?type=blanc">Vins blancs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listevins.php?type=rose">Vins rosés</a>
                </li>
                <li class="nav-ite" m>
                    <a class="nav-link" href="listevins.php?type=all">Liste des vins</a>
                </li>
                <li class="nav-ite" m>
                    <a class="nav-link" href="inscription.php">S'enregistrer</a>
                </li>
                <li class="nav-ite" m>
                    <a class="nav-link" href="connexion.php">Se connecter</a>
                </li>
                <li class="nav-ite" m>
                    <a class="nav-link" href="deconnexion.php">Se déconnecter</a>
                </li>
            </ul>
        </div>
    </nav>