-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 mai 2024 à 02:41
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `amin`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `telephone`) VALUES
(1, 'test', '0404040404'),
(2, 'Test', '+33 712369746'),
(3, 'Test', '+33 712369746'),
(4, 'ggt', 'gtgt'),
(5, 'dgrgd', 'gdrgd'),
(6, 'nn', 'nyny'),
(7, 'nfn', 'nfnf'),
(8, 'fghcgcf', 'gcfgcf'),
(9, 'fsef', 'fesfsf'),
(10, 'fesf', 'fsefs'),
(11, 'fsfs', 'fsefs'),
(12, 'fsfs', 'fsefsf'),
(13, 'fesfs', 'fsefs'),
(14, 'fsfs', 'fesfsf'),
(15, 'fesfs', 'gcfgcf'),
(16, 'dqdqzd', 'fsefsf'),
(17, 'fesf', 'dqz'),
(18, 'fghcgcf', 'fesfsf'),
(19, 'fesf', 'dqzdqz'),
(20, '', ''),
(21, 'dqd', 'dqzdqz');

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

CREATE TABLE `disponibilites` (
  `id` int(11) NOT NULL,
  `heure` time NOT NULL,
  `jour` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `disponibilites`
--

INSERT INTO `disponibilites` (`id`, `heure`, `jour`) VALUES
(4, '01:19:00', 'lundi'),
(5, '01:19:00', 'vendredi');

-- --------------------------------------------------------

--
-- Structure de la table `prestations`
--

CREATE TABLE `prestations` (
  `id` int(11) NOT NULL,
  `offre` varchar(100) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prestations`
--

INSERT INTO `prestations` (`id`, `offre`, `prix`, `heure_debut`, `heure_fin`) VALUES
(1, 'Coupe de cheveux', 15.00, '00:00:00', '00:00:00'),
(2, 'Coupe + Barbe', 20.00, '00:00:00', '00:00:00'),
(3, 'Barbe seule', 8.00, '00:00:00', '00:00:00'),
(4, 'Soins du visage', 10.00, '00:00:00', '00:00:00'),
(5, 'Formule complète (Coupe + Barbe + Soins du visage)', 25.00, '00:00:00', '00:00:00'),
(6, 'test', 700.00, '00:00:00', '00:00:00'),
(7, '', 0.00, '00:00:00', '00:00:00'),
(8, 'fesf', 0.00, '00:55:00', '00:56:00'),
(9, 'fgesf', 0.00, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  `heure_disponible` time DEFAULT NULL,
  `jour` varchar(20) DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `offre_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `client_id`, `date_reservation`, `heure_disponible`, `jour`, `heure`, `produit_id`, `offre_id`) VALUES
(18, 13, '0000-00-00', '00:00:00', '1714689153', '00:00:00', NULL, ''),
(19, 14, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, ''),
(20, 15, '0000-00-00', '00:00:00', '1714690556', NULL, NULL, ''),
(21, 15, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, ''),
(22, 16, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, ''),
(23, 17, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, ''),
(24, 18, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, '1'),
(25, 19, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, '1'),
(26, 20, '0000-00-00', '00:00:00', '', '00:00:00', NULL, ''),
(27, 20, '0000-00-00', '00:00:00', '', '00:00:00', NULL, ''),
(28, 20, '0000-00-00', '00:00:00', '', '00:00:00', NULL, ''),
(29, 21, '0000-00-00', '00:00:00', 'lundi', '01:19:00', NULL, '<br />\r\n<b>Warning</b>:  Undefined variable $offre_id in <b>C:xampphtdocsamin\reservation.php</b> on ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestations`
--
ALTER TABLE `prestations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `disponibilites`
--
ALTER TABLE `disponibilites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `prestations`
--
ALTER TABLE `prestations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
