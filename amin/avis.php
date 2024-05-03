<?php
// Inclure la connexion à la base de données
include 'connection.php';

// Récupérer les avis depuis la base de données
$sql = "SELECT * FROM avis";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Avis - Salon de coiffure</title>
    <link rel="stylesheet" href="css/avis.css">
</head>

<header>
<nav class="menu menu-5">
    <nav>
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="prestations.php">Prestations</a></li>
            
            <li><a href="avis.php">Avis</a></li>
        </ul>
    </nav>
</header>

<body>
    <h1>Avis</h1>
    <div class="avis-container">
        <?php
        // Vérifier s'il y a des avis à afficher
        if ($result->num_rows > 0) {
            // Afficher chaque avis
            while($row = $result->fetch_assoc()) {
                echo "<div class='avis'>";
                echo "<p><strong>Nom :</strong> " . $row["nom"] . "</p>";
                echo "<p><strong>Commentaire :</strong> " . $row["commentaire"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Aucun avis disponible pour le moment.</p>";
        }

        // Fermer la connexion à la base de données
        $conn->close();
        ?>
    </div>

   
    <form action="ajouter_avis.php" method="post">
    <h2>Ajouter un avis</h2>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="commentaire">Commentaire :</label><br>
        <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
