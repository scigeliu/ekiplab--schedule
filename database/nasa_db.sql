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
-- DROP DATABASE IF EXISTS `nasa_db`;
-- CREATE DATABASE IF NOT EXISTS `nasa_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ekiplab_nasa`;

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

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `coins` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `category` varchar(512) NOT NULL,
  `image` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;		

INSERT INTO `product`( `id_product`,`coins`, `title`, `category`,`image`) VALUES 
(1,150,'NASA Meatball T-Shirt','apparel','https://cdn.shopify.com/s/files/1/2120/7043/products/white-meatball_grande.jpg?v=1530042863'),
(2,230,'Retro NASA T-Shirt','apparel','https://cdn.shopify.com/s/files/1/2120/7043/products/retro-cardinal-red_bd9dacac-f8be-40d8-a29b-6fbe23a04e89_grande.jpg?v=1533758452'),
(3,200,"Women's Blue Retro NASA T-Shirt",'apparel','https://cdn.shopify.com/s/files/1/2120/7043/products/womens-retro-blue_grande.jpg?v=1504713269'),
(4,280,'Spaced Out Tie','accessories','https://cdn.shopify.com/s/files/1/2120/7043/products/star-tie_grande.jpg?v=1508252060'),
(5,280,'Spacewalk Tie','accessories','https://cdn.shopify.com/s/files/1/2120/7043/products/eva-tie_grande.jpg?v=1508251800'),
(6,2100,'Orion Spacecraft 1/48 Scale Model','collectibles','https://cdn.shopify.com/s/files/1/2120/7043/products/orion-model_grande.jpg?v=1504638310'),
(7,2600,'3 Shuttle Collection 1/200 Model','collectibles','https://cdn.shopify.com/s/files/1/2120/7043/products/3-shuttle-model_grande.jpg?v=1504712789'),
(8,2200,'B747 With Shuttle 1/200 Model','collectibles','https://cdn.shopify.com/s/files/1/2120/7043/products/side-view-747-with-orbiter_grande.jpg?v=1504629379'),
(9,2600,'Shuttle Orbiter with Cargo Doors','collectibles','https://cdn.shopify.com/s/files/1/2120/7043/products/orbiter-with-cargo-doors_grande.jpg?v=1508356299'),
(10,180,'Hidden Figures','bookstore','https://cdn.shopify.com/s/files/1/2120/7043/products/hidden-figures_grande.jpg?v=1504711403'),
(11,300,'Apollo 8 by Jeffrey Kluger','bookstore','https://cdn.shopify.com/s/files/1/2120/7043/products/apollo-8-book_grande.jpg?v=1508357628'),
(12,230,'Jazz of Physics','bookstore','https://cdn.shopify.com/s/files/1/2120/7043/products/jazz-of-physics_grande.jpg?v=1507307069'),
(13,50,'Astronaut Ice Cream Sandwich','space food','https://cdn.shopify.com/s/files/1/2120/7043/products/ice-cream-sandwhich_grande.jpg?v=1504115635'),
(14,50,'Astronaut Strawberries','space food','https://cdn.shopify.com/s/files/1/2120/7043/products/astronaut-strawberries_grande.jpg?v=1504116285');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
