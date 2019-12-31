-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 31. Dez 2019 um 20:55
-- Server-Version: 10.3.17-MariaDB-0+deb10u1
-- PHP-Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `passwort+zeit`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitszeit`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `arbeitszeit` (
  `Datum` date NOT NULL,
  `AnzahlStunden` double NOT NULL,
  `Anfang` time NOT NULL,
  `Ende` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `arbeitszeit`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `benutzer` (
  `Nutzernummer` int(11) NOT NULL,
  `Benutzername` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `Passwort` varchar(255) COLLATE utf8_german2_ci NOT NULL,
  `permissionlvl` int(11) NOT NULL,
  `SessionID` text COLLATE utf8_german2_ci NOT NULL,
  `FehlgeschlageneVersuche` int(11) NOT NULL,
  `EinCode` varchar(255) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `benutzer`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bot`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `bot` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `bot`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `crsfef`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `crsfef` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL,
  `Token` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `crsfef`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `crsffe`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `crsffe` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL,
  `Token` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `crsffe`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `downupdir`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `downupdir` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL,
  `Verzeichnis_Datei` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `downupdir`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fehlerhafteingabe`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `fehlerhafteingabe` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL,
  `Eingabe` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `fehlerhafteingabe`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginer`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `loginer` (
  `id` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `loginer`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginfe`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `loginfe` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `loginfe`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `passwoerter`
--
-- Erstellt am: 26. Dez 2019 um 16:50
--

CREATE TABLE `passwoerter` (
  `ID` int(11) NOT NULL,
  `Seite` varchar(40) COLLATE utf8_german2_ci NOT NULL,
  `PW` varchar(40) COLLATE utf8_german2_ci NOT NULL,
  `Benutzer` varchar(40) COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `passwoerter`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registerer`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `registerer` (
  `id` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IP-Adresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `registerer`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registerfe`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `registerfe` (
  `id` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `registerfe`:
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeitspam`
--
-- Erstellt am: 16. Dez 2019 um 22:12
--

CREATE TABLE `zeitspam` (
  `ID` int(11) NOT NULL,
  `DatumZeit` datetime NOT NULL,
  `Benutzer` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `IPAdresse` varchar(25) COLLATE utf8_german2_ci NOT NULL,
  `Grund` longtext COLLATE utf8_german2_ci NOT NULL,
  `Eingabe` longtext COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- RELATIONEN DER TABELLE `zeitspam`:
--

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `arbeitszeit`
--
ALTER TABLE `arbeitszeit`
  ADD UNIQUE KEY `Datum` (`Datum`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`Nutzernummer`),
  ADD UNIQUE KEY `Nutzernummer` (`Nutzernummer`),
  ADD UNIQUE KEY `Benutzername` (`Benutzername`),
  ADD UNIQUE KEY `SessionID` (`SessionID`(32));

--
-- Indizes für die Tabelle `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `crsfef`
--
ALTER TABLE `crsfef`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `crsffe`
--
ALTER TABLE `crsffe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `downupdir`
--
ALTER TABLE `downupdir`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `fehlerhafteingabe`
--
ALTER TABLE `fehlerhafteingabe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `loginer`
--
ALTER TABLE `loginer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `loginfe`
--
ALTER TABLE `loginfe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `passwoerter`
--
ALTER TABLE `passwoerter`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `registerer`
--
ALTER TABLE `registerer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `registerfe`
--
ALTER TABLE `registerfe`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zeitspam`
--
ALTER TABLE `zeitspam`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `Nutzernummer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bot`
--
ALTER TABLE `bot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `crsfef`
--
ALTER TABLE `crsfef`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `crsffe`
--
ALTER TABLE `crsffe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `downupdir`
--
ALTER TABLE `downupdir`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `fehlerhafteingabe`
--
ALTER TABLE `fehlerhafteingabe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `loginer`
--
ALTER TABLE `loginer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `loginfe`
--
ALTER TABLE `loginfe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `passwoerter`
--
ALTER TABLE `passwoerter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `registerer`
--
ALTER TABLE `registerer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `registerfe`
--
ALTER TABLE `registerfe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zeitspam`
--
ALTER TABLE `zeitspam`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


--
-- Metadaten
--
USE `phpmyadmin`;

--
-- Metadaten für Tabelle arbeitszeit
--

--
-- Metadaten für Tabelle benutzer
--

--
-- Metadaten für Tabelle bot
--

--
-- Metadaten für Tabelle crsfef
--

--
-- Metadaten für Tabelle crsffe
--

--
-- Metadaten für Tabelle downupdir
--

--
-- Metadaten für Tabelle fehlerhafteingabe
--

--
-- Metadaten für Tabelle loginer
--

--
-- Metadaten für Tabelle loginfe
--

--
-- Metadaten für Tabelle passwoerter
--

--
-- Metadaten für Tabelle registerer
--

--
-- Metadaten für Tabelle registerfe
--

--
-- Metadaten für Tabelle zeitspam
--

--
-- Metadaten für Datenbank passwort+zeit
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
