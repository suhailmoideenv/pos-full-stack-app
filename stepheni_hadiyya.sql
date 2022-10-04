-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 16, 2022 at 11:59 PM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stepheni_hadiyya`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `adding_price` decimal(8,2) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_ons`
--

INSERT INTO `add_ons` (`id`, `name`, `adding_price`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(6, 'Extra cheese', '3.00', 1, 0, '2022-09-13 12:46:36', '2022-09-13 12:46:36', 6),
(7, 'Extra sause', '2.00', 1, 0, '2022-09-13 12:46:47', '2022-09-13 12:46:47', 6);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(19, 'Pizza', 1, 0, '2022-09-13 12:45:14', '2022-09-13 12:45:14', 6),
(20, 'Burgers', 1, 0, '2022-09-13 12:45:25', '2022-09-13 12:45:25', 6),
(21, 'Juices', 1, 0, '2022-09-13 19:47:34', '2022-09-13 19:47:34', 6),
(22, 'Bakery', 1, 0, '2022-09-13 19:47:41', '2022-09-13 19:47:41', 6),
(23, 'Indian', 1, 0, '2022-09-13 19:47:51', '2022-09-13 19:47:51', 6),
(24, 'Continental', 1, 0, '2022-09-13 19:47:58', '2022-09-13 19:47:58', 6),
(25, 'Category4', 1, 0, '2022-09-13 19:48:14', '2022-09-13 19:48:14', 6),
(26, 'Category5', 1, 0, '2022-09-13 19:48:21', '2022-09-13 19:48:21', 6),
(27, 'Category6', 1, 0, '2022-09-13 19:48:27', '2022-09-13 19:48:27', 6),
(28, 'Mexican', 1, 0, '2022-09-13 19:48:50', '2022-09-13 19:48:50', 6);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `building_name` varchar(45) NOT NULL,
  `room_number` varchar(45) NOT NULL,
  `area` varchar(45) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `building_name`, `room_number`, `area`, `telephone`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(3, 'Rusiru Dananga', 'Negombo House', '453', 'Negombo', '0762330036', 1, 0, '2022-09-13 12:52:41', '2022-09-13 12:52:41', 6),
(4, 'Jude Stephen', 'Stephen Innovations', '001', 'Negombo', '0774327733', 1, 0, '2022-09-13 12:53:15', '2022-09-13 12:53:15', 6);

-- --------------------------------------------------------

--
-- Table structure for table `customer_settlements`
--

CREATE TABLE `customer_settlements` (
  `id` int(11) NOT NULL,
  `debit_amount` decimal(8,2) DEFAULT NULL,
  `credit_amount` decimal(8,2) DEFAULT NULL,
  `balance_amount` decimal(8,2) DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `orders_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_settlements`
--

INSERT INTO `customer_settlements` (`id`, `debit_amount`, `credit_amount`, `balance_amount`, `date`, `created_at`, `updated_at`, `customers_id`, `orders_id`) VALUES
(33, NULL, '909.00', '909.00', '2022-09-13', '2022-09-13 12:59:18', '2022-09-13 12:59:18', 3, 64);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `vehicle_no` varchar(10) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `telephone`, `vehicle_no`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(2, 'Ishara Induranga', 'ishara@gmail.com', '0715160131', 'UK-9894', 1, 0, '2022-09-13 12:49:41', '2022-09-13 12:49:41', 6),
(3, 'Yesh Adithya', 'adi@gmail.com', '0312236285', 'JK-8767', 1, 0, '2022-09-13 12:50:09', '2022-09-13 12:50:09', 6);

-- --------------------------------------------------------

--
-- Table structure for table `driver_settlements`
--

CREATE TABLE `driver_settlements` (
  `id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `drivers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` text,
  `image` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `image`, `quantity`, `price`, `active`, `deleted`, `created_at`, `updated_at`, `categories_id`, `users_id`) VALUES
(15, 'Sausage Pizza', 'Sausage, Cheese, Garlick', '1663053377_63202e413b887.jpeg', 10, '500.00', 1, 0, '2022-09-13 12:46:18', '2022-09-13 19:50:03', 19, 6),
(16, 'Chicken Burger', 'Chicken, Tomato, Cheese', '1663053461_63202e955dd17.jpeg', 20, '400.00', 1, 0, '2022-09-13 12:47:41', '2022-09-13 12:47:41', 20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `items_has_add_ons`
--

CREATE TABLE `items_has_add_ons` (
  `id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `items_id` int(11) NOT NULL,
  `add_ons_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_has_add_ons`
--

INSERT INTO `items_has_add_ons` (`id`, `active`, `deleted`, `created_at`, `updated_at`, `items_id`, `add_ons_id`, `users_id`) VALUES
(2, 1, 0, '2022-09-13 12:47:00', '2022-09-13 12:47:00', 15, 6, 6),
(3, 1, 0, '2022-09-13 12:47:57', '2022-09-13 12:47:57', 16, 6, 6),
(4, 1, 0, '2022-09-13 12:48:08', '2022-09-13 12:48:08', 16, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `items_has_sizes`
--

CREATE TABLE `items_has_sizes` (
  `id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sizes_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items_has_sizes`
--

INSERT INTO `items_has_sizes` (`id`, `active`, `deleted`, `created_at`, `updated_at`, `sizes_id`, `items_id`, `users_id`) VALUES
(7, 1, 0, '2022-09-13 12:48:24', '2022-09-13 12:48:24', 4, 15, 6),
(8, 1, 0, '2022-09-13 12:48:29', '2022-09-13 12:48:29', 5, 15, 6),
(9, 1, 0, '2022-09-13 12:48:35', '2022-09-13 12:48:35', 6, 15, 6),
(10, 1, 0, '2022-09-13 12:48:44', '2022-09-13 12:48:44', 4, 16, 6),
(11, 1, 0, '2022-09-13 12:48:49', '2022-09-13 12:48:49', 5, 16, 6),
(12, 1, 0, '2022-09-13 12:48:54', '2022-09-13 12:48:54', 6, 16, 6);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '1 for completed, 2 for canceled',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tables_id` int(11) DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `payment_types_id` int(11) DEFAULT NULL,
  `order_types_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `subtotal`, `status`, `created_at`, `updated_at`, `tables_id`, `users_id`, `customers_id`, `payment_types_id`, `order_types_id`) VALUES
(64, '909.00', 1, '2022-09-13 12:59:18', '2022-09-13 13:05:54', NULL, 6, 3, 3, 3),
(65, '508.00', 1, '2022-09-13 12:59:56', '2022-09-13 13:04:47', 3, 6, 4, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_assigned_drivers`
--

CREATE TABLE `orders_assigned_drivers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `orders_id` int(11) NOT NULL,
  `drivers_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_assigned_drivers`
--

INSERT INTO `orders_assigned_drivers` (`id`, `created_at`, `updated_at`, `orders_id`, `drivers_id`) VALUES
(49, '2022-09-13 12:59:18', '2022-09-13 12:59:18', 64, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `completed` int(11) NOT NULL DEFAULT '0' COMMENT '1 for completed',
  `canceled` int(11) NOT NULL DEFAULT '0' COMMENT '1 for canceled',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `items_id` int(11) NOT NULL,
  `sizes_id` int(11) DEFAULT NULL,
  `orders_id` int(11) NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `quantity`, `price`, `completed`, `canceled`, `deleted`, `created_at`, `updated_at`, `items_id`, `sizes_id`, `orders_id`, `users_id`) VALUES
(71, 1, '502.00', 1, 0, 0, '2022-09-13 12:59:18', '2022-09-13 13:05:54', 15, 4, 64, 6),
(72, 1, '407.00', 1, 0, 0, '2022-09-13 12:59:18', '2022-09-13 13:05:54', 16, 5, 64, 6),
(73, 1, '508.00', 1, 0, 0, '2022-09-13 12:59:56', '2022-09-13 13:04:47', 15, 6, 65, 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_items_has_add_ons`
--

CREATE TABLE `order_items_has_add_ons` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `order_items_id` int(11) NOT NULL,
  `add_ons_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items_has_add_ons`
--

INSERT INTO `order_items_has_add_ons` (`id`, `created_at`, `updated_at`, `order_items_id`, `add_ons_id`) VALUES
(24, '2022-09-13 12:59:18', '2022-09-13 12:59:18', 72, 6),
(25, '2022-09-13 12:59:56', '2022-09-13 12:59:56', 73, 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_types`
--

CREATE TABLE `order_types` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_types`
--

INSERT INTO `order_types` (`id`, `name`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'Dine In', 1, 0, '2022-06-05 20:55:23', '2022-06-05 20:55:23'),
(2, 'Take Away', 1, 0, '2022-06-05 20:55:23', '2022-06-05 20:55:23'),
(3, 'Delivery', 1, 0, '2022-06-05 20:55:37', '2022-06-05 20:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, '2022-06-05 20:53:49', '2022-06-05 20:53:49'),
(2, 'Card', 1, '2022-06-05 20:53:49', '2022-06-05 20:53:49'),
(3, 'Credit', 1, '2022-06-05 20:54:34', '2022-06-05 20:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_times`
--

CREATE TABLE `reservation_times` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_times`
--

INSERT INTO `reservation_times` (`id`, `time`, `active`, `deleted`, `created_at`, `updated_at`) VALUES
(16, '01:00:00', 0, 0, '2022-06-28 14:09:59', '2022-06-28 14:09:59'),
(17, '02:00:00', 0, 0, '2022-06-28 17:46:06', '2022-06-28 17:46:12'),
(18, '03:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(19, '04:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(20, '05:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(21, '06:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(22, '07:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(23, '08:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(24, '09:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(25, '10:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(26, '11:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(27, '12:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(28, '13:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(29, '14:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(30, '15:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(31, '16:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(32, '17:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(33, '18:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(34, '19:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(35, '20:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(36, '21:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(37, '22:00:00', 1, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(38, '23:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40'),
(39, '24:00:00', 0, 0, '2022-06-28 17:46:37', '2022-06-28 17:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `adding_price` decimal(8,2) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `adding_price`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(4, 'Small', '2.00', 1, 0, '2022-06-05 22:23:14', '2022-06-05 22:24:12', 6),
(5, 'Medium', '4.00', 1, 0, '2022-06-05 22:23:25', '2022-06-05 22:23:25', 6),
(6, 'Large', '5.00', 1, 0, '2022-06-05 22:23:36', '2022-06-05 22:23:36', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `pax_count` int(11) DEFAULT NULL COMMENT 'customer count of the table can hold',
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `name`, `pax_count`, `active`, `deleted`, `created_at`, `updated_at`, `users_id`) VALUES
(3, 'Table1', 4, 1, 0, '2022-06-05 22:24:56', '2022-06-05 22:26:58', 6),
(4, 'Table2', 4, 1, 0, '2022-06-05 22:25:05', '2022-06-05 22:25:05', 6),
(5, 'Table3', 8, 1, 0, '2022-06-05 22:25:14', '2022-06-05 22:25:14', 6),
(6, 'Table4', 8, 1, 0, '2022-06-05 22:25:35', '2022-06-05 22:25:35', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tables_has_reservation_times`
--

CREATE TABLE `tables_has_reservation_times` (
  `reservation` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active',
  `deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1 for deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `tables_id` int(11) NOT NULL,
  `reservation_times_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Rusiru Dananga', 'russ@gmail.com', NULL, '$2y$10$fd/eREK5HMNstg09TOm0v.56N6.nkIfxyHeOBbB.D8Rg5t94oxb16', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_add_ons_users1_idx` (`users_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_users1_idx` (`users_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customers_users1_idx` (`users_id`);

--
-- Indexes for table `customer_settlements`
--
ALTER TABLE `customer_settlements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_settlements_customers1_idx` (`customers_id`),
  ADD KEY `fk_customer_settlements_orders1_idx` (`orders_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_drivers_users1_idx` (`users_id`);

--
-- Indexes for table `driver_settlements`
--
ALTER TABLE `driver_settlements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_driver_settlements_drivers1_idx` (`drivers_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_categories_idx` (`categories_id`),
  ADD KEY `fk_items_users1_idx` (`users_id`);

--
-- Indexes for table `items_has_add_ons`
--
ALTER TABLE `items_has_add_ons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_has_add_ons_items1_idx` (`items_id`),
  ADD KEY `fk_items_has_add_ons_add_ons1_idx` (`add_ons_id`),
  ADD KEY `fk_items_has_add_ons_users1_idx` (`users_id`);

--
-- Indexes for table `items_has_sizes`
--
ALTER TABLE `items_has_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_has_sizes_sizes1_idx` (`sizes_id`),
  ADD KEY `fk_items_has_sizes_items1_idx` (`items_id`),
  ADD KEY `fk_items_has_sizes_users1_idx` (`users_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_tables1_idx` (`tables_id`),
  ADD KEY `fk_orders_users1_idx` (`users_id`),
  ADD KEY `fk_orders_customers1_idx` (`customers_id`),
  ADD KEY `fk_orders_payment_types1_idx` (`payment_types_id`),
  ADD KEY `fk_orders_order_types1_idx` (`order_types_id`);

--
-- Indexes for table `orders_assigned_drivers`
--
ALTER TABLE `orders_assigned_drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_assigned_drivers_orders1_idx` (`orders_id`),
  ADD KEY `fk_orders_assigned_drivers_drivers1_idx` (`drivers_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_items_items1_idx` (`items_id`),
  ADD KEY `fk_cart_items_sizes1_idx` (`sizes_id`),
  ADD KEY `fk_order_items_orders1_idx` (`orders_id`),
  ADD KEY `fk_order_items_users1_idx` (`users_id`);

--
-- Indexes for table `order_items_has_add_ons`
--
ALTER TABLE `order_items_has_add_ons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_items_has_add_ons_order_items1_idx` (`order_items_id`),
  ADD KEY `fk_order_items_has_add_ons_add_ons1_idx` (`add_ons_id`);

--
-- Indexes for table `order_types`
--
ALTER TABLE `order_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_times`
--
ALTER TABLE `reservation_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sizes_users1_idx` (`users_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tables_users1_idx` (`users_id`);

--
-- Indexes for table `tables_has_reservation_times`
--
ALTER TABLE `tables_has_reservation_times`
  ADD KEY `fk_tables_has_reservation_times_tables1_idx` (`tables_id`),
  ADD KEY `fk_tables_has_reservation_times_reservation_times1_idx` (`reservation_times_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_settlements`
--
ALTER TABLE `customer_settlements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_settlements`
--
ALTER TABLE `driver_settlements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items_has_add_ons`
--
ALTER TABLE `items_has_add_ons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items_has_sizes`
--
ALTER TABLE `items_has_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `orders_assigned_drivers`
--
ALTER TABLE `orders_assigned_drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `order_items_has_add_ons`
--
ALTER TABLE `order_items_has_add_ons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_types`
--
ALTER TABLE `order_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_times`
--
ALTER TABLE `reservation_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_ons`
--
ALTER TABLE `add_ons`
  ADD CONSTRAINT `fk_add_ons_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customers_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer_settlements`
--
ALTER TABLE `customer_settlements`
  ADD CONSTRAINT `fk_customer_settlements_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_settlements_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `fk_drivers_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `driver_settlements`
--
ALTER TABLE `driver_settlements`
  ADD CONSTRAINT `fk_driver_settlements_drivers1` FOREIGN KEY (`drivers_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items_has_add_ons`
--
ALTER TABLE `items_has_add_ons`
  ADD CONSTRAINT `fk_items_has_add_ons_add_ons1` FOREIGN KEY (`add_ons_id`) REFERENCES `add_ons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_add_ons_items1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_add_ons_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items_has_sizes`
--
ALTER TABLE `items_has_sizes`
  ADD CONSTRAINT `fk_items_has_sizes_items1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_sizes_sizes1` FOREIGN KEY (`sizes_id`) REFERENCES `sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_has_sizes_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_order_types1` FOREIGN KEY (`order_types_id`) REFERENCES `order_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_payment_types1` FOREIGN KEY (`payment_types_id`) REFERENCES `payment_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_tables1` FOREIGN KEY (`tables_id`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders_assigned_drivers`
--
ALTER TABLE `orders_assigned_drivers`
  ADD CONSTRAINT `fk_orders_assigned_drivers_drivers1` FOREIGN KEY (`drivers_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_assigned_drivers_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_cart_items_items1` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cart_items_sizes1` FOREIGN KEY (`sizes_id`) REFERENCES `sizes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items_has_add_ons`
--
ALTER TABLE `order_items_has_add_ons`
  ADD CONSTRAINT `fk_order_items_has_add_ons_add_ons1` FOREIGN KEY (`add_ons_id`) REFERENCES `add_ons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_items_has_add_ons_order_items1` FOREIGN KEY (`order_items_id`) REFERENCES `order_items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `fk_sizes_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tables`
--
ALTER TABLE `tables`
  ADD CONSTRAINT `fk_tables_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tables_has_reservation_times`
--
ALTER TABLE `tables_has_reservation_times`
  ADD CONSTRAINT `fk_tables_has_reservation_times_reservation_times1` FOREIGN KEY (`reservation_times_id`) REFERENCES `reservation_times` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tables_has_reservation_times_tables1` FOREIGN KEY (`tables_id`) REFERENCES `tables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
