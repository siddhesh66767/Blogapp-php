-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 09:30 PM
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
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 3, 2, 'test', '2024-10-13 15:31:34'),
(2, 6, 2, 'test', '2024-10-13 16:49:09'),
(3, 6, 4, 'hey\r\n', '2024-10-13 16:51:18'),
(4, 12, 2, 'wawa\r\n', '2024-10-13 17:27:46'),
(5, 12, 4, 'nice', '2024-10-13 17:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', 'test', '2024-10-13 19:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `image`, `category`) VALUES
(3, 'test', 'test sid', '2024-10-13 15:26:41', 'uploads/Screenshot 2024-09-30 193331.png', ''),
(5, 't', 't', '2024-10-13 16:16:04', 'uploads/Screenshot 2024-08-06 190849.png', ''),
(6, 'test2', 'lorem', '2024-10-13 16:46:44', 'uploads/Screenshot 2024-08-06 190837.png', ''),
(9, 'hh', 'h', '2024-10-13 17:04:32', 'uploads/1728839072_Screenshot 2024-09-30 205015.png', ''),
(10, 'g', 'g', '2024-10-13 17:08:03', 'uploads/1728839282_Screenshot 2024-08-31 191424.png', ''),
(11, 't', 't', '2024-10-13 17:11:02', 'uploads/1728839462_test.png', ''),
(12, 'Need more exposure on such wickets: Towhid Hridoy', 'Towhid Hridoy said their team was lacking in all aspects during the just concluded three-match T20I series against India.\r\n\r\nBangladesh had an experienced side compared to the young Indian squad but that made little difference as the hostscompletely outclassed Bangladesh in terms of skill sets.\r\n\r\n\"We lacked in all departments. One day the batting was good but the bowling wasn\'t, and when the bowling was good, the batting wasn\'t,\" Hridoy told reporters after their third successive loss.\r\n\r\n\"We don\'t usually play on wickets like this. I\'m not making excuses, but the more we play on such wickets, the better we\'ll get,\" he said.\r\n\r\n\"Overall, we have a lot of room for improvement. We have a lot to learn from this series. Hopefully, we will be able to learn from it,\" he added.\r\n\r\nHridoy said that the failure of the top-order made them pay in every game while adding that if they are accustomed to play in good wicket in that case they can better in the coming days.\r\n\r\nBangladesh suffered a huge 133-run defeat in the third and final T20I and lost the series 3-0 on a record-breaking night for the hosts at the Rajiv Gandhi International Stadium in Hyderabad on Saturday (October 12). Bangladesh managed to muster 164 for 7 in the record run chase of 298.\r\n\r\nThis is Bangladesh\'s largest defeat by a margin of runs, beating the previous record of a 104-run defeat to South Africa in 2022. India won the first game by seven wickets and the second game by 86 runs.\r\n\r\n\"Look, in every team, runs come from the top order. When that happens, naturally, you score big. If the top four get big runs, then the total becomes 180,\" Hridoy added.\r\n\r\n\"I wouldn\'t say we\'re too far behind. We\'re not this bad as a side. It\'s more about how we can perform on flat wickets.. Most of our players can\'t read the wicket properly. We mostly play in Mirpur. If we play in Chattogram, we know what the wicket will be like, but in other places, the wicket varies each day. If we keep playing on good wickets, we will improve day by day. It won\'t happen overnight. India can be an example for us-how to play on flat wickets with good planning. We need to improve in all departments.\"\r\n\r\n\"It\'s not just about the wickets; we also need to improve our skills. I wouldn\'t say our standard is too low. We\'ve played against big teams. India is a strong team, and this is their home ground. They\'re good in all aspects and ahead in terms of skill too,\" he concluded.', '2024-10-13 17:26:17', 'uploads/1728840377_OIP.jpeg', 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'test', '$2y$10$.E..9PI8cwFvUSse.mfYSuPRWkJNcAgM6L7h31XO9OQPyuuoPkiRu', 'admin'),
(3, 'sid', '$2y$10$GnNe8GB3o5uNkxoIMUIb2OoFR/N5jQnHSFPyEPAs1CNfq9QUm2Ri.', 'user'),
(4, 'sh', '$2y$10$.CKveKvO9HaaOLLU/gNMCuON1KLNFOD9oVL2jgQ4eQ.rHNr5XwgYC', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
