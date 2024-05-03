<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation - Sab'Arber</title>
    <link rel="stylesheet" href="css/reservation.css">
</head>
<header>
    <nav class="menu menu-3">
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="prestations.php">Prestations</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="avis.php">Avis</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1 class="animated-heading">Réservation</h1>
    <?php
    // Vérifier si l'identifiant de l'offre est présent dans l'URL
    if(isset($_GET['offre_id'])) {
        $offre_id = $_GET['offre_id'];
        include 'connection.php';

        // Récupérer les détails de l'offre à partir de la table "prestations"
        $sql = "SELECT * FROM prestations WHERE id = $offre_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Récupérer les détails de l'offre
            $offre = $result->fetch_assoc();

            // Afficher les détails de l'offre sur la page de réservation
            // Afficher les détails de l'offre sur la page de réservation
echo "<p style='color: white;'>Offre sélectionnée : " . $offre["offre"] . " - Prix : " . $offre["prix"] . "€</p>";

        } else {
            echo "Offre introuvable.";
        }

        // Fermer la connexion
        $conn->close();
    } else {
        echo "Offre manquante.";
    }
    ?>

<form action="reservation_process.php" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br><br>
    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" required><br><br>
    <!-- Champ caché pour envoyer l'identifiant de l'offre avec le formulaire -->
    <input type="hidden" name="offre_id" value="<?php echo $offre_id; ?>">
    <label for="heure_disponible">Choisissez votre jour et heure :</label>
    <select id="heure_disponible" name="heure_disponible" required>
        <?php
        // Connexion à la base de données (à adapter selon votre configuration)
        include 'connection.php';

        // Récupération des disponibilités depuis la table disponibilites
        $sql = "SELECT * FROM disponibilites";
        $result = $conn->query($sql);

        // Vérification s'il y a des résultats
        if ($result->num_rows > 0) {
            // Création des options pour chaque disponibilité
            while($row = $result->fetch_assoc()) {
                // Affichage du jour et de l'heure
                echo '<option value="'.$row['jour'].' '.$row['heure'].'">'.$row['jour'].' '.$row['heure'].'</option>';
            }
        } else {
            echo '<option value="">Aucune disponibilité</option>';
        }

        // Fermer la connexion
        $conn->close();
        ?>
    </select><br><br>
    <input type="submit" value="Réserver">
</form>



</body>
</html>
