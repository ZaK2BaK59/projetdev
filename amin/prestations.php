<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Prestations - Salon de coiffure</title>
    <link rel="stylesheet" href="css/prestation.css">
</head>

<header>
    <nav>
    <nav class="menu menu-4">
        <ul>
        
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="prestations.php">Prestations</a></li>
            <li><a href="avis.php">Avis</a></li>
        </ul>
    </nav>
</header>

<body>
    <h1></h1>
    <ul>
        <?php
        // Inclure la connexion à la base de données
        include 'connection.php';

        // Récupérer les offres depuis la base de données
        $sql = "SELECT * FROM prestations";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["offre"] . " - " . $row["prix"] . "€ <a href='reservation.php?offre_id=" . $row["id"] . "'class='bouton-reserver'>Réserver</a></li>";
            } 
        } else {
            echo "Aucune offre disponible.";
        }

        // Fermer la connexion
        $conn->close();
        ?>
    </ul>
</body>
</html>
