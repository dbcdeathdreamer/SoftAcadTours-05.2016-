-- MySQL Script generated by MySQL Workbench
-- 05/09/16 21:02:04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema softacad
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `softacad` ;

-- -----------------------------------------------------
-- Schema softacad
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `softacad` DEFAULT CHARACTER SET utf8 ;
USE `softacad` ;

-- -----------------------------------------------------
-- Table `softacad`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`users` ;

CREATE TABLE IF NOT EXISTS `softacad`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NULL,
  `password` VARCHAR(50) NULL,
  `email` VARCHAR(50) NULL,
  `description` MEDIUMTEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `softacad`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`categories` ;

CREATE TABLE IF NOT EXISTS `softacad`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `softacad`.`tours`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`tours` ;

CREATE TABLE IF NOT EXISTS `softacad`.`tours` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `description` TEXT(5000) NULL,
  `image` VARCHAR(255) NULL,
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `softacad`.`blog`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`blog` ;

CREATE TABLE IF NOT EXISTS `softacad`.`blog` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) NULL,
  `description` TEXT(20000) NULL,
  `name` VARCHAR(255) NULL,
  `created_at` DATETIME NULL,
  `user_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `softacad`.`blog_images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`blog_images` ;

CREATE TABLE IF NOT EXISTS `softacad`.`blog_images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `blog_post_id` INT(10) UNSIGNED NOT NULL,
  `image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `softacad`.`tours_images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `softacad`.`tours_images` ;

CREATE TABLE IF NOT EXISTS `softacad`.`tours_images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tours_id` INT(10) UNSIGNED NOT NULL,
  `image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `softacad`.`clients` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NULL,
  `password` VARCHAR(50) NULL,
  `email` VARCHAR(50) NULL,
  `description` MEDIUMTEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
