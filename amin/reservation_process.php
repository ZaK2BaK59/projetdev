<?php
// Connexion à la base de données (à adapter selon votre configuration)
include 'connection.php';

// Récupération des données du formulaire
$nom = $_POST['nom'];
$telephone = $_POST['telephone'];
$heure_disponible = $_POST['heure_disponible'];
$offre_id = $_POST['offre_id'];

// Récupération de la date actuelle sous forme de timestamp UNIX
$jour = date('Y-m-d'); // Date actuelle

// Décomposition de la valeur $heure_disponible
list($jour, $heure) = explode(' ', $heure_disponible);

// Vérifier si le client existe déjà dans la base de données
$sql = "SELECT id FROM clients WHERE nom = '$nom' AND telephone = '$telephone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Le client existe déjà, récupérer son ID
    $row = $result->fetch_assoc();
    $client_id = $row['id'];
} else {
    // Le client n'existe pas encore, l'ajouter à la table clients
    $sql = "INSERT INTO clients (nom, telephone) VALUES ('$nom', '$telephone')";
    $conn->query($sql);
    $client_id = $conn->insert_id;
}

// Insérer les données dans la table reservations
$sql = "INSERT INTO reservations (client_id, offre_id, heure_disponible, jour, heure) VALUES ('$client_id', '$offre_id', '$heure_disponible', '$jour', '$heure')";

if ($conn->query($sql) === TRUE) {
    // Rediriger vers la page de confirmation de paiement avec l'ID de l'offre conservé
    header("Location: confirmation_payment.php?offre_id=" . urlencode($offre_id));
    exit;
} else {
    // Rediriger vers une page d'erreur si une erreur se produit lors de la réservation
    header("Location: error.php?message=" . urlencode("Une erreur s'est produite lors de la réservation. Veuillez réessayer."));
    exit;
}

// Fermer la connexion
$conn->close();
?>
