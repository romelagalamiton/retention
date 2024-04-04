-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 01:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ui_migration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Lastname`, `Firstname`, `Contact`, `Email`, `Password`) VALUES
(1, 'Santillana', 'DJ Mae', '09124488892', 'deejaybarredo@gmail.com', 'Santillana_123');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_desc` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `subject_code`, `subject_desc`, `section`, `date`, `time`, `room_no`, `teacher_email`, `color`) VALUES
(10, 'SSP 002 ', 'SSP ', 'UI-FCI-BSIT1-3', '2024-02-22', '21:35', 'EL 405', 'deejaybarredo@gmail.com', '#ea7f1a'),
(11, 'ITE 360', 'PROGRAMMING 1', 'UI-FCI-BSIT1-2', '2024-02-06', '04:42', 'ML103', 'deejaybarredo@gmail.com', '#f0e80f');

-- --------------------------------------------------------

--
-- Table structure for table `parents_info`
--

CREATE TABLE `parents_info` (
  `id` int(255) NOT NULL,
  `student_id_number` varchar(255) NOT NULL,
  `student_firstname` varchar(255) NOT NULL,
  `student_lastname` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_contact_no` varchar(255) NOT NULL,
  `student_section` varchar(255) NOT NULL,
  `student_subject` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `guardian's_firstname` varchar(255) NOT NULL,
  `guardian's_lastname` varchar(255) NOT NULL,
  `guardians_email` varchar(255) NOT NULL,
  `guardian's_contact_no` varchar(255) NOT NULL,
  `guardian's_address` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents_info`
--

INSERT INTO `parents_info` (`id`, `student_id_number`, `student_firstname`, `student_lastname`, `student_email`, `student_contact_no`, `student_section`, `student_subject`, `school_year`, `semester`, `guardian's_firstname`, `guardian's_lastname`, `guardians_email`, `guardian's_contact_no`, `guardian's_address`, `profile`) VALUES
(1, '454678', '8sfagdhfa', 'fdgafdh', 'fghasfdgh@gmail.com', 'asfdghaf', 'fsahdfh', 'ashdfahg', 'fhgsafghf', 'fgafsdghaf', 'fsaghdfgahf', 'ghdfghsdgf', 'hfsdfaghdf@gmail.com', 'hfshagdfha', 'dsadad', 'C:xampp	mpphp3039.tmp'),
(2, '04-1819-04894', '125736a', 'asgdhajg', 'student@gmail.com', 'tfaghd', 'ghdfsahdf', 'sahdfghf', 'ghfshafdghafsdgh', 'fsadgf', 'afshgad', 'hgafsdghafs', 'guradian@gmail.com', '1523671', 'ashshadg', 'calli.png'),
(3, '04-1819-04894', 'asdahd', 'ggashdga', 'student@gmail.com', '135126', 'ashdj', 'ashjagdh', 'ashgdjadg', 'ashdgajd', 'asdhasdg', 'hasgdajgd', 'guardian@gmail.com', 'asdhjagdh', 'shjagdajd', '377241883_2959015597564985_1746830981690166709_n.jpg'),
(4, '04-2122-031467', 'Jocel', 'Espina', 'espinajocel@gmail.com', '12345678', 'UI-FC1-BSIT3-1', 'SSP 007', '2023-2024', '1st Semester', 'Mari', 'Espina', 'mari@gmail.com', '1234567', 'Mandurraio, Iloilo City', 'th.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `semester`, `school_year`, `status`) VALUES
(1, '1st Semester', 'S.Y.2024-2025', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `student_risk_tbl`
--

CREATE TABLE `student_risk_tbl` (
  `id` int(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sub_desc` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_risk_tbl`
--

INSERT INTO `student_risk_tbl` (`id`, `id_number`, `firstname`, `lastname`, `sub_code`, `sub_desc`, `section`, `teacher_email`, `class_id`, `term`, `semester`, `school_year`) VALUES
(7, '04-2122-031461', 'Jocel', 'Espina', 'SSP 008', 'Student Success Program', 'UI-FC1-BSIT3-1', 'deejaybarredo@gmail.com', 11, 'P1', '1st Semester', 'S.Y.2024-2025'),
(8, '04-1819-04894', 'Marvin', 'Aungon', 'SSP 008', 'Student Success Program', 'UI-FC1-BSIT3-1', 'deejaybarredo@gmail.com', 11, 'P1', '1st Semester', 'S.Y.2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `id_number`, `firstname`, `lastname`, `email`, `password`, `profile`) VALUES
(1, '04-189-04894', 'Sarah Joy ', 'Sombria', 'sombria@gmail.com', 'Sombria', '2023-02-23.png'),
(3, '04-1920-00279', 'Jensen', 'Lanosnia', 'deejaybarredo@gmail.com', 'Lanosnia', '2023-03-15 (3).png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents_info`
--
ALTER TABLE `parents_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_risk_tbl`
--
ALTER TABLE `student_risk_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parents_info`
--
ALTER TABLE `parents_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_risk_tbl`
--
ALTER TABLE `student_risk_tbl`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
