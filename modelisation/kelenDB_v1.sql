-- MySQL Script generated by MySQL Workbench
-- Tue Apr  4 08:16:20 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema KelenFIla
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema KelenFIla
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `KelenFIla` DEFAULT CHARACTER SET utf8 ;
USE `KelenFIla` ;

-- -----------------------------------------------------
-- Table `KelenFIla`.`typePaiement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`typePaiement` (
  `idtypePaiement` INT NOT NULL,
  `designPaiement` VARCHAR(45) NULL,
  PRIMARY KEY (`idtypePaiement`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`user` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `emailUser` VARCHAR(100) NOT NULL,
  `numeroUser` VARCHAR(25) NOT NULL,
  `dateInscription` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` VARCHAR(100) NOT NULL,
  `typeUser` VARCHAR(45) NOT NULL,
  `pays` VARCHAR(45) NOT NULL,
  `ville` VARCHAR(45) NOT NULL,
  `adresse` VARCHAR(100) NOT NULL,
  `logo` VARCHAR(400) NULL,
  PRIMARY KEY (`idUser`),
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`methodPaiement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`methodPaiement` (
  `idtypePaiement` INT NOT NULL,
  `idUser` INT NOT NULL,
  `coordPaiement` VARCHAR(100) NULL,
  PRIMARY KEY (`idtypePaiement`, `idUser`),
  INDEX `FK_PAIEMENT_USER_MET_idx` (`idUser` ASC) VISIBLE,
  CONSTRAINT `FK_PAIEMENT_USER_MET`
    FOREIGN KEY (`idUser`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_TYPE_PAIEMENT`
    FOREIGN KEY (`idtypePaiement`)
    REFERENCES `KelenFIla`.`typePaiement` (`idtypePaiement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`particulier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`particulier` (
  `idParticu` INT NOT NULL,
  `nomParticul` VARCHAR(45) NOT NULL,
  `prenomParticul` VARCHAR(45) NOT NULL,
  `dateNaissance` VARCHAR(45) NOT NULL,
  `idUser` INT(45) NULL,
  `CNI` VARCHAR(400) NOT NULL COMMENT 'carte nationnal d\'identité ',
  `isConfirmed` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`idParticu`),
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC) VISIBLE,
  CONSTRAINT `FK_CLIENT_USER`
    FOREIGN KEY (`idUser`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`entreprise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`entreprise` (
  `idEntreprise` INT NOT NULL AUTO_INCREMENT,
  `designEntreprise` VARCHAR(45) NOT NULL,
  `IDU` VARCHAR(45) NOT NULL COMMENT 'numero d\'identification unique d\'entreprise ',
  `nom_intermediaire` VARCHAR(45) NOT NULL,
  `prenom_intermediaire` VARCHAR(45) NOT NULL,
  `poste_intermediaire` VARCHAR(45) NOT NULL,
  `idUser` INT NULL,
  PRIMARY KEY (`idEntreprise`),
  UNIQUE INDEX `IDU_UNIQUE` (`IDU` ASC) VISIBLE,
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC) VISIBLE,
  CONSTRAINT `FK_ENTREPRISE_USER`
    FOREIGN KEY (`idUser`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`categorie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`categorie` (
  `idCategorie` INT NOT NULL,
  `designCategorie` VARCHAR(45) NOT NULL,
  `imageCategorie` VARCHAR(400) NULL,
  `descriptCategorie` TEXT NULL,
  PRIMARY KEY (`idCategorie`),
  UNIQUE INDEX `designCategorie_UNIQUE` (`designCategorie` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`enchere`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`enchere` (
  `idEnchere` INT NOT NULL,
  `numEnchere` VARCHAR(45) NOT NULL,
  ` dateEnchere` DATETIME NULL,
  `durerEnchere` VARCHAR(45) NULL,
  `idCategorie` INT NOT NULL,
  `idVendeur` INT NOT NULL,
  PRIMARY KEY (`idEnchere`),
  UNIQUE INDEX `numEnchere_UNIQUE` (`numEnchere` ASC) VISIBLE,
  UNIQUE INDEX `idVendeur_UNIQUE` (`idVendeur` ASC) VISIBLE,
  INDEX `FK_ENCHERE_CATEGORIE_idx` (`idCategorie` ASC) VISIBLE,
  CONSTRAINT `FK_ENCHERE_CATEGORIE`
    FOREIGN KEY (`idCategorie`)
    REFERENCES `KelenFIla`.`categorie` (`idCategorie`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_ENCHERE_VENDEUR`
    FOREIGN KEY (`idVendeur`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`lot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`lot` (
  `idLot` INT NOT NULL AUTO_INCREMENT,
  `designLot` VARCHAR(45) NOT NULL,
  `descriptionLot` TEXT(600) NOT NULL,
  `etatLot` VARCHAR(50) NOT NULL,
  `estimatLot` DOUBLE NOT NULL,
  `numeroLot` INT NOT NULL,
  `image1` VARCHAR(400) NOT NULL,
  `image2` VARCHAR(400) NOT NULL,
  `image3` VARCHAR(400) NOT NULL,
  `image4` VARCHAR(400) NOT NULL,
  `image5` VARCHAR(400) NULL,
  `image6` VARCHAR(400) NULL,
  `isVendue` TINYINT NULL,
  `prixVendue` DOUBLE NULL,
  `idEnchere` INT NULL,
  PRIMARY KEY (`idLot`),
  UNIQUE INDEX `idEnchere_UNIQUE` (`idEnchere` ASC) VISIBLE,
  CONSTRAINT `FK_LOT_ENCHERE`
    FOREIGN KEY (`idEnchere`)
    REFERENCES `KelenFIla`.`enchere` (`idEnchere`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`modalite`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`modalite` (
  `idModal` INT NOT NULL AUTO_INCREMENT,
  `modalPaiement` TEXT NOT NULL,
  `modalLivraison` TEXT NOT NULL,
  `formuleSalutation` TEXT NULL,
  `modalAutre` TEXT NULL,
  `idUser` INT NULL,
  `delaiPaiement` DATE NULL,
  PRIMARY KEY (`idModal`),
  UNIQUE INDEX `idUser_UNIQUE` (`idUser` ASC) VISIBLE,
  CONSTRAINT `FK_MODALITE_USER`
    FOREIGN KEY (`idUser`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`participer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`participer` (
  `idUser_client` INT NOT NULL,
  `idEnchere_enchere` INT NOT NULL,
  `isSpectateur` TINYINT NOT NULL,
  PRIMARY KEY (`idUser_client`, `idEnchere_enchere`),
  INDEX `fk_user_has_enchere_enchere1_idx` (`idEnchere_enchere` ASC) VISIBLE,
  INDEX `fk_user_has_enchere_user1_idx` (`idUser_client` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_enchere_user1`
    FOREIGN KEY (`idUser_client`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_enchere_enchere1`
    FOREIGN KEY (`idEnchere_enchere`)
    REFERENCES `KelenFIla`.`enchere` (`idEnchere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `KelenFIla`.`adjudicataire`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `KelenFIla`.`adjudicataire` (
  `idUser_adju` INT NOT NULL,
  `idLot_lot` INT NOT NULL,
  `prix` DOUBLE NOT NULL,
  `dateVictoire` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `place_adju` INT NOT NULL,
  PRIMARY KEY (`idUser_adju`, `idLot_lot`),
  INDEX `fk_user_has_lot_lot1_idx` (`idLot_lot` ASC) VISIBLE,
  INDEX `fk_user_has_lot_user1_idx` (`idUser_adju` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_lot_user1`
    FOREIGN KEY (`idUser_adju`)
    REFERENCES `KelenFIla`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_lot_lot1`
    FOREIGN KEY (`idLot_lot`)
    REFERENCES `KelenFIla`.`lot` (`idLot`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
