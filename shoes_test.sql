--
-- Database: `shoes_test`
--
CREATE DATABASE IF NOT EXISTS `shoes_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes_test`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stores_brands`
--

CREATE TABLE `stores_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores_brands`
--

INSERT INTO `stores_brands` (`id`, `store_id`, `brand_id`) VALUES
(1, 50, 31),
(2, 59, 39),
(3, 59, 40),
(4, 60, 41),
(5, 70, 50),
(6, 70, 51),
(7, 71, 52),
(8, 78, 84),
(9, 79, 84),
(10, 80, 85),
(11, 90, 87),
(12, 90, 88),
(13, 91, 89),
(14, 92, 97),
(15, 93, 97),
(16, 94, 98),
(17, 104, 100),
(18, 104, 101),
(19, 105, 102),
(20, 106, 110),
(21, 107, 110),
(22, 108, 111),
(24, 119, 122),
(25, 120, 122),
(26, 121, 123),
(28, 132, 134),
(29, 133, 134),
(30, 134, 135),
(31, 144, 137),
(32, 144, 138),
(33, 145, 139),
(34, 146, 147),
(35, 147, 147),
(36, 148, 148),
(37, 158, 150),
(38, 158, 151),
(39, 159, 152),
(40, 160, 160),
(41, 161, 160),
(42, 162, 161),
(43, 174, 173),
(44, 175, 173),
(45, 176, 174),
(47, 186, 176),
(48, 186, 177),
(49, 187, 178),
(50, 188, 186),
(51, 189, 186),
(52, 190, 187),
(54, 200, 189),
(55, 200, 190),
(56, 201, 191),
(57, 202, 199),
(58, 203, 199),
(59, 204, 200),
(61, 214, 202),
(62, 214, 203),
(63, 215, 204),
(64, 216, 212),
(65, 217, 212),
(66, 218, 213),
(68, 228, 215),
(69, 228, 216),
(70, 229, 217),
(71, 230, 225),
(72, 231, 225),
(73, 232, 226),
(75, 242, 228),
(76, 242, 229),
(77, 243, 230),
(79, 263, 272),
(80, 263, 273),
(81, 267, 290),
(82, 268, 290),
(83, 269, 291),
(85, 279, 293),
(86, 279, 294),
(87, 281, 303),
(88, 282, 303),
(89, 283, 304),
(91, 293, 306),
(92, 293, 307),
(94, 307, 319),
(95, 307, 320),
(96, 309, 329),
(97, 310, 329),
(98, 311, 330),
(100, 321, 332),
(101, 321, 333),
(102, 323, 342),
(103, 324, 342),
(104, 325, 343),
(106, 335, 345),
(107, 335, 346),
(108, 337, 355),
(109, 338, 355),
(110, 339, 356),
(112, 349, 358),
(113, 349, 359),
(114, 350, 360),
(115, 351, 368),
(116, 352, 368),
(117, 353, 369),
(119, 363, 371),
(120, 363, 372),
(121, 364, 373),
(122, 365, 381),
(123, 366, 381),
(124, 367, 382),
(126, 377, 384),
(127, 377, 385),
(128, 378, 386);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `stores_brands`
--
ALTER TABLE `stores_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;
--
-- AUTO_INCREMENT for table `stores_brands`
--
ALTER TABLE `stores_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
