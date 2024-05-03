<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $commentaire = $_POST['commentaire'];

    // Connexion à la base de données (à adapter selon votre configuration)
    include 'connection.php';

    // Préparer la requête SQL pour insérer l'avis dans la table des avis
    $sql = "INSERT INTO avis (nom, commentaire) VALUES ('$nom', '$commentaire')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "Votre avis a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'avis : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>

<meta http-equiv="refresh" content="2;url=avis.php">