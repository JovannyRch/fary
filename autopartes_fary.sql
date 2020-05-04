-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2020 a las 20:01:20
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `autopartes_fary`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` text NOT NULL,
  `negocio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tiempo` tinyint(3) UNSIGNED DEFAULT 7,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ads`
--

INSERT INTO `ads` (`id`, `url`, `negocio_id`, `tiempo`, `created_at`, `updated_at`) VALUES
(4, '/images/1588258838.jpeg', 1, 10, '2020-04-30 20:00:38', '2020-04-30 20:00:38'),
(5, '/images/1588258975.mp4', 1, 7, '2020-04-30 20:02:55', '2020-04-30 20:02:55'),
(6, '/images/1588259535.jpeg', NULL, 7, '2020-04-30 20:12:15', '2020-04-30 20:12:15'),
(7, '/images/1588259547.jpeg', NULL, 7, '2020-04-30 20:12:27', '2020-04-30 20:12:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `created_at`, `updated_at`, `content`) VALUES
(12, 1, '2020-04-14 09:29:24', '2020-04-14 09:29:24', 'VENTO COMFORTLINE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments_car_posts`
--

CREATE TABLE `comments_car_posts` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_post_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comments_car_posts`
--

INSERT INTO `comments_car_posts` (`id`, `user_id`, `car_post_id`, `content`, `created_at`, `updated_at`) VALUES
(3, 1, 12, 'Transmisión: Std Llaves: SI Refacturación: Si a su nombre, Observaciones:  Arrancando, caminando, Fácil reparación!  Súper Margen!!  TEL 5510434007 / 5526210241', '2020-04-14 09:29:37', '2020-04-14 09:29:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgs_cars`
--

CREATE TABLE `imgs_cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `car_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imgs_cars`
--

INSERT INTO `imgs_cars` (`id`, `url`, `created_at`, `updated_at`, `car_id`) VALUES
(21, '/images/15868385640.jpeg', '2020-04-14 09:29:24', '2020-04-14 09:29:24', 12),
(22, '/images/15868385641.jpeg', '2020-04-14 09:29:24', '2020-04-14 09:29:24', 12),
(23, '/images/15868385642.jpeg', '2020-04-14 09:29:24', '2020-04-14 09:29:24', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_08_19_000000_create_failed_jobs_table', 2),
(4, '2020_04_08_221740_create_negocios_table', 3),
(7, '2020_04_08_223411_create_posts_table', 4),
(8, '2020_04_08_223421_create_comments_table', 5),
(10, '2020_04_08_231812_adds_api_token_to_users_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`id`, `name`, `address`, `phone`, `email`, `img`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, 'J19 Software', 'Toluca, Edomex', '7121397374', 'jova@gmail.com', '/negocios/1588051622.png', '2020-04-28 10:27:02', '2020-04-28 10:27:02', 2),
(2, 'Refaccionaria Automotriz Chavez', 'Hidalgo, No. 126 Autlan, Jalisco', '3173822248', 'chavez@gmail.com', '/negocios/1588275968.jpeg', '2020-05-01 00:46:08', '2020-05-01 00:46:08', 2),
(3, 'REFACCIONARIA EL ARBOL', 'Toluca, Edomex', '7121397374', 'correo_del_negocio@gmail.com', '/negocios/1588281837.jpeg', '2020-05-01 02:23:57', '2020-05-01 02:23:57', 2),
(4, 'REFACCIONARIAS LALO´S', 'TOLUCA', '7121397374', 'ejemplo@gmail.com', '/images/1588283096.jpeg', '2020-05-01 02:27:11', '2020-05-01 02:44:56', 2),
(5, 'Ancona Autopartes', 'Toluca, Edomex', '7121397374', 'correo@gmail.com', '/images/1588283242.jpeg', '2020-05-01 02:47:22', '2020-05-01 02:47:22', 2),
(6, 'Refaccionaria Automotriz San Pedro S.A. de C.V', 'Calle 47 No. 75 Av. Gonernadores', '7228116330', 'negocio@gmail.com', '/images/1588283501.jpeg', '2020-05-01 02:51:41', '2020-05-01 02:51:41', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `piece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national` tinyint(1) NOT NULL DEFAULT 1,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `piece`, `model`, `brand`, `national`, `img`, `details`, `created_at`, `updated_at`, `user_id`) VALUES
(4, 'motor 4', '2017 3', '123 4', 1, '', 'asdasd123', '2020-04-09 07:58:59', '2020-04-09 07:58:59', 1),
(5, 'motor 5', '2017 3', '123 4', 1, NULL, 'asdasd123', '2020-04-09 07:59:01', '2020-04-09 07:59:01', 1),
(6, 'motor 6', '2017 3', '123 4', 1, NULL, 'asdasd123', '2020-04-09 07:59:04', '2020-04-09 07:59:04', 1),
(7, 'Llantas', '123', '123', 1, NULL, '123', '2020-04-09 08:29:22', '2020-04-09 08:29:22', 1),
(8, 'Juguito de arándano', '312', '123', 0, '/images/1586466648.png', '123', '2020-04-10 02:10:48', '2020-04-10 02:10:48', 1),
(9, 'Juguito de arándano', '312', '123', 0, '/images/1586466886.png', '123', '2020-04-10 02:14:46', '2020-04-10 02:14:46', 1),
(10, 'Juguito de arándano', '312', '123', 0, '/images/1586466936.png', '123', '2020-04-10 02:15:36', '2020-04-10 02:15:36', 1),
(13, 'Juguito de arándano', 'asd', 'as', 1, NULL, 'assa', '2020-04-10 04:01:13', '2020-04-10 04:01:13', 1),
(14, 'Xiaomi', 'asd', 'asd', 1, '/images/1586473288.jpeg', 'asd', '2020-04-10 04:01:28', '2020-04-10 04:01:28', 1),
(17, 'Juguito de arándano', 'asd', 'asd', 1, '/images/1586473629.png', 'asd', '2020-04-10 04:07:09', '2020-04-10 04:07:09', 1),
(18, 'Puerta de camioneta', '2014', 'FORD F150', 1, NULL, 'Puerta del lado izquierdo', '2020-04-10 09:58:21', '2020-04-10 09:58:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`created_at`, `updated_at`, `id`, `name`) VALUES
('2020-04-28 10:25:42', '2020-04-28 10:25:42', 2, 'TALLERES MECANICOS'),
('2020-04-28 10:25:47', '2020-04-28 10:25:47', 3, 'LAVADO DE AUTOS'),
('2020-04-28 10:26:00', '2020-04-28 10:26:00', 5, 'TALLERES DE HOJALATERIA Y PINTURA'),
('2020-04-28 10:26:08', '2020-04-28 10:26:08', 7, 'TALACHERAS'),
('2020-04-28 10:26:11', '2020-04-28 10:26:11', 8, 'REPARACION DE CAJAS AUTOMATICAS'),
('2020-05-01 02:20:24', '2020-05-01 02:20:24', 9, 'NEGOCIOS DE AUTO PARTES USADAS'),
('2020-05-01 02:20:45', '2020-05-01 02:20:45', 10, 'TALLERES ELECTRICOS'),
('2020-05-01 02:21:34', '2020-05-01 02:21:34', 11, 'REFACCIONARIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_negocios`
--

CREATE TABLE `tipos_negocios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `negocio_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos_negocios`
--

INSERT INTO `tipos_negocios` (`id`, `negocio_id`, `tipo_id`, `created_at`, `updated_at`) VALUES
(2, 1, 2, '2020-04-28 05:27:02', '2020-04-28 05:27:02'),
(3, 1, 5, '2020-04-28 05:27:02', '2020-04-28 05:27:02'),
(10, 2, 5, '2020-04-30 21:14:16', '2020-04-30 21:14:16'),
(11, 2, 8, '2020-04-30 21:14:16', '2020-04-30 21:14:16'),
(12, 3, 11, '2020-04-30 21:23:57', '2020-04-30 21:23:57'),
(25, 4, 2, '2020-04-30 21:44:56', '2020-04-30 21:44:56'),
(26, 4, 8, '2020-04-30 21:44:56', '2020-04-30 21:44:56'),
(27, 5, 9, '2020-04-30 21:47:22', '2020-04-30 21:47:22'),
(28, 6, 11, '2020-04-30 21:51:41', '2020-04-30 21:51:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` enum('admin','normal','owner') COLLATE utf8mb4_unicode_ci DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `address`, `phone`, `remember_token`, `created_at`, `updated_at`, `api_token`, `rol`) VALUES
(1, 'jovanny ramírez chimal', 'jovannyrch@gmail.com', NULL, '$2y$10$Mf3cWSKrXLP0FjpYqMPn8OtgvnwAEmDxp3negDDQ3rJHcwunAm5M.', 'Toluca Estado de México', '7226227577', NULL, '2020-04-09 01:32:32', '2020-04-09 01:32:32', NULL, 'admin'),
(2, 'Otro usuario', 'mrgbep@gmail.com', NULL, '$2y$10$f8rligpiI.vdBYy39k6afu94NE3CcV.0VBz5FME44jKvfnp3.wKAy', 'Temascalcingo', '7122080680', NULL, '2020-04-12 09:44:56', '2020-04-28 10:17:15', NULL, 'owner'),
(3, 'Daniela', 'j19_r10@hotmail.com', NULL, '$2y$10$7WacnlWfxrc2c6pQ0S0C/ueD.971tJ51IacohJiY28Mq8OamAKfhK', 'San Francisco Tepeolulco, Edomex', '7121397374', NULL, '2020-05-01 03:06:08', '2020-05-01 03:06:08', NULL, 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contador` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=koi8u;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negocio_id` (`negocio_id`);

--
-- Indices de la tabla `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `comments_car_posts`
--
ALTER TABLE `comments_car_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_post_id` (`car_post_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imgs_cars`
--
ALTER TABLE `imgs_cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_negocios`
--
ALTER TABLE `tipos_negocios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `negocio_id` (`negocio_id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comments_car_posts`
--
ALTER TABLE `comments_car_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imgs_cars`
--
ALTER TABLE `imgs_cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipos_negocios`
--
ALTER TABLE `tipos_negocios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`negocio_id`) REFERENCES `negocios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comments_car_posts`
--
ALTER TABLE `comments_car_posts`
  ADD CONSTRAINT `comments_car_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_car_posts_ibfk_2` FOREIGN KEY (`car_post_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imgs_cars`
--
ALTER TABLE `imgs_cars`
  ADD CONSTRAINT `imgs_cars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD CONSTRAINT `negocios_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tipos_negocios`
--
ALTER TABLE `tipos_negocios`
  ADD CONSTRAINT `tipos_negocios_ibfk_1` FOREIGN KEY (`negocio_id`) REFERENCES `negocios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tipos_negocios_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
