
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/client.css">
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
                <div class="voir-btn"><p><a href="../index.php">voir l'accueil</a></p></div>
            </div>
            <div class="btn-ajouter">
            <p><a href="add_billets.php">Ajouter un  biellet</a></p>
            </div>
        </div>
    </nav>

<?php 
require_once "../php/config.php";

;
$requete = $conn->prepare("SELECT * FROM `clients` ORDER BY `id` ASC");
$requete->execute();
 
?>

    
        <div class="section-liste">
            <h1>Listes clients </h1>
            <?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>
            <div class="client">
            <h3>
                <a href="detail_client.php?id=<?php echo $row['id'] ?>">
                <span> <?php echo $row["prenom"] ?></span> 
                <span>  <?php echo $row["nom"]." " ?></span> 
                <span>  <?php echo " ". $row["email"] ?></span> 
                <span>  <?php echo " ". $row["telephone"] ?></span>
                </a>
            </h3>
            </div>
            <?php endwhile?>
        </div>

    </div>
</body>
</html>
