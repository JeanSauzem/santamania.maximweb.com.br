/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100126
 Source Host           : localhost:3306
 Source Schema         : maximweb_santamania

 Target Server Type    : MySQL
 Target Server Version : 100126
 File Encoding         : 65001

 Date: 21/10/2017 10:05:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('20170915122424');
INSERT INTO `migrations` VALUES ('20170916124901');
INSERT INTO `migrations` VALUES ('20170916155203');
INSERT INTO `migrations` VALUES ('20170916160143');
INSERT INTO `migrations` VALUES ('20170916173037');
INSERT INTO `migrations` VALUES ('20171009124648');
COMMIT;

-- ----------------------------
-- Table structure for product_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
BEGIN;
INSERT INTO `product_categories` VALUES (1, '61ffa4f0544a09130eb5ef9efd3453636e9d2321da28932241192508730baf3184iHhZAvTgdy6tUcI+V09pMOZFPWzWRWvtmgpD2wxwc=', 1, '2017-10-09 16:53:30', '2017-10-09 16:57:16');
COMMIT;

-- ----------------------------
-- Table structure for product_status
-- ----------------------------
DROP TABLE IF EXISTS `product_status`;
CREATE TABLE `product_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_id` int(11) DEFAULT NULL,
  `units_measure_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_product_categories1_idx` (`product_category_id`),
  KEY `fk_products_unit_measures1_idx` (`units_measure_id`),
  CONSTRAINT `fk_products_product_categories1_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_unit_measures1_id` FOREIGN KEY (`units_measure_id`) REFERENCES `units_measure` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES (1, 1, 1, '46065cf13d6f33fff5d15b74a8e617082aeeb665af62296bf4c71e2948861719MdWsYnLPQYJEs5sven0XlZ7izG7JG31YlYeMWZIucKUofkdm8g4OXT3WTGe6A3+d', 1, '2017-09-16 21:29:09', '2017-10-09 17:12:38');
COMMIT;

-- ----------------------------
-- Table structure for units_measure
-- ----------------------------
DROP TABLE IF EXISTS `units_measure`;
CREATE TABLE `units_measure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of units_measure
-- ----------------------------
BEGIN;
INSERT INTO `units_measure` VALUES (1, '2bdab31bc97ba08d1d70d0218580649e2f2196423d5b1d5aeafb8e740ae4ee86BEvZWMEcXkjMNJ6QhMxmPEonuW1BlVMZe2Dn/ShGqcA=', '8a309cfa1041c93bfddec7a7f4ed7533118c20e1a2a70b23610235ca16eb409742ajeKN2wgR6WugRYj1D/w++3bqMAk3ihCdcKdRh1e8=', '2017-10-09 17:05:13', '2017-10-09 17:11:52');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `activation_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (4, 'Marcelo', 'Corrêa', 'marcelocorrea229@gmail.com', '$2y$10$uXMwx5alcoJ0kmL4XQtROO2ci8qgq7bbwvUuPta2p1TZtlt7ikKy2', 1, 1, 'asdfa9s8df76gs98df76gs9', '2017-09-15 12:35:00', '2017-09-15 17:37:05');
COMMIT;

-- ----------------------------
-- Table structure for warehouses
-- ----------------------------
DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of warehouses
-- ----------------------------
BEGIN;
INSERT INTO `warehouses` VALUES (1, '1e791eef82770e2', 'c6e5a82713655f1924acf01a10f36d9c71d900a05a6082f7c73c8776b3223689+wV+xUnR3rt3mGroLna3ror0jlrOyxUgW+3j1iJU6bA=', 1, '2017-10-09 14:56:59', '2017-10-09 15:25:25');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
