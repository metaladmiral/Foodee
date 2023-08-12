-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 10:27 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodee`
--

-- --------------------------------------------------------

--
-- Table structure for table `commonnorth`
--

CREATE TABLE `commonnorth` (
  `food_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `food_time_type` varchar(100) NOT NULL,
  `food_frequency_type` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commonnorth`
--

INSERT INTO `commonnorth` (`food_id`, `name`, `food_type`, `food_time_type`, `food_frequency_type`, `image`) VALUES
(66, 'Aaloo ke parathe', 'veg', 'breakfast', 'regular', ''),
(67, 'Pyaaz ke parathe', 'veg', 'breakfast', 'regular', ''),
(68, 'Mooli ke parathe', 'veg', 'breakfast', 'regular', ''),
(69, 'Gobhi ke parathe', 'veg', 'breakfast', 'regular', ''),
(70, 'Namkeen kachori', 'veg', 'breakfast lunch', 'regular', ''),
(71, 'Paneer ke parathe', 'veg', 'breakfast', 'lessfrequent_special', ''),
(72, 'Omelete', 'nonveg', 'breakfast', 'regular', ''),
(73, 'Poha', 'veg', 'breakfast', 'lessfrequent', ''),
(74, 'Moong dal cheela', 'veg', 'breakfast', 'lessfrequent', ''),
(75, 'Paneer Sandwich', 'veg', 'breakfast', 'lessfrequent', ''),
(76, 'Veg Mayo Grilled Sandwich', 'veg', 'breakfast', 'special', ''),
(77, 'Sabudana Khichdi', 'veg', 'breakfast lunch', 'lessfrequent', ''),
(78, 'Khasta Jalebi', 'veg', 'breakfast', 'lessfrequent', ''),
(79, 'Manchow soup', 'veg', 'breakfast', 'special', ''),
(80, 'Potato cheese balls', 'veg', 'breakfast', 'special', ''),
(81, 'Bharwa Bhindi', 'veg', 'breakfast lunch', 'regular', ''),
(82, 'Bhindi', 'veg', 'breakfast lunch', 'regular', ''),
(83, 'Vada Pav', 'veg', 'breakfast lunch', 'lessfrequent', ''),
(84, 'Dahi ke aaloo', 'veg', 'lunch', 'regular', ''),
(85, 'Baati chokha', 'veg', 'lunch dinner', 'special', ''),
(86, 'Kadhi', 'veg', 'lunch', 'regular', ''),
(87, 'Aaloo tamatar ki sabzi', 'veg', 'breakfast lunch', 'regular', ''),
(88, 'Aaloo gobhi ki sabzi', 'veg', 'breakfast lunch dinner', 'regular', ''),
(89, 'Idli/Sambhar', 'veg', 'breakfast lunch dinner', 'special', ''),
(90, 'Sambhar Dosa', 'veg', 'breakfast lunch dinner', 'regular', ''),
(91, 'Kaddoo ki sabzi', 'veg', 'breakfast lunch', 'regular', ''),
(92, 'Aaloo Jeera', 'veg', 'breakfast lunch', 'regular', ''),
(93, 'Lauki ka kofte', 'veg', 'breakfast lunch dinner', 'lessfrequent', ''),
(94, 'Malai kofta', 'veg', 'breakfast lunch dinner', 'lessfrequent', ''),
(95, 'Manchurian', 'veg', 'lunch dinner', 'special', ''),
(96, 'Pindi chole', 'veg', 'dinner lunch', 'special', ''),
(97, 'Peshawari chole', 'veg', 'dinner lunch', 'special', ''),
(98, 'Chole curry', 'veg', 'dinner lunch', 'special', ''),
(99, 'Kadhai chole', 'veg', 'dinner lunch', 'special', ''),
(100, 'Masoor Dal', 'veg', 'lunch dinner', 'regular', ''),
(101, 'Moong ki Dal', 'veg', 'lunch dinner', 'regular', ''),
(102, 'Urad dal', 'veg', 'lunch dinner', 'regular', ''),
(103, 'Chane ki daal', 'veg', 'lunch dinner', 'regular', ''),
(104, 'tuvar/arhar ki dal', 'veg', 'lunch dinner', 'regular', ''),
(105, 'Dal makhni', 'veg', 'lunch dinner', 'lessfrequent', ''),
(106, 'Pachmela Dal', 'veg', 'lunch dinner', 'special', ''),
(107, 'Rajma', 'veg', 'lunch dinner', 'lessfrequent_special', ''),
(108, 'Egg curry', 'nonveg', 'lunch dinner', 'lessfrequent', ''),
(109, 'Chicken lababdar', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(110, 'Afghani chicken', 'nonveg', 'lunch dinner', 'special', ''),
(111, 'Shahi chicken masala', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(112, 'Butter Chicken', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(113, 'Chicken curry', 'nonveg', 'lunch dinner', 'lessfrequent', ''),
(114, 'Chicken Korma', 'nonveg', 'lunch dinner', 'special', ''),
(115, 'Chicken Kadhai', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(116, 'Mutton Qorma', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(117, 'Mutton Stew', 'nonveg', 'lunch dinner', 'special', ''),
(118, 'Mutton Rogan Josh', 'nonveg', 'lunch dinner', 'special', ''),
(119, 'Kadhai Paneer', 'nonveg', 'lunch dinner', 'lessfrequent_special', ''),
(120, 'Paneer Butter Masala', 'veg', 'lunch dinner', 'lessfrequent_special', ''),
(121, 'Paneer Do Pyaza', 'veg', 'lunch dinner', 'lessfrequent_special', ''),
(122, 'Matar Paneer', 'veg', 'lunch dinner', 'lessfrequent_special', ''),
(123, 'Handi Paneer', 'veg', 'lunch dinner', 'special', ''),
(124, 'Paneer Lababdar', 'veg', 'lunch dinner', 'special', ''),
(125, 'Palak Paneer', 'veg', 'lunch dinner', 'regular', ''),
(126, 'Shahi Paneer', 'veg', 'lunch dinner', 'regular', ''),
(127, 'Torai(gourd)', 'veg', 'breakfast lunch', 'lessfrequent', ''),
(128, 'Parwal(gourd)', 'veg', 'breakfast lunch', 'lessfrequent', ''),
(129, 'Kathal(Jackfruit)', 'veg', 'breakfast lunch', 'regular', ''),
(130, 'Arbi(Guyyiyan)', 'veg', 'breakfast lunch', 'regular', '');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profileno` varchar(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  `food_eater_type` varchar(20) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commonnorth`
--
ALTER TABLE `commonnorth`
  ADD PRIMARY KEY (`food_id`);
ALTER TABLE `commonnorth` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `commonnorth` ADD FULLTEXT KEY `foodtimetype` (`food_time_type`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profileno`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commonnorth`
--
ALTER TABLE `commonnorth`
  MODIFY `food_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
