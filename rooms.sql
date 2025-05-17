-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 09:47 PM
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
-- Database: `rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `collaboration`
--

CREATE TABLE `collaboration` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `compname` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `reqroom` varchar(50) DEFAULT NULL,
  `maxpeople` int(11) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `catering` varchar(10) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_requests`
--

CREATE TABLE `help_requests` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `help` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `help_requests`
--

INSERT INTO `help_requests` (`id`, `fullname`, `phone`, `email`, `help`, `submitted_at`) VALUES
(1, 'abdallah', '98765432', 'abd@gmail.com', 'nothing, testing', '2025-05-15 12:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `per_hour` decimal(6,2) NOT NULL,
  `per_day` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `type`, `size`, `per_hour`, `per_day`) VALUES
(1, 'Meeting Room', 'Small', 10.00, 100.00),
(2, 'Meeting Room', 'Medium', 35.00, 150.00),
(3, 'Meeting Room', 'Large', 60.00, 250.00),
(4, 'Podcast Studio', 'Medium', 25.00, 200.00),
(5, 'Cinema', 'Large', 40.00, 350.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help_requests`
--
ALTER TABLE `help_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `help_requests`
--
ALTER TABLE `help_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `questionnaire_responses`
--

CREATE TABLE `questionnaire_responses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `heard_from` varchar(50) NOT NULL,
  `heard_other` varchar(100) DEFAULT NULL,
  `booking_satisfaction` int(11) NOT NULL,
  `navigation_ease` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `cleanliness_rating` int(11) NOT NULL,
  `room_match` varchar(3) NOT NULL,
  `room_match_reasons` text DEFAULT NULL,
  `amenities_provided` varchar(3) NOT NULL,
  `amenities_reasons` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roommenu`
--

CREATE TABLE `roommenu` (
  `room_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `price_increment` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roommenu`
--

INSERT INTO `roommenu` (`room_id`, `name`, `description`, `base_price`, `price_increment`, `created_at`) VALUES
(1, 'Business Meeting room', 'Room where you can have meetings with business partners, colleagues, etc. 5 OMR/hour, +2 for every size increase.', 5.00, 2.00, '2025-05-16 17:11:07'),
(2, 'Podcast room', 'Soundproofed room to record podcasts or songs. 10 OMR/hour, +4 for every size increase', 10.00, 4.00, '2025-05-16 17:11:07'),
(3, 'Teaching room', 'Room specially made to teach a class of students. 4 OMR/hour, +2 for every size increase.', 4.00, 2.00, '2025-05-16 17:11:07'),
(4, 'Cinema Style room', 'Room to enjoy educational videos on a big screen. 8 OMR/hour, +3 for every size increase.', 8.00, 3.00, '2025-05-16 17:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_form`
--

CREATE TABLE `room_booking_form` (
  `booking_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `num_attendees` int(11) NOT NULL,
  `needs_catering` tinyint(1) DEFAULT 0,
  `equipment_needed` varchar(255) DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_booking_form`
--

INSERT INTO `room_booking_form` (`booking_id`, `customer_name`, `customer_email`, `customer_phone`, `room_type`, `booking_date`, `start_time`, `end_time`, `num_attendees`, `needs_catering`, `equipment_needed`, `additional_notes`, `created_at`) VALUES
(1, 'Ahmed Al-Maskari', 'ahmed@omantel.com', '+96891234567', 'Business Meeting Room', '2023-12-15', '09:00:00', '12:00:00', 8, 1, 'Projector,Whiteboard', 'Need HDMI cables for projector', '2025-05-16 18:00:20'),
(2, 'Maya Al-Rashidi', 'maya@podcast.om', '+96892345678', 'Podcast Room', '2023-12-16', '14:00:00', '17:00:00', 4, 0, 'Microphone,Speakers,Camera', 'Interview with government official', '2025-05-16 18:00:20'),
(3, 'Dr. Khalid Al-Harthy', 'khalid@squ.edu.om', '+96893456789', 'Teaching Room', '2023-12-17', '08:00:00', '10:00:00', 25, 1, 'Projector,Whiteboard', 'Monthly faculty meeting', '2025-05-16 18:00:20'),
(4, 'Layla Al-Balushi', 'layla@events.om', '+96894567890', 'Cinema Style Room', '2023-12-18', '18:00:00', '21:00:00', 30, 1, 'Projector,Speakers', 'Children\'s educational film festival', '2025-05-16 18:00:20'),
(5, 'Yousuf Al-Kindi', 'yousuf@training.om', '+96895678901', 'Creative Workshop', '2023-12-19', '13:00:00', '16:00:00', 12, 0, 'Whiteboard,Flipchart', 'Design thinking workshop for entrepreneurs', '2025-05-16 18:00:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questionnaire_responses`
--
ALTER TABLE `questionnaire_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roommenu`
--
ALTER TABLE `roommenu`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_booking_form`
--
ALTER TABLE `room_booking_form`
  ADD PRIMARY KEY (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questionnaire_responses`
--
ALTER TABLE `questionnaire_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roommenu`
--
ALTER TABLE `roommenu`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_booking_form`
--
ALTER TABLE `room_booking_form`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

