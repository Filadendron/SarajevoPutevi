-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 02:58 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saputevibaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE IF NOT EXISTS `komentari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_novosti` int(11) NOT NULL,
  `autor` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_novosti` (`id_novosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `id_novosti`, `autor`, `tekst`) VALUES
(1, 1, 'Filadendron', 'ne valja novost'),
(2, 1, 'Hajvan', 'Dobra novost'),
(4, 1, 'konjina', 'bla bla bla'),
(5, 1, 'admin', 'novi komentar'),
(6, 1, 'admin', 'Test komentara sdfsdfsdsfsdfsdf'),
(7, 1, 'admin', 'test test test'),
(8, 1, 'admin', 'asdasfasfasfasfasfasfasf'),
(10, 2, 'ikameni', 'blabla');

-- --------------------------------------------------------

--
-- Table structure for table `komentarikomentara`
--

CREATE TABLE IF NOT EXISTS `komentarikomentara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_komentara` int(11) NOT NULL,
  `autor` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_komentara` (`id_komentara`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `komentarikomentara`
--

INSERT INTO `komentarikomentara` (`id`, `id_komentara`, `autor`, `tekst`) VALUES
(1, 1, 'halil', 'odgovor na komentar'),
(2, 1, 'mujo', 'odgovor na komentar 2\r\n'),
(3, 2, 'admin', 'ma ne valja novost'),
(4, 2, 'admin', 'ma ne valja novost'),
(5, 2, 'admin', 'ma ne valja novost'),
(6, 7, 'admin', 'test komentara komentara'),
(7, 1, 'admin', 'evo odgovor'),
(8, 1, 'malina', 'nja nja nja'),
(9, 1, 'admin', 'jahsfjasgfahsjfg');

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `datumobjave` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `autor_id` int(11) NOT NULL,
  `dvoslovnikod` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `telefonskibroj` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `otvorena` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor_id` (`autor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`id`, `naslov`, `tekst`, `datumobjave`, `autor_id`, `dvoslovnikod`, `telefonskibroj`, `otvorena`) VALUES
(1, 'B naslov', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-05-25T00:00:00', 2, 'ba', '+3876145544', '1'),
(2, 'C naslov', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-05-25T13:46:30', 2, 'ba', '+38761889885', '1'),
(3, 'A naslov', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-05-25T13:47:21', 1, 'ba', '+38762449885', '1'),
(4, 'asfasfasf', 'afasfasfa', '2016-05-25T15:53:05', 1, 'BA', '+387325245', '0'),
(6, 'Nova novost', 'asfasjoaxiocasofhouachojxbocaus', '2016-05-25T17:56:48', 1, 'BA', '+3874895214', '0'),
(7, 'HA HA', 'hahahahahahahahaha', '2016-05-27T02:10:01', 15, 'BA', '+3874345435', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'ikameni', 'a5993b4dbb5390dff648c6187243e44d', 'korisnik'),
(4, 'malina', '0ff68179820a88f04344b8962fed3d2b', 'korisnik'),
(15, 'konjina', '3ab8001f397ccf09fef9beffdd3c448e', 'korisnik');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentari`
--
ALTER TABLE `komentari`
  ADD CONSTRAINT `komentari_ibfk_1` FOREIGN KEY (`id_novosti`) REFERENCES `novosti` (`id`);

--
-- Constraints for table `komentarikomentara`
--
ALTER TABLE `komentarikomentara`
  ADD CONSTRAINT `komentarikomentara_ibfk_1` FOREIGN KEY (`id_komentara`) REFERENCES `komentari` (`id`);

--
-- Constraints for table `novosti`
--
ALTER TABLE `novosti`
  ADD CONSTRAINT `novosti_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
