-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 20 Janvier 2017 à 19:36
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `micro_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `contenu`, `date`, `user_id`) VALUES
(1, 'Ceci est le premier message d''Ismael', 1484936673, 1),
(2, 'Nous sommes Vendredi ! ', 1484936695, 1),
(3, 'Je suis Franck, ceci est mon premier message...', 1484936735, 2),
(4, 'Bienvenue Ã  moi Patrick !', 1484936798, 3),
(5, 'Ceci est le 1er message de Laurent', 1484936924, 4),
(6, '1er message de Laurent modifiÃ©', 1484936938, 4),
(7, 'Enfin le week end !', 1484936979, 1),
(8, 'Tapez "ceci" pour tester le fonctionnement de la barre de recherche', 1484937043, 1),
(9, 'Je ne peux modifier et supprimer que mes messages..', 1484937126, 3),
(10, 'Super une personne non-connectÃ©e ne peut Ã©crire sur ce blog !', 1484937157, 3),
(11, 'Hello Ã  tous', 1484937227, 2),
(12, 'Je dois ajouter des messages pour la pagination..', 1484937254, 2),
(13, 'Il est temps d''aller se reposer', 1484937295, 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `sessionid` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `pseudo`, `sessionid`) VALUES
(1, 'HMAIN', 'Ismael', 'hmain@hotmail.fr', 'e10adc3949ba59abbe56e057f20f883e', 'ismael', 'bc109669d0af6e833f95986577da4491'),
(2, 'DUPONT', 'Franck', 'dupont@hotmail.fr', '6c44e5cd17f0019c64b042e4a745412a', 'franck', '32af9c877a757071ef8c11b1f5c9d27e'),
(3, 'MARTIN', 'Patrick', 'martin@hotmail.fr', 'fc5e038d38a57032085441e7fe7010b0', 'patrick', '9f920c1a8dd8f202a534dbfc165d4dae'),
(4, 'DELANNOY', 'Laurent', 'delannoy@hotmail.fr', '40be4e59b9a2a2b5dffb918c0e86b3d7', 'laurent', 'a661223dad0b4fec592533bf4764031e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
