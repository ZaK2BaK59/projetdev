<?php
// Vérifiez si l'identifiant de l'offre est présent dans la demande POST
if (isset($_POST['stripeToken']) && isset($_POST['offre_id'])) {
    $token = $_POST['stripeToken'];
    $offre_id = $_POST['offre_id'];


    require_once('vendor/autoload.php');
    \Stripe\Stripe::setApiKey('sk_test_51PCHNKRvnhSE065wLSWHsNQLalZIYBsQBosKzanTfXtjgANDm1mniATQxImxrxzamTWg46o2JkM324K1vmRZzdHU00gtkLFucC');

    // Récupérez le prix de l'offre à partir de la base de données
    include 'connection.php'; // Assurez-vous d'avoir la connexion à la base de données ici

    $sql = "SELECT prix FROM prestations WHERE id = $offre_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $offre = $result->fetch_assoc();
        $montantOffre = $offre['prix'] * 100; // Convertir le prix en cents pour Stripe
    } else {
        // Gérer le cas où l'offre n'est pas trouvée dans la base de données
        header("Location: confirmation_payment.php?error=" . urlencode("L'offre n'a pas été trouvée dans la base de données."));
        exit;
    }

    // Effectuez une charge avec Stripe en utilisant le token
    try {
        $charge = \Stripe\Charge::create([
            'amount' => $montantOffre,
            'currency' => 'eur',
            'description' => 'Paiement pour une réservation',
            'source' => $token,
        ]);

        // Si le paiement est réussi, vous pouvez enregistrer la réservation dans la base de données ou effectuer d'autres opérations nécessaires

        // Redirigez l'utilisateur vers une page de confirmation
        header("Location: confirmation_payment.php");
        exit;
    } catch (\Stripe\Exception\CardException $e) {
        // Erreur de carte: afficher un message d'erreur à l'utilisateur
        $error = $e->getError()->message;
        header("Location: confirmation_payment.php?error=" . urlencode($error));
        exit;
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Erreur de demande invalide: afficher un message d'erreur générique
        $error = "Une erreur s'est produite lors du traitement de votre paiement. Veuillez réessayer plus tard.";
        header("Location: confirmation_payment.php?error=" . urlencode($error));
        exit;
    }  catch (\Throwable $e) {
        // Gérer l'erreur ici (par exemple, journalisation, affichage d'un message d'erreur)
        // Rediriger l'utilisateur vers la page de confirmation de paiement
        header("Location: confirmation_payment.php?error=" . urlencode("Une erreur s'est produite lors du traitement de votre paiement. Veuillez vérifier votre e-mail pour la confirmation."));
        exit;
    }
} else {
    // Redirigez l'utilisateur vers une page d'erreur si aucun token n'est présent dans la demande
    header("Location: confirmation_payment.php?error=" . urlencode("Aucun token de paiement n'a été fourni ou l'identifiant de l'offre est manquant."));
    exit;
}
?>
