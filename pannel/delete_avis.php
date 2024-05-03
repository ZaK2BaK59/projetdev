<?php
// Vérifier si l'ID de l'avis à supprimer est présent dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Inclure la connexion à la base de données
    include 'connection.php';

    // Préparer et exécuter la requête SQL pour supprimer l'avis
    $id = $_GET['id'];
    $sql = "DELETE FROM avis WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page d'administration des avis avec un message de succès
        header("Location: admin_prestations.php?success=1");
        exit();
    } else {
        // En cas d'erreur, redirection avec un message d'erreur
        header("Location: avis.php?error=1");
        exit();
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Redirection vers la page d'administration des avis si l'ID n'est pas présent dans l'URL
    header("Location: admin_prestations.php");
    exit();
}
?>
