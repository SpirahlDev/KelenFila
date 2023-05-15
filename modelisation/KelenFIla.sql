-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 mai 2023 à 02:29
-- Version du serveur : 10.11.2-MariaDB-1
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `KelenFIla`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `BRING_LOT` (IN `ID` INT)   BEGIN
    DECLARE typeU VARCHAR(45);
    DECLARE emailU VARCHAR(260);
    DECLARE numeroU VARCHAR(25);
    DECLARE name VARCHAR(45);
    DECLARE idVendeur BIGINT;
  DECLARE nom VARCHAR(45); 
      DECLARE prenom VARCHAR(45);
    SELECT idUser,typeUser,emailUser,numeroUser INTO idVendeur,typeU,emailU,numeroU from user where `idUser`=(SELECT idVendeur from enchere INNER JOIN lot on lot.`idEnchere`=enchere.`idEnchere` where `idLot`=ID);

    IF (typeU="particulier") THEN
        SELECT nomParticul, PrenomParticul INTO nom, prenom FROM particulier WHERE particulier.`idUser`=idVendeur;
        SET name=CONCAT(nom,' ',prenom);

    ELSEIF (typeU="entreprise") THEN
        SELECT designEntreprise INTO name from entreprise where entreprise.`idUser`=idVendeur;
    END IF;

    SELECT lot.*, @typeU:=typeU as typeUser, @emailU:=emailU as emailUser, 
           @numeroU:=numeroU as numeroUser, @name:=name as name 
    FROM lot WHERE idLot=ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_ENCHERE` (IN `dateEnch` DATETIME, IN `durerEnchere` VARCHAR(10), IN `categorie` INT, IN `vendeurID` BIGINT, OUT `idEnchere` BIGINT)   BEGIN
    DECLARE numeroEnchere VARCHAR(45);
    DECLARE designVendeur VARCHAR(45);
    DECLARE typeV VARCHAR(45);
    DECLARE nb INT;
    
    SELECT count(*) INTO nb FROM enchere where enchere.idVendeur=vendeurID;
    SELECT FORMAT(nb,'000') INTO nb;
    SELECT typeUser INTO typeV from `user` where `idUser`=vendeurID;

    IF(typeV="entreprise") THEN 
        SELECT designEntreprise INTO designVendeur FROM entreprise where entreprise.`idUser`=vendeurID;
    ELSEIF(typeV="particulier") THEN 
        SELECT nomParticul INTO designVendeur FROM particulier where particulier.`idUser`=vendeurID;
    END IF; 
    SELECT CONCAT(designVendeur,"ENCH",nb) INTO numeroEnchere;
    INSERT INTO enchere (`numEnchere`,`dateEnchere`,`durerEnchere`,`idCategorie`,`idVendeur`) VALUES(numeroEnchere,dateEnch,durerEnchere,categorie,vendeurID);
    SET idEnchere=LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_ENTREPRISE` (IN `e_id` INT, IN `e_design` VARCHAR(45), IN `e_nom_inter` VARCHAR(45), IN `e_prenom_inter` VARCHAR(45), IN `e_poste_inter` VARCHAR(45), IN `IDU` VARCHAR(45))   BEGIN 
