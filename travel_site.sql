-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 07:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(550) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `content`, `date`, `image`, `users_id`) VALUES
(1, 'Hiking the Grand Canyon', 'The American West is one of the most beautiful places I’ve ever seen, and within it lies one of the world’s greatest wonders: the Grand Canyon.', 'Stretching 277 miles and cutting a trench 6,000 feet deep, the Grand Canyon is one of the United States‘ most popular tourist destinations and natural wonders. Taking millennia to form, the rocks at the base of the canyon itself are actually dated to be over 2 billion years old.\r\n\r\nWhile the canyon is popular, of the 6.25 million annual visitors, 99% go to the Grand Canyon for less than four hours. Of that time, only spend 20 minutes is spent at the actual canyon. Surprisingly, only 1% of visitors actually walk down into the canyon, and only about half of that percent hike down to the bottom.', '06/11/2019', 'grandcanyon.jpg', 13),
(2, 'Planning a trip to Mexico City', 'Picking a place to stay in Mexico City can be overwhelming. You’ve got lots of choices when it comes great hotels and neighborhoods.', 'If you’re looking for a colorful city full of vibrant culture, numerous neighborhoods to explore both day and night, and exciting half-day trips, you’ll be pleasantly pleased with all that Mexico City has to offer. There’s castles and canal rides, dog parks and green space. All my (wildly high) expectations were met and then some.\r\n\r\nOh, and don’t forget to stuff your face. Mexico City is full of restaurants and street carts just begging to be indulged in. Chilaquiles. Avocado ice cream (my new obsession). Late-night churros. Street tacos. I’d go back just for the food (ok, and all the puppies literally everywhere).', '04/23/2020', 'mexico.jpg', 14),
(11, 'Planning a trip to Mexico City', 'Picking a place to stay in Mexico City can be overwhelming. You’ve got lots of choices when it comes great hotels and neighborhoods.', 'If you’re looking for a colorful city full of vibrant culture, numerous neighborhoods to explore both day and night, and exciting half-day trips, you’ll be pleasantly pleased with all that Mexico City has to offer. There’s castles and canal rides, dog parks and green space. All my (wildly high) expectations were met and then some.\r\n\r\nOh, and don’t forget to stuff your face. Mexico City is full of restaurants and street carts just begging to be indulged in. Chilaquiles. Avocado ice cream (my new obsession). Late-night churros. Street tacos. I’d go back just for the food (ok, and all the puppies literally everywhere).', '04/23/2020', 'mexico.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `about` varchar(256) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `country`, `about`, `users_id`) VALUES
(4, 'Gabriela Quevedo', 'Spain', 'Hello, I\'m Gaby. I like to travel!', 12);

-- --------------------------------------------------------

--
-- Table structure for table `recent_travels`
--

CREATE TABLE `recent_travels` (
  `id` int(11) NOT NULL,
  `destination` varchar(256) NOT NULL,
  `image` text NOT NULL,
  `departure` date NOT NULL,
  `return` date NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recent_travels`
--

INSERT INTO `recent_travels` (`id`, `destination`, `image`, `departure`, `return`, `users_id`) VALUES
(1, 'New York City, New York', 'newyork.jpg', '2021-03-07', '2021-03-13', 12),
(2, 'Rome, Italy', 'rome.jpg', '2021-03-07', '2021-03-13', 12),
(3, 'Paris, France', 'paris.jpg', '2021-03-07', '2021-03-13', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(256) NOT NULL,
  `lastName` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `username`, `password`, `role`, `active`) VALUES
(1, 'Emily', 'Quevedo', 'emily@email.com', 'EmilyQ', 'password', 1, 0),
(2, 'Mickey', 'Mouse', 'mmouse@email.com', 'MMouse', 'mouse', 0, 0),
(11, 'Justin', 'Bieber', 'justin@email.com', 'JBieber', 'pasword', 0, 0),
(12, 'Gaby', 'Quevedo', 'gaby@email.com', 'GabyQ', 'password', 0, 0),
(13, 'Alice', 'Paulson', 'alice@email.com', 'AlicePaulson', 'password', 0, 0),
(14, 'John', 'Smith', 'johnsmith@email.com', 'JSmith', 'password', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users_idx` (`users_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profile_users_idx` (`users_id`) USING BTREE;

--
-- Indexes for table `recent_travels`
--
ALTER TABLE `recent_travels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recent_travels_users_idx` (`users_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recent_travels`
--
ALTER TABLE `recent_travels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
