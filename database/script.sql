-- MySQL Script generated by MySQL Workbench
-- Tue Apr 10 22:18:58 2018
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`atendente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendente` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cliente` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME_CLIENTE` VARCHAR(45) NOT NULL,
  `EMAIL_CLIENTE` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`pergunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pergunta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendimento` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  `ID_ATENDENTE` INT(11) NOT NULL,
  `ID_CLIENTE` INT(11) NOT NULL,
  `ID_PERGUNTA` INT(11) NOT NULL,
  `DURACAO_ATENDIMENTO` INT(11) NULL DEFAULT NULL,
  `QTD_TENTATIVA` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_ATENDIMENTO_ATENDENTE_idx` (`ID_ATENDENTE` ASC),
  INDEX `fk_ATENDIMENTO_CLIENTE1_idx` (`ID_CLIENTE` ASC),
  INDEX `fk_ATENDIMENTO_PERGUNTA1_idx` (`ID_PERGUNTA` ASC),
  CONSTRAINT `fk_ATENDIMENTO_ATENDENTE`
    FOREIGN KEY (`ID_ATENDENTE`)
    REFERENCES `mydb`.`atendente` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ATENDIMENTO_CLIENTE1`
    FOREIGN KEY (`ID_CLIENTE`)
    REFERENCES `mydb`.`cliente` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ATENDIMENTO_PERGUNTA1`
    FOREIGN KEY (`ID_PERGUNTA`)
    REFERENCES `mydb`.`pergunta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`resposta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`resposta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` TEXT NULL DEFAULT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`atendimento_has_resposta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendimento_has_resposta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_ATENDIMENTO` INT(11) NOT NULL,
  `ID_RESPOSTA` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_ATENDIMENTO_has_RESPOSTA_RESPOSTA1_idx` (`ID_RESPOSTA` ASC),
  INDEX `fk_ATENDIMENTO_has_RESPOSTA_ATENDIMENTO1_idx` (`ID_ATENDIMENTO` ASC),
  CONSTRAINT `fk_ATENDIMENTO_has_RESPOSTA_ATENDIMENTO1`
    FOREIGN KEY (`ID_ATENDIMENTO`)
    REFERENCES `mydb`.`atendimento` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ATENDIMENTO_has_RESPOSTA_RESPOSTA1`
    FOREIGN KEY (`ID_RESPOSTA`)
    REFERENCES `mydb`.`resposta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`palavra_chave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`palavra_chave` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `PALAVRA_CHAVE_PRINCIPAL` TINYINT(1) NULL DEFAULT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `NOME` (`NOME` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`palavra_chave_has_resposta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`palavra_chave_has_resposta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_PALAVRA_CHAVE` INT(11) NOT NULL,
  `ID_RESPOSTA` INT(11) NOT NULL,
  `PONT_RESPOSTA` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_PALAVRA-CHAVE_has_RESPOSTA_RESPOSTA1_idx` (`ID_RESPOSTA` ASC),
  INDEX `fk_PALAVRA-CHAVE_has_RESPOSTA_PALAVRA-CHAVE1_idx` (`ID_PALAVRA_CHAVE` ASC),
  CONSTRAINT `fk_PALAVRA-CHAVE_has_RESPOSTA_PALAVRA-CHAVE1`
    FOREIGN KEY (`ID_PALAVRA_CHAVE`)
    REFERENCES `mydb`.`palavra_chave` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PALAVRA-CHAVE_has_RESPOSTA_RESPOSTA1`
    FOREIGN KEY (`ID_RESPOSTA`)
    REFERENCES `mydb`.`resposta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 41
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`pergunta_has_palavra_chave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pergunta_has_palavra_chave` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_PERGUNTA` INT(11) NOT NULL,
  `ID_PALAVRA_CHAVE` INT(11) NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_PERGUNTA_has_PALAVRA-CHAVE_PALAVRA-CHAVE1_idx` (`ID_PALAVRA_CHAVE` ASC),
  INDEX `fk_PERGUNTA_has_PALAVRA-CHAVE_PERGUNTA1_idx` (`ID_PERGUNTA` ASC),
  CONSTRAINT `fk_PERGUNTA_has_PALAVRA-CHAVE_PALAVRA-CHAVE1`
    FOREIGN KEY (`ID_PALAVRA_CHAVE`)
    REFERENCES `mydb`.`palavra_chave` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PERGUNTA_has_PALAVRA-CHAVE_PERGUNTA1`
    FOREIGN KEY (`ID_PERGUNTA`)
    REFERENCES `mydb`.`pergunta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NOT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `mydb`.`pergunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`pergunta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`atendente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendente` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`cliente` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `NOME_CLIENTE` VARCHAR(45) NOT NULL,
  `EMAIL_CLIENTE` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendimento` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` VARCHAR(45) NOT NULL,
  `ATIVO` TINYINT(4) NULL DEFAULT NULL,
  `DATA_ATUALIZACAO` DATETIME NULL DEFAULT NULL,
  `DATA_CRIACAO` DATETIME NULL DEFAULT NULL,
  `ID_ATENDENTE` INT(11) NOT NULL,
  `ID_CLIENTE` INT(11) NOT NULL,
  `ID_PERGUNTA` INT(11) NOT NULL,
  `DURACAO_ATENDIMENTO` INT(11) NULL DEFAULT NULL,
  `QTD_TENTATIVA` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_ATENDIMENTO_ATENDENTE_idx` (`ID_ATENDENTE` ASC),
  INDEX `fk_ATENDIMENTO_CLIENTE1_idx` (`ID_CLIENTE` ASC),
  INDEX `fk_ATENDIMENTO_PERGUNTA1_idx` (`ID_PERGUNTA` ASC),
  CONSTRAINT `fk_ATENDIMENTO_ATENDENTE`
    FOREIGN KEY (`ID_ATENDENTE`)
    REFERENCES `mydb`.`atendente` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ATENDIMENTO_CLIENTE1`
    FOREIGN KEY (`ID_CLIENTE`)
    REFERENCES `mydb`.`cliente` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ATENDIMENTO_PERGUNTA1`
    FOREIGN KEY (`ID_PERGUNTA`)
    REFERENCES `mydb`.`pergunta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`atendimento_has_pergunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`atendimento_has_pergunta` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `ID_PERGUNTA` INT(11) NOT NULL,
  `ID_RESPOSTA` INT(11) NOT NULL,
  INDEX `fk_table1_pergunta1_idx` (`ID_PERGUNTA` ASC),
  INDEX `fk_table1_atendimento1_idx` (`ID_RESPOSTA` ASC),
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_table1_pergunta1`
    FOREIGN KEY (`ID_PERGUNTA`)
    REFERENCES `mydb`.`pergunta` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_atendimento1`
    FOREIGN KEY (`ID_RESPOSTA`)
    REFERENCES `mydb`.`atendimento` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE pergunta_has_resposta (
  ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ID_PERGUNTA INT(11) NULL,
    ID_RESPOSTA INT(11) NULL,
    PONT_RESPOSTA INT(11) NULL DEFAULT '0',
    CONSTRAINT fk_pergunta_has_resposta_1 FOREIGN KEY (ID_PERGUNTA) REFERENCES pergunta(ID),
    CONSTRAINT fk_pergunta_has_resposta_2 FOREIGN KEY (ID_RESPOSTA) REFERENCES resposta(ID)
);

ALTER TABLE pergunta_has_resposta ADD DATA_ATUALIZACAO DATETIME NULL DEFAULT NULL;
ALTER TABLE pergunta_has_resposta ADD DATA_CRIACAO DATETIME NULL DEFAULT NULL;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

insert into `users` (`email`, `name`, `password`, `updated_at`, `created_at`) values ('funcionario@email.com', 'Funcionario', '$2y$10$cf22WIcjgw99j1E1DS16wOgma1ofXdAqPc/XjN/7uyKl8zZx0E84.', '2018-03-24 16:04:24', '2018-03-24 16:04:24');
