-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 19 Mars 2011 à 21:45
-- Version du serveur: 5.0.41
-- Version de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `highnimal`
--

-- --------------------------------------------------------

--
-- Structure de la table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `id_species` int(11) NOT NULL,
  `race` varchar(250) collate utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('male','female') collate utf8_unicode_ci NOT NULL,
  `bloodgroup` varchar(150) collate utf8_unicode_ci NOT NULL,
  `vaccines` text collate utf8_unicode_ci NOT NULL,
  `color` varchar(250) collate utf8_unicode_ci NOT NULL,
  `appearance` text collate utf8_unicode_ci NOT NULL,
  `id_mother` int(11) default NULL,
  `id_father` int(11) default NULL,
  `pedigree` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `animals`
--


-- --------------------------------------------------------

--
-- Structure de la table `animals_contests`
--

DROP TABLE IF EXISTS `animals_contests`;
CREATE TABLE IF NOT EXISTS `animals_contests` (
  `id_animal` int(11) NOT NULL,
  `id_contest` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY  (`id_animal`,`id_contest`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `animals_contests`
--


-- --------------------------------------------------------

--
-- Structure de la table `animals_photos`
--

DROP TABLE IF EXISTS `animals_photos`;
CREATE TABLE IF NOT EXISTS `animals_photos` (
  `id_animal` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  PRIMARY KEY  (`id_animal`,`id_photo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `animals_photos`
--


-- --------------------------------------------------------

--
-- Structure de la table `contests`
--

DROP TABLE IF EXISTS `contests`;
CREATE TABLE IF NOT EXISTS `contests` (
  `id` int(11) NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `contests`
--


-- --------------------------------------------------------

--
-- Structure de la table `parentanimals`
--

DROP TABLE IF EXISTS `parentanimals`;
CREATE TABLE IF NOT EXISTS `parentanimals` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `id_species` int(11) NOT NULL,
  `race` varchar(250) collate utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `sex` enum('male','female') collate utf8_unicode_ci NOT NULL,
  `pedigree` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `parentanimals`
--


-- --------------------------------------------------------

--
-- Structure de la table `parentanimals_photos`
--

DROP TABLE IF EXISTS `parentanimals_photos`;
CREATE TABLE IF NOT EXISTS `parentanimals_photos` (
  `id_parentanimal` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  PRIMARY KEY  (`id_parentanimal`,`id_photo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `parentanimals_photos`
--


-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL auto_increment,
  `internuri` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `photos`
--


-- --------------------------------------------------------

--
-- Structure de la table `species`
--

DROP TABLE IF EXISTS `species`;
CREATE TABLE IF NOT EXISTS `species` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `species`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) collate utf8_unicode_ci NOT NULL,
  `status` enum('pro','part') collate utf8_unicode_ci NOT NULL,
  `email` varchar(250) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(15) collate utf8_unicode_ci default NULL,
  `location` varchar(250) collate utf8_unicode_ci default NULL,
  `registration` varchar(250) collate utf8_unicode_ci default NULL,
  `credits` int(11) NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci NOT NULL,
  `other` text collate utf8_unicode_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--


-- --------------------------------------------------------

--
-- Structure de la table `users_unblockedusers`
--

DROP TABLE IF EXISTS `users_unblockedusers`;
CREATE TABLE IF NOT EXISTS `users_unblockedusers` (
  `id_user` int(11) NOT NULL,
  `id_unblockeduser` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_user`,`id_unblockeduser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users_unblockedusers`
--

