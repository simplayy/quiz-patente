-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Nov 01, 2018 alle 01:21
-- Versione del server: 10.1.36-MariaDB
-- Versione PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patente`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `quiz`
--

CREATE TABLE `quiz` (
  `id` int(20) NOT NULL,
  `testo` text NOT NULL,
  `risposta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quiz`
--

INSERT INTO `quiz` (`id`, `testo`, `risposta`) VALUES
(1, 'Il conducente del veicolo da sorpassare ha l\'obbligo di non gareggiare in velocità con il veicolo sorpassante', 'vero'),
(2, 'Il conducente del veicolo da sorpassare ha l\'obbligo di portarsi al centro della carreggiata per evitare sorpassi in scia', 'falso'),
(3, 'La distanza minima di sicurezza se si viaggia a 30 km/h è di circa 9 metri', 'vero'),
(4, 'La distanza minima di sicurezza se si viaggia a 50 km/h deve essere di circa 14 metri', 'vero'),
(5, 'La distanza minima di sicurezza se si viaggia a 50 km/h deve essere di circa 5 metri', 'falso'),
(6, 'La distanza minima di sicurezza se si viaggia a 130 km/h deve essere di circa 20 metri', 'falso'),
(7, 'La distrazione del conducente può essere causata dalla accensione di una sigaretta', 'vero'),
(8, 'La distrazione del conducente non rappresenta un pericolo se si limita a pochi secondi', 'falso');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