INSERT INTO entreprise (designEntreprise,nom_intermediaire,prenom_intermediaire,poste_intermediaire,IDU)
VALUES (e_design,e_nom_inter,e_prenom_inter,e_poste_inter,IDU);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_PARTICULIER` (IN `p_id` INT, IN `p_nomParticul` VARCHAR(255), IN `p_prenomParticul` VARCHAR(255), IN `p_dateNaissance` VARCHAR(45), IN `p_dir` VARCHAR(400))   BEGIN
    INSERT INTO particulier (nomParticul, prenomParticul, dateNaissance,idUser,CNI)
    VALUES (p_nomParticul, p_prenomParticul, p_dateNaissance,p_id,p_dir);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CREATE_USER` (IN `emailUser` VARCHAR(255), IN `numeroUser` VARCHAR(255), IN `password` VARCHAR(255), IN `pays` VARCHAR(255), IN `ville` VARCHAR(255), IN `adresse` VARCHAR(255), IN `typeUser` VARCHAR(255), OUT `id` BIGINT)   BEGIN
  INSERT INTO user (emailUser, numeroUser, password, pays, ville, adresse, typeUser)
  VALUES (emailUser, numeroUser, password, pays, ville, adresse, typeUser);
  SELECT LAST_INSERT_ID() INTO id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_LOT` (IN `design` VARCHAR(45), IN `descript` TEXT(600), IN `etat` VARCHAR(50), IN `estim` DOUBLE, IN `numLot` INT, IN `img1` VARCHAR(400), IN `img2` VARCHAR(400), IN `img3` VARCHAR(400), IN `img4` VARCHAR(400), IN `img5` VARCHAR(400), IN `img6` VARCHAR(400), IN `idEnchere` BIGINT)   BEGIN
  INSERT INTO lot (`designLot`,`descriptionLot`,`etatLot`,`estimatLot`,`numeroLot`,`image1`,`image2`,`image3`,`image4`,`image5`,`image6`,`idEnchere`) VALUES(
    design,descript,etat,estim,numLot,img1,img2,img3,img4,img5,img6,idEnchere
  );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `adjudicataire`
--

CREATE TABLE `adjudicataire` (
  `idUser_adju` int(11) NOT NULL,
  `idLot_lot` int(11) NOT NULL,
  `prix` double NOT NULL,
  `dateVictoire` datetime DEFAULT current_timestamp(),
  `place_adju` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `designCategorie` varchar(45) NOT NULL,
  `imageCategorie` varchar(400) DEFAULT NULL,
  `descriptCategorie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `designCategorie`, `imageCategorie`, `descriptCategorie`) VALUES
(1, 'Ameublement', NULL, 'Des canapés confortables aux tables élégantes en passant par les armoires fonctionnelles, découvrez les pièces maîtresses uniques qui transformeront votre intérieur. '),
(2, 'Électroménager et matériel pro.', NULL, 'Plongez dans notre catégorie Électroménager matériel pro. où vous trouverez une sélection complète d\'équipements professionnels pour répondre à vos besoins'),
(3, 'Livres', NULL, 'Parcourez une vaste sélection de romans, de livres de référence, de livres anciens et de bandes dessinées pour enrichir votre bibliothèque personnelle.'),
(4, 'Autres véhicules et engins ', NULL, 'Des motos aux vélos, des bateaux aux caravanes, des engins de construction aux équipements agricoles, explorez notre sélection diversifiée pour trouver LE véhicule ou L\'engin qui correspond à vos attentes'),
(5, 'Voitures de sport et de collection', NULL, 'Que vous soyez un passionné de vitesse ou un collectionneur averti, notre collection vous fera battre le cœur au plus vite.'),
(6, 'Informatique & Telephonie', NULL, 'Découvrez ce qu\'il vous faut, des technologies les plus avant-gardistes à leurs prémices dans le monde !'),
(7, 'Jouets', NULL, 'Vous trouverez ici une variété de choix qui raviront les petits et les grands enfants. Laissez libre cours à votre imagination et laissez les jeux commencer !'),
(8, 'Horlogerie', NULL, 'Découvrez des montres de collection et des montres de luxe qui allient style et fonctionnalité'),
(9, 'Musique', NULL, 'Que vous soyez un musicien accompli ou un amateur de musique, vous trouverez ici tout ce dont vous avez besoin pour vivre ou revivre votre passion.'),
(10, 'Mode & Bijoux', NULL, 'Que vous recherchiez des pièces de créateurs, des articles vintage ou des articles de luxe, vous trouverez votre bonheur ici'),
(11, 'Vins et spiritueux', NULL, 'Que vous soyez un collectionneur passionné ou simplement un amateur de bons breuvages, notre sélection saura éveiller vos papilles'),
(12, 'Collections ', NULL, 'Notre catégorie Collections regorge de trésors pour les passionnés et les collectionneurs. Que vous recherchiez des pièces de monnaie anciennes, des timbres rares, des objets de collection vintage ou des souvenirs historiques, vous trouverez ici des articles uniques qui susciteront votre intérêt et enrichiront votre collection.'),
(13, 'Arts de la table', NULL, 'Découvrez notre catégorie Arts de la table, où l\'élégance rencontre la fonctionnalité.');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

