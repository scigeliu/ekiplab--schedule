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
CREATE TABLE IF NOT EXISTS `profile_answers` (
  `id_profile` int(11) NOT NULL,
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

INSERT INTO `profile_answers`( `id_profile`,`id_question`, `id_answer`, `flag_correct`) VALUES 
(1,1,1,0),
(1,3,12,1),
(2,1,2,1);

DROP TABLE IF EXISTS `quest_questions`;
CREATE TABLE IF NOT EXISTS `quest_questions` (
  `id_question` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(512) NOT NULL,
  `question_type` int(11) NOT NULL DEFAULT 1,
  `question_point` int(11) NOT NULL DEFAULT 0,
  `question_coin` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `quest_questions`( `id_question`,`question`, `question_type`, `question_point`, `question_coin`) VALUES 
(1,"The biggest volcano in the world is:",1,3,0),
(2,'In 2008, Speedo launched the LZR Racer suit, a swimsuit made from high-technology swimwear fabric, developed in association with NASA. Since its debut, how many world records have been broken by swimmers wearing the LZR Racer?',1,15,1),
(3,'Cryosat is an ESA satellite that:',1,5,0),
(4,'GOCE’s task is to provide the best information yet on our planet’s:',1,5,2),
(5,"John F. Kennedy Space Center, NASA's space vehicle launch facility and Launch Control Center is located where? ",1,8,0);


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

INSERT INTO `question_answers`( `id_answer`,`id_question`, `answer`, `flag_correct`) VALUES 
(1,1,'Eyjafjallajökull in Iceland',0),
(2,1,'Etna in Sicily',0),
(3,1,'Stromboli in Sicily',1),
(4,1,'Mauna Loa in Hawaii',0),
(5,2,'39',0),
(6,2,'45',0),
(7,2,'58',0),
(8,2,'62',1),
(9,3,'Measures the Earth’s temperature',0),
(10,3,'Studies pollution on Earth',0),
(11,3,'Measures tiny changes in ice thickness',0),
(12,3,'Studies Earth’s gravity field',1),
(13,4,'Atmosphere',0),
(14,4,'Gravity field',0),
(15,4,'Stratosphere',0),
(16,4,'Temperature',1),
(17,5,'Merritt Island, Florida',1),
(18,5,'Alamogordo, New Mexico',0),
(19,5,'Houston, Texas',0),
(20,5,'Roswell, New Mexico',0);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
