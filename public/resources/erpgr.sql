-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 27 août 2024 à 01:05
-- Version du serveur : 10.5.23-MariaDB-0+deb11u1
-- Version de PHP : 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `erpgr`
--
CREATE DATABASE IF NOT EXISTS `erpgr` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `erpgr`;

-- --------------------------------------------------------

--
-- Structure de la table `cce`
--

CREATE TABLE IF NOT EXISTS `cce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomp` varchar(253) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cce`
--

INSERT INTO `cce` (`id`, `nomp`, `created_at`, `updated_at`, `file`) VALUES
(1, 'testst', '2024-08-27 00:08:12', '2024-08-27 00:08:12', 'FRG_19_CCE1724717292.docx'),
(2, 'غلي الشويخي', '2024-08-27 00:08:54', '2024-08-27 00:08:54', 'FRG_19_CCE1724717334.docx');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240826233205', '2024-08-26 23:32:11', 39),
('DoctrineMigrations\\Version20240827000004', '2024-08-27 00:00:08', 24);

-- --------------------------------------------------------

--
-- Structure de la table `fgrh`
--

CREATE TABLE IF NOT EXISTS `fgrh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fgrh`
--

INSERT INTO `fgrh` (`id`, `name`, `file`, `cat`, `created_at`, `updated_at`) VALUES
(5, 'cv', 'FR-GRH-31-CURRICULUM-VITAE-Nom-and-Prenom-v02-66cd15315b6fe.docx', '31', '2024-08-27 00:03:30', '2024-08-26 23:52:17'),
(6, 'ordm', 'FR-GRH-11-ORDRE-DE-MISSION-v02-66c975d426489-66c977e93c8b1.docx', '11', '2024-08-27 00:03:44', '2024-08-27 00:08:00'),
(7, 'list piece admi', 'FR-GRH-26-LISTE-PIECES-DOSSIER-ADMINISTRATIF-v03-66c9760970bfc.docx', '26', '2024-08-27 00:03:50', '2024-08-27 00:08:06'),
(8, 'bulletin de vote', 'FR-GRH-20-BULLETIN-DE-VOTE-v02-66c97664abad7.docx', '20', '2024-08-27 00:03:59', '2024-08-27 00:08:13'),
(9, 'cand', 'FR-GRH-19-DEMANDE-DE-CONDIDATURE-CCE-v02-66cd0cd0efade-66cd17dbe271c.docx', '19', '2024-08-26 23:16:32', '2024-08-27 00:03:39'),
(10, 'fren', 'FR-GRH-08-FICHE-DE-RENSEIGNEMENTS-v02-66cd1d0738ff2.docx', '8', '2024-08-27 00:25:43', '2024-08-27 00:25:43'),
(11, 'bavs', 'FR-GRH-15-BON-POUR-AVANCE-SUR-SALAIRE-and-PRET-v02-66cd1d87d6ecb.docx', '15', '2024-08-27 00:27:51', '2024-08-27 00:27:51'),
(12, 'demcong', 'FR-GRH-13-DEMANDE-and-TITRE-DE-CONGE-v02-66cd1eff9cada.docx', '13', '2024-08-27 00:34:07', '2024-08-27 00:34:07');

-- --------------------------------------------------------

--
-- Structure de la table `formgrh`
--

CREATE TABLE IF NOT EXISTS `formgrh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `test` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formgrh`
--

INSERT INTO `formgrh` (`id`, `name`, `type`, `date`, `test`) VALUES
(1, 'fddfffd', 'ccvcvcv', '2024-08-19 03:55:00', 'bbvvvbbbbbbbbbbbbbbbbbbbb'),
(2, 'bbbbbb', 'bbbbbb', '2024-08-19 03:57:00', 'bbbbbb'),
(3, 'bbvbvbvb', 'bvbvvbbvbv', '2000-02-20 00:00:00', 'vbbbbbbbbbbbb');

-- --------------------------------------------------------

--
-- Structure de la table `ordm`
--

CREATE TABLE IF NOT EXISTS `ordm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomper` varchar(255) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `aut` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `mission` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ordm`
--

INSERT INTO `ordm` (`id`, `nomper`, `fonction`, `aut`, `lieu`, `mission`, `file`, `created_at`, `updated_at`) VALUES
(3, 'ali chouikhi', 'INg', 'oi', 'med', 'pre rdv', 'FRG_11_ORDM1724710574.docx', '2024-08-26 22:16:14', '2024-08-26 22:16:14');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `created_at`, `updated_at`) VALUES
(2, 'aaa@ggg.tt', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', '$2y$13$P2VbhGLojW8APJBBDMfzWenTRw5.oSmOqj0tuz6HMDuifSFlNrPuC', '0000-00-00 00:00:00', NULL),
(3, 'test@ddsss.fr', '[\"ROLE_USER\"]', '$2y$13$k4jdW7zAx9WRhU4lEPmqB.Cm2tr6AJhUiBqQvzmIfV1zPTQ12NsIC', '2024-08-26 22:10:38', '2024-08-26 22:10:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
