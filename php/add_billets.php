<?php
require_once "../php/config.php";


?>




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
            <p><a href="add_clients.php">Ajouter un  client</a></p>
            </div>
        </div>
    </nav>

<?php 


;
$requete = $conn->prepare("SELECT b.*, c.nom AS nom_client, c.prenom AS prenom_client 
FROM Billets b INNER JOIN Clients c ON b.id_client = c.id WHERE b.id_client = id_client;");
$requete->execute();


$requete_clients = $conn->prepare("SELECT * FROM Clients");
$requete_clients->execute();
$clients = $requete_clients->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="contenaire">
        <div class="section-form">
            <form action= "verification_billet.php " method="POST">
            <!-- <label for="name" >Prenom</label> -->
            <!-- <label for="id_client">Client :</label> -->
            <select name="id_client" id="id_client">
                <?php foreach ($clients as $client) : ?>
                    <option value="<?= $client['id'] ?>" <?= ($client['id'] ) ? 'selected' : '' ?>>
                        <?= $client['prenom'] . ' ' . $client['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="date"  id="date_reservation" name="date_reservation"  placeholder="Entrez votre nom">
            <!-- <label for="name" >Nom</label> -->
            <input type="time"  id="heure_reservation" name="heure_reservation"  placeholder="Entrez votre nom">
            <!-- <label for="email">Email</label> -->
            <input type="int" id="prix" name="prix" placeholder="250.000 fcfa">
            <!-- <label for="phone">Téléphone</label> -->
            <input type="date" id="date_depart" name="date_depart"  placeholder="+221770606062">
            <input type="time" id="heure_depart" name="heure_depart"  placeholder="Medina, rue 5 x 13 Dakar,SENEGAL">
            <input type="date" id="date_arrivee" name="date_arrivee"  placeholder="Medina, rue 5 x 13 Dakar,SENEGAL">
            <input type="time" id="heure_arrivee" name="heure_arrivee"  placeholder="Medina, rue 5 x 13 Dakar,SENEGAL">
            <input type="text" id="destination" name="destination"  placeholder="DAKAR">
            <select name="statut" id="statut" required>
                <option  value="Payer" <?= ('Payer') ? 'selected' : '' ?>>Payer</option>
                <option value="Annulé" <?= ( 'Annulé') ? 'selected' : '' ?>>Annulé</option>
                <option value="Réserver" <?= ('Réserver') ? 'selected' : '' ?>>Réserver</option>
                <option value="Libre" <?= ('Libre') ? 'selected' : '' ?>>Libre</option>
            </select>
            <input type="text" id="nombre_place" name="nombre_place"  placeholder="Ex : 2">
            <button type="submit" class="btn">Ajouter </button>

            </form>
        </div>
        <div class="section-liste">
    <h1>Clients enregistrés récemment</h1>
    <?php 
    $requete_clients = $conn->prepare("SELECT * FROM Clients ORDER BY id DESC limit 5" );
    $requete_clients->execute();
    $clients = $requete_clients->fetchAll(PDO::FETCH_ASSOC);
    $requete_clients->execute();
    while ($row = $requete_clients->fetch(PDO::FETCH_ASSOC)) :
    ?>
        <div class="client">
            <h3>
                <span><?php echo isset($row["prenom"]) ? $row["prenom"] : "Nom non disponible"; ?></span>
                <span><?php echo isset($row["nom"]) ? $row["nom"] : "Prénom non disponible"; ?></span>
            </h3>
        </div>
    <?php endwhile ?>
</div>


    </div>
</body>
</html>
