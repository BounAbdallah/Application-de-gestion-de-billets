<?php
require_once "php/config.php";


$requete = $conn->prepare("SELECT * FROM `billets` ORDER BY `id` ASC");
$requete->execute();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
    <nav>
        <div class="navigation">
            <img src="images/Logo.png" alt="">
        </div>
        <div class="nav-bar">
            <div class="btn-voir">
                <div class="voir-btn"><p><a href="">voir la liste de clients</a></p></div>
            </div>
            <div class="btn-ajouter">
            <p><a href="php/add_clients.php">Ajouter un client</a></p>
            <p><a href="">Ajouter un  biellet</a></p>
            </div>
        </div>
    </nav>
    <div class="titre">
        <h2>Liste de resérvation :</h2>
    </div>
    <div class="card-contenaire">
<?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>
        <div class="card">
            <h3>Resérvation nº : <span><?php echo $row["id"] ?></span> </h3>
            <h3>Passager : <span><?php echo $row["id_client"] ?></span></h3>
            <h3>Reserver le : <span><?php echo $row["date_reservation"] ?></span></h3>
            <h3>Date du depart le : <span><?php echo $row["date_depart"] ?></span></h3>
            <h3>Heure de l'embarquement : <span><?php echo $row["heure_depart"] ?></span></h3>
            <h3>Date d'arrivé le : <span><?php echo $row["date_arrivee"] ?></span></h3>
            <h3>Heure d'arrivé : <span><?php echo $row["heure_arrivee"] ?></span> </h3>
            <h3>Destination : <span><?php echo $row["destination"] ?></span></h3>
            <h3>Nobre de places resérver : <span><?php echo $row["nombre_place"] ?></span>place(s)</h3>
            <h3>Statut : <span><?php echo $row["statut"] ?></span> </h3>
            <h3>Statut : <span><?php echo( $row["prix"]*$row['nombre_place']) ?></span> </h3>
        </div> 
        <?php endwhile?>

    </div>
</body>
</html>
            