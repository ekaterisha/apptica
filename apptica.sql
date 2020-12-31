-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 31 2020 г., 20:22
-- Версия сервера: 5.5.62
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `apptica`
--

-- --------------------------------------------------------

--
-- Структура таблицы `prepared_data`
--

CREATE TABLE `prepared_data` (
  `date` date NOT NULL,
  `category` int(255) NOT NULL,
  `position` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prepared_data`
--

INSERT INTO `prepared_data` (`date`, `category`, `position`) VALUES
('2020-12-20', 2, 1),
('2020-12-20', 23, 1),
('2020-12-20', 134, 2),
('2020-12-21', 2, 1),
('2020-12-21', 23, 1),
('2020-12-21', 134, 2),
('2020-12-22', 2, 1),
('2020-12-22', 23, 1),
('2020-12-22', 134, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `prepared_data`
--
ALTER TABLE `prepared_data`
  ADD UNIQUE KEY `udx_date` (`date`,`category`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
