-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 fév. 2024 à 23:55
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idA` int NOT NULL AUTO_INCREMENT,
  `emailA` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mdpA` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idA`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idA`, `emailA`, `mdpA`) VALUES
(1, 'admin@gmail.com', 'adminwesselni');

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

DROP TABLE IF EXISTS `conducteur`;
CREATE TABLE IF NOT EXISTS `conducteur` (
  `idC` int NOT NULL AUTO_INCREMENT,
  `nomC` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenomC` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `telC` int NOT NULL,
  `adresseC` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `matriculeC` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `emailC` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mdpC` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idC`),
  UNIQUE KEY `matriculeC` (`matriculeC`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`idC`, `nomC`, `prenomC`, `telC`, `adresseC`, `matriculeC`, `emailC`, `mdpC`) VALUES
(1, 'ANNAD', 'Walid', 550123456, 'Babezzouar', '181831049446', 'walidannad@gmail.com', 'dilawdilaw'),
(2, 'ANNAD', 'Billel', 660123456, 'Zeralda', '212131049446', 'billelannad@gmail.com', 'lellib1234');

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

DROP TABLE IF EXISTS `passager`;
CREATE TABLE IF NOT EXISTS `passager` (
  `idP` int NOT NULL AUTO_INCREMENT,
  `nomP` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenomP` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telP` int NOT NULL,
  `adresseP` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `matriculeP` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `emailP` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mdpP` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idP`),
  UNIQUE KEY `matriculeP` (`matriculeP`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`idP`, `nomP`, `prenomP`, `telP`, `adresseP`, `matriculeP`, `emailP`, `mdpP`) VALUES
(1, 'LAGAB', 'Melina', 770123456, 'Azazga Tizi Ouzou', '202031012201', 'melinalagab@gmail.com', 'anilem0000'),
(2, 'ANNAD', 'Eva', 550987654, 'Dar el Beida - Alger', '202031056789', 'evaannad@gmail.com', 'evaevaeva'),
(3, 'LAGAB', 'Walbil', 550123569, 'Tirsatin azazga TiziOuzzou', '161631015501', 'alilagab@gmail.com', 'alialiali15');

-- --------------------------------------------------------

--
-- Structure de la table `propositions_trajet`
--

DROP TABLE IF EXISTS `propositions_trajet`;
CREATE TABLE IF NOT EXISTS `propositions_trajet` (
  `idTemp` int NOT NULL AUTO_INCREMENT,
  `descTemp` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `statutTemp` int NOT NULL,
  `lieu_departTemp` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `date_departTemp` date NOT NULL,
  `heure_departTemp` time NOT NULL,
  `lieu_arriveTemp` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `dureeTemp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nb_siegesTemp` int NOT NULL,
  `nb_places_dispoTemp` int NOT NULL,
  `prixTemp` float NOT NULL,
  `conditionsTemp` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `idConducteurTemp` int NOT NULL,
  `idPassagerTemp` int NOT NULL,
  PRIMARY KEY (`idTemp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `propositions_trajet`
--

INSERT INTO `propositions_trajet` (`idTemp`, `descTemp`, `statutTemp`, `lieu_departTemp`, `date_departTemp`, `heure_departTemp`, `lieu_arriveTemp`, `dureeTemp`, `nb_siegesTemp`, `nb_places_dispoTemp`, `prixTemp`, `conditionsTemp`, `idConducteurTemp`, `idPassagerTemp`) VALUES
(1, 'Trajet vers l-entreprise dont on fait notre pfe', 1, 'Université des Sciences et de la Technologie Houari Boumediene, BP 32, Boulevard de l-Université, Cité EPLF, Cité 324 lgts, Bab Ezzouar, Daïra Dar el-Beïda, Alger, 16111, Algérie', '2024-03-08', '08:00:00', 'Ministère du Commerce, Rue Fodil Ali, Cité Zerhouni Mokhtar (Les Bananiers), Lotissement les Mandariniers, Pins Maritimes, Mohammadia, Daïra Dar el-Beïda, Alger, 16312, Algérie', '15 minutes', 2, 2, 300, 'On est un binome', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `idR` int NOT NULL AUTO_INCREMENT,
  `idTrajet` int NOT NULL,
  `idPassager` int NOT NULL,
  `nb_places_reserves` int NOT NULL,
  `remarque` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idR`),
  KEY `fk_res_trajet` (`idTrajet`),
  KEY `fk_res_passager` (`idPassager`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`idR`, `idTrajet`, `idPassager`, `nb_places_reserves`, `remarque`) VALUES
(11, 2, 1, 9, 'nous sommes un groupe d-étudiants'),
(9, 1, 1, 5, 'je suis en famille'),
(12, 3, 1, 5, 'Nous sommes une famille de 5 personnes'),
(13, 1, 2, 1, 'Rien'),
(14, 3, 1, 1, 'rien de spécial'),
(15, 3, 3, 2, 'j-aime le desert');

--
-- Déclencheurs `reservation`
--
DROP TRIGGER IF EXISTS `maj_nb_places_dispo-ajout`;
DELIMITER $$
CREATE TRIGGER `maj_nb_places_dispo-ajout` AFTER INSERT ON `reservation` FOR EACH ROW BEGIN
DECLARE xnb_dispo INT;
    UPDATE trajet
    SET nb_places_dispo = nb_places_dispo - NEW.nb_places_reserves
    WHERE idT = NEW.idTrajet;

    SELECT nb_places_dispo INTO xnb_dispo FROM Trajet WHERE idT=NEW.idTrajet; 
    
    IF xnb_dispo = 0 THEN
        UPDATE trajet SET statut = 2 WHERE idT = NEW.idTrajet;
    ELSE  UPDATE trajet SET statut = 1 WHERE idT = NEW.idTrajet;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `maj_nb_places_dispo-delete`;
DELIMITER $$
CREATE TRIGGER `maj_nb_places_dispo-delete` AFTER DELETE ON `reservation` FOR EACH ROW BEGIN
DECLARE xnb_dispo INT;
    UPDATE trajet
    SET nb_places_dispo = nb_places_dispo + OLD.nb_places_reserves
    WHERE idT = OLD.idTrajet;

    SELECT nb_places_dispo INTO xnb_dispo FROM Trajet WHERE idT=OLD.idTrajet; 
    
    IF xnb_dispo = 0 THEN
        UPDATE trajet SET statut = 2 WHERE idT = OLD.idTrajet;
    ELSE  UPDATE trajet SET statut = 1 WHERE idT = OLD.idTrajet;
    END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `maj_nb_places_dispo-update`;
DELIMITER $$
CREATE TRIGGER `maj_nb_places_dispo-update` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN
DECLARE xnb_dispo INT;
    IF NEW.nb_places_reserves != OLD.nb_places_reserves THEN
        UPDATE trajet
        SET nb_places_dispo = nb_places_dispo + OLD.nb_places_reserves - NEW.nb_places_reserves
        WHERE idT = NEW.idTrajet;
    END IF;
    
    SELECT nb_places_dispo INTO xnb_dispo FROM Trajet WHERE idT=NEW.idTrajet; 
    
    IF xnb_dispo = 0 THEN
        UPDATE trajet SET statut = 2 WHERE idT = NEW.idTrajet;
    ELSE  UPDATE trajet SET statut = 1 WHERE idT = NEW.idTrajet;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `idT` int NOT NULL AUTO_INCREMENT,
  `descT` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` int NOT NULL COMMENT 'Dispo 1  ou  complet 2',
  `lieu_depart` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  `lieu_arrive` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `duree` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nb_sieges` int NOT NULL,
  `nb_places_dispo` int NOT NULL,
  `prix` float NOT NULL COMMENT 'prix par personne',
  `conditions` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `idConducteur` int NOT NULL,
  PRIMARY KEY (`idT`),
  KEY `fk_tra_conducteur` (`idConducteur`)
) ENGINE=MyISAM AUTO_INCREMENT=47856 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`idT`, `descT`, `statut`, `lieu_depart`, `date_depart`, `heure_depart`, `lieu_arrive`, `duree`, `nb_sieges`, `nb_places_dispo`, `prix`, `conditions`, `idConducteur`) VALUES
(1, 'Trajet exceptionnel', 2, 'Aéroport d-Alger, Route de Aéroport International Houari Boumediene, Dar El Beïda, Daïra Dar el-Beïda, Alger, 16311, Algérie', '2024-03-02', '11:00:00', 'Zéralda, Daïra Zéralda, Alger, 16063, Algérie', '2 heures', 6, 0, 550, 'Il est interdit de ramener des animaux', 1),
(2, 'Trajet de voyage', 2, 'Azazga, Daïra Azazga, Tizi Ouzou, 15300, Algérie', '2024-01-17', '08:30:00', 'Béjaïa, Daïra Béjaïa, Béjaïa, 06000, Algérie', '3 heures', 9, 0, 250, 'Rien', 2),
(3, 'Voyage vers le desert', 2, 'Alger, Alger-Centre, Daïra Sidi M-Hamed, Alger, 16007, Algérie', '2025-03-15', '06:00:00', 'Béchar, Daïra de Béchar, Béchar, 08000, Algérie', '10 heures', 7, 0, 1300, 'Vous êtes la bienvenue', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_status`
--

DROP TABLE IF EXISTS `type_status`;
CREATE TABLE IF NOT EXISTS `type_status` (
  `idS` int NOT NULL AUTO_INCREMENT,
  `descS` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idS`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_status`
--

INSERT INTO `type_status` (`idS`, `descS`) VALUES
(1, 'Disponible'),
(2, 'Complet');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
