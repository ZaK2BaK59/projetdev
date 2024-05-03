<?php
// Connexion à la base de données (à adapter selon votre configuration)
include 'connection.php';

// Récupération des données du formulaire
$offre = $_POST['offre'];
$prix = $_POST['prix'];

// Insérer les données dans la table prestations
$sql = "INSERT INTO prestations (offre, prix) VALUES ('$offre', '$prix')";
$conn->query($sql);

// Afficher un message de confirmation
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d\'ajout de prestation</title>
</head>
<body>
    <h1>Prestation ajoutée avec succès</h1>
    <p>L\'offre "'.$offre.'" a été ajoutée avec un prix de '.$prix.'€.</p>
</body>
</html>';

// Fermer la connexion
$conn->close();
?>

<meta http-equiv="refresh" content="2;url=admin_prestations.php">