-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 jan. 2021 à 19:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jpeppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `libelle`) VALUES
(1, 'Assurance'),
(2, 'Commerce'),
(3, 'Travaux public'),
(4, 'Industrie'),
(99, 'Asupp');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(50) NOT NULL DEFAULT '',
  `adresse` varchar(50) NOT NULL DEFAULT '',
  `ville` varchar(30) NOT NULL DEFAULT '',
  `cp` varchar(5) NOT NULL,
  `nomResponsable` varchar(30) NOT NULL DEFAULT '',
  `nomContact` varchar(30) NOT NULL DEFAULT '',
  `telContact` varchar(14) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `effectif` int(11) DEFAULT NULL,
  `idActivite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_entreprise` (`idActivite`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `raisonSociale`, `adresse`, `ville`, `cp`, `nomResponsable`, `nomContact`, `telContact`, `site`, `effectif`, `idActivite`) VALUES
(1, 'BatiRefect', 'Route de Paris', 'Bergerac', '24100', 'Monsieur Pontel', 'Jean Durand', '0512131415', '', 250, 3),
(2, 'Brossette', 'Bd de l\'Atlantique', 'Bergerac', '24100', 'Monsieur Ramy', 'Jules renard', '0510101012', '', 50, 1),
(3, 'Aluminium de Dordogne', 'ZI de P?rigueux', 'P?rigueux', '24000', 'Madame Parmielle', 'France Binard', '0513420712', '', 50, 4),
(4, 'MAGIF', '45 Bd de l\'Ouest', 'Bergerac', '24100', 'Madame Chymene', 'Yves Polard', '0514457893', '', 150, 1),
(5, 'Carrefour', 'ZI de P?rigueux', 'P?rigueux', '24000', 'Monsieur Piedblanc', 'Anne Zrari', '0524579812', '', 350, 2),
(6, 'Le Nouveau Comptoir', 'Avenue Auguste Blanqui', 'P?rigueux', '24000', 'Monsieur Barron', 'Annie Demarque', '0532899899', '', 50, 2),
(7, 'InfoDev', '12 Avenue Aristide Briand', 'P?rigueux', '24000', 'Monsieur hardy', 'Jean lassalle', '0578945653', '', 25, 4),
(99, 'Asupp', '99 nulle part', 'Paris', '75000', 'Monsieur Personne', 'Jean Dupont', '0606060606', '', 99, 99);

-- --------------------------------------------------------

--
-- Structure de la table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `NomUtilisateur` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `registration`
--

INSERT INTO `registration` (`UserId`, `NomUtilisateur`, `Password`) VALUES
(13, 'toto', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(14, 'nom', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(17, 'antoine', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'),
(20, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateV` date NOT NULL,
  `heureDebut` varchar(12) NOT NULL DEFAULT '',
  `duree` varchar(12) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL,
  `nbPlacesMax` int(11) NOT NULL DEFAULT '0',
  `nbPlacesMin` int(11) NOT NULL DEFAULT '0',
  `etat` varchar(12) NOT NULL DEFAULT 'ouverte',
  `nbVisiteursInscrits` int(11) NOT NULL DEFAULT '0',
  `idEntreprise` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_visite` (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`id`, `dateV`, `heureDebut`, `duree`, `description`, `nbPlacesMax`, `nbPlacesMin`, `etat`, `nbVisiteursInscrits`, `idEntreprise`) VALUES
(1, '2021-10-20', '10h', '1h30', 'Visite de l\'entrepot', 15, 10, 'ouverte', 0, 1),
(2, '2021-09-22', '8H', '1h', 'Visite du magasin', 20, 10, 'ouverte', 0, 2),
(3, '2021-11-03', '15h', '1h30', 'Visite des bureaux', 25, 10, 'ouverte', 0, 3),
(4, '2021-09-14', '10H', '1h', 'Visite du SI', 20, 10, 'ouverte', 0, 2),
(5, '2021-09-22', '10h', '1h30', 'Visite de l\'entrepot', 35, 10, 'ouverte', 0, 5),
(6, '2021-09-14', '8H', '1h', 'Visite des stoks', 20, 10, 'ouverte', 1, 2),
(7, '2021-11-03', '15h', '1h30', 'Visite des bureaux', 10, 2, 'ouverte', 0, 4),
(8, '2021-09-22', '14H', '2h', 'Presentation du SI', 20, 10, 'ouverte', 0, 4),
(9, '2021-11-03', '10H', '2h', 'Visite des locaux', 30, 10, 'ouverte', 0, 6),
(10, '2021-09-14', '15H', '2h', 'Visite des locaux', 25, 5, 'ouverte', 2, 7),
(23, '2021-01-01', '10H', '1 H 00', 'test_date', 2, 1, 'ouverte', 2, 2),
(101, '2021-01-22', '20:23', ' 2 h ', 'Visite modifiÃ©e via le formulaire', 18, 7, 'ouverte', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '',
  `prenom` varchar(50) NOT NULL DEFAULT '',
  `tel` varchar(12) DEFAULT NULL,
  `cp` varchar(5) NOT NULL,
  `nbPersonnes` int(11) NOT NULL,
  `idVisite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visiteur` (`idVisite`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `tel`, `cp`, `nbPersonnes`, `idVisite`) VALUES
(1, 'Ardie', 'Jean', '0623231299', '24500', 2, 1),
(2, 'Macler', 'Marie', '0634631299', '24450', 1, 1),
(3, 'Sami', 'Andree', '0523223459', '24320', 3, 1),
(4, 'Moineau', 'Jeanne', '0611231299', '24500', 3, 2),
(5, 'Marcel', 'Yves', '0699871299', '24500', 2, 7),
(6, 'Poisson', 'Myriam', '0547831232', '24530', 2, 2),
(7, 'Renard', 'Marie', '0634671299', '24500', 1, 3),
(8, 'Gramon', 'Patrice', '0623234231', '24430', 2, 4),
(9, 'Paris', 'Marc', '0645321299', '24510', 2, 3),
(10, 'Finele', 'Marie', '0634637856', '24550', 1, 1),
(11, 'Satyre', 'Ange', '0528745459', '24320', 3, 1),
(12, 'Mignon', 'Jules', '0611232156', '24610', 2, 8),
(13, 'Pignon', 'Maurice', '0665891299', '24740', 2, 2),
(14, 'Poireau', 'Gilles', '0588761232', '24530', 2, 2),
(15, 'Boisse', 'Anne', '0634674532', '24500', 1, 3),
(16, 'Garmine', 'Pascal', '0623234231', '24430', 2, 4),
(17, 'Margie', 'Hamed', '0632451299', '24510', 2, 3),
(18, 'Ramon', 'Marc', '0634567856', '24550', 1, 7),
(19, 'Jojo', 'Annie', '0512457459', '24320', 3, 1),
(20, 'PoiMignon', 'Jim', '0687982156', '24610', 2, 2),
(21, 'Panard', 'Mathilde', '0623231299', '24740', 2, 6),
(22, 'Tallon', 'Antoine', '3608572766', '38470', 1, 6);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `fk_entreprise` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `visite`
--
ALTER TABLE `visite`
  ADD CONSTRAINT `fk_visite` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `visiteur`
--
ALTER TABLE `visiteur`
  ADD CONSTRAINT `fk_visiteur` FOREIGN KEY (`idVisite`) REFERENCES `visite` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
