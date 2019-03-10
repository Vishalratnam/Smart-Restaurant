-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2019 at 12:50 PM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(3) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(3) NOT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `category`, `price`, `image_path`) VALUES
(1, 'Idli(2 pieces)', 'South Indian', 24, 'https://media-cdn.tripadvisor.com/media/photo-s/0e/60/08/7d/idly.jpg'),
(2, 'Vada', 'South Indian', 21, 'https://farm1.staticflickr.com/320/18912568232_686613c78c_o.jpg'),
(3, 'Rava Idli', 'South Indian', 32, 'http://cdn3.foodviva.com/static-content/food-images/breakfast-recipes/rava-idli-recipe/rava-idli-recipe.jpg'),
(4, 'Jamun', 'South Indian', 25, 'https://du7ybees82p4m.cloudfront.net/56a288e117d3f8.50310584.jpg?width=910&height=512'),
(5, 'Khara Bhath', 'South Indian', 20, 'https://i.ytimg.com/vi/qYFbz9Hddj4/maxresdefault.jpg'),
(6, 'Kesari Bhath', 'South Indian', 20, 'https://www.vegrecipesofindia.com/wp-content/uploads/2016/10/kesari-bath-recipe-1.jpg'),
(7, 'Roti', 'North Indian', 20, 'https://navbharattimes.indiatimes.com/hindi-recipes/wp-content/uploads/sites/2/2018/09/roti-655x477.jpg'),
(8, 'Paneer Butter Masala', 'North Indian', 130, 'https://i0.wp.com/mypullzone-9vexd6dl53at.netdna-ssl.com/wp-content/uploads/2017/04/paneer-butter-masala-recipe-step-by-step-instructions.jpg?fit=2592%2C1944&ssl=1');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `table_no` int(3) NOT NULL,
  `item_id` int(3) NOT NULL,
  `quantity` int(2) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`table_no`, `item_id`, `quantity`, `timestamp`, `completed`) VALUES
(1, 1, 1, '2019-03-10 09:10:36', b'1'),
(1, 2, 1, '2019-03-10 09:10:36', b'0'),
(3, 4, 1, '2019-03-10 11:32:43', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`table_no`,`item_id`,`timestamp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
