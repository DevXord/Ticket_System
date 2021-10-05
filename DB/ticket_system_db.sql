-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Paź 2021, 14:20
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ticket_system_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins_db`
--

CREATE TABLE `admins_db` (
  `ID` int(11) NOT NULL,
  `Name` varchar(24) NOT NULL,
  `Surname` varchar(24) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `Rang_strong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ticket_list`
--

CREATE TABLE `ticket_list` (
  `ID` int(11) NOT NULL,
  `Date_added` varchar(24) NOT NULL,
  `Title` varchar(54) NOT NULL,
  `Author_name` varchar(24) NOT NULL,
  `Author_surname` varchar(24) NOT NULL,
  `Author_email` varchar(24) NOT NULL,
  `Ticket_status` int(11) NOT NULL,
  `Priority` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ticket_themes_db`
--

CREATE TABLE `ticket_themes_db` (
  `ID` int(11) NOT NULL,
  `Author_Email` varchar(30) NOT NULL,
  `Author_Name` varchar(24) NOT NULL,
  `Author_Surame` varchar(24) NOT NULL,
  `Title` varchar(54) NOT NULL,
  `Value` varchar(325) NOT NULL,
  `Date_added` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_db`
--

CREATE TABLE `users_db` (
  `ID` int(11) NOT NULL,
  `Name` varchar(24) NOT NULL,
  `Surname` varchar(24) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `Join_Date` date NOT NULL DEFAULT current_timestamp(),
  `Images_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins_db`
--
ALTER TABLE `admins_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `ticket_list`
--
ALTER TABLE `ticket_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `ticket_themes_db`
--
ALTER TABLE `ticket_themes_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users_db`
--
ALTER TABLE `users_db`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins_db`
--
ALTER TABLE `admins_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ticket_list`
--
ALTER TABLE `ticket_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ticket_themes_db`
--
ALTER TABLE `ticket_themes_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users_db`
--
ALTER TABLE `users_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
