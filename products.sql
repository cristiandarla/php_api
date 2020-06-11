-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iun. 11, 2020 la 05:26 PM
-- Versiune server: 10.4.11-MariaDB
-- Versiune PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `2ckeckout`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `products`
--

CREATE TABLE `products` (
  `ID` int(6) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PRICE` float NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT current_timestamp(),
  `UPDATED_DATE` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `products`
--

INSERT INTO `products` (`ID`, `NAME`, `PRICE`, `CATEGORY`, `CREATED_DATE`, `UPDATED_DATE`) VALUES
(1, 'water', 1.99, 'drink', '2020-06-10 16:21:49', '2020-06-10 19:02:04'),
(2, 'beer', 5, 'drink', '2020-06-10 16:23:33', '2020-06-10 16:23:33'),
(3, 'almonds', 7.2, 'food', '2020-06-10 16:23:55', '2020-06-10 16:23:55'),
(4, 'ball', 29.9, 'sport object', '2020-06-10 16:24:31', '2020-06-10 16:24:31'),
(10, 'soda', 5, 'drink', '2020-06-11 16:00:00', '2020-06-11 16:00:00');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
