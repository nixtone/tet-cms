-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2020 г., 12:28
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kacms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block`
--

CREATE TABLE `ka_block` (
  `ID` int NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_block`
--

INSERT INTO `ka_block` (`ID`, `NAME`) VALUES
(1, 'Текстовая страница'),
(2, 'Плюшка'),
(3, 'Тестовод'),
(4, 'Еще один');

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block1`
--

CREATE TABLE `ka_block1` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `CATEGORY` int NOT NULL,
  `URL_ALTERNATIVE` text NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `TEXT` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_block1`
--

INSERT INTO `ka_block1` (`ID`, `ACTIVE`, `SORT`, `SECTION_BLOCK`, `CATEGORY`, `URL_ALTERNATIVE`, `NAME`, `TEXT`) VALUES
(1, 1, 10, 1, 0, '', 'Тестовая запись', 'Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Первую однажды которое, прямо пояс вопроса, диких бросил большого курсивных предупреждал рукопись свой безопасную даже наш, свою текстами продолжил рыбными!'),
(2, 1, 20, 1, 0, '', 'Статья безопасное вождение или \"правило десяти долларов\"', 'Сегодня мы начинаем серию статей по концепции безопасного вождения на улицах городов. Этот связано с многочисленными вопросами райдеров о различных ситуациях на дороге. Мы будем рассказывать о том, как мы научились ездить безопасно и быстро. \r\n\r\nОсновываться мы будем на работах знаменитого гонщика Кейта Кода. Этот автор описывает безопасное движение на дороге относительно motoGP. Всего есть несколько моментов, которые нужно считать каноничными и выучить до уровня рефлексов, чтобы потом ездить быстро и безопасно. И первое правило мотоциклиста - ничего и никогда не бояться. Страх - это первый враг райдера.\r\n\r\nТо есть, например если вы едите и никого не трогаете, а из-за угла вдруг выскакивает какое-то препятствие, то первое что захочется сделать - это нажать педаль тормоза. На автомобиле такая реакция будет правильной. Для байкера такие действия могут обернуться трагедией. Поэтому очень важно всегда сохранять холодный ум. И в вышеописанной ситуации необходимо четко прокрутить все варианты безопасного падения, торможения или поворота. Режим паники наносит человеку самый ужасный вред во время аварии.'),
(3, 1, 30, 1, 0, '', 'Медвежья услуга', 'Это одно из явлений в коллективе, которое может носить кратковременный положительный результат но в итоге это лишь усугубляет положение того кому помогли и как следствие это вызывает агрессию на кого кто помогал.\r\n\r\nПричина 1.\r\nЧеловеку «дали рыбу, но не дали удочку». Иными словами — консультант дал готовое решение тому, кто нуждался в помощи, не удосужившись объяснить почему оно работает. \r\n	Консультант в данном случае опирался на свои знания, опыт, навыки и жизненные установки и не учел, что у его подопечного они отличны. Результатом чаще всего являются ошибочные действия и прямо противоположный результат. Клиент, само собой, разгневан и зол на советчика. Это же он дал такой совет.\r\n	Советчик из спасителя превращается в преследуемого. А преследуемый — в преследователя.\r\n\r\nКак убрать ошибку?\r\n1. Не давать готовых решений, как бы у вас их не просили. Давать способы и компетенции, с помощью которых человек сможет сам достичь решения.\r\n2. В случае, если без готовых решений не обойтись: давать их по возможности больше, с объяснением какое решение к чему приведет, и от чего наоборот отдалит. Что человек получит в результате этого решения, а что потеряет. На чем сэкономит, а где получит прибыль.\r\n3. В случае, если решение только одно — максимально подробно рассмотреть его с различных сторон и «вести» и корректировать действия клиента все время, которое потребуется для достижения результата. Это поможет увеличить шансы того, что нужный результат будет достигнут.');

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block2`
--

CREATE TABLE `ka_block2` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `CATEGORY` int NOT NULL,
  `URL_ALTERNATIVE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block3`
--

CREATE TABLE `ka_block3` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `CATEGORY` int NOT NULL,
  `URL_ALTERNATIVE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block4`
--

CREATE TABLE `ka_block4` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `CATEGORY` int NOT NULL,
  `URL_ALTERNATIVE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ka_block5`
--

CREATE TABLE `ka_block5` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `SECTION_BLOCK` int NOT NULL,
  `CATEGORY` int NOT NULL,
  `URL_ALTERNATIVE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ka_design`
--

CREATE TABLE `ka_design` (
  `ID` int NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PARENT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_design`
--

INSERT INTO `ka_design` (`ID`, `NAME`, `PARENT`) VALUES
(1, 'Базовый', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ka_section`
--

CREATE TABLE `ka_section` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `FOLDER` varchar(255) NOT NULL,
  `DESIGN` int NOT NULL,
  `PARENT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_section`
--

INSERT INTO `ka_section` (`ID`, `ACTIVE`, `SORT`, `NAME`, `FOLDER`, `DESIGN`, `PARENT`) VALUES
(1, 0, 10, 'Страница не найдена', '404', 1, 0),
(2, 1, 20, 'Главная', 'index', 1, 0),
(3, 1, 10, 'Каталог', 'katalog', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `ka_section_block`
--

CREATE TABLE `ka_section_block` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `SORT` int NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `SECTION` int NOT NULL,
  `BLOCK` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_section_block`
--

INSERT INTO `ka_section_block` (`ID`, `ACTIVE`, `SORT`, `NAME`, `SECTION`, `BLOCK`) VALUES
(1, 1, 10, 'Текстовая страница', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ka_site`
--

CREATE TABLE `ka_site` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `DOMAIN` varchar(255) NOT NULL,
  `SECTION_INDEX` int NOT NULL,
  `SECTION_404` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `ka_site`
--

INSERT INTO `ka_site` (`ID`, `ACTIVE`, `DOMAIN`, `SECTION_INDEX`, `SECTION_404`) VALUES
(1, 1, 'kacms.loc', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ka_user`
--

CREATE TABLE `ka_user` (
  `ID` int NOT NULL,
  `ACTIVE` int NOT NULL,
  `LOGIN` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `USER_GROUP` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ka_block`
--
ALTER TABLE `ka_block`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_block1`
--
ALTER TABLE `ka_block1`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_design`
--
ALTER TABLE `ka_design`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_section`
--
ALTER TABLE `ka_section`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_section_block`
--
ALTER TABLE `ka_section_block`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_site`
--
ALTER TABLE `ka_site`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ka_user`
--
ALTER TABLE `ka_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ka_block`
--
ALTER TABLE `ka_block`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `ka_block1`
--
ALTER TABLE `ka_block1`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `ka_design`
--
ALTER TABLE `ka_design`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ka_section`
--
ALTER TABLE `ka_section`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `ka_section_block`
--
ALTER TABLE `ka_section_block`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ka_site`
--
ALTER TABLE `ka_site`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ka_user`
--
ALTER TABLE `ka_user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
