-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 27 2019 г., 07:34
-- Версия сервера: 10.1.30-MariaDB
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_blog_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id_news` int(11) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `dt_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id_news`, `title`, `content`, `dt_create`) VALUES
(27, 'new article 7', 'sss', '2018-07-04 18:38:58'),
(52, 'new article 5', '34343', '2018-07-04 18:38:46'),
(64, 'new articledd', 'tasty', '2018-10-06 17:23:13'),
(65, 'new article 6', 'uytuty', '2018-07-04 18:38:52'),
(68, 'new article 4', '123', '2018-07-04 18:38:37'),
(69, 'New article 9', 'content1', '2018-07-04 18:39:14'),
(71, 'new article 1', '1', '2018-07-04 18:38:30');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `name`) VALUES
(1, 'user.view_articles', 'Просмотр статей'),
(2, 'editor.add_edit', 'Добавление и редактирование статей'),
(3, 'moderator.delete_articles', 'Удаление статей'),
(4, 'moderator.approve_articles', 'Одобрение статей'),
(5, 'moderator.discard_articles', 'Отклонение статей'),
(6, 'admin.edit_users\'', 'Управление пользователями');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions_roles`
--

CREATE TABLE `permissions_roles` (
  `role_code` varchar(255) NOT NULL,
  `permission_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `permissions_roles`
--

INSERT INTO `permissions_roles` (`role_code`, `permission_code`) VALUES
('user', 'user.view_articles'),
('user', 'editor.add_edit'),
('editor', 'user.view_articles'),
('editor', 'editor.add_edit'),
('moderator', 'moderator.approve_articles'),
('moderator', 'moderator.delete_articles'),
('moderator', 'moderator.discard_articles'),
('moderator', 'user.view_articles'),
('moderator', 'editor.add_edit'),
('admin', 'admin.edit_users\''),
('admin', 'user.view_articles'),
('admin', 'editor.add_edit');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица ролей';

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`) VALUES
(1, 'user', 'Пользователь'),
(2, 'editor', 'Редактор'),
(3, 'moderator', 'Модератор'),
(4, 'admin', 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dt_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `dt_reg`, `role_id`, `status`) VALUES
(4, 'admin', 'qwerty', '2018-05-15 08:36:18', 4, '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_news`),
  ADD UNIQUE KEY `name_article` (`title`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Индексы таблицы `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD KEY `permission_code` (`permission_code`),
  ADD KEY `role_code` (`role_code`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id_news` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permissions_roles`
--
ALTER TABLE `permissions_roles`
  ADD CONSTRAINT `permissions_roles_ibfk_1` FOREIGN KEY (`permission_code`) REFERENCES `permissions` (`code`),
  ADD CONSTRAINT `permissions_roles_ibfk_2` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
