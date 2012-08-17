-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 24. Jun 2012 um 12:36
-- Server Version: 5.1.62
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ts3leih`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leih`
--

CREATE TABLE IF NOT EXISTS `leih` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `port` text NOT NULL,
  `ende` text NOT NULL,
  `userip` text NOT NULL,
  `kill_code` text NOT NULL,
  `verlaengern` text NOT NULL,
  `note_msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `port`
--

CREATE TABLE IF NOT EXISTS `port` (
  `port_an` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `port`
--

INSERT INTO `port` (`port_an`) VALUES
(50008);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `ip` text NOT NULL,
  `port` text NOT NULL,
  `datum` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `userdata`
--
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `admin` text NOT NULL,
  `handy` text NOT NULL,
  `strasse` text NOT NULL,
  `name` text NOT NULL,
  `vorname` text NOT NULL,
  `plz` text NOT NULL,
  `ort` text NOT NULL,
  `lastlogin` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Daten für Tabelle `user`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Tabellenstruktur für Tabelle `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `datum` text NOT NULL,
  `email` text NOT NULL,
  `port` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Daten für Tabelle `backup`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `datum` text NOT NULL,
  `text` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Daten für Tabelle `feedback`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontakt`
--

CREATE TABLE IF NOT EXISTS `kontakt` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `datum` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `kontakt`
--
