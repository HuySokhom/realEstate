/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : real_estate

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-05-15 15:57:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `action_recorder`
-- ----------------------------
DROP TABLE IF EXISTS `action_recorder`;
CREATE TABLE `action_recorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `success` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_action_recorder_module` (`module`),
  KEY `idx_action_recorder_user_id` (`user_id`),
  KEY `idx_action_recorder_identifier` (`identifier`),
  KEY `idx_action_recorder_date_added` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of action_recorder
-- ----------------------------
INSERT INTO `action_recorder` VALUES ('1', 'ar_admin_login', '1', 'admin', '', '1', '2016-05-07 10:11:09');
INSERT INTO `action_recorder` VALUES ('2', 'ar_admin_login', '1', 'admin', '', '1', '2016-05-09 16:44:20');
INSERT INTO `action_recorder` VALUES ('3', 'ar_admin_login', '1', 'admin', '', '1', '2016-05-15 15:26:48');

-- ----------------------------
-- Table structure for `address_book`
-- ----------------------------
DROP TABLE IF EXISTS `address_book`;
CREATE TABLE `address_book` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `entry_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT '0',
  `entry_zone_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of address_book
-- ----------------------------
INSERT INTO `address_book` VALUES ('1', '1', 'm', 'test', '', '', 'test test', 'test', '12345', 'test', 'test', '12', '0');
INSERT INTO `address_book` VALUES ('2', '2', 'm', 'reads', 'test', 'test', 'test test', '1234', '1241', 'atest', 'caga', '36', '0');
INSERT INTO `address_book` VALUES ('3', '3', 'm', '', 'GASG', 'sd gsgd', 'ZXC dasdt', '', '', '23r sv', '', '36', '0');
INSERT INTO `address_book` VALUES ('4', '4', '', null, '', '', '', null, '', '', null, '0', '0');
INSERT INTO `address_book` VALUES ('5', '5', '', null, '', '', '', null, '', '', null, '0', '0');
INSERT INTO `address_book` VALUES ('6', '6', '', null, '', '', '', null, '', '', null, '0', '0');

