-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 28, 2024 at 05:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_making`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `id` int(11) NOT NULL,
  `recipename` varchar(255) NOT NULL,
  `image_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breakfast`
--

INSERT INTO `breakfast` (`id`, `recipename`, `image_name`) VALUES
(1, 'dosa', '1732695787_dosa2.jpg'),
(2, 'idli', 'idli image.webp'),
(3, 'poori', 'poori.jpg'),
(4, 'alooparatha', 'Aloo-Paratha.jpg'),
(5, 'sandwich', 'sandwich.jpg'),
(6, 'dosa', '1732776281_dosa2.jpg'),
(7, 'dosa', ''),
(8, 'dosa', ''),
(9, 'dosa', ''),
(10, 'dosa', '1732787520_dosa2.jpg'),
(11, 'idli', '1732788894_idli image.webp');

-- --------------------------------------------------------

--
-- Table structure for table `breakfast2`
--

CREATE TABLE `breakfast2` (
  `id` int(11) NOT NULL,
  `recipename` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dessert`
--

CREATE TABLE `dessert` (
  `id` int(11) NOT NULL,
  `recipename` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dessert`
--

INSERT INTO `dessert` (`id`, `recipename`, `image_name`) VALUES
(1, 'cake', 'cake.jpg'),
(2, 'brownie', 'brownie.jpg'),
(3, 'gulabjamun', 'gulabjamun.jpg'),
(4, 'rasamalai', 'rasamalai.webp'),
(5, 'carrotkheer', 'carrotkheer.webp');

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

CREATE TABLE `dinner` (
  `id` int(11) NOT NULL,
  `recipename` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinner`
--

INSERT INTO `dinner` (`id`, `recipename`, `image_name`) VALUES
(1, 'paneerbuttermasala', '1732702541_paneer-butter-masala.webp'),
(2, 'aloogobi', '1732702598_Aloo_Gobi_Cauliflower_Potato_Stir_Fry.jpg'),
(3, 'curdrice', '1732702624_Curd-Rice.webp'),
(4, 'uttapam', '1732702644_Rava-Uttapam.jpg'),
(5, 'chickencurry', '1732702672_chickencurry.jpg'),
(6, 'chapati', '1732789306_Chapati.webp');

-- --------------------------------------------------------

--
-- Table structure for table `displayprofile`
--

CREATE TABLE `displayprofile` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `followers` int(255) NOT NULL,
  `followings` int(255) NOT NULL,
  `posts` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `displayprofile`
--

INSERT INTO `displayprofile` (`id`, `username`, `profile_image`, `followers`, `followings`, `posts`) VALUES
(1, 'viji', '\\uploads\\profileimg.png', 200, 300, 0),
(2, '', '', 0, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `forgetpassword`
--

CREATE TABLE `forgetpassword` (
  `id` int(11) NOT NULL,
  `newpassword` varchar(255) NOT NULL,
  `confirmpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forgetpassword`
--

INSERT INTO `forgetpassword` (`id`, `newpassword`, `confirmpassword`) VALUES
(1, '1234', '1234'),
(2, '123\n', '123');

-- --------------------------------------------------------

--
-- Table structure for table `ingrediants`
--

CREATE TABLE `ingrediants` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingrediants`
--

INSERT INTO `ingrediants` (`id`, `name`, `quantity`) VALUES
(1, 'egg', '4 large eggs'),
(2, 'butter', '6 tspn'),
(3, 'Milk', '3 cup'),
(4, 'sugar', '4 tspn'),
(5, 'Flour', '4 cup'),
(6, 'Baking powder', '4 tspn');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'viji', 'viji@123'),
(2, 'john', 'john123'),
(3, 'viji', 'viji@123'),
(6, 'viji', '123'),
(7, 'viji', '123l');

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `id` int(11) NOT NULL,
  `recipename` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`id`, `recipename`, `image_name`) VALUES
(1, 'gheerice', 'Ghee Rice.JPG'),
(2, 'vegpulavo', 'vegpulavo.jpg'),
(3, 'eggfriedrice', 'eggfriedrice.webp'),
(4, 'redsaucepasta', 'redsaucepasta.png'),
(5, 'vegsalad', 'vegsalad.jpg'),
(16, 'gheerice', '1732776470_Ghee Rice.JPG'),
(17, 'gheerice', ''),
(18, 'dosa', ''),
(19, 'gheerice', '1732788186_Ghee Rice.JPG'),
(20, 'gheerice', '1732789024_Ghee Rice.JPG'),
(21, 'gheerice', '1732789900_Ghee Rice.JPG'),
(22, 'gheerice', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipeoverview`
--

CREATE TABLE `recipeoverview` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `recipeimage` varchar(255) NOT NULL,
  `preparationtime` int(255) NOT NULL,
  `cookingtime` int(255) NOT NULL,
  `servings` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipeoverview`
--

INSERT INTO `recipeoverview` (`id`, `title`, `recipeimage`, `preparationtime`, `cookingtime`, `servings`) VALUES
(1, 'pancakes', '\\uploads\\pancakes.jpg', 10, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shareyourexperience`
--

CREATE TABLE `shareyourexperience` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ratings` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shareyourexperience`
--

INSERT INTO `shareyourexperience` (`id`, `username`, `ratings`, `review`) VALUES
(1, 'viji', '4.5 ratings', 'I tried this recipe it came out so well');

-- --------------------------------------------------------

--
-- Table structure for table `stepsofinstruction`
--

CREATE TABLE `stepsofinstruction` (
  `step1` varchar(255) NOT NULL,
  `step2` varchar(255) NOT NULL,
  `step3` varchar(255) NOT NULL,
  `step4` varchar(255) NOT NULL,
  `step5` varchar(255) NOT NULL,
  `step6` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stepsofinstruction`
--

INSERT INTO `stepsofinstruction` (`step1`, `step2`, `step3`, `step4`, `step5`, `step6`) VALUES
('Combine 1 cup flour, 2 tsp sugar, 1 tsp baking powder, and 1/2 tsp salt in a bowl.', 'Whisk 1 egg, 3/4 cup milk, and 2 tbsp melted butter in another bowl.', 'Gradually mix wet ingredients into dry, stirring until just combined (lumps are okay).', 'Heat a non-stick pan or griddle over medium heat; lightly grease with butter or oil.', 'Pour 1/4 cup batter for each pancake; flip when bubbles form, cooking until golden.', 'Stack, top with syrup, fruit, or butter, and enjoy your delicious pancakes!');

-- --------------------------------------------------------

--
-- Table structure for table `trendingrecipes`
--

CREATE TABLE `trendingrecipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ratings` varchar(255) NOT NULL,
  `image_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trendingrecipes`
--

INSERT INTO `trendingrecipes` (`id`, `name`, `ratings`, `image_name`) VALUES
(1, 'pancakes', '4.5', '1732686313_pancakes.jpg'),
(2, 'salad', '4.0', 'salad.jpeg'),
(3, 'parrotta', '4.0', 'malabar-paratha.webp'),
(4, 'pasta', '4.3', 'WhiteSaucePasta.jpg'),
(5, 'panipuri', '4.0', 'Pani-Puri.jpg'),
(7, 'panakes\n', '4.0', '1732776141_pancakes.jpg'),
(8, 'panakes\n', '4.0', ''),
(9, 'panakes\n', '4.0', ''),
(10, 'pancakes', '4.0', '1732789761_pancakes.jpg'),
(11, 'pancakes', '4.0', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breakfast2`
--
ALTER TABLE `breakfast2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dessert`
--
ALTER TABLE `dessert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `displayprofile`
--
ALTER TABLE `displayprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpassword`
--
ALTER TABLE `forgetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingrediants`
--
ALTER TABLE `ingrediants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipeoverview`
--
ALTER TABLE `recipeoverview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shareyourexperience`
--
ALTER TABLE `shareyourexperience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stepsofinstruction`
--
ALTER TABLE `stepsofinstruction`
  ADD PRIMARY KEY (`step6`);

--
-- Indexes for table `trendingrecipes`
--
ALTER TABLE `trendingrecipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `breakfast`
--
ALTER TABLE `breakfast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `breakfast2`
--
ALTER TABLE `breakfast2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dessert`
--
ALTER TABLE `dessert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dinner`
--
ALTER TABLE `dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `displayprofile`
--
ALTER TABLE `displayprofile`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forgetpassword`
--
ALTER TABLE `forgetpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ingrediants`
--
ALTER TABLE `ingrediants`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lunch`
--
ALTER TABLE `lunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recipeoverview`
--
ALTER TABLE `recipeoverview`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shareyourexperience`
--
ALTER TABLE `shareyourexperience`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trendingrecipes`
--
ALTER TABLE `trendingrecipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
