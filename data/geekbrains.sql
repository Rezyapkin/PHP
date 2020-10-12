-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 12 2020 г., 14:05
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geekbrains`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`) VALUES
(1, 'admin', 'Все ок'),
(2, 'Пользователь', 'Привет'),
(4, 'Кто то ', 'Привет'),
(5, 'admin', 'Забаню'),
(6, 'Админ', 'Привет мир'),
(10, 'Супер автор', 'Оставить отзыв');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`ID`, `filename`, `size`, `views`) VALUES
(1, '01.jpg', 111456, 2),
(2, '02.jpg', 70076, 0),
(3, '03.jpg', 70215, 0),
(4, '04.jpg', 61733, 0),
(5, '05.jpg', 160617, 0),
(6, '06.jpg', 89871, 0),
(7, '07.jpg', 99418, 0),
(8, '08.jpg', 103775, 0),
(9, '09.jpg', 81022, 0),
(10, '10.jpg', 97127, 0),
(11, '11.jpg', 98579, 0),
(12, '12.jpg', 139286, 0),
(13, '13.jpg', 113016, 0),
(14, '14.jpg', 151814, 0),
(15, '15.jpg', 112488, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`) VALUES
(1, 'Опубликованы детали разговора Путина и Клинтона о гибели подлодки \"Курск\"', 'МОСКВА, 5 окт — РИА Новости. Цифровая библиотека Билла Клинтона рассекретила стенограммы бесед экс-президента США с Владимиром Путиным, одна из которых касалась катастрофы подводной лодки \"Курск\" в августе 2000 года.\r\nВстреча лидеров двух стран состоялась 6 сентября 2000 года в президентском номере нью-йоркской гостиницы Waldorf Astoria.\r\nВ начале беседы Клинтон выразил соболезнования в связи с гибелью \"Курска\", а Путин признал, что у него не было хорошего варианта в сложившейся ситуации.'),
(2, 'ОЗХО направит в Россию экспертов для расследования по делу Навального', 'МОСКВА, 5 окт — РИА Новости. Организация по запрещению химического оружия (ОЗХО) готова предоставить России группу экспертов для расследования инцидента с Алексеем Навальным.\r\nСоответствующее обращение из Москвы поступило 1 октября.\r\n\"Второго октября генеральный директор ОЗХО Фернандо Ариас ответил на этот запрос письмом на имя постоянного представителя России при ОЗХО. Он заверил <...>, что технический секретариат готов предоставить запрашиваемую экспертизу и что группа экспертов может быть размещена в короткие сроки\", — сказано в сообщении.\r\nОтмечается, что гендиректор попросил российскую сторону дать дополнительные разъяснения относительно типа запрашиваемой экспертизы, а также поблагодарил за доверие.');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`) VALUES
(3, 'Ноутбук игровой ASUS F571GT-BQ703T', 'Компактный ноутбук, с достаточно мощным железом внутри. Два вентилятора, что в нём стоят, не дают ему нагреваться до высоких температур, даже когда запускаешь требовательные программы и игры ( в частности raindbow six siege на высоких шла плавно, ноут ощутимо не нагревался) . Экран оказался на удивление хорошим, хоть это и ips-level ( по сути TFT, но доработанный) и оставил о себе приятное впечатление. Подсветка есть, разъём под SD карту есть, HDMI есть, E кабель есть. Возможно это и не плюс, но блок питания компактный.', 'asus.png', 49990),
(4, 'Ноутбук игровой ASUS TUF Gaming FX705DT-AU027T', 'ASUS TUF Gaming FX705 AMD Edition – это современный игровой ноутбук в корпусе повышенной прочности, которая подтверждена строгими тестами по стандарту MIL-STD-810G. В аппаратную конфигурацию устройства входит новейший процессор AMD Ryzen и дискретная видеокарта Radeon. IPS-дисплей NanoEdge со сверхтонкой рамкой поддерживает технологию адаптивной синхронизации AMD FreeSync, гарантируя высокое качество изображения. TUF Gaming FX705 AMD Edition – отличная игровая платформа по разумной цене!', 'asus2.jpg', 79990),
(5, 'Ноутбук Apple MacBook Pro 13 i5 1,4/8Gb/512SSD Sil', ' Особого отношения к себе не требует, сам себя чистит от ошибок и всего мусора за исключением хвостов от удаленных программ (периодически приходится подчищать). Работал с видосами, быстро рендрит. Советую покупать больше памяти, или доп. ж/д для хранения. Есть интересные моменты с форматами чтения дисков, ж/дисков, флешек и т.д. Уточняйте с чем работает. ', 'mac.jpg', 59990);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
