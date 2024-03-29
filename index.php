<?php
require_once "php/config.php";


$requete = $conn->prepare("SELECT * FROM `billets` ORDER BY `id` ASC");
$requete->execute();
 
$requete = $conn->prepare("SELECT b.*, c.nom AS nom_client, c.prenom AS prenom_client 
FROM Billets b INNER JOIN Clients c ON b.id_client = c.id WHERE b.id_client = id_client;");
$requete->execute();

$nombre_client_query = $conn->query("SELECT COUNT(*) AS total_clients FROM clients");
$resultat = $nombre_client_query->fetch(PDO::FETCH_ASSOC);
$nombre_client = $resultat['total_clients'];
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
            <div class="client_total"><h5>Clients total : </h5><span><?php echo $nombre_client ?></span></div>
            <div class="voir-btn"><p><a href="php/dashbaord.php">Acceder au tableau de bord</a></p></div>
        </div>
            <div class="btn-ajouter">
            <p><a href="php/add_clients.php">Ajouter un client</a></p>
            <p><a href="php/add_billets.php">Ajouter un  biellet</a></p>
            </div>
        </div>
    </nav>

    <div class="titre">
        <h2>Liste de resérvation :</h2>
    </div>
    <div class="card-contenaire">
<?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>
        <div class="card">
            <h3 class="id">Resérvation nº : <span><?php echo $row["id"] ?></span> </h3>
            <h3 class="passager">Passager : <span><?php echo $row["prenom_client"] ?></span></h3>
            <h3 class="date_reservation">Reserver le : <span><?php echo $row["date_reservation"] ?></span></h3>
            <h3 class="date_depart" ><img src="images/callendrier.png" alt="">Depart le : <span><?php echo $row["date_depart"] ?></span></h3>
            <h3 class="heure_depart" >Heure de l'embarquement : <span><?php echo $row["heure_depart"] ?></span></h3>
            <h3 class ="date_arrive"><img src="images/callendrier.png" alt=""> Arrivé :<span><?php echo $row["date_arrivee"] ?></span></h3>
            <h3 class="heure_arrive">Heure d'arrivé : <span><?php echo $row["heure_arrivee"] ?></span> </h3>
            <h3 class="destination"><img src="images/Icon-avion.png" alt="">Destination : <span><?php echo $row["destination"] ?></span></h3>
            <h3 class="prix"><span><?php echo $row["prix"] ?> </span> FCFA</h3>
            <h3 class ="place"> <img src="images/personne.png" alt="">Places :<span><?php echo $row["nombre_place"] ?> </span> place(s)</h3>
            <h3 class="statut">Statut : <span><?php echo $row["statut"] ?></span> </h3>
            <div class="btn">
                <div class="update">
                    <a href="php/update_billets.php?id=<?php echo $row['id'] ?>">modifier</a>
                </div>
                <div class="delete">
                    <a href="php/delete.php?id=<?php echo $row['id'] ?>">Supprimer</a>
                </div>
            </div>

        </div> 
        <?php endwhile?>

    </div>
</body>
</html>
            