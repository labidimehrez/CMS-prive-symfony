-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Août 2014 à 17:44
-- Version du serveur :  5.1.71-community
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `symfonydatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE IF NOT EXISTS `actualite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateinsertion` date NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D6630334FF7747B4` (`titre`),
  KEY `IDX_D6630334FB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `texte` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `sousrubrique_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CD8737FA6C6E55B5` (`nom`),
  UNIQUE KEY `UNIQ_CD8737FABEE02DA1` (`sousrubrique_id`),
  KEY `IDX_CD8737FA3BD38833` (`rubrique_id`),
  KEY `IDX_CD8737FAD60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `rubrique_id`, `role_id`, `texte`, `image`, `nom`, `date`, `sousrubrique_id`) VALUES
(1, 1, 0, 'Symfony est un framework MVC libre écrit en PHP 5. En tant que framework, il facilite et accélère le développement de sites et d''applications Internet et Intranet.', NULL, 'Nom de l''article', '2014-08-13', NULL),
(3, 4, 1, 'Le site du framework symfony a été lancé en octobre 2005. À l''origine du projet, on trouve une agence web française, Sensio, qui a développé ce qui s''appelait à l''époque Sensio Framework1 pour ses propres besoins et a ensuite souhaité en partager le code avec la communauté des développeurs PHP.', NULL, 'Article', '2014-08-13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DD3795AD2B36786B` (`title`),
  UNIQUE KEY `UNIQ_DD3795AD462CE4F5` (`position`),
  KEY `IDX_DD3795ADFB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `utilisateur_id`, `position`, `title`) VALUES
(1, 1, 1, 'menu haut'),
(2, 1, 2, 'menu gauche');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `permission`) VALUES
(0, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rub`
--

CREATE TABLE IF NOT EXISTS `rub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_618DAE0B2B36786B` (`title`),
  KEY `IDX_618DAE0BCCD7E912` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Contenu de la table `rub`
--

INSERT INTO `rub` (`id`, `menu_id`, `position`, `state`, `title`) VALUES
(1, 1, 1, 1, 'Rub 1'),
(3, 1, 3, 0, 'Rub3'),
(4, 2, 1, 1, 'Rubb'),
(5, 2, 5, 0, 'Rubrique');

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sousrubrique`
--

CREATE TABLE IF NOT EXISTS `sousrubrique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rubrique_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_39A229E22B36786B` (`title`),
  KEY `IDX_39A229E23BD38833` (`rubrique_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `sousrubrique`
--

INSERT INTO `sousrubrique` (`id`, `rubrique_id`, `position`, `state`, `title`) VALUES
(1, 1, 1, 1, 'Sub1'),
(3, 4, 1, 1, 'Sub_Rub');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `type`) VALUES
(1, 'admin', 'admin', 'mehrez.labidi@esprit.tn', 'mehrez.labidi@esprit.tn', 1, '6od77bmgt688s0w4wso8wgww040s04s', 'sBFjuyvRdd47vBzWBh2b4qBbbtquMt+5Hxq2zNFOzYdqG59XaqxpYFIP2ba/Eh77pyim2ezpYcx1he5Tx0XEtA==', '2014-08-13 14:04:03', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL, 'user_one'),
(2, 'auteur', 'auteur', 'auteur@esprit.tn', 'auteur@esprit.tn', 1, 'g1mfoler2io0w0sos8oo8c8sk8g0skk', 'hRwVxBYxb0lXdh7p/nGGq67czTvTzzC5CplPqYoi037+MVddrfFmcc2SStA8RU0bxmjrovnFhdZbZdFdWvwbAg==', '2014-07-29 20:06:18', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:11:"ROLE_AUTEUR";}', 0, NULL, 'user_one'),
(3, 'moderateur', 'moderateur', 'moderateur@esprit.tn', 'moderateur@esprit.tn', 1, 'artmvei4vz4k0gsook48408gocs488w', 'D6nuv+9PKxnWubgJv3UoCeG7nlZcSXj1w7ZL8gy1FX6nCHG8g9JCnBJ/GvFSuXR3GA4r8oaPmVJncPU9rNx5Rw==', '2014-07-21 04:24:29', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:15:"ROLE_MODERATEUR";}', 0, NULL, 'user_one');

-- --------------------------------------------------------

--
-- Structure de la table `user_one`
--

CREATE TABLE IF NOT EXISTS `user_one` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_one`
--

INSERT INTO `user_one` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Structure de la table `user_two`
--

CREATE TABLE IF NOT EXISTS `user_two` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B36C6E55B5` (`nom`),
  UNIQUE KEY `UNIQ_1D1C63B3AA08CB10` (`login`),
  UNIQUE KEY `UNIQ_1D1C63B335C246D5` (`password`),
  UNIQUE KEY `UNIQ_1D1C63B35126AC48` (`mail`),
  KEY `IDX_1D1C63B3D60322AC` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `role_id`, `nom`, `login`, `password`, `mail`) VALUES
(1, 0, 'nom', 'login', 'password', 'mail');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD CONSTRAINT `FK_D6630334FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_CD8737FA3BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `rub` (`id`),
  ADD CONSTRAINT `FK_CD8737FABEE02DA1` FOREIGN KEY (`sousrubrique_id`) REFERENCES `sousrubrique` (`id`),
  ADD CONSTRAINT `FK_CD8737FAD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_DD3795ADFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `rub`
--
ALTER TABLE `rub`
  ADD CONSTRAINT `FK_618DAE0BCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Contraintes pour la table `sousrubrique`
--
ALTER TABLE `sousrubrique`
  ADD CONSTRAINT `FK_39A229E23BD38833` FOREIGN KEY (`rubrique_id`) REFERENCES `rub` (`id`);

--
-- Contraintes pour la table `user_one`
--
ALTER TABLE `user_one`
  ADD CONSTRAINT `FK_917AE77ABF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_two`
--
ALTER TABLE `user_two`
  ADD CONSTRAINT `FK_FADCEBEDBF396750` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
