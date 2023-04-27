-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Kwi 2023, 15:50
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `logowanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id` int(255) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Cena` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Zdjecie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Ilosc` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id`, `Nazwa`, `Cena`, `Zdjecie`, `Ilosc`) VALUES
(59, 'burger', '12', 'food-6.png', '1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `id` int(255) NOT NULL,
  `Nazwa` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Cena` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Zdjecie` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkt`
--

INSERT INTO `produkt` (`id`, `Nazwa`, `Cena`, `Zdjecie`) VALUES
(1, 'burger', '12', 'food-6.png'),
(4, 'frytki', '11', 'food-4.png'),
(6, 'kanapka', '14', 'food-3.png'),
(13, 'tost', '7', 'food-4.png'),
(32, 'Kebab', '18', 'food-6.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rejestr`
--

CREATE TABLE `rejestr` (
  `id` int(11) NOT NULL,
  `User` text COLLATE utf8_polish_ci NOT NULL,
  `Pass` text COLLATE utf8_polish_ci NOT NULL,
  `Email` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rejestr`
--

INSERT INTO `rejestr` (`id`, `User`, `Pass`, `Email`) VALUES
(1, 'Admin', '$2y$10$M0UZAzHs4vDXrKziaKcQqO6/fTvOmj83Iy3NQaQcYtp4oGQo4YRX.', 'admin@wp.pl'),
(2, 'Marcin', '$2y$10$1lIS1AS20IlzLnl7InUhyezkrQ5DQM1gaOLmX8jxGC1Qb1BmEnz/y', 'marcin@wp.pl'),
(7, 'Test', '$2y$10$8j6Q83joZe2fsT50ZRg2P.LLheGp5esk2xd7sgtZ67bm4KN7Msttq', 'test@wp.pl'),
(11, 'User', '$2y$10$pJ//BW/HghWK7e3WojJOyOil0IXNJpeN4uzDT.IWTJCim3Ehs3IiK', 'user@wp.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(255) NOT NULL,
  `Imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `NrTel` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Miasto` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Ulica` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Mieszkanie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Produkty` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `Cena` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `Imie`, `Nazwisko`, `NrTel`, `Email`, `Miasto`, `Ulica`, `Mieszkanie`, `Produkty`, `Cena`) VALUES
(1, 'Piotr', 'Nowak', '123456789', 'test@wp.pl', 'Wroclaw', 'Kwiatkowa', '4', 'burger (1) , frytki (1) ', '23'),
(9, 'Piotr', 'Nowak2', '123456789', 'test@wp.pl', 'Wroclaw', 'Tulipanowa', '5', 'burger (4) ', '48'),
(40, 'Marcin', 'Nowak', '123123', 'aaaa@wp.pl', 'Wroclaw', 'aa', '112', 'burger (1) ', '12');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rejestr`
--
ALTER TABLE `rejestr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT dla tabeli `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT dla tabeli `rejestr`
--
ALTER TABLE `rejestr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
