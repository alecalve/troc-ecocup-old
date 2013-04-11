--
-- Base de données: `troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `assos`
--

CREATE TABLE IF NOT EXISTS `assos` (
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ecocups`
--

CREATE TABLE IF NOT EXISTS `ecocups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `asso` varchar(255) NOT NULL,
  `semestre` char(3) NOT NULL,
  `commentaire` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etus`
--

CREATE TABLE IF NOT EXISTS `etus` (
  `login` varchar(8) NOT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `propositions`
--

CREATE TABLE IF NOT EXISTS `propositions` (
  `ecocup_donne_id` int(11) NOT NULL,
  `ecocup_cherche_id` int(11) NOT NULL,
  `login` char(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`ecocup_donne_id`,`ecocup_cherche_id`,`login`),
  KEY `ecocup_cherche_id` (`ecocup_cherche_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `semestres`
--

CREATE TABLE IF NOT EXISTS `semestres` (
  `semestre` char(3) NOT NULL,
  PRIMARY KEY (`semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Contraintes pour la table `propositions`
--
ALTER TABLE `propositions`
  ADD CONSTRAINT `propositions_ibfk_1` FOREIGN KEY (`ecocup_donne_id`) REFERENCES `ecocups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `propositions_ibfk_2` FOREIGN KEY (`ecocup_cherche_id`) REFERENCES `ecocups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
