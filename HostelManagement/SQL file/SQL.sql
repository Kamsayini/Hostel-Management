-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 02:42 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel management system`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` char(6) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `MobileNo` varchar(14) NOT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Fname`, `Lname`, `MobileNo`, `Salary`) VALUES
('EM/01', 'James', 'Butt', '504-621-8927', 34000),
('EM/02', 'Josephine', 'Gowsi', '001245687', 33000),
('EM/03', 'Art', 'Venere', '856-636-8749', 35000),
('EM/04', 'Lenna', 'Paprocki', '907-385-4412', 45000),
('EM/05', 'Donette', 'Foller', '513-570-1893', 50000),
('EM/06', 'Simona', 'Morasca', '419-503-2484', 48000),
('EM/07', 'Mitsue', 'Tollner', '773-573-6914', 39000);

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `FurnitureID` char(10) NOT NULL,
  `nChair` varchar(10) NOT NULL,
  `nTable` varchar(10) NOT NULL,
  `RoomID` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`FurnitureID`, `nChair`, `nTable`, `RoomID`) VALUES
('F001', 'Yes', 'No', 'FF-07'),
('F002', 'No', 'Yes', 'FF-07'),
('F003', 'No', 'Yes', 'FF-09'),
('F004', 'Yes', 'No', 'FF-13'),
('F005', 'No', 'Yes', 'FF-13'),
('F006', 'No', 'Yes', 'FF-15'),
('F007', 'Yes', 'No', 'FF-17'),
('F008', 'No', 'Yes', 'FF-19'),
('F009', 'Yes', 'No', 'FF-21'),
('F010', 'yes', 'no', 'FF-01');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `HostelID` varchar(4) NOT NULL,
  `SuperID` char(6) DEFAULT NULL,
  `nRooms` int(11) NOT NULL,
  `nFloors` int(11) NOT NULL,
  `nStudents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`HostelID`, `SuperID`, `nRooms`, `nFloors`, `nStudents`) VALUES
