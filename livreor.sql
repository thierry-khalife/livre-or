-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 22 nov. 2019 à 13:42
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `livreor_commentaires`
--

USE dbs781078;

DROP TABLE IF EXISTS `livreor_commentaires`;
CREATE TABLE IF NOT EXISTS `livreor_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreor_commentaires`
--

INSERT INTO `livreor_commentaires` (`id`, `commentaire`, `id_utilisateur`, `date`) VALUES
(23, 'Salut mec!', 2, '2019-11-22 12:01:59'),
(22, 'Salut Ã  tous !', 3, '2019-11-22 11:58:09'),
(24, 'odfiehznlksmf,elf,', 2, '2019-11-22 13:37:19'),
(25, 'pcksdfpÃ¹kzepfkze', 2, '2019-11-22 14:14:07');

-- --------------------------------------------------------

--
-- Structure de la table `livreor_utilisateurs`
--

DROP TABLE IF EXISTS `livreor_utilisateurs`;
CREATE TABLE IF NOT EXISTS `livreor_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreor_utilisateurs`
--

INSERT INTO `livreor_utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'test1', '$2y$12$o39Mr/wMn92wA7fr1PVqOOSByDLD7U5eSRNr.cej52kCAALyGqlcO'),
(2, 'deku', '$2y$12$Y9kg68K9wxFu10ujqmkdcultzAG96CnweNT4ELxh1z3wGXyg9X5Ry'),
(3, 'admin', '$2y$12$zDEtbV9eO2h4iCiFD.xp/uRJaiXNUPODBXm5cALStdYs0g/NzwFMu'),
(4, 'salut2', '$2y$12$Koe7.mKb5ap1EFxVDt8r1utPyad2goMwRtN53dwVYdNpva4BWWzV.');

-- --------------------------------------------------------

--
-- Structure de la table `livreor_votes`
--

DROP TABLE IF EXISTS `livreor_votes`;
CREATE TABLE IF NOT EXISTS `livreor_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commentaire` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livreor_votes`
--

INSERT INTO `livreor_votes` (`id`, `id_commentaire`, `id_utilisateur`, `valeur`) VALUES
(173, 25, 2, 1),
(168, 22, 2, 1),
(167, 23, 2, -1),
(161, 22, 3, -1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