-- ----------------------------
-- Table structure for `address_format`
-- ----------------------------
DROP TABLE IF EXISTS `address_format`;
CREATE TABLE `address_format` (
  `address_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_format` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address_summary` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of address_format
-- ----------------------------
INSERT INTO `address_format` VALUES ('1', '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
INSERT INTO `address_format` VALUES ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
INSERT INTO `address_format` VALUES ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
INSERT INTO `address_format` VALUES ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO `address_format` VALUES ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

-- ----------------------------
-- Table structure for `administrators`
-- ----------------------------
DROP TABLE IF EXISTS `administrators`;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of administrators
-- ----------------------------
INSERT INTO `administrators` VALUES ('1', 'admin', '$P$DRRMOl769qtOxrbeggl2nKo1Klsh5J/');
INSERT INTO `administrators` VALUES ('2', 'admin123', '$P$DiZa27yqE2eLd0WXF3FraaCH56dZfc1');

-- ----------------------------
-- Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `banners_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `banners_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banners_image` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `banners_group` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `banners_html_text` text COLLATE utf8_unicode_ci,
  `expires_impressions` int(7) DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banners_id`),
  KEY `idx_banners_group` (`banners_group`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES ('1', 'osCommerce', 'http://www.oscommerce.com', 'banners/oscommerce.gif', 'footer', '', '0', null, null, '2015-02-26 16:56:08', null, '1');

-- ----------------------------
-- Table structure for `banners_history`
-- ----------------------------
DROP TABLE IF EXISTS `banners_history`;
CREATE TABLE `banners_history` (
  `banners_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_id` int(11) NOT NULL,
  `banners_shown` int(5) NOT NULL DEFAULT '0',
  `banners_clicked` int(5) NOT NULL DEFAULT '0',
  `banners_history_date` datetime NOT NULL,
  PRIMARY KEY (`banners_history_id`),
  KEY `idx_banners_history_banners_id` (`banners_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of banners_history
-- ----------------------------

-- ----------------------------
-- Table structure for `cache`
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `cache_id` varchar(32) NOT NULL DEFAULT '',
  `cache_language_id` tinyint(1) NOT NULL DEFAULT '0',
  `cache_name` varchar(255) NOT NULL DEFAULT '',
  `cache_data` mediumtext NOT NULL,
  `cache_global` tinyint(1) NOT NULL DEFAULT '1',
  `cache_gzip` tinyint(1) NOT NULL DEFAULT '1',
  `cache_method` varchar(20) NOT NULL DEFAULT 'RETURN',
  `cache_date` datetime NOT NULL,
  `cache_expires` datetime NOT NULL,
  PRIMARY KEY (`cache_id`,`cache_language_id`),
  KEY `cache_id` (`cache_id`),
  KEY `cache_language_id` (`cache_language_id`),
  KEY `cache_global` (`cache_global`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('3f99e969ab97a4ed9b2f66db76e4c167', '1', 'seo_urls_v2_MANUFACTURERS', 'S0lNy8xL1VD3dfQLdXN0DgkNcg2K93P0dY03VtdRUE8qrVTXtOZKwanKHKQqvyQjtQi/OkMDkMLixJxUkDoA', '1', '1', 'EVAL', '2016-05-15 10:45:13', '2016-06-14 10:45:13');
INSERT INTO `cache` VALUES ('5aea2ef0968befad405de776007fa7b2', '1', 'seo_urls_v2_PRODUCTS', 'AwA=', '1', '1', 'EVAL', '2016-05-15 10:45:12', '2016-06-14 10:45:12');
INSERT INTO `cache` VALUES ('82c85abb1a53ab2274cf8f913897f181', '1', 'seo_urls_v2_CATEGORIES', 'S0lNy8xL1VB3dgxxdfcPioz3c/R1jTcxUtdRUE/KL0qtLFbXtOZKwarK2AKsqrQStxITY5CS5Pzc3NSi5MzEHDwqDSEq81Ly8SgyAClKSS1LzckvyE3NK8HnOkuQ2iKgIpB5AA==', '1', '1', 'EVAL', '2016-05-15 10:45:12', '2016-06-14 10:45:12');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('38', null, '0', '1', '2016-05-15 15:40:02', '2016-05-15 15:43:58');
INSERT INTO `categories` VALUES ('39', null, '0', '2', '2016-05-15 15:40:24', '2016-05-15 15:44:05');
INSERT INTO `categories` VALUES ('40', null, '0', '3', '2016-05-15 15:41:03', '2016-05-15 15:44:14');
INSERT INTO `categories` VALUES ('41', null, '0', '4', '2016-05-15 15:41:29', '2016-05-15 15:44:22');
INSERT INTO `categories` VALUES ('42', null, '0', '5', '2016-05-15 15:41:47', '2016-05-15 15:44:27');
INSERT INTO `categories` VALUES ('43', null, '0', '6', '2016-05-15 15:43:01', '2016-05-15 15:44:35');

-- ----------------------------
-- Table structure for `categories_description`
-- ----------------------------
DROP TABLE IF EXISTS `categories_description`;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `categories_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories_description
-- ----------------------------
INSERT INTO `categories_description` VALUES ('42', '1', 'Boreys');
INSERT INTO `categories_description` VALUES ('38', '1', 'Buy');
INSERT INTO `categories_description` VALUES ('43', '1', 'Commercial');
INSERT INTO `categories_description` VALUES ('41', '1', 'Condo');
INSERT INTO `categories_description` VALUES ('40', '1', 'New Developments');
INSERT INTO `categories_description` VALUES ('39', '1', 'Rent');
INSERT INTO `categories_description` VALUES ('41', '2', 'ខុនដូ');
INSERT INTO `categories_description` VALUES ('40', '2', 'គំរោងថ្មី');
INSERT INTO `categories_description` VALUES ('39', '2', 'ជួល');
INSERT INTO `categories_description` VALUES ('38', '2', 'ទិញ');
INSERT INTO `categories_description` VALUES ('42', '2', 'បុរី');
INSERT INTO `categories_description` VALUES ('43', '2', 'ពាណិជ្ជកម្ម');

-- ----------------------------
-- Table structure for `colors`
-- ----------------------------
DROP TABLE IF EXISTS `colors`;
CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(127) NOT NULL,
  `image` varchar(127) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of colors
-- ----------------------------
INSERT INTO `colors` VALUES ('1', '#000', 'images/img1.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('2', '#9a0606', 'images/img2.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('3', '#cecece', 'images/img3.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('4', '#023668', 'images/img4.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('5', '#8dba00', 'images/img5.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('6', '#FFF', 'images/img6.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('7', '#4a2e20', 'images/img7.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('8', '#d82897', 'images/img8.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('9', '#666666', 'images/img9.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');
INSERT INTO `colors` VALUES ('10', '#b76904', 'images/img10.jpg', '1', '2015-03-13 13:21:51', '2015-03-13 13:21:51');

-- ----------------------------
-- Table structure for `configuration`
-- ----------------------------
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_value` text COLLATE utf8_unicode_ci NOT NULL,
  `configuration_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_group_id` int(11) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `use_function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `set_function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1543 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of configuration
-- ----------------------------
INSERT INTO `configuration` VALUES ('1', 'Store Name', 'STORE_NAME', 'khmer_shoping_online', 'The name of my store', '1', '1', '2015-11-12 19:54:14', '2015-02-26 16:56:10', null, null);
INSERT INTO `configuration` VALUES ('2', 'Store Owner', 'STORE_OWNER', 'osc', 'The name of my store owner', '1', '2', null, '2015-02-26 16:56:10', null, null);
INSERT INTO `configuration` VALUES ('3', 'E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'osc@gmail.com', 'The e-mail address of my store owner', '1', '3', null, '2015-02-26 16:56:10', null, null);
INSERT INTO `configuration` VALUES ('4', 'E-Mail From', 'EMAIL_FROM', '\"osc\" <osc@gmail.com>', 'The e-mail address used in (sent) e-mails', '1', '4', null, '2015-02-26 16:56:10', null, null);
INSERT INTO `configuration` VALUES ('5', 'Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>', '1', '6', null, '2015-02-26 16:56:10', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES ('6', 'Zone', 'STORE_ZONE', '18', 'The zone my store is located in', '1', '7', null, '2015-02-26 16:56:10', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
INSERT INTO `configuration` VALUES ('7', 'Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', '1', '8', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'asc\', \'desc\'), ');
INSERT INTO `configuration` VALUES ('8', 'Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', '1', '9', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), ');
INSERT INTO `configuration` VALUES ('9', 'Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', '1', '10', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('10', 'Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '1', '11', null, '2015-02-26 16:56:10', null, null);
INSERT INTO `configuration` VALUES ('11', 'Use Search-Engine Safe URLs', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', '1', '12', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('12', 'Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', '1', '14', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('13', 'Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', '1', '15', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('14', 'Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', '1', '17', null, '2015-02-26 16:56:10', null, 'tep_cfg_select_option(array(\'and\', \'or\'), ');
INSERT INTO `configuration` VALUES ('15', 'Store Address', 'STORE_ADDRESS', 'Address Line 1\nAddress Line 2\nCountry\nPhone', 'This is the Address of my store used on printable documents and displayed online', '1', '18', null, '2015-02-26 16:56:10', null, 'tep_cfg_textarea(');
INSERT INTO `configuration` VALUES ('16', 'Store Phone', 'STORE_PHONE', '555-1234', 'This is the phone number of my store used on printable documents and displayed online', '1', '19', null, '2015-02-26 16:56:11', null, 'tep_cfg_textarea(');
INSERT INTO `configuration` VALUES ('17', 'Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', '1', '20', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('18', 'Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', null, '2015-02-26 16:56:11', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('19', 'First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', '2', '1', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('20', 'Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', '2', '2', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('21', 'Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', '2', '3', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('22', 'E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', '2', '4', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('23', 'Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', '2', '5', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('24', 'Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', '2', '6', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('25', 'Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', '2', '7', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('26', 'City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', '2', '8', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('27', 'State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', '2', '9', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('28', 'Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', '2', '10', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('29', 'Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', '2', '11', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('30', 'Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', '2', '12', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('31', 'Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', '2', '13', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('32', 'Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', '2', '14', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('33', 'Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', '2', '15', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('34', 'Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the \'This Customer Also Purchased\' box', '2', '16', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('35', 'Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', '3', '1', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('36', 'Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '30', 'Amount of products to list', '3', '2', '2016-01-14 15:23:28', '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('37', 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of \'number\' links use for page-sets', '3', '3', null, '2015-02-26 16:56:11', null, null);
INSERT INTO `configuration` VALUES ('38', 'Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Maximum number of products on special to display', '3', '4', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('39', 'New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '27', 'Maximum number of new products to display in a category', '3', '5', '2015-11-12 17:26:24', '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('40', 'Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Maximum number of products expected to display', '3', '6', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('41', 'Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', '3', '7', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('42', 'Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', '3', '7', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('43', 'Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', '3', '8', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('44', 'New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', '3', '9', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('45', 'Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', '3', '10', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('46', 'Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', '3', '11', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('47', 'Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', '3', '12', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('48', 'Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', '3', '13', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('49', 'New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Maximum number of new products to display in new products page', '3', '14', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('50', 'Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '10', 'Maximum number of best sellers to display', '3', '15', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('51', 'Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the \'This Customer Also Purchased\' box', '3', '16', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('52', 'Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', '3', '17', null, '2015-02-26 16:56:12', null, null);
INSERT INTO `configuration` VALUES ('53', 'Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', '3', '18', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('54', 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', '3', '19', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('55', 'Small Image Width', 'SMALL_IMAGE_WIDTH', '200', 'The pixel width of small images', '4', '1', '2016-01-06 11:47:54', '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('56', 'Small Image Height', 'SMALL_IMAGE_HEIGHT', '220', 'The pixel height of small images', '4', '2', '2016-01-06 11:48:01', '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('57', 'Heading Image Width', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images', '4', '3', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('58', 'Heading Image Height', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images', '4', '4', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('59', 'Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', '4', '5', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('60', 'Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', '4', '6', null, '2015-02-26 16:56:13', null, null);
INSERT INTO `configuration` VALUES ('61', 'Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '4', '7', null, '2015-02-26 16:56:13', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('62', 'Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', '4', '8', null, '2015-02-26 16:56:13', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('63', 'Gender', 'ACCOUNT_GENDER', 'true', 'Display gender in the customers account', '5', '1', null, '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('64', 'Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth in the customers account', '5', '2', null, '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('65', 'Company', 'ACCOUNT_COMPANY', 'false', 'Display company in the customers account', '5', '3', '2015-11-12 19:53:10', '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('66', 'Suburb', 'ACCOUNT_SUBURB', 'false', 'Display suburb in the customers account', '5', '4', '2015-11-12 19:53:14', '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('67', 'State', 'ACCOUNT_STATE', 'false', 'Display state in the customers account', '5', '5', '2015-11-12 19:53:19', '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('68', 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'authorizenet_cc_aim.php;cod.php;paypal_express.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)', '6', '0', '2015-06-09 15:56:09', '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('69', 'Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', '2015-06-09 16:09:33', '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('70', 'Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php;table.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', '6', '0', '2015-06-04 14:42:05', '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('71', 'Installed Modules', 'MODULE_ACTION_RECORDER_INSTALLED', 'ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php', 'List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', null, '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('72', 'Installed Modules', 'MODULE_SOCIAL_BOOKMARKS_INSTALLED', 'sb_facebook.php;sb_facebook_like.php;sb_twitter.php', 'List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', '2016-01-06 11:12:46', '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('73', 'Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', '6', '1', null, '2015-02-26 16:56:14', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('74', 'Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', null, '2015-02-26 16:56:14', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES ('75', 'Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '67', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('76', 'Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', null, '2015-02-26 16:56:14', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('82', 'Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', '6', '0', null, '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('83', 'Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', '6', '0', null, '2015-02-26 16:56:14', null, null);
INSERT INTO `configuration` VALUES ('84', 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('96', 'Minimum Minutes Per E-Mail', 'MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES', '15', 'Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('97', 'Minimum Minutes Per E-Mail', 'MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES', '15', 'Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('98', 'Allowed Minutes', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', '5', 'Number of minutes to allow login attempts to occur.', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('99', 'Allowed Attempts', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS', '3', 'Number of login attempts to allow within the specified period.', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('100', 'Allowed Minutes', 'MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', '5', 'Number of minutes to allow password resets to occur.', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('101', 'Allowed Attempts', 'MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS', '1', 'Number of password reset attempts to allow within the specified period.', '6', '0', null, '2015-02-26 16:56:15', null, null);
INSERT INTO `configuration` VALUES ('112', 'Enable Twitter Module', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS', 'False', 'Do you want to allow products to be shared through Twitter?', '6', '1', null, '2015-02-26 16:56:16', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('113', 'Sort Order', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER', '1', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('117', 'Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', '7', '1', null, '2015-02-26 16:56:16', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES ('118', 'Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', '7', '2', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('119', 'Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', '7', '3', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('120', 'Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '3', 'What is the weight of typical packaging of small to medium packages?', '7', '4', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('121', 'Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', '7', '5', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('122', 'Allow Orders Not Matching Defined Shipping Zones ', 'SHIPPING_ALLOW_UNDEFINED_ZONES', 'False', 'Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?', '7', '5', null, '2015-02-26 16:56:16', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('123', 'Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', '8', '1', null, '2015-02-26 16:56:16', null, null);
INSERT INTO `configuration` VALUES ('124', 'Display Product Manufacturer Name', 'PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', '8', '2', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('125', 'Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', '8', '3', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('126', 'Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', '8', '4', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('127', 'Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', '8', '5', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('128', 'Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', '8', '6', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('129', 'Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', '8', '7', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('130', 'Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', '8', '8', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('131', 'Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', '8', '9', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('132', 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', '8', '10', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('133', 'Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', '9', '1', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('134', 'Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', '9', '2', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('135', 'Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', '9', '3', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('136', 'Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', '9', '4', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('137', 'Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', '9', '5', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('138', 'Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', '10', '1', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('139', 'Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', '10', '2', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('140', 'Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', '10', '3', null, '2015-02-26 16:56:17', null, null);
INSERT INTO `configuration` VALUES ('141', 'Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'true', 'Display the page parse time (store page parse time must be enabled)', '10', '4', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('142', 'Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log', '10', '5', null, '2015-02-26 16:56:17', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('143', 'Use Cache', 'USE_CACHE', 'true', 'Use caching features', '11', '1', '2015-05-26 12:12:05', '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('144', 'Cache Directory', 'DIR_FS_CACHE', '/var/www/osCommerce/includes/work/', 'The directory where the cached files are saved', '11', '2', null, '2015-02-26 16:56:18', null, null);
INSERT INTO `configuration` VALUES ('145', 'E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', '12', '1', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),');
INSERT INTO `configuration` VALUES ('146', 'E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '12', '2', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),');
INSERT INTO `configuration` VALUES ('147', 'Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '12', '3', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('148', 'Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', '12', '4', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('149', 'Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '12', '5', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('150', 'Enable download', 'DOWNLOAD_ENABLED', 'false', 'Enable the products download functions.', '13', '1', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('151', 'Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'false', 'Use browser redirection for download. Disable on non-Unix systems.', '13', '2', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('152', 'Expiry delay (days)', 'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', '13', '3', null, '2015-02-26 16:56:18', null, '');
INSERT INTO `configuration` VALUES ('153', 'Maximum number of downloads', 'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', '13', '4', null, '2015-02-26 16:56:18', null, '');
INSERT INTO `configuration` VALUES ('154', 'Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', '14', '1', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('155', 'Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', '14', '2', null, '2015-02-26 16:56:18', null, null);
INSERT INTO `configuration` VALUES ('156', 'Session Directory', 'SESSION_WRITE_DIRECTORY', '/var/www/osCommerce/includes/work/', 'If sessions are file based, store them in this directory.', '15', '1', null, '2015-02-26 16:56:18', null, null);
INSERT INTO `configuration` VALUES ('157', 'Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', '15', '2', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('158', 'Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', '15', '3', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('159', 'Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', '15', '4', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('160', 'Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', '15', '5', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('161', 'Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', '15', '6', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('162', 'Recreate Session', 'SESSION_RECREATE', 'True', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', '15', '7', null, '2015-02-26 16:56:18', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('163', 'Last Update Check Time', 'LAST_UPDATE_CHECK_TIME', '', 'Last time a check for new versions of osCommerce was run', '6', '0', null, '2015-02-26 16:56:18', null, null);
INSERT INTO `configuration` VALUES ('164', 'Store Logo', 'STORE_LOGO', 'logo.png', 'This is the filename of your Store Logo.  This should be updated at admin > configuration > Store Logo', '6', '1000', null, '2015-02-26 16:56:19', null, null);
INSERT INTO `configuration` VALUES ('165', 'Bootstrap Container', 'BOOTSTRAP_CONTAINER', 'container', 'What type of container should the page content be shown in? See http://getbootstrap.com/css/#overview-container', '16', '1', '2015-11-11 16:40:15', '2015-02-26 16:56:19', null, 'tep_cfg_select_option(array(\'container-fluid\', \'container\'), ');
INSERT INTO `configuration` VALUES ('166', 'Bootstrap Content', 'BOOTSTRAP_CONTENT', '6', 'What width should the page content default to?  (8 = two thirds width, 6 = half width, 4 = one third width) Note that the Side Column(s) will adjust automatically.', '16', '2', '2015-11-11 16:40:46', '2015-02-26 16:56:19', null, 'tep_cfg_select_option(array(\'8\', \'6\', \'4\'), ');
INSERT INTO `configuration` VALUES ('167', 'Enable PayPal Express Checkout', 'MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS', 'True', 'Do you want to accept PayPal Express Checkout payments?', '6', '1', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('168', 'Seller Account', 'MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT', 'osc@gmail.com', 'The email address of the seller account if no API credentials has been setup.', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('169', 'API Username', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME', 'kom.huy-facilitator_api1.gmail.com', 'The username to use for the PayPal API service', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('170', 'API Password', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD', '7FVFJT5SAKPCGUHB', 'The password to use for the PayPal API service', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('171', 'API Signature', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE', 'A67TJ2nlTM9Dzyi2fE4dhkuBJ18FAPgglQNWhRX-wuYsAWXvc4GuUlTt', 'The signature to use for the PayPal API service', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('172', 'PayPal Account Optional', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ACCOUNT_OPTIONAL', 'False', 'This must also be enabled in your PayPal account, in Profile > Website Payment Preferences.', '6', '0', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('173', 'PayPal Instant Update', 'MODULE_PAYMENT_PAYPAL_EXPRESS_INSTANT_UPDATE', 'True', 'Support PayPal shipping and tax calculations on the PayPal.com site during Express Checkout.', '6', '0', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('174', 'PayPal Checkout Image', 'MODULE_PAYMENT_PAYPAL_EXPRESS_CHECKOUT_IMAGE', 'Static', 'Use static or dynamic Express Checkout image buttons. Dynamic images are used with PayPal campaigns.', '6', '0', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'Static\', \'Dynamic\'), ');
INSERT INTO `configuration` VALUES ('175', 'Page Style', 'MODULE_PAYMENT_PAYPAL_EXPRESS_PAGE_STYLE', '', 'The page style to use for the checkout flow (defined at your PayPal Profile page)', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('176', 'Transaction Method', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD', 'Sale', 'The processing method to use for each transaction.', '6', '0', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'Authorization\', \'Sale\'), ');
INSERT INTO `configuration` VALUES ('177', 'Set Order Status', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', null, '2015-02-26 16:56:52', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('178', 'PayPal Transactions Order Status Level', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTIONS_ORDER_STATUS_ID', '4', 'Include PayPal transaction information in this order status level', '6', '0', null, '2015-02-26 16:56:52', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('179', 'Payment Zone', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', null, '2015-02-26 16:56:52', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES ('180', 'Transaction Server', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER', 'Sandbox', 'Use the live or testing (sandbox) gateway server to process transactions?', '6', '0', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), ');
INSERT INTO `configuration` VALUES ('181', 'Verify SSL Certificate', 'MODULE_PAYMENT_PAYPAL_EXPRESS_VERIFY_SSL', 'True', 'Verify gateway server SSL certificate on connection?', '6', '1', null, '2015-02-26 16:56:52', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('182', 'Proxy Server', 'MODULE_PAYMENT_PAYPAL_EXPRESS_PROXY', '', 'Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)', '6', '0', null, '2015-02-26 16:56:52', null, null);
INSERT INTO `configuration` VALUES ('183', 'Debug E-Mail Address', 'MODULE_PAYMENT_PAYPAL_EXPRESS_DEBUG_EMAIL', '', 'All parameters of an invalid transaction will be sent to this email address.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('184', 'Sort order of display.', 'MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('185', 'Installed Modules', 'MODULE_HEADER_TAGS_INSTALLED', 'ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_canonical.php;ht_robot_noindex.php;ht_datepicker_jquery.php;ht_grid_list_view.php;ht_table_click_jquery.php;ht_product_colorbox.php;ht_noscript.php;ht_opensearch.php;ht_twitter_product_card.php', 'List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', '2015-02-27 13:46:31', '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('186', 'Enable Category Title Module', 'MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS', 'True', 'Do you want to allow category titles to be added to the page title?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('187', 'Sort Order', 'MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('188', 'Enable Manufacturer Title Module', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS', 'True', 'Do you want to allow manufacturer titles to be added to the page title?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('189', 'Sort Order', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('190', 'Enable Product Title Module', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS', 'True', 'Do you want to allow product titles to be added to the page title?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('191', 'Sort Order', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER', '300', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('192', 'Enable Canonical Module', 'MODULE_HEADER_TAGS_CANONICAL_STATUS', 'True', 'Do you want to enable the Canonical module?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('193', 'Sort Order', 'MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER', '400', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('194', 'Enable Robot NoIndex Module', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS', 'True', 'Do you want to enable the Robot NoIndex module?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('195', 'Pages', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES', 'account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php', 'The pages to add the meta robot noindex tag to.', '6', '0', null, '2015-02-26 16:56:53', 'ht_robot_noindex_show_pages', 'ht_robot_noindex_edit_pages(');
INSERT INTO `configuration` VALUES ('196', 'Sort Order', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('197', 'Enable No Script Module', 'MODULE_HEADER_TAGS_NOSCRIPT_STATUS', 'True', 'Add message for people with .js turned off?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('198', 'Sort Order', 'MODULE_HEADER_TAGS_NOSCRIPT_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('199', 'Enable Datepicker jQuery Module', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_STATUS', 'True', 'Do you want to enable the Datepicker module?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('200', 'Pages', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_PAGES', 'account_edit.php;advanced_search.php;create_account.php', 'The pages to add the Datepicker jQuery Scripts to.', '6', '0', null, '2015-02-26 16:56:53', 'ht_datepicker_jquery_show_pages', 'ht_datepicker_jquery_edit_pages(');
INSERT INTO `configuration` VALUES ('201', 'Sort Order', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_SORT_ORDER', '600', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:53', null, null);
INSERT INTO `configuration` VALUES ('202', 'Enable Grid List javascript', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_STATUS', 'True', 'Do you want to enable the Grid/List Javascript module?', '6', '1', null, '2015-02-26 16:56:53', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('203', 'Pages', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_PAGES', 'advanced_search_result.php;index.php;products_new.php;specials.php', 'The pages to add the Grid List JS Scripts to.', '6', '0', null, '2015-02-26 16:56:53', 'ht_grid_list_view_show_pages', 'ht_grid_list_view_edit_pages(');
INSERT INTO `configuration` VALUES ('204', 'Sort Order', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_SORT_ORDER', '700', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:54', null, null);
INSERT INTO `configuration` VALUES ('205', 'Enable Clickable Table Rows Module', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS', 'True', 'Do you want to enable the Clickable Table Rows module?', '6', '1', null, '2015-02-26 16:56:54', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('206', 'Pages', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES', 'checkout_payment.php;checkout_shipping.php', 'The pages to add the jQuery Scripts to.', '6', '0', null, '2015-02-26 16:56:54', 'ht_table_click_jquery_show_pages', 'ht_table_click_jquery_edit_pages(');
INSERT INTO `configuration` VALUES ('207', 'Sort Order', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER', '800', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:54', null, null);
INSERT INTO `configuration` VALUES ('208', 'Enable Colorbox Script', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_STATUS', 'True', 'Do you want to enable the Colorbox Scripts?', '6', '1', null, '2015-02-26 16:56:54', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('209', 'Pages', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_PAGES', 'product_info.php', 'The pages to add the Colorbox Scripts to.', '6', '0', null, '2015-02-26 16:56:54', 'ht_product_colorbox_show_pages', 'ht_product_colorbox_edit_pages(');
INSERT INTO `configuration` VALUES ('210', 'Sort Order', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_SORT_ORDER', '900', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:54', null, null);
INSERT INTO `configuration` VALUES ('211', 'Installed Modules', 'MODULE_ADMIN_DASHBOARD_INSTALLED', 'd_admin_logins.php;d_total_customers.php;d_total_revenue.php', 'List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', '2015-11-03 13:05:43', '2015-02-26 16:56:54', null, null);
INSERT INTO `configuration` VALUES ('234', 'Installed Modules', 'MODULE_BOXES_INSTALLED', 'bm_categories.php;bm_languages.php;bm_specials.php', 'List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', '2016-05-15 15:28:40', '2015-02-26 16:56:55', null, null);
INSERT INTO `configuration` VALUES ('254', 'Installed Template Block Groups', 'TEMPLATE_BLOCK_GROUPS', 'boxes;header_tags', 'This is automatically updated. No need to edit.', '6', '0', null, '2015-02-26 16:56:56', null, null);
INSERT INTO `configuration` VALUES ('255', 'Installed Modules', 'MODULE_CONTENT_INSTALLED', 'account/cm_account_stripe_cards;account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;checkout_success/cm_cs_thank_you;checkout_success/cm_cs_product_notifications;checkout_success/cm_cs_downloads;footer/cm_footer_account;footer/cm_footer_contact_us;footer/cm_footer_information_links;footer/cm_footer_text;footer_suffix/cm_footer_extra_copyright;footer_suffix/cm_footer_extra_icons;header/cm_header_logo;header/cm_header_search;header/cm_header_breadcrumb;login/cm_paypal_login;login/cm_login_form;login/cm_create_account_link;navigation/cm_navbar', 'This is automatically updated. No need to edit.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('256', 'Enable Set Account Password', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS', 'True', 'Do you want to enable the Set Account Password module?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('257', 'Allow Local Passwords', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD', 'True', 'Allow local account passwords to be set.', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('258', 'Sort Order', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('259', 'Enable Redirect Old Order Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS', 'True', 'Should customers be redirected when viewing old checkout success orders?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('260', 'Redirect Minutes', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES', '60', 'Redirect customers to the My Account page after an order older than this amount is viewed.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('261', 'Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('262', 'Enable Thank You Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_STATUS', 'True', 'Should the thank you block be shown on the checkout success page?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('263', 'Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('264', 'Enable Product Notifications Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS', 'True', 'Should the product notifications block be shown on the checkout success page?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('265', 'Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER', '2000', 'Sort order of display. Lowest is displayed first.', '6', '3', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('266', 'Enable Product Downloads Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS', 'True', 'Should ordered product download links be shown on the checkout success page?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('267', 'Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER', '3000', 'Sort order of display. Lowest is displayed first.', '6', '3', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('268', 'Enable Login Form Module', 'MODULE_CONTENT_LOGIN_FORM_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('269', 'Content Width', 'MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', null, '2015-02-26 16:56:57', null, 'tep_cfg_select_option(array(\'Full\', \'Half\'), ');
INSERT INTO `configuration` VALUES ('270', 'Sort Order', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:57', null, null);
INSERT INTO `configuration` VALUES ('271', 'Enable New User Module', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'True', 'Do you want to enable the new user module?', '6', '1', null, '2015-02-26 16:56:58', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('272', 'Content Width', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', null, '2015-02-26 16:56:58', null, 'tep_cfg_select_option(array(\'Full\', \'Half\'), ');
INSERT INTO `configuration` VALUES ('273', 'Sort Order', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER', '2000', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-26 16:56:58', null, null);
INSERT INTO `configuration` VALUES ('274', 'Security Check Extended Last Run', 'MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME', '1447311345', 'The date and time the last extended security check was performed.', '6', null, null, '2015-02-27 11:29:40', null, null);
INSERT INTO `configuration` VALUES ('291', 'Enable OpenSearch Module', 'MODULE_HEADER_TAGS_OPENSEARCH_STATUS', 'True', 'Add shop search functionality to the browser?', '6', '1', null, '2015-02-27 12:14:22', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('292', 'Short Name', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_SHORT_NAME', 'osc', 'Short name to describe the search engine.', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('293', 'Description', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_DESCRIPTION', 'Search osc', 'Description of the search engine.', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('294', 'Contact', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_CONTACT', 'osc@gmail.com', 'E-Mail address of the search engine maintainer. (optional)', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('295', 'Tags', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_TAGS', '', 'Keywords to identify and categorize the search content, separated by an empty space. (optional)', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('296', 'Attribution', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ATTRIBUTION', 'Copyright (c) osc', 'Attribution for the search content. (optional)', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('297', 'Adult Content', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ADULT_CONTENT', 'False', 'Search content contains material suitable only for adults.', '6', '0', null, '2015-02-27 12:14:22', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('298', '16x16 Icon', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ICON', 'http://localhost/osCommerce/favicon.ico', 'A 16x16 sized icon (must be in .ico format, eg http://server/favicon.ico). (optional)', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('299', '64x64 Image', 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_IMAGE', '', 'A 64x64 sized image (must be in .png format, eg http://server/images/logo.png). (optional)', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('300', 'Sort Order', 'MODULE_HEADER_TAGS_OPENSEARCH_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:14:22', null, null);
INSERT INTO `configuration` VALUES ('301', 'Enable Twitter Product Card Module', 'MODULE_HEADER_TAGS_TWITTER_PRODUCT_CARD_STATUS', 'True', 'Do you want to allow Twitter Product Card tags to be added to your product information pages? Note that your product images MUST be at least 160px by 160px.', '6', '1', null, '2015-02-27 12:15:20', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('302', 'Twitter Author @username', 'MODULE_HEADER_TAGS_TWITTER_PRODUCT_CARD_USER_ID', '', 'Your @username at Twitter', '6', '0', null, '2015-02-27 12:15:20', null, null);
INSERT INTO `configuration` VALUES ('303', 'Twitter Shop @username', 'MODULE_HEADER_TAGS_TWITTER_PRODUCT_CARD_SITE_ID', '', 'Your shops @username at Twitter (or leave blank if it is the same as your @username above).', '6', '0', null, '2015-02-27 12:15:20', null, null);
INSERT INTO `configuration` VALUES ('304', 'Sort Order', 'MODULE_HEADER_TAGS_TWITTER_PRODUCT_CARD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:15:20', null, null);
INSERT INTO `configuration` VALUES ('305', 'Enable Header Breadcrumb Module', 'MODULE_CONTENT_HEADER_BREADCRUMB_STATUS', 'True', 'Do you want to enable the Breadcrumb content module?', '6', '1', null, '2015-02-27 12:23:26', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('306', 'Content Width', 'MODULE_CONTENT_HEADER_BREADCRUMB_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '1', null, '2015-02-27 12:23:26', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('307', 'Sort Order', 'MODULE_CONTENT_HEADER_BREADCRUMB_SORT_ORDER', '2', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:23:26', null, null);
INSERT INTO `configuration` VALUES ('308', 'Enable Header Logo Module', 'MODULE_CONTENT_HEADER_LOGO_STATUS', 'True', 'Do you want to enable the Logo content module?', '6', '1', null, '2015-02-27 12:23:56', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('309', 'Content Width', 'MODULE_CONTENT_HEADER_LOGO_CONTENT_WIDTH', '4', 'What width container should the content be shown in?', '6', '1', null, '2015-02-27 12:23:56', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('310', 'Sort Order', 'MODULE_CONTENT_HEADER_LOGO_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:23:56', null, null);
INSERT INTO `configuration` VALUES ('311', 'Enable Navbar Module', 'MODULE_CONTENT_NAVBAR_STATUS', 'False', 'Should the Navbar be shown? ', '6', '1', null, '2015-02-27 12:24:09', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('312', 'Sort Order', 'MODULE_CONTENT_NAVBAR_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:24:09', null, null);
INSERT INTO `configuration` VALUES ('313', 'Enable Search Box Module', 'MODULE_CONTENT_HEADER_SEARCH_STATUS', 'False', 'Do you want to enable the Search Box content module?', '6', '1', null, '2015-02-27 12:24:17', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('314', 'Content Width', 'MODULE_CONTENT_HEADER_SEARCH_CONTENT_WIDTH', '4', 'What width container should the content be shown in?', '6', '1', null, '2015-02-27 12:24:17', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('315', 'Sort Order', 'MODULE_CONTENT_HEADER_SEARCH_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:24:17', null, null);
INSERT INTO `configuration` VALUES ('316', 'Enable Account Footer Module', 'MODULE_CONTENT_FOOTER_ACCOUNT_STATUS', 'False', 'Do you want to enable the Account content module?', '6', '1', null, '2015-02-27 12:24:59', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('317', 'Content Width', 'MODULE_CONTENT_FOOTER_ACCOUNT_CONTENT_WIDTH', '3', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-02-27 12:25:00', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('318', 'Sort Order', 'MODULE_CONTENT_FOOTER_ACCOUNT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:25:00', null, null);
INSERT INTO `configuration` VALUES ('319', 'Enable Contact Us Footer Module', 'MODULE_CONTENT_FOOTER_CONTACT_US_STATUS', 'True', 'Do you want to enable the Contact Us content module?', '6', '1', null, '2015-02-27 12:25:11', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('320', 'Content Width', 'MODULE_CONTENT_FOOTER_CONTACT_US_CONTENT_WIDTH', '4', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-02-27 12:25:11', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('321', 'Sort Order', 'MODULE_CONTENT_FOOTER_CONTACT_US_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:25:11', null, null);
INSERT INTO `configuration` VALUES ('325', 'Enable Generic Text Footer Module', 'MODULE_CONTENT_FOOTER_TEXT_STATUS', 'True', 'Do you want to enable the Generic Text content module?', '6', '1', null, '2015-02-27 12:26:32', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('326', 'Content Width', 'MODULE_CONTENT_FOOTER_TEXT_CONTENT_WIDTH', '3', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-02-27 12:26:32', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('327', 'Sort Order', 'MODULE_CONTENT_FOOTER_TEXT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:26:32', null, null);
INSERT INTO `configuration` VALUES ('338', 'Enable Copyright Details Footer Module', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS', 'True', 'Do you want to enable the Copyright content module?', '6', '1', null, '2015-02-27 12:27:43', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('339', 'Content Width', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_CONTENT_WIDTH', '6', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-02-27 12:27:43', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('340', 'Sort Order', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:27:43', null, null);
INSERT INTO `configuration` VALUES ('341', 'Enable Stripe Card Management', 'MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_STATUS', 'True', 'Do you want to enable the Stripe Card Management module?', '6', '1', null, '2015-02-27 12:28:35', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('342', 'Sort Order', 'MODULE_CONTENT_ACCOUNT_STRIPE_CARDS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:28:35', null, null);
INSERT INTO `configuration` VALUES ('343', 'Enable Information Links Footer Module', 'MODULE_CONTENT_FOOTER_INFORMATION_STATUS', 'True', 'Do you want to enable the Information Links content module?', '6', '1', null, '2015-02-27 12:28:42', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('344', 'Content Width', 'MODULE_CONTENT_FOOTER_INFORMATION_CONTENT_WIDTH', '4', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-02-27 12:28:42', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('345', 'Sort Order', 'MODULE_CONTENT_FOOTER_INFORMATION_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-02-27 12:28:42', null, null);
INSERT INTO `configuration` VALUES ('346', 'Enable SEO URLs?', 'SEO_ENABLED', 'true', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', '17', '0', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('347', 'Add cPath to product URLs?', 'SEO_ADD_CID_TO_PRODUCT_URLS', 'true', 'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).', '17', '1', '2015-03-21 15:11:03', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('348', 'Add category parent to product URLs?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'true', 'This setting will append the category parent(s) name to the product URLs (i.e. - parent-some-product-p-1.html).', '17', '2', '2015-03-21 15:11:09', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('349', 'Add category parent to begining of URLs?', 'SEO_ADD_CAT_PARENT', 'false', 'This setting will add the category parent(s) name to the beginning of the category URLs (i.e. - parent-category-c-1.html).', '17', '3', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('350', 'Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting will filter words less than or equal to the value from the URL.', '17', '4', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, null);
INSERT INTO `configuration` VALUES ('351', 'Output W3C valid URLs (parameter string)?', 'SEO_URLS_USE_W3C_VALID', 'true', 'This setting will output W3C valid URLs.', '17', '5', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('352', 'Enable SEO cache to save queries?', 'USE_SEO_CACHE_GLOBAL', 'true', 'This is a global setting and will turn off caching completely.', '17', '6', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('353', 'Enable product cache?', 'USE_SEO_CACHE_PRODUCTS', 'true', 'This will turn off caching for the products.', '17', '7', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('354', 'Enable categories cache?', 'USE_SEO_CACHE_CATEGORIES', 'true', 'This will turn off caching for the categories.', '17', '8', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('355', 'Enable manufacturers cache?', 'USE_SEO_CACHE_MANUFACTURERS', 'true', 'This will turn off caching for the manufacturers.', '17', '9', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('356', 'Enable Articles Manager Articles cache?', 'USE_SEO_CACHE_ARTICLES', 'false', 'This will turn off caching for the Articles Manager articles.', '17', '10', '2015-03-19 14:29:54', '2015-03-19 14:29:54', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('357', 'Enable Articles Manager Topics cache?', 'USE_SEO_CACHE_TOPICS', 'false', 'This will turn off caching for the Articles Manager topics.', '17', '11', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('358', 'Enable FAQDesk Categories cache?', 'USE_SEO_CACHE_FAQDESK_CATEGORIES', 'false', 'This will turn off caching for the FAQDesk Category pages.', '17', '12', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('359', 'Enable Information Pages cache?', 'USE_SEO_CACHE_INFO_PAGES', 'false', 'This will turn off caching for Information Pages.', '17', '13', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('360', 'Enable Links Manager cache?', 'USE_SEO_CACHE_LINKS', 'false', 'This will turn off caching for the Links Manager category pages.', '17', '14', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('361', 'Enable NewsDesk Articles cache?', 'USE_SEO_CACHE_NEWSDESK_ARTICLES', 'false', 'This will turn off caching for the NewsDesk Article pages.', '17', '15', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('362', 'Enable NewsDesk Categories cache?', 'USE_SEO_CACHE_NEWSDESK_CATEGORIES', 'false', 'This will turn off caching for the NewsDesk Category pages.', '17', '16', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('363', 'Enable Pollbooth cache?', 'USE_SEO_CACHE_POLLBOOTH', 'false', 'This will turn off caching for Pollbooth.', '17', '17', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('364', 'Enable Page Editor cache?', 'USE_SEO_CACHE_PAGE_EDITOR', 'false', 'This will turn off caching for the Page Editor pages.', '17', '18', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('365', 'Enable automatic redirects?', 'USE_SEO_REDIRECT', 'true', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', '17', '19', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('366', 'Enable use Header Tags SEO as name?', 'USE_SEO_HEADER_TAGS', 'false', 'This will cause the title set in Header Tags SEO to be used instead of the categories or products name.', '17', '20', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('367', 'Enable performance checker?', 'USE_SEO_PERFORMANCE_CHECK', 'false', 'This will cause the code to track all database queries so that its affect on the speed of the page can be determined. Enabling it will cause a small speed loss.', '17', '21', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('368', 'Choose URL Rewrite Type', 'SEO_REWRITE_TYPE', 'Rewrite', 'Choose which SEO URL format to use.', '17', '22', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'Rewrite\'),');
INSERT INTO `configuration` VALUES ('369', 'Enter special character conversions', 'SEO_CHAR_CONVERT_SET', '', 'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', '17', '23', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, null);
INSERT INTO `configuration` VALUES ('370', 'Remove all non-alphanumeric characters?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.', '17', '24', '2015-03-19 14:29:55', '2015-03-19 14:29:55', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('371', 'Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', '17', '25', '2015-03-19 14:29:55', '2015-03-19 14:29:55', 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(\'reset\', \'false\'),');
INSERT INTO `configuration` VALUES ('372', 'Uninstall Ultimate SEO', 'SEO_URLS_DB_UNINSTALL', 'false', 'This will delete all of the entries in the configuration table for SEO', '17', '26', '2015-03-19 14:29:55', '2015-03-19 14:29:55', 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(\'uninstall\', \'false\'),');
INSERT INTO `configuration` VALUES ('373', 'Enable Payment Icons Footer Module', 'MODULE_CONTENT_FOOTER_EXTRA_ICONS_STATUS', 'True', 'Do you want to enable the Payment Icons content module?', '6', '1', null, '2015-05-25 11:59:31', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('374', 'Content Width', 'MODULE_CONTENT_FOOTER_EXTRA_ICONS_CONTENT_WIDTH', '6', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', null, '2015-05-25 11:59:31', null, 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ');
INSERT INTO `configuration` VALUES ('375', 'Sort Order', 'MODULE_CONTENT_FOOTER_EXTRA_ICONS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-05-25 11:59:32', null, null);
INSERT INTO `configuration` VALUES ('376', 'Enable Facebook Module', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS', 'True', 'Do you want to allow products to be shared through Facebook?', '6', '1', null, '2015-05-25 12:05:07', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('377', 'Sort Order', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-05-25 12:05:07', null, null);
INSERT INTO `configuration` VALUES ('452', 'Installed Modules', '', '', 'This is automatically updated. No need to edit.', '6', '0', null, '2015-05-26 12:18:05', null, null);
INSERT INTO `configuration` VALUES ('549', 'Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', '6', '0', null, '2015-06-04 14:42:05', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('550', 'Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', '6', '0', null, '2015-06-04 14:42:05', null, null);
INSERT INTO `configuration` VALUES ('551', 'Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', null, '2015-06-04 14:42:05', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES ('552', 'Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', null, '2015-06-04 14:42:05', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES ('553', 'Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', null, '2015-06-04 14:42:05', null, null);
INSERT INTO `configuration` VALUES ('1310', 'Enable Table Method', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Do you want to offer table rate shipping?', '6', '0', null, '2015-06-05 15:47:28', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1311', 'Shipping Table', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'The shipping cost is based on the total cost or weight of items. Example: 25:8.50,50:5.50,etc.. Up to 25 charge 8.50, from there to 50 charge 5.50, etc', '6', '0', null, '2015-06-05 15:47:28', null, null);
INSERT INTO `configuration` VALUES ('1312', 'Table Method', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'The shipping cost is based on the order total or the total weight of the items ordered.', '6', '0', null, '2015-06-05 15:47:28', null, 'tep_cfg_select_option(array(\'weight\', \'price\'), ');
INSERT INTO `configuration` VALUES ('1313', 'Handling Fee', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'Handling fee for this shipping method.', '6', '0', null, '2015-06-05 15:47:28', null, null);
INSERT INTO `configuration` VALUES ('1314', 'Tax Class', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', null, '2015-06-05 15:47:28', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES ('1315', 'Shipping Zone', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', null, '2015-06-05 15:47:28', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES ('1316', 'Sort Order', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'Sort order of display.', '6', '0', null, '2015-06-05 15:47:28', null, null);
INSERT INTO `configuration` VALUES ('1409', 'Enable Authorize.net Advanced Integration Method', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS', 'True', 'Do you want to accept Authorize.net Advanced Integration Method payments?', '6', '0', null, '2015-06-09 15:55:05', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1410', 'API Login ID', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID', '', 'The API Login ID used for the Authorize.net service', '6', '0', null, '2015-06-09 15:55:05', null, null);
INSERT INTO `configuration` VALUES ('1411', 'API Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_KEY', '', 'The API Transaction Key used for the Authorize.net service', '6', '0', null, '2015-06-09 15:55:06', null, null);
INSERT INTO `configuration` VALUES ('1412', 'MD5 Hash', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH', '', 'The MD5 Hash value to verify transactions with', '6', '0', null, '2015-06-09 15:55:06', null, null);
INSERT INTO `configuration` VALUES ('1413', 'Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_METHOD', 'Authorization', 'The processing method to use for each transaction.', '6', '0', null, '2015-06-09 15:55:06', null, 'tep_cfg_select_option(array(\'Authorization\', \'Capture\'), ');
INSERT INTO `configuration` VALUES ('1414', 'Set Order Status', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', null, '2015-06-09 15:55:06', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('1415', 'Review Order Status', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_REVIEW_ORDER_STATUS_ID', '0', 'Set the status of orders flagged as being under review to this value', '6', '0', null, '2015-06-09 15:55:06', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('1416', 'Transaction Order Status', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_ORDER_STATUS_ID', '5', 'Include transaction information in this order status level', '6', '0', null, '2015-06-09 15:55:06', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES ('1417', 'Payment Zone', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '0', null, '2015-06-09 15:55:06', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES ('1418', 'Transaction Server', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_SERVER', 'Live', 'Perform transactions on the live or test server. The test server should only be used by developers with Authorize.net test accounts.', '6', '0', null, '2015-06-09 15:55:06', null, 'tep_cfg_select_option(array(\'Live\', \'Test\'), ');
INSERT INTO `configuration` VALUES ('1419', 'Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_MODE', 'Live', 'Transaction mode used for processing orders', '6', '0', null, '2015-06-09 15:55:06', null, 'tep_cfg_select_option(array(\'Live\', \'Test\'), ');
INSERT INTO `configuration` VALUES ('1420', 'Verify SSL Certificate', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_VERIFY_SSL', 'True', 'Verify transaction server SSL certificate on connection?', '6', '0', null, '2015-06-09 15:55:06', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1421', 'Proxy Server', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_PROXY', '', 'Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)', '6', '0', null, '2015-06-09 15:55:06', null, null);
INSERT INTO `configuration` VALUES ('1422', 'Debug E-Mail Address', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_DEBUG_EMAIL', '', 'All parameters of an invalid transaction will be sent to this email address.', '6', '0', null, '2015-06-09 15:55:06', null, null);
INSERT INTO `configuration` VALUES ('1423', 'Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-06-09 15:55:06', null, null);
INSERT INTO `configuration` VALUES ('1477', 'Enable Log In with PayPal', 'MODULE_CONTENT_PAYPAL_LOGIN_STATUS', 'True', 'Do you want to enable the Log In with PayPal module?', '6', '0', null, '2015-06-09 16:05:44', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1478', 'Client ID', 'MODULE_CONTENT_PAYPAL_LOGIN_CLIENT_ID', '', 'Your PayPal Application Client ID.', '6', '0', null, '2015-06-09 16:05:44', null, null);
INSERT INTO `configuration` VALUES ('1479', 'Secret', 'MODULE_CONTENT_PAYPAL_LOGIN_SECRET', '', 'Your PayPal Application Secret.', '6', '0', null, '2015-06-09 16:05:44', null, null);
INSERT INTO `configuration` VALUES ('1480', 'Theme', 'MODULE_CONTENT_PAYPAL_LOGIN_THEME', 'Blue', 'Which theme should be used for the button?', '6', '0', null, '2015-06-09 16:05:44', null, 'tep_cfg_select_option(array(\'Blue\', \'Neutral\'), ');
INSERT INTO `configuration` VALUES ('1481', 'Information Requested From Customers', 'MODULE_CONTENT_PAYPAL_LOGIN_ATTRIBUTES', 'full_name;date_of_birth;age_range;gender;email_address;street_address;city;state;country;zip_code;phone;account_status;account_type;account_creation_date;time_zone;locale;language;seamless_checkout', 'The attributes the customer must share with you.', '6', '0', null, '2015-06-09 16:05:44', 'cm_paypal_login_show_attributes', 'cm_paypal_login_edit_attributes(');
INSERT INTO `configuration` VALUES ('1482', 'Server Type', 'MODULE_CONTENT_PAYPAL_LOGIN_SERVER_TYPE', 'Live', 'Which server should be used? Live for production or Sandbox for testing.', '6', '0', null, '2015-06-09 16:05:44', null, 'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), ');
INSERT INTO `configuration` VALUES ('1483', 'Verify SSL Certificate', 'MODULE_CONTENT_PAYPAL_LOGIN_VERIFY_SSL', 'True', 'Verify gateway server SSL certificate on connection?', '6', '0', null, '2015-06-09 16:05:44', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1484', 'Proxy Server', 'MODULE_CONTENT_PAYPAL_LOGIN_PROXY', '', 'Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)', '6', '0', null, '2015-06-09 16:05:44', null, null);
INSERT INTO `configuration` VALUES ('1485', 'Content Width', 'MODULE_CONTENT_PAYPAL_LOGIN_CONTENT_WIDTH', 'Full', 'Should the content be shown in a full or half width container?', '6', '0', null, '2015-06-09 16:05:44', null, 'tep_cfg_select_option(array(\'Full\', \'Half\'), ');
INSERT INTO `configuration` VALUES ('1486', 'Sort order of display', 'MODULE_CONTENT_PAYPAL_LOGIN_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-06-09 16:05:44', null, null);
INSERT INTO `configuration` VALUES ('1494', 'Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', '6', '1', null, '2015-06-09 16:09:24', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('1495', 'Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', '6', '2', null, '2015-06-09 16:09:24', null, null);
INSERT INTO `configuration` VALUES ('1496', 'Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', '6', '3', null, '2015-06-09 16:09:24', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('1497', 'Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Provide free shipping for orders over the set amount.', '6', '4', null, '2015-06-09 16:09:24', 'currencies->format', null);
INSERT INTO `configuration` VALUES ('1498', 'Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', '6', '5', null, '2015-06-09 16:09:24', null, 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), ');
INSERT INTO `configuration` VALUES ('1499', 'Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', '6', '1', null, '2015-06-09 16:09:26', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('1500', 'Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '4', 'Sort order of display.', '6', '2', null, '2015-06-09 16:09:26', null, null);
INSERT INTO `configuration` VALUES ('1501', 'Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', '6', '1', null, '2015-06-09 16:09:28', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('1502', 'Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', '6', '2', null, '2015-06-09 16:09:28', null, null);
INSERT INTO `configuration` VALUES ('1503', 'Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', '6', '1', null, '2015-06-09 16:09:30', null, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES ('1504', 'Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', '6', '2', null, '2015-06-09 16:09:30', null, null);
INSERT INTO `configuration` VALUES ('1505', 'Enable Categories Module', 'MODULE_BOXES_CATEGORIES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', null, '2015-06-11 11:22:08', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1506', 'Content Placement', 'MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', null, '2015-06-11 11:22:08', null, 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ');
INSERT INTO `configuration` VALUES ('1507', 'Sort Order', 'MODULE_BOXES_CATEGORIES_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-06-11 11:22:08', null, null);
INSERT INTO `configuration` VALUES ('1511', 'Require users to login to reply?', 'NEWS_REPLY', 'true', 'This makes users create an account at your store to reply to prevent spam.', '367', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('1512', 'Receive email when user replies?', 'NEWS_EMAIL', 'true', 'This will send an email when a user replies?', '367', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('1513', 'Require replies to be approved by admin?', 'NEWS_APPROVED', 'false', 'Set to true if you want to approve user repies before they display on your store.', '367', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('1514', 'Number of months to display on the storefront.', 'NEWS_MONTH_ROWS', '12', 'This is the menu that is on the left on the news store front. The default is 12', '367', '4', null, '2015-11-03 11:27:50', null, null);
INSERT INTO `configuration` VALUES ('1515', 'Number of characters to display in each subtitle.', 'NEWS_CHARACTERS', '100', 'This is the sub-title that is displayed below the title on the front news page. The default is 100.', '367', '5', null, '2015-11-03 11:27:50', null, null);
INSERT INTO `configuration` VALUES ('1516', 'Number of articles to display in your RSS Feed.', 'NEWS_RSS_ARTICLE', '10', 'If you want all of your articles to display in the RSS type in something like 2000.  The default is 10', '367', '6', null, '2015-11-03 11:27:50', null, null);
INSERT INTO `configuration` VALUES ('1517', 'Number of characters to display in each RSS article.', 'NEWS_RSS_CHARACTERS', '250', 'If you keep this at 250 it will hide a little bit of each of article from your viewers. They will have to come to your store to finish.  The default is 250', '367', '7', null, '2015-11-03 11:27:51', null, null);
INSERT INTO `configuration` VALUES ('1518', 'Enable Total Customers Module', 'MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS', 'True', 'Do you want to show the total customers chart on the dashboard?', '6', '1', null, '2015-11-03 13:05:32', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1519', 'Sort Order', 'MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-11-03 13:05:32', null, null);
INSERT INTO `configuration` VALUES ('1520', 'Enable Total Revenue Module', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS', 'True', 'Do you want to show the total revenue chart on the dashboard?', '6', '1', null, '2015-11-03 13:05:39', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1521', 'Sort Order', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-11-03 13:05:39', null, null);
INSERT INTO `configuration` VALUES ('1522', 'Enable Administrator Logins Module', 'MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS', 'True', 'Do you want to show the latest administrator logins on the dashboard?', '6', '1', null, '2015-11-03 13:05:42', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1523', 'Sort Order', 'MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2015-11-03 13:05:42', null, null);
INSERT INTO `configuration` VALUES ('1527', 'Enable Specials Module', 'MODULE_BOXES_SPECIALS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', null, '2016-01-05 18:20:20', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1528', 'Content Placement', 'MODULE_BOXES_SPECIALS_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', null, '2016-01-05 18:20:20', null, 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ');
INSERT INTO `configuration` VALUES ('1529', 'Sort Order', 'MODULE_BOXES_SPECIALS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2016-01-05 18:20:21', null, null);
INSERT INTO `configuration` VALUES ('1533', 'Enable Facebook Like Module', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STATUS', 'True', 'Do you want to allow products to be shared through Facebook Like?', '6', '1', null, '2016-01-06 11:12:46', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1534', 'Layout Style', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_STYLE', 'Button Count', 'Determines the size and amount of social context next to the button.', '6', '1', null, '2016-01-06 11:12:46', null, 'tep_cfg_select_option(array(\'Standard\', \'Button Count\'), ');
INSERT INTO `configuration` VALUES ('1535', 'Show Faces', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_FACES', 'True', 'Show profile pictures below the button?', '6', '1', null, '2016-01-06 11:12:46', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1536', 'Width', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_WIDTH', '200', 'The width of the iframe in pixels.', '6', '0', null, '2016-01-06 11:12:46', null, null);
INSERT INTO `configuration` VALUES ('1537', 'Verb to Display', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_VERB', 'Like', 'The verb to display in the button.', '6', '1', null, '2016-01-06 11:12:46', null, 'tep_cfg_select_option(array(\'Like\', \'Recommend\'), ');
INSERT INTO `configuration` VALUES ('1538', 'Color Scheme', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SCHEME', 'Dark', 'The color scheme of the button.', '6', '1', null, '2016-01-06 11:12:46', null, 'tep_cfg_select_option(array(\'Light\', \'Dark\'), ');
INSERT INTO `configuration` VALUES ('1539', 'Sort Order', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_LIKE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2016-01-06 11:12:46', null, null);
INSERT INTO `configuration` VALUES ('1540', 'Enable Languages Module', 'MODULE_BOXES_LANGUAGES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', null, '2016-05-15 15:28:40', null, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES ('1541', 'Content Placement', 'MODULE_BOXES_LANGUAGES_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', null, '2016-05-15 15:28:40', null, 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ');
INSERT INTO `configuration` VALUES ('1542', 'Sort Order', 'MODULE_BOXES_LANGUAGES_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', null, '2016-05-15 15:28:40', null, null);

-- ----------------------------
-- Table structure for `configuration_group`
-- ----------------------------
DROP TABLE IF EXISTS `configuration_group`;
CREATE TABLE `configuration_group` (
  `configuration_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_group_title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_group_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `visible` int(1) DEFAULT '1',
  PRIMARY KEY (`configuration_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=368 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of configuration_group
-- ----------------------------
INSERT INTO `configuration_group` VALUES ('1', 'My Store', 'General information about my store', '1', '1');
INSERT INTO `configuration_group` VALUES ('2', 'Minimum Values', 'The minimum values for functions / data', '2', '1');
INSERT INTO `configuration_group` VALUES ('3', 'Maximum Values', 'The maximum values for functions / data', '3', '1');
INSERT INTO `configuration_group` VALUES ('4', 'Images', 'Image parameters', '4', '1');
INSERT INTO `configuration_group` VALUES ('5', 'Customer Details', 'Customer account configuration', '5', '1');
INSERT INTO `configuration_group` VALUES ('6', 'Module Options', 'Hidden from configuration', '6', '0');
INSERT INTO `configuration_group` VALUES ('7', 'Shipping/Packaging', 'Shipping options available at my store', '7', '1');
INSERT INTO `configuration_group` VALUES ('8', 'Product Listing', 'Product Listing    configuration options', '8', '1');
INSERT INTO `configuration_group` VALUES ('9', 'Stock', 'Stock configuration options', '9', '1');
INSERT INTO `configuration_group` VALUES ('10', 'Logging', 'Logging configuration options', '10', '1');
INSERT INTO `configuration_group` VALUES ('11', 'Cache', 'Caching configuration options', '11', '1');
INSERT INTO `configuration_group` VALUES ('12', 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', '12', '1');
INSERT INTO `configuration_group` VALUES ('13', 'Download', 'Downloadable products options', '13', '1');
INSERT INTO `configuration_group` VALUES ('14', 'GZip Compression', 'GZip compression options', '14', '1');
INSERT INTO `configuration_group` VALUES ('15', 'Sessions', 'Session options', '15', '1');
INSERT INTO `configuration_group` VALUES ('16', 'Bootstrap Setup', 'Basic Bootstrap Options', '16', '1');
INSERT INTO `configuration_group` VALUES ('17', 'SEO URLs', 'Options for Ultimate SEO URLs by Chemo', '17', '1');
INSERT INTO `configuration_group` VALUES ('367', 'News Blog', 'News Blog Configuration', '200', '1');

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `countries_iso_code_2` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `countries_iso_code_3` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `address_format_id` int(11) NOT NULL,
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'Afghanistan', 'AF', 'AFG', '1');
INSERT INTO `countries` VALUES ('2', 'Albania', 'AL', 'ALB', '1');
INSERT INTO `countries` VALUES ('3', 'Algeria', 'DZ', 'DZA', '1');
INSERT INTO `countries` VALUES ('4', 'American Samoa', 'AS', 'ASM', '1');
INSERT INTO `countries` VALUES ('5', 'Andorra', 'AD', 'AND', '1');
INSERT INTO `countries` VALUES ('6', 'Angola', 'AO', 'AGO', '1');
INSERT INTO `countries` VALUES ('7', 'Anguilla', 'AI', 'AIA', '1');
INSERT INTO `countries` VALUES ('8', 'Antarctica', 'AQ', 'ATA', '1');
INSERT INTO `countries` VALUES ('9', 'Antigua and Barbuda', 'AG', 'ATG', '1');
INSERT INTO `countries` VALUES ('10', 'Argentina', 'AR', 'ARG', '1');
INSERT INTO `countries` VALUES ('11', 'Armenia', 'AM', 'ARM', '1');
INSERT INTO `countries` VALUES ('12', 'Aruba', 'AW', 'ABW', '1');
INSERT INTO `countries` VALUES ('13', 'Australia', 'AU', 'AUS', '1');
INSERT INTO `countries` VALUES ('14', 'Austria', 'AT', 'AUT', '5');
INSERT INTO `countries` VALUES ('15', 'Azerbaijan', 'AZ', 'AZE', '1');
INSERT INTO `countries` VALUES ('16', 'Bahamas', 'BS', 'BHS', '1');
INSERT INTO `countries` VALUES ('17', 'Bahrain', 'BH', 'BHR', '1');
INSERT INTO `countries` VALUES ('18', 'Bangladesh', 'BD', 'BGD', '1');
INSERT INTO `countries` VALUES ('19', 'Barbados', 'BB', 'BRB', '1');
INSERT INTO `countries` VALUES ('20', 'Belarus', 'BY', 'BLR', '1');
INSERT INTO `countries` VALUES ('21', 'Belgium', 'BE', 'BEL', '1');
INSERT INTO `countries` VALUES ('22', 'Belize', 'BZ', 'BLZ', '1');
INSERT INTO `countries` VALUES ('23', 'Benin', 'BJ', 'BEN', '1');
INSERT INTO `countries` VALUES ('24', 'Bermuda', 'BM', 'BMU', '1');
INSERT INTO `countries` VALUES ('25', 'Bhutan', 'BT', 'BTN', '1');
INSERT INTO `countries` VALUES ('26', 'Bolivia', 'BO', 'BOL', '1');
INSERT INTO `countries` VALUES ('27', 'Bosnia and Herzegowina', 'BA', 'BIH', '1');
INSERT INTO `countries` VALUES ('28', 'Botswana', 'BW', 'BWA', '1');
INSERT INTO `countries` VALUES ('29', 'Bouvet Island', 'BV', 'BVT', '1');
INSERT INTO `countries` VALUES ('30', 'Brazil', 'BR', 'BRA', '1');
INSERT INTO `countries` VALUES ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '1');
INSERT INTO `countries` VALUES ('32', 'Brunei Darussalam', 'BN', 'BRN', '1');
INSERT INTO `countries` VALUES ('33', 'Bulgaria', 'BG', 'BGR', '1');
INSERT INTO `countries` VALUES ('34', 'Burkina Faso', 'BF', 'BFA', '1');
INSERT INTO `countries` VALUES ('35', 'Burundi', 'BI', 'BDI', '1');
INSERT INTO `countries` VALUES ('36', 'Cambodia', 'KH', 'KHM', '1');
INSERT INTO `countries` VALUES ('37', 'Cameroon', 'CM', 'CMR', '1');
INSERT INTO `countries` VALUES ('38', 'Canada', 'CA', 'CAN', '1');
INSERT INTO `countries` VALUES ('39', 'Cape Verde', 'CV', 'CPV', '1');
INSERT INTO `countries` VALUES ('40', 'Cayman Islands', 'KY', 'CYM', '1');
INSERT INTO `countries` VALUES ('41', 'Central African Republic', 'CF', 'CAF', '1');
INSERT INTO `countries` VALUES ('42', 'Chad', 'TD', 'TCD', '1');
INSERT INTO `countries` VALUES ('43', 'Chile', 'CL', 'CHL', '1');
INSERT INTO `countries` VALUES ('44', 'China', 'CN', 'CHN', '1');
INSERT INTO `countries` VALUES ('45', 'Christmas Island', 'CX', 'CXR', '1');
INSERT INTO `countries` VALUES ('46', 'Cocos (Keeling) Islands', 'CC', 'CCK', '1');
INSERT INTO `countries` VALUES ('47', 'Colombia', 'CO', 'COL', '1');
INSERT INTO `countries` VALUES ('48', 'Comoros', 'KM', 'COM', '1');
INSERT INTO `countries` VALUES ('49', 'Congo', 'CG', 'COG', '1');
INSERT INTO `countries` VALUES ('50', 'Cook Islands', 'CK', 'COK', '1');
INSERT INTO `countries` VALUES ('51', 'Costa Rica', 'CR', 'CRI', '1');
INSERT INTO `countries` VALUES ('52', 'Cote D\'Ivoire', 'CI', 'CIV', '1');
INSERT INTO `countries` VALUES ('53', 'Croatia', 'HR', 'HRV', '1');
INSERT INTO `countries` VALUES ('54', 'Cuba', 'CU', 'CUB', '1');
INSERT INTO `countries` VALUES ('55', 'Cyprus', 'CY', 'CYP', '1');
INSERT INTO `countries` VALUES ('56', 'Czech Republic', 'CZ', 'CZE', '1');
INSERT INTO `countries` VALUES ('57', 'Denmark', 'DK', 'DNK', '1');
INSERT INTO `countries` VALUES ('58', 'Djibouti', 'DJ', 'DJI', '1');
INSERT INTO `countries` VALUES ('59', 'Dominica', 'DM', 'DMA', '1');
INSERT INTO `countries` VALUES ('60', 'Dominican Republic', 'DO', 'DOM', '1');
INSERT INTO `countries` VALUES ('61', 'East Timor', 'TP', 'TMP', '1');
INSERT INTO `countries` VALUES ('62', 'Ecuador', 'EC', 'ECU', '1');
INSERT INTO `countries` VALUES ('63', 'Egypt', 'EG', 'EGY', '1');
INSERT INTO `countries` VALUES ('64', 'El Salvador', 'SV', 'SLV', '1');
INSERT INTO `countries` VALUES ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '1');
INSERT INTO `countries` VALUES ('66', 'Eritrea', 'ER', 'ERI', '1');
INSERT INTO `countries` VALUES ('67', 'Estonia', 'EE', 'EST', '1');
INSERT INTO `countries` VALUES ('68', 'Ethiopia', 'ET', 'ETH', '1');
INSERT INTO `countries` VALUES ('69', 'Falkland Islands (Malvinas)', 'FK', 'FLK', '1');
INSERT INTO `countries` VALUES ('70', 'Faroe Islands', 'FO', 'FRO', '1');
INSERT INTO `countries` VALUES ('71', 'Fiji', 'FJ', 'FJI', '1');
INSERT INTO `countries` VALUES ('72', 'Finland', 'FI', 'FIN', '1');
INSERT INTO `countries` VALUES ('73', 'France', 'FR', 'FRA', '1');
INSERT INTO `countries` VALUES ('74', 'France, Metropolitan', 'FX', 'FXX', '1');
INSERT INTO `countries` VALUES ('75', 'French Guiana', 'GF', 'GUF', '1');
INSERT INTO `countries` VALUES ('76', 'French Polynesia', 'PF', 'PYF', '1');
INSERT INTO `countries` VALUES ('77', 'French Southern Territories', 'TF', 'ATF', '1');
INSERT INTO `countries` VALUES ('78', 'Gabon', 'GA', 'GAB', '1');
INSERT INTO `countries` VALUES ('79', 'Gambia', 'GM', 'GMB', '1');
INSERT INTO `countries` VALUES ('80', 'Georgia', 'GE', 'GEO', '1');
INSERT INTO `countries` VALUES ('81', 'Germany', 'DE', 'DEU', '5');
INSERT INTO `countries` VALUES ('82', 'Ghana', 'GH', 'GHA', '1');
INSERT INTO `countries` VALUES ('83', 'Gibraltar', 'GI', 'GIB', '1');
INSERT INTO `countries` VALUES ('84', 'Greece', 'GR', 'GRC', '1');
INSERT INTO `countries` VALUES ('85', 'Greenland', 'GL', 'GRL', '1');
INSERT INTO `countries` VALUES ('86', 'Grenada', 'GD', 'GRD', '1');
INSERT INTO `countries` VALUES ('87', 'Guadeloupe', 'GP', 'GLP', '1');
INSERT INTO `countries` VALUES ('88', 'Guam', 'GU', 'GUM', '1');
INSERT INTO `countries` VALUES ('89', 'Guatemala', 'GT', 'GTM', '1');
INSERT INTO `countries` VALUES ('90', 'Guinea', 'GN', 'GIN', '1');
INSERT INTO `countries` VALUES ('91', 'Guinea-bissau', 'GW', 'GNB', '1');
INSERT INTO `countries` VALUES ('92', 'Guyana', 'GY', 'GUY', '1');
INSERT INTO `countries` VALUES ('93', 'Haiti', 'HT', 'HTI', '1');
INSERT INTO `countries` VALUES ('94', 'Heard and Mc Donald Islands', 'HM', 'HMD', '1');
INSERT INTO `countries` VALUES ('95', 'Honduras', 'HN', 'HND', '1');
INSERT INTO `countries` VALUES ('96', 'Hong Kong', 'HK', 'HKG', '1');
INSERT INTO `countries` VALUES ('97', 'Hungary', 'HU', 'HUN', '1');
INSERT INTO `countries` VALUES ('98', 'Iceland', 'IS', 'ISL', '1');
INSERT INTO `countries` VALUES ('99', 'India', 'IN', 'IND', '1');
INSERT INTO `countries` VALUES ('100', 'Indonesia', 'ID', 'IDN', '1');
INSERT INTO `countries` VALUES ('101', 'Iran (Islamic Republic of)', 'IR', 'IRN', '1');
INSERT INTO `countries` VALUES ('102', 'Iraq', 'IQ', 'IRQ', '1');
INSERT INTO `countries` VALUES ('103', 'Ireland', 'IE', 'IRL', '1');
INSERT INTO `countries` VALUES ('104', 'Israel', 'IL', 'ISR', '1');
INSERT INTO `countries` VALUES ('105', 'Italy', 'IT', 'ITA', '1');
INSERT INTO `countries` VALUES ('106', 'Jamaica', 'JM', 'JAM', '1');
INSERT INTO `countries` VALUES ('107', 'Japan', 'JP', 'JPN', '1');
INSERT INTO `countries` VALUES ('108', 'Jordan', 'JO', 'JOR', '1');
INSERT INTO `countries` VALUES ('109', 'Kazakhstan', 'KZ', 'KAZ', '1');
INSERT INTO `countries` VALUES ('110', 'Kenya', 'KE', 'KEN', '1');
INSERT INTO `countries` VALUES ('111', 'Kiribati', 'KI', 'KIR', '1');
INSERT INTO `countries` VALUES ('112', 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', '1');
INSERT INTO `countries` VALUES ('113', 'Korea, Republic of', 'KR', 'KOR', '1');
INSERT INTO `countries` VALUES ('114', 'Kuwait', 'KW', 'KWT', '1');
INSERT INTO `countries` VALUES ('115', 'Kyrgyzstan', 'KG', 'KGZ', '1');
INSERT INTO `countries` VALUES ('116', 'Lao People\'s Democratic Republic', 'LA', 'LAO', '1');
INSERT INTO `countries` VALUES ('117', 'Latvia', 'LV', 'LVA', '1');
INSERT INTO `countries` VALUES ('118', 'Lebanon', 'LB', 'LBN', '1');
INSERT INTO `countries` VALUES ('119', 'Lesotho', 'LS', 'LSO', '1');
INSERT INTO `countries` VALUES ('120', 'Liberia', 'LR', 'LBR', '1');
INSERT INTO `countries` VALUES ('121', 'Libyan Arab Jamahiriya', 'LY', 'LBY', '1');
INSERT INTO `countries` VALUES ('122', 'Liechtenstein', 'LI', 'LIE', '1');
INSERT INTO `countries` VALUES ('123', 'Lithuania', 'LT', 'LTU', '1');
INSERT INTO `countries` VALUES ('124', 'Luxembourg', 'LU', 'LUX', '1');
INSERT INTO `countries` VALUES ('125', 'Macau', 'MO', 'MAC', '1');
INSERT INTO `countries` VALUES ('126', 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', '1');
INSERT INTO `countries` VALUES ('127', 'Madagascar', 'MG', 'MDG', '1');
INSERT INTO `countries` VALUES ('128', 'Malawi', 'MW', 'MWI', '1');
INSERT INTO `countries` VALUES ('129', 'Malaysia', 'MY', 'MYS', '1');
INSERT INTO `countries` VALUES ('130', 'Maldives', 'MV', 'MDV', '1');
INSERT INTO `countries` VALUES ('131', 'Mali', 'ML', 'MLI', '1');
INSERT INTO `countries` VALUES ('132', 'Malta', 'MT', 'MLT', '1');
INSERT INTO `countries` VALUES ('133', 'Marshall Islands', 'MH', 'MHL', '1');
INSERT INTO `countries` VALUES ('134', 'Martinique', 'MQ', 'MTQ', '1');
INSERT INTO `countries` VALUES ('135', 'Mauritania', 'MR', 'MRT', '1');
INSERT INTO `countries` VALUES ('136', 'Mauritius', 'MU', 'MUS', '1');
INSERT INTO `countries` VALUES ('137', 'Mayotte', 'YT', 'MYT', '1');
INSERT INTO `countries` VALUES ('138', 'Mexico', 'MX', 'MEX', '1');
INSERT INTO `countries` VALUES ('139', 'Micronesia, Federated States of', 'FM', 'FSM', '1');
INSERT INTO `countries` VALUES ('140', 'Moldova, Republic of', 'MD', 'MDA', '1');
INSERT INTO `countries` VALUES ('141', 'Monaco', 'MC', 'MCO', '1');
INSERT INTO `countries` VALUES ('142', 'Mongolia', 'MN', 'MNG', '1');
INSERT INTO `countries` VALUES ('143', 'Montserrat', 'MS', 'MSR', '1');
INSERT INTO `countries` VALUES ('144', 'Morocco', 'MA', 'MAR', '1');
INSERT INTO `countries` VALUES ('145', 'Mozambique', 'MZ', 'MOZ', '1');
INSERT INTO `countries` VALUES ('146', 'Myanmar', 'MM', 'MMR', '1');
INSERT INTO `countries` VALUES ('147', 'Namibia', 'NA', 'NAM', '1');
INSERT INTO `countries` VALUES ('148', 'Nauru', 'NR', 'NRU', '1');
INSERT INTO `countries` VALUES ('149', 'Nepal', 'NP', 'NPL', '1');
INSERT INTO `countries` VALUES ('150', 'Netherlands', 'NL', 'NLD', '1');
INSERT INTO `countries` VALUES ('151', 'Netherlands Antilles', 'AN', 'ANT', '1');
INSERT INTO `countries` VALUES ('152', 'New Caledonia', 'NC', 'NCL', '1');
INSERT INTO `countries` VALUES ('153', 'New Zealand', 'NZ', 'NZL', '1');
INSERT INTO `countries` VALUES ('154', 'Nicaragua', 'NI', 'NIC', '1');
INSERT INTO `countries` VALUES ('155', 'Niger', 'NE', 'NER', '1');
INSERT INTO `countries` VALUES ('156', 'Nigeria', 'NG', 'NGA', '1');
INSERT INTO `countries` VALUES ('157', 'Niue', 'NU', 'NIU', '1');
INSERT INTO `countries` VALUES ('158', 'Norfolk Island', 'NF', 'NFK', '1');
INSERT INTO `countries` VALUES ('159', 'Northern Mariana Islands', 'MP', 'MNP', '1');
INSERT INTO `countries` VALUES ('160', 'Norway', 'NO', 'NOR', '1');
INSERT INTO `countries` VALUES ('161', 'Oman', 'OM', 'OMN', '1');
INSERT INTO `countries` VALUES ('162', 'Pakistan', 'PK', 'PAK', '1');
INSERT INTO `countries` VALUES ('163', 'Palau', 'PW', 'PLW', '1');
INSERT INTO `countries` VALUES ('164', 'Panama', 'PA', 'PAN', '1');
INSERT INTO `countries` VALUES ('165', 'Papua New Guinea', 'PG', 'PNG', '1');
INSERT INTO `countries` VALUES ('166', 'Paraguay', 'PY', 'PRY', '1');
INSERT INTO `countries` VALUES ('167', 'Peru', 'PE', 'PER', '1');
INSERT INTO `countries` VALUES ('168', 'Philippines', 'PH', 'PHL', '1');
INSERT INTO `countries` VALUES ('169', 'Pitcairn', 'PN', 'PCN', '1');
INSERT INTO `countries` VALUES ('170', 'Poland', 'PL', 'POL', '1');
INSERT INTO `countries` VALUES ('171', 'Portugal', 'PT', 'PRT', '1');
INSERT INTO `countries` VALUES ('172', 'Puerto Rico', 'PR', 'PRI', '1');
INSERT INTO `countries` VALUES ('173', 'Qatar', 'QA', 'QAT', '1');
INSERT INTO `countries` VALUES ('174', 'Reunion', 'RE', 'REU', '1');
INSERT INTO `countries` VALUES ('175', 'Romania', 'RO', 'ROM', '1');
INSERT INTO `countries` VALUES ('176', 'Russian Federation', 'RU', 'RUS', '1');
INSERT INTO `countries` VALUES ('177', 'Rwanda', 'RW', 'RWA', '1');
INSERT INTO `countries` VALUES ('178', 'Saint Kitts and Nevis', 'KN', 'KNA', '1');
INSERT INTO `countries` VALUES ('179', 'Saint Lucia', 'LC', 'LCA', '1');
INSERT INTO `countries` VALUES ('180', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1');
INSERT INTO `countries` VALUES ('181', 'Samoa', 'WS', 'WSM', '1');
INSERT INTO `countries` VALUES ('182', 'San Marino', 'SM', 'SMR', '1');
INSERT INTO `countries` VALUES ('183', 'Sao Tome and Principe', 'ST', 'STP', '1');
INSERT INTO `countries` VALUES ('184', 'Saudi Arabia', 'SA', 'SAU', '1');
INSERT INTO `countries` VALUES ('185', 'Senegal', 'SN', 'SEN', '1');
INSERT INTO `countries` VALUES ('186', 'Seychelles', 'SC', 'SYC', '1');
INSERT INTO `countries` VALUES ('187', 'Sierra Leone', 'SL', 'SLE', '1');
INSERT INTO `countries` VALUES ('188', 'Singapore', 'SG', 'SGP', '4');
INSERT INTO `countries` VALUES ('189', 'Slovakia (Slovak Republic)', 'SK', 'SVK', '1');
INSERT INTO `countries` VALUES ('190', 'Slovenia', 'SI', 'SVN', '1');
INSERT INTO `countries` VALUES ('191', 'Solomon Islands', 'SB', 'SLB', '1');
INSERT INTO `countries` VALUES ('192', 'Somalia', 'SO', 'SOM', '1');
INSERT INTO `countries` VALUES ('193', 'South Africa', 'ZA', 'ZAF', '1');
INSERT INTO `countries` VALUES ('194', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '1');
INSERT INTO `countries` VALUES ('195', 'Spain', 'ES', 'ESP', '3');
INSERT INTO `countries` VALUES ('196', 'Sri Lanka', 'LK', 'LKA', '1');
INSERT INTO `countries` VALUES ('197', 'St. Helena', 'SH', 'SHN', '1');
INSERT INTO `countries` VALUES ('198', 'St. Pierre and Miquelon', 'PM', 'SPM', '1');
INSERT INTO `countries` VALUES ('199', 'Sudan', 'SD', 'SDN', '1');
INSERT INTO `countries` VALUES ('200', 'Suriname', 'SR', 'SUR', '1');
INSERT INTO `countries` VALUES ('201', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '1');
INSERT INTO `countries` VALUES ('202', 'Swaziland', 'SZ', 'SWZ', '1');
INSERT INTO `countries` VALUES ('203', 'Sweden', 'SE', 'SWE', '1');
INSERT INTO `countries` VALUES ('204', 'Switzerland', 'CH', 'CHE', '1');
INSERT INTO `countries` VALUES ('205', 'Syrian Arab Republic', 'SY', 'SYR', '1');
INSERT INTO `countries` VALUES ('206', 'Taiwan', 'TW', 'TWN', '1');
INSERT INTO `countries` VALUES ('207', 'Tajikistan', 'TJ', 'TJK', '1');
INSERT INTO `countries` VALUES ('208', 'Tanzania, United Republic of', 'TZ', 'TZA', '1');
INSERT INTO `countries` VALUES ('209', 'Thailand', 'TH', 'THA', '1');
INSERT INTO `countries` VALUES ('210', 'Togo', 'TG', 'TGO', '1');
INSERT INTO `countries` VALUES ('211', 'Tokelau', 'TK', 'TKL', '1');
INSERT INTO `countries` VALUES ('212', 'Tonga', 'TO', 'TON', '1');
INSERT INTO `countries` VALUES ('213', 'Trinidad and Tobago', 'TT', 'TTO', '1');
INSERT INTO `countries` VALUES ('214', 'Tunisia', 'TN', 'TUN', '1');
INSERT INTO `countries` VALUES ('215', 'Turkey', 'TR', 'TUR', '1');
INSERT INTO `countries` VALUES ('216', 'Turkmenistan', 'TM', 'TKM', '1');
INSERT INTO `countries` VALUES ('217', 'Turks and Caicos Islands', 'TC', 'TCA', '1');
INSERT INTO `countries` VALUES ('218', 'Tuvalu', 'TV', 'TUV', '1');
INSERT INTO `countries` VALUES ('219', 'Uganda', 'UG', 'UGA', '1');
INSERT INTO `countries` VALUES ('220', 'Ukraine', 'UA', 'UKR', '1');
INSERT INTO `countries` VALUES ('221', 'United Arab Emirates', 'AE', 'ARE', '1');
INSERT INTO `countries` VALUES ('222', 'United Kingdom', 'GB', 'GBR', '1');
INSERT INTO `countries` VALUES ('223', 'United States', 'US', 'USA', '2');
INSERT INTO `countries` VALUES ('224', 'United States Minor Outlying Islands', 'UM', 'UMI', '1');
INSERT INTO `countries` VALUES ('225', 'Uruguay', 'UY', 'URY', '1');
INSERT INTO `countries` VALUES ('226', 'Uzbekistan', 'UZ', 'UZB', '1');
INSERT INTO `countries` VALUES ('227', 'Vanuatu', 'VU', 'VUT', '1');
INSERT INTO `countries` VALUES ('228', 'Vatican City State (Holy See)', 'VA', 'VAT', '1');
INSERT INTO `countries` VALUES ('229', 'Venezuela', 'VE', 'VEN', '1');
INSERT INTO `countries` VALUES ('230', 'Viet Nam', 'VN', 'VNM', '1');
INSERT INTO `countries` VALUES ('231', 'Virgin Islands (British)', 'VG', 'VGB', '1');
INSERT INTO `countries` VALUES ('232', 'Virgin Islands (U.S.)', 'VI', 'VIR', '1');
INSERT INTO `countries` VALUES ('233', 'Wallis and Futuna Islands', 'WF', 'WLF', '1');
INSERT INTO `countries` VALUES ('234', 'Western Sahara', 'EH', 'ESH', '1');
INSERT INTO `countries` VALUES ('235', 'Yemen', 'YE', 'YEM', '1');
INSERT INTO `countries` VALUES ('236', 'Yugoslavia', 'YU', 'YUG', '1');
INSERT INTO `countries` VALUES ('237', 'Zaire', 'ZR', 'ZAR', '1');
INSERT INTO `countries` VALUES ('238', 'Zambia', 'ZM', 'ZMB', '1');
INSERT INTO `countries` VALUES ('239', 'Zimbabwe', 'ZW', 'ZWE', '1');

-- ----------------------------
-- Table structure for `currencies`
-- ----------------------------
DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `currencies_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_point` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thousands_point` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_places` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` float(13,8) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`currencies_id`),
  KEY `idx_currencies_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of currencies
-- ----------------------------
INSERT INTO `currencies` VALUES ('1', 'U.S. Dollar', 'USD', '$', '', '.', ',', '2', '1.00000000', '2015-02-26 16:56:32');
INSERT INTO `currencies` VALUES ('2', 'Euro', 'EUR', '', '€', '.', ',', '2', '1.00000000', '2015-02-26 16:56:32');

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_location` int(11) NOT NULL,
  `customers_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `customers_dob` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customers_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_address` varchar(127) COLLATE utf8_unicode_ci NOT NULL,
  `customers_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customers_newsletter` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customers_id`),
  KEY `idx_customers_email_address` (`customers_email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', '3', '', 'test', 'test', 'test posting', '', '0000-00-00 00:00:00', 'test@test.com', '1', 'phnom penh', '0912 332', '', '$P$DHXuIqt1FraLmwA0.jDbRUQKNw69qs.', '1');
INSERT INTO `customers` VALUES ('2', '0', 'm', 'test', 'test', '', '', '2010-05-06 00:00:00', 'cvn@testw.adf', '2', '', '12512', 'test@test.com', '$P$DpiUh/.52rNO0l1mcIRJgTWMWkXjCp/', '');
INSERT INTO `customers` VALUES ('3', '0', 'm', 'GASG', 'sd gsgd', '', '', '1999-01-05 00:00:00', 'asg@gm.com', '3', '', '1241241 52 1255', '', '$P$DWCxvfMUNfRgLmjSP01fkWZIVEL.fB.', '');
-- ----------------------------
-- Table structure for `customers_basket`
-- ----------------------------
DROP TABLE IF EXISTS `customers_basket`;
CREATE TABLE `customers_basket` (
  `customers_basket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `customers_basket_quantity` int(2) NOT NULL,
  `final_price` decimal(15,4) DEFAULT NULL,
  `customers_basket_date_added` char(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customers_basket_id`),
  KEY `idx_customers_basket_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers_basket
-- ----------------------------

-- ----------------------------
-- Table structure for `customers_basket_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `customers_basket_attributes`;
CREATE TABLE `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `products_options_id` int(11) NOT NULL,
  `products_options_value_id` int(11) NOT NULL,
  PRIMARY KEY (`customers_basket_attributes_id`),
  KEY `idx_customers_basket_att_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers_basket_attributes
-- ----------------------------

-- ----------------------------
-- Table structure for `customers_braintree_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `customers_braintree_tokens`;
CREATE TABLE `customers_braintree_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `braintree_token` varchar(255) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  `number_filtered` varchar(20) NOT NULL,
  `expiry_date` char(6) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cbraintreet_customers_id` (`customers_id`),
  KEY `idx_cbraintreet_token` (`braintree_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers_braintree_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `customers_info`
-- ----------------------------
DROP TABLE IF EXISTS `customers_info`;
CREATE TABLE `customers_info` (
  `customers_info_id` int(11) NOT NULL,
  `customers_info_date_of_last_logon` datetime DEFAULT NULL,
  `customers_info_number_of_logons` int(5) DEFAULT NULL,
  `customers_info_date_account_created` datetime DEFAULT NULL,
  `customers_info_date_account_last_modified` datetime DEFAULT NULL,
  `global_product_notifications` int(1) DEFAULT '0',
  `password_reset_key` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_date` datetime DEFAULT NULL,
  PRIMARY KEY (`customers_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers_info
-- ----------------------------
INSERT INTO `customers_info` VALUES ('1', '2016-03-27 15:29:30', '55', '2015-02-27 12:38:45', '2016-01-14 14:27:05', '0', null, null);
INSERT INTO `customers_info` VALUES ('2', null, '0', '2015-09-30 16:39:51', null, '0', null, null);
INSERT INTO `customers_info` VALUES ('3', null, '0', '2015-11-12 19:26:58', '2015-11-12 19:33:11', '0', null, null);
INSERT INTO `customers_info` VALUES ('4', '2016-01-09 17:10:45', '2', '2016-01-09 17:06:43', null, '0', null, null);
INSERT INTO `customers_info` VALUES ('5', null, '0', '2016-01-10 14:46:31', '2016-01-10 14:52:53', '0', null, null);
INSERT INTO `customers_info` VALUES ('6', '2016-01-14 14:09:32', '1', '2016-01-14 13:07:07', null, '0', null, null);

-- ----------------------------
-- Table structure for `customers_sagepay_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `customers_sagepay_tokens`;
CREATE TABLE `customers_sagepay_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `sagepay_token` char(38) NOT NULL,
  `card_type` varchar(15) NOT NULL,
  `number_filtered` varchar(20) NOT NULL,
  `expiry_date` char(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_csagepayt_customers_id` (`customers_id`),
  KEY `idx_csagepayt_token` (`sagepay_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers_sagepay_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `customers_stripe_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `customers_stripe_tokens`;
CREATE TABLE `customers_stripe_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `stripe_token` varchar(255) NOT NULL,
  `card_type` varchar(32) NOT NULL,
  `number_filtered` varchar(20) NOT NULL,
  `expiry_date` char(6) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_cstripet_customers_id` (`customers_id`),
  KEY `idx_cstripet_token` (`stripe_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customers_stripe_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `geo_zones`
-- ----------------------------
DROP TABLE IF EXISTS `geo_zones`;
CREATE TABLE `geo_zones` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `geo_zone_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of geo_zones
-- ----------------------------
INSERT INTO `geo_zones` VALUES ('1', 'Florida', 'Florida local sales tax zone', null, '2015-02-26 16:56:42');

-- ----------------------------
-- Table structure for `image_slider`
-- ----------------------------
DROP TABLE IF EXISTS `image_slider`;
CREATE TABLE `image_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(220) NOT NULL,
  `image` varchar(220) NOT NULL,
  `image_thumbnail` varchar(127) NOT NULL,
  `link` varchar(220) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of image_slider
-- ----------------------------
INSERT INTO `image_slider` VALUES ('66', 'test', '2.1458881383.jpg', 'image-thumbnail/2.1458881383.jpg', '', '0', '2015-12-31 12:05:49', '1');
INSERT INTO `image_slider` VALUES ('76', 'ZXSD', 'business_card_08_1.1458881388.jpg', 'image-thumbnail/business_card_08_1.1458881388.jpg', '', '0', '2015-12-31 14:19:01', '3');
INSERT INTO `image_slider` VALUES ('79', 'ឋខ', '2.1458881362.jpg', 'image-thumbnail/2.1458881362.jpg', '', '0', '2015-12-31 14:20:02', '0');
INSERT INTO `image_slider` VALUES ('81', 'ស​ៗ\"', 'Clean+Corporate+Business+Card+Template.1458881368.jpg', 'image-thumbnail/Clean+Corporate+Business+Card+Template.1458881368.jpg', '', '0', '2015-12-31 14:20:44', '0');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `directory` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`languages_id`),
  KEY `IDX_LANGUAGES_NAME` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('1', 'English', 'en', 'icon.gif', 'english', '1');
INSERT INTO `languages` VALUES ('2', 'Khmer', 'kh', 'icon.gif', 'khmer', '0');

-- ----------------------------
-- Table structure for `location`
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(175) NOT NULL,
  `created` datetime NOT NULL,
  `modifies` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of location
-- ----------------------------
INSERT INTO `location` VALUES ('1', 'Phnom Penh', '2015-11-12 00:00:00', '2015-11-12 11:35:34');
INSERT INTO `location` VALUES ('2', 'Preah Sihanouk', '2015-11-12 00:00:00', '2015-11-12 11:37:31');
INSERT INTO `location` VALUES ('3', 'Kampong Cham', '2015-11-12 00:00:00', '2015-11-12 11:37:42');
INSERT INTO `location` VALUES ('4', 'Siem Reap', '2015-11-12 00:00:00', '2015-11-12 11:37:51');
INSERT INTO `location` VALUES ('5', 'Battambang', '2015-11-12 00:00:00', '2015-11-12 11:37:59');
INSERT INTO `location` VALUES ('6', 'Kandal', '2015-11-12 00:00:00', '2015-11-12 11:38:15');
INSERT INTO `location` VALUES ('7', 'Banteay Meanchey', '2015-11-12 00:00:00', '2015-11-12 11:38:17');
INSERT INTO `location` VALUES ('8', 'Bavet', '2015-11-12 00:00:00', '2015-11-12 11:38:28');
INSERT INTO `location` VALUES ('9', 'Kampong Chhnang', '2015-11-12 00:00:00', '2015-11-12 11:38:36');
INSERT INTO `location` VALUES ('10', 'Kampong Speu', '2015-11-12 00:00:00', '2015-11-12 11:38:44');
INSERT INTO `location` VALUES ('11', 'Kampong Thom', '2015-11-12 00:00:00', '2015-11-12 11:38:51');
INSERT INTO `location` VALUES ('12', 'Kampot', '2015-11-12 00:00:00', '2015-11-12 11:38:57');
INSERT INTO `location` VALUES ('13', 'Keb', '2015-11-12 00:00:00', '2015-11-12 11:39:05');
INSERT INTO `location` VALUES ('14', 'Koh Kong', '2015-11-12 00:00:00', '2015-11-12 11:39:11');
INSERT INTO `location` VALUES ('15', 'Kratie', '2015-11-12 00:00:00', '2015-11-12 11:39:17');
INSERT INTO `location` VALUES ('16', 'Mondulkiri', '2015-11-12 00:00:00', '2015-11-12 11:39:22');
INSERT INTO `location` VALUES ('17', 'Oddor Meanchey', '2015-11-12 00:00:00', '2015-11-12 11:39:28');
INSERT INTO `location` VALUES ('18', 'Pailin', '2015-11-12 00:00:00', '2015-11-12 11:39:36');
INSERT INTO `location` VALUES ('19', 'Poipet', '2015-11-12 00:00:00', '2015-11-12 11:39:51');
INSERT INTO `location` VALUES ('20', 'Preah Vihear', '2015-11-12 00:00:00', '2015-11-12 11:40:26');
INSERT INTO `location` VALUES ('21', 'Prey Veng', '2015-11-12 00:00:00', '2015-11-12 11:40:33');
INSERT INTO `location` VALUES ('22', 'Pursat', '2015-11-12 00:00:00', '2015-11-12 11:40:40');
INSERT INTO `location` VALUES ('23', 'Rattanakiri', '2015-11-12 00:00:00', '2015-11-12 11:40:48');
INSERT INTO `location` VALUES ('24', 'Stung Treng', '2015-11-12 00:00:00', '2015-11-12 11:40:56');
INSERT INTO `location` VALUES ('25', 'Svay Rieng', '2015-11-12 00:00:00', '2015-11-12 11:41:02');
INSERT INTO `location` VALUES ('26', 'Takeo', '2015-11-12 00:00:00', '2015-11-12 11:41:13');

-- ----------------------------
-- Table structure for `manufacturers`
-- ----------------------------
DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturers_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturers_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manufacturers
-- ----------------------------
INSERT INTO `manufacturers` VALUES ('3', 'buy', 'manufacturer_warner.gif', '2015-02-26 16:56:32', '2015-11-12 12:10:22');
INSERT INTO `manufacturers` VALUES ('7', 'other', 'manufacturer_sierra.gif', '2015-02-26 16:56:32', '2015-11-12 12:10:36');
INSERT INTO `manufacturers` VALUES ('10', 'sale', 'manufacturer_samsung.png', '2015-02-26 16:56:33', '2015-11-12 12:10:15');

-- ----------------------------
-- Table structure for `manufacturers_info`
-- ----------------------------
DROP TABLE IF EXISTS `manufacturers_info`;
CREATE TABLE `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `manufacturers_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT '0',
  `date_last_click` datetime DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of manufacturers_info
-- ----------------------------
INSERT INTO `manufacturers_info` VALUES ('3', '1', 'http://www.warner.com', '0', null);
INSERT INTO `manufacturers_info` VALUES ('3', '2', 'http://www.warner.com', '0', null);
INSERT INTO `manufacturers_info` VALUES ('7', '1', 'http://www.sierra.com', '0', null);
INSERT INTO `manufacturers_info` VALUES ('7', '2', 'http://www.sierra.com', '0', null);
INSERT INTO `manufacturers_info` VALUES ('10', '1', 'http://www.samsung.com', '1', '2016-01-06 11:50:50');
INSERT INTO `manufacturers_info` VALUES ('10', '2', 'http://www.samsung.com', '0', null);

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `month_date` varchar(20) NOT NULL DEFAULT '',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `replys` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('1', 'January 2007', '2007-01-01 15:48:04', '0');

-- ----------------------------
-- Table structure for `newsletters`
-- ----------------------------
DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `newsletters_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `locked` int(1) DEFAULT '0',
  PRIMARY KEY (`newsletters_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of newsletters
-- ----------------------------
INSERT INTO `newsletters` VALUES ('1', 'AS', '2tgZX G', 'newsletter', '2015-11-03 11:33:02', null, '0', '0');

-- ----------------------------
-- Table structure for `news_description`
-- ----------------------------
DROP TABLE IF EXISTS `news_description`;
CREATE TABLE `news_description` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `news_id` int(12) NOT NULL DEFAULT '0',
  `language_id` int(1) NOT NULL DEFAULT '1',
  `name` varchar(64) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_description
-- ----------------------------
INSERT INTO `news_description` VALUES ('1', '1', '1', 'test 1', 'test 1');
INSERT INTO `news_description` VALUES ('2', '1', '2', 'test 2', 'test 2');
INSERT INTO `news_description` VALUES ('3', '1', '3', 'test 3', 'test 3');

-- ----------------------------
-- Table structure for `news_replys`
-- ----------------------------
DROP TABLE IF EXISTS `news_replys`;
CREATE TABLE `news_replys` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `news_id` int(12) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(64) DEFAULT 'username',
  `email` varchar(64) DEFAULT 'email',
  `content` text NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `approved` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_replys
-- ----------------------------

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_address_format_id` int(5) NOT NULL,
  `delivery_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_address_format_id` int(5) NOT NULL,
  `billing_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address_format_id` int(5) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_expires` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `orders_status` int(5) NOT NULL,
  `orders_date_finished` datetime DEFAULT NULL,
  `currency` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  KEY `idx_orders_customers_id` (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Cash on Delivery', '', '', '', '', null, '2015-02-27 12:41:50', '1', null, 'USD', '1.000000');
INSERT INTO `orders` VALUES ('2', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Cash on Delivery', '', '', '', '', null, '2015-03-21 15:07:01', '1', null, 'USD', '1.000000');
INSERT INTO `orders` VALUES ('3', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Cash on Delivery', '', '', '', '', null, '2015-03-23 10:46:07', '1', null, 'USD', '1.000000');
INSERT INTO `orders` VALUES ('4', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Cash on Delivery', '', '', '', '', null, '2015-05-18 16:19:29', '1', null, 'USD', '1.000000');
INSERT INTO `orders` VALUES ('5', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Credit or Debit Card (paypal_pro_dp; Sandbox)', '', '', '', '', null, '2015-05-28 17:29:43', '1', null, 'USD', '1.000000');
INSERT INTO `orders` VALUES ('6', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1234124', 'test@test.com', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'test test', 'test', 'test test', 'test', 'test', '12345', 'test', 'Aruba', '1', 'Cash on Delivery', '', '', '', '', '2015-10-27 11:09:51', '2015-10-27 11:07:16', '3', null, 'USD', '1.000000');

-- ----------------------------
-- Table structure for `orders_products`
-- ----------------------------
DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE `orders_products` (
  `orders_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_model` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `final_price` decimal(15,4) NOT NULL,
  `products_tax` decimal(7,4) NOT NULL,
  `products_quantity` int(2) NOT NULL,
  PRIMARY KEY (`orders_products_id`),
  KEY `idx_orders_products_orders_id` (`orders_id`),
  KEY `idx_orders_products_products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_products
-- ----------------------------
INSERT INTO `orders_products` VALUES ('1', '1', '25', 'MSINTKB', 'Microsoft Internet Keyboard PS/2', '69.9900', '69.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('2', '1', '28', 'GT-P1000', 'Samsung Galaxy Tab', '749.9900', '749.9900', '0.0000', '4');
INSERT INTO `orders_products` VALUES ('3', '1', '26', 'MSIMEXP', 'Microsoft IntelliMouse Explorer', '64.9500', '70.9500', '0.0000', '5');
INSERT INTO `orders_products` VALUES ('4', '2', '28', 'GT-P1000', 'Samsung Galaxy Tab', '749.9900', '749.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('5', '2', '19', 'DVD-TSAB', 'There\'s Something About Mary', '49.9900', '49.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('6', '2', '21', 'PC-SWAT3', 'SWAT 3: Close Quarters Battle', '79.9900', '79.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('7', '2', '23', 'PC-TWOF', 'The Wheel Of Time', '20.0000', '20.0000', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('8', '3', '23', 'PC-TWOF', 'The Wheel Of Time', '20.0000', '20.0000', '0.0000', '22');
INSERT INTO `orders_products` VALUES ('9', '4', '23', 'PC-TWOF', 'The Wheel Of Time', '20.0000', '20.0000', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('10', '4', '28', 'GT-P1000', 'Samsung Galaxy Tab', '749.9900', '749.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('11', '4', '19', 'DVD-TSAB', 'There\'s Something About Mary', '49.9900', '49.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('12', '4', '22', 'PC-UNTM', 'Unreal Tournament', '89.9900', '89.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('13', '5', '28', 'GT-P1000', 'Samsung Galaxy Tab', '749.9900', '749.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('14', '5', '8', 'DVD-ABUG', 'A Bug\'s Life', '35.9900', '35.9900', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('15', '6', '14', 'DVD-REDC', 'Red Cornersg asdg awr', '32.0000', '32.0000', '0.0000', '1');
INSERT INTO `orders_products` VALUES ('16', '6', '25', 'MSINTKB', 'Microsoft Internet Keyboard PS/2 sadg asdga d', '69.9900', '69.9900', '0.0000', '15');

-- ----------------------------
-- Table structure for `orders_products_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `orders_products_attributes`;
CREATE TABLE `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_products_id` int(11) NOT NULL,
  `products_options` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `products_options_values` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`orders_products_attributes_id`),
  KEY `idx_orders_products_att_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_products_attributes
-- ----------------------------
INSERT INTO `orders_products_attributes` VALUES ('1', '1', '3', 'Model', 'USB', '6.0000', '+');
INSERT INTO `orders_products_attributes` VALUES ('2', '4', '12', 'Version', 'Download: Windows - English', '0.0000', '+');

-- ----------------------------
-- Table structure for `orders_products_download`
-- ----------------------------
DROP TABLE IF EXISTS `orders_products_download`;
CREATE TABLE `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `download_maxdays` int(2) NOT NULL DEFAULT '0',
  `download_count` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orders_products_download_id`),
  KEY `idx_orders_products_download_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_products_download
-- ----------------------------

-- ----------------------------
-- Table structure for `orders_status`
-- ----------------------------
DROP TABLE IF EXISTS `orders_status`;
CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `public_flag` int(11) DEFAULT '1',
  `downloads_flag` int(11) DEFAULT '0',
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_status
-- ----------------------------
INSERT INTO `orders_status` VALUES ('1', '1', 'Pending', '1', '0');
INSERT INTO `orders_status` VALUES ('1', '2', 'Pending', '1', '0');
INSERT INTO `orders_status` VALUES ('2', '1', 'Processing', '1', '1');
INSERT INTO `orders_status` VALUES ('2', '2', 'Processing', '1', '0');
INSERT INTO `orders_status` VALUES ('3', '1', 'Delivered', '1', '1');
INSERT INTO `orders_status` VALUES ('3', '2', 'Delivered', '1', '0');
INSERT INTO `orders_status` VALUES ('4', '1', 'PayPal [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('4', '2', 'PayPal [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('5', '1', 'Authorize.net [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('5', '2', 'Authorize.net [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('6', '1', 'Braintree [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('6', '2', 'Braintree [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('10', '1', 'Sage Pay [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('10', '2', 'Sage Pay [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('11', '1', 'Sofort', '0', '0');
INSERT INTO `orders_status` VALUES ('11', '2', 'Sofort', '1', '0');
INSERT INTO `orders_status` VALUES ('12', '1', 'Preparing [WorldPay]', '0', '0');
INSERT INTO `orders_status` VALUES ('12', '2', 'Preparing [WorldPay]', '1', '0');
INSERT INTO `orders_status` VALUES ('13', '1', 'WorldPay [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('13', '2', 'WorldPay [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('14', '1', 'Stripe [Transactions]', '0', '0');
INSERT INTO `orders_status` VALUES ('14', '2', 'Stripe [Transactions]', '1', '0');
INSERT INTO `orders_status` VALUES ('18', '1', 'Preparing [ChronoPay]', '0', '0');
INSERT INTO `orders_status` VALUES ('18', '2', 'Preparing [ChronoPay]', '1', '0');

-- ----------------------------
-- Table structure for `orders_status_history`
-- ----------------------------
DROP TABLE IF EXISTS `orders_status_history`;
CREATE TABLE `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_status_id` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `customer_notified` int(1) DEFAULT '0',
  `comments` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_status_history_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_status_history
-- ----------------------------
INSERT INTO `orders_status_history` VALUES ('1', '1', '1', '2015-02-27 12:41:50', '1', 'test');
INSERT INTO `orders_status_history` VALUES ('2', '2', '1', '2015-03-21 15:07:01', '1', '');
INSERT INTO `orders_status_history` VALUES ('3', '3', '1', '2015-03-23 10:46:08', '1', '');
INSERT INTO `orders_status_history` VALUES ('4', '4', '1', '2015-05-18 16:19:29', '1', '');
INSERT INTO `orders_status_history` VALUES ('5', '5', '1', '2015-05-28 17:29:43', '1', '');
INSERT INTO `orders_status_history` VALUES ('6', '5', '4', '2015-05-28 17:29:48', '0', 'Transaction ID: 17494740XB527540D\nAVS Code: X\nCVV2 Match: M');
INSERT INTO `orders_status_history` VALUES ('7', '6', '1', '2015-10-27 11:07:17', '1', '');
INSERT INTO `orders_status_history` VALUES ('8', '6', '5', '2015-10-27 11:08:45', '1', '');
INSERT INTO `orders_status_history` VALUES ('9', '6', '3', '2015-10-27 11:09:56', '1', '');

-- ----------------------------
-- Table structure for `orders_total`
-- ----------------------------
DROP TABLE IF EXISTS `orders_total`;
CREATE TABLE `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(15,4) NOT NULL,
  `class` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`orders_total_id`),
  KEY `idx_orders_total_orders_id` (`orders_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders_total
-- ----------------------------
INSERT INTO `orders_total` VALUES ('1', '1', 'Sub-Total:', '$3,424.70', '3424.7000', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('2', '1', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('3', '1', 'Total:', '<strong>$3,429.70</strong>', '3429.7000', 'ot_total', '4');
INSERT INTO `orders_total` VALUES ('4', '2', 'Sub-Total:', '$899.97', '899.9700', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('5', '2', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('6', '2', 'Total:', '<strong>$904.97</strong>', '904.9700', 'ot_total', '4');
INSERT INTO `orders_total` VALUES ('7', '3', 'Sub-Total:', '$440.00', '440.0000', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('8', '3', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('9', '3', 'Total:', '<strong>$445.00</strong>', '445.0000', 'ot_total', '4');
INSERT INTO `orders_total` VALUES ('10', '4', 'Sub-Total:', '$909.97', '909.9700', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('11', '4', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('12', '4', 'Total:', '<strong>$914.97</strong>', '914.9700', 'ot_total', '4');
INSERT INTO `orders_total` VALUES ('13', '5', 'Sub-Total:', '$785.98', '785.9800', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('14', '5', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('15', '5', 'Total:', '<strong>$790.98</strong>', '790.9800', 'ot_total', '4');
INSERT INTO `orders_total` VALUES ('16', '6', 'Sub-Total:', '$1,081.85', '1081.8500', 'ot_subtotal', '1');
INSERT INTO `orders_total` VALUES ('17', '6', 'Flat Rate ():', '$5.00', '5.0000', 'ot_shipping', '2');
INSERT INTO `orders_total` VALUES ('18', '6', 'Total:', '<strong>$1,086.85</strong>', '1086.8500', 'ot_total', '4');

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `products_quantity` int(4) NOT NULL,
  `products_model` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_image` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_image_thumbnail` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_date_added` datetime NOT NULL,
  `products_last_modified` datetime DEFAULT NULL,
  `products_date_available` datetime DEFAULT NULL,
  `products_weight` decimal(5,2) NOT NULL,
  `products_status` tinyint(1) NOT NULL,
  `products_tax_class_id` int(11) NOT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `products_ordered` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`products_id`),
  KEY `idx_products_model` (`products_model`),
  KEY `idx_products_date_added` (`products_date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `products_attributes`
-- ----------------------------
DROP TABLE IF EXISTS `products_attributes`;
CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL,
  `options_values_id` int(11) NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`products_attributes_id`),
  KEY `idx_products_attributes_products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_attributes
-- ----------------------------

-- ----------------------------
-- Table structure for `products_attributes_download`
-- ----------------------------
DROP TABLE IF EXISTS `products_attributes_download`;
CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL,
  `products_attributes_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `products_attributes_maxdays` int(2) DEFAULT '0',
  `products_attributes_maxcount` int(2) DEFAULT '0',
  PRIMARY KEY (`products_attributes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_attributes_download
-- ----------------------------
INSERT INTO `products_attributes_download` VALUES ('26', 'unreal.zip', '7', '3');

-- ----------------------------
-- Table structure for `products_description`
-- ----------------------------
DROP TABLE IF EXISTS `products_description`;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_name` varchar(127) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `products_description` text COLLATE utf8_unicode_ci,
  `products_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_viewed` int(5) DEFAULT '0',
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_description
-- ----------------------------

-- ----------------------------
-- Table structure for `products_images`
-- ----------------------------
DROP TABLE IF EXISTS `products_images`;
CREATE TABLE `products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `image` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_thumbnail` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `htmlcontent` text COLLATE utf8_unicode_ci,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_images_prodid` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_images
-- ----------------------------

-- ----------------------------
-- Table structure for `products_notifications`
-- ----------------------------
DROP TABLE IF EXISTS `products_notifications`;
CREATE TABLE `products_notifications` (
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`products_id`,`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for `products_options`
-- ----------------------------
DROP TABLE IF EXISTS `products_options`;
CREATE TABLE `products_options` (
  `products_options_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_options
-- ----------------------------
INSERT INTO `products_options` VALUES ('1', '1', 'Color');
INSERT INTO `products_options` VALUES ('1', '2', 'Color');
INSERT INTO `products_options` VALUES ('2', '1', 'Size');
INSERT INTO `products_options` VALUES ('2', '2', 'Size');
INSERT INTO `products_options` VALUES ('3', '1', 'Model');
INSERT INTO `products_options` VALUES ('3', '2', 'Model');
INSERT INTO `products_options` VALUES ('4', '1', 'Memory');
INSERT INTO `products_options` VALUES ('4', '2', 'Memory');
INSERT INTO `products_options` VALUES ('5', '1', 'Version');
INSERT INTO `products_options` VALUES ('5', '2', 'Version');

-- ----------------------------
-- Table structure for `products_options_values`
-- ----------------------------
DROP TABLE IF EXISTS `products_options_values`;
CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_values_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_values_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_options_values
-- ----------------------------
INSERT INTO `products_options_values` VALUES ('1', '1', '4 mb');
INSERT INTO `products_options_values` VALUES ('1', '2', '4 mb');
INSERT INTO `products_options_values` VALUES ('2', '1', '8 mb');
INSERT INTO `products_options_values` VALUES ('2', '2', '8 mb');
INSERT INTO `products_options_values` VALUES ('3', '1', '16 mb');
INSERT INTO `products_options_values` VALUES ('3', '2', '16 mb');
INSERT INTO `products_options_values` VALUES ('4', '1', '32 mb');
INSERT INTO `products_options_values` VALUES ('4', '2', '32 mb');
INSERT INTO `products_options_values` VALUES ('5', '1', 'Value');
INSERT INTO `products_options_values` VALUES ('5', '2', 'Value');
INSERT INTO `products_options_values` VALUES ('6', '1', 'Premium');
INSERT INTO `products_options_values` VALUES ('6', '2', 'Premium');
INSERT INTO `products_options_values` VALUES ('7', '1', 'Deluxe');
INSERT INTO `products_options_values` VALUES ('7', '2', 'Deluxe');
INSERT INTO `products_options_values` VALUES ('8', '1', 'PS/2');
INSERT INTO `products_options_values` VALUES ('8', '2', 'PS/2');
INSERT INTO `products_options_values` VALUES ('9', '1', 'USB');
INSERT INTO `products_options_values` VALUES ('9', '2', 'USB');
INSERT INTO `products_options_values` VALUES ('10', '1', 'Download: Windows - English');
INSERT INTO `products_options_values` VALUES ('10', '2', 'Download: Windows - English');
INSERT INTO `products_options_values` VALUES ('13', '1', 'Box: Windows - English');
INSERT INTO `products_options_values` VALUES ('13', '2', 'Box: Windows - English');
INSERT INTO `products_options_values` VALUES ('14', '1', 'blue');
INSERT INTO `products_options_values` VALUES ('14', '2', 'blue');

-- ----------------------------
-- Table structure for `products_options_values_to_products_options`
-- ----------------------------
DROP TABLE IF EXISTS `products_options_values_to_products_options`;
CREATE TABLE `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_options_id` int(11) NOT NULL,
  `products_options_values_id` int(11) NOT NULL,
  PRIMARY KEY (`products_options_values_to_products_options_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_options_values_to_products_options
-- ----------------------------
INSERT INTO `products_options_values_to_products_options` VALUES ('1', '4', '1');
INSERT INTO `products_options_values_to_products_options` VALUES ('2', '4', '2');
INSERT INTO `products_options_values_to_products_options` VALUES ('3', '4', '3');
INSERT INTO `products_options_values_to_products_options` VALUES ('4', '4', '4');
INSERT INTO `products_options_values_to_products_options` VALUES ('5', '3', '5');
INSERT INTO `products_options_values_to_products_options` VALUES ('6', '3', '6');
INSERT INTO `products_options_values_to_products_options` VALUES ('7', '3', '7');
INSERT INTO `products_options_values_to_products_options` VALUES ('8', '3', '8');
INSERT INTO `products_options_values_to_products_options` VALUES ('9', '3', '9');
INSERT INTO `products_options_values_to_products_options` VALUES ('10', '5', '10');
INSERT INTO `products_options_values_to_products_options` VALUES ('13', '5', '13');
INSERT INTO `products_options_values_to_products_options` VALUES ('14', '1', '14');

-- ----------------------------
-- Table structure for `products_to_categories`
-- ----------------------------
DROP TABLE IF EXISTS `products_to_categories`;
CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`products_id`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products_to_categories
-- ----------------------------

-- ----------------------------
-- Table structure for `product_contact_person`
-- ----------------------------
DROP TABLE IF EXISTS `product_contact_person`;
CREATE TABLE `product_contact_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `contact_name` varchar(127) NOT NULL,
  `contact_phone` varchar(127) NOT NULL,
  `contact_address` varchar(127) NOT NULL,
  `contact_location` int(11) NOT NULL,
  `contact_email` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_contact_person
-- ----------------------------
INSERT INTO `product_contact_person` VALUES ('48', '1', '105', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('49', '1', '106', 'Mr. Lonely', '012212121', 'phnom penh 123', '1', 'test123@test.com');
INSERT INTO `product_contact_person` VALUES ('50', '1', '107', 'test @@2', '444444444444', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('51', '1', '108', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('52', '1', '109', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('53', '1', '110', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('54', '1', '111', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('55', '1', '112', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('56', '1', '113', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('57', '1', '114', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('58', '1', '115', 'test posting', '1234124', 'phnom penh', '5', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('59', '1', '116', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('60', '1', '117', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('61', '1', '118', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('62', '1', '119', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('63', '1', '120', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('64', '1', '121', 'test ags', '2235325', 'phnom as', '3', 'test@test.sag');
INSERT INTO `product_contact_person` VALUES ('65', '1', '122', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('66', '1', '123', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('68', '1', '125', 'test posting', 'GGGGSDGG', 'phnom penh', '3', 'test@test.com');
INSERT INTO `product_contact_person` VALUES ('73', '6', '130', 'gooo', '545474534346346', 'G SD SDFH EJDFJ', '1', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('74', '6', '131', 'gooo', '3125235', 'sf ssd as', '1', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('75', '6', '132', 'gooo dfsg', '012546541', 'phnom penh', '1', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('76', '6', '133', 'gooo', '2352346346346', '', '0', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('77', '6', '134', 'gooo', '325234634772', 'wea sdag .\nsadh asdh\nw4y', '1', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('78', '6', '135', 'gooo', '235235235', 'sdf asd a24ty234ty42', '1', 'goo@gmail.com');
INSERT INTO `product_contact_person` VALUES ('80', '1', '137', 'test posting', '0912 332', 'phnom penh', '3', 'test@test.com');

-- ----------------------------
-- Table structure for `reviews`
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `customers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reviews_rating` int(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `reviews_status` tinyint(1) NOT NULL DEFAULT '0',
  `reviews_read` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviews_id`),
  KEY `idx_reviews_products_id` (`products_id`),
  KEY `idx_reviews_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reviews
-- ----------------------------

-- ----------------------------
-- Table structure for `reviews_description`
-- ----------------------------
DROP TABLE IF EXISTS `reviews_description`;
CREATE TABLE `reviews_description` (
  `reviews_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `reviews_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`reviews_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of reviews_description
-- ----------------------------

-- ----------------------------
-- Table structure for `sagepay_server_securitykeys`
-- ----------------------------
DROP TABLE IF EXISTS `sagepay_server_securitykeys`;
CREATE TABLE `sagepay_server_securitykeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(16) NOT NULL,
  `securitykey` char(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `verified` char(1) DEFAULT '0',
  `transaction_details` text,
  PRIMARY KEY (`id`),
  KEY `idx_sagepay_server_securitykeys_code` (`code`),
  KEY `idx_sagepay_server_securitykeys_securitykey` (`securitykey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sagepay_server_securitykeys
-- ----------------------------

-- ----------------------------
-- Table structure for `sec_directory_whitelist`
-- ----------------------------
DROP TABLE IF EXISTS `sec_directory_whitelist`;
CREATE TABLE `sec_directory_whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sec_directory_whitelist
-- ----------------------------
INSERT INTO `sec_directory_whitelist` VALUES ('1', 'admin/backups');
INSERT INTO `sec_directory_whitelist` VALUES ('2', 'admin/images/graphs');
INSERT INTO `sec_directory_whitelist` VALUES ('3', 'images');
INSERT INTO `sec_directory_whitelist` VALUES ('4', 'images/banners');
INSERT INTO `sec_directory_whitelist` VALUES ('5', 'images/dvd');
INSERT INTO `sec_directory_whitelist` VALUES ('6', 'images/gt_interactive');
INSERT INTO `sec_directory_whitelist` VALUES ('7', 'images/hewlett_packard');
INSERT INTO `sec_directory_whitelist` VALUES ('8', 'images/matrox');
INSERT INTO `sec_directory_whitelist` VALUES ('9', 'images/microsoft');
INSERT INTO `sec_directory_whitelist` VALUES ('10', 'images/samsung');
INSERT INTO `sec_directory_whitelist` VALUES ('11', 'images/sierra');
INSERT INTO `sec_directory_whitelist` VALUES ('12', 'includes/work');
INSERT INTO `sec_directory_whitelist` VALUES ('13', 'pub');

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `sesskey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('05ffgrtfrvg01g9rjuavtmef46', '1459350311', 'language|s:7:\"english\";languages_id|s:1:\"1\";auth_ignore|b:1;admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";}');
INSERT INTO `sessions` VALUES ('0qpsq9qhs1kds18eoa4jq90dm2', '1462593584', 'language|s:7:\"english\";languages_id|s:1:\"1\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";}');
INSERT INTO `sessions` VALUES ('39ed7ssc7leou1a85sm6meilh4', '1463302316', 'sessiontoken|s:32:\"28b0724c4baab24d700bfadb015ee119\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:8:\"ndex.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('3cf4mossip4lgil6v4r8qhkm41', '1462603800', 'sessiontoken|s:32:\"29fb4cf83b5fcd075c775b03a4585e87\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:11:\"products_id\";s:3:\"137\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('3fvpb6l9hmc3tg80gpr3778sc1', '1461403211', 'sessiontoken|s:32:\"02c6be224b812fdabe93575d38fbff8c\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:2:\"25\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"login.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}');
INSERT INTO `sessions` VALUES ('47n3629ck3aa8c8j9an7tvb913', '1461597654', 'sessiontoken|s:32:\"cf7c7a705285614431c7002ea16d6cbf\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:9:\"login.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:18:\"create_account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:11:\"account.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}');
INSERT INTO `sessions` VALUES ('6tt0umbok4q0c7723ukq9bp855', '1462603840', 'sessiontoken|s:32:\"4e3ba7f588420014f60c80f54a1b8de4\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:4:\".php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:2:\"25\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('at7po910525o2asd1e5bl2ph66', '1462799981', 'sessiontoken|s:32:\"5fc93d1d2716394cf288e172c98e6a6d\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('d8odo2rotrujg9hfmnek00nbt6', '1463199988', 'sessiontoken|s:32:\"28f30e81b6bc4d85357517dbca4fa108\";cart|O:12:\"shoppingCart\":4:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('j6a8js2fup18mdmogddk8cbmh1', '1463302609', 'language|s:7:\"english\";languages_id|s:1:\"1\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";}');
INSERT INTO `sessions` VALUES ('m49kqau04querlde3bu63n1t77', '1462803559', 'language|s:7:\"english\";languages_id|s:1:\"1\";admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";}');
INSERT INTO `sessions` VALUES ('rrrrlks5oblat20s590g8e15d1', '1462786945', 'sessiontoken|s:32:\"04639583d136d1ea2494f6f748ec96b4\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:2:\"23\";s:6:\"osCsid\";s:26:\"rrrrlks5oblat20s590g8e15d1\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
INSERT INTO `sessions` VALUES ('vvor952on7q584i0odca296hk1', '1463199988', 'sessiontoken|s:32:\"494328cc869da314a3ab300f0a206107\";cart|O:12:\"shoppingCart\":4:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;}language|s:7:\"english\";languages_id|s:1:\"1\";currency|s:3:\"USD\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:10:\"/index.php\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');

-- ----------------------------
-- Table structure for `specials`
-- ----------------------------
DROP TABLE IF EXISTS `specials`;
CREATE TABLE `specials` (
  `specials_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `specials_new_products_price` decimal(15,4) NOT NULL,
  `specials_date_added` datetime DEFAULT NULL,
  `specials_last_modified` datetime DEFAULT NULL,
  `expires_date` datetime DEFAULT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`specials_id`),
  KEY `idx_specials_products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of specials
-- ----------------------------

-- ----------------------------
-- Table structure for `tax_class`
-- ----------------------------
DROP TABLE IF EXISTS `tax_class`;
CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `tax_class_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tax_class
-- ----------------------------
INSERT INTO `tax_class` VALUES ('1', 'Taxable Goods', 'The following types of products are included non-food, services, etc', '2015-02-26 16:56:42', '2015-02-26 16:56:42');

-- ----------------------------
-- Table structure for `tax_rates`
-- ----------------------------
DROP TABLE IF EXISTS `tax_rates`;
CREATE TABLE `tax_rates` (
  `tax_rates_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_zone_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_priority` int(5) DEFAULT '1',
  `tax_rate` decimal(7,4) NOT NULL,
  `tax_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_rates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tax_rates
-- ----------------------------
INSERT INTO `tax_rates` VALUES ('1', '1', '1', '1', '7.0000', 'FL TAX 7.0%', '2015-02-26 16:56:42', '2015-02-26 16:56:42');

-- ----------------------------
-- Table structure for `whos_online`
-- ----------------------------
DROP TABLE IF EXISTS `whos_online`;
CREATE TABLE `whos_online` (
  `customer_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `time_entry` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `time_last_click` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `last_page_url` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `idx_whos_online_session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of whos_online
-- ----------------------------
INSERT INTO `whos_online` VALUES ('0', 'Guest', '39ed7ssc7leou1a85sm6meilh4', '', '1463300380', '1463302316', '/realEstate/index.php');

-- ----------------------------
-- Table structure for `zones`
-- ----------------------------
DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `zone_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `idx_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of zones
-- ----------------------------
INSERT INTO `zones` VALUES ('1', '223', 'AL', 'Alabama');
INSERT INTO `zones` VALUES ('2', '223', 'AK', 'Alaska');
INSERT INTO `zones` VALUES ('3', '223', 'AS', 'American Samoa');
INSERT INTO `zones` VALUES ('4', '223', 'AZ', 'Arizona');
INSERT INTO `zones` VALUES ('5', '223', 'AR', 'Arkansas');
INSERT INTO `zones` VALUES ('6', '223', 'AF', 'Armed Forces Africa');
INSERT INTO `zones` VALUES ('7', '223', 'AA', 'Armed Forces Americas');
INSERT INTO `zones` VALUES ('8', '223', 'AC', 'Armed Forces Canada');
INSERT INTO `zones` VALUES ('9', '223', 'AE', 'Armed Forces Europe');
INSERT INTO `zones` VALUES ('10', '223', 'AM', 'Armed Forces Middle East');
INSERT INTO `zones` VALUES ('11', '223', 'AP', 'Armed Forces Pacific');
INSERT INTO `zones` VALUES ('12', '223', 'CA', 'California');
INSERT INTO `zones` VALUES ('13', '223', 'CO', 'Colorado');
INSERT INTO `zones` VALUES ('14', '223', 'CT', 'Connecticut');
INSERT INTO `zones` VALUES ('15', '223', 'DE', 'Delaware');
INSERT INTO `zones` VALUES ('16', '223', 'DC', 'District of Columbia');
INSERT INTO `zones` VALUES ('17', '223', 'FM', 'Federated States Of Micronesia');
INSERT INTO `zones` VALUES ('18', '223', 'FL', 'Florida');
INSERT INTO `zones` VALUES ('19', '223', 'GA', 'Georgia');
INSERT INTO `zones` VALUES ('20', '223', 'GU', 'Guam');
INSERT INTO `zones` VALUES ('21', '223', 'HI', 'Hawaii');
INSERT INTO `zones` VALUES ('22', '223', 'ID', 'Idaho');
INSERT INTO `zones` VALUES ('23', '223', 'IL', 'Illinois');
INSERT INTO `zones` VALUES ('24', '223', 'IN', 'Indiana');
INSERT INTO `zones` VALUES ('25', '223', 'IA', 'Iowa');
INSERT INTO `zones` VALUES ('26', '223', 'KS', 'Kansas');
INSERT INTO `zones` VALUES ('27', '223', 'KY', 'Kentucky');
INSERT INTO `zones` VALUES ('28', '223', 'LA', 'Louisiana');
INSERT INTO `zones` VALUES ('29', '223', 'ME', 'Maine');
INSERT INTO `zones` VALUES ('30', '223', 'MH', 'Marshall Islands');
INSERT INTO `zones` VALUES ('31', '223', 'MD', 'Maryland');
INSERT INTO `zones` VALUES ('32', '223', 'MA', 'Massachusetts');
INSERT INTO `zones` VALUES ('33', '223', 'MI', 'Michigan');
INSERT INTO `zones` VALUES ('34', '223', 'MN', 'Minnesota');
INSERT INTO `zones` VALUES ('35', '223', 'MS', 'Mississippi');
INSERT INTO `zones` VALUES ('36', '223', 'MO', 'Missouri');
INSERT INTO `zones` VALUES ('37', '223', 'MT', 'Montana');
INSERT INTO `zones` VALUES ('38', '223', 'NE', 'Nebraska');
INSERT INTO `zones` VALUES ('39', '223', 'NV', 'Nevada');
INSERT INTO `zones` VALUES ('40', '223', 'NH', 'New Hampshire');
INSERT INTO `zones` VALUES ('41', '223', 'NJ', 'New Jersey');
INSERT INTO `zones` VALUES ('42', '223', 'NM', 'New Mexico');
INSERT INTO `zones` VALUES ('43', '223', 'NY', 'New York');
INSERT INTO `zones` VALUES ('44', '223', 'NC', 'North Carolina');
INSERT INTO `zones` VALUES ('45', '223', 'ND', 'North Dakota');
INSERT INTO `zones` VALUES ('46', '223', 'MP', 'Northern Mariana Islands');
INSERT INTO `zones` VALUES ('47', '223', 'OH', 'Ohio');
INSERT INTO `zones` VALUES ('48', '223', 'OK', 'Oklahoma');
INSERT INTO `zones` VALUES ('49', '223', 'OR', 'Oregon');
INSERT INTO `zones` VALUES ('50', '223', 'PW', 'Palau');
INSERT INTO `zones` VALUES ('51', '223', 'PA', 'Pennsylvania');
INSERT INTO `zones` VALUES ('52', '223', 'PR', 'Puerto Rico');
INSERT INTO `zones` VALUES ('53', '223', 'RI', 'Rhode Island');
INSERT INTO `zones` VALUES ('54', '223', 'SC', 'South Carolina');
INSERT INTO `zones` VALUES ('55', '223', 'SD', 'South Dakota');
INSERT INTO `zones` VALUES ('56', '223', 'TN', 'Tennessee');
INSERT INTO `zones` VALUES ('57', '223', 'TX', 'Texas');
INSERT INTO `zones` VALUES ('58', '223', 'UT', 'Utah');
INSERT INTO `zones` VALUES ('59', '223', 'VT', 'Vermont');
INSERT INTO `zones` VALUES ('60', '223', 'VI', 'Virgin Islands');
INSERT INTO `zones` VALUES ('61', '223', 'VA', 'Virginia');
INSERT INTO `zones` VALUES ('62', '223', 'WA', 'Washington');
INSERT INTO `zones` VALUES ('63', '223', 'WV', 'West Virginia');
INSERT INTO `zones` VALUES ('64', '223', 'WI', 'Wisconsin');
INSERT INTO `zones` VALUES ('65', '223', 'WY', 'Wyoming');
INSERT INTO `zones` VALUES ('66', '38', 'AB', 'Alberta');
INSERT INTO `zones` VALUES ('67', '38', 'BC', 'British Columbia');
INSERT INTO `zones` VALUES ('68', '38', 'MB', 'Manitoba');
INSERT INTO `zones` VALUES ('69', '38', 'NF', 'Newfoundland');
INSERT INTO `zones` VALUES ('70', '38', 'NB', 'New Brunswick');
INSERT INTO `zones` VALUES ('71', '38', 'NS', 'Nova Scotia');
INSERT INTO `zones` VALUES ('72', '38', 'NT', 'Northwest Territories');
INSERT INTO `zones` VALUES ('73', '38', 'NU', 'Nunavut');
INSERT INTO `zones` VALUES ('74', '38', 'ON', 'Ontario');
INSERT INTO `zones` VALUES ('75', '38', 'PE', 'Prince Edward Island');
INSERT INTO `zones` VALUES ('76', '38', 'QC', 'Quebec');
INSERT INTO `zones` VALUES ('77', '38', 'SK', 'Saskatchewan');
INSERT INTO `zones` VALUES ('78', '38', 'YT', 'Yukon Territory');
INSERT INTO `zones` VALUES ('79', '81', 'NDS', 'Niedersachsen');
INSERT INTO `zones` VALUES ('80', '81', 'BAW', 'Baden-Württemberg');
INSERT INTO `zones` VALUES ('81', '81', 'BAY', 'Bayern');
INSERT INTO `zones` VALUES ('82', '81', 'BER', 'Berlin');
INSERT INTO `zones` VALUES ('83', '81', 'BRG', 'Brandenburg');
INSERT INTO `zones` VALUES ('84', '81', 'BRE', 'Bremen');
INSERT INTO `zones` VALUES ('85', '81', 'HAM', 'Hamburg');
INSERT INTO `zones` VALUES ('86', '81', 'HES', 'Hessen');
INSERT INTO `zones` VALUES ('87', '81', 'MEC', 'Mecklenburg-Vorpommern');
INSERT INTO `zones` VALUES ('88', '81', 'NRW', 'Nordrhein-Westfalen');
INSERT INTO `zones` VALUES ('89', '81', 'RHE', 'Rheinland-Pfalz');
INSERT INTO `zones` VALUES ('90', '81', 'SAR', 'Saarland');
INSERT INTO `zones` VALUES ('91', '81', 'SAS', 'Sachsen');
INSERT INTO `zones` VALUES ('92', '81', 'SAC', 'Sachsen-Anhalt');
INSERT INTO `zones` VALUES ('93', '81', 'SCN', 'Schleswig-Holstein');
INSERT INTO `zones` VALUES ('94', '81', 'THE', 'Thüringen');
INSERT INTO `zones` VALUES ('95', '14', 'WI', 'Wien');
INSERT INTO `zones` VALUES ('96', '14', 'NO', 'Niederösterreich');
INSERT INTO `zones` VALUES ('97', '14', 'OO', 'Oberösterreich');
INSERT INTO `zones` VALUES ('98', '14', 'SB', 'Salzburg');
INSERT INTO `zones` VALUES ('99', '14', 'KN', 'Kärnten');
INSERT INTO `zones` VALUES ('100', '14', 'ST', 'Steiermark');
INSERT INTO `zones` VALUES ('101', '14', 'TI', 'Tirol');
INSERT INTO `zones` VALUES ('102', '14', 'BL', 'Burgenland');
INSERT INTO `zones` VALUES ('103', '14', 'VB', 'Voralberg');
INSERT INTO `zones` VALUES ('104', '204', 'AG', 'Aargau');
INSERT INTO `zones` VALUES ('105', '204', 'AI', 'Appenzell Innerrhoden');
INSERT INTO `zones` VALUES ('106', '204', 'AR', 'Appenzell Ausserrhoden');
INSERT INTO `zones` VALUES ('107', '204', 'BE', 'Bern');
INSERT INTO `zones` VALUES ('108', '204', 'BL', 'Basel-Landschaft');
INSERT INTO `zones` VALUES ('109', '204', 'BS', 'Basel-Stadt');
INSERT INTO `zones` VALUES ('110', '204', 'FR', 'Freiburg');
INSERT INTO `zones` VALUES ('111', '204', 'GE', 'Genf');
INSERT INTO `zones` VALUES ('112', '204', 'GL', 'Glarus');
INSERT INTO `zones` VALUES ('113', '204', 'JU', 'Graubünden');
INSERT INTO `zones` VALUES ('114', '204', 'JU', 'Jura');
INSERT INTO `zones` VALUES ('115', '204', 'LU', 'Luzern');
INSERT INTO `zones` VALUES ('116', '204', 'NE', 'Neuenburg');
INSERT INTO `zones` VALUES ('117', '204', 'NW', 'Nidwalden');
INSERT INTO `zones` VALUES ('118', '204', 'OW', 'Obwalden');
INSERT INTO `zones` VALUES ('119', '204', 'SG', 'St. Gallen');
INSERT INTO `zones` VALUES ('120', '204', 'SH', 'Schaffhausen');
INSERT INTO `zones` VALUES ('121', '204', 'SO', 'Solothurn');
INSERT INTO `zones` VALUES ('122', '204', 'SZ', 'Schwyz');
INSERT INTO `zones` VALUES ('123', '204', 'TG', 'Thurgau');
INSERT INTO `zones` VALUES ('124', '204', 'TI', 'Tessin');
INSERT INTO `zones` VALUES ('125', '204', 'UR', 'Uri');
INSERT INTO `zones` VALUES ('126', '204', 'VD', 'Waadt');
INSERT INTO `zones` VALUES ('127', '204', 'VS', 'Wallis');
INSERT INTO `zones` VALUES ('128', '204', 'ZG', 'Zug');
INSERT INTO `zones` VALUES ('129', '204', 'ZH', 'Zürich');
INSERT INTO `zones` VALUES ('130', '195', 'A Coruña', 'A Coruña');
INSERT INTO `zones` VALUES ('131', '195', 'Alava', 'Alava');
INSERT INTO `zones` VALUES ('132', '195', 'Albacete', 'Albacete');
INSERT INTO `zones` VALUES ('133', '195', 'Alicante', 'Alicante');
INSERT INTO `zones` VALUES ('134', '195', 'Almeria', 'Almeria');
INSERT INTO `zones` VALUES ('135', '195', 'Asturias', 'Asturias');
INSERT INTO `zones` VALUES ('136', '195', 'Avila', 'Avila');
INSERT INTO `zones` VALUES ('137', '195', 'Badajoz', 'Badajoz');
INSERT INTO `zones` VALUES ('138', '195', 'Baleares', 'Baleares');
INSERT INTO `zones` VALUES ('139', '195', 'Barcelona', 'Barcelona');
INSERT INTO `zones` VALUES ('140', '195', 'Burgos', 'Burgos');
INSERT INTO `zones` VALUES ('141', '195', 'Caceres', 'Caceres');
INSERT INTO `zones` VALUES ('142', '195', 'Cadiz', 'Cadiz');
INSERT INTO `zones` VALUES ('143', '195', 'Cantabria', 'Cantabria');
INSERT INTO `zones` VALUES ('144', '195', 'Castellon', 'Castellon');
INSERT INTO `zones` VALUES ('145', '195', 'Ceuta', 'Ceuta');
INSERT INTO `zones` VALUES ('146', '195', 'Ciudad Real', 'Ciudad Real');
INSERT INTO `zones` VALUES ('147', '195', 'Cordoba', 'Cordoba');
INSERT INTO `zones` VALUES ('148', '195', 'Cuenca', 'Cuenca');
INSERT INTO `zones` VALUES ('149', '195', 'Girona', 'Girona');
INSERT INTO `zones` VALUES ('150', '195', 'Granada', 'Granada');
INSERT INTO `zones` VALUES ('151', '195', 'Guadalajara', 'Guadalajara');
INSERT INTO `zones` VALUES ('152', '195', 'Guipuzcoa', 'Guipuzcoa');
INSERT INTO `zones` VALUES ('153', '195', 'Huelva', 'Huelva');
INSERT INTO `zones` VALUES ('154', '195', 'Huesca', 'Huesca');
INSERT INTO `zones` VALUES ('155', '195', 'Jaen', 'Jaen');
INSERT INTO `zones` VALUES ('156', '195', 'La Rioja', 'La Rioja');
INSERT INTO `zones` VALUES ('157', '195', 'Las Palmas', 'Las Palmas');
INSERT INTO `zones` VALUES ('158', '195', 'Leon', 'Leon');
INSERT INTO `zones` VALUES ('159', '195', 'Lleida', 'Lleida');
INSERT INTO `zones` VALUES ('160', '195', 'Lugo', 'Lugo');
INSERT INTO `zones` VALUES ('161', '195', 'Madrid', 'Madrid');
INSERT INTO `zones` VALUES ('162', '195', 'Malaga', 'Malaga');
INSERT INTO `zones` VALUES ('163', '195', 'Melilla', 'Melilla');
INSERT INTO `zones` VALUES ('164', '195', 'Murcia', 'Murcia');
INSERT INTO `zones` VALUES ('165', '195', 'Navarra', 'Navarra');
INSERT INTO `zones` VALUES ('166', '195', 'Ourense', 'Ourense');
INSERT INTO `zones` VALUES ('167', '195', 'Palencia', 'Palencia');
INSERT INTO `zones` VALUES ('168', '195', 'Pontevedra', 'Pontevedra');
INSERT INTO `zones` VALUES ('169', '195', 'Salamanca', 'Salamanca');
INSERT INTO `zones` VALUES ('170', '195', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
INSERT INTO `zones` VALUES ('171', '195', 'Segovia', 'Segovia');
INSERT INTO `zones` VALUES ('172', '195', 'Sevilla', 'Sevilla');
INSERT INTO `zones` VALUES ('173', '195', 'Soria', 'Soria');
INSERT INTO `zones` VALUES ('174', '195', 'Tarragona', 'Tarragona');
INSERT INTO `zones` VALUES ('175', '195', 'Teruel', 'Teruel');
INSERT INTO `zones` VALUES ('176', '195', 'Toledo', 'Toledo');
INSERT INTO `zones` VALUES ('177', '195', 'Valencia', 'Valencia');
INSERT INTO `zones` VALUES ('178', '195', 'Valladolid', 'Valladolid');
INSERT INTO `zones` VALUES ('179', '195', 'Vizcaya', 'Vizcaya');
INSERT INTO `zones` VALUES ('180', '195', 'Zamora', 'Zamora');
INSERT INTO `zones` VALUES ('181', '195', 'Zaragoza', 'Zaragoza');

-- ----------------------------
-- Table structure for `zones_to_geo_zones`
-- ----------------------------
DROP TABLE IF EXISTS `zones_to_geo_zones`;
CREATE TABLE `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `geo_zone_id` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`association_id`),
  KEY `idx_zones_to_geo_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of zones_to_geo_zones
-- ----------------------------
INSERT INTO `zones_to_geo_zones` VALUES ('1', '223', '18', '1', null, '2015-02-26 16:56:42');
