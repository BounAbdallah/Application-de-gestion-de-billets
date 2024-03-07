<?php 

require_once "../php/config.php";

$id_client = $_POST["id_client"];
$date_reservation =$_POST['date_reservation'];
$heure_reservation =$_POST['heure_reservation'];
$prix = $_POST['prix'];
$statut = $_POST['statut'];
$date_depart = $_POST['date_depart'];
$heure_depart = $_POST['heure_depart'];
$date_arrivee = $_POST['date_arrivee'];
$heure_arrivee = $_POST['heure_arrivee'];
$destination = $_POST['destination'];
$nombre_place = $_POST['nombre_place'];
// $id_client = $result['id_client'];



// Validation des données (à améliorer)
if (empty($destination) || empty($prix) || empty($statut) || empty($heure_reservation)) {
    header('Location: add_billets.php');
    exit;
}




// Insertion dans la base de données
$sql = "INSERT INTO Billets (id_client, date_reservation, heure_reservation, 
prix, statut, date_depart, heure_depart, date_arrivee, 
heure_arrivee, destination,nombre_place )
VALUES (:id_client,:date_reservation, :heure_reservation,
 :prix, :statut,:date_depart,:heure_depart,:date_arrivee,
 :heure_arrivee, :destination, :nombre_place)";
$requete = $conn->prepare($sql);
$requete->execute([
    ':id_client' => $id_client,
    ':date_reservation' => $date_reservation,
    ':heure_reservation'=> $heure_reservation,
    ':prix' =>$prix,
    ':statut' => $statut,
    ':date_depart' => $date_depart,
    ':heure_depart' => $heure_depart,
    ':date_arrivee' => $date_arrivee,
    ':heure_arrivee' => $heure_arrivee, 
    ':destination' => $destination, 
    ':nombre_place' => $nombre_place,
]);

// Message de confirmation
header('Location: ../index.php');

