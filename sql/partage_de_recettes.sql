-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 juin 2025 à 14:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `partage_de_recettes`
--

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `recipe` text NOT NULL,
  `author` text NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `recipe`, `author`, `is_enabled`) VALUES
(2, 'Riz sauce arachide de l\'ouest', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae qui veritatis incidunt asperiores adipisci accusantium aspernatur aliquam. Voluptates numquam blanditiis dolores possimus officiis, fuga quidem, vero delectus reiciendis dolore dolor.', 'mathieu.nebra@exemple.com', 1),
(3, 'CousCous Ndole', 'ccccccc', 'laurene.castor@exemple.com', 0),
(5, 'Okok du sud', 'viande', 'mikael.andrieu@exemple.com', 1),
(6, 'Riz sauce arachide', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae qui veritatis incidunt asperiores adipisci accusantium aspernatur aliquam. Voluptates numquam blanditiis dolores possimus officiis, fuga quidem, vero delectus reiciendis dolore dolor.', 'mathieu.nebra@exemple.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` tinyint(200) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `age`, `password`) VALUES
(1, 'Mikael Andrieu', 'mikael.andrieu@exemple.com', 34, 'password'),
(2, 'Mathieu Nebra', 'mathieu.nebra@exemple.com', 34, 'ABCD'),
(5, 'Laurene Castor', 'laurene.castor@exemple.com', 29, 'miamMiam');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
