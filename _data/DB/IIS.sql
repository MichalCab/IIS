-- MySQL Script generated by MySQL Workbench
-- 12/05/14 19:36:42
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pe000404db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema pe000404db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pe000404db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `pe000404db` ;

-- -----------------------------------------------------
-- Table `pe000404db`.`Stav`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Stav` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Stav` (
  `id` CHAR(36) NOT NULL,
  `deleted` BIT(1) NOT NULL DEFAULT 0,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Clen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Clen` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Clen` (
  `id` CHAR(36) NOT NULL,
  `login` VARCHAR(100) NOT NULL,
  `heslo` VARCHAR(100) NOT NULL,
  `evidovany` BIT(1) NOT NULL DEFAULT 0,
  `typ` CHAR(3) NOT NULL DEFAULT 'ZAK',
  `meno` VARCHAR(100) NOT NULL,
  `priezvisko` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`OblastRozvozu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`OblastRozvozu` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`OblastRozvozu` (
  `id` CHAR(36) NOT NULL,
  `nazov` VARCHAR(45) NULL,
  `spravuje` CHAR(36) NULL,
  INDEX `fk_spravuje_idx` (`spravuje` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_oblastrozvozu_spravuje`
    FOREIGN KEY (`spravuje`)
    REFERENCES `pe000404db`.`Clen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Adresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Adresa` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Adresa` (
  `id` CHAR(36) NOT NULL,
  `oblast` CHAR(36) NULL,
  `clen` CHAR(36) NOT NULL,
  `adresa` VARCHAR(255) NOT NULL,
  INDEX `fk_oblast_idx` (`oblast` ASC),
  INDEX `fk_clen_idx` (`clen` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_adresa_oblast`
    FOREIGN KEY (`oblast`)
    REFERENCES `pe000404db`.`OblastRozvozu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresa_clen`
    FOREIGN KEY (`clen`)
    REFERENCES `pe000404db`.`Clen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Objednavka`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Objednavka` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Objednavka` (
  `id` CHAR(36) NOT NULL,
  `cislo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `termin` DATE NOT NULL,
  `suma` FLOAT(10,2) NOT NULL,
  `vybavene` BIT(1) NOT NULL,
  `vodic` CHAR(36) NULL,
  `podal` CHAR(36) NOT NULL,
  `adresa` CHAR(36) NULL,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_adresa_idx` (`adresa` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cislo_UNIQUE` (`cislo` ASC),
  CONSTRAINT `fk_objednavka_vodic`
    FOREIGN KEY (`vodic`)
    REFERENCES `pe000404db`.`Clen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_objednavka_adresa`
    FOREIGN KEY (`adresa`)
    REFERENCES `pe000404db`.`Adresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Pecivo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Pecivo` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Pecivo` (
  `id` CHAR(36) NOT NULL,
  `nazov` VARCHAR(45) NOT NULL,
  `popis` VARCHAR(255) NULL,
  `cena` FLOAT(10,2) UNSIGNED NOT NULL,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Zoznam`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Zoznam` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Zoznam` (
  `id` CHAR(36) NOT NULL,
  `objednavka` CHAR(36) NOT NULL,
  `pecivo` CHAR(36) NOT NULL,
  `mnozstvo` INT UNSIGNED NOT NULL,
  INDEX `fk_objednavka_idx` (`objednavka` ASC),
  INDEX `fk_pecivo_idx` (`pecivo` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_zoznam_objednavka`
    FOREIGN KEY (`objednavka`)
    REFERENCES `pe000404db`.`Objednavka` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_zoznam_pecivo`
    FOREIGN KEY (`pecivo`)
    REFERENCES `pe000404db`.`Pecivo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Surovina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Surovina` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Surovina` (
  `id` CHAR(36) NOT NULL,
  `nazov` VARCHAR(100) NOT NULL,
  `nakupnaCena` FLOAT(10,2) NULL,
  `naSklade` FLOAT(10,3) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pe000404db`.`Recept`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pe000404db`.`Recept` ;

CREATE TABLE IF NOT EXISTS `pe000404db`.`Recept` (
  `id` CHAR(36) NOT NULL,
  `surovina` CHAR(36) NOT NULL,
  `pecivo` CHAR(36) NOT NULL,
  `mnozstvo` FLOAT(10,3) NOT NULL,
  INDEX `fk_surovina_idx` (`surovina` ASC),
  INDEX `fk_pecivo_idx` (`pecivo` ASC),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_recept_surovina`
    FOREIGN KEY (`surovina`)
    REFERENCES `pe000404db`.`Surovina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recept_pecivo`
    FOREIGN KEY (`pecivo`)
    REFERENCES `pe000404db`.`Pecivo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `pe000404db` ;

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vAdresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vAdresa` (`id` INT, `oblast` INT, `clen` INT, `adresa` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vClen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vClen` (`id` INT, `login` INT, `heslo` INT, `evidovany` INT, `typ` INT, `meno` INT, `priezvisko` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavka`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavka` (`id` INT, `cislo` INT, `termin` INT, `suma` INT, `vybavene` INT, `vodic` INT, `podal` INT, `adresa` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vOblastRozvozu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vOblastRozvozu` (`id` INT, `nazov` INT, `spravuje` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vPecivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vPecivo` (`id` INT, `nazov` INT, `popis` INT, `cena` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vRecept`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vRecept` (`id` INT, `surovina` INT, `pecivo` INT, `mnozstvo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vStav`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vStav` (`id` INT, `deleted` INT, `created` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vSurovina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vSurovina` (`id` INT, `nazov` INT, `nakupnaCena` INT, `naSklade` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vZoznam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vZoznam` (`id` INT, `objednavka` INT, `pecivo` INT, `mnozstvo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vSurovinaFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vSurovinaFull` (`id` INT, `nazov` INT, `nakupnaCena` INT, `naSklade` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vZoznamFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vZoznamFull` (`id` INT, `objednavka` INT, `pecivo` INT, `mnozstvo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vReceptFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vReceptFull` (`id` INT, `surovina` INT, `pecivo` INT, `mnozstvo` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vPecivoFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vPecivoFull` (`id` INT, `nazov` INT, `popis` INT, `cena` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vStavFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vStavFull` (`id` INT, `deleted` INT, `created` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vOblastRozvozuFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vOblastRozvozuFull` (`id` INT, `nazov` INT, `spravuje` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavkaFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavkaFull` (`id` INT, `cislo` INT, `termin` INT, `suma` INT, `vybavene` INT, `vodic` INT, `podal` INT, `adresa` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vClenFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vClenFull` (`id` INT, `login` INT, `heslo` INT, `evidovany` INT, `typ` INT, `meno` INT, `priezvisko` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vAdresaFull`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vAdresaFull` (`id` INT, `oblast` INT, `clen` INT, `adresa` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vOblastRozvozuAdresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vOblastRozvozuAdresa` (`spravuje` INT, `OblastRozvozuId` INT, `nazov` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vVodicAdresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vVodicAdresa` (`AdresaId` INT, `OblastRozvozuId` INT, `nazov` INT, `adresa` INT, `clen` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavkaOblast`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavkaOblast` (`id` INT, `cislo` INT, `termin` INT, `suma` INT, `vybavene` INT, `vodic` INT, `podal` INT, `AdresaId` INT, `OblastRozvozuId` INT, `nazov` INT, `spravuje` INT, `adresa` INT, `clen` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vPecivoSurovina`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vPecivoSurovina` (`mnozstvo` INT, `SurovinaNazov` INT, `nakupnaCena` INT, `naSklade` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavkaPecivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavkaPecivo` (`mnozstvo` INT, `nazov` INT, `popis` INT, `cena` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavkaAdresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavkaAdresa` (`id` INT, `cislo` INT, `termin` INT, `suma` INT, `vybavene` INT, `vodic` INT, `podal` INT, `adresaId` INT, `oblast` INT, `clen` INT, `adresa` INT);

-- -----------------------------------------------------
-- Placeholder table for view `pe000404db`.`vObjednavkaAdresaClen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pe000404db`.`vObjednavkaAdresaClen` (`id` INT, `cislo` INT, `termin` INT, `suma` INT, `vybavene` INT, `vodic` INT, `podal` INT, `adresaId` INT, `oblast` INT, `clen` INT, `adresa` INT, `meno` INT, `priezvisko` INT);

-- -----------------------------------------------------
-- View `pe000404db`.`vAdresa`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vAdresa` ;
DROP TABLE IF EXISTS `pe000404db`.`vAdresa`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vAdresa` AS SELECT a.* FROM Adresa AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;


-- -----------------------------------------------------
-- View `pe000404db`.`vClen`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vClen` ;
DROP TABLE IF EXISTS `pe000404db`.`vClen`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vClen` AS SELECT a.* FROM Clen AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavka`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavka` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavka`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavka` AS SELECT a.* FROM Objednavka AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vOblastRozvozu`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vOblastRozvozu` ;
DROP TABLE IF EXISTS `pe000404db`.`vOblastRozvozu`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vOblastRozvozu` AS SELECT a.* FROM OblastRozvozu AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vPecivo`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vPecivo` ;
DROP TABLE IF EXISTS `pe000404db`.`vPecivo`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vPecivo` AS SELECT a.* FROM Pecivo AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vRecept`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vRecept` ;
DROP TABLE IF EXISTS `pe000404db`.`vRecept`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vRecept` AS SELECT a.* FROM Recept AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vStav`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vStav` ;
DROP TABLE IF EXISTS `pe000404db`.`vStav`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vStav` AS SELECT a.* FROM Stav AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vSurovina`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vSurovina` ;
DROP TABLE IF EXISTS `pe000404db`.`vSurovina`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vSurovina` AS SELECT a.* FROM Surovina AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vZoznam`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vZoznam` ;
DROP TABLE IF EXISTS `pe000404db`.`vZoznam`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vZoznam` AS SELECT a.* FROM Zoznam AS a JOIN Stav as st on st.id = a.id where st.deleted = 0;

-- -----------------------------------------------------
-- View `pe000404db`.`vSurovinaFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vSurovinaFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vSurovinaFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vSurovinaFull` AS SELECT a.* FROM Surovina AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vZoznamFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vZoznamFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vZoznamFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vZoznamFull` AS SELECT a.* FROM Zoznam AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vReceptFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vReceptFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vReceptFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vReceptFull` AS SELECT a.* FROM Recept AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vPecivoFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vPecivoFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vPecivoFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vPecivoFull` AS SELECT a.* FROM Pecivo AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vStavFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vStavFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vStavFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vStavFull` AS SELECT a.* FROM Stav AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vOblastRozvozuFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vOblastRozvozuFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vOblastRozvozuFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vOblastRozvozuFull` AS SELECT a.* FROM OblastRozvozu AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavkaFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavkaFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavkaFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavkaFull` AS SELECT a.* FROM Objednavka AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vClenFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vClenFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vClenFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vClenFull` AS SELECT a.* FROM Clen AS a JOIN Stav as st on st.id = a.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vAdresaFull`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vAdresaFull` ;
DROP TABLE IF EXISTS `pe000404db`.`vAdresaFull`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vAdresaFull` AS SELECT a.* FROM Adresa AS a JOIN Stav as st on st.id = a.id;


-- -----------------------------------------------------
-- View `pe000404db`.`vOblastRozvozuAdresa`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vOblastRozvozuAdresa` ;
DROP TABLE IF EXISTS `pe000404db`.`vOblastRozvozuAdresa`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vOblastRozvozuAdresa` AS SELECT a.*, obr.spravuje, obr.id as OblastRozvozuId, obr.nazov FROM vAdresa AS a RIGHT JOIN vOblastRozvozu as obr ON a.oblast = obr.id;

-- -----------------------------------------------------
-- View `pe000404db`.`vVodicAdresa`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vVodicAdresa` ;
DROP TABLE IF EXISTS `pe000404db`.`vVodicAdresa`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vVodicAdresa` AS SELECT c.*, ora.id as AdresaId, ora.OblastRozvozuId, ora.nazov, ora.adresa, ora.clen FROM vOblastRozvozuAdresa AS ora RIGHT JOIN vClen as c ON c.id = ora.spravuje;

-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavkaOblast`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavkaOblast` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavkaOblast`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavkaOblast` AS SELECT o.id, o.cislo, o.termin, o.suma, o.vybavene, o.vodic, o.podal, ora.id as AdresaId, ora.OblastRozvozuId, ora.nazov, ora.spravuje, ora.adresa, ora.clen FROM vObjednavka AS o LEFT JOIN vOblastRozvozuAdresa AS ora ON ora.id = o.adresa ORDER BY o.cislo DESC;


-- -----------------------------------------------------
-- View `pe000404db`.`vPecivoSurovina`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vPecivoSurovina` ;
DROP TABLE IF EXISTS `pe000404db`.`vPecivoSurovina`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vPecivoSurovina` AS SELECT p.*, r.mnozstvo, s.nazov as SurovinaNazov, s.nakupnaCena, s.naSklade FROM vPecivo AS p LEFT JOIN vRecept AS r ON r.pecivo = p.id LEFT JOIN vSurovina AS s ON s.id = r.surovina;


-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavkaPecivo`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavkaPecivo` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavkaPecivo`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavkaPecivo` AS SELECT o.*, z.mnozstvo, p.nazov, p.popis, p.cena FROM vObjednavka AS o LEFT JOIN vZoznam AS z ON z.objednavka = o.id LEFT JOIN vPecivoFull AS p ON p.id = z.pecivo ORDER BY p.nazov ASC;

-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavkaAdresa`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavkaAdresa` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavkaAdresa`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavkaAdresa` AS SELECT o.id, o.cislo, o.termin, o.suma, o.vybavene, o.vodic, o.podal, a.id AS adresaId, a.oblast, a.clen, a.adresa FROM vObjednavka AS o LEFT JOIN vAdresaFull AS a ON o.adresa = a.id ORDER BY o.cislo DESC;


-- -----------------------------------------------------
-- View `pe000404db`.`vObjednavkaAdresaClen`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `pe000404db`.`vObjednavkaAdresaClen` ;
DROP TABLE IF EXISTS `pe000404db`.`vObjednavkaAdresaClen`;
USE `pe000404db`;
CREATE  OR REPLACE VIEW `vObjednavkaAdresaClen` AS SELECT o.id, o.cislo, o.termin, o.suma, o.vybavene, o.vodic, o.podal, a.id AS adresaId, a.oblast, a.clen, a.adresa, c.meno, c.priezvisko FROM vObjednavka AS o LEFT JOIN vAdresaFull AS a ON o.adresa = a.id LEFT JOIN vClenFull AS c ON a.clen = c.id ORDER BY o.cislo DESC;

USE `pe000404db`;

DELIMITER $$

USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Stav_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Stav_BEFORE_DELETE` BEFORE DELETE ON `Stav` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Clen_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Clen_BEFORE_INSERT` BEFORE INSERT ON `Clen` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Clen_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Clen_AFTER_INSERT` AFTER INSERT ON `Clen` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Clen_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Clen_BEFORE_DELETE` BEFORE DELETE ON `Clen` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`OblastRozvozu_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`OblastRozvozu_BEFORE_INSERT` BEFORE INSERT ON `OblastRozvozu` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`OblastRozvozu_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`OblastRozvozu_AFTER_INSERT` AFTER INSERT ON `OblastRozvozu` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`OblastRozvozu_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`OblastRozvozu_BEFORE_DELETE` BEFORE DELETE ON `OblastRozvozu` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Adresa_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Adresa_BEFORE_INSERT` BEFORE INSERT ON `Adresa` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Adresa_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Adresa_AFTER_INSERT` AFTER INSERT ON `Adresa` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`) VALUES (NEW.`ID`);
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Adresa_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Adresa_BEFORE_DELETE` BEFORE DELETE ON `Adresa` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Objednavka_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Objednavka_BEFORE_INSERT` BEFORE INSERT ON `Objednavka` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Objednavka_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Objednavka_AFTER_INSERT` AFTER INSERT ON `Objednavka` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Objednavka_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Objednavka_BEFORE_DELETE` BEFORE DELETE ON `Objednavka` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Pecivo_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Pecivo_BEFORE_INSERT` BEFORE INSERT ON `Pecivo` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Pecivo_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Pecivo_AFTER_INSERT` AFTER INSERT ON `Pecivo` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Pecivo_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Pecivo_BEFORE_DELETE` BEFORE DELETE ON `Pecivo` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Zoznam_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Zoznam_BEFORE_INSERT` BEFORE INSERT ON `Zoznam` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Zoznam_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Zoznam_AFTER_INSERT` AFTER INSERT ON `Zoznam` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Zoznam_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Zoznam_BEFORE_DELETE` BEFORE DELETE ON `Zoznam` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Surovina_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Surovina_BEFORE_INSERT` BEFORE INSERT ON `Surovina` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Surovina_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Surovina_AFTER_INSERT` AFTER INSERT ON `Surovina` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Surovina_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Surovina_BEFORE_DELETE` BEFORE DELETE ON `Surovina` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Recept_BEFORE_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Recept_BEFORE_INSERT` BEFORE INSERT ON `Recept` FOR EACH ROW
BEGIN
  SET new.id := (SELECT UUID());
END$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Recept_AFTER_INSERT` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Recept_AFTER_INSERT` AFTER INSERT ON `Recept` FOR EACH ROW
BEGIN
	INSERT INTO Stav(`ID`, `created`) VALUES (NEW.`ID`, CURRENT_TIMESTAMP());
END;$$


USE `pe000404db`$$
DROP TRIGGER IF EXISTS `pe000404db`.`Recept_BEFORE_DELETE` $$
USE `pe000404db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `pe000404db`.`Recept_BEFORE_DELETE` BEFORE DELETE ON `Recept` FOR EACH ROW
BEGIN
    call do_not_delete();
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
