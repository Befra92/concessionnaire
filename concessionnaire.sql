-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 21 fév. 2019 à 09:04
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `concessionnaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `pseudo`, `email`, `pass`) VALUES
(1, 'befra', 'befra@admin.fr', '90a76ce590c3a8610d651c31f95cb614');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
CREATE TABLE IF NOT EXISTS `voiture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(20) NOT NULL,
  `modele` varchar(20) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `prix` double NOT NULL,
  `photo` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id`, `marque`, `modele`, `pays`, `prix`, `photo`, `description`, `date_creation`) VALUES
(1, 'Renault', 'Clio2', 'France', 14000, 'clio2.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia sint eos non asperiores dolor eum. Eius quas sint magni amet officiis molestiae delectus dolorum optio nihil, voluptatem quia mollitia ullam.', '2019-02-18 12:57:19'),
(2, 'Mercedes', 'Benz', 'Italie', 50000, 'mercedes.png', '<p>quelle voiture <strong>extra</strong></p>', '2019-02-18 12:58:56'),
(12, 'Lamborghini', 'ddd', 'Italie', 30000, 'porshe.png', '<p><strong>Lamborghini aventado</strong> - render mini cooper c4d voit - voitures 4 comm\\\' &middot; render voiture sport ...</p>', '2019-02-19 13:55:54'),
(13, 'Xantia', 'old', 'France', 0, 'xantia.jpg', '<p>Alors que <strong>Renault</strong> a r&eacute;alis&eacute; une marge op&eacute;rationnelle de pr&egrave;s de 6,4 % au premier semestre 2018, son partenaire japonais a baiss&eacute; &agrave; 3,7 %, deux fois moins ! En Asie, Nissan limite la casse. En Chine, le constructeur fait mieux que la concurrence, avec des ventes en hausse de 2,5 %, alors que le march&eacute; est en baisse pour la premi&egrave;re fois depuis trente ans. De m&ecirc;me, au Japon, le second constructeur de l&rsquo;Archipel se remet en selle apr&egrave;s le scandale li&eacute; aux inspections de ses v&eacute;hicules au sein de ses usines. En revanche, le constructeur japonais souffre sur les march&eacute;s nord-am&eacute;ricain et europ&eacute;en.\\\"&gt;</p>', '2019-02-19 13:58:43'),
(14, 'ddd', 'dd', 'Ã©tat-unis', 5000, 'mercedes1.jpg', '<p>le beau temps est parmi texte</p>', '2019-02-20 08:15:08'),
(16, 'rolls', 'jkjkkjk', 'UK', 300000, 'clio2.jpg', '', '2019-02-20 08:23:04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
