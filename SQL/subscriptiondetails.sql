-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Jun 2015 um 08:36
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `newsletterdata`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subscriptiondetails`
--

CREATE TABLE IF NOT EXISTS `subscriptiondetails` (
  `Email` varchar(200) NOT NULL,
  `Anrede` varchar(10) NOT NULL,
  `Vorname` varchar(200) NOT NULL,
  `Nachname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `subscriptiondetails`
--

INSERT INTO `subscriptiondetails` (`Email`, `Anrede`, `Vorname`, `Nachname`) VALUES
('Stefan.Daniel.Schranz@t-online.de', 'Herr', 'Stefan', 'Schranz'),
('Stefan.Daniel.Schranz@t-online.de', 'Herr', 'Stefan', 'Schranz');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