('H001', 'EM/03', 84, 3, 335),
('H002', 'EM/04', 84, 3, 336),
('H003', 'EM/05', 56, 2, 112),
('H004', 'EM/06', 84, 3, 336),
('H005', 'EM/07', 56, 2, 112);

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `PayID` char(10) NOT NULL,
  `StudentID` char(10) DEFAULT NULL,
  `Amount` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Medium` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`PayID`, `StudentID`, `Amount`, `Date`, `Medium`) VALUES
('PID2011', '2019/E/032', 1200, '2019-03-24', 'Online'),
('PID2012', NULL, 1200, '2019-07-25', 'Cash'),
('PID2013', '2019/E/049', 1200, '2019-03-29', 'Cash'),
('PID2014', '2019/E/061', 1200, '2019-09-27', 'VisaCard'),
('PID2015', NULL, 1200, '2019-07-11', 'Online'),
('PID2016', '2019/E/134', 1200, '2019-01-25', 'Online'),
('PID2017', '2019/E/158', 1200, '2019-03-27', 'VisaCard'),
('PID2018', '2019/E/049', 1200, '2019-08-06', 'Online'),
('PID2019', '2019/E/061', 1200, '2019-08-03', 'Cash'),
('PID2020', '2019/E/134', 1200, '2019-05-24', 'Cash'),
('PID2021', '2019/E/032', 1200, '2019-09-27', 'Online'),
('PID2022', NULL, 1200, '2019-07-25', 'Cash'),
('PID2023', NULL, 1200, '2019-03-27', 'Online'),
('PID2024', '2019/E/112', 1200, '2022-10-29', 'Cash'),
('PID2025', '2019/E/025', 1200, '2022-11-01', 'VisaCard');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomID` varchar(9) NOT NULL,
  `HostelID` varchar(4) DEFAULT NULL,
  `nBed` int(11) UNSIGNED NOT NULL,
  `Capacity` int(11) UNSIGNED NOT NULL,
  `nPeople` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomID`, `HostelID`, `nBed`, `Capacity`, `nPeople`) VALUES
('FF-01', 'H001', 4, 4, 1),
('FF-02', 'H001', 4, 4, 0),
('FF-03', 'H001', 4, 4, 0),
('FF-04', 'H001', 4, 4, 0),
('FF-05', 'H001', 4, 4, 0),
('FF-06', 'H001', 4, 4, 1),
('FF-07', 'H001', 4, 4, 1),
('FF-08', 'H001', 4, 4, 1),
('FF-09', 'H001', 4, 4, 1),
('FF-10', 'H001', 4, 4, 0),
('FF-11', 'H001', 4, 4, 1),
('FF-12', 'H001', 4, 4, 0),
('FF-13', 'H001', 4, 4, 1),
('FF-14', 'H001', 4, 4, 1),
('FF-15', 'H001', 4, 4, 0),
('FF-16', 'H001', 4, 4, 0),
('FF-17', 'H001', 4, 4, 0),
('FF-18', 'H001', 4, 4, 0),
('FF-19', 'H001', 4, 4, 0),
('FF-20', 'H001', 4, 4, 0),
('FF-21', 'H001', 4, 4, 0),
('FF-22', 'H001', 4, 4, 0),
('FF-23', 'H001', 4, 4, 0),
('FF-24', 'H001', 4, 4, 0),
('FF-25', 'H001', 4, 4, 0),
('FF-26', 'H001', 4, 4, 2),
('FF-27', 'H001', 4, 4, 1),
('FF-28', 'H001', 4, 4, 0),
('SF-01', 'H002', 2, 2, 0),
('SF-02', 'H002', 2, 2, 0),
('SF-03', 'H002', 2, 2, 1),
('SF-04', 'H002', 2, 2, 0),
('SF-05', 'H002', 2, 2, 2),
('SF-06', 'H002', 2, 2, 0),
('SF-07', 'H002', 2, 2, 1),
('SF-08', 'H002', 2, 2, 1),
('SF-09', 'H002', 2, 2, 0),
('SF-10', 'H002', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` char(10) NOT NULL,
  `RoomID` char(9) DEFAULT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Age` int(11) NOT NULL,
  `MobileNo` varchar(14) NOT NULL,
  `Department` varchar(35) NOT NULL,
  `Status` varchar(4) NOT NULL,
  `Address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `RoomID`, `Fname`, `Lname`, `Age`, `MobileNo`, `Department`, `Status`, `Address`) VALUES
