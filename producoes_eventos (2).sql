-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Mar-2025 às 20:46
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `producoes_eventos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `address`
--

CREATE TABLE `address` (
  `address_id` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `city_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `address`
--

INSERT INTO `address` (`address_id`, `address`, `zip_code`, `city_id`) VALUES
(1, 'Próximo ao batalhão da PM', '72130080', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `attendees`
--

CREATE TABLE `attendees` (
  `attendee_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `qr_code_hash` varchar(255) NOT NULL,
  `checked_in` tinyint(1) DEFAULT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_item_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

CREATE TABLE `categories` (
  `category_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `city`
--

CREATE TABLE `city` (
  `city_id` int(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `city`
--

INSERT INTO `city` (`city_id`, `city`, `state_id`) VALUES
(1, 'Brasília', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `country`
--

CREATE TABLE `country` (
  `country_id` int(255) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `country`
--

INSERT INTO `country` (`country_id`, `country`) VALUES
(1, 'Brasil');

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `event_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `status` enum('draft','published','cancelled') NOT NULL,
  `cover_image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL,
  `organizer_id` int(255) NOT NULL,
  `address_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_categories`
--

CREATE TABLE `event_categories` (
  `event_id` int(255) NOT NULL,
  `categories_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `status` enum('pending','completed','cancelled','refunded') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` int(11) DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_ticket` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `order_id` int(255) NOT NULL,
  `ticket_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('credit_card','pix','boleto') NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(255) NOT NULL,
  `rating` tinyint(3) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(255) NOT NULL,
  `event_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `state`
--

CREATE TABLE `state` (
  `state_id` int(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `state`
--

INSERT INTO `state` (`state_id`, `state`, `country_id`) VALUES
(1, 'DF', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `sale_start` datetime DEFAULT NULL,
  `sale_end` datetime DEFAULT NULL,
  `max_per_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `event_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('customer','organizer','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password_hash`, `role`, `created_at`, `updated_at`, `address_id`) VALUES
(1, 'Pedro', 'pedro@gmail.com', '$2y$10$aipCN1sqDlOjbMj7VVMCl.Q8ra1PVtcXKfuI2nBjjakJoagFh50ZO', 'organizer', '2025-03-12 18:09:53', '2025-03-12 20:23:44', 1),
(2, 'Pedro Rafael', 'pedro.rafael@gmail.com', '$2y$10$ONIoYtlQSPx3PpIk0WcHEeT1GKIq.JvYx0I3nHuc48JQKxZXVv5cS', 'admin', '2025-03-12 18:25:07', '2025-03-12 20:23:56', 1),
(3, 'Pedro Rafael Faria', 'pedro.rafael.faria@gmail.com', '$2y$10$V/yJXXEtcR7YqbzzjPyPjeVGZ1.PNgp.J350rUbYYi62av5JpvaH.', 'customer', '2025-03-12 19:03:37', '2025-03-12 19:03:37', 1),
(4, 'Pedro Rafael Faria Ferreira', 'pedro.rafael.faria.Ferreira@gmail.com', '$2y$10$9wm4VzPB37h4Of288.m0JObKIuivEFc2/HJEHQRekOTAnUM3/reBa', 'customer', '2025-03-12 20:01:44', '2025-03-12 20:01:44', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `zip_code` (`zip_code`);

--
-- Índices para tabela `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`attendee_id`);

--
-- Índices para tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Índices para tabela `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Índices para tabela `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Índices para tabela `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Índices para tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Índices para tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Índices para tabela `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Índices para tabela `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `attendees`
--
ALTER TABLE `attendees`
  MODIFY `attendee_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Limitadores para a tabela `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `fk_order_item_id` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`order_item_id`);

--
-- Limitadores para a tabela `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `state_id` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

--
-- Limitadores para a tabela `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `address_id` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`),
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_organizer_id` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Limitadores para a tabela `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Limitadores para a tabela `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Limitadores para a tabela `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Limitadores para a tabela `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_address_id` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
