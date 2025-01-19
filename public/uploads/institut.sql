-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 19 jan. 2025 à 12:47
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `institut`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20250109152112', '2025-01-18 18:43:38', 28),
('DoctrineMigrations\\Version20250118190619', '2025-01-18 19:06:53', 136),
('DoctrineMigrations\\Version20250119121748', '2025-01-19 12:18:13', 136);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(1000) DEFAULT NULL,
  `professeur_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9014574ABAB22EE9` (`professeur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `professeur_id`) VALUES
(11, 'Mathématiques', 3),
(12, 'Informatique', 7),
(1, 'Francais', 3),
(2, 'Anglais', 11),
(3, 'Allemand', 12);

-- --------------------------------------------------------

--
-- Structure de la table `matiere_stage`
--

DROP TABLE IF EXISTS `matiere_stage`;
CREATE TABLE IF NOT EXISTS `matiere_stage` (
  `matiere_id` int NOT NULL,
  `stage_id` int NOT NULL,
  PRIMARY KEY (`stage_id`,`matiere_id`),
  KEY `IDX_4EDC3D1CF46CD258` (`matiere_id`),
  KEY `IDX_4EDC3D1C2298D193` (`stage_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `matiere_stage`
--

INSERT INTO `matiere_stage` (`matiere_id`, `stage_id`) VALUES
(11, 2),
(1, 3),
(2, 3),
(3, 3),
(11, 3),
(12, 4);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `nom`, `email`) VALUES
(10, 'Fennecs', 'dupont@example.com'),
(3, 'Alice', 'alice@example.com'),
(7, 'FredDeCarglass', 'fredcarglass@gmail.com'),
(11, 'Monresard', 'lambert@example.com'),
(12, 'beckquer', 'alice@example.com');

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id`, `titre`, `date`, `description`) VALUES
(2, 'Stage Java', '2025-03-05 08:30:00', 'Apprendre la programmation orientée objet en Java.'),
(3, 'Stage Laravel', '2025-04-01 10:00:00', 'Découverte et mise en pratique du framework Laravel.'),
(4, 'Stage React', '2025-05-15 09:00:00', 'Bases de React et écosystème Javascript.'),
(5, 'Stage Python', '2025-06-10 09:30:00', 'Initiation à Python pour l’analyse de données.'),
(9, 'Stageee', '2025-01-19 12:32:00', 'eef'),
(13, 'Stage Data Science', '2025-07-01 09:00:00', 'Apprentissage des techniques de Data Science.'),
(14, 'Stage Web Development', '2025-08-15 10:00:00', 'Développement d\'applications web modernes.');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `datenaissance` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire_stage`
--

DROP TABLE IF EXISTS `stagiaire_stage`;
CREATE TABLE IF NOT EXISTS `stagiaire_stage` (
  `stagiaire_id` int NOT NULL,
  `stage_id` int NOT NULL,
  PRIMARY KEY (`stagiaire_id`,`stage_id`),
  KEY `IDX_979FD2C5BBA93DD6` (`stagiaire_id`),
  KEY `IDX_979FD2C52298D193` (`stage_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`) VALUES
(1, 'HarounaKANE', '$2y$13$sDxRf53mJS0qcmf6.y.oEO/YPq/7EKR7IEffZxvnNHBk1M630SGKy', 'ROLE_PROF'),
(2, 'noecalmes', '$2y$13$4SsvLhuwyYoQGTsck.SsNuSctD/i8v0vM.L7hQHTxIzHv.chJESjC', 'ROLE_ADMIN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
