
<?php 
require_once "../php/config.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

// Vérifier si l'ID est valide
if (!$id) {
    echo "ID d'idée non spécifié.";
    exit;
}

try {
    // Préparer et exécuter la requête pour récupérer les détails de l'idée
    $requete = $conn->prepare("SELECT * FROM clients WHERE id = :id");
    $requete->execute([':id' => $id]);

    // Vérifier si une idée correspondant à l'ID est trouvée
    if (!$requete->rowCount()) {
        echo "Aucune idée trouvée avec l'ID spécifié.";
        exit;
    }
 
?>
   <?php $requete->execute([':id' => $id]);?>
<?php while ($row = $requete->fetch(PDO::FETCH_ASSOC)) :?>
    
        
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Information de : <span><?php echo $row["nom"] ?> qui a comme </span> - ID: <span><?php echo $row["id"] ?></span></a>
        </div>
    </nav>


    <!-- Section détails du client -->
    <div class="container">
        <h2>Détails du client</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
               
                <p><strong>prenom :</strong> <span><?php echo $row["prenom"] ?></span>  </p>
                <p><strong>prenom :</strong> <span><?php echo $row["nom"] ?></span>  </p>
                <p><strong>Numéro de téléphone:</strong> <span><?php echo $row["telephone"] ?></span></p>
                <p><strong>Adresse email:</strong><span><?php echo $row["email"] ?></span></p>
                <p><strong>Adresse physique:</strong><span><?php echo $row["adresse"] ?></span></p>
            </div>
        </div>
        <div class="mt-4">
            <button class="btn btn-supprimer">Modier</button>
            <a href="delete_client.php?id=<?php echo $row['id'] ?>" class="btn btn-modifier">Supprimer</a>
        </div>
    </div>
            <?php endwhile?>
        </div>
        <?php
    }
 catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du client</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vos styles personnalisés -->
    <style>
        body {
            background-color: #FFFFFF;
        }
        .navbar {
            background-color: #FE7A15;
        }
        .navbar-brand {
            color: #FFFFFF;
        }
        .container {
            background-color: #FE7A15;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .container {
            background-color: #3011BC;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            color: #FFFFFF
        }
        .btn-supprimer, .btn-modifier {
            background-color: #FE7A15;
            color: #FFFFFF;
            margin-right: 10px;
        }
        a{
            text-decoration: none;
            color: #000000;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
   


    <!-- Bootstrap JavaScript and dependencies -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>
</html>
