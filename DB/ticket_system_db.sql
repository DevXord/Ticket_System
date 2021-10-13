-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Paź 2021, 16:54
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
  `Email` varchar(30) NOT NULL,
  `Rang_strong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admins_db`
--

INSERT INTO `admins_db` (`ID`, `Email`, `Rang_strong`) VALUES
(1, 'root@root.com', 3),
(2, 'moderator@moderator.com', 1),
(3, 'admin@admin.com', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `banned_db`
--

CREATE TABLE `banned_db` (
  `ID` int(11) NOT NULL,
  `Banned_email` varchar(50) NOT NULL,
  `Banned_name` varchar(24) NOT NULL,
  `Banned_reason` varchar(50) NOT NULL,
  `Banned_date` varchar(30) NOT NULL,
  `Admin_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `edit_db`
--

CREATE TABLE `edit_db` (
  `ID` int(11) NOT NULL,
  `Writter_ID` int(11) NOT NULL,
  `Thema_ID` int(11) NOT NULL,
  `Edit_value` text NOT NULL,
  `Date_edit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message_db`
--

CREATE TABLE `message_db` (
  `ID` int(11) NOT NULL,
  `Writter_ID` int(11) NOT NULL,
  `Thema_ID` int(11) NOT NULL,
  `Date_added` varchar(30) NOT NULL,
  `Value` text NOT NULL,
  `Edit_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ticket_db`
--

CREATE TABLE `ticket_db` (
  `ID` int(11) NOT NULL,
  `Date_added` varchar(30) NOT NULL,
  `Title` varchar(54) NOT NULL,
  `Author_id` int(11) NOT NULL,
  `Author_name` varchar(24) NOT NULL,
  `Author_surname` varchar(24) NOT NULL,
  `Author_email` varchar(30) NOT NULL,
  `Status` int(11) NOT NULL,
  `Priority` int(11) NOT NULL,
  `Value` text NOT NULL
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
  `Images_url` text NOT NULL,
  `Online` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users_db`
--

INSERT INTO `users_db` (`ID`, `Name`, `Surname`, `Email`, `Password`, `Join_Date`, `Images_url`, `Online`) VALUES
(1, 'root', 'root', 'root@root.com', 'xxxxxx', '2021-10-13', '', 0),
(2, 'Moder', 'Moderator', 'moderator@moderator.com', 'xxxxxx', '2021-10-13', '', 0),
(3, 'Admin', 'Admin', 'admin@admin.com', 'xxxxxx', '2021-10-13', '', 0),
(4, 'Jacek', 'Soplica', 'jspolica@gmail.com', 'xxxxxx', '2021-10-13', '', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins_db`
--
ALTER TABLE `admins_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `banned_db`
--
ALTER TABLE `banned_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `edit_db`
--
ALTER TABLE `edit_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `message_db`
--
ALTER TABLE `message_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `ticket_db`
--
ALTER TABLE `ticket_db`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `banned_db`
--
ALTER TABLE `banned_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `edit_db`
--
ALTER TABLE `edit_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `message_db`
--
ALTER TABLE `message_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ticket_db`
--
ALTER TABLE `ticket_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users_db`
--
ALTER TABLE `users_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
