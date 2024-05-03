<?php
// Inclure la connexion à la base de données
include 'connection.php';

// Vérifier si l'identifiant de la prestation à supprimer est présent dans l'URL
if(isset($_GET['id'])) {
    $prestation_id = $_GET['id'];

    // Préparer et exécuter la requête SQL pour supprimer la prestation
    $sql = "DELETE FROM prestations WHERE id = $prestation_id";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page d'administration des prestations avec un message de succès
        header("Location: admin_prestations.php?success=prestation_deleted");
        exit;
    } else {
        // En cas d'erreur lors de la suppression, rediriger avec un message d'erreur
        header("Location: admin_prestations.php?error=delete_error");
        exit;
    }
} else {
    // Rediriger vers la page d'administration des prestations si l'identifiant n'est pas fourni dans l'URL
    header("Location: admin_prestations.php?error=id_missing");
    exit;
}

// Fermer la connexion à la base de données
$conn->close();
?>
