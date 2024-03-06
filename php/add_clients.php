
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de clients</title>
</head>
<body>
    
<nav>
        <div class="navigation">
            <img src="../images/Logo.png" alt="">
        </div>
        <div class="nav-bar">
            <div class="btn-voir">
                <div class="voir-btn"><p><a href="../index.php">voir la liste de clients</a></p></div>
            </div>
            <div class="btn-ajouter">
            <p><a href="">Ajouter un  biellet</a></p>
            </div>
        </div>
    </nav>

<?php 
require_once "../php/config.php";

;
$requete = $conn->prepare("SELECT * FROM `clients` ORDER BY `id` DESC LIMIT 4");
$requete->execute();
 
?>

    <div class="contenaire">
        <div class="section-form">
            <form action= "verification_client.php " method="POST">
            <!-- <label for="name" >Prenom</label> -->
            <input type="texte"  id="nom" name="prenom"  placeholder="Entrez votre nom">
            <!-- <label for="name" >Nom</label> -->
            <input type="texte"  id="nom" name="nom"  placeholder="Entrez votre nom">
            <!-- <label for="email">Email</label> -->
            <input type="email" id="email" name="email" placeholder="you@exemple.com">
            <!-- <label for="phone">Téléphone</label> -->
            <input type="phone" id="telephone" name="telephone"  placeholder="+221770606062">
            <input type="location" id="adresse" name="adresse"  placeholder="Medina, rue 5 x 13 Dakar,SENEGAL">
            <button type="submit" class="btn">Ajouter </button>

            </form>
        </div>
        <div class="section-liste">
            <h1>Clients enregistré  recémment</h1>
            <?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>
            <div class="client">
            

                <h3><span><?php echo $row["prenom"] ?></span> <span> <?php echo $row["nom"] ?></span></h3>
            </div>
            <?php endwhile?>
        </div>

    </div>
</body>
</html>
