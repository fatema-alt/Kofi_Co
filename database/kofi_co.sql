-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2026 at 04:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kofi_co`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `current_stock` decimal(10,2) DEFAULT 0.00,
  `low_stock_alert` decimal(10,2) DEFAULT 0.00,
  `cost_per_unit` decimal(10,2) DEFAULT 0.00,
  `expiry_date` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `unit_id`, `current_stock`, `low_stock_alert`, `cost_per_unit`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Chicken', 2, 34.80, 5.00, 320.00, '2026-10-05', 'active', '2026-04-27 19:30:01', '2026-04-29 05:44:24'),
(14, 'Potato', 2, 54.00, 10.00, 49.99, '2026-05-20', 'active', '2026-04-27 19:30:43', '2026-04-28 18:03:07'),
(15, 'Coffee Beans', 2, 10.52, 3.00, 899.99, '2026-06-01', 'active', '2026-04-27 19:31:12', '2026-04-29 08:11:14'),
(16, 'Milk', 4, 3.80, 5.00, 80.00, '2026-05-05', 'active', '2026-04-27 19:31:43', '2026-04-29 05:44:24'),
(17, 'Burger Bun', 1, 51.00, 15.00, 15.00, '2026-05-07', 'active', '2026-04-27 19:32:20', '2026-04-29 05:44:24'),
(18, ' Cheese Slice', 1, 41.00, 10.00, 20.00, '2026-05-15', 'active', '2026-04-27 19:33:01', '2026-04-29 05:44:24'),
(19, 'Cooking Oil', 4, 16.69, 3.00, 180.00, '2026-08-01', 'active', '2026-04-27 19:34:01', '2026-04-29 05:44:24'),
(20, 'Beef', 2, 19.10, 5.00, 600.00, '2026-08-01', 'active', '2026-04-28 04:30:26', '2026-04-29 05:44:24'),
(21, 'suger', 2, 19.38, 3.00, 50.00, '2026-06-05', 'active', '2026-04-28 04:41:07', '2026-04-29 05:44:24'),
(22, 'Lettuce', 2, 9.82, 2.00, 50.00, '2026-05-21', 'active', '2026-04-28 04:45:29', '2026-04-29 05:44:24'),
(23, 'Sauce', 2, 19.76, 5.00, 100.00, '2026-06-01', 'active', '2026-04-28 04:46:16', '2026-04-29 05:44:24'),
(24, 'Salt', 2, 7.75, 2.00, 40.00, '2026-08-01', 'active', '2026-04-28 04:46:51', '2026-04-28 18:03:07'),
(25, 'Lemon', 2, 9.75, 2.00, 80.00, '2026-05-15', 'active', '2026-04-28 04:48:23', '2026-04-28 18:03:07'),
(26, 'Flour', 2, 19.50, 5.00, 80.00, '2026-07-30', 'active', '2026-04-28 04:49:22', '2026-04-29 05:44:24'),
(27, 'Egg', 1, 94.00, 10.00, 15.00, '2026-08-30', 'active', '2026-04-28 04:50:07', '2026-04-29 05:01:43'),
(28, 'Cocoa Powder', 2, 11999.96, 3.00, 50.00, '2026-10-12', 'active', '2026-04-28 04:50:54', '2026-04-29 05:01:43'),
(29, 'Butter', 2, 14.85, 2.00, 500.00, '2026-12-01', 'active', '2026-04-28 04:51:35', '2026-04-29 05:01:43'),
(30, 'Cream', 4, 9.70, 2.00, 300.00, '2026-08-13', 'active', '2026-04-28 04:52:17', '2026-04-28 18:03:07'),
(31, 'Ice', 2, 9.55, 2.00, 20.00, '2026-06-02', 'active', '2026-04-28 04:57:23', '2026-04-29 05:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Burgers', 'Juicy, flavorful burgers made fresh to order.', '1777303421_12d833e60a8d75bc18c3.jpg', 1, '2026-04-27 20:26:50', '2026-04-27 15:23:41'),
(2, 'Drinks', 'Refreshing cold beverages for every mood.', '1777303401_6d5af5176263d10f9cbb.jpg', 1, '2026-04-27 20:26:50', '2026-04-27 15:23:21'),
(3, 'Snacks', 'Quick bites and light treats for any time of day.', '1777303310_3086a7814ff69da0882e.jpg', 1, '2026-04-27 20:26:50', '2026-04-27 15:21:50'),
(4, 'Desserts', 'Sweet indulgences to satisfy your cravings.', '1777302678_489fad1bf719575cd411.png', 1, '2026-04-27 20:26:50', '2026-04-27 15:11:18'),
(5, 'Coffee', 'Rich and aromatic coffee crafted to perfection.', '1777303489_63a892e7608eca926670.jpg', 1, '2026-04-27 15:24:49', '2026-04-29 05:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT 'available',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `category_id`, `price`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Chicken Burger', 1, 180.00, '1777304823_9c3e2a603271c1dee20c.jpg', 'Grilled chicken patty with lettuce and mayo', 'available', '2026-04-27 15:47:03', '2026-04-27 15:47:03'),
(5, ' Beef Burger', 1, 220.00, '1777304897_54cbab5760c98ba13125.jpg', 'Juicy beef patty with cheese and sauce', 'available', '2026-04-27 15:48:17', '2026-04-27 15:48:17'),
(6, 'Cold Coffee', 2, 120.00, '1777304987_26b8d375c55521cc11ec.jpg', 'Chilled creamy coffee with ice', 'available', '2026-04-27 15:49:47', '2026-04-27 15:49:47'),
(7, 'Lemonade', 2, 90.00, '1777305052_098074a02ddc16b2030d.jpg', 'Fresh lemon juice with mint', 'available', '2026-04-27 15:50:52', '2026-04-27 15:50:52'),
(8, 'French Fries', 3, 100.00, '1777305132_0d4452ff64c250b05202.jpg', ' Crispy golden potato fries', 'available', '2026-04-27 15:52:12', '2026-04-27 20:02:09'),
(9, ' Crispy golden potato fries', 3, 160.00, '1777305185_f9db740c54f10d5041a4.jpg', 'Fried chicken bites with dip', 'available', '2026-04-27 15:53:05', '2026-04-27 15:53:05'),
(10, 'Chocolate Cake', 4, 200.00, '1777305286_4c311068fe92112fed86.jpg', 'Rich chocolate layered cake', 'available', '2026-04-27 15:53:56', '2026-04-27 15:54:46'),
(11, 'Ice Cream', 4, 80.00, '1777305346_6fffdbf47b7312d3f5ff.jpg', 'Vanilla ice cream scoop', 'available', '2026-04-27 15:55:46', '2026-04-27 15:55:46'),
(12, 'Espresso', 5, 90.00, '1777305466_eb105174bb42078732c3.jpg', 'Strong and rich black coffee shot', 'available', '2026-04-27 15:57:12', '2026-04-27 15:57:46'),
(13, 'Cappuccino', 5, 150.00, '1777305518_35c8b23071d36f590efe.jpg', 'Espresso with steamed milk and foam', 'available', '2026-04-27 15:58:38', '2026-04-27 15:58:38'),
(14, 'Latte', 5, 160.00, '1777305577_ca9a6f79da26aba6605c.jpg', 'Smooth espresso with creamy milk', 'available', '2026-04-27 15:59:37', '2026-04-27 20:01:45'),
(15, 'Americano', 5, 120.00, '1777305666_9647efdd64f2a92c3586.jpg', 'Espresso diluted with hot water', 'available', '2026-04-27 16:01:06', '2026-04-27 16:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `customer_name` varchar(100) DEFAULT 'Walk-in Customer',
  `order_type` enum('dine_in','takeaway','delivery') DEFAULT 'takeaway',
  `subtotal` decimal(10,2) DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `tax` decimal(10,2) DEFAULT 0.00,
  `service_charge` decimal(10,2) DEFAULT 0.00,
  `grand_total` decimal(10,2) DEFAULT 0.00,
  `status` enum('pending','preparing','ready','served','paid','cancelled') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','partial') DEFAULT 'unpaid',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `customer_name`, `order_type`, `subtotal`, `discount`, `tax`, `service_charge`, `grand_total`, `status`, `payment_status`, `created_by`, `created_at`, `updated_at`) VALUES
(43, 'ORD-APR-001', 'Walk-in Customer', 'takeaway', 300.00, 0.00, 0.00, 0.00, 300.00, 'paid', 'paid', 7, '2026-04-01 11:20:00', NULL),
(44, 'ORD-APR-002', 'Walk-in Customer', 'takeaway', 420.00, 0.00, 0.00, 0.00, 420.00, 'paid', 'paid', 7, '2026-04-03 14:10:00', NULL),
(45, 'ORD-APR-003', 'Walk-in Customer', 'takeaway', 260.00, 0.00, 0.00, 0.00, 260.00, 'paid', 'paid', 7, '2026-04-06 17:30:00', NULL),
(46, 'ORD-APR-004', 'Walk-in Customer', 'takeaway', 540.00, 0.00, 0.00, 0.00, 540.00, 'paid', 'paid', 7, '2026-04-10 13:45:00', NULL),
(47, 'ORD-APR-005', 'Walk-in Customer', 'takeaway', 390.00, 0.00, 0.00, 0.00, 390.00, 'paid', 'paid', 7, '2026-04-14 18:20:00', NULL),
(48, 'ORD-APR-006', 'Walk-in Customer', 'takeaway', 720.00, 0.00, 0.00, 0.00, 720.00, 'paid', 'paid', 7, '2026-04-18 19:15:00', NULL),
(49, 'ORD-APR-007', 'Walk-in Customer', 'takeaway', 480.00, 0.00, 0.00, 0.00, 480.00, 'paid', 'paid', 7, '2026-04-22 12:40:00', NULL),
(50, 'ORD-APR-008', 'Walk-in Customer', 'takeaway', 650.00, 0.00, 0.00, 0.00, 650.00, 'paid', 'paid', 7, '2026-04-25 16:50:00', NULL),
(51, 'ORD-APR-009', 'Walk-in Customer', 'takeaway', 510.00, 0.00, 0.00, 0.00, 510.00, 'paid', 'paid', 7, '2026-04-27 20:05:00', NULL),
(52, 'ORD-APR-010', 'Walk-in Customer', 'takeaway', 850.00, 0.00, 0.00, 0.00, 850.00, 'paid', 'paid', 7, '2026-04-28 15:25:00', NULL),
(53, 'ORD-20260428074757', 'Walk-in Customer', 'takeaway', 740.00, 0.00, 0.00, 0.00, 740.00, 'paid', 'paid', 7, '2026-04-28 07:47:57', NULL),
(54, 'ORD-20260428083933', 'Walk-in Customer', 'takeaway', 310.00, 0.00, 0.00, 0.00, 310.00, 'paid', 'paid', 7, '2026-04-28 08:39:33', NULL),
(55, 'ORD-20260428090758', 'Walk-in Customer', 'takeaway', 480.00, 0.00, 0.00, 0.00, 480.00, 'paid', 'paid', 7, '2026-04-28 09:07:58', NULL),
(56, 'ORD-20260428133710', 'Walk-in Customer', 'takeaway', 240.00, 24.00, 7.20, 24.00, 247.20, 'paid', 'paid', 9, '2026-04-28 13:37:10', NULL),
(57, 'ORD-20260428180307', 'Walk-in Customer', 'takeaway', 3480.00, 1740.00, 104.40, 348.00, 2192.40, 'paid', 'paid', 1, '2026-04-28 18:03:07', NULL),
(58, 'ORD-20260429050143', 'Walk-in Customer', 'takeaway', 320.00, 16.00, 9.60, 32.00, 345.60, 'paid', 'paid', 1, '2026-04-29 05:01:43', NULL),
(59, 'ORD-20260429054424', 'Walk-in Customer', 'takeaway', 500.00, 10.00, 15.00, 50.00, 555.00, 'paid', 'paid', 1, '2026-04-29 05:44:24', NULL),
(60, 'ORD-20260429081114', 'Walk-in Customer', 'takeaway', 120.00, 18.00, 3.60, 12.00, 117.60, 'paid', 'paid', 1, '2026-04-29 08:11:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_item_id`, `quantity`, `price`, `total`, `note`, `created_at`) VALUES
(55, 43, 4, 1, 180.00, 180.00, NULL, '2026-04-01 11:20:00'),
(56, 43, 6, 1, 120.00, 120.00, NULL, '2026-04-01 11:20:00'),
(57, 44, 5, 1, 220.00, 220.00, NULL, '2026-04-03 14:10:00'),
(58, 44, 10, 1, 200.00, 200.00, NULL, '2026-04-03 14:10:00'),
(59, 45, 8, 1, 100.00, 100.00, NULL, '2026-04-06 17:30:00'),
(60, 45, 9, 1, 160.00, 160.00, NULL, '2026-04-06 17:30:00'),
(61, 46, 4, 2, 180.00, 360.00, NULL, '2026-04-10 13:45:00'),
(62, 46, 6, 1, 120.00, 120.00, NULL, '2026-04-10 13:45:00'),
(63, 46, 7, 1, 60.00, 60.00, NULL, '2026-04-10 13:45:00'),
(64, 47, 12, 1, 90.00, 90.00, NULL, '2026-04-14 18:20:00'),
(65, 47, 13, 2, 150.00, 300.00, NULL, '2026-04-14 18:20:00'),
(66, 48, 5, 2, 220.00, 440.00, NULL, '2026-04-18 19:15:00'),
(67, 48, 10, 1, 200.00, 200.00, NULL, '2026-04-18 19:15:00'),
(68, 48, 11, 1, 80.00, 80.00, NULL, '2026-04-18 19:15:00'),
(69, 49, 9, 2, 160.00, 320.00, NULL, '2026-04-22 12:40:00'),
(70, 49, 6, 1, 120.00, 120.00, NULL, '2026-04-22 12:40:00'),
(71, 49, 12, 1, 40.00, 40.00, NULL, '2026-04-22 12:40:00'),
(72, 50, 4, 1, 180.00, 180.00, NULL, '2026-04-25 16:50:00'),
(73, 50, 5, 1, 220.00, 220.00, NULL, '2026-04-25 16:50:00'),
(74, 50, 13, 1, 150.00, 150.00, NULL, '2026-04-25 16:50:00'),
(75, 50, 8, 1, 100.00, 100.00, NULL, '2026-04-25 16:50:00'),
(76, 51, 14, 2, 160.00, 320.00, NULL, '2026-04-27 20:05:00'),
(77, 51, 7, 1, 90.00, 90.00, NULL, '2026-04-27 20:05:00'),
(78, 51, 11, 1, 100.00, 100.00, NULL, '2026-04-27 20:05:00'),
(79, 52, 4, 2, 180.00, 360.00, NULL, '2026-04-28 15:25:00'),
(80, 52, 5, 1, 220.00, 220.00, NULL, '2026-04-28 15:25:00'),
(81, 52, 10, 1, 200.00, 200.00, NULL, '2026-04-28 15:25:00'),
(82, 52, 15, 1, 70.00, 70.00, NULL, '2026-04-28 15:25:00'),
(86, 53, 13, 2, 150.00, 300.00, NULL, '2026-04-28 07:47:57'),
(87, 53, 14, 2, 160.00, 320.00, NULL, '2026-04-28 07:47:57'),
(88, 53, 15, 1, 120.00, 120.00, NULL, '2026-04-28 07:47:57'),
(89, 54, 13, 1, 150.00, 150.00, NULL, '2026-04-28 08:39:33'),
(90, 54, 14, 1, 160.00, 160.00, NULL, '2026-04-28 08:39:33'),
(91, 55, 15, 2, 120.00, 240.00, NULL, '2026-04-28 09:07:58'),
(92, 55, 14, 1, 160.00, 160.00, NULL, '2026-04-28 09:07:58'),
(93, 55, 11, 1, 80.00, 80.00, NULL, '2026-04-28 09:07:58'),
(94, 56, 13, 1, 150.00, 150.00, NULL, '2026-04-28 13:37:10'),
(95, 56, 12, 1, 90.00, 90.00, NULL, '2026-04-28 13:37:10'),
(96, 57, 7, 4, 90.00, 360.00, NULL, '2026-04-28 18:03:07'),
(97, 57, 8, 4, 100.00, 400.00, NULL, '2026-04-28 18:03:07'),
(98, 57, 5, 3, 220.00, 660.00, NULL, '2026-04-28 18:03:07'),
(99, 57, 4, 3, 180.00, 540.00, NULL, '2026-04-28 18:03:07'),
(100, 57, 6, 2, 120.00, 240.00, NULL, '2026-04-28 18:03:07'),
(101, 57, 9, 3, 160.00, 480.00, NULL, '2026-04-28 18:03:07'),
(102, 57, 10, 1, 200.00, 200.00, NULL, '2026-04-28 18:03:07'),
(103, 57, 11, 1, 80.00, 80.00, NULL, '2026-04-28 18:03:07'),
(104, 57, 12, 1, 90.00, 90.00, NULL, '2026-04-28 18:03:07'),
(105, 57, 15, 1, 120.00, 120.00, NULL, '2026-04-28 18:03:07'),
(106, 57, 14, 1, 160.00, 160.00, NULL, '2026-04-28 18:03:07'),
(107, 57, 13, 1, 150.00, 150.00, NULL, '2026-04-28 18:03:07'),
(108, 58, 15, 1, 120.00, 120.00, NULL, '2026-04-29 05:01:43'),
(109, 58, 10, 1, 200.00, 200.00, NULL, '2026-04-29 05:01:43'),
(110, 59, 6, 1, 120.00, 120.00, NULL, '2026-04-29 05:44:24'),
(111, 59, 5, 1, 220.00, 220.00, NULL, '2026-04-29 05:44:24'),
(112, 59, 9, 1, 160.00, 160.00, NULL, '2026-04-29 05:44:24'),
(113, 60, 15, 1, 120.00, 120.00, NULL, '2026-04-29 08:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_method_id`, `amount`, `paid_at`) VALUES
(37, 43, 5, 300.00, '2026-04-01 11:20:00'),
(38, 44, 5, 420.00, '2026-04-03 14:10:00'),
(39, 45, 5, 260.00, '2026-04-06 17:30:00'),
(40, 46, 5, 540.00, '2026-04-10 13:45:00'),
(41, 47, 5, 390.00, '2026-04-14 18:20:00'),
(42, 48, 5, 720.00, '2026-04-18 19:15:00'),
(43, 49, 5, 480.00, '2026-04-22 12:40:00'),
(44, 50, 5, 650.00, '2026-04-25 16:50:00'),
(45, 51, 5, 510.00, '2026-04-27 20:05:00'),
(46, 52, 5, 850.00, '2026-04-28 15:25:00'),
(52, 53, 5, 740.00, '2026-04-28 07:47:57'),
(53, 54, 5, 350.30, '2026-04-28 08:39:33'),
(54, 55, 5, 542.40, '2026-04-28 09:07:58'),
(55, 56, 6, 271.20, '2026-04-28 13:37:10'),
(56, 57, 7, 3932.40, '2026-04-28 18:03:07'),
(57, 58, 7, 361.60, '2026-04-29 05:01:43'),
(58, 59, 8, 565.00, '2026-04-29 05:44:24'),
(59, 60, 5, 135.60, '2026-04-29 08:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `created_at`) VALUES
(5, 'Cash', 'active', '2026-04-28 12:52:14'),
(6, 'Card', 'active', '2026-04-28 12:52:14'),
(7, 'bKash', 'active', '2026-04-28 12:52:14'),
(8, 'Nagad', 'active', '2026-04-28 12:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_items`
--

CREATE TABLE `recipe_items` (
  `id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_items`
--

INSERT INTO `recipe_items` (`id`, `menu_item_id`, `ingredient_id`, `quantity`, `unit_id`, `created_at`) VALUES
(2, 14, 16, 0.20, 4, '2026-04-27 20:15:09'),
(3, 14, 15, 0.02, 2, '2026-04-27 20:15:25'),
(4, 8, 14, 0.20, 2, '2026-04-27 20:15:55'),
(5, 8, 19, 0.03, 4, '2026-04-27 20:16:04'),
(6, 4, 13, 0.15, 2, '2026-04-27 20:16:35'),
(7, 4, 17, 1.00, 1, '2026-04-27 20:16:42'),
(8, 4, 18, 1.00, 1, '2026-04-27 20:16:58'),
(9, 4, 22, 0.02, 2, '2026-04-28 04:54:05'),
(10, 4, 23, 0.02, 4, '2026-04-28 04:54:20'),
(11, 5, 20, 0.18, 2, '2026-04-28 04:54:37'),
(12, 5, 17, 1.00, 1, '2026-04-28 04:54:44'),
(13, 5, 18, 1.00, 1, '2026-04-28 04:54:53'),
(14, 5, 22, 0.02, 2, '2026-04-28 04:55:11'),
(15, 5, 23, 0.02, 4, '2026-04-28 04:55:31'),
(16, 6, 15, 0.02, 2, '2026-04-28 04:56:11'),
(17, 6, 16, 0.20, 4, '2026-04-28 04:56:25'),
(18, 6, 21, 0.02, 2, '2026-04-28 04:56:36'),
(19, 6, 31, 0.05, 2, '2026-04-28 04:57:45'),
(20, 7, 25, 0.05, 2, '2026-04-28 04:58:03'),
(21, 7, 21, 0.03, 2, '2026-04-28 04:58:14'),
(22, 7, 31, 0.05, 2, '2026-04-28 04:58:29'),
(23, 8, 24, 0.05, 2, '2026-04-28 04:58:59'),
(24, 9, 13, 0.15, 2, '2026-04-28 04:59:37'),
(25, 9, 26, 0.05, 2, '2026-04-28 04:59:44'),
(26, 9, 19, 0.04, 4, '2026-04-28 04:59:56'),
(27, 9, 23, 0.02, 2, '2026-04-28 05:00:06'),
(28, 10, 26, 0.10, 2, '2026-04-28 05:00:22'),
(29, 10, 21, 0.08, 2, '2026-04-28 05:00:33'),
(30, 10, 27, 2.00, 1, '2026-04-28 05:00:43'),
(31, 10, 28, 0.02, 2, '2026-04-28 05:00:52'),
(32, 10, 29, 0.05, 2, '2026-04-28 05:01:06'),
(33, 11, 16, 0.25, 4, '2026-04-28 05:01:23'),
(34, 11, 21, 0.05, 2, '2026-04-28 05:01:31'),
(35, 11, 30, 0.10, 4, '2026-04-28 05:01:44'),
(36, 13, 15, 0.02, 2, '2026-04-28 05:02:06'),
(37, 13, 16, 0.15, 4, '2026-04-28 05:02:17'),
(38, 12, 15, 0.02, 2, '2026-04-28 05:02:36'),
(39, 15, 15, 0.02, 2, '2026-04-28 05:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Full access', '2026-04-27 09:38:23', NULL),
(2, 'Manager', 'Manage sales, inventory and reports', '2026-04-27 09:38:23', NULL),
(3, 'Cashier', 'Use POS and handle payments', '2026-04-27 09:38:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `restaurant_name` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `currency` varchar(20) DEFAULT '৳',
  `tax_percent` decimal(5,2) DEFAULT 0.00,
  `service_charge` decimal(5,2) DEFAULT 0.00,
  `receipt_footer` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `restaurant_name`, `phone`, `email`, `address`, `currency`, `tax_percent`, `service_charge`, `receipt_footer`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Kofi Co.', '01700000000', 'info@kofico.com', 'Dhaka, Bangladesh', '৳', 3.00, 10.00, 'Thank you for visiting Kofi Co.', '1777441549_d1e4e645f514018dc03f.png', '2026-04-28 13:27:59', '2026-04-29 05:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `type` enum('purchase','sale','waste','adjustment_in','adjustment_out','return') NOT NULL,
  `direction` enum('in','out') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `ingredient_id`, `type`, `direction`, `quantity`, `reference_id`, `note`, `created_by`, `created_at`) VALUES
(1, 13, 'purchase', 'in', 10.00, NULL, 'Bought from local supplier', 7, '2026-04-27 19:37:00'),
(2, 14, 'purchase', 'in', 20.00, NULL, 'Weekly stock refill', 7, '2026-04-27 19:37:22'),
(3, 16, 'purchase', 'in', 15.00, NULL, 'Daily fresh milk delivery', 7, '2026-04-27 19:37:42'),
(4, 16, 'waste', 'out', 3.00, NULL, 'Expired milk', 7, '2026-04-27 19:38:05'),
(5, 14, 'waste', 'out', 5.00, NULL, 'Rotten potatoes', 7, '2026-04-27 19:38:35'),
(6, 13, 'adjustment_in', 'in', 2.00, NULL, 'Stock recount correction', 7, '2026-04-27 19:39:00'),
(7, 15, 'adjustment_out', 'out', 1.00, NULL, 'Damaged during storage', 7, '2026-04-27 19:39:19'),
(8, 19, 'return', 'in', 2.00, NULL, 'Returned defective product', 7, '2026-04-27 19:39:38'),
(9, 20, 'sale', 'out', 0.18, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(10, 17, 'sale', 'out', 1.00, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(11, 18, 'sale', 'out', 1.00, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(12, 22, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(13, 23, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(14, 15, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(15, 16, 'sale', 'out', 0.20, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(16, 21, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(17, 31, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(18, 13, 'sale', 'out', 0.15, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(19, 17, 'sale', 'out', 1.00, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(20, 18, 'sale', 'out', 1.00, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(21, 22, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(22, 23, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(23, 14, 'sale', 'out', 0.20, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(24, 19, 'sale', 'out', 0.03, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(25, 24, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(26, 25, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(27, 21, 'sale', 'out', 0.03, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(28, 31, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(29, 16, 'sale', 'out', 0.25, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(30, 21, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(31, 30, 'sale', 'out', 0.10, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(32, 26, 'sale', 'out', 0.10, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(33, 21, 'sale', 'out', 0.08, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(34, 27, 'sale', 'out', 2.00, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(35, 28, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(36, 29, 'sale', 'out', 0.05, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(37, 15, 'sale', 'out', 0.02, 11, 'Auto deducted from order ORD-20260428050420', 7, '2026-04-28 05:04:20'),
(38, 15, 'sale', 'out', 0.04, 53, 'Auto deducted from order ORD-20260428074757', 7, '2026-04-28 07:47:57'),
(39, 16, 'sale', 'out', 0.30, 53, 'Auto deducted from order ORD-20260428074757', 7, '2026-04-28 07:47:57'),
(40, 16, 'sale', 'out', 0.40, 53, 'Auto deducted from order ORD-20260428074757', 7, '2026-04-28 07:47:57'),
(41, 15, 'sale', 'out', 0.04, 53, 'Auto deducted from order ORD-20260428074757', 7, '2026-04-28 07:47:57'),
(42, 15, 'sale', 'out', 0.02, 53, 'Auto deducted from order ORD-20260428074757', 7, '2026-04-28 07:47:57'),
(43, 15, 'sale', 'out', 0.02, 54, 'Auto deducted from order ORD-20260428083933', 7, '2026-04-28 08:39:33'),
(44, 16, 'sale', 'out', 0.15, 54, 'Auto deducted from order ORD-20260428083933', 7, '2026-04-28 08:39:33'),
(45, 16, 'sale', 'out', 0.20, 54, 'Auto deducted from order ORD-20260428083933', 7, '2026-04-28 08:39:33'),
(46, 15, 'sale', 'out', 0.02, 54, 'Auto deducted from order ORD-20260428083933', 7, '2026-04-28 08:39:33'),
(47, 15, 'sale', 'out', 0.04, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(48, 16, 'sale', 'out', 0.20, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(49, 15, 'sale', 'out', 0.02, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(50, 16, 'sale', 'out', 0.25, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(51, 21, 'sale', 'out', 0.05, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(52, 30, 'sale', 'out', 0.10, 55, 'Auto deducted from order ORD-20260428090758', 7, '2026-04-28 09:07:58'),
(53, 15, 'sale', 'out', 0.02, 56, 'Auto deducted from order ORD-20260428133710', 9, '2026-04-28 13:37:10'),
(54, 16, 'sale', 'out', 0.15, 56, 'Auto deducted from order ORD-20260428133710', 9, '2026-04-28 13:37:10'),
(55, 15, 'sale', 'out', 0.02, 56, 'Auto deducted from order ORD-20260428133710', 9, '2026-04-28 13:37:10'),
(56, 25, 'sale', 'out', 0.20, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(57, 21, 'sale', 'out', 0.12, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(58, 31, 'sale', 'out', 0.20, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(59, 14, 'sale', 'out', 0.80, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(60, 19, 'sale', 'out', 0.12, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(61, 24, 'sale', 'out', 0.20, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(62, 20, 'sale', 'out', 0.54, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(63, 17, 'sale', 'out', 3.00, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(64, 18, 'sale', 'out', 3.00, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(65, 22, 'sale', 'out', 0.06, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(66, 23, 'sale', 'out', 0.06, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(67, 13, 'sale', 'out', 0.45, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(68, 17, 'sale', 'out', 3.00, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(69, 18, 'sale', 'out', 3.00, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(70, 22, 'sale', 'out', 0.06, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(71, 23, 'sale', 'out', 0.06, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(72, 15, 'sale', 'out', 0.04, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(73, 16, 'sale', 'out', 0.40, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(74, 21, 'sale', 'out', 0.04, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(75, 31, 'sale', 'out', 0.10, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(76, 13, 'sale', 'out', 0.45, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(77, 26, 'sale', 'out', 0.15, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(78, 19, 'sale', 'out', 0.12, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(79, 23, 'sale', 'out', 0.06, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(80, 26, 'sale', 'out', 0.10, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(81, 21, 'sale', 'out', 0.08, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(82, 27, 'sale', 'out', 2.00, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(83, 28, 'sale', 'out', 0.02, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(84, 29, 'sale', 'out', 0.05, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(85, 16, 'sale', 'out', 0.25, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(86, 21, 'sale', 'out', 0.05, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(87, 30, 'sale', 'out', 0.10, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(88, 15, 'sale', 'out', 0.02, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(89, 15, 'sale', 'out', 0.02, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(90, 16, 'sale', 'out', 0.20, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(91, 15, 'sale', 'out', 0.02, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(92, 15, 'sale', 'out', 0.02, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(93, 16, 'sale', 'out', 0.15, 57, 'Auto deducted from order ORD-20260428180307', 1, '2026-04-28 18:03:07'),
(94, 15, 'sale', 'out', 0.02, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(95, 26, 'sale', 'out', 0.10, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(96, 21, 'sale', 'out', 0.08, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(97, 27, 'sale', 'out', 2.00, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(98, 28, 'sale', 'out', 0.02, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(99, 29, 'sale', 'out', 0.05, 58, 'Auto deducted from order ORD-20260429050143', 1, '2026-04-29 05:01:43'),
(100, 15, 'sale', 'out', 0.02, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(101, 16, 'sale', 'out', 0.20, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(102, 21, 'sale', 'out', 0.02, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(103, 31, 'sale', 'out', 0.05, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(104, 20, 'sale', 'out', 0.18, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(105, 17, 'sale', 'out', 1.00, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(106, 18, 'sale', 'out', 1.00, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(107, 22, 'sale', 'out', 0.02, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(108, 23, 'sale', 'out', 0.02, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(109, 13, 'sale', 'out', 0.15, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(110, 26, 'sale', 'out', 0.05, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(111, 19, 'sale', 'out', 0.04, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(112, 23, 'sale', 'out', 0.02, 59, 'Auto deducted from order ORD-20260429054424', 1, '2026-04-29 05:44:24'),
(113, 15, 'sale', 'out', 0.02, 60, 'Auto deducted from order ORD-20260429081114', 1, '2026-04-29 08:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `created_at`) VALUES
(1, 'Piece', 'pc', '2026-04-27 09:59:07'),
(2, 'Kilogram', 'kg', '2026-04-27 09:59:07'),
(3, 'Gram', 'g', '2026-04-27 09:59:07'),
(4, 'Liter', 'L', '2026-04-27 09:59:07'),
(5, 'Milliliter', 'ml', '2026-04-27 09:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@kofico.com', '01700000000', '$2y$10$g6eCCd6vIsZyH9LeBvlKjutcSCvZFV4mAuR6a1RQ4xZOBLFeswVQm', 'active', '2026-04-27 09:39:07', '2026-04-28 17:44:13'),
(8, 'Fatema yeasmin Momo', 'nilimamomo123@gmail.com', '01941724660', '$2y$10$cvcCXgiDaeBLc3idfJLFBeS.AAKHQDNxG9tFOiBk75ne0leD5s2/q', 'active', '2026-04-28 01:13:23', '2026-04-28 09:01:35'),
(9, 'ashik', 'codekman@gmail.com', '01675645158', '$2y$10$x2.2L4pWel8.ERxN7wgSFObSIczAvQmPxN4vXR5OKXDWqi1trUTMe', 'active', '2026-04-28 03:12:34', '2026-04-28 03:12:34'),
(10, 'arafat jahan anika', 'anika123@gmail.com', '01939459409', '$2y$10$tiRP9UvUNkoflUKkeJwCQuc7xP0laknkpwVDJJYTBUyJemTCDfUAK', 'active', '2026-04-28 09:00:16', '2026-04-28 09:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(8, 8, 2),
(9, 9, 3),
(10, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `contact_person` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `contact_person`, `phone`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Farm Supplies', 'Abdul Rahman', '01710000001', 'freshfarm@gmail.com', 'Dhaka, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(2, 'Coffee Bean Traders', 'Sakib Hasan', '01710000002', 'coffeebean@gmail.com', 'Chattogram, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(3, 'Dairy Best Ltd.', 'Nusrat Jahan', '01710000003', 'dairybest@gmail.com', 'Gazipur, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(4, 'Frozen Foods BD', 'Imran Hossain', '01710000004', 'frozenfoods@gmail.com', 'Khulna, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(5, 'Spice World', 'Tanvir Ahmed', '01710000005', 'spiceworld@gmail.com', 'Sylhet, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(6, 'Beverage Hub', 'Mehedi Hasan', '01710000006', 'beveragehub@gmail.com', 'Dhaka, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(7, 'Bakery Raw Materials', 'Farhana Akter', '01710000007', 'bakeryraw@gmail.com', 'Rajshahi, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(8, 'Packaging Solutions', 'Rifat Karim', '01710000008', 'packaging@gmail.com', 'Narayanganj, Bangladesh', 1, '2026-04-28 20:05:28', NULL),
(9, 'Ice Cream Supply Co.', 'Jannat Mim', '01710000009', 'icecream@gmail.com', 'Barishal, Bangladesh', 1, '2026-04-28 20:05:28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_no` (`order_no`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `recipe_items`
--
ALTER TABLE `recipe_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item_id` (`menu_item_id`),
  ADD KEY `ingredient_id` (`ingredient_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_role_permission` (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_role` (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe_items`
--
ALTER TABLE `recipe_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Constraints for table `recipe_items`
--
ALTER TABLE `recipe_items`
  ADD CONSTRAINT `recipe_items_ibfk_1` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_items_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_items_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
