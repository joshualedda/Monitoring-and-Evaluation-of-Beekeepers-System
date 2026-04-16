/*
 Navicat Premium Data Transfer

 Source Server         : c
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : meb

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 16/01/2020 12:01:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for apiary
-- ----------------------------
DROP TABLE IF EXISTS `apiary`;
CREATE TABLE `apiary`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay_id` int(11) NULL DEFAULT NULL,
  `beekeeper_id` int(11) NOT NULL,
  `lgu_id` int(11) NOT NULL,
  `province_id` int(11) NULL DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  `source_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `topography_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `area_size` decimal(12, 2) NULL DEFAULT NULL,
  `coordinate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `location` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `map` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `zip_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `beekeeper_id`(`beekeeper_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for association
-- ----------------------------
DROP TABLE IF EXISTS `association`;
CREATE TABLE `association`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barangay_id` int(11) NULL DEFAULT NULL,
  `lgu_id` int(11) NULL DEFAULT NULL,
  `province_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `association_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `contact_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `website` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) UNSIGNED ZEROFILL NOT NULL COMMENT '1=active  2=inactive',
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `association_name`(`association_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of association
-- ----------------------------
INSERT INTO `association` VALUES (1, 1, 1, 26, 2, 'address', 'Association 1', NULL, '', '', '', '', 1, '2020-01-08 23:06:10', 23);
INSERT INTO `association` VALUES (2, 1, 1, 66, 2, 'qw', 'sd', 'sadsadas', '', '', '', '', 1, '2020-01-09 21:32:58', 23);
INSERT INTO `association` VALUES (3, 2, 2, 9, 3, 'test', 'Associationzzzz', 'test', 'test', 'test', '<p>test</p>', 'test', 1, '2020-01-12 00:41:51', 23);
INSERT INTO `association` VALUES (4, 2, 2, 9, 3, 'test', 'test', 'test', 'test', 'test', '<p>111</p>', 'test', 1, '2020-01-12 00:46:13', 23);
INSERT INTO `association` VALUES (5, 2, 2, 9, 3, 'xxxxxxxxxxxxx', 'xxxxxxxxxxxxxxx', 'xxxxxxxxxx', 'zzz', 'zzz', '<p>zzzz</p>', 'zzz', 1, '2020-01-12 01:15:47', 23);
INSERT INTO `association` VALUES (7, 2, 2, 9, 3, 'adasdasda', 'asdadas', 'dsadsadsad', 'asdasdas', 'sadasd', '<p>test</p>', 'sadsadas', 1, '2020-01-12 01:37:05', 23);
INSERT INTO `association` VALUES (8, 2, 2, 9, 3, 'xzczxc', 'xxzcxzcxz', 'zxczxczxc', 'cxzcxzc', 'xczxcxzc', '<p>test</p>', 'zxczxczx', 1, '2020-01-12 02:22:14', 23);
INSERT INTO `association` VALUES (9, 3, 8, 126, 3, 'fdfdfd', 'ffdfdfdfd', 'fdfdf', 'fdfd', 'fdfdfd', '<p>teststt</p>', 'dfdfdfd', 1, '2020-01-12 03:14:01', 23);

-- ----------------------------
-- Table structure for barangay
-- ----------------------------
DROP TABLE IF EXISTS `barangay`;
CREATE TABLE `barangay`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lgu_id` int(11) NOT NULL,
  `code` int(10) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barangay
-- ----------------------------
INSERT INTO `barangay` VALUES (4, 9, 232, 'BARANGAY 1', 1);

-- ----------------------------
-- Table structure for bee_type
-- ----------------------------
DROP TABLE IF EXISTS `bee_type`;
CREATE TABLE `bee_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bee_type
-- ----------------------------
INSERT INTO `bee_type` VALUES (1, '1', 'Type 1', 1);

-- ----------------------------
-- Table structure for beekeeper
-- ----------------------------
DROP TABLE IF EXISTS `beekeeper`;
CREATE TABLE `beekeeper`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `association_id` int(11) NULL DEFAULT NULL,
  `barangay_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `education_id` int(11) NULL DEFAULT NULL,
  `fund_source_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `gender_id` int(11) NULL DEFAULT NULL,
  `lgu_id` int(11) NULL DEFAULT NULL,
  `nationality_id` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `province_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `beekeeper_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `beekeeper_register_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `birthdate` date NULL DEFAULT NULL,
  `contact_number` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `directory` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `website` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `beekeeper_name`(`beekeeper_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of beekeeper
-- ----------------------------
INSERT INTO `beekeeper` VALUES (27, 7, 4, 1, 4, '[\"12\"]', 6, 9, '[\"7\"]', 141, 4, 'test', 'test', '', '2020-12-31', 'test', '27', 'test', '', 'test', 1, '2020-01-16 11:15:15', 23);

-- ----------------------------
-- Table structure for byproduct
-- ----------------------------
DROP TABLE IF EXISTS `byproduct`;
CREATE TABLE `byproduct`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of byproduct
-- ----------------------------
INSERT INTO `byproduct` VALUES (1, 0, 'Honey', 1);
INSERT INTO `byproduct` VALUES (2, 0, 'Beeswax', 1);
INSERT INTO `byproduct` VALUES (3, 0, 'Propolis', 1);
INSERT INTO `byproduct` VALUES (4, 0, 'Bee pollen', 1);
INSERT INTO `byproduct` VALUES (5, 0, 'Royal Jelly', 1);
INSERT INTO `byproduct` VALUES (6, 0, 'Mated Queens', 1);
INSERT INTO `byproduct` VALUES (7, 0, 'Starter Colony', 1);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Small', 1);
INSERT INTO `category` VALUES (2, 'Medium', 1);
INSERT INTO `category` VALUES (3, 'Large', 1);
INSERT INTO `category` VALUES (4, 'Large', 1);

-- ----------------------------
-- Table structure for category_beekeeper
-- ----------------------------
DROP TABLE IF EXISTS `category_beekeeper`;
CREATE TABLE `category_beekeeper`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category_beekeeper
-- ----------------------------
INSERT INTO `category_beekeeper` VALUES (1, 'Small', 1);
INSERT INTO `category_beekeeper` VALUES (2, 'Medium', 1);
INSERT INTO `category_beekeeper` VALUES (3, 'dsds', 1);
INSERT INTO `category_beekeeper` VALUES (7, 'test', 1);
INSERT INTO `category_beekeeper` VALUES (11, '1', 1);
INSERT INTO `category_beekeeper` VALUES (12, 's', 1);
INSERT INTO `category_beekeeper` VALUES (13, 'sss', 1);
INSERT INTO `category_beekeeper` VALUES (14, 'asas', 1);

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(10) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES (1, 0, 'test', 1);

-- ----------------------------
-- Table structure for colony
-- ----------------------------
DROP TABLE IF EXISTS `colony`;
CREATE TABLE `colony`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apiary_id` int(11) NOT NULL,
  `species_id` int(11) NULL DEFAULT NULL,
  `phase_id` int(11) NOT NULL,
  `total_colony` int(11) NOT NULL,
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `apiary_id`(`apiary_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for document
-- ----------------------------
DROP TABLE IF EXISTS `document`;
CREATE TABLE `document`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apiary_id` int(11) NOT NULL,
  `beekeeper_id` int(11) NULL DEFAULT NULL,
  `colony_id` int(11) NULL DEFAULT NULL,
  `post_id` int(11) NULL DEFAULT NULL,
  `document_type_id` int(11) NULL DEFAULT NULL,
  `doc_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `doc_size` int(10) NULL DEFAULT 0,
  `doc_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `colony_no`(`colony_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document
-- ----------------------------
INSERT INTO `document` VALUES (12, 36, 27, NULL, NULL, 3, 'test6.docx', 11, 'application/vnd.openxmlformats', '2020-01-16 11:45:58', 23);

-- ----------------------------
-- Table structure for document_type
-- ----------------------------
DROP TABLE IF EXISTS `document_type`;
CREATE TABLE `document_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_type
-- ----------------------------
INSERT INTO `document_type` VALUES (1, 'Beekeeper', 1);
INSERT INTO `document_type` VALUES (2, 'Colony', 1);
INSERT INTO `document_type` VALUES (3, 'Association', 1);
INSERT INTO `document_type` VALUES (4, 'Activities', 1);
INSERT INTO `document_type` VALUES (5, 'Environment', 1);
INSERT INTO `document_type` VALUES (6, 'Post', 1);
INSERT INTO `document_type` VALUES (8, 'test1', 2);

-- ----------------------------
-- Table structure for education
-- ----------------------------
DROP TABLE IF EXISTS `education`;
CREATE TABLE `education`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of education
-- ----------------------------
INSERT INTO `education` VALUES (4, 'Elementary', 1);
INSERT INTO `education` VALUES (5, 'Highschool', 1);
INSERT INTO `education` VALUES (6, 'College', 1);

-- ----------------------------
-- Table structure for fund_source
-- ----------------------------
DROP TABLE IF EXISTS `fund_source`;
CREATE TABLE `fund_source`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fund_source
-- ----------------------------
INSERT INTO `fund_source` VALUES (12, 'test', 1);

-- ----------------------------
-- Table structure for gender
-- ----------------------------
DROP TABLE IF EXISTS `gender`;
CREATE TABLE `gender`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gender
-- ----------------------------
INSERT INTO `gender` VALUES (4, 'Female', 1);
INSERT INTO `gender` VALUES (6, 'Male', 1);

-- ----------------------------
-- Table structure for inquiry
-- ----------------------------
DROP TABLE IF EXISTS `inquiry`;
CREATE TABLE `inquiry`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beekeeper_id` int(11) NOT NULL,
  `inquiry_type_id` int(11) NULL DEFAULT NULL,
  `support_type_id` int(11) NULL DEFAULT NULL,
  `request` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `feedback` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `answered_by` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inquiry_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `beekeeper_id`(`beekeeper_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inquiry
-- ----------------------------
INSERT INTO `inquiry` VALUES (2, 22, 1, 2, 'test', 'test', 'test', '2020-01-31');

-- ----------------------------
-- Table structure for inquiry_type
-- ----------------------------
DROP TABLE IF EXISTS `inquiry_type`;
CREATE TABLE `inquiry_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inquiry_type
-- ----------------------------
INSERT INTO `inquiry_type` VALUES (1, 'BEGINNER', 'Beginning the process', 1);

-- ----------------------------
-- Table structure for lgu
-- ----------------------------
DROP TABLE IF EXISTS `lgu`;
CREATE TABLE `lgu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province_id` int(11) NOT NULL,
  `code` int(10) NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `zip_code` int(11) NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lgu
-- ----------------------------
INSERT INTO `lgu` VALUES (1, 1, 11, 'aa', 2323222, 1);
INSERT INTO `lgu` VALUES (2, 9, 1231, '112321', 221312312, 1);
INSERT INTO `lgu` VALUES (4, 107, 213, '123', 213222, 1);
INSERT INTO `lgu` VALUES (5, 10, 213, '213', 23123, 1);
INSERT INTO `lgu` VALUES (6, 80, 1, '32', 111, 1);
INSERT INTO `lgu` VALUES (8, 126, 0, 'test', 0, 1);
INSERT INTO `lgu` VALUES (9, 141, 2131, 'LGU 1', 2000, 1);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `version` bigint(20) NOT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1);

-- ----------------------------
-- Table structure for municipality
-- ----------------------------
DROP TABLE IF EXISTS `municipality`;
CREATE TABLE `municipality`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(10) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of municipality
-- ----------------------------
INSERT INTO `municipality` VALUES (1, 0, 'Bacnotan', 1);

-- ----------------------------
-- Table structure for nationality
-- ----------------------------
DROP TABLE IF EXISTS `nationality`;
CREATE TABLE `nationality`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nationality
-- ----------------------------
INSERT INTO `nationality` VALUES (7, 'Filipino', 1);
INSERT INTO `nationality` VALUES (8, 'test1', 1);

-- ----------------------------
-- Table structure for origin
-- ----------------------------
DROP TABLE IF EXISTS `origin`;
CREATE TABLE `origin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of origin
-- ----------------------------
INSERT INTO `origin` VALUES (1, 'Philippines', 1);
INSERT INTO `origin` VALUES (2, 'Japanese', 1);
INSERT INTO `origin` VALUES (3, 'Canadian', 1);

-- ----------------------------
-- Table structure for phase
-- ----------------------------
DROP TABLE IF EXISTS `phase`;
CREATE TABLE `phase`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of phase
-- ----------------------------
INSERT INTO `phase` VALUES (1, 'Phase 1', 1);
INSERT INTO `phase` VALUES (2, 'Phase 2', 1);
INSERT INTO `phase` VALUES (3, 'rrrrrrrrrrr', 1);

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(11) NOT NULL,
  `date_from` date NULL DEFAULT NULL,
  `date_to` date NULL DEFAULT NULL,
  `doc_type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_text` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `posted_by` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_visibility` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=visible 2=non visible',
  `active` tinyint(1) NOT NULL COMMENT '1=active 2=inactive',
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES (1, 1, '2019-09-30', '2020-03-28', 'image/jpeg', 'Welcome to new beekeepers!', 'Welcome-to-new-beekeepers', '<p>Welcome to the database for beekeepers.</p>', 'beezzz.jpg', 'Carmen Gagnon', 1, 1, '2019-09-30 13:39:40', 18);
INSERT INTO `post` VALUES (3, 2, '2019-09-30', '2020-09-30', '', 'News from NARTDI', 'News-from-NARTDI', '<p>testing</p>', 'noimage.jpg', 'Carmen Gagnon', 1, 1, '2019-09-30 16:09:24', 18);
INSERT INTO `post` VALUES (4, 1, '2019-12-28', '2020-02-14', '', 'More information about ....', 'More-information-about', '<p>Dear members</p><p>You will find attached in this post a presentation of the new Beekeepers system.</p>', 'animated-bee-image-0182.gif', 'Carmen Gagnon', 2, 1, '2019-12-28 16:00:20', 23);

-- ----------------------------
-- Table structure for post_category
-- ----------------------------
DROP TABLE IF EXISTS `post_category`;
CREATE TABLE `post_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active 2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of post_category
-- ----------------------------
INSERT INTO `post_category` VALUES (1, 'New member', 1);
INSERT INTO `post_category` VALUES (2, 'News', 1);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 'Honey', 1);
INSERT INTO `product` VALUES (4, 'test', 1);

-- ----------------------------
-- Table structure for production
-- ----------------------------
DROP TABLE IF EXISTS `production`;
CREATE TABLE `production`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `colony_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `beehive_number` decimal(12, 2) NULL DEFAULT NULL,
  `total_production` decimal(12, 2) NULL DEFAULT NULL,
  `gross_income` decimal(12, 0) NULL DEFAULT NULL,
  `cost` decimal(12, 0) NULL DEFAULT NULL,
  `net_income` decimal(12, 0) NULL DEFAULT NULL,
  `production_date` date NULL DEFAULT NULL,
  `year` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `beekeeper_id`(`colony_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of production
-- ----------------------------
INSERT INTO `production` VALUES (15, 8, 1, NULL, 0.00, NULL, NULL, NULL, '2009-02-19', '');
INSERT INTO `production` VALUES (16, 9, 1, NULL, 2.00, NULL, NULL, NULL, '2001-12-20', '');
INSERT INTO `production` VALUES (17, 15, 4, NULL, 5000.00, 222, 225, 0, '2020-12-31', '');
INSERT INTO `production` VALUES (18, 15, 1, NULL, 222.00, 22251, 2225, 0, '2020-12-31', '');
INSERT INTO `production` VALUES (19, 15, 1, NULL, 5.00, 5, 2, 3, '2020-12-31', '');
INSERT INTO `production` VALUES (20, 15, 1, NULL, 5.00, 5, 2, 3, '2020-12-31', '');
INSERT INTO `production` VALUES (21, 15, 1, NULL, 5.00, 5, 2, 3, '2020-12-31', '');
INSERT INTO `production` VALUES (22, 15, 1, NULL, 50.00, 2000, 30000, -28000, '2020-12-31', '');
INSERT INTO `production` VALUES (23, 15, 4, NULL, 55.00, 222, 2224, -2002, '2020-12-31', '');
INSERT INTO `production` VALUES (24, 15, 4, NULL, 55.00, 200, 500, -300, '2020-12-31', '');
INSERT INTO `production` VALUES (25, 15, 1, NULL, 2.00, 5000, 3000, 2000, '2020-12-31', '');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `protected` tinyint(4) NULL DEFAULT NULL COMMENT '1=Protected',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (1, 'Super Admin', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}', NULL);
INSERT INTO `profile` VALUES (2, 'admin', 'a:120:{i:0;s:12:\"createRegion\";i:1;s:12:\"updateRegion\";i:2;s:10:\"viewRegion\";i:3;s:12:\"deleteRegion\";i:4;s:14:\"createProvince\";i:5;s:14:\"updateProvince\";i:6;s:12:\"viewProvince\";i:7;s:14:\"deleteProvince\";i:8;s:9:\"createLgu\";i:9;s:9:\"updateLgu\";i:10;s:7:\"viewLgu\";i:11;s:9:\"deleteLgu\";i:12;s:14:\"createBarangay\";i:13;s:14:\"updateBarangay\";i:14;s:12:\"viewBarangay\";i:15;s:14:\"deleteBarangay\";i:16;s:15:\"createBeekeeper\";i:17;s:15:\"updateBeekeeper\";i:18;s:13:\"viewBeekeeper\";i:19;s:15:\"deleteBeekeeper\";i:20;s:17:\"createAssociation\";i:21;s:17:\"updateAssociation\";i:22;s:15:\"viewAssociation\";i:23;s:17:\"deleteAssociation\";i:24;s:12:\"createGender\";i:25;s:12:\"updateGender\";i:26;s:10:\"viewGender\";i:27;s:12:\"deleteGender\";i:28;s:17:\"createNationality\";i:29;s:17:\"updateNationality\";i:30;s:15:\"viewNationality\";i:31;s:17:\"deleteNationality\";i:32;s:15:\"createEducation\";i:33;s:15:\"updateEducation\";i:34;s:13:\"viewEducation\";i:35;s:15:\"deleteEducation\";i:36;s:14:\"createCategory\";i:37;s:14:\"updateCategory\";i:38;s:12:\"viewCategory\";i:39;s:14:\"deleteCategory\";i:40;s:17:\"createFund_Source\";i:41;s:17:\"updateFund_Source\";i:42;s:15:\"viewFund_Source\";i:43;s:17:\"deleteFund_Source\";i:44;s:13:\"createInquiry\";i:45;s:13:\"updateInquiry\";i:46;s:11:\"viewInquiry\";i:47;s:13:\"deleteInquiry\";i:48;s:17:\"createInquiryType\";i:49;s:17:\"updateInquiryType\";i:50;s:15:\"viewInquiryType\";i:51;s:17:\"deleteInquiryType\";i:52;s:17:\"createSupportType\";i:53;s:17:\"updateSupportType\";i:54;s:15:\"viewSupportType\";i:55;s:17:\"deleteSupportType\";i:56;s:12:\"createApiary\";i:57;s:12:\"updateApiary\";i:58;s:10:\"viewApiary\";i:59;s:12:\"deleteApiary\";i:60;s:12:\"createColony\";i:61;s:12:\"updateColony\";i:62;s:10:\"viewColony\";i:63;s:12:\"deleteColony\";i:64;s:13:\"createSpecies\";i:65;s:13:\"updateSpecies\";i:66;s:11:\"viewSpecies\";i:67;s:13:\"deleteSpecies\";i:68;s:11:\"createPhase\";i:69;s:11:\"updatePhase\";i:70;s:9:\"viewPhase\";i:71;s:11:\"deletePhase\";i:72;s:16:\"createTopography\";i:73;s:16:\"updateTopography\";i:74;s:14:\"viewTopography\";i:75;s:16:\"deleteTopography\";i:76;s:12:\"createSource\";i:77;s:12:\"updateSource\";i:78;s:10:\"viewSource\";i:79;s:12:\"deleteSource\";i:80;s:16:\"createProduction\";i:81;s:16:\"updateProduction\";i:82;s:14:\"viewProduction\";i:83;s:16:\"deleteProduction\";i:84;s:13:\"createProduct\";i:85;s:13:\"updateProduct\";i:86;s:11:\"viewProduct\";i:87;s:13:\"deleteProduct\";i:88;s:15:\"createByproduct\";i:89;s:15:\"updateByproduct\";i:90;s:13:\"viewByproduct\";i:91;s:15:\"deleteByproduct\";i:92;s:14:\"createDocument\";i:93;s:14:\"updateDocument\";i:94;s:12:\"viewDocument\";i:95;s:14:\"deleteDocument\";i:96;s:18:\"createDocumentType\";i:97;s:18:\"updateDocumentType\";i:98;s:16:\"viewDocumentType\";i:99;s:18:\"deleteDocumentType\";i:100;s:10:\"createUser\";i:101;s:10:\"updateUser\";i:102;s:8:\"viewUser\";i:103;s:10:\"deleteUser\";i:104;s:13:\"createProfile\";i:105;s:13:\"updateProfile\";i:106;s:11:\"viewProfile\";i:107;s:13:\"deleteProfile\";i:108;s:11:\"viewAccount\";i:109;s:18:\"createPostCategory\";i:110;s:18:\"updatePostCategory\";i:111;s:16:\"viewPostCategory\";i:112;s:18:\"deletePostCategory\";i:113;s:10:\"createPost\";i:114;s:10:\"updatePost\";i:115;s:8:\"viewPost\";i:116;s:10:\"deletePost\";i:117;s:10:\"viewReport\";i:118;s:13:\"updateSetting\";i:119;s:12:\"updateSystem\";}', 1);
INSERT INTO `profile` VALUES (3, 'regional', 'a:34:{i:0;s:15:\"createBeekeeper\";i:1;s:15:\"updateBeekeeper\";i:2;s:13:\"viewBeekeeper\";i:3;s:15:\"deleteBeekeeper\";i:4;s:17:\"createAssociation\";i:5;s:17:\"updateAssociation\";i:6;s:15:\"viewAssociation\";i:7;s:17:\"deleteAssociation\";i:8;s:13:\"createInquiry\";i:9;s:13:\"updateInquiry\";i:10;s:11:\"viewInquiry\";i:11;s:13:\"deleteInquiry\";i:12;s:12:\"createApiary\";i:13;s:12:\"updateApiary\";i:14;s:10:\"viewApiary\";i:15;s:12:\"deleteApiary\";i:16;s:12:\"createColony\";i:17;s:12:\"updateColony\";i:18;s:10:\"viewColony\";i:19;s:12:\"deleteColony\";i:20;s:16:\"createProduction\";i:21;s:16:\"updateProduction\";i:22;s:14:\"viewProduction\";i:23;s:16:\"deleteProduction\";i:24;s:14:\"createDocument\";i:25;s:14:\"updateDocument\";i:26;s:12:\"viewDocument\";i:27;s:14:\"deleteDocument\";i:28;s:11:\"viewAccount\";i:29;s:10:\"createPost\";i:30;s:10:\"updatePost\";i:31;s:8:\"viewPost\";i:32;s:10:\"deletePost\";i:33;s:10:\"viewReport\";}', 1);
INSERT INTO `profile` VALUES (4, 'Reader', 'a:7:{i:0;s:13:\"viewBeekeeper\";i:1;s:10:\"viewApiary\";i:2;s:10:\"viewColony\";i:3;s:12:\"viewDocument\";i:4;s:11:\"viewAccount\";i:5;s:8:\"viewPost\";i:6;s:10:\"viewReport\";}', 1);

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `code` int(11) NULL DEFAULT NULL,
  `map_id` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 144 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES (1, 3, NULL, 'PHL2511', 'Tawi-Tawi', 1);
INSERT INTO `province` VALUES (2, 3, NULL, 'PHL2513', 'Bohol', 1);
INSERT INTO `province` VALUES (3, 3, NULL, 'PHL2514', 'Cebu', 1);
INSERT INTO `province` VALUES (4, 3, NULL, 'PHL2516', 'Negros Oriental', 1);
INSERT INTO `province` VALUES (5, 3, NULL, 'PHL2517', 'Siquijor', 1);
INSERT INTO `province` VALUES (6, 3, NULL, 'PHL2518', 'Negros Occidental', 1);
INSERT INTO `province` VALUES (7, 3, NULL, 'PHL2519', 'Basilan', 1);
INSERT INTO `province` VALUES (8, 3, NULL, 'PHL2520', 'Zamboanga del Norte', 1);
INSERT INTO `province` VALUES (9, 3, NULL, 'PHL2521', 'Zamboanga Sibugay', 1);
INSERT INTO `province` VALUES (10, 3, 0, 'PHL2522', 'Zamboanga del Sur', 1);
INSERT INTO `province` VALUES (11, 3, NULL, 'PHL2523', 'Misamis Occidental', 1);
INSERT INTO `province` VALUES (12, 3, NULL, 'PHL2524', 'Sulu', 1);
INSERT INTO `province` VALUES (13, 3, NULL, 'PHL2525', 'Aklan', 1);
INSERT INTO `province` VALUES (14, 3, NULL, 'PHL2526', 'Antique', 1);
INSERT INTO `province` VALUES (15, 3, NULL, 'PHL2528', 'Capiz', 1);
INSERT INTO `province` VALUES (16, 3, NULL, 'PHL2529', 'Iloilo', 1);
INSERT INTO `province` VALUES (17, 3, NULL, 'PHL2530', 'Guimaras', 1);
INSERT INTO `province` VALUES (18, 3, NULL, 'PHL2534', 'Palawan', 1);
INSERT INTO `province` VALUES (19, 3, NULL, 'PHL2535', 'Romblon', 1);
INSERT INTO `province` VALUES (20, 3, NULL, 'PHL2536', 'Albay', 1);
INSERT INTO `province` VALUES (21, 3, NULL, 'PHL2537', 'Camarines Norte', 1);
INSERT INTO `province` VALUES (22, 3, NULL, 'PHL2538', 'Camarines Sur', 1);
INSERT INTO `province` VALUES (23, 3, NULL, 'PHL2539', 'Catanduanes', 1);
INSERT INTO `province` VALUES (24, 3, NULL, 'PHL2540', 'Masbate', 1);
INSERT INTO `province` VALUES (25, 3, NULL, 'PHL2541', 'Sorsogon', 1);
INSERT INTO `province` VALUES (26, 3, NULL, 'PHL2542', 'Abra', 1);
INSERT INTO `province` VALUES (27, 3, NULL, 'PHL2543', 'Batanes', 1);
INSERT INTO `province` VALUES (28, 3, NULL, 'PHL2545', 'Cagayan', 1);
INSERT INTO `province` VALUES (29, 3, NULL, 'PHL2546', 'Apayao', 1);
INSERT INTO `province` VALUES (30, 3, NULL, 'PHL2547', 'Ilocos Norte', 1);
INSERT INTO `province` VALUES (31, 3, NULL, 'PHL2548', 'Ilocos Sur', 1);
INSERT INTO `province` VALUES (32, 3, NULL, 'PHL2549', 'Aurora', 1);
INSERT INTO `province` VALUES (33, 3, NULL, 'PHL2550', 'Isabela', 1);
INSERT INTO `province` VALUES (34, 3, NULL, 'PHL2551', 'Ifugao', 1);
INSERT INTO `province` VALUES (36, 3, NULL, 'PHL2553', 'Nueva Vizcaya', 1);
INSERT INTO `province` VALUES (37, 3, NULL, 'PHL2554', 'Quirino', 1);
INSERT INTO `province` VALUES (38, 3, NULL, 'PHL2555', 'Bataan', 1);
INSERT INTO `province` VALUES (39, 3, NULL, 'PHL2556', 'Tarlac', 1);
INSERT INTO `province` VALUES (40, 3, NULL, 'PHL2557', 'Nueva Ecija', 1);
INSERT INTO `province` VALUES (41, 3, NULL, 'PHL2558', 'Pampanga', 1);
INSERT INTO `province` VALUES (42, 3, NULL, 'PHL2559', 'Benguet', 1);
INSERT INTO `province` VALUES (43, 3, NULL, 'PHL2560', 'Zambales', 1);
INSERT INTO `province` VALUES (44, 3, NULL, 'PHL2561', 'La Union', 1);
INSERT INTO `province` VALUES (45, 3, NULL, 'PHL2562', 'Pangasinan', 1);
INSERT INTO `province` VALUES (46, 3, NULL, 'PHL2563', 'Cavite', 1);
INSERT INTO `province` VALUES (47, 3, NULL, 'PHL2564', 'Batangas', 1);
INSERT INTO `province` VALUES (48, 3, NULL, 'PHL2565', 'Bulacan', 1);
INSERT INTO `province` VALUES (49, 3, NULL, 'PHL2566', 'Laguna', 1);
INSERT INTO `province` VALUES (50, 3, NULL, 'PHL2567', 'Rizal', 1);
INSERT INTO `province` VALUES (51, 3, NULL, 'PHL2569', 'Marinduque', 1);
INSERT INTO `province` VALUES (52, 3, NULL, 'PHL2570', 'Mindoro Occidental', 1);
INSERT INTO `province` VALUES (53, 3, NULL, 'PHL2571', 'Mindoro Oriental', 1);
INSERT INTO `province` VALUES (54, 3, NULL, 'PHL2572', 'Quezon', 1);
INSERT INTO `province` VALUES (55, 3, NULL, 'PHL2573', 'Lanao del Norte', 1);
INSERT INTO `province` VALUES (56, 3, NULL, 'PHL2574', 'Lanao del Sur', 1);
INSERT INTO `province` VALUES (57, 3, NULL, 'PHL2576', 'Maguindanao', 1);
INSERT INTO `province` VALUES (58, 3, NULL, 'PHL2579', 'Cotabato', 1);
INSERT INTO `province` VALUES (59, 3, NULL, 'PHL2580', 'Sultan Kudarat', 1);
INSERT INTO `province` VALUES (60, 3, NULL, 'PHL2581', 'Biliran', 1);
INSERT INTO `province` VALUES (61, 3, NULL, 'PHL2582', 'Eastern Samar', 1);
INSERT INTO `province` VALUES (62, 3, NULL, 'PHL2583', 'Leyte', 1);
INSERT INTO `province` VALUES (63, 3, NULL, 'PHL2584', 'Samar', 1);
INSERT INTO `province` VALUES (64, 3, NULL, 'PHL2585', 'Southern Leyte', 1);
INSERT INTO `province` VALUES (65, 3, NULL, 'PHL2586', 'Northern Samar', 1);
INSERT INTO `province` VALUES (66, 3, NULL, 'PHL2587', 'Agusan del Norte', 1);
INSERT INTO `province` VALUES (67, 3, NULL, 'PHL2588', 'Agusan del Sur', 1);
INSERT INTO `province` VALUES (68, 3, NULL, 'PHL2589', 'Bukidnon', 1);
INSERT INTO `province` VALUES (69, 3, NULL, 'PHL2590', 'Camiguin', 1);
INSERT INTO `province` VALUES (70, 3, NULL, 'PHL2591', 'Davao del Norte', 1);
INSERT INTO `province` VALUES (71, 3, NULL, 'PHL2592', 'Compostela Valley', 1);
INSERT INTO `province` VALUES (72, 3, NULL, 'PHL2593', 'Surigao del Norte', 1);
INSERT INTO `province` VALUES (73, 3, NULL, 'PHL2594', 'Surigao del Sur', 1);
INSERT INTO `province` VALUES (74, 3, NULL, 'PHL2595', 'Misamis Oriental', 1);
INSERT INTO `province` VALUES (75, 3, NULL, 'PHL2596', 'Davao del Sur', 1);
INSERT INTO `province` VALUES (76, 3, NULL, 'PHL2597', 'Davao Oriental', 1);
INSERT INTO `province` VALUES (77, 3, NULL, 'PHL2598', 'Sarangani', 1);
INSERT INTO `province` VALUES (78, 3, NULL, 'PHL2599', 'South Cotabato', 1);
INSERT INTO `province` VALUES (79, 3, NULL, 'PHL4931', 'Kalinga', 1);
INSERT INTO `province` VALUES (80, 3, NULL, 'PHL4932', 'Zamboanga', 1);
INSERT INTO `province` VALUES (81, 3, NULL, 'PHL4933', 'Isabela', 1);
INSERT INTO `province` VALUES (82, 3, NULL, 'PHL5522', 'Cebu', 1);
INSERT INTO `province` VALUES (83, 3, NULL, 'PHL5523', 'Mandaue', 1);
INSERT INTO `province` VALUES (84, 3, NULL, 'PHL5524', 'Lapu-Lapu', 1);
INSERT INTO `province` VALUES (85, 3, NULL, 'PHL5525', 'Bacolod', 1);
INSERT INTO `province` VALUES (86, 3, NULL, 'PHL5526', 'Iloilo', 1);
INSERT INTO `province` VALUES (87, 3, NULL, 'PHL5527', 'Cotabato', 1);
INSERT INTO `province` VALUES (88, 3, NULL, 'PHL5528', 'Davao', 1);
INSERT INTO `province` VALUES (89, 3, NULL, 'PHL5529', 'General Santos', 1);
INSERT INTO `province` VALUES (90, 3, NULL, 'PHL5530', 'Iligan', 1);
INSERT INTO `province` VALUES (91, 3, NULL, 'PHL5531', 'Cagayan de Oro', 1);
INSERT INTO `province` VALUES (92, 3, NULL, 'PHL5532', 'Butuan', 1);
INSERT INTO `province` VALUES (93, 3, NULL, 'PHL5533', 'Puerto Princesa', 1);
INSERT INTO `province` VALUES (94, 3, NULL, 'PHL5534', 'Ormoc', 1);
INSERT INTO `province` VALUES (95, 3, NULL, 'PHL5535', 'Tacloban', 1);
INSERT INTO `province` VALUES (96, 3, NULL, 'PHL5536', 'Naga', 1);
INSERT INTO `province` VALUES (97, 3, NULL, 'PHL5537', 'Santiago', 1);
INSERT INTO `province` VALUES (98, 3, NULL, 'PHL5538', 'Angeles', 1);
INSERT INTO `province` VALUES (99, 3, NULL, 'PHL5539', 'Baguio', 1);
INSERT INTO `province` VALUES (100, 3, NULL, 'PHL5540', 'Olongapo', 1);
INSERT INTO `province` VALUES (101, 3, NULL, 'PHL5541', 'Dagupan', 1);
INSERT INTO `province` VALUES (102, 3, NULL, 'PHL5542', 'Mandaluyong City', 1);
INSERT INTO `province` VALUES (103, 3, NULL, 'PHL5543', 'Manila', 1);
INSERT INTO `province` VALUES (104, 3, NULL, 'PHL5544', 'Navotas', 1);
INSERT INTO `province` VALUES (105, 3, NULL, 'PHL5545', 'Caloocan', 1);
INSERT INTO `province` VALUES (106, 3, NULL, 'PHL5546', 'Malabon', 1);
INSERT INTO `province` VALUES (107, 3, NULL, 'PHL5547', 'Valenzuela', 1);
INSERT INTO `province` VALUES (108, 3, NULL, 'PHL5549', 'Quezon City', 1);
INSERT INTO `province` VALUES (109, 3, NULL, 'PHL5550', 'Marikina', 1);
INSERT INTO `province` VALUES (110, 3, NULL, 'PHL5551', 'San Juan', 1);
INSERT INTO `province` VALUES (111, 3, NULL, 'PHL5552', 'Pasig', 1);
INSERT INTO `province` VALUES (112, 3, NULL, 'PHL5553', 'Makati', 1);
INSERT INTO `province` VALUES (113, 3, NULL, 'PHL5554', 'Pasay', 1);
INSERT INTO `province` VALUES (114, 3, NULL, 'PHL5555', 'Paranaque', 1);
INSERT INTO `province` VALUES (115, 3, NULL, 'PHL5556', 'Las Pinas', 1);
INSERT INTO `province` VALUES (116, 3, NULL, 'PHL5557', 'Muntinlupa', 1);
INSERT INTO `province` VALUES (117, 3, NULL, 'PHL5558', 'Taguig', 1);
INSERT INTO `province` VALUES (118, 3, NULL, 'PHL5559', 'Pateros', 1);
INSERT INTO `province` VALUES (119, 3, NULL, 'PHL5560', 'Lucena', 1);
INSERT INTO `province` VALUES (121, 3, 0, 'test', 'test', 1);
INSERT INTO `province` VALUES (122, 3, 0, '11', '22', 1);
INSERT INTO `province` VALUES (123, 3, 1, '1', '1', 1);
INSERT INTO `province` VALUES (124, 3, 1, '1', '1', 1);
INSERT INTO `province` VALUES (125, 3, 1, '1', '1', 1);
INSERT INTO `province` VALUES (126, 3, 0, 'test', 'test', 1);
INSERT INTO `province` VALUES (127, 3, 1, '1', '1', 1);
INSERT INTO `province` VALUES (129, 2, 2, '2', '2', 1);
INSERT INTO `province` VALUES (130, 3, 3, '3', '3', 1);
INSERT INTO `province` VALUES (131, 2, 1, '1', '1', 1);
INSERT INTO `province` VALUES (132, 2, 1, '1', '1', 1);
INSERT INTO `province` VALUES (133, 3, 0, 'zx', 'zx', 1);
INSERT INTO `province` VALUES (134, 2, 0, 'asd', 'asd', 1);
INSERT INTO `province` VALUES (135, 2, 123, '123', '12321', 1);
INSERT INTO `province` VALUES (136, 2, 12, '12', '12', 1);
INSERT INTO `province` VALUES (137, 2, 2, '2', '2', 1);
INSERT INTO `province` VALUES (138, 2, 1, '1', '12222', 1);
INSERT INTO `province` VALUES (141, 4, 2, '2', 'Province 1', 1);
INSERT INTO `province` VALUES (143, 3, 0, 'test', 'test1231', 1);

-- ----------------------------
-- Table structure for rating
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rating
-- ----------------------------
INSERT INTO `rating` VALUES (1, 'Small', 1);
INSERT INTO `rating` VALUES (2, 'Medium', 1);
INSERT INTO `rating` VALUES (3, 'Large', 1);

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of region
-- ----------------------------
INSERT INTO `region` VALUES (2, '1', 'Region 1', 1);
INSERT INTO `region` VALUES (3, '2', 'Region 2', 1);
INSERT INTO `region` VALUES (4, '3', 'Region 3', 1);

-- ----------------------------
-- Table structure for report
-- ----------------------------
DROP TABLE IF EXISTS `report`;
CREATE TABLE `report`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_code` char(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `report_desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `report_form` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `report_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `report_selection` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Yes 2-=No',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `report_code`(`report_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of report
-- ----------------------------
INSERT INTO `report` VALUES (1, 'REP01', 'List of Beekeepers', '/application/controllers/Repor01.php', 'List of Beekeepers', 1);
INSERT INTO `report` VALUES (2, 'REP02', 'List of Colonies', '/application/controllers/Report02.php', 'List of Colonies', 1);
INSERT INTO `report` VALUES (3, 'REP03', 'Production', '/application/controllers/Report03.php', 'Production', 1);
INSERT INTO `report` VALUES (4, 'REP04', 'Inquiries', '/application/controllers/Report04.php', 'Inquiries', 1);
INSERT INTO `report` VALUES (5, 'REP05', 'List of Colonies by Province', 'application/controllers/Report05.php', 'List of Colonies by Province', 1);
INSERT INTO `report` VALUES (6, 'REP06', 'List of Settings', '/application/controllers/Report06.php', 'List of Settings', 2);
INSERT INTO `report` VALUES (7, 'REP0B', 'Beekeeper', '/appliation/controllers/Report0b.php', 'Beekeeper', 2);
INSERT INTO `report` VALUES (8, 'REP0C', 'Colony', '/appliation/controllers/Report0C.php', 'Colony', 2);
INSERT INTO `report` VALUES (9, 'REP0A', 'Association', '/application/controllers/Report0A.php', 'Association', 2);
INSERT INTO `report` VALUES (10, 'REP1A', 'Apiary', '/application/controllers/Report1A.php', 'Apiary', 1);

-- ----------------------------
-- Table structure for source
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of source
-- ----------------------------
INSERT INTO `source` VALUES (10, 'test1', 1);
INSERT INTO `source` VALUES (11, 'test3', 1);
INSERT INTO `source` VALUES (13, 'test5', 1);
INSERT INTO `source` VALUES (14, 'test6', 1);

-- ----------------------------
-- Table structure for species
-- ----------------------------
DROP TABLE IF EXISTS `species`;
CREATE TABLE `species`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of species
-- ----------------------------
INSERT INTO `species` VALUES (7, '', 'Specy 1', 1);
INSERT INTO `species` VALUES (8, '', 'Specy 1', 1);

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Inscription', 1);

-- ----------------------------
-- Table structure for support_type
-- ----------------------------
DROP TABLE IF EXISTS `support_type`;
CREATE TABLE `support_type`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of support_type
-- ----------------------------
INSERT INTO `support_type` VALUES (2, '4444', 'bbbbbbbbbbbbbbb', 1);

-- ----------------------------
-- Table structure for topography
-- ----------------------------
DROP TABLE IF EXISTS `topography`;
CREATE TABLE `topography`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of topography
-- ----------------------------
INSERT INTO `topography` VALUES (8, 'Topo 1', 1);
INSERT INTO `topography` VALUES (9, 'test1', 1);
INSERT INTO `topography` VALUES (10, 'test2', 1);
INSERT INTO `topography` VALUES (11, 'test3', 1);
INSERT INTO `topography` VALUES (13, 'test5', 1);
INSERT INTO `topography` VALUES (14, 'test6', 1);
INSERT INTO `topography` VALUES (15, 'test7', 1);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `region_id` int(11) NULL DEFAULT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `language` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '1=active  2=inactive',
  `updated_by` int(11) NULL DEFAULT NULL,
  `updated_date` timestamp(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (18, 2, NULL, 'voyagine', '$2y$10$zdSQoIZNy10Gs3uQhG0OF.8xucSKJyP5AEkuCkPY08axj/rNm7lrW', 'en', 'voyagine@hotmail.com', 'Carmen Gagnon', '5149836594', 1, NULL, '2019-12-26 17:29:36');
INSERT INTO `user` VALUES (20, 4, 0, 'reader', '$2y$10$vT4zSfuPPQH.ltQtgWdRHOq7fX3eG0fXlR/4msi1Lo8CXtzzd2m8q', 'en', 'reader@hotmail.com', 'Mister Reader', '', 0, NULL, '2019-12-26 17:29:36');
INSERT INTO `user` VALUES (23, 2, 0, 'nartdi', '$2y$10$x9E7sOYmA4G3.rUsDXOYIee7aown65Rb8Zl/6epBEBtxmOLfxN5kC', 'en', 'admin@hotmail.com', 'Administrator NARTDI', '', 2, NULL, '2019-12-26 17:29:36');
INSERT INTO `user` VALUES (24, 3, 4, 'regional', '$2y$10$XkWfKocZo2Cc5097dhS9l.YHtsBK6tNH2V.zcLIAIqHmhtdvLeIdm', 'en', 'bizz@hotmail.com', 'Regional Representative', '', 1, NULL, '2019-12-28 20:59:50');
INSERT INTO `user` VALUES (25, 3, 3, 'regional1', '$2y$10$oBGI/pi2rzQ.3LG9R030jOB3dHep0IYGrWKiFls83uHbQh1AoBBfu', 'en', 'regional@gmail.com', 'regional1', '', 1, NULL, '2020-01-16 09:10:30');

SET FOREIGN_KEY_CHECKS = 1;
