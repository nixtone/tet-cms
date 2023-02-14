-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 05 2023 г., 02:05
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tetcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE `block` (
  `ID` int NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (`ID`, `NAME`, `CREATED_AT`) VALUES
(1, 'Текстовая страница', '2022-12-21 00:52:11'),
(2, 'Каталог', '2022-12-28 20:41:39');

-- --------------------------------------------------------

--
-- Структура таблицы `block1`
--

CREATE TABLE `block1` (
  `ID` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `SORT` int NOT NULL,
  `ACTIVE` int NOT NULL DEFAULT '1',
  `NAME` varchar(255) NOT NULL,
  `TEXT` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `block1`
--

INSERT INTO `block1` (`ID`, `SECTION_BLOCK`, `SORT`, `ACTIVE`, `NAME`, `TEXT`) VALUES
(1, 1, 10, 1, 'Первая тестовая запись', 'Тестовый текст 1');

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `ID` int NOT NULL,
  `TYPE` varchar(30) NOT NULL,
  `EXTENSION` varchar(30) NOT NULL,
  `SIZE` int NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `file`
--

INSERT INTO `file` (`ID`, `TYPE`, `EXTENSION`, `SIZE`, `CREATED_AT`) VALUES
(1, 'image/jpeg', 'jpg', 64219, '2023-02-01 17:43:29');

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
  `ID` int NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PARENT_ID` int NOT NULL DEFAULT '0',
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`ID`, `NAME`, `PARENT_ID`, `CREATED_AT`) VALUES
(1, 'Главная', 0, '2022-12-21 00:52:01'),
(2, '404', 0, '2022-12-27 22:27:01'),
(3, 'Каталог', 0, '2022-12-28 01:07:39'),
(4, 'Контакты', 0, '2022-12-30 15:53:05');

-- --------------------------------------------------------

--
-- Структура таблицы `section_block`
--

CREATE TABLE `section_block` (
  `ID` int NOT NULL,
  `SECTION_ID` int NOT NULL,
  `BLOCK_ID` int NOT NULL,
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `section_block`
--

INSERT INTO `section_block` (`ID`, `SECTION_ID`, `BLOCK_ID`, `CREATED_AT`) VALUES
(1, 1, 1, '2022-12-21 00:52:28'),
(2, 2, 1, '2022-12-27 22:27:15'),
(3, 1, 2, '2022-12-28 20:41:56');

-- --------------------------------------------------------

--
-- Структура таблицы `url`
--

CREATE TABLE `url` (
  `ID` int NOT NULL,
  `URL` varchar(300) NOT NULL,
  `SECTION` int NOT NULL DEFAULT '0',
  `ELEMENT` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`ID`, `URL`, `SECTION`, `ELEMENT`) VALUES
(1, '/katalog/elektro/lampochka-svetit', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `LOGIN` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `EMAIL` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `TOKEN` varchar(255) NOT NULL,
  `PERMISSION` int NOT NULL DEFAULT '1',
  `ACTIVE` int NOT NULL DEFAULT '1',
  `CREATED_AT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `LOGIN`, `EMAIL`, `PASSWORD`, `TOKEN`, `PERMISSION`, `ACTIVE`, `CREATED_AT`) VALUES
(1, 'test1', '@', '$argon2i$v=19$m=65536,t=4,p=1$SlZSR05xTVk4cXkxM3dmYg$HBzqEc8Uwa1Da6LHReSdYOKx+qvYLPyVP6Gw85ZoDVQ', '$argon2i$v=19$m=65536,t=4,p=1$UFV4THNYNHpFckFmZjFneQ$f2bs0a9gcHI3utiuYLYLPClcuAHi6EWITLcVEgAn+ew', 3, 1, '2022-12-30 21:47:27'),
(2, 'test2', NULL, '$argon2i$v=19$m=65536,t=4,p=1$QU1NL1Q0TFRoeHhRTXBTcg$kh/KcgBw1zsn8EmzvjYM2yxcA2h2gou/lfYH2WbSksA', '$argon2i$v=19$m=65536,t=4,p=1$ektaclRsSEYwbktkUm0vdA$p+7dZR38o5U8P4rcbuB7Be39eTdRQRzYbIwoAqnNC8M', 2, 1, '2023-02-01 23:39:05'),
(3, 'test3', NULL, '$argon2i$v=19$m=65536,t=4,p=1$RVUxRGRjWjZFQ2QuZlRvQQ$YCsDM0ykLSviBgu9gqYpcCXGTNsE5HMZWYAvTuZ5c58', '$argon2i$v=19$m=65536,t=4,p=1$R09SM1pnaXBXV1N5WEhEUw$ZwZeDnqa0YT4VahdUXAT0rgk2wHbupE3/xX459Y4nyg', 1, 0, '2023-02-02 01:36:43'),
(4, 'test4', NULL, '$argon2i$v=19$m=65536,t=4,p=1$cVJtc3I3SlM1Y2IvTlF5VA$uSDVC7xMQSYoGjbDsDmbMOvslqKqSx9p4icrqC6ih0E', '$argon2i$v=19$m=65536,t=4,p=1$V0o4bmdkOHEuSG9zbGJMRg$HnICOotSklr8+HMSHE6bUH9UEy2tMw3KJcZ5qqC+pck', 1, 1, '2023-02-02 01:37:54'),
(5, 'test5', NULL, '$argon2i$v=19$m=65536,t=4,p=1$Vkd3d1BUL3lyQXdlelJyTA$uWqQ6ZDfDP2i5ysKgaERqrrcNWX/UmHJ31gZAMnlQrs', '$argon2i$v=19$m=65536,t=4,p=1$Zktkb2FySHZkL3FnT0MvZQ$rL15W+arwXj3kVPACZSk0ZPSszRo4prV2kimMqi0LbA', 1, 1, '2023-02-04 14:06:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `block1`
--
ALTER TABLE `block1`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `section_block`
--
ALTER TABLE `section_block`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `block1`
--
ALTER TABLE `block1`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `section_block`
--
ALTER TABLE `section_block`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `url`
--
ALTER TABLE `url`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
