-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 juin 2024 à 19:14
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_administrative_patient`
--

-- --------------------------------------------------------

--
-- Structure de la table `demandemodificationpatient`
--

DROP TABLE IF EXISTS `demandemodificationpatient`;
CREATE TABLE IF NOT EXISTS `demandemodificationpatient` (
  `id_modification` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nom_champ` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ancienne_valeur` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `valeur_demandee` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_demande` datetime NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_traitement` datetime DEFAULT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_modification`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id_user` int NOT NULL,
  `poste` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_embauche` date NOT NULL,
  `type_contrat` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `date_debut_contrat` date DEFAULT NULL,
  `date_fin_contrat` date DEFAULT NULL,
  `id_service` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_service` (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id_user`, `poste`, `date_embauche`, `type_contrat`, `date_debut_contrat`, `date_fin_contrat`, `id_service`) VALUES
(31, 'Chef Service', '2024-06-07', 'CDI', '2024-06-07', '0000-00-00', 2),
(10, 'Chef Service', '2024-05-10', 'CDI', '2024-05-11', '2024-05-24', 1),
(32, 'Chef Service', '2024-06-03', 'CDI', '2024-06-03', '0000-00-00', 3),
(33, 'employe', '2024-06-12', 'Alt', '2024-06-12', '2025-06-19', 2);

-- --------------------------------------------------------

--
-- Structure de la table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id_user` int NOT NULL,
  `date_naissance` date NOT NULL,
  `profession` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `situation_familial` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `num_sec` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresse_postal` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `CP` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `Ville` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Pays` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `num_tel` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_assurance` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contacte_cas_urgence` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_cas_urgence` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lien_cas_urgence` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MedecinTraitant` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `langue_parler` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `contrainte_unique` (`num_sec`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id_user`, `date_naissance`, `profession`, `situation_familial`, `num_sec`, `adresse_postal`, `CP`, `Ville`, `Pays`, `num_tel`, `type_assurance`, `contacte_cas_urgence`, `telephone_cas_urgence`, `lien_cas_urgence`, `MedecinTraitant`, `langue_parler`) VALUES
(11, '2000-02-02', 'commercant', 'célibataire', '12345678922222', '1 route des courgette', '69006', 'Lyon', 'France', '0666666666', 'Assurance complémentaire', 'RAS', '0666666666', '', 'Letoublon', 'Français'),
(9, '2002-01-01', 'Etudiant', 'célibataire', '12345678900000', '3 rue des moulins', '69009', 'Lyon', 'France', '0700000777', 'Mutuelle', 'RAS', '', NULL, 'Letoublon', 'Français'),
(19, '2000-05-05', 'etudiant', 'célibataire', '12345678944444', '4 rue des tests', '69005', 'Lyon', 'France', '0000000000', 'Mutuelle', NULL, NULL, NULL, 'Letoublon', 'Français'),
(18, '2012-12-12', 'etudiant', 'célibataire', '12345678942111', '38 rue des chauves', '69000', 'Lyon', 'France', '3333333333', 'Mutuelle', NULL, NULL, 'parent', 'Letoublon', 'Français'),
(30, '1999-11-12', 'agriculteur', 'marié', '123456789421110', 'test', '12222', 'test', 'test', '0000000000', 'Assurance maladie', NULL, NULL, NULL, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `patient_service`
--

DROP TABLE IF EXISTS `patient_service`;
CREATE TABLE IF NOT EXISTS `patient_service` (
  `id_user` int NOT NULL,
  `id_service` int NOT NULL,
  PRIMARY KEY (`id_user`,`id_service`),
  KEY `id_service` (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient_service`
--

INSERT INTO `patient_service` (`id_user`, `id_service`) VALUES
(9, 2),
(9, 3),
(11, 2),
(11, 3),
(19, 2);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL,
  `nom_service` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role_service` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `nom_service`, `role_service`) VALUES
(1, 'Administratif', 'S\'occupe de l\'administratif'),
(2, 'Urgences', 'Urgences'),
(3, 'Radiologie', 'Je fais des radios');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `Nom_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_user` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sexe` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse_mail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mot_de_passe_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `contrainte_unique` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `Nom_user`, `prenom_user`, `sexe`, `adresse_mail`, `mot_de_passe_hash`) VALUES
(11, 'Abdel', 'Ilias', 'M', 'ilias@gmail.com', '$2y$10$SB6rwLLCxpvfYaixuRfKuOySN.nVFG4cmqKIIjDCGYRmPq2JEjz6i'),
(10, 'Letoublon', 'Thomas', 'M', 'thomas@gmail.com', '$2y$10$.qariMfrE3a60wRlkYh6..qiou6SYDXpAdXUURW2iSlI9Odpzc.yW'),
(9, 'Roustan', 'Liam', 'M', 'liam@gmail.com', '$2y$10$oSq3HfNDyLPBOwdjlGhp.uernIb7up6PH7NURMZLJzcumO5VVQKni'),
(19, 'Rodriguez', 'David', 'M', 'david@gmail.com', '$2y$10$.kgTEzbpLcqGO6ENLGnUPur8YwR4L69G2h4qDoc48/5pcrBbnHLae'),
(33, 'Mario', 'Luigi', 'M', 'luigi@gmail.com', '$2y$10$Ckp/CMdXUwXf3u2ykMu2ZOoP75nGr4..7xQD5bTTlH9rWvchmXXX2'),
(32, 'Macron', 'Issame', 'M', 'issame@gmail.com', '$2y$10$xRPJ3vY1swKG2i36UDglduxoMuC8ppDSE1ZEBihHA7O1ldVIvzg0C'),
(18, 'Contaux', 'Valentin', 'M', 'val@gmail.com', '$2y$10$ZXSoDHsiqEhC/U2Uzr.XSeWBZLV/LNCy7XN9NUDrSF1e7lqFhA9Ju'),
(31, 'Magniere', 'Lucie', 'F', 'lucie@gmail.com', '$2y$10$ad/RJXt/F5kdaF5.XcLmsOuLkofQHrElOxohnJ1y0uuVwXdhsE59a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