CREATE TABLE `enchere` (
  `idEnchere` int(11) NOT NULL,
  `numEnchere` varchar(45) NOT NULL,
  `dateEnchere` datetime DEFAULT NULL,
  `durerEnchere` varchar(45) DEFAULT NULL,
  `idCategorie` int(11) NOT NULL,
  `idVendeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`idEnchere`, `numEnchere`, `dateEnchere`, `durerEnchere`, `idCategorie`, `idVendeur`) VALUES
(18, 'AlloueENCH0', '2023-05-11 00:22:00', '00:23', 5, 18),
(19, 'AlloueENCH1', '2023-05-11 00:22:00', '00:23', 5, 18);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `designEntreprise` varchar(45) NOT NULL,
  `IDU` varchar(45) NOT NULL COMMENT 'numero d''identification unique d''entreprise ',
  `nom_intermediaire` varchar(45) NOT NULL,
  `prenom_intermediaire` varchar(45) NOT NULL,
  `poste_intermediaire` varchar(45) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `idLot` int(11) NOT NULL,
  `designLot` varchar(45) NOT NULL,
  `descriptionLot` text NOT NULL,
  `etatLot` varchar(50) NOT NULL,
  `estimatLot` double NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp(),
  `numeroLot` int(11) NOT NULL,
  `image1` varchar(400) NOT NULL,
  `image2` varchar(400) NOT NULL,
  `image3` varchar(400) NOT NULL,
  `image4` varchar(400) NOT NULL,
  `image5` varchar(400) DEFAULT NULL,
  `image6` varchar(400) DEFAULT NULL,
  `isVendue` tinyint(4) DEFAULT NULL,
  `prixVendue` double DEFAULT NULL,
  `idEnchere` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `methodPaiement`
--

CREATE TABLE `methodPaiement` (
  `idtypePaiement` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `coordPaiement` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `modalite`
--

CREATE TABLE `modalite` (
  `idModal` int(11) NOT NULL,
  `modalPaiement` text NOT NULL,
  `modalLivraison` text NOT NULL,
  `formuleSalutation` text DEFAULT NULL,
  `modalAutre` text DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `delaiPaiement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE `participer` (
  `idUser_client` int(11) NOT NULL,
  `idEnchere_enchere` int(11) NOT NULL,
  `isSpectateur` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `particulier`
--

CREATE TABLE `particulier` (
  `idParticu` int(11) NOT NULL,
  `nomParticul` varchar(45) NOT NULL,
  `prenomParticul` varchar(45) NOT NULL,
  `dateNaissance` varchar(45) DEFAULT NULL,
  `idUser` int(45) DEFAULT NULL,
  `CNI` varchar(400) NOT NULL COMMENT 'carte nationnal d''identité ',
  `isConfirmed` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `particulier`
--

INSERT INTO `particulier` (`idParticu`, `nomParticul`, `prenomParticul`, `dateNaissance`, `idUser`, `CNI`, `isConfirmed`) VALUES
(6, 'Anselme', 'Alloue', NULL, 10, '../../../FTP-server/user_files/information/AnselmeAlloue10-CNI.jpeg', 0),
(8, 'Gongapieu', 'Newton', NULL, 12, '../../../FTP-server/user_files/information/GongapieuNewton12-CNI.png', 0),
(9, 'Anselme', 'Alloue', NULL, 13, '../../../FTP-server/user_files/information/AnselmeAlloue13-CNI.png', 0),
(10, 'Gbayo', 'Isaac', NULL, 14, '../../../FTP-server/user_files/information/GbayoIsaac14-CNI.jpeg', 0),
(12, 'Alloue', 'Anselme Emmanuel', NULL, 18, '../../../FTP-server/user_files/information/AlloueAnselme Emmanuel18-CNI.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `typePaiement`
--

CREATE TABLE `typePaiement` (
  `idtypePaiement` int(11) NOT NULL,
  `designPaiement` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `emailUser` varchar(100) NOT NULL,
  `numeroUser` varchar(25) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT current_timestamp(),
  `password` varchar(100) NOT NULL,
  `typeUser` varchar(45) NOT NULL,
  `pays` varchar(45) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `logo` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `emailUser`, `numeroUser`, `dateInscription`, `password`, `typeUser`, `pays`, `ville`, `adresse`, `logo`) VALUES
(10, 'isac@gmail.com', '0503680098', '2023-04-24 00:58:17', '$2y$10$DXTKrSgBslsZyEd7EF9KJuyVo6iDUNJ8xH9rox76M9hCnTLdggQiO', 'particulier', 'Burkina Faso', 'abidjan', 'abidjan', NULL),
(12, 'newton@gmail.com', '0503680098', '2023-04-25 21:28:31', '$2y$10$96qNJSf.1p6aMNmwLdLTneTcQ6OXOTW1kP/rhLF2QGXnvF.Qu6dBa', 'particulier', 'Côte d\'Ivoire', 'abidjan', 'abidjan', NULL),
(13, 'emmanuelvianney1234@gmail.com', '0102804964', '2023-05-01 19:08:43', '$2y$10$rrxcV09wa6mtDlk71nQ6teL8iObDx4fThSl69y5ra3HCCMhjrqe46', 'particulier', 'Côte d\'Ivoire', 'abidjan', 'abj', NULL),
(14, 'emmanuelvianney1234@gmail.com', '0503680098', '2023-05-01 19:19:41', '$2y$10$u1X9P9zIpbNxhPyS5jFe5uBxgK8Hb7E/Wv68o9vYm1XIBi5najxgC', 'particulier', 'Côte d\'Ivoire', 'abidjan', 'abidjan', NULL),
(18, 'yapson@gmail.com', '0504680098', '2023-05-10 21:08:34', '$2y$10$wwurF2yv0BpSDlicMc3QceKtiud2nY7ARCkXS1Jv5vCF935KK5jOC', 'particulier', 'Côte d\'ivoire', 'Abidjan', 'BP 23 Abidjan 12', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adjudicataire`
--
ALTER TABLE `adjudicataire`
  ADD PRIMARY KEY (`idUser_adju`,`idLot_lot`),
  ADD KEY `fk_user_has_lot_lot1_idx` (`idLot_lot`),
  ADD KEY `fk_user_has_lot_user1_idx` (`idUser_adju`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`),
  ADD UNIQUE KEY `designCategorie_UNIQUE` (`designCategorie`);

--
-- Index pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`idEnchere`),
  ADD UNIQUE KEY `numEnchere_UNIQUE` (`numEnchere`),
  ADD KEY `FK_ENCHERE_CATEGORIE_idx` (`idCategorie`),
  ADD KEY `idVendeur` (`idVendeur`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntreprise`),
  ADD UNIQUE KEY `IDU_UNIQUE` (`IDU`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`idUser`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`idLot`),
  ADD KEY `idEnchere` (`idEnchere`);

--
-- Index pour la table `methodPaiement`
--
ALTER TABLE `methodPaiement`
  ADD PRIMARY KEY (`idtypePaiement`,`idUser`),
  ADD KEY `FK_PAIEMENT_USER_MET_idx` (`idUser`);

--
-- Index pour la table `modalite`
--
ALTER TABLE `modalite`
  ADD PRIMARY KEY (`idModal`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`idUser`);

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`idUser_client`,`idEnchere_enchere`),
  ADD KEY `fk_user_has_enchere_enchere1_idx` (`idEnchere_enchere`),
  ADD KEY `fk_user_has_enchere_user1_idx` (`idUser_client`);

--
-- Index pour la table `particulier`
--
ALTER TABLE `particulier`
  ADD PRIMARY KEY (`idParticu`),
  ADD UNIQUE KEY `idUser_UNIQUE` (`idUser`);

--
-- Index pour la table `typePaiement`
--
ALTER TABLE `typePaiement`
  ADD PRIMARY KEY (`idtypePaiement`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enchere`
--
ALTER TABLE `enchere`
  MODIFY `idEnchere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `idLot` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modalite`
--
ALTER TABLE `modalite`
  MODIFY `idModal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `particulier`
--
ALTER TABLE `particulier`
  MODIFY `idParticu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adjudicataire`
--
ALTER TABLE `adjudicataire`
  ADD CONSTRAINT `fk_user_has_lot_lot1` FOREIGN KEY (`idLot_lot`) REFERENCES `lot` (`idLot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_lot_user1` FOREIGN KEY (`idUser_adju`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `FK_ENCHERE_CATEGORIE` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENCHERE_VENDEUR` FOREIGN KEY (`idVendeur`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_ENTREPRISE_USER` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`idEnchere`) REFERENCES `enchere` (`idEnchere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `methodPaiement`
--
ALTER TABLE `methodPaiement`
  ADD CONSTRAINT `FK_PAIEMENT_USER_MET` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_TYPE_PAIEMENT` FOREIGN KEY (`idtypePaiement`) REFERENCES `typePaiement` (`idtypePaiement`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `modalite`
--
ALTER TABLE `modalite`
  ADD CONSTRAINT `FK_MODALITE_USER` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `fk_user_has_enchere_user1` FOREIGN KEY (`idUser_client`) REFERENCES `user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `participer_ibfk_1` FOREIGN KEY (`idEnchere_enchere`) REFERENCES `enchere` (`idEnchere`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `particulier`
--
ALTER TABLE `particulier`
  ADD CONSTRAINT `FK_CLIENT_USER` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
