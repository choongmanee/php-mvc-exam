SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `redbelt` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `redbelt` ;

-- -----------------------------------------------------
-- Table `redbelt`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `redbelt`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `alias` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `dob` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `redbelt`.`quotes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `redbelt`.`quotes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `author` VARCHAR(45) NULL ,
  `message` TEXT NULL ,
  `postedby` VARCHAR(45) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_quotes_user_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_quotes_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `redbelt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `redbelt`.`favorites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `redbelt`.`favorites` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `quotes_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_favorites_user1_idx` (`user_id` ASC) ,
  INDEX `fk_favorites_quotes1_idx` (`quotes_id` ASC) ,
  CONSTRAINT `fk_favorites_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `redbelt`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favorites_quotes1`
    FOREIGN KEY (`quotes_id` )
    REFERENCES `redbelt`.`quotes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `redbelt` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