('2019/E/024', 'FF-01', 'Diluxan', 'Rasen', 24, '0123456789', 'Computer', 'Yes', 'Killinochi'),
('2019/E/025', 'FF-06', 'Dansten', 'Croos', 24, '076-8517674', 'Civil', 'yes', '6 S 33rd St,Mannar'),
('2019/E/032', 'FF-07', 'Dilushan', 'Guna', 22, '076-8517675', 'Computer', 'yes', '6 Greenleaf Ave,Trinco'),
('2019/E/034', 'FF-09', 'Tharu', 'Yogan', 23, '0987564321', 'Mechanical', 'Yes', 'Vavuniya'),
('2019/E/040', 'FF-08', 'Haleeth', 'Mohammed', 23, '9512634780', 'Civil', 'Yes', 'Horapoththana'),
('2019/E/047', 'FF-27', 'Anas', 'Issath', 24, '0761234938', 'Computer', 'Yes', 'Trincomalee'),
('2019/E/049', 'FF-11', 'Jathurshan', 'Sownthar', 24, '076-8517677', 'Computer', 'yes', '74 S Westgate St,Trinco'),
('2019/E/061', 'FF-13', 'Keshikan', 'Baskaran', 23, '076-8517678', 'Civil', 'no', '3273 State St,Mullai'),
('2019/E/065', 'FF-14', 'Lalith', 'Kumar', 25, '076-8517679', 'EEE', 'yes', '1 Central Ave,Nuwa'),
('2019/E/112', 'SF-08', 'Rishikee', 'Hariharan', 23, '076-8517680', 'Civil', 'yes', '86 Nw 66th St #8673,Trinco'),
('2019/E/128', 'FF-26', 'Saarankan', 'Santhiran', 23, '076-8517681', 'Civil', 'yes', '2 Cedar Ave #84,Kilinochi'),
('2019/E/134', 'FF-26', 'Siranchith', 'Kirakalan', 23, '076-8517683', 'Civil', 'yes', '386 9th Ave N,Mullai'),
('2019/E/150', 'SF-03', 'Thushan', 'Subas', 23, '076-8517684', 'EEE', 'yes', '74874 Atlantic Ave,Vavuniya'),
('2019/E/158', 'SF-05', 'Vithusan', 'Kennedy', 23, '076-8517685', 'EEE', 'yes', '366 South Dr,Kilinochi'),
('2019/E/159', 'SF-05', 'Vithusan', 'Ampi', 23, '076-8517686', 'Civil', 'yes', '45 E Liberty St,Kilinochi'),
('2019/E/175', 'SF-07', 'Yesinthan', 'Rathakrish', 23, '076-8517687', 'EEE', 'yes', '4 Ralph Ct,Nuwa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `password`, `date`) VALUES
(1, 7336652, 'Gowsi', 'Gowsi', '2022-10-20 14:34:34'),
(6, 9223372036854775807, 'Gowsikan', '324612', '2022-10-20 20:24:35'),
(12, 38892, 'Guna', 'Guna', '2022-10-21 09:45:51'),
(13, 8931963, 'Home', 'Home1234', '2022-10-21 10:01:29'),
(15, 228337000394340, 'user', 'user', '2022-10-21 15:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `VisitorID` char(10) NOT NULL,
  `StudentID` char(10) DEFAULT NULL,
  `TimeIn` time NOT NULL,
  `TimeOut` time DEFAULT NULL,
  `Date` date NOT NULL,
  `Sex` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`VisitorID`, `StudentID`, `TimeIn`, `TimeOut`, `Date`, `Sex`) VALUES
('V01', NULL, '14:22:21', '16:57:46', '2019-10-09', 'F'),
('V02', '2019/E/049', '13:38:42', '12:02:48', '2019-06-08', 'M'),
('V03', '2019/E/061', '12:39:00', '12:15:23', '2019-06-19', 'M'),
('V04', '2019/E/065', '11:17:45', '12:03:36', '2019-03-28', 'F'),
('V05', '2019/E/112', '12:30:23', '12:02:49', '2019-06-24', 'F'),
('V06', '2019/E/128', '11:41:08', '13:25:56', '2019-10-18', 'F'),
('V07', NULL, '12:05:12', '14:09:58', '2019-09-26', 'F'),
('V08', '2019/E/134', '11:26:05', '12:31:48', '2019-10-07', 'F'),
('V09', '2019/E/049', '14:15:11', '11:52:27', '2019-04-23', 'F'),
('V10', '2019/E/061', '13:43:42', '14:03:18', '2019-01-01', 'M'),
('V11', '2019/E/025', '16:43:00', '18:24:00', '2022-10-20', 'F'),
('V12', '2019/E/032', '19:06:00', '19:15:00', '2022-10-21', 'M'),
('V13', '2019/E/040', '12:01:00', '12:03:00', '2022-10-30', 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`FurnitureID`),
  ADD KEY `furniture_ibfk_1` (`RoomID`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`HostelID`),
  ADD KEY `hostel_ibfk_1` (`SuperID`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`PayID`),
  ADD KEY `rent_ibfk_1` (`StudentID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `room_ibfk_1` (`HostelID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `student_ibfk_1` (`RoomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`VisitorID`),
  ADD KEY `visitor_ibfk_1` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `furniture`
--
ALTER TABLE `furniture`
  ADD CONSTRAINT `furniture_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `hostel`
--
ALTER TABLE `hostel`
  ADD CONSTRAINT `hostel_ibfk_1` FOREIGN KEY (`SuperID`) REFERENCES `employee` (`EmployeeID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`HostelID`) REFERENCES `hostel` (`HostelID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `visitor`
--
ALTER TABLE `visitor`
  ADD CONSTRAINT `visitor_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
