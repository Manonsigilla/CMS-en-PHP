-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 oct. 2023 à 08:55
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wordpress`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `pseudo_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `avatar_user` varchar(255) NOT NULL,
  `niveau_user` varchar(3) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `mail_user`, `pseudo_user`, `pass_user`, `avatar_user`, `niveau_user`) VALUES
(6, 'admin', 'admin', 'admin@admin.com', 'admin', '$2y$10$TmOVf2DbNLjjr2BLuRJbl.t7nTtz/NUlsM2aIqDPge8iBI6YixE2e', '', '1'),
(2, 'Sigaud', 'Manon', 'sigaudmanon@gmail.com', 'manonsigilla', '$2y$10$paJ9PG89LSTKfvUwL.UDseGtbRzFoGPEzo1EpalvV72hHATgLZcoi', 'uploads/651589114f359.png', '0'),
(3, 'Zammit', 'Laure', 'laure@zammit.fr', 'laure', '$2y$10$EA3j9K5uW6twR6bG/1N3XuwMc0xE2N2gklSbeYDUWi4.3L1OIWuTS', 'uploads/65158b4081e1d.png', '0'),
(5, 'Poitrot', 'Kloé', 'kloe@gmail.com', 'tegmelko', '$2y$10$gl4CUpYxvSqqgSNecB.puuoF0lOm3XZ4sbr0.tDw6Np/VpFfK6FK6', 'uploads/65158b99c2ff9.png', '0'),
(7, 'theisen ', 'tamara', 'tam@tamara.fr', 'tamiche', '$2y$10$Jlg31.e.Gu/rXh6xbo63auLlDBSUqDuQslyyl7Fjqnq/rP9/Avty2', 'uploads/65158bd2296f8.png', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
