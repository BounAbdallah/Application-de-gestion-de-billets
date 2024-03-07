
<?php
require_once "../php/config.php";

// Vérification de l'existence de l'ID dans l'URL et récupération des données de l'idée
if (isset($_GET['id']) && $_GET['id']) {
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM Billets WHERE id = :id";

    $requete = $conn->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $result = $requete->fetch();

    // Récupération des valeurs
    if ($result) {
        $id = $result['id'];
        $id_client = $result['id_client'];
        $date_reservation = $result['date_reservation'];
        $heure_reservation = $result['heure_reservation'];
        $prix = $result['prix'];
        $date_depart = $result['date_depart'];
        $heure_depart = $result['heure_depart'];
        $date_arrivee = $result['date_arrivee'];
        $heure_arrivee = $result['heure_arrivee'];
        $destination = $result['destination'];
        $statut = $result['statut'];
        $nombre_place = $result['nombre_place'];
    }
}

// Traitement du formulaire de mise à jour
if (isset($_POST['submit'])) {
    $id = strip_tags($_POST['id']);
    $id_client = strip_tags($_POST['id_client']);
    $date_reservation = strip_tags($_POST['date_reservation']);
    $heure_reservation = strip_tags($_POST['heure_reservation']);
    $prix = strip_tags($_POST['prix']);
    $date_depart = strip_tags($_POST['date_depart']);
    $heure_depart = strip_tags($_POST['heure_depart']);
    $date_arrivee = strip_tags($_POST['date_arrivee']);
    $heure_arrivee = strip_tags($_POST['heure_arrivee']);
    $destination = strip_tags($_POST['destination']);
    $statut = strip_tags($_POST['statut']);
    $nombre_place = strip_tags($_POST['nombre_place']);

    // Exécution de la requête de mise à jour
    $sql_update = "UPDATE Billets SET id_client = :id_client, date_reservation = :date_reservation, heure_reservation = :heure_reservation, prix = :prix, date_depart = :date_depart, heure_depart = :heure_depart, date_arrivee = :date_arrivee, heure_arrivee = :heure_arrivee, destination = :destination, statut = :statut, nombre_place = :nombre_place WHERE id = :id";
    $requete_update = $conn->prepare($sql_update);
    $requete_update->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $requete_update->bindParam(':date_reservation', $date_reservation);
    $requete_update->bindParam(':heure_reservation', $heure_reservation);
    $requete_update->bindParam(':prix', $prix);
    $requete_update->bindParam(':date_depart', $date_depart);
    $requete_update->bindParam(':heure_depart', $heure_depart);
    $requete_update->bindParam(':date_arrivee', $date_arrivee);
    $requete_update->bindParam(':heure_arrivee', $heure_arrivee);
    $requete_update->bindParam(':destination', $destination);
    $requete_update->bindParam(':statut', $statut);
    $requete_update->bindParam(':nombre_place', $nombre_place);
    $requete_update->bindParam(':id', $id, PDO::PARAM_INT);
    $requete_update->execute();

    // Redirection vers la page d'accueil après la mise à jour
    header('Location: ../index.php');
    exit;
}

// Récupération des clients
$requete_clients = $conn->prepare("SELECT * FROM Clients");
$requete_clients->execute();
$clients = $requete_clients->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un billet</title>
</head>
<body>
    
<nav>
    <div class="navigation">
        <img src="../images/Logo.png" alt="">
    </div>
    <div class="nav-bar">
        <div class="btn-voir">
            <div class="voir-btn"><p><a href="../index.php">Voir la liste de clients</a></p></div>
        </div>
        <div class="btn-ajouter">
            <p><a href="">Ajouter un billet</a></p>
        </div>
    </div>
</nav>

<div class="contenaire">
    <div class="section-form">
        <h1>Modifier un billet</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="id_client">Client :</label>
            <select name="id_client" id="id_client">
                <?php foreach ($clients as $client) : ?>
                    <option value="<?= $client['id'] ?>" <?= ($client['id'] == $id_client) ? 'selected' : '' ?>>
                        <?= $client['prenom'] . ' ' . $client['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="date_reservation">Date de réservation :</label>
            <input type="date" id="date_reservation" name="date_reservation" value="<?= $date_reservation ?>" required>
            <label for="heure_reservation">Heure de réservation :</label>
            <input type="time" id="heure_reservation" name="heure_reservation" value="<?= $heure_reservation ?>" required>
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" value="<?= $prix ?>" required>
            <label for="date_depart">Date de départ :</label>
            <input type="date" id="date_depart" name="date_depart" value="<?= $date_depart ?>" required>
            <label for="heure_depart">Heure de départ :</label>
            <input type="time" id="heure_depart" name="heure_depart" value="<?= $heure_depart ?>" required>
            <label for="date_arrivee">Date d'arrivée :</label>
            <input type="date" id="date_arrivee" name="date_arrivee" value="<?= $date_arrivee ?>" required>
            <label for="heure_arrivee">Heure d'arrivée :</label>
            <input type="time" id="heure_arrivee" name="heure_arrivee" value="<?= $heure_arrivee ?>" required>
            <label for="destination">Destination :</label>
            <input type="text" id="destination" name="destination" value="<?= $destination ?>" required>
            <label for="statut">Statut :</label>
            <select name="statut" id="statut" required>
                <option value="Payer" <?= ($statut == 'Payer') ? 'selected' : '' ?>>Payer</option>
                <option value="Annulé" <?= ($statut == 'Annulé') ? 'selected' : '' ?>>Annulé</option>
                <option value="Réserver" <?= ($statut == 'Réserver') ? 'selected' : '' ?>>Réserver</option>
                <option value="Libre" <?= ($statut == 'Libre') ? 'selected' : '' ?>>Libre</option>
            </select>
            <label for="nombre_place">Nombre de places :</label>
            <input type="number" id="nombre_place" name="nombre_place" value="<?= $nombre_place ?>" required>
            <button type="submit" name="submit" class="btn">Modifier</button>
        </form>
    </div>
</div>
</body>
</html>
