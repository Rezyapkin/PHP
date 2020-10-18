-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 18 2020 г., 09:36
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
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `session_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `quantity`, `user_id`, `session_id`) VALUES
(11, 4, 2, 0, 'a0j1d788u6ivqfldismku134qam1hf5v'),
(12, 3, 5, 0, 'a0j1d788u6ivqfldismku134qam1hf5v'),
(33, 3, 4, 1, 'g4jo0pi68mnamgk748on4og7ctf4sbue'),
(34, 5, 4, 1, 'g4jo0pi68mnamgk748on4og7ctf4sbue');

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
(4, 'Кто то ', 'Привет'),
(5, 'admin', 'Забаню'),
(6, 'Админ', 'Привет мир'),
(10, 'Супер автор', 'Отличный отзыв 11'),
(16, 'Стив Джобс', 'Привет мир'),
(17, 'Стив Джобс', '3333');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback_product`
--

CREATE TABLE `feedback_product` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `feedback_product`
--

INSERT INTO `feedback_product` (`id`, `name`, `feedback`, `product_id`) VALUES
(1, 'Дмитрий', 'Ноутбук игровой ASUS F571GT-BQ703T нереально крут!', 3),
(2, 'Иван И.', 'ASUS TUF Gaming FX705 AMD Edition бомбический ноут!', 4),
(4, 'Михаил', 'Отличный ноут. Отзывы поправил.', 3),
(5, 'Вася', 'Люблю Mac', 5),
(9, 'Дмитрий', 'Привет Димон', 4);

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
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `status` enum('Новый','Подтвержден','Оплачен','Выдан','Отменен') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Новый',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint(8) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `u_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `date`, `user_id`, `status`, `name`, `phone`, `address`, `u_id`) VALUES
(3, '2020-10-17 17:36:18', 0, 'Отменен', 'Дмитрий', 7, 'lllll', '7667690415f8affca5a42b2.56442037'),
(7, '2020-10-17 18:08:40', 0, 'Оплачен', 'Дмитрий', 79771175704, 'Москва', '15470743565f8b08f8260fa3.69380903'),
(8, '2020-10-17 18:35:42', 0, 'Новый', 'Дмитрий', 79771175704, 'Москва, Верхняя Красносельская 10к7а, 120', '7831725235f8b0f4e165908.35482044'),
(9, '2020-10-17 18:38:25', 0, 'Новый', 'Дмитрий', 79771175704, 'Москва', '9882337285f8b0ff1570814.36086473'),
(10, '2020-10-17 18:41:46', 0, 'Новый', 'Михаил', 79888888888, 'Москва, Кремаль', '17770870195f8b10ba76fad1.54576059'),
(11, '2020-10-17 18:43:35', 0, 'Новый', 'Дмитрий', 79999999999, 'ул. Новая, 5', '8121252925f8b1127a3e533.17526315'),
(12, '2020-10-17 18:44:35', 1, 'Новый', 'Стив Джобс', 79191919191, 'Москва, ул. Вавилова', '12177005055f8b11630b0a19.30509404'),
(13, '2020-10-17 18:58:01', 1, 'Подтвержден', 'Стив Джобс', 79292922929, 'Москва, Преображенская', '12997233595f8b14898c3a01.52524607'),
(14, '2020-10-17 18:58:50', 1, 'Новый', 'Вася Иванов', 79292921911, 'Владимирская обл.', '16770767915f8b14ba7cfc70.10239757'),
(15, '2020-10-17 19:00:24', 1, 'Новый', 'Миша', 79111111111, 'Заберу сам', '14544876635f8b151848b2f1.50470674'),
(16, '2020-10-17 19:01:04', 1, 'Выдан', 'Стив Джобс', 79999999999, '9', '1843035125f8b1540ed53e3.24931597'),
(17, '2020-10-17 22:20:42', 3, 'Оплачен', 'Вася', 79843334343, 'Васин адрес', '482715095f8b440a46bc88.23095635'),
(18, '2020-10-17 22:34:58', 1, 'Выдан', 'Стив Джобс', 79543343543, 'США', '6343891065f8b47620ffdd3.86066331');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(4, 3, 3, 15, 49990),
(5, 3, 4, 3, 79990),
(6, 3, 5, 2, 59990),
(16, 7, 3, 15, 49990),
(17, 7, 4, 3, 79990),
(18, 7, 5, 2, 59990),
(19, 8, 3, 15, 49990),
(20, 8, 4, 3, 79990),
(21, 8, 5, 2, 59990),
(22, 9, 3, 15, 49990),
(23, 9, 4, 3, 79990),
(24, 9, 5, 2, 59990),
(25, 10, 3, 15, 49990),
(26, 10, 4, 3, 79990),
(27, 10, 5, 2, 59990),
(28, 11, 3, 1, 49990),
(29, 12, 4, 1, 79990),
(30, 12, 3, 1, 49990),
(32, 13, 3, 1, 49990),
(33, 14, 4, 1, 79990),
(34, 15, 3, 1, 49990),
(35, 15, 4, 1, 79990),
(37, 16, 3, 1, 49990),
(38, 17, 3, 1, 49990),
(39, 17, 4, 1, 79990),
(41, 18, 3, 7, 49990),
(42, 18, 5, 1, 59990);

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

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cookie_hash` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT current_timestamp(),
  `is_admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `password_hash`, `cookie_hash`, `last_action`, `is_admin`) VALUES
(1, 'admin', 'Стив Джобс', '$2y$10$Tu4VWMKlDkq5Lkhz3liKL.6rbAKxs0IDMdmexD44pzn3wgWChCavC', '', '2020-10-15 06:37:24', b'1'),
(3, 'vasya', 'Вася', '$2y$10$hfMzQQ6K4g6oITfNvtAu0OhQCJIsRWDg.OMbpRVEEcV6mhFR0osIW', '', '2020-10-17 19:20:05', b'0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback_product`
--
ALTER TABLE `feedback_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

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
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`,`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `feedback_product`
--
ALTER TABLE `feedback_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `feedback_product`
--
ALTER TABLE `feedback_product`
  ADD CONSTRAINT `feedback_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
