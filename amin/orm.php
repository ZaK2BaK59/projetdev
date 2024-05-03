<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amin";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration pour activer les exceptions PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

// Exemple de requête de sélection (SELECT)
try {
    $stmt = $conn->prepare("SELECT * FROM clients");
    $stmt->execute();

    // Récupération de tous les résultats sous forme de tableau associatif
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des résultats
    foreach($result as $row) {
        echo "ID: " . $row['id'] . ", Nom: " . $row['nom'] . ", Téléphone: " . $row['telephone'] . "<br>";
    }
} catch(PDOException $e) {
    echo "Erreur de sélection : " . $e->getMessage();
}

// Exemple d'insertion (INSERT)
try {
    $sql = "INSERT INTO clients (nom, telephone) VALUES ('John Doe', '123456789')";
    // Utilisation de la méthode exec() car aucune donnée n'est retournée
    $conn->exec($sql);
    echo "Nouvel enregistrement créé avec succès";
} catch(PDOException $e) {
    echo "Erreur d'insertion : " . $e->getMessage();
}

// Exemple de mise à jour (UPDATE)
try {
    $sql = "UPDATE clients SET telephone='987654321' WHERE id=1";
    // Utilisation de la méthode exec() car aucune donnée n'est retournée
    $conn->exec($sql);
    echo "Enregistrement mis à jour avec succès";
} catch(PDOException $e) {
    echo "Erreur de mise à jour : " . $e->getMessage();
}

// Exemple de suppression (DELETE)
try {
    $sql = "DELETE FROM clients WHERE id=1";
    // Utilisation de la méthode exec() car aucune donnée n'est retournée
    $conn->exec($sql);
    echo "Enregistrement supprimé avec succès";
} catch(PDOException $e) {
    echo "Erreur de suppression : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
