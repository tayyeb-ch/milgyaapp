-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 03:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milgyawebapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@findlostitems.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `picture`, `created_at`) VALUES
(1, 'Smart Phone', 'images/categories/smartphone.png', '2022-05-24 05:29:25'),
(2, 'Laptop', 'images/categories/laptop.png', '2022-05-24 05:29:25'),
(3, 'Ring', 'images/categories/diamond-ring.png', '2022-05-24 05:29:25'),
(4, 'iPad', 'images/categories/electronic.png', '2022-05-24 05:29:25'),
(5, 'Tablet', 'images/categories/content-marketing.png', '2022-05-24 05:29:25'),
(6, 'Men Wallet', 'images/categories/wallet.png', '2022-05-24 05:29:25'),
(7, 'Women Purse', 'images/categories/purse.png', '2022-05-24 05:29:25'),
(8, 'Bag', 'images/categories/bags.png', '2022-05-24 05:29:25'),
(9, 'Keys', 'images/categories/key-chain.png', '2022-05-24 05:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Umer Rajput', 'umernaseer10@gmail.com', 'test subject', 'asdf', '2022-05-24 07:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `views` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_id`, `category_id`, `title`, `description`, `picture`, `location`, `views`, `type`, `created_at`) VALUES
(3, 2, 2, 'HP Omen Laptop', 'The HP Omen 15 2019 is, without a doubt, a powerful laptop, but like other devices, it has its flaws. It has a great display configuration, above-average gaming performance, and slim form factor. The only significant issues that I had here is that it has heating problems while its battery life is subpar. But overall, the gaming laptop is one heck of a performer and worthy upgrade if you have an older Omen. However, the pricing of this device will most likely affect your decision to get it.', 'images/items/HPOmen15-dh__1_.jpg', 'D1 Mirpur Azad Kashmir', 82, 'Found', '2022-05-24 08:08:51'),
(4, 2, 6, 'Gucci Guccissima Wallet', 'Gucci Guccissima web bi-fold wallet | Gucci wallet, Wallet, Luxury wallet Gucci Guccissima web bi-fold wallet | Gucci wallet, Wallet, Luxury wallet Gucci Guccissima web bi-fold wallet | Gucci wallet, Wallet, Luxury wallet Gucci Guccissima web bi-fold wallet | Gucci wallet, Wallet, Luxury wallet Gucci Guccissima web bi-fold wallet | Gucci wallet, Wallet, Luxury wallet', 'images/items/40bc6995db94fdf1474066c918805301.jpg', 'C4 Mirpur Azad Kashmir', 1, 'Found', '2022-05-24 09:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `item_specifications`
--

CREATE TABLE `item_specifications` (
  `id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_specifications`
--

INSERT INTO `item_specifications` (`id`, `item_id`, `name`, `value`, `created_at`) VALUES
(8, 3, 'Color', 'Black', '2022-05-24 09:09:34'),
(9, 3, 'Condition', 'New', '2022-05-24 09:09:44'),
(10, 3, 'Specs', 'Gaming Laptop', '2022-05-24 09:09:54'),
(11, 4, 'Color', 'Black/Red', '2022-05-24 09:12:43'),
(12, 4, 'Brand', 'Gucci', '2022-05-24 09:12:48'),
(13, 4, 'Gender Type', 'Mens Wallet', '2022-05-24 09:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `address`, `created_at`) VALUES
(2, 'Umer Rajput', 'umer@mailinator.com', 'asdf1234', '03415304550', 'Mirpur Azad Kashmir', '2022-05-24 04:39:58'),
(3, 'Karim Abdullah', 'karim@mailinator.com', 'asdf1234', '03212301232', 'Mirpur Azad Kashmir', '2022-05-24 04:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` int(255) NOT NULL,
  `review_from` int(255) NOT NULL,
  `review_to` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `review_description` longtext NOT NULL,
  `rating` decimal(18,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `review_from`, `review_to`, `item_id`, `review_description`, `rating`, `created_at`) VALUES
(1, 3, 2, 3, 'Arrived  so quick...thanks', '5.00', '2022-05-24 07:54:02'),
(2, 3, 2, 3, 'When it arrived I immediately say\r\nthat the packaging is very good.\r\nI was happier when I saw the mat\r\nbecause they are impressively nice', '4.00', '2022-05-24 07:54:02'),
(3, 3, 2, 3, 'great job', '0.00', '2022-05-25 08:58:41'),
(4, 3, 2, 3, 'asdf', '0.00', '2022-05-25 08:59:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `item_specifications`
--
ALTER TABLE `item_specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_from` (`review_from`),
  ADD KEY `review_to` (`review_to`),
  ADD KEY `item_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item_specifications`
--
ALTER TABLE `item_specifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
