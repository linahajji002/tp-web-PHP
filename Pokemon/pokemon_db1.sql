-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 avr. 2025 à 15:59
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
-- Base de données : `pokemon_db1`
--

-- --------------------------------------------------------

--
-- Structure de la table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hp` int(11) NOT NULL,
  `attack_minimal` int(11) NOT NULL,
  `attack_maximal` int(11) NOT NULL,
  `special_attack` int(11) NOT NULL,
  `probability_special_attack` int(11) NOT NULL,
  `type` enum('Feu','Eau','Plante','Normal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `url`, `hp`, `attack_minimal`, `attack_maximal`, `special_attack`, `probability_special_attack`, `type`) VALUES
(1, 'Dracaufeu Gigamax 1', 'images/dracaufeu1.jpg', 200, 10, 100, 2, 20, 'Feu'),
(2, 'Dracaufeu Gigamax 2', 'images/dracaufeu2.jpg', 200, 30, 80, 4, 20, 'Feu'),
(3, 'Tortank', 'images/tortank.jpg', 180, 20, 90, 3, 25, 'Eau'),
(4, 'Florizarre', 'images/florizarre.jpg', 190, 15, 85, 2, 30, 'Plante');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
