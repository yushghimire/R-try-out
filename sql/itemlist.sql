-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 04:15 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims2`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemlist`
--

CREATE TABLE `itemlist` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `costPrice` float NOT NULL,
  `sellPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemlist`
--

INSERT INTO `itemlist` (`itemId`, `itemName`, `quantity`, `costPrice`, `sellPrice`) VALUES
(1, 'tropical fruit', 1, 343, 409),
(2, 'whole milk', 85, 875, 932),
(3, 'pip fruit', 88, 456, 533),
(4, 'other vegetables', 57, 76, 150),
(5, 'rolls/buns', 85, 643, 758),
(6, 'pot plants', 64, 572, 655),
(7, 'citrus fruit', 13, 617, 722),
(8, 'beef', 50, 783, 863),
(9, 'frankfurter', 16, 145, 227),
(10, 'chicken', 54, 450, 543),
(11, 'butter', 45, 351, 401),
(12, 'fruit/vegetable juice', 48, 764, 880),
(13, 'packaged fruit/vegetables', 71, 210, 283),
(14, 'chocolate', 92, 355, 439),
(15, 'specialty bar', 88, 500, 592),
(16, 'butter milk', 57, 337, 452),
(17, 'bottled water', 62, 480, 593),
(18, 'yogurt', 74, 741, 837),
(19, 'sausage', 71, 930, 991),
(20, 'brown bread', 20, 660, 733),
(21, 'hamburger meat', 15, 671, 772),
(22, 'root vegetables', 6, 690, 806),
(23, 'pork', 26, 521, 610),
(24, 'pastry', 97, 362, 451),
(25, 'canned beer', 36, 236, 294),
(26, 'berries', 56, 179, 297),
(27, 'coffee', 40, 230, 337),
(28, 'misc. beverages', 0, 114, 212),
(29, 'ham', 100, 72, 155),
(30, 'turkey', 62, 399, 469),
(31, 'curd cheese', 69, 789, 867),
(32, 'red/blush wine', 23, 382, 450),
(33, 'frozen potato products', 60, 661, 719),
(34, 'flour', 99, 694, 765),
(35, 'sugar', 64, 235, 336),
(36, 'frozen meals', 90, 632, 718),
(37, 'herbs', 83, 139, 201),
(38, 'soda', 56, 787, 872),
(39, 'detergent', 32, 41, 145),
(40, 'grapes', 82, 548, 628),
(41, 'processed cheese', 12, 868, 987),
(42, 'fish', 64, 921, 982),
(43, 'sparkling wine', 74, 750, 853),
(44, 'newspapers', 83, 366, 440),
(45, 'curd', 77, 238, 341),
(46, 'pasta', 49, 570, 676),
(47, 'popcorn', 76, 555, 632),
(48, 'finished products', 1, 174, 254),
(49, 'beverages', 85, 337, 443),
(50, 'bottled beer', 11, 396, 456),
(51, 'dessert', 80, 199, 298),
(52, 'dog food', 49, 473, 524),
(53, 'specialty chocolate', 35, 817, 928),
(54, 'condensed milk', 83, 83, 157),
(55, 'cleaner', 31, 686, 740),
(56, 'white wine', 100, 125, 221),
(57, 'meat', 63, 629, 682),
(58, 'ice cream', 76, 574, 643),
(59, 'hard cheese', 16, 160, 253),
(60, 'cream cheese ', 33, 314, 375),
(61, 'liquor', 74, 321, 403),
(62, 'pickled vegetables', 23, 213, 293),
(63, 'liquor (appetizer)', 28, 202, 265),
(64, 'UHT-milk', 95, 182, 237),
(65, 'candy', 78, 221, 278),
(66, 'onions', 51, 922, 975),
(67, 'hair spray', 85, 500, 566),
(68, 'photo/film', 94, 842, 922),
(69, 'domestic eggs', 94, 686, 754),
(70, 'margarine', 82, 595, 694),
(71, 'shopping bags', 33, 135, 198),
(72, 'salt', 74, 452, 559),
(73, 'oil', 97, 57, 144),
(74, 'whipped/sour cream', 69, 770, 884),
(75, 'frozen vegetables', 75, 415, 489),
(76, 'sliced cheese', 9, 646, 751),
(77, 'dish cleaner', 66, 384, 475),
(78, 'baking powder', 35, 390, 509),
(79, 'specialty cheese', 52, 44, 101),
(80, 'salty snack', 73, 875, 929),
(81, 'Instant food products', 73, 575, 625),
(82, 'pet care', 15, 287, 341),
(83, 'white bread', 30, 293, 385),
(84, 'female sanitary products', 34, 781, 883),
(85, 'cling film/bags', 54, 67, 149),
(86, 'soap', 87, 288, 339),
(87, 'frozen chicken', 37, 84, 146),
(88, 'house keeping products', 30, 596, 656),
(89, 'spread cheese', 15, 272, 330),
(90, 'decalcifier', 9, 573, 663),
(91, 'frozen dessert', 88, 26, 132),
(92, 'vinegar', 2, 813, 893),
(93, 'nuts/prunes', 86, 241, 303),
(94, 'potato products', 73, 645, 697),
(95, 'frozen fish', 47, 735, 821),
(96, 'hygiene articles', 20, 596, 666),
(97, 'artif. sweetener', 52, 111, 176),
(98, 'light bulbs', 23, 902, 967),
(99, 'canned vegetables', 80, 598, 680),
(100, 'chewing gum', 18, 708, 766),
(101, 'canned fish', 93, 318, 393),
(102, 'cookware', 70, 37, 119),
(103, 'semi-finished bread', 79, 553, 651),
(104, 'cat food', 38, 876, 992),
(105, 'bathroom cleaner', 47, 714, 789),
(106, 'prosecco', 85, 127, 228),
(107, 'liver loaf', 12, 504, 554),
(108, 'zwieback', 41, 300, 378),
(109, 'canned fruit', 65, 865, 942),
(110, 'frozen fruits', 44, 4, 115),
(111, 'brandy', 25, 622, 697),
(112, 'baby cosmetics', 97, 374, 425),
(113, 'spices', 27, 198, 307),
(114, 'napkins', 65, 60, 123),
(115, 'waffles', 47, 771, 871),
(116, 'sauces', 32, 425, 495),
(117, 'rum', 1, 770, 854),
(118, 'chocolate marshmallow', 94, 437, 491),
(119, 'long life bakery product', 57, 580, 699),
(120, 'bags', 56, 630, 690),
(121, 'sweet spreads', 94, 216, 270),
(122, 'soups', 89, 586, 672),
(123, 'mustard', 98, 294, 369),
(124, 'specialty fat', 84, 582, 699),
(125, 'instant coffee', 14, 417, 531),
(126, 'snack products', 38, 325, 428),
(127, 'organic sausage', 58, 645, 724),
(128, 'soft cheese', 91, 355, 462),
(129, 'mayonnaise', 41, 393, 443),
(130, 'dental care', 35, 765, 834),
(131, 'roll products ', 22, 547, 628),
(132, 'kitchen towels', 44, 86, 152),
(133, 'flower soil/fertilizer', 1, 189, 309),
(134, 'cereals', 39, 529, 605),
(135, 'meat spreads', 38, 214, 317),
(136, 'dishes', 51, 32, 151),
(137, 'male cosmetics', 34, 54, 158),
(138, 'candles', 97, 667, 753),
(139, 'whisky', 77, 89, 148),
(140, 'tidbits', 28, 856, 919),
(141, 'cooking chocolate', 88, 691, 807),
(142, 'seasonal products', 26, 476, 561),
(143, 'liqueur', 6, 483, 547),
(144, 'abrasive cleaner', 43, 849, 917),
(145, 'syrup', 66, 632, 712),
(146, 'ketchup', 84, 390, 473),
(147, 'cream', 93, 112, 172),
(148, 'skin care', 49, 910, 994),
(149, 'rubbing alcohol', 25, 864, 944),
(150, 'nut snack', 58, 286, 382),
(151, 'cocoa drinks', 14, 722, 832),
(152, 'softener', 82, 303, 361),
(153, 'organic products', 22, 118, 233),
(154, 'cake bar', 25, 498, 558),
(155, 'honey', 19, 224, 323),
(156, 'jam', 42, 516, 570),
(157, 'kitchen utensil', 93, 337, 410),
(158, 'flower (seeds)', 3, 38, 108),
(159, 'rice', 34, 125, 184),
(160, 'tea', 16, 91, 181),
(161, 'salad dressing', 32, 354, 449),
(162, 'specialty vegetables', 17, 287, 395),
(163, 'pudding powder', 47, 611, 689),
(164, 'ready soups', 47, 468, 585),
(165, 'make up remover', 90, 562, 655),
(166, 'toilet cleaner', 26, 38, 116),
(167, 'preservation products', 99, 162, 258);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemlist`
--
ALTER TABLE `itemlist`
  ADD PRIMARY KEY (`itemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemlist`
--
ALTER TABLE `itemlist`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
