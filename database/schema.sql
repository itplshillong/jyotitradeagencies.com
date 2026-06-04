-- ============================================================
-- Jyoti Trade Agencies - Complete MySQL Database Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS jyoti_trade_agencies
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE jyoti_trade_agencies;

-- --------------------------------------------------------
-- Table: admin_users
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`   VARCHAR(100) NOT NULL UNIQUE,
  `email`      VARCHAR(255) NOT NULL UNIQUE,
  `password`   VARCHAR(255) NOT NULL COMMENT 'bcrypt hash',
  `full_name`  VARCHAR(255) NOT NULL,
  `is_active`  TINYINT(1) NOT NULL DEFAULT 1,
  `last_login` DATETIME DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin: password = Admin@1234 (bcrypt)
INSERT INTO `admin_users` (`username`, `email`, `password`, `full_name`) VALUES
('admin', 'admin@jyotitradeagencies.com', '$2y$12$eImiTXuWVxfM37uY4JANjOe5XAk6l/d.RmSBmmIqB6zomrP0bjGQS', 'Administrator');

-- --------------------------------------------------------
-- Table: banners
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `banners` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255) NOT NULL,
  `subtitle`    TEXT DEFAULT NULL,
  `image_path`  VARCHAR(500) NOT NULL,
  `btn1_text`   VARCHAR(100) DEFAULT NULL,
  `btn1_link`   VARCHAR(500) DEFAULT NULL,
  `btn2_text`   VARCHAR(100) DEFAULT NULL,
  `btn2_link`   VARCHAR(500) DEFAULT NULL,
  `sort_order`  INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1) NOT NULL DEFAULT 1,
  `created_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_sort_active` (`sort_order`, `is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: product_categories
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(255) NOT NULL,
  `slug`         VARCHAR(255) NOT NULL UNIQUE,
  `description`  TEXT DEFAULT NULL,
  `image_path`   VARCHAR(500) DEFAULT NULL,
  `pdf_path`     VARCHAR(500) DEFAULT NULL,
  `sort_order`   INT UNSIGNED NOT NULL DEFAULT 0,
  `is_active`    TINYINT(1) NOT NULL DEFAULT 1,
  `created_at`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_slug` (`slug`),
  KEY `idx_sort_active` (`sort_order`, `is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product_categories` (`name`, `slug`, `description`, `sort_order`) VALUES
('Veterinary Medicines', 'veterinary-medicines', 'Comprehensive range of veterinary medicines including antibiotics, antiparasitics, vitamins, vaccines, and specialty formulations for all animal species.', 1),
('Surgical Instruments', 'surgical-instruments', 'High-quality veterinary surgical instruments including forceps, scalpels, scissors, retractors, and complete surgical sets for veterinary professionals.', 2),
('Chemicals', 'chemicals', 'Laboratory-grade veterinary chemicals, disinfectants, reagents, and specialty chemical compounds for diagnostics and treatment protocols.', 3),
('Laboratories', 'laboratories', 'Advanced laboratory products including diagnostic kits, testing equipment, culture media, and analytical instruments for veterinary diagnostics.', 4),
('Health Care Products', 'health-care-products', 'Comprehensive animal healthcare products including nutritional supplements, grooming products, wound care, and preventive healthcare solutions.', 5);

-- --------------------------------------------------------
-- Table: inquiries (Contact Form)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`         VARCHAR(255) NOT NULL,
  `company_name` VARCHAR(255) DEFAULT NULL,
  `email`        VARCHAR(255) NOT NULL,
  `phone`        VARCHAR(50) DEFAULT NULL,
  `message`      TEXT NOT NULL,
  `ip_address`   VARCHAR(45) DEFAULT NULL,
  `is_read`      TINYINT(1) NOT NULL DEFAULT 0,
  `created_at`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_is_read` (`is_read`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: quote_requests
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote_requests` (
  `id`                  INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`                VARCHAR(255) NOT NULL,
  `company_name`        VARCHAR(255) DEFAULT NULL,
  `country`             VARCHAR(100) DEFAULT NULL,
  `email`               VARCHAR(255) NOT NULL,
  `phone`               VARCHAR(50) DEFAULT NULL,
  `product_category`    VARCHAR(255) DEFAULT NULL,
  `quantity`            VARCHAR(255) DEFAULT NULL,
  `requirement_details` TEXT DEFAULT NULL,
  `ip_address`          VARCHAR(45) DEFAULT NULL,
  `is_read`             TINYINT(1) NOT NULL DEFAULT 0,
  `created_at`          DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_is_read` (`is_read`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table: settings
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_val` TEXT DEFAULT NULL,
  `updated_at`  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `settings` (`setting_key`, `setting_val`) VALUES
('company_name',      'Jyoti Trade Agencies'),
('phone',             '+91-XXXXXXXXXX'),
('email',             'info@jyotitradeagencies.com'),
('address',           'Your Address, City, State, India'),
('map_embed',         ''),
('smtp_host',         'smtp.gmail.com'),
('smtp_port',         '587'),
('smtp_username',     ''),
('smtp_password',     ''),
('smtp_sender_name',  'Jyoti Trade Agencies'),
('smtp_recipient',    ''),
('meta_title_home',   'Jyoti Trade Agencies - Global Veterinary Healthcare Solutions'),
('meta_desc_home',    'Jyoti Trade Agencies provides veterinary medicines, surgical instruments, chemicals, laboratory products and healthcare solutions worldwide.'),
('meta_keywords',     'veterinary medicines, surgical instruments, veterinary chemicals, animal healthcare, veterinary laboratory products'),
('google_analytics',  ''),
('og_image',          ''),
('whatsapp_number',   '')
ON DUPLICATE KEY UPDATE setting_key = setting_key;
