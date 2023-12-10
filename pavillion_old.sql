-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 01:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pavillion`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_forms`
--

CREATE TABLE `application_forms` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `opened` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_forms`
--

INSERT INTO `application_forms` (`id`, `firstname`, `lastname`, `email`, `phone`, `address`, `city`, `state`, `zip`, `position`, `text`, `timestamp`, `opened`) VALUES
(1, 'Mahmoud', 'Hegazy', 'mahmoody2002@gmail.com', '01017620097', '420 Orouba Axis', 'First Settlement', 'Cairo', 11865, 'Engineering', 'I am an engineer and I want to apply for your position and I hope that you can accept my application seeing that I am a very dedicated person and would like to join your very professional team', '2023-04-20 19:31:47', 1),
(3, 'Nermine', 'Strougo', 'whatever@gmail.com', '010101010101', 'address', 'city', 'state', 0, 'Finance', 'I am a financial manager and I would be honored to join your team in order to help you build a better future for your company while also being a part of that future for you.', '2023-04-22 00:42:54', 1),
(4, 'Ali', 'Elbahaie', 'elbahaie@gmail.com', '0101111111111', '420 Adress, Street', 'Cairo', 'Cairo', 11865, 'Accounting', 'I am an accountant and I am currently testing this website and looking for any errors that might occur', '2023-04-24 05:42:38', 1),
(5, 'Ali', 'Elbahaie', 'ali.elbahaie@gmail.com', '01000000', 'beety', 'madenit beety', 'stateBbeety', 0, 'Founder ', 'im the bestttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', '2023-04-24 06:33:06', 1),
(7, 'karim', 'morad', 'kareemhaitham.m@gmail.com', '01115554634', 'cairo', 'cairo', 'cairo', 11835, 'MANAGER', 'enough is told where nothing can meet my requiremnts as hegazy is a n exceptional chatrater', '2023-04-26 00:49:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `opened` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`, `opened`) VALUES
(1, 'Mahmoud Hegazy', 'mahmoody2002@gmail.com', 'Hello, I wanted to asks you about your portfolio as I have a project that I need management for. Can you please send me this portfolio on my email? Thanks a lot!', '2023-04-21 00:59:34', 0),
(5, 'mahmoud', 'mail@mail.com', 'This is another test to see if the browser will store the cookies of this form. The first test worked :)', '2023-04-22 01:16:49', 0),
(23, 'Mahmoud Hegazy', 'Mahmoud@gmail.com', 'nklnklccdsklccnsklcnd', '2023-04-23 18:34:52', 1),
(24, 'Mahmoud Hegazy', 'mail@mail.com', 'This is a message to test if the page will not reload but will still send the data to the SQL server', '2023-04-23 19:06:02', 1),
(34, 'Mahmoud Hegazy', 'mahmoud@gmail.com', 'Hello, this is a contact form test message', '2023-04-25 21:02:09', 0),
(35, 'Mahmoud Hegazy', 'mahmoud@gmail.com', 'Hello, this is a contact form test message', '2023-04-25 21:02:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `last_accessed` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `PASSWORD`, `email`, `first_name`, `last_name`, `last_accessed`, `created_at`) VALUES
(1, 'admin', '$2y$10$WiNOR0vS6ANXhE.yaKYrqOtoVB6yeKPJcjVJiZ/SXFnnWL1EtevEG', 'mh2101083@tkh.edu.eg', 'Mahmoud', 'Hegazy', NULL, '2023-04-21 03:21:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_forms`
--
ALTER TABLE `application_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_forms`
--
ALTER TABLE `application_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
