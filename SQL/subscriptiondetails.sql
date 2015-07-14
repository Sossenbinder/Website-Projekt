-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Jul 2015 um 07:52
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
  `Nachname` varchar(200) NOT NULL,
  `VerificationCode` varchar(100) NOT NULL,
  `Verifiziert` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `subscriptiondetails`
--

INSERT INTO `subscriptiondetails` (`Email`, `Anrede`, `Vorname`, `Nachname`, `VerificationCode`, `Verifiziert`) VALUES
('s@d.f', 'Herr', 'd', 'erw', '749c9ff9401f7376f67506231f5f2b89', 1),
('test@d.te', 'Herr', 'test', 'mist', 'ac0b35abfbbbfb0af2d2017876db7555', 1),
('c@d.e', 'Herr', 'd', 'e', 'c0e50eae1d5319789166283e1f36e6a5', 1),
('test@testmail.de', 'Herr', 'Dimi', 'test', 'd2dc7cf890c9b426f748652541f708cd', 1),
('TEst@testmail.de', 'Herr', 'Stefan', 'Test', '585ea12e36419fe9721336585c6c5fd9', 1),
('Stefan.Daniel.Schranz@t-online.de', 'Herr', 'Stefan', 'Schranz', '50cd037cd71ca5c912862d7f0cd8d805', 1),
('testman@test.de', 'Herr', 'Testman', 'TestNachnam', '41a61e1368d9d4400d83184d26d582cd', 1),
('TEst@testmail.de', 'Herr', 'Stefan', 'Schranz', '6933d4409d976b3793bc4dc657a5b9da', 1),
('test@testmail.de', 'Herr', 'Stefan', 'Schranz', '16cb1c107daddfb13addbc41c8c9d485', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
