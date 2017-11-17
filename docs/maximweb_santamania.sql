-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Nov-2017 às 02:23
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maximweb_santamania`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `counter`
--

INSERT INTO `counter` (`id`, `date`, `created_at`, `updated_at`) VALUES
(21, '2017-11-01 00:00:00', '2017-11-16 01:34:05', '2017-11-16 01:34:05'),
(22, '2017-11-25 00:00:00', '2017-11-16 16:03:29', '2017-11-16 16:03:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
('20170915122424'),
('20170916124901'),
('20170916155203'),
('20170916160143'),
('20170916173037'),
('20171009124648'),
('20171025094512');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_category_id` int(11) DEFAULT NULL,
  `units_measure_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `product_category_id`, `units_measure_id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(2, 1, 35, 'f32993bcf3cc1b402df4987e1b12159075b3f046ae754480018764ce8a6972dcv4Fy7HnQkoUjrbhZ8vfTeksR0c+axNSIMh9LoEZMT3Y=', 1, '2017-11-03 16:40:26', '2017-11-03 16:40:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'b4a114e22b3c5e388f365273866a06d024ccc6e7617471ecd34213788e9c803d48R/pWPtLTU/dBfOh3srBPpBNzsMNGWgWtlm31hJP+E=', 1, '2017-11-03 01:49:43', '2017-11-03 01:49:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_check`
--

CREATE TABLE `product_check` (
  `id` int(11) NOT NULL,
  `id_counter` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `checked` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `product_check`
--

INSERT INTO `product_check` (`id`, `id_counter`, `id_product`, `total`, `checked`, `created_at`, `updated_at`) VALUES
(22, 21, 2, 24, 1, '2017-11-16 01:34:06', '2017-11-16 01:34:06'),
(23, 22, 2, 0, 0, '2017-11-16 16:03:30', '2017-11-16 16:03:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product_status`
--

CREATE TABLE `product_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prodution`
--

CREATE TABLE `prodution` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prodution`
--

INSERT INTO `prodution` (`id`, `quantity`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 9, 2, '2017-11-03 16:43:14', '2017-11-03 16:43:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quantity_warehouse`
--

CREATE TABLE `quantity_warehouse` (
  `id` int(11) NOT NULL,
  `id_product_checked` int(11) NOT NULL,
  `id_warehouses` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `quantity_warehouse`
--

INSERT INTO `quantity_warehouse` (`id`, `id_product_checked`, `id_warehouses`, `quantity`, `created_at`, `updated_at`) VALUES
(27, 22, 1, 12, '2017-11-16 01:41:13', '2017-11-16 01:41:13'),
(28, 22, 2, 12, '2017-11-16 01:41:13', '2017-11-16 01:41:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `total_report`
--

CREATE TABLE `total_report` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `different` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `total_report`
--

INSERT INTO `total_report` (`id`, `total`, `different`, `product_id`, `sub_total`, `created_at`, `updated_at`) VALUES
(24, 18, 0, 2, 9, '2017-11-04 02:21:19', '2017-11-04 02:21:19'),
(26, 18, 0, 2, 9, '2017-11-04 02:21:20', '2017-11-04 02:21:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `units_measure`
--

CREATE TABLE `units_measure` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `units_measure`
--

INSERT INTO `units_measure` (`id`, `name`, `symbol`, `created_at`, `updated_at`) VALUES
(35, '2b7fa41deed234915f79887640ac0c31e8ab63758a524100e94d05abc26cd255U+tfm9XVNZ0V3Buo/Cb+cWvSRpZQ/JGsAQAgZXEK6m0=', '9933024a004e620ac08f89fbe09dd03ba000ee61433df7a60c72a8ff5c9e1f9fUm9/4rIVG4TDkRCn91z9g9cXzzWgN6wBs1QclI0Z6wg=', '2017-10-23 20:07:17', '2017-10-23 20:07:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `activation_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `level`, `active`, `activation_key`, `created_at`, `updated_at`) VALUES
(4, 'Marcelo', 'Corrêa', 'marcelocorrea229@gmail.com', '$2y$10$uXMwx5alcoJ0kmL4XQtROO2ci8qgq7bbwvUuPta2p1TZtlt7ikKy2', 1, 1, 'asdfa9s8df76gs98df76gs9', '2017-09-15 12:35:00', '2017-09-15 17:37:05'),
(5, 'Jean', 'Sauzem Marques', 'jsauzem@gmail.com', '$2y$10$zCYGNnvnUCsN53ZXkNQle.qjR1Z6cEKjuEmCOXAeP7GO3F0V2VyFW', 1, 1, NULL, '2017-10-23 14:49:54', '2017-10-23 14:49:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `warehouses`
--

INSERT INTO `warehouses` (`id`, `code`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, '0c36e4738a3643a', 'e34ab1dcb3d34a446b4e884f242f3a4b84844856c0bd2127b6605ae6d15d1b5aC41ZDPnlNKxktomUEU69aGM/ODsTRToDhY2xstigJ54=', 1, '2017-11-03 16:26:24', '2017-11-03 16:26:20'),
(2, '0329ffe8b47faf4', '80afc8785422b1ceb9325f4f8ab42d5c796cb0177ad670cc57fb7ccf065eb7b8tskpGJvMC8fPzoaY/m006g4et0cCSdcvb2LCCVmVvOk=', 1, '2017-11-07 16:38:31', '2017-11-07 16:38:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_ibfk_1` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_product_categories1_idx` (`product_category_id`),
  ADD KEY `fk_products_unit_measures1_idx` (`units_measure_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_check`
--
ALTER TABLE `product_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_counter` (`id_counter`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_status`
--
ALTER TABLE `product_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodution`
--
ALTER TABLE `prodution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodution_ibfk_1` (`product_id`);

--
-- Indexes for table `quantity_warehouse`
--
ALTER TABLE `quantity_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quantity_warehouse_ibfk_2` (`id_warehouses`),
  ADD KEY `id_product_checked` (`id_product_checked`);

--
-- Indexes for table `total_report`
--
ALTER TABLE `total_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `units_measure`
--
ALTER TABLE `units_measure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_check`
--
ALTER TABLE `product_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_status`
--
ALTER TABLE `product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodution`
--
ALTER TABLE `prodution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quantity_warehouse`
--
ALTER TABLE `quantity_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `total_report`
--
ALTER TABLE `total_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `units_measure`
--
ALTER TABLE `units_measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `checklist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checklist_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_product_categories1_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_unit_measures1_id` FOREIGN KEY (`units_measure_id`) REFERENCES `units_measure` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `product_check`
--
ALTER TABLE `product_check`
  ADD CONSTRAINT `product_check_ibfk_1` FOREIGN KEY (`id_counter`) REFERENCES `counter` (`id`),
  ADD CONSTRAINT `product_check_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Limitadores para a tabela `prodution`
--
ALTER TABLE `prodution`
  ADD CONSTRAINT `prodution_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `quantity_warehouse`
--
ALTER TABLE `quantity_warehouse`
  ADD CONSTRAINT `quantity_warehouse_ibfk_2` FOREIGN KEY (`id_warehouses`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `quantity_warehouse_ibfk_3` FOREIGN KEY (`id_product_checked`) REFERENCES `product_check` (`id`);

--
-- Limitadores para a tabela `total_report`
--
ALTER TABLE `total_report`
  ADD CONSTRAINT `total_report_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
