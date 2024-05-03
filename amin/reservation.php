<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation - Sab'Arber</title>
    <link rel="stylesheet" href="css/reservation.css">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Ajoutez ici votre CSS personnalisé pour le formulaire de paiement */
    </style>
</head>
<header>
    <nav class="menu menu-3">
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="prestations.php">Prestations</a></li>
            <li><a href="avis.php">Avis</a></li>
        </ul>
    </nav>
</header>
<body>
    <h1 class="animated-heading">Réservation</h1>
    <?php
    // Inclure la connexion à la base de données
    include 'connection.php';

    // Vérifier si l'identifiant de l'offre est présent dans l'URL
    if(isset($_GET['offre_id'])) {
        $offre_id = $_GET['offre_id'];

        // Récupérer les détails de l'offre à partir de la table "prestations"
        $sql = "SELECT * FROM prestations WHERE id = $offre_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Récupérer les détails de l'offre
            $offre = $result->fetch_assoc();

            // Afficher les détails de l'offre sur la page de réservation
            echo "<p style='color: white; '>Offre sélectionnée : " . $offre["offre"] . " - Prix : " . $offre["prix"] . "€</p>";

        } else {
            echo "Offre introuvable.";
        }
    } else {
        echo "Offre manquante.";
    }
    ?>

    <!-- Formulaire de réservation avec Stripe -->
    <form action="process_payment.php" method="POST" id="payment-form">
        <label for="nom">Nom :</label>
        <input style="ok" type="text" id="nom" name="nom" required><br><br>
        <label for="telephone">Téléphone :</label>
        <input style="ok" type="text" id="telephone" name="telephone" required><br><br>
        <!-- Champ caché pour envoyer l'identifiant de l'offre avec le formulaire -->
        <input type="hidden" name="offre_id" value="<?php echo $offre_id; ?>">
        <label style="ok" for="heure_disponible">Choisissez votre jour et heure :</label>
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
        <div class="form-row">
            <label for="card-element">
                Numéro de carte
            </label>
            <div id="card-element">
                <!-- Stripe Card Element -->
            </div>

            <!-- Utilisé pour afficher les erreurs de validation de la carte -->
            <div id="card-errors" role="alert"></div>
        </div>

        <button class='bouton-reserver' type="submit">Payer</button>
    </form>

    <script>
        var stripe = Stripe('pk_test_51PCHNKRvnhSE065wiZooV17LLI0BeDkDhlwLXm73VWb4zp9jU849HG1UC4xieukCoSSjMJyDgJebeyeASWU9EJaW00oNcevEyS');
        var elements = stripe.elements();

        var style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
            }
        };

        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    </script>
</body>
</html>
