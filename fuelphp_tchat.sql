-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Octobre 2015 à 16:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fuelphp_tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `tchats`
--

CREATE TABLE IF NOT EXISTS `tchats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `tchats`
--

INSERT INTO `tchats` (`id`, `user_id`, `text`, `created_at`, `updated_at`) VALUES
(7, 1, 'test', 2147483647, 2147483647),
(8, 1, 're test', 2147483647, 2147483647),
(9, 1, 're re test', 2147483647, 2147483647),
(19, 4, 'test', 1443888916, 1443888916);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `profile_fields` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `group`, `email`, `last_login`, `login_hash`, `profile_fields`, `created_at`, `updated_at`) VALUES
(1, 'creasitenet', 'ytNpidOnBDIpiqJlxhGGVzxPKRSy0uOv5Mm/fptjZc4=', 100, 'creasitenet.com@gmail.com', 1427130863, 'ac3b21935dba2e79fb0f96684e99953fdc962e13', 'a:0:{}', 1385996989, NULL),
(3, 'edouard', 'ytNpidOnBDIpiqJlxhGGVzxPKRSy0uOv5Mm/fptjZc4=', 1, 'edouardboissel@hotmail.com', 1416568357, '969a09504aeeaed01eda12d4bb4d3220731501dd', 'a:0:{}', 1416568250, NULL),
(4, 'edouardo', 'xxYuYhLF6BzCOCNEVgQ1EnvkSPcW9Ti5wSajwQgO5tI=', 1, 'edouardboissel@gmail.com', 1443888716, '7931e1b4e3cf7264ccd34615456a2ea7feefb503', 'a:0:{}', 1443885693, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
