-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 13 déc. 2024 à 21:37
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hospitalmanagement`
--

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentid` int(10) NOT NULL,
  `appointmenttype` varchar(25) NOT NULL,
  `patientid` int(10) NOT NULL,
  `roomid` int(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `appointmentdate` date NOT NULL,
  `appointmenttime` time NOT NULL,
  `doctorid` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `app_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`appointmentid`, `appointmenttype`, `patientid`, `roomid`, `departmentid`, `appointmentdate`, `appointmenttime`, `doctorid`, `status`, `app_reason`) VALUES
(1, '', 1, 0, 1, '2019-06-17', '03:00:00', 1, 'Approved', 'Fever'),
(2, '', 3, 0, 2, '2021-06-25', '09:22:00', 2, 'Approved', 'test pour mohsine'),
(4, '', 5, 0, 4, '2021-06-24', '14:28:00', 5, 'Approved', 'demo demo demo'),
(5, '', 6, 0, 7, '2021-06-24', '11:18:00', 7, 'Approved', 'Demo Test, Demo Reason!!'),
(6, '', 9, 0, 3, '2454-05-24', '12:24:00', 0, 'Approved', 'fffffffffffff'),
(7, '', 0, 0, 0, '0000-00-00', '00:00:00', 0, '', ''),
(8, '', 0, 0, 0, '0000-00-00', '00:00:00', 0, '', ''),
(9, '', 0, 0, 0, '0000-00-00', '00:00:00', 0, '', ''),
(10, '', 0, 0, 0, '0000-00-00', '00:00:00', 0, '', ''),
(11, '', 3, 0, 1, '2024-10-09', '10:30:00', 1, 'Approved', 'consultation'),
(12, '', 1, 0, 7, '2024-10-10', '10:10:00', 7, 'Approved', 'consultatoin '),
(13, '', 10, 0, 8, '2025-12-12', '12:12:00', 2, 'Approved', 'consultation '),
(14, '', 1, 0, 4, '2024-11-30', '10:10:00', 5, 'Approved', ''),
(15, '', 11, 0, 1, '2024-12-07', '10:10:00', 1, 'Approved', 'consultation'),
(16, '', 12, 0, 1, '2024-12-28', '10:10:00', 2, 'Approved', 'alae consultation'),
(17, '', 1, 0, 1, '2024-12-08', '11:10:00', 1, 'Active', 'consultation '),
(18, '', 13, 0, 1, '2024-12-11', '21:33:00', 7, 'Approved', 'CONSULTATION '),
(19, '', 14, 0, 1, '2024-12-12', '12:00:00', 7, 'Approved', 'CONSULTATION '),
(20, '', 15, 0, 1, '2024-12-12', '12:21:00', 7, 'Approved', 'CONSULTATION '),
(21, 'ONLINE', 16, 0, 1, '2024-12-13', '15:23:00', 9, 'Pending', 'consultation');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
