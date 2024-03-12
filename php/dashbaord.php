

<?php
require_once "config.php";


$requete = $conn->prepare("SELECT * FROM `billets` ORDER BY `id` DESC LIMIT 2");
$requete->execute();
 
$requete_clients = $conn->prepare("SELECT * FROM `clients` ORDER BY `id` DESC LIMIT 4");
$requete_clients->execute();

// Sélection des détails des billets avec les informations client
$requeteDetails = $conn->prepare("SELECT b.*, c.nom AS nom_client, c.prenom AS prenom_client 
FROM Billets b INNER JOIN Clients c ON b.id_client = c.id ORDER BY b.id DESC LIMIT 2");
$requeteDetails->execute();

$nombre_client_query = $conn->query("SELECT COUNT(*) AS total_clients FROM clients");
$resultat = $nombre_client_query->fetch(PDO::FETCH_ASSOC);
$nombre_client = $resultat['total_clients'];


$nombre_client_query = $conn->query("SELECT COUNT(*) AS total_reservation FROM Billets");
$resultat = $nombre_client_query->fetch(PDO::FETCH_ASSOC);
$total_reservation = $resultat['total_reservation'];



$nombre_reserve_payer = $conn->query("SELECT COUNT(*) AS nombre_reserve_payer FROM Billets where statut = 'payer'");
$resultat = $nombre_reserve_payer->fetch(PDO::FETCH_ASSOC);
$total_reservation_payer = $resultat['nombre_reserve_payer'];


$nombre_reserve_annuler = $conn->query("SELECT COUNT(*) AS nombre_reserve_annuler FROM Billets where statut = 'Annulé'");
$resultat = $nombre_reserve_annuler->fetch(PDO::FETCH_ASSOC);
$total_reservation_annuler = $resultat['nombre_reserve_annuler'];
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/dashbaord.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <div class="top-bar">
        <div class="logo"><img src="../images/logo.png" alt=""></div>
        <div class="bouton">
            <div class="btn-new-client"><a href="../index.php"> <img src="../images/icon_home.svg" alt=""></a></div>
            <div class="btn-new-client"><a href="add_clients.php">Ajouter un client</a></div>
            <div class="btn-new-client"><a href="add_billets.php">Ajouter un Billet</a></div>
        </div>
    </div>
    <div class="section-principal">
        <div class="nav-bar">
            <div class="btn-nav">
                <span><a href="liste_clients.php">Nombre de clients :<span><?php echo $nombre_client ?></span></a></span>
            </div>
            <div class="btn-nav"id="reserver">
                <span><a href="../index.php">Nombre de réservations : <span><?php echo $total_reservation ?></span></a></span>
            </div>
            <div class="btn-nav" id="payer">
                <span><a href="#">Réservation payer  : <span><?php echo $total_reservation_payer ?></span></a></span></a></span>
            </div>
            <div class="btn-nav" id="annuler">
                <span><a href="#">Réservation annulées : <span><?php echo $total_reservation_annuler ?></span></a></span>
            </div>
        </div>
        <div class="contenaire">
            <div class="titre"><h1> Billet ajouter récemment</h1></div>
            <div class="card-contenaire">
            <?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>

                <div class="card">
                    <h3 class="id">Resérvation nº : <span><?php echo $row["id"] ?></span> </h3>
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
                            <a href="update_billets.php?id=<?php echo $row['id'] ?>">modifier</a>
                        </div>
                        <div class="delete">
                            <a href="delete.php?id=<?php echo $row['id'] ?>">Supprimer</a>
                        </div>
                    </div>
                </div>
                <?php endwhile?>
            </div> 
            <div class="espace"><h1> 4 derniers client ajouter </h1></div>
            <div class="card-contenaire">
            <?php while ($row = $requete_clients->fetch(PDO::FETCH_ASSOC)) :?>
                <a href="detail_client.php?id=<?php echo $row['id'] ?>">
                <div class="card-client">
                        <h3>
                            <?php echo $row['prenom'] ?><br>
                            <?php echo $row['email'] ?> 
                        </h3>

                </div>
            </a>
                <?php endwhile?>
            </div> 
    </div>
</body>
</html>