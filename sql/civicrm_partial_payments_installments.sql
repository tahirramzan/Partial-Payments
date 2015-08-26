-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2015 at 07:22 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wpdemocivi_bwwgb`
--

-- --------------------------------------------------------

--
-- Table structure for table `civicrm_partial_payments_installments`
--

DROP TABLE IF EXISTS `civicrm_partial_payments_installments`;
CREATE TABLE IF NOT EXISTS `civicrm_partial_payments_installments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contribution_id` int(10) unsigned NOT NULL,
  `primary_contact_id` int(10) unsigned NOT NULL,
  `secondary_contact_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` decimal(20,2) NOT NULL,
  `installment_amount` decimal(20,2) NOT NULL,
  `installments_count` decimal(20,2) NOT NULL,
  `installments_remaining` decimal(20,2) NOT NULL,
  `paying_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_civicrm_partial_payments_installments_primary_contact_id` (`primary_contact_id`),
  KEY `FK_civicrm_partial_payments_installments_secondary_contact_id` (`secondary_contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `civicrm_partial_payments_installments`
--
ALTER TABLE `civicrm_partial_payments_installments`
  ADD CONSTRAINT `FK_civicrm_partial_payments_installments_primary_contact_id` FOREIGN KEY (`primary_contact_id`) REFERENCES `civicrm_contact` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_civicrm_partial_payments_installments_secondary_contact_id` FOREIGN KEY (`secondary_contact_id`) REFERENCES `civicrm_contact` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
