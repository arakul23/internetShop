-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 13 2018 г., 23:01
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `internetshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `updated_at`, `created_at`) VALUES
(1, 0, 'Мобильные телефоны', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Кнопочные телефоны', '2018-12-13 13:17:24', '2018-12-13 13:17:24'),
(3, 1, 'Смартфоны', '2018-12-13 17:48:07', '2018-12-13 17:48:07'),
(4, 0, 'Бытовая техника', '2018-12-13 17:49:08', '2018-12-13 17:49:08');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `id_product`, `url`, `updated_at`, `created_at`) VALUES
(1, 4, '..\\..\\public\\img\\Без названия.jpg', '2018-12-05 12:21:24', '2018-12-05 12:21:24'),
(2, 5, '..\\..\\public\\img\\meizu_16_white.png', '2018-12-05 14:30:05', '2018-12-05 14:30:05'),
(3, 9, '..\\..\\public\\img\\9653067_images_1811657645.jpg', '2018-12-06 14:08:59', '2018-12-06 14:08:59'),
(4, 10, '..\\..\\public\\img\\', '2018-12-11 10:39:24', '2018-12-11 10:39:24'),
(5, 11, '..\\..\\public\\img\\', '2018-12-11 10:40:10', '2018-12-11 10:40:10'),
(6, 12, '..\\..\\public\\img\\', '2018-12-11 10:40:44', '2018-12-11 10:40:44'),
(7, 13, '..\\..\\public\\img\\', '2018-12-11 10:40:58', '2018-12-11 10:40:58'),
(8, 14, '..\\..\\public\\img\\', '2018-12-11 10:43:05', '2018-12-11 10:43:05'),
(9, 15, '..\\..\\public\\img\\', '2018-12-11 10:45:03', '2018-12-11 10:45:03'),
(10, 16, '..\\..\\public\\img\\', '2018-12-11 10:45:05', '2018-12-11 10:45:05'),
(11, 17, '..\\..\\public\\img\\', '2018-12-11 10:46:07', '2018-12-11 10:46:07'),
(12, 18, '..\\..\\public\\img\\', '2018-12-11 10:46:15', '2018-12-11 10:46:15'),
(13, 19, '..\\..\\public\\img\\', '2018-12-11 10:54:06', '2018-12-11 10:54:06'),
(14, 21, '..\\..\\public\\img\\', '2018-12-11 10:55:45', '2018-12-11 10:55:45'),
(15, 22, '..\\..\\public\\img\\', '2018-12-11 10:56:35', '2018-12-11 10:56:35'),
(16, 35, 'public\\img\\', '2018-12-11 11:07:34', '2018-12-11 11:07:34'),
(17, 37, 'public\\img\\', '2018-12-11 11:10:44', '2018-12-11 11:10:44'),
(18, 38, 'public\\img\\', '2018-12-11 11:11:21', '2018-12-11 11:11:21'),
(19, 42, 'public\\img\\', '2018-12-11 11:16:54', '2018-12-11 11:16:54'),
(20, 43, '..\\public\\img\\', '2018-12-11 11:17:14', '2018-12-11 11:17:14'),
(21, 44, '..\\public\\img\\', '2018-12-11 11:17:51', '2018-12-11 11:17:51'),
(22, 45, '..\\public\\img\\', '2018-12-11 11:18:17', '2018-12-11 11:18:17'),
(23, 46, '..\\public\\img\\9653067_images_1811657645.jpg', '2018-12-11 11:20:38', '2018-12-11 11:20:38'),
(24, 47, '..\\public\\img\\558862.png', '2018-12-12 12:19:19', '2018-12-12 12:19:19'),
(25, 48, '..\\public\\img\\product-thumb-2.jpg', '2018-12-13 17:53:32', '2018-12-13 17:53:32'),
(26, 49, '..\\public\\img\\product-thumb-1.jpg', '2018-12-13 17:54:28', '2018-12-13 17:54:28'),
(27, 50, '..\\public\\img\\product-thumb-1.jpg', '2018-12-13 17:56:44', '2018-12-13 17:56:44');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `price`, `description`, `updated_at`, `created_at`) VALUES
(1, 'jhkhj', 1, 66, '', '2018-12-05 12:18:35', '2018-12-05 12:18:35'),
(2, 'jhkhj', 1, 66, '', '2018-12-05 12:20:34', '2018-12-05 12:20:34'),
(3, 'gfgdfg', 1, 1111, '', '2018-12-05 12:20:52', '2018-12-05 12:20:52'),
(4, 'gfgdfg', 1, 1111, '', '2018-12-05 12:21:24', '2018-12-05 12:21:24'),
(5, 'zzzzz', 1, 12, '', '2018-12-05 14:30:05', '2018-12-05 14:30:05'),
(6, 'gfdg', 1, 23, '', '2018-12-06 14:05:56', '2018-12-06 14:05:56'),
(7, 'gfdg', 1, 23, '', '2018-12-06 14:08:15', '2018-12-06 14:08:15'),
(8, 'hjggj', 1, 23, '', '2018-12-06 14:08:23', '2018-12-06 14:08:23'),
(9, 'gfhfgh', 1, 21, '', '2018-12-06 14:08:59', '2018-12-06 14:08:59'),
(10, 'hjkhjkh', 1, 5, '', '2018-12-11 10:39:24', '2018-12-11 10:39:24'),
(11, 'hjghjhg', 1, 1, '', '2018-12-11 10:40:10', '2018-12-11 10:40:10'),
(12, 'jhjk', 1, 32, '', '2018-12-11 10:40:44', '2018-12-11 10:40:44'),
(13, 'jhjk', 1, 32, '', '2018-12-11 10:40:58', '2018-12-11 10:40:58'),
(14, 'jhjk', 1, 32, '', '2018-12-11 10:43:05', '2018-12-11 10:43:05'),
(15, 'jhjk', 1, 32, '', '2018-12-11 10:45:03', '2018-12-11 10:45:03'),
(16, 'jhjk', 1, 32, '', '2018-12-11 10:45:05', '2018-12-11 10:45:05'),
(17, 'jhjk', 1, 32, '', '2018-12-11 10:46:07', '2018-12-11 10:46:07'),
(18, 'gdff', 1, 22, '', '2018-12-11 10:46:15', '2018-12-11 10:46:15'),
(19, 'gdff', 1, 22, '', '2018-12-11 10:54:06', '2018-12-11 10:54:06'),
(20, 'gdff', 1, 22, '', '2018-12-11 10:55:38', '2018-12-11 10:55:38'),
(21, 'gdff', 1, 22, '', '2018-12-11 10:55:45', '2018-12-11 10:55:45'),
(22, 'gdff', 1, 22, '', '2018-12-11 10:56:35', '2018-12-11 10:56:35'),
(23, 'gdff', 1, 22, '', '2018-12-11 10:57:36', '2018-12-11 10:57:36'),
(24, 'jhgjghn', 1, 65, '', '2018-12-11 10:57:59', '2018-12-11 10:57:59'),
(25, 'jhgjghn', 1, 65, '', '2018-12-11 11:00:22', '2018-12-11 11:00:22'),
(26, 'jhgjghn', 1, 65, '', '2018-12-11 11:01:12', '2018-12-11 11:01:12'),
(27, 'jhgjghn', 1, 65, '', '2018-12-11 11:01:22', '2018-12-11 11:01:22'),
(28, 'jhgjghn', 1, 65, '', '2018-12-11 11:01:48', '2018-12-11 11:01:48'),
(29, 'jhgjghn', 1, 65, '', '2018-12-11 11:02:58', '2018-12-11 11:02:58'),
(30, 'jhgjghn', 1, 65, '', '2018-12-11 11:03:03', '2018-12-11 11:03:03'),
(31, 'jhgjghn', 1, 65, '', '2018-12-11 11:03:55', '2018-12-11 11:03:55'),
(32, 'jhgjghn', 1, 65, '', '2018-12-11 11:05:08', '2018-12-11 11:05:08'),
(33, 'hgjhmg', 1, 21, '', '2018-12-11 11:06:29', '2018-12-11 11:06:29'),
(34, 'hgjhmg', 1, 21, '', '2018-12-11 11:07:25', '2018-12-11 11:07:25'),
(35, 'hgjhmg', 1, 21, '', '2018-12-11 11:07:34', '2018-12-11 11:07:34'),
(36, 'cdsfgs', 1, 1, '', '2018-12-11 11:10:05', '2018-12-11 11:10:05'),
(37, 'cdsfgs', 1, 1, '', '2018-12-11 11:10:44', '2018-12-11 11:10:44'),
(38, 'cdsfgs', 1, 1, '', '2018-12-11 11:11:21', '2018-12-11 11:11:21'),
(39, 'cdsfgs', 1, 1, '', '2018-12-11 11:11:40', '2018-12-11 11:11:40'),
(40, 'cdsfgs', 1, 1, '', '2018-12-11 11:16:36', '2018-12-11 11:16:36'),
(41, 'cdsfgs', 1, 1, '', '2018-12-11 11:16:43', '2018-12-11 11:16:43'),
(42, 'cdsfgs', 1, 1, '', '2018-12-11 11:16:54', '2018-12-11 11:16:54'),
(43, 'cdsfgs', 1, 1, '', '2018-12-11 11:17:14', '2018-12-11 11:17:14'),
(44, 'qq', 1, 12, '', '2018-12-11 11:17:51', '2018-12-11 11:17:51'),
(45, 'qq', 1, 12, '', '2018-12-11 11:18:17', '2018-12-11 11:18:17'),
(46, 'hngnn', 1, 434, '', '2018-12-11 11:20:38', '2018-12-11 11:20:38'),
(47, 'Samsung G2', 1, 1123, '\"\\u041f\\u0440\\u043e\\u0446\\u0435\\u0441\\u0441\\u043e\\u0440: Xenos.\\r\\n\\u041e\\u0417\\u0423: 1 \\u0413\\u0411,\\r\\n\\u041e\\u0421: \\u0410\\u043d\\u0434\\u0440\\u043e\\u0438\\u0434,\\r\\n\\u041a\\u0430\\u043c\\u0435\\u0440\\u0430: 12 \\u041c\\u041f\\/5 \\u041c\\u041f,\\r\\n\\u0414\\u0438\\u0441\\u043f\\u043b\\u0435\\u0439: 5.5\"', '2018-12-12 12:19:19', '2018-12-12 12:19:19'),
(48, 'hythjyt', 3, 22, NULL, '2018-12-13 17:53:32', '2018-12-13 17:53:32'),
(49, 'hgbgb3', 4, 22, 'bbbbgg', '2018-12-13 17:54:28', '2018-12-13 17:54:28'),
(50, 'tyrtytrh', 2, 43, 'bgh', '2018-12-13 17:56:44', '2018-12-13 17:56:44');

-- --------------------------------------------------------

--
-- Структура таблицы `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `property_product`
--

CREATE TABLE `property_product` (
  `id_category` int(11) NOT NULL,
  `id_property` int(11) NOT NULL,
  `value` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, 'апвп', 'fdgdfgf@fgdgfdg.fgf', '$2y$10$Wu33iU7xe3eQynEyjWoK2um/tRz/5VTRcP/MQgGgj5puXW.2yfQYW', '', '2018-12-05 11:58:57', '2018-12-05 11:58:57'),
(2, 'arakul', 'babls2332@gmail.com', '$2y$10$8.e5Pe30ZrGzo5TEKvkpVu.tdzGHC6KBN.5h4snU.w9fGdGmrc6Om', 'XhX2nZDwqpld4fBELFGkXMCNAeX65NG53Joesp1iHKNqUOWjzt1keOph9cG8', '2018-12-05 12:03:32', '2018-12-05 12:03:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
