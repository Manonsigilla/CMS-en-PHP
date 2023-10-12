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
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id_page` int NOT NULL AUTO_INCREMENT,
  `titre_page` varchar(50) NOT NULL,
  `date_page` date NOT NULL,
  `image_page` varchar(255) NOT NULL,
  `contenu_page` text NOT NULL,
  `statut_page` enum('publié','en attente de relecture','en brouillon') NOT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id_page`, `titre_page`, `date_page`, `image_page`, `contenu_page`, `statut_page`) VALUES
(1, 'Mentions légales', '2023-09-28', '../uploads/65153259bc2df.jpg', 'Mentions Légales\r\nÉditeur du site\r\nNom du site : Plateforme Journal\r\nAdresse e-mail : sigaudmanon@gmail.com\r\n\r\nDirecteur de la publication\r\nNom et prénom du directeur de la publication : Sigaud Manon\r\nAdresse e-mail du directeur de la publication : sigaudmanon@gmail.com\r\n\r\nHébergement du site\r\nNom de l\'hébergeur : [Nom de la société d\'hébergement]\r\nAdresse : [Adresse de l\'hébergeur]\r\nNuméro de téléphone de l\'hébergeur : [Numéro de téléphone de l\'hébergeur]\r\n\r\nPropriété intellectuelle\r\nCe site web et son contenu sont protégés par les lois sur la propriété intellectuelle et les droits d\'auteur. Tous les droits de reproduction sont réservés, y compris les documents téléchargeables et les représentations iconographiques et photographiques.\r\n\r\nDonnées personnelles\r\nCollecte de données personnelles\r\nLes données personnelles collectées sur ce site sont uniquement destinées à un usage interne. En aucun cas, ces données ne seront cédées ou vendues à des tiers. Conformément à la loi \"Informatique et Libertés\" du 6 janvier 1978, vous disposez d\'un droit d\'accès, de modification, de rectification et de suppression des données qui vous concernent. Pour exercer ce droit, veuillez nous contacter à l\'adresse suivante : sigaudmanon@gmail.com.\r\n\r\nCookies\r\nCe site peut utiliser des cookies pour améliorer l\'expérience de l\'utilisateur. En naviguant sur ce site, vous acceptez l\'utilisation de cookies conformément à notre politique en matière de cookies.\r\n\r\nResponsabilité\r\nL\'éditeur du site décline toute responsabilité quant aux éventuels dommages directs ou indirects résultant de l\'accès à ce site ou à ses contenus, sauf dispositions contraires prévues par la loi.\r\n\r\nModification des mentions légales\r\nL\'éditeur se réserve le droit de modifier à tout moment les présentes mentions légales. Il est donc conseillé de les consulter régulièrement.', 'publié'),
(2, 'À propos de nous', '2023-09-28', '../uploads/65154412a71af.jpg', 'À propos de nous\r\n\r\nBienvenue sur La Plateforme Journal, votre source d\'informations fiables et pertinentes. Fondé par Manon Sigaud, un passionné du journalisme, notre média en ligne s\'engage à vous tenir informé des événements les plus importants de notre époque.\r\n\r\nNotre équipe de journalistes chevronnés travaille sans relâche pour vous fournir des articles de qualité, des analyses approfondies et des reportages captivants. Nous croyons en l\'importance d\'un journalisme éthique et indépendant pour informer et inspirer nos lecteurs.\r\n\r\nDécouvrez notre histoire, notre mission et notre équipe en naviguant sur notre site.', 'publié'),
(3, 'Politique de confidentialité', '2023-09-28', '../uploads/651544759b080.jpg', 'Politique de confidentialité\r\n\r\nChez La Plateforme Journal, nous attachons une grande importance à la protection de vos informations personnelles. Cette politique de confidentialité a été créée pour vous expliquer comment nous collectons, utilisons et protégeons vos données lorsque vous utilisez notre site web.\r\n\r\nCollecte de données : Nous pouvons collecter des informations telles que votre nom, votre adresse e-mail et votre adresse IP lorsque vous naviguez sur notre site ou vous abonnez à notre newsletter. Nous ne partageons jamais ces informations avec des tiers sans votre consentement explicite.\r\n\r\nSécurité des données : Nous mettons en place des mesures de sécurité strictes pour protéger vos données contre tout accès non autorisé ou toute utilisation abusive.', 'publié'),
(4, 'Conditions d\'utilisation', '2023-09-28', '../uploads/651544d260935.jpg', 'Conditions d\'utilisation\r\n\r\nL\'utilisation du site web de La Plateforme Journal est soumise aux conditions suivantes :\r\n\r\nVous acceptez de ne pas utiliser notre site à des fins illégales ou interdites par la loi.\r\n\r\nLe contenu de ce site est protégé par des droits d\'auteur. Vous ne pouvez pas reproduire, distribuer ou utiliser notre contenu sans autorisation.\r\n\r\nNous ne sommes pas responsables de l\'exactitude ou de la pertinence du contenu tiers lié depuis notre site.\r\n\r\nVotre utilisation de notre site implique votre acceptation de notre politique de confidentialité.\r\n\r\nNous nous réservons le droit de modifier ces conditions d\'utilisation à tout moment.', 'publié'),
(5, 'Mention des droits d\'auteur © 2023, La Plateforme ', '2023-09-28', '../uploads/6515451984d2a.jpg', 'Tous les droits d\'auteur relatifs au contenu de La Plateforme Journal sont réservés. Aucune reproduction ou utilisation non autorisée du contenu de ce site n\'est permise sans l\'autorisation écrite préalable de La Plateforme Journal.', 'en brouillon'),
(6, 'Contact', '2023-09-28', '../uploads/651545916c728.jpg', 'sigaudmanon@gmail.com\r\n', 'en attente de relecture'),
(7, 'Avis et témoignages', '2023-09-28', '../uploads/65154615427db.jpg', 'Avis et témoignages\r\n\r\nTémoignages de nos lecteurs\r\nDécouvrez ce que nos lecteurs disent de La Plateforme Journal :\r\n\r\n\"Je suis un fidèle lecteur de La Plateforme Journal depuis des années. Les articles sont toujours bien écrits et informatifs.\" - Marie D.\r\n\r\n\"C\'est ma source d\'informations préférée. Je peux toujours compter sur La Plateforme Journal pour des nouvelles objectives et crédibles.\" - Pierre L.\r\n\r\n\"Les analyses de La Plateforme Journal sont inestimables. Elles m\'ont aidé à mieux comprendre de nombreux sujets.\" - Sophie G.\r\n\r\nNous apprécions les commentaires de nos lecteurs et nous nous efforçons de fournir un journalisme de qualité chaque jour.', 'en attente de relecture');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
