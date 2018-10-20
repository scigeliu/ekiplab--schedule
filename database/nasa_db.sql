-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Ott 20, 2018 alle 14:08
-- Versione del server: 5.7.21
-- Versione PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasa_db`
--
DROP DATABASE IF EXISTS `nasa_db`;
CREATE DATABASE IF NOT EXISTS `nasa_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nasa_db`;

-- --------------------------------------------------------

--
-- Struttura della tabella `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id_profile` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(512) UNIQUE NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `score` int(11) NOT NULL DEFAULT 0,
  `coins` int(11) NOT NULL DEFAULT 0

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `profile`( `username`, `level`, `score`, `coins`) VALUES ('fad',1,10,2);
INSERT INTO `profile`( `username`, `level`, `score`, `coins`) VALUES ('Jack',2,64,10);
INSERT INTO `profile`( `username`, `level`, `score`, `coins`) VALUES ('Leo',1,23,0);
INSERT INTO `profile`( `username`, `level`, `score`, `coins`) VALUES ('Anto198',3,120,15);


DROP TABLE IF EXISTS `profile_answers`;
CREATE TABLE IF NOT EXISTS `question_answers` (
  `id_profile` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_question` varchar(512) NOT NULL,
  `id_answer` varchar(512) NOT NULL DEFAULT 1,
  `flag_correct` tinyint(1) NOT NULL DEFAULT '0',
  FOREIGN KEY (`id_profile`) REFERENCES profile (`id_profile`)
            on delete no action
            on update no action,
  FOREIGN KEY (`id_question`) REFERENCES quest_questions (`id_question`)
            on delete no action
            on update no action,
  FOREIGN KEY (`id_answer`) REFERENCES question_answers (`id_answer`)
            on delete no action
            on update no action
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `quest_questions`;
CREATE TABLE IF NOT EXISTS `quest_questions` (
  `id_question` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(512) NOT NULL,
  `question_type` int(11) NOT NULL DEFAULT 1,
  `question_point` int(11) NOT NULL DEFAULT 0,
  `question_coin` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `question_answers`;
CREATE TABLE IF NOT EXISTS `question_answers` (
  `id_answer` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_question` varchar(512) NOT NULL,
  `answer` varchar(512) NOT NULL DEFAULT 1,
  `flag_correct` tinyint(1) NOT NULL DEFAULT '0',
  FOREIGN KEY (`id_question`) REFERENCES quest_questions (`id_question`)
            on delete no action
            on update no action  
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
