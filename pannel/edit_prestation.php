<?php
// Inclure la connexion à la base de données
include 'connection.php';

// Vérifier si l'identifiant de la prestation à modifier est présent dans l'URL
if(isset($_GET['id'])) {
    $prestation_id = $_GET['id'];

    // Vérifier si le formulaire de modification a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $offre = $_POST['offre'];
        $prix = $_POST['prix'];

        // Préparer et exécuter la requête SQL pour mettre à jour la prestation
        $sql = "UPDATE prestations SET offre = '$offre', prix = '$prix' WHERE id = $prestation_id";

        if ($conn->query($sql) === TRUE) {
            // Rediriger vers la page d'administration des prestations avec un message de succès
            header("Location: admin_prestations.php?success=prestation_updated");
            exit;
        } else {
            // En cas d'erreur lors de la mise à jour, rediriger avec un message d'erreur
            header("Location: admin_prestations.php?error=update_error");
            exit;
        }
    } else {
        // Sélectionner la prestation à modifier depuis la base de données
        $sql = "SELECT * FROM prestations WHERE id = $prestation_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Afficher le formulaire de modification avec les données existantes
            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Modifier Prestation</title>
            </head>
            <body>
                <h1>Modifier Prestation</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $prestation_id; ?>" method="post">
                    <label for="offre">Offre :</label>
                    <input type="text" id="offre" name="offre" value="<?php echo $row['offre']; ?>" required><br>
                    <label for="prix">Prix :</label>
                    <input type="text" id="prix" name="prix" value="<?php echo $row['prix']; ?>" required><br>
                    <input type="submit" value="Enregistrer les modifications">
                </form>
            </body>
            </html>
            <?php
        } else {
            // Rediriger avec un message d'erreur si la prestation n'est pas trouvée
            header("Location: admin_prestations.php?error=prestation_not_found");
            exit;
        }
    }
} else {
    // Rediriger vers la page d'administration des prestations si l'identifiant n'est pas fourni dans l'URL
    header("Location: admin_prestations.php?error=id_missing");
    exit;
}

// Fermer la connexion à la base de données
$conn->close();
?>
