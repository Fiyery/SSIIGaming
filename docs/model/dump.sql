-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 22 Septembre 2015 à 17:02
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ssii_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `consultant`
--

CREATE TABLE IF NOT EXISTS `consultant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `wage` varchar(255) NOT NULL,
  `employed_date` timestamp NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `consultant_mission`
--

CREATE TABLE IF NOT EXISTS `consultant_mission` (
  `id_consultant` int(11) NOT NULL,
  `id_mission` int(11) NOT NULL,
  PRIMARY KEY (`id_consultant`,`id_mission`),
  KEY `id_mission` (`id_mission`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `consultant_skill`
--

CREATE TABLE IF NOT EXISTS `consultant_skill` (
  `id_consultant` int(11) NOT NULL,
  `id_skill` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_consultant`,`id_skill`),
  KEY `id_skill` (`id_skill`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `begin_date` timestamp NOT NULL,
  `end_date` timestamp NOT NULL,
  `place` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mission_skill`
--

CREATE TABLE IF NOT EXISTS `mission_skill` (
  `id_mission` int(11) NOT NULL,
  `id_skill` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_mission`,`id_skill`),
  KEY `id_skill` (`id_skill`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `consultant`
--
ALTER TABLE `consultant`
  ADD CONSTRAINT `consultant_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `consultant_mission`
--
ALTER TABLE `consultant_mission`
  ADD CONSTRAINT `consultant_mission_ibfk_2` FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `consultant_mission_ibfk_1` FOREIGN KEY (`id_consultant`) REFERENCES `consultant` (`id`);

--
-- Contraintes pour la table `consultant_skill`
--
ALTER TABLE `consultant_skill`
  ADD CONSTRAINT `consultant_skill_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `consultant_skill_ibfk_1` FOREIGN KEY (`id_consultant`) REFERENCES `consultant` (`id`);

--
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `mission_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);

--
-- Contraintes pour la table `mission_skill`
--
ALTER TABLE `mission_skill`
  ADD CONSTRAINT `mission_skill_ibfk_2` FOREIGN KEY (`id_skill`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `mission_skill_ibfk_1` FOREIGN KEY (`id_mission`) REFERENCES `mission` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
