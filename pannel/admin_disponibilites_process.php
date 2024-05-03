<?php
// Connexion à la base de données (à adapter selon votre configuration)
include 'connection.php';

// Récupération des données du formulaire
$jour = $_POST['jour'];
$heure = $_POST['heure'];

// Insérer les données dans la table disponibilites
$sql = "INSERT INTO disponibilites (jour, heure) VALUES ('$jour', '$heure')";
$conn->query($sql);


// Afficher un message de confirmation
echo '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation d\'ajout de disponibilité</title>
</head>
<body>
    <h1>Disponibilité ajoutée avec succès</h1>
    <p>Une plage horaire de disponibilité a été ajoutée pour le '.$jour.' à '.$heure.'.</p>
</body>
</html>';

// Fermer la connexion
$conn->close();
?>

<meta http-equiv="refresh" content="2;url=admin_prestations.php">