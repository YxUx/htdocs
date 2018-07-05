/*
Navicat MySQL Data Transfer

Source Server         : baza1
Source Server Version : 100110
Source Host           : localhost:3306
Source Database       : pizzeria

Target Server Type    : MYSQL
Target Server Version : 100110
File Encoding         : 65001

Date: 2018-07-05 17:59:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id_address` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `house` varchar(5) NOT NULL,
  `flat` int(10) unsigned DEFAULT NULL,
  `phone` int(20) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  PRIMARY KEY (`id_address`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('19', 'test', 'test', 'test', '1', '0', '123321123', 'test', 'test');
INSERT INTO `address` VALUES ('20', 'test2', 'test2', 'test2', '2', '0', '22233414', 'test2', 'test2');
INSERT INTO `address` VALUES ('21', 'Rakowiecka', 'Zielona Góra', '67-056', '12', '0', '29938129', 'Jan', 'Kowalski');
INSERT INTO `address` VALUES ('22', 'Nawojki', 'Chorzów', '57-131', '122', '8', '4294967295', 'Maciej', 'Makuszna');
INSERT INTO `address` VALUES ('23', 'Wiejska', 'Warszawa', '81-182', '121', '2', '98283823', 'Adam', 'Buczyński');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id_order` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price_total` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `id_user` int(255) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_order`),
  KEY `user` (`id_user`),
  CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('4', '2018-07-04 22:19:53', '31.50', '19');
INSERT INTO `orders` VALUES ('9', '2018-07-05 03:42:58', '16.20', '18');
INSERT INTO `orders` VALUES ('10', '2018-07-05 16:43:24', '34.20', '22');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id_order_details` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `id_size` int(255) unsigned NOT NULL,
  `id_pizza` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_order_details`),
  KEY `size` (`id_size`),
  KEY `pizza` (`id_pizza`),
  CONSTRAINT `pizza` FOREIGN KEY (`id_pizza`) REFERENCES `pizza_name` (`id_pizza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `size` FOREIGN KEY (`id_size`) REFERENCES `sizes` (`id_size`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES ('3', '2', '2');
INSERT INTO `order_details` VALUES ('4', '1', '2');
INSERT INTO `order_details` VALUES ('5', '1', '7');

-- ----------------------------
-- Table structure for order_items
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id_order` int(10) unsigned DEFAULT NULL,
  `id_order_details` int(10) unsigned DEFAULT NULL,
  KEY `order` (`id_order`),
  KEY `orderDetails` (`id_order_details`),
  CONSTRAINT `order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderDetails` FOREIGN KEY (`id_order_details`) REFERENCES `order_details` (`id_order_details`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_items
-- ----------------------------
INSERT INTO `order_items` VALUES ('4', '3');
INSERT INTO `order_items` VALUES ('9', '4');
INSERT INTO `order_items` VALUES ('10', '5');

-- ----------------------------
-- Table structure for pizza
-- ----------------------------
DROP TABLE IF EXISTS `pizza`;
CREATE TABLE `pizza` (
  `id_pizza` int(255) unsigned NOT NULL,
  `id_topping` int(255) unsigned NOT NULL,
  KEY `topping` (`id_topping`),
  KEY `pizza_name` (`id_pizza`),
  CONSTRAINT `pizza_name` FOREIGN KEY (`id_pizza`) REFERENCES `pizza_name` (`id_pizza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `topping` FOREIGN KEY (`id_topping`) REFERENCES `toppings` (`id_topping`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of pizza
-- ----------------------------
INSERT INTO `pizza` VALUES ('1', '1');
INSERT INTO `pizza` VALUES ('1', '8');
INSERT INTO `pizza` VALUES ('2', '1');
INSERT INTO `pizza` VALUES ('2', '6');
INSERT INTO `pizza` VALUES ('2', '8');
INSERT INTO `pizza` VALUES ('3', '1');
INSERT INTO `pizza` VALUES ('3', '6');
INSERT INTO `pizza` VALUES ('3', '4');
INSERT INTO `pizza` VALUES ('4', '1');
INSERT INTO `pizza` VALUES ('4', '6');
INSERT INTO `pizza` VALUES ('4', '7');
INSERT INTO `pizza` VALUES ('7', '1');
INSERT INTO `pizza` VALUES ('7', '4');
INSERT INTO `pizza` VALUES ('7', '6');
INSERT INTO `pizza` VALUES ('7', '11');

-- ----------------------------
-- Table structure for pizza_name
-- ----------------------------
DROP TABLE IF EXISTS `pizza_name`;
CREATE TABLE `pizza_name` (
  `id_pizza` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name_p` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pizza`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of pizza_name
-- ----------------------------
INSERT INTO `pizza_name` VALUES ('1', 'Margarita');
INSERT INTO `pizza_name` VALUES ('2', 'Funghi');
INSERT INTO `pizza_name` VALUES ('3', 'Vesuvio');
INSERT INTO `pizza_name` VALUES ('4', 'Salami');
INSERT INTO `pizza_name` VALUES ('7', 'Capriciosa');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id_role` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'user');
INSERT INTO `role` VALUES ('2', 'admin');

-- ----------------------------
-- Table structure for sizes
-- ----------------------------
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
  `id_size` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `size` decimal(10,2) unsigned NOT NULL,
  `price_multipler` decimal(10,2) unsigned NOT NULL,
  PRIMARY KEY (`id_size`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sizes
-- ----------------------------
INSERT INTO `sizes` VALUES ('1', '30.00', '5.00');
INSERT INTO `sizes` VALUES ('2', '45.00', '6.00');
INSERT INTO `sizes` VALUES ('3', '60.00', '8.00');

-- ----------------------------
-- Table structure for toppings
-- ----------------------------
DROP TABLE IF EXISTS `toppings`;
CREATE TABLE `toppings` (
  `id_topping` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name_t` varchar(20) NOT NULL,
  `price_t` decimal(4,2) unsigned NOT NULL,
  PRIMARY KEY (`id_topping`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of toppings
-- ----------------------------
INSERT INTO `toppings` VALUES ('1', 'ser', '1.50');
INSERT INTO `toppings` VALUES ('3', 'pepperoni', '1.90');
INSERT INTO `toppings` VALUES ('4', 'szynka', '1.20');
INSERT INTO `toppings` VALUES ('5', 'kukurydza', '0.70');
INSERT INTO `toppings` VALUES ('6', 'pieczarki', '1.00');
INSERT INTO `toppings` VALUES ('7', 'salami', '1.40');
INSERT INTO `toppings` VALUES ('8', 'oreagano', '0.20');
INSERT INTO `toppings` VALUES ('9', 'chilli', '1.80');
INSERT INTO `toppings` VALUES ('11', 'mozarella', '2.00');
INSERT INTO `toppings` VALUES ('12', 'Jalapeno', '1.80');
INSERT INTO `toppings` VALUES ('13', 'pomidor', '0.90');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_address` int(255) unsigned DEFAULT NULL,
  `id_role` int(255) unsigned NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`),
  KEY `address` (`id_address`),
  CONSTRAINT `address` FOREIGN KEY (`id_address`) REFERENCES `address` (`id_address`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('18', 'test@test.pl', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '19', '1');
INSERT INTO `user` VALUES ('19', 'test2@test2.pl', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', '20', '2');
INSERT INTO `user` VALUES ('20', 'test3@test3.pl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '21', '1');
INSERT INTO `user` VALUES ('21', 'mmk@ko.pl', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '22', '1');
INSERT INTO `user` VALUES ('22', 'abc@abc.pl', 'a9993e364706816aba3e25717850c26c9cd0d89d', '23', '1');

-- ----------------------------
-- View structure for pizzatoppings
-- ----------------------------
DROP VIEW IF EXISTS `pizzatoppings`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `pizzatoppings` AS SELECT pn.name_p, price_t FROM pizza_name pn 
LEFT JOIN pizza p ON pn.id_pizza=p.id_pizza 
LEFT JOIN toppings t ON p.id_topping=t.id_topping ;

-- ----------------------------
-- View structure for toppings_list
-- ----------------------------
DROP VIEW IF EXISTS `toppings_list`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `toppings_list` AS SELECT name_p, name_t FROM pizza_name pn 
LEFT JOIN pizza p ON pn.id_pizza=p.id_pizza 
LEFT JOIN toppings t ON p.id_topping=t.id_topping ;

-- ----------------------------
-- View structure for vieworders
-- ----------------------------
DROP VIEW IF EXISTS `vieworders`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `vieworders` AS SELECT a.name, a.surname, o.id_order, o.price_total, o.date, s.size, p.name_p FROM address a 
JOIN user u ON a.id_address=u.id_address 
JOIN orders o ON u.id_user=o.id_user
JOIN order_items i ON o.id_order=i.id_order
JOIN order_details d ON i.id_order_details=d.id_order_details
JOIN sizes s ON d.id_size=s.id_size
JOIN pizza_name p ON d.id_pizza=p.id_pizza ;

-- ----------------------------
-- Function structure for checkRole
-- ----------------------------
DROP FUNCTION IF EXISTS `checkRole`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `checkRole`(_id INT) RETURNS tinyint(4)
BEGIN
	DECLARE temp TINYINT;
    SELECT id_role INTO temp FROM user WHERE id_user=_id;
	RETURN temp;

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for checkUser
-- ----------------------------
DROP FUNCTION IF EXISTS `checkUser`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `checkUser`(email_ VARCHAR(50)) RETURNS tinyint(1)
BEGIN
	IF EXISTS (SELECT email FROM user WHERE email = email_) THEN
   	 RETURN 1; 
               ELSE
               RETURN 0;
               END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `addTime`;
DELIMITER ;;
CREATE TRIGGER `addTime` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
	SET NEW.date = CURRENT_TIMESTAMP; 
END
;;
DELIMITER ;
