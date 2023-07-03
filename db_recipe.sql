-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_recipe
CREATE DATABASE IF NOT EXISTS `db_recipe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_recipe`;

-- Dumping structure for table db_recipe.admin_log
CREATE TABLE IF NOT EXISTS `admin_log` (
  `userId` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.admin_log: ~0 rows (approximately)
INSERT INTO `admin_log` (`userId`, `username`, `password`) VALUES
	('admin@admin.com', 'ziard', 'x04JsnCBpiEfU');

-- Dumping structure for table db_recipe.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.coupons: ~4 rows (approximately)
INSERT INTO `coupons` (`coupon_id`, `title`, `description`, `price`) VALUES
	(1, 'coupon 1', '10% Discount', 1500),
	(2, 'coupon 2', '20% Discount', 2500),
	(3, 'coupon 2', '30% Discount', 3500),
	(4, 'coupon 4', '40% Discount', 4500);

-- Dumping structure for table db_recipe.cus_log
CREATE TABLE IF NOT EXISTS `cus_log` (
  `cusId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`cusId`,`email`,`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.cus_log: ~4 rows (approximately)
INSERT INTO `cus_log` (`cusId`, `name`, `email`, `phone`, `password`, `points`, `username`) VALUES
	(1, 'Mohomed Ziard', 'ziard@gmail.com', '769784104', 'x0Qo8PIdMK7.o', 0, 'ziard47'),
	(2, 'john doe', 'john@gmail.com', '12345670', 'x0wZKvceJ2vv2', 10, 'john'),
	(4, 'scooby doo', 'scoob@gmail.com', '0115464104', 'x0XlOlZT6jslI', 430, 'scoob'),
	(5, 'harry potter', 'harry@gmail.com', '69696969', 'x0pNA3diD/Zi.', 0, 'hary69');

-- Dumping structure for table db_recipe.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `cusId` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `redeemed_date` date NOT NULL,
  `code` text NOT NULL DEFAULT '0',
  PRIMARY KEY (`inventory_id`),
  KEY `cusId` (`cusId`),
  KEY `coupon_id` (`coupon_id`),
  CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`cusId`) REFERENCES `cus_log` (`cusId`),
  CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.inventory: ~2 rows (approximately)
INSERT INTO `inventory` (`inventory_id`, `cusId`, `coupon_id`, `redeemed_date`, `code`) VALUES
	(10, 1, 1, '2023-07-02', 'BZGXN-HZBRO-BOUCN'),
	(11, 1, 1, '2023-07-02', 'ODRJT-BTNCD-PKPHE'),
	(12, 2, 1, '2023-07-02', 'MLGCL-QLZOY-EHXGL');

-- Dumping structure for table db_recipe.recipes
CREATE TABLE IF NOT EXISTS `recipes` (
  `recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `preparation_time` int(11) NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `uploaded_by` varchar(100) NOT NULL,
  `picture` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `date` date NOT NULL DEFAULT curdate(),
  `views` int(11) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'in_review',
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.recipes: ~5 rows (approximately)
INSERT INTO `recipes` (`recipe_id`, `title`, `description`, `preparation_time`, `cooking_time`, `servings`, `uploaded_by`, `picture`, `date`, `views`, `status`) VALUES
	(1, 'Pasta Salad', 'This easy pasta salad recipe comes together quickly with convenient ingredients and colorful vegetables.', 20, 10, 5, 'john', '1_6499be47528a9.jpg', '2023-06-26', 21, 'accepted'),
	(2, 'Chicken Kottu', 'An all-time Sri Lankan favourite! You can now make spicy chicken kottu from scratch, in the comfort of your own home!', 30, 20, 5, 'ziard47', '2_6499f428e392c.jpg', '2023-06-27', 9, 'accepted'),
	(3, 'Chicken Fried Rice', 'Moist and fluffy chicken fried rice with a ginger garlic vegetable stir-fry.', 15, 10, 5, 'john', '3_6499f6a47d780.jpg', '2023-06-27', 51, 'accepted'),
	(30, 'Mango Ice Cream', 'This 3 ingredient mango ice cream is no-churn and can be made in an ice cream maker such as the Ninja CREAMi or just poured into a freezer safe container. How easy can it get?', 15, 0, 10, 'scoob', '30_649de848e8d0a.jpg', '2023-06-30', 15, 'accepted'),
	(31, 'Stir Fried Noodles', 'Steaming stir-fried chicken noodles with fresh vegetables, topped with roasted sesame seeds.', 30, 20, 4, 'scoob', '31_649deacdbda67.jpg', '2023-06-30', 28, 'accepted');

-- Dumping structure for table db_recipe.recipe_ingredients
CREATE TABLE IF NOT EXISTS `recipe_ingredients` (
  `ingredient_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) DEFAULT NULL,
  `ingredient_name` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.recipe_ingredients: ~42 rows (approximately)
INSERT INTO `recipe_ingredients` (`ingredient_id`, `recipe_id`, `ingredient_name`, `quantity`, `unit`) VALUES
	(41, 2, 'plain flour', '250g', '1'),
	(42, 2, 'teaspoon salt', '1/2', '1'),
	(43, 2, 'tablespoon oil to mix', '1', '1'),
	(44, 2, 'cup oil for dipping', '1', '1'),
	(45, 2, 'roasted or cooked chicken, cut into cubes', '200g', '1'),
	(46, 2, 'sachet Knorr Chicken Powder Mix', '1', '1'),
	(47, 2, 'tablespoons Knorr Chinese Chilli Recipe Mix', '3', '1'),
	(48, 2, 'carrots, shredded', '100g', '1'),
	(49, 2, 'leeks, shredded', '100g', '1'),
	(50, 2, 'large onions, diced', '2', '1'),
	(51, 2, 'green chillies, sliced', '2-3', '1'),
	(52, 2, 'cup spring onion leaves', '1', '1'),
	(53, 2, 'garlic cloves, crushed', '2-3', '1'),
	(54, 2, 'inch piece ginger, chopped', '1', '1'),
	(55, 2, 'A handful of curry leaves', '1', '1'),
	(56, 2, 'peeled tomatoes, cut into wedges', '2', '1'),
	(57, 2, 'tablespoons Astra', '2-3', '1'),
	(58, 2, 'Salt and crushed pepper to taste', '1', '1'),
	(153, 30, 'cupsmango puree (from 4 to 5 mangos)', '1', ''),
	(154, 30, 'cup heavy cream', '1', ''),
	(155, 30, 'cup white sugar', '1', ''),
	(156, 31, 'noodles', '200g', ''),
	(157, 1, 'tri-colored spiral pasta', '1', ''),
	(158, 1, 'Italian-style salad dressing', '1', ''),
	(159, 1, ' salad seasoning mix', '6', ''),
	(160, 1, 'cherry tomatoes, diced', '2', ''),
	(161, 1, 'green bell pepper, chopped', '1', ''),
	(162, 1, 'red bell pepper, diced', '1', ''),
	(163, 1, 'yellow bell pepper, chopped', '1/2', ''),
	(164, 1, 'black olives, chopped', '1', ''),
	(165, 3, 'basmati or samba rice, cooked', '500g', '1'),
	(166, 3, 'boneless chicken, cut into small cubes', '250g', '1'),
	(167, 3, 'carrot, julienned', '50g', '1'),
	(168, 3, 'leeks, julienned (green part)', '50g', '1'),
	(169, 3, 'leek stalk, julienned', '50g', '1'),
	(170, 3, 'Knorr Chicken Cube', '1', '1'),
	(171, 3, 'eggs, beaten', '3', '1'),
	(172, 3, 'onion, chopped', '1', '1'),
	(173, 3, 'garlic cloves, chopped', '2', '1'),
	(174, 3, 'inch ginger, chopped', '1', '1'),
	(175, 3, 'Astra', '20g', '1'),
	(176, 3, 'Salt and pepper to taste', '1', '1');

-- Dumping structure for table db_recipe.recipe_steps
CREATE TABLE IF NOT EXISTS `recipe_steps` (
  `step_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) DEFAULT NULL,
  `step_number` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`step_id`),
  KEY `recipe_id` (`recipe_id`),
  CONSTRAINT `recipe_steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_recipe.recipe_steps: ~25 rows (approximately)
INSERT INTO `recipe_steps` (`step_id`, `recipe_id`, `step_number`, `description`) VALUES
	(31, 2, 1, 'For the roti, mix in the flour and salt with 1 tab'),
	(32, 2, 2, 'Add water gradually and knead well till it becomes'),
	(33, 2, 3, 'Divide the dough into small, equal-sized balls. In'),
	(34, 2, 4, 'Heat a large pan (according to the size you want t'),
	(35, 2, 5, 'Using your palm, flatten the dough into thin rotis'),
	(36, 2, 6, 'For the kottu mixture, heat Astra in a pan. Add ga'),
	(37, 2, 7, 'Add chicken, green chilli, carrot, leek and sauté '),
	(38, 2, 8, 'Add Knorr Chicken Powder Mix, Knorr Chinese Chilli'),
	(39, 2, 9, 'Finally add the chopped rotis and mix it up. Garni'),
	(154, 30, 1, 'Peel and dice mangoes. Place in a blender and blend until pureed; measure out 1 1/2 cups puree; set aside. Refrigerate remaining puree for another use.'),
	(155, 30, 2, 'Whip heavy cream and sugar with an electric mixer on high speed until soft peaks form. Reduce the mixer speed to low and mix in mango puree.'),
	(156, 30, 3, 'Pour into Ninja® CREAMi™ containers or into a freezer-safe bowl. Freeze for 24 hours if using Ninja® CREAMi™ or for 8 hours to overnight if freezing in a container.'),
	(157, 30, 4, 'Following manufacturers instructions, insert the pint container into the outer bowl of Ninja® CREAMi™. Push “Ice Cream” button. If freezing in a container, remove from the freezer and let sit for 8 to 10 minutes or until soft enough to scoop.'),
	(158, 31, 1, 'Pour boiling water over noodles and add salt and olive oil. Cover for 3 minutes for the flavours to infuse. Then strain and wash in running water.'),
	(159, 1, 1, 'Gather all ingredients.'),
	(160, 1, 2, 'Bring a large pot of lightly salted water to a boi'),
	(161, 1, 3, 'Whisk Italian dressing and salad spice mix togethe'),
	(162, 1, 4, 'Pour dressing over salad and toss to coat.'),
	(163, 1, 5, 'Refrigerate salad, 8 hours to overnight.'),
	(164, 1, 6, 'Enjoy!!!'),
	(165, 3, 1, 'Melt Astra in a pan and add onion, garlic and ging'),
	(166, 3, 2, 'Scramble the eggs in a separate pan and set aside.'),
	(167, 3, 3, 'Add chicken, a pinch of salt and pepper and cook f'),
	(168, 3, 4, 'Add carrot, leeks, leek stalk and Knorr Chicken Cu'),
	(169, 3, 5, 'Add cooked rice and scrambled eggs. Mix well and s');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
