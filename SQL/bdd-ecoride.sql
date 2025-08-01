CREATE SCHEMA IF NOT EXISTS `ecoride` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `ecoride` ;

-- -----------------------------------------------------
-- Table `ecoride`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(50) NOT NULL,
  `nom` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NOT NULL,
  `photo` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`preferences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`preferences` (
  `id_preferences` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tabac` VARCHAR(50) NOT NULL,
  `animal` VARCHAR(15) NOT NULL,
  `preferences` TEXT NULL,
  PRIMARY KEY (`id_preferences`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`detailCar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`detailCar` (
  `id_detailCar` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `marque` VARCHAR(50) NOT NULL,
  `modele` VARCHAR(50) NOT NULL,
  `couleur` VARCHAR(50) NOT NULL,
  `ecolo` VARCHAR(45) NOT NULL,
  `places` INT NOT NULL,
  PRIMARY KEY (`id_detailCar`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`voiture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`voiture` (
  `id_voiture` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `immatriculation` VARCHAR(50) NOT NULL,
  `date_immat` DATE NOT NULL,
  `idPref` INT UNSIGNED NOT NULL,
  `idDetail` INT UNSIGNED NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_voiture`),
  INDEX `fk_voiture_users1_idx` (`idUser` ASC),
  INDEX `fk_voiture_preferences1_idx` (`idPref` ASC),
  INDEX `fk_voiture_detailCar1_idx` (`idDetail` ASC),
  CONSTRAINT `fk_voiture_users1`
    FOREIGN KEY (`idUser`)
    REFERENCES `ecoride`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voiture_preferences1`
    FOREIGN KEY (`idPref`)
    REFERENCES `ecoride`.`preferences` (`id_preferences`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voiture_detailCar1`
    FOREIGN KEY (`idDetail`)
    REFERENCES `ecoride`.`detailCar` (`id_detailCar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`covoiturage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`covoiturage` (
  `id_covoiturage` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_depart` DATE NOT NULL,
  `lieu_depart` VARCHAR(50) NOT NULL,
  `heure_depart` TIME NOT NULL,
  `lieu_arrivee` VARCHAR(50) NOT NULL,
  `heure_arrivee` TIME NOT NULL,
  `place_rest` INT NOT NULL,
  `prix` FLOAT NOT NULL,
  `idVoiture` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_covoiturage`),
  INDEX `fk_covoiturage_voiture1_idx` (`idVoiture` ASC),
  CONSTRAINT `fk_covoiturage_voiture1`
    FOREIGN KEY (`idVoiture`)
    REFERENCES `ecoride`.`voiture` (`id_voiture`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`avis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`avis` (
  `id_avis` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `note` INT NOT NULL,
  `commentaire` TEXT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  `idCovoit` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_avis`),
  INDEX `fk_avis_users1_idx` (`idUser` ASC),
  INDEX `fk_avis_covoiturage1_idx` (`idCovoit` ASC),
  CONSTRAINT `fk_avis_users1`
    FOREIGN KEY (`idUser`)
    REFERENCES `ecoride`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avis_covoiturage1`
    FOREIGN KEY (`idCovoit`)
    REFERENCES `ecoride`.`covoiturage` (`id_covoiturage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`role` (
  `id_role` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(50) NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_role`),
  INDEX `fk_role_users1_idx` (`idUser` ASC),
  CONSTRAINT `fk_role_users1`
    FOREIGN KEY (`idUser`)
    REFERENCES `ecoride`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`reservation` (
  `id_reservation` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  `idCovoit` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_reservation`),
  INDEX `fk_reservation_users1_idx` (`idUser` ASC),
  INDEX `fk_reservation_covoiturage1_idx` (`idCovoit` ASC),
  CONSTRAINT `fk_reservation_users1`
    FOREIGN KEY (`idUser`)
    REFERENCES `ecoride`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservation_covoiturage1`
    FOREIGN KEY (`idCovoit`)
    REFERENCES `ecoride`.`covoiturage` (`id_covoiturage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ecoride`.`credit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ecoride`.`credit` (
  `id_credit` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `credit_initial` FLOAT NOT NULL,
  `credit_ajoute` FLOAT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  `idReserv` INT UNSIGNED NOT NULL,
  `idCovoit` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_credit`),
  INDEX `fk_credit_users1_idx` (`idUser` ASC),
  INDEX `fk_credit_reservation1_idx` (`idReserv` ASC),
  INDEX `fk_credit_covoiturage1_idx` (`idCovoit` ASC),
  CONSTRAINT `fk_credit_users1`
    FOREIGN KEY (`idUser`)
    REFERENCES `ecoride`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_credit_reservation1`
    FOREIGN KEY (`idReserv`)
    REFERENCES `ecoride`.`reservation` (`id_reservation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_credit_covoiturage1`
    FOREIGN KEY (`idCovoit`)
    REFERENCES `ecoride`.`covoiturage` (`id_covoiturage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
