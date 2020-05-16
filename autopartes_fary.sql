-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-05-2020 a las 01:42:36
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

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
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `created_at`, `updated_at`, `content`) VALUES
(1, 6, '2020-05-16 08:48:28', '2020-05-16 08:48:28', 'Math Rush'),
(2, 6, '2020-05-16 08:56:10', '2020-05-16 08:56:10', 'asd'),
(3, 6, '2020-05-16 08:57:46', '2020-05-16 08:57:46', 'asdasdasd'),
(4, 7, '2020-05-17 03:54:55', '2020-05-17 03:54:55', '2I GRAND TOURING');

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

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `content`, `created_at`, `updated_at`, `user_id`, `post_id`) VALUES
(2, 'Ejemplo de comentario', '2020-05-16 02:13:48', '2020-05-16 02:13:48', 6, 19),
(4, 'Un comentario', '2020-05-17 03:26:18', '2020-05-17 03:26:18', 7, 25),
(5, 'asd', '2020-05-17 04:00:57', '2020-05-17 04:00:57', 7, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments_car_posts`
--

CREATE TABLE `comments_car_posts` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_post_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comments_car_posts`
--

INSERT INTO `comments_car_posts` (`id`, `user_id`, `car_post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 7, 3, 'Hola', '2020-05-17 00:23:22', '2020-05-17 00:23:22'),
(2, 7, 3, 'hola a todos', '2020-05-17 00:25:24', '2020-05-17 00:25:24'),
(3, 7, 3, 'Otro comentario', '2020-05-17 00:47:40', '2020-05-17 00:47:40'),
(4, 7, 2, 'Un comentario', '2020-05-17 01:36:26', '2020-05-17 01:36:26'),
(5, 7, 4, 'Un comentario', '2020-05-17 04:18:52', '2020-05-17 04:18:52');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgs_cars`
--

CREATE TABLE `imgs_cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `car_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imgs_cars`
--

INSERT INTO `imgs_cars` (`id`, `url`, `created_at`, `updated_at`, `car_id`) VALUES
(1, '/images/15896009081.png', '2020-05-16 08:48:28', '2020-05-16 08:48:28', 1),
(2, '/images/15896013701.png', '2020-05-16 08:56:10', '2020-05-16 08:56:10', 2),
(3, '/images/15896014661.png', '2020-05-16 08:57:46', '2020-05-16 08:57:46', 3),
(4, '/images/15896696951.png', '2020-05-17 03:54:55', '2020-05-17 03:54:55', 4);

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
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `img`, `content`, `created_at`, `updated_at`, `user_id`) VALUES
(19, '/images/1588607926.jpeg', 'asd', '2020-05-04 20:58:46', '2020-05-04 20:58:46', 1),
(21, NULL, 'asdjlsa dasdjlas jdlkas', '2020-05-16 19:09:54', '2020-05-16 19:09:54', 6),
(22, NULL, 'asdsadasdasd', '2020-05-16 19:10:01', '2020-05-16 19:10:01', 6),
(23, NULL, 'asdasdasdasd', '2020-05-16 19:10:08', '2020-05-16 19:10:08', 6),
(24, NULL, 'asdasdasdasd', '2020-05-16 19:10:13', '2020-05-16 19:10:13', 6),
(25, '/images/1589667744.png', 'asdasd', '2020-05-17 03:22:24', '2020-05-17 03:22:24', 7);

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
(3, 'Daniela', 'j19_r10@hotmail.com', NULL, '$2y$10$7WacnlWfxrc2c6pQ0S0C/ueD.971tJ51IacohJiY28Mq8OamAKfhK', 'San Francisco Tepeolulco, Edomex', '7121397374', NULL, '2020-05-01 03:06:08', '2020-05-01 03:06:08', NULL, 'normal'),
(4, 'jovanny ramírez chimal', 'thejovazrch@gmail.com', NULL, '$2y$10$fZohTZxkt68RCLaXCxkRSuQmmrraefmZDh/d770osZ8cVSHEXup/y', 'Toluca, Edomex', 'asd', NULL, '2020-05-04 20:58:11', '2020-05-04 20:58:11', NULL, 'normal'),
(5, 'Otro usuario', 'correo3@gmail.com', NULL, '$2y$10$lF4tEs0306UV2zBlh11LhemK.wTPKQmb0Q3Yf9wxTqs6JXFFaiw9O', 'Toluca, Edomex', '1231231231', NULL, '2020-05-05 00:34:45', '2020-05-05 00:34:45', NULL, 'normal'),
(6, 'Otro usuario', 'jovannyrch3@gmail.com', NULL, '$2y$10$YrQnfZxoq4NkmJqFkVSpN.Ln3FnUCVmcg8ZNdR4pBOy5xL9iE2m/6', 'Toluca, Edomex', '123123123', NULL, '2020-05-07 07:38:56', '2020-05-07 07:38:56', NULL, 'normal'),
(7, 'Dueño de negocio', 'correo4@gmail.com', NULL, '$2y$10$bhrHOeiNR351R6M5ulmACO1.inAFzF4sZHsg/kLyl9mnf9svaLu8y', 'Toluca, Edomex', '7121397374', NULL, '2020-05-17 00:17:01', '2020-05-17 00:17:01', NULL, 'normal');

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comments_car_posts`
--
ALTER TABLE `comments_car_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imgs_cars`
--
ALTER TABLE `imgs_cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
