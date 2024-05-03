<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration des Réservations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        h2 {
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="time"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Administration des Réservations</h1>

    <!-- Tableau pour afficher les réservations -->
    <table>
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Numéro de Téléphone</th>
                <th>Heure</th>
                <th>Jour</th>
                <th>Offre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Inclure la connexion à la base de données
            include 'connection.php';

            // Récupération des réservations depuis la base de données
            $sql = "SELECT reservations.*, clients.nom AS nom_client, clients.telephone AS telephone_client, prestations.offre AS offre FROM reservations 
                    INNER JOIN clients ON reservations.client_id = clients.id 
                    INNER JOIN prestations ON reservations.offre_id = prestations.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nom_client"] . "</td>";
                    echo "<td>" . $row["telephone_client"] . "</td>";
                    echo "<td>" . $row["heure"] . "</td>";
                    echo "<td>" . $row["jour"] . "</td>";
                    echo "<td>" . $row["offre"] . "</td>";
                    echo "<td><a href='delete_reservation.php?id=" . $row["id"] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucune réservation trouvée.</td></tr>";
            }

            // Fermer la connexion à la base de données
            $conn->close();
            ?>
        </tbody>
    </table>

    <h1>Administration des Prestations</h1>

    <!-- Tableau pour afficher les prestations -->
    <table>
        <thead>
            <tr>
                <th>Offre</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Inclure la connexion à la base de données
            include 'connection.php';

            // Récupération des prestations depuis la base de données
            $sql = "SELECT * FROM prestations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["offre"] . "</td>";
                    echo "<td>" . $row["prix"] . "</td>";
                    echo "<td><a href='edit_prestation.php?id=" . $row["id"] . "'>Modifier</a> <a href='delete_prestation.php?id=" . $row["id"] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucune prestation disponible.</td></tr>";
            }

            // Fermer la connexion à la base de données
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Formulaire pour ajouter une prestation -->
    <h2>Ajouter une prestation :</h2>
    <form action="admin_prestations_process.php" method="POST">
        <label for="offre">Offre :</label>
        <input type="text" id="offre" name="offre" required><br>
        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required><br>
        <input type="submit" value="Ajouter Prestation">
    </form>

    <!-- Formulaire pour ajouter une plage horaire de disponibilité -->
    <h2>Ajouter une plage horaire de disponibilité :</h2>
    <form action="admin_disponibilites_process.php" method="POST">
        <label for="jour">Jour :</label>
        <select id="jour" name="jour" required>
            <?php
            // Array contenant les jours de la semaine en français
            $jours = array(
                "lundi" => "Lundi",
                "mardi" => "Mardi",
                "mercredi" => "Mercredi",
                "jeudi" => "Jeudi",
                "vendredi" => "Vendredi",
                "samedi" => "Samedi",
                "dimanche" => "Dimanche"
            );

            // Boucle pour afficher les options du select avec les jours en français
            foreach ($jours as $jour => $nomJour) {
                echo '<option value="'.$jour.'">'.$nomJour.'</option>';
            }
            ?>
        </select><br>
        <label for="heure">Heure :</label>
        <input type="time" id="heure" name="heure" required><br>
        <input type="submit" value="Ajouter Disponibilité">
    </form>
    <h1>Administration des Avis</h1>

    <!-- Tableau pour afficher les avis -->
    <table>
        <thead>
            <tr>
                <th>Nom du Client</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Inclure la connexion à la base de données
            include 'connection.php';

            // Récupération des avis depuis la base de données
            $sql = "SELECT * FROM avis";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["commentaire"] . "</td>";
                    echo "<td>" . $row["date_ajout"] . "</td>";
                    echo "<td><a href='delete_avis.php?id=" . $row["id"] . "'>Supprimer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun avis trouvé.</td></tr>";
            }

            // Fermer la connexion à la base de données
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
