<?php
// Vérifier si l'identifiant de la réservation à supprimer est présent dans l'URL
if(isset($_GET['id'])) {
    // Récupérer l'identifiant de la réservation depuis l'URL
    $reservation_id = $_GET['id'];

    // Connexion à la base de données (à adapter selon votre configuration)
    include 'connection.php';

    // Requête SQL pour supprimer la réservation avec l'identifiant spécifié
    $sql = "DELETE FROM reservations WHERE id = $reservation_id";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page admin avec un message de succès
        header("Location: admin_prestations.php?delete=success");
        exit; // Arrêter l'exécution du script
    } else {
        // Afficher un message d'erreur si la suppression a échoué
        echo "Erreur lors de la suppression de la réservation : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Rediriger vers la page admin si l'identifiant de la réservation à supprimer n'est pas spécifié dans l'URL
    header("Location: admin_prestations.php");
    exit; // Arrêter l'exécution du script
}
?>
