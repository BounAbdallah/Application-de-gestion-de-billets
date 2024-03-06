<?php 

require_once "../php/config.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$phone = $_POST['telephone'];
$adresse = $_POST['adresse'];


// Validation des données (à améliorer)
if (empty($nom) || empty($email) || empty($phone)) {
    // header('Location: add_clients.php');
    exit;
}




// Insertion dans la base de données
$sql = "INSERT INTO clients (nom, prenom, email, telephone, adresse ) VALUES (:nom,:prenom, :email, :telephone, :adresse)";
$requete = $conn->prepare($sql);
$requete->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':telephone'=> $phone,
    ':adresse'=>$adresse

]);

// Message de confirmation
header('Location: ../index.php');

