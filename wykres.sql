-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Cze 2022, 08:38
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wykres`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wykres`
--

CREATE TABLE `wykres` (
  `dzien_miesiaca` int(2) NOT NULL,
  `temperatura` decimal(4,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wykres`
--

INSERT INTO `wykres` (`dzien_miesiaca`, `temperatura`) VALUES
(1, '36.1'),
(2, '36.3'),
(3, '36.3'),
(4, '36.4'),
(5, '36.2'),
(6, '0.0'),
(7, '36.4'),
(8, '36.7'),
(9, '36.8'),
(10, '36.9'),
(11, '37.0'),
(12, '36.8'),
(13, '36.7'),
(14, '36.4'),
(15, '36.5'),
(16, '36.1'),
(17, '37.1'),
(18, '36.7'),
(19, '36.7'),
(20, '36.8'),
(21, '36.9'),
(22, '37.0'),
(23, '36.8'),
(24, '36.7'),
(25, '36.4'),
(26, NULL),
(27, '36.1'),
(28, '37.1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wymiary`
--

CREATE TABLE `wymiary` (
  `id` int(11) NOT NULL,
  `szerokosc` int(11) NOT NULL,
  `wysokosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wymiary`
--

INSERT INTO `wymiary` (`id`, `szerokosc`, `wysokosc`) VALUES
(1, 1000, 400);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `wykres`
--
ALTER TABLE `wykres`
  ADD PRIMARY KEY (`dzien_miesiaca`);

--
-- Indeksy dla tabeli `wymiary`
--
ALTER TABLE `wymiary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `wykres`
--
ALTER TABLE `wykres`
  MODIFY `dzien_miesiaca` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `wymiary`
--
ALTER TABLE `wymiary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
