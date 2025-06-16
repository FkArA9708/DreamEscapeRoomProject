-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2025 at 07:55 PM
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
-- Database: `escape-room`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `question` varchar(200) NOT NULL,
  `hint` varchar(200) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `roomId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `hint`, `answer`, `roomId`) VALUES
(1, 'In this dream, time moves backward. If it\'s now 3:00 PM and 5 hours ago it was 7:00 PM, what time is it really?', 'In this dream world, time moves in reverse.', '1:00 AM', 1),
(2, '\"You see me once in a dream,\r\nTwice if you try to escape,\r\nBut stare too long and I vanish.\r\nWhat am I?\"', 'You’re trying to hold on… but it fades like mist in the morning.', 'a memory', 1),
(3, 'I vanish with the light, though in slumber I reign. I speak in riddles, yet I tell no lie. What am I?', 'This thing only exists while you sleep and disappears when you wake up. It\'s often strange, symbolic, and hard to explain — yet somehow meaningful.', 'A dream', 2),
(4, 'You can’t hold me, yet I hold you tight,\r\nIn silence or screams, I visit each night.\r\nA key to your mind, a door to your fear,\r\nSolve me, and truth will suddenly appear.\r\nWhat am I?', 'I often come when you\'re most vulnerable — in the deepest parts of sleep.', 'A nightmare', 1),
(5, '\"I follow you in every dream, but vanish with the light.\r\nI’m always behind, silent, but never quite right.\r\nWhat am I?', 'You never see me in the front, but I mimic your every move — even in dreams.', 'A shadow', 2),
(6, 'In dreams I move fast, then suddenly slow.\r\nI melt on the wall, but you don’t even know.\r\nWhat am I?', 'Think Salvador Dalí. It’s a concept that feels strange in dreams — sometimes missing entirely.', 'Time', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_naam` varchar(255) NOT NULL,
  `aantal_spelers` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `klaar` tinyint(1) DEFAULT 0,
  `punten` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_naam`, `aantal_spelers`, `start_time`, `end_time`, `klaar`, `punten`) VALUES
(1, 'The Dream Team', 4, '2025-05-22 14:30:00', '2025-05-22 16:24:53', 1, 3),
(2, 'Clever Individuals', 2, '2025-03-12 09:30:00', '2025-03-12 10:03:57', 1, 2),
(3, 'The Boyzz', 5, '2025-04-04 12:54:59', '2025-04-04 13:32:32', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('speler','admin') DEFAULT 'speler'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'furkan', 'furkan', 'admin'),
(2, 'Piet', 'Piet', 'speler');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
