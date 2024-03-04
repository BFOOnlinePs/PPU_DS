-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 01:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppu_ds`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `c_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `c_name` text DEFAULT NULL COMMENT 'اسم الشركة',
  `c_description` text DEFAULT NULL COMMENT 'وصف للشركة',
  `c_website` text DEFAULT NULL COMMENT 'الموقع الإلكتروني للشركة',
  `c_type` int(11) DEFAULT NULL COMMENT 'نوع الشركة ، مثال : قطاع خاص ، قطاع عام ...',
  `c_category_id` int(11) DEFAULT NULL COMMENT 'رقم التصنيف',
  `c_manager_id` int(11) DEFAULT NULL COMMENT 'رقم مدير الشركة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`c_id`, `c_name`, `c_description`, `c_website`, `c_type`, `c_category_id`, `c_manager_id`, `created_at`, `updated_at`) VALUES
(1, 'ملتقى سواعد شباب الغد ', NULL, NULL, 2, 1, 2, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(2, 'جمعية سيدات السموع الخيرية ', NULL, NULL, 2, 1, 3, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(3, 'بوابة المسافر للتأمين ', NULL, NULL, 2, 2, 4, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(4, 'شركة اليوسف للابواب ', NULL, NULL, 2, 3, 5, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(5, 'شركة ميجا للاوراق الصحية', NULL, NULL, 2, 3, 6, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(6, 'غرفة تجارة وصناعة شمال الخليل ', NULL, NULL, 2, 4, 7, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(7, 'العالمية للفرشات', NULL, NULL, 2, 3, 8, '2024-02-26 06:25:20', '2024-02-26 06:25:23'),
(8, 'شركة مجوهرات القواسمي', NULL, NULL, 2, 3, 9, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(9, 'شركة الجعبري للتجارة والتسويق ( لوازم مكتبية )', NULL, NULL, 2, 5, 10, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(10, 'شركة مطاعم لاستوريا ', NULL, NULL, 2, 10, 11, '2024-02-26 06:25:20', '2024-02-26 06:25:21'),
(11, 'مجموعة ارام الاستثمارية', NULL, NULL, 2, 6, 12, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(12, ' شركة ازدهار فلسطين', NULL, NULL, 2, 6, 13, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(13, 'شركة النور للصياغة والمجوهرات', NULL, NULL, 2, 3, 14, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(14, 'شركة سنقرط للمجوهرات والمعادن - جولد ستار', NULL, NULL, 2, 3, 15, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(15, 'شركة قوافل التميمي الزراعية الصناعية  ', NULL, NULL, 2, 5, 16, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(16, 'شركة كريستال سيكوريت الحديثة للزجاج', NULL, NULL, 2, 3, 17, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(17, 'بيست ليبل التجارية للاعلان والطباعة', NULL, NULL, 2, 7, 18, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(18, 'شركة التقدم للقبانات والموازين والاثاث المعدني', NULL, NULL, 2, 3, 19, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(19, 'الشركة الاهلية لصناعة علب الكرتون', NULL, NULL, 2, 3, 20, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(20, 'شركة العسيلي للتجارة الدولية ( مواد غذائية )', NULL, NULL, 2, 5, 21, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(21, 'شركة شويكي اخوان الصناعية للزجاج', NULL, NULL, 2, 3, 22, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(22, 'شركة طيف للدعاية والاعلان', NULL, NULL, 2, 7, 23, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(23, 'شركة التجهيز والبناء الحديثة للتعهدات', NULL, NULL, 2, 8, 24, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(24, 'شركة الشماس سيستم لتجارة وصناعة الالمنيوم', NULL, NULL, 2, 3, 25, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(25, 'شركة محسن زلوم وشركاه للتجارة الدولية', NULL, NULL, 2, 5, 26, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(26, 'مؤسسة مسودي للتخليص الجمركي وتدقيق الحسابات ', NULL, NULL, 2, 9, 27, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(27, 'شركة بترومول لصناعة وتجارة البلاستيك', NULL, NULL, 2, 3, 28, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(28, '\nشركة MAVI للحلول التسويقية', NULL, NULL, 2, 7, 29, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(29, 'شركة أبو منشار للاستثمار والتسويق ( دهان السيارات )', NULL, NULL, 2, 5, 30, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(30, 'شركة كراون سيستم لتجارة وصناعة الالمنيوم', NULL, NULL, 2, 3, 31, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(31, 'شركة بيوتي مير  لمواد التجميل ', NULL, NULL, 2, 5, 32, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(32, 'ملتقى رجال الاعمال الفلسطيني ', NULL, NULL, 2, 4, 33, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(33, 'عبده للتأمين', NULL, NULL, 2, 2, 34, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(34, 'شركة رويال الصناعية التجارية', NULL, NULL, 2, 3, 35, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(35, 'شركة أبناء حامد الجدع ', NULL, NULL, 2, 11, 36, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(36, 'شركة الراز  للعدد الصناعية ', NULL, NULL, 2, 5, 37, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(37, 'شركة سوبر تكس لصناعة الملابس', NULL, NULL, 2, 3, 38, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(38, 'مجموعة الوكيل للالكترونيات ', NULL, NULL, 2, 12, 39, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(39, 'شركة كهرباء الخليل', NULL, NULL, 2, 11, 40, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(40, 'بلدية الخليل', NULL, NULL, 2, 13, 41, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(41, 'بنك القدس', NULL, NULL, 2, 14, 42, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(42, 'فلسطين للتأمين', NULL, NULL, 2, 2, 43, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(43, 'PalPay', NULL, NULL, 2, 15, 44, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(44, 'شركة كهرباء الجنوب', NULL, NULL, 2, 11, 45, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(45, 'الوفاء للبلاستيك', NULL, NULL, 2, 3, 46, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(46, 'المشروبات الوطنية- كوكاكولا', NULL, NULL, 2, 3, 47, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(47, 'شركة جوال (جوال باي)', NULL, NULL, 2, 15, 48, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(48, 'الحرباوي لتكنولوجيا الصناعة', NULL, NULL, 2, 3, 49, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(49, 'الجبريني', NULL, NULL, 2, 3, 50, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(50, 'الجنيدي', NULL, NULL, 2, 3, 51, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(51, 'شمسنا', NULL, NULL, 2, 11, 52, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(52, 'شركة نيروخ لصناعة القبانات و الأثاث المعدني', NULL, NULL, 2, 3, 53, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(53, 'سعدي الجدع للهندسة الكهربائية وحلول الطاقة ', NULL, NULL, 2, 11, 54, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(54, 'مدفوعاتكم', NULL, NULL, 2, 15, 55, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(55, 'مجموعة السلام الاستثمارية', NULL, NULL, 2, 6, 56, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(56, 'شركة بيت لحم لأجهزة الطاقة المتجددة', NULL, NULL, 2, 11, 57, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(57, 'بيسان للأنظمة المالية', NULL, NULL, 2, 12, 58, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(58, 'أكاد للتمويل والتنمية', NULL, NULL, 2, 16, 59, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(59, 'الطويل شركة جي ال تي للصناعات البلاستيكية', NULL, NULL, 2, 3, 60, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(60, 'تكنولوجيا الخطوط الخضراء', NULL, NULL, 2, 11, 61, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(61, 'تحالف', NULL, NULL, 2, 17, 62, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(62, 'الوسيط للتأمين', NULL, NULL, 2, 2, 63, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(63, 'انفنتي للدعاية والإعلان', NULL, NULL, 2, 7, 64, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(64, 'فاتن', NULL, NULL, 2, 16, 65, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(65, 'مكتب سامح الجعبري للتأمين', NULL, NULL, 2, 2, 66, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(66, 'البنك الإسلامي الفلسطيني', NULL, NULL, 2, 14, 67, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(67, 'شركة تو مي لتجارة الكوزمتكس', NULL, NULL, 2, 5, 68, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(68, 'توب لاينز للمستلزمات الطبية', NULL, NULL, 2, 5, 69, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(69, 'شركة قدرة لحلول الطاقة ', NULL, NULL, 2, 11, 70, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(70, 'شركة إجارة', NULL, NULL, 2, 16, 71, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(71, 'بلدية السموع', NULL, NULL, 2, 13, 72, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(72, 'وكالة عدنان للتأمين', NULL, NULL, 2, 2, 73, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(73, 'شركة الزرو للكهرباء الصناعية', NULL, NULL, 2, 11, 74, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(74, 'شركة حمزة شاهين واولاه الاستثمارية', NULL, NULL, 2, 5, 75, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(75, 'شركة القواسمة لزخرفة الحديد', NULL, NULL, 2, 3, 76, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(76, 'مستشفى الملكي التخصصي', NULL, NULL, 2, 18, 77, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(77, 'شركة سوبر نمر الصناعية ', NULL, NULL, 2, 3, 78, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(78, 'شركة انفيتي للكوزمتكس والاكسسورات', NULL, NULL, 2, 5, 79, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(79, 'شركة زمزم للصناعات البلاستيكية', NULL, NULL, 2, 3, 80, '2024-02-26 06:25:25', '2024-02-26 06:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `companies_categories`
--

CREATE TABLE `companies_categories` (
  `cc_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `cc_name` text NOT NULL COMMENT 'اسم تصنيف الشركة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies_categories`
--

INSERT INTO `companies_categories` (`cc_id`, `cc_name`, `created_at`, `updated_at`) VALUES
(1, 'مؤسسات غير ربحية', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(2, 'شركات ووسطاء التأمين', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(3, 'شركات التصنيع والانتاج الصناعي', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(4, 'الغرف التجارية والمؤسسات الأهلية', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(5, 'شركات تجارة الجملة والتجزئة', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(6, 'شركات الاستثمار والخدمات', '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(7, 'شركات التسويق والدعاية والاعلان', '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(8, 'شركات المقاولات والتطوير العقاري', '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(9, 'شركات التدقيق والمحاسبة والاستشارات', '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(10, 'شركات المطاعم والفنادق', '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(11, 'شركات الطاقة والكهرباء ', '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(12, 'شركات تكنولوجيا المعلومات والبرمجيات', '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(13, 'البلديات والمجالس المحلية', '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(14, 'البنوك والمصارف', '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(15, 'شركات الدفع الالكتروني', '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(16, 'مؤسسات التمويل والاقراض', '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(17, 'مؤسسات التعليم والتدريب', '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(18, 'المستشفيات والمراكز الطبية والدوائية', '2024-02-26 06:25:24', '2024-02-26 06:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `company_branches`
--

CREATE TABLE `company_branches` (
  `b_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `b_company_id` int(11) NOT NULL COMMENT 'رقم الشركة',
  `b_address` text NOT NULL COMMENT 'عنوان فرع الشركة',
  `b_phone1` text NOT NULL COMMENT 'رقم هاتف الشركة ، الرقم الأول',
  `b_phone2` text DEFAULT NULL COMMENT 'رقم هاتف الشركة ، الرقم الثاني',
  `b_main_branch` int(11) NOT NULL COMMENT 'هل هو فرع رئيسي أم لا؟\r\n1: فرع رئيسي\r\n0: ليس فرع رئيسي',
  `b_manager_id` int(11) NOT NULL COMMENT 'رقم المدير',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_branches`
--

INSERT INTO `company_branches` (`b_id`, `b_company_id`, `b_address`, `b_phone1`, `b_phone2`, `b_main_branch`, `b_manager_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'دورا ', '599276670', NULL, 1, 2, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(2, 2, 'السموع ', '0599-379928', NULL, 1, 3, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(3, 3, 'يطا ', '0597-318885', NULL, 1, 4, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(4, 4, 'يطا ', '0599-102601', NULL, 1, 5, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(5, 5, 'يطا ', '0568-102077', NULL, 1, 6, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(6, 6, 'حلحول ', '0598-888422', NULL, 1, 7, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(7, 7, 'الخليل ', '0599-678166', NULL, 1, 8, '2024-02-26 06:25:20', '2024-02-26 06:25:23'),
(8, 8, 'الخليل', '0569-222221', NULL, 1, 9, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(9, 9, 'الخليل', '0599-203068', NULL, 1, 10, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(10, 10, 'الخليل', '0599-438797', NULL, 1, 11, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(11, 11, 'الخليل', '0599-272000', NULL, 1, 12, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(12, 12, 'حلحول', '0599-242000', NULL, 1, 13, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(13, 13, 'الخليل', '0599-202569', NULL, 1, 14, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(14, 14, 'الخليل', '0599-319683', NULL, 1, 15, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(15, 15, 'الخليل', '0599-222011', NULL, 1, 16, '2024-02-26 06:25:20', '2024-02-26 06:25:20'),
(16, 16, 'الخليل', '0599-999646', NULL, 1, 17, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(17, 17, 'الخليل', '0599-649178', NULL, 1, 18, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(18, 18, 'الخليل', '0599-210601', NULL, 1, 19, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(19, 19, 'الخليل', '0595-806666', NULL, 1, 20, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(20, 20, 'الخليل', '0599-390390', NULL, 1, 21, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(21, 21, 'الخليل', '0599-828451', NULL, 1, 22, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(22, 22, 'الخليل', '0599-870011', NULL, 1, 23, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(23, 23, 'الخليل', '0569-214840', NULL, 1, 24, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(24, 24, 'الخليل', '\n0569-292705', NULL, 1, 25, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(25, 25, 'الخليل', '0599-401301', NULL, 1, 26, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(26, 26, 'الخليل', '0599-333030', NULL, 1, 27, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(27, 27, 'الخليل', '0599-299324', NULL, 1, 28, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(28, 28, 'الخليل', '0569-032052', NULL, 1, 29, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(29, 29, 'الخليل', '0599-224060', NULL, 1, 30, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(30, 30, 'الخليل', '0569-373333', NULL, 1, 31, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(31, 31, 'الخليل', '0599-999600', NULL, 1, 32, '2024-02-26 06:25:21', '2024-02-26 06:25:21'),
(32, 32, 'الخليل', '0599-508666', NULL, 1, 33, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(33, 33, 'الخليل ', '0599-498833', NULL, 1, 34, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(34, 34, 'الخليل ', '0599-340226', NULL, 1, 35, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(35, 35, 'الخليل', '0599-035205', NULL, 1, 36, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(36, 36, 'الخليل', '0599-274286', NULL, 1, 37, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(37, 37, 'الخليل', '0599-991992', NULL, 1, 38, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(38, 38, 'الخليل', '0597-877000', NULL, 1, 39, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(39, 39, 'الخليل ', '0598-123620', NULL, 1, 40, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(40, 40, 'الخليل ', '0598-741754', NULL, 1, 41, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(41, 41, 'رام الله / الخليل ', '0568-278888', NULL, 1, 42, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(42, 42, 'رام الله / الخليل ', '0594-550218', NULL, 1, 43, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(43, 43, 'رام الله / الخليل ', '0568-848026', NULL, 1, 44, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(44, 44, 'دورا ', '0592-777000 / 0595-044877', NULL, 1, 45, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(45, 45, 'الخليل ', '0598-939291', NULL, 1, 46, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(46, 46, 'رام الله / الخليل ', '0594-430339', NULL, 1, 47, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(47, 47, 'رام الله / الخليل ', '0599-000864', NULL, 1, 48, '2024-02-26 06:25:22', '2024-02-26 06:25:22'),
(48, 48, 'الخليل ', '0562-331335', NULL, 1, 49, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(49, 49, 'الخليل ', '0568-226000', NULL, 1, 50, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(50, 50, 'الخليل ', '0595-260002', NULL, 1, 51, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(51, 51, 'الخليل ', '0599-764900', NULL, 1, 52, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(52, 52, 'الخليل ', '0597-257000', NULL, 1, 53, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(53, 53, 'الخليل ', '0599-110417', NULL, 1, 54, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(54, 54, 'رام الله / الخليل ', '0594-266100', NULL, 1, 55, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(55, 55, 'الخليل ', '0599-034039', NULL, 1, 56, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(56, 56, 'بيت لحم / الخليل ', '0592-265001', NULL, 1, 57, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(57, 57, 'رام الله  ', '0597-270493', NULL, 1, 58, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(58, 58, 'رام الله / الخليل ', '0562-600400', NULL, 1, 59, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(59, 59, 'الخليل ', '0599-211098', NULL, 1, 60, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(60, 60, 'الخليل ', '0568-264799', NULL, 1, 61, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(61, 61, 'الخليل ', '0000000000', NULL, 1, 62, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(62, 62, 'الخليل ', '0568-390700', NULL, 1, 63, '2024-02-26 06:25:23', '2024-02-26 06:25:23'),
(63, 63, 'الخليل ', '0598-909800', NULL, 1, 64, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(64, 64, 'رام الله / الخليل ', '0000000000', NULL, 1, 65, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(65, 65, 'الخليل ', '0599-849632', NULL, 1, 66, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(66, 66, 'رام الله / الخليل ', '0598-242683', NULL, 1, 67, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(67, 67, 'الخليل ', '0000000000', NULL, 1, 68, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(68, 68, 'الخليل ', '0599-675378', NULL, 1, 69, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(69, 69, 'رام الله ', '0562-171833', NULL, 1, 70, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(70, 70, 'رام الله / الخليل ', '0000000000', NULL, 1, 71, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(71, 71, 'السموع ', '0598-933933', NULL, 1, 72, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(72, 72, 'دورا ', '0000000000', NULL, 1, 73, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(73, 73, 'الخليل', '0599-110707', NULL, 1, 74, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(74, 74, 'الخليل/سنجر', '0597918004/0568918005', NULL, 1, 75, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(75, 75, 'الخليل/بيت عينون', '599046375', NULL, 1, 76, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(76, 76, 'الخليل/الضاحية', '593555529', NULL, 1, 77, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(77, 77, 'بيت اولا/المنطقة الصناعية', '599522065', NULL, 1, 78, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(78, 78, 'الخليل/نمره', '598882161', NULL, 1, 79, '2024-02-26 06:25:24', '2024-02-26 06:25:24'),
(79, 79, 'الخليل/بيت كاحل', '569380000', NULL, 1, 80, '2024-02-26 06:25:25', '2024-02-26 06:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `company_branches_departments`
--

CREATE TABLE `company_branches_departments` (
  `cbd_id` int(11) NOT NULL,
  `cbd_d_id` int(11) NOT NULL,
  `cbd_company_branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_branches_locations`
--

CREATE TABLE `company_branches_locations` (
  `bl_id` int(11) NOT NULL,
  `bl_branch_id` int(11) DEFAULT NULL,
  `bl_longitude` text DEFAULT NULL,
  `bl_latitude` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_departments`
--

CREATE TABLE `company_departments` (
  `d_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `d_name` text DEFAULT NULL,
  `d_company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `c_name` text NOT NULL COMMENT 'اسم المساق',
  `c_course_code` text NOT NULL COMMENT 'رمز المساق',
  `c_hours` int(11) NOT NULL COMMENT 'عدد ساعات المساق',
  `c_description` text NOT NULL COMMENT 'وصف المساق',
  `c_course_type` int(11) NOT NULL COMMENT 'نوع المساق ، مثال : عملي ، نظري ، عملي و نظري',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'تمت إضافة المساق بتاريخ',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'تم التعديل على معلومات المساق بتاريخ',
  `c_reference_code` text NOT NULL COMMENT 'الرمز المرجعي للمساق'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `c_id` int(11) NOT NULL,
  `c_name` text NOT NULL COMMENT 'اسم العملة',
  `c_symbol` text NOT NULL COMMENT 'رمز العملة',
  `c_status` int(11) NOT NULL DEFAULT 1 COMMENT 'حالة العملة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `e_id` int(11) NOT NULL,
  `e_student_company_id` int(11) NOT NULL,
  `e_company_evaluation` int(11) NOT NULL,
  `e_student_evaluation` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `e_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `e_description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `e_start_date` date NOT NULL,
  `e_end_date` date NOT NULL,
  `e_type` int(11) NOT NULL,
  `e_course_id` int(11) DEFAULT NULL,
  `e_major_id` int(11) DEFAULT NULL,
  `e_company_id` int(11) DEFAULT NULL,
  `e_color` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `updated_at` date NOT NULL DEFAULT current_timestamp(),
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fcm_registration_tokens`
--

CREATE TABLE `fcm_registration_tokens` (
  `frt_id` int(11) NOT NULL,
  `frt_user_id` int(11) NOT NULL,
  `frt_registration_token` text NOT NULL,
  `frt_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `m_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `m_name` text NOT NULL COMMENT 'اسم التخصص',
  `m_description` text NOT NULL COMMENT 'وصف التخصص',
  `m_reference_code` text NOT NULL COMMENT 'الرمز المرجعي للتخصص',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`m_id`, `m_name`, `m_description`, `m_reference_code`, `created_at`, `updated_at`) VALUES
(1, 'Business Technology', 'The \"Business Technology\" program integrates key programs such as Business Administration, Information Technology, Information Systems, E-marketing, and Multimedia.This multidisciplinary program seamlessly blends advanced technological methods with hands-on management experiences. Its primary goal is to equip students with both theoretical knowledge and practical skills, ensuring they are well-prepared to meet the diverse needs of various Palestinian sectors.\r\n\r\nThis program incorporates real-world applications into the learning and teaching process. This approach ensures that graduates are not only well-versed in theoretical concepts but also adept at applying their knowledge in practical scenarios.', '29104', '2024-02-26 07:08:34', '2024-02-26 07:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `major_supervisors`
--

CREATE TABLE `major_supervisors` (
  `ms_id` int(11) NOT NULL,
  `ms_super_id` int(11) NOT NULL,
  `ms_major_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentors_companies`
--

CREATE TABLE `mentors_companies` (
  `mc_id` int(11) NOT NULL,
  `mc_company_employees_id` int(11) DEFAULT NULL,
  `mc_student_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `p_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `p_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `p_company_id` int(11) NOT NULL COMMENT 'رقم الشركة',
  `p_student_company_id` int(11) NOT NULL,
  `p_reference_id` text DEFAULT NULL,
  `p_payment_value` double NOT NULL COMMENT 'قيمة المبلغ المدفوع',
  `p_file` text DEFAULT NULL COMMENT 'ملف',
  `p_inserted_by_id` int(11) NOT NULL COMMENT 'تمت الإضافة بواسطة',
  `p_student_notes` text DEFAULT NULL COMMENT 'ملاحظات',
  `p_status` int(11) DEFAULT NULL COMMENT 'الحالة\r\n0: الديفولت اول ما يضيف دفعة\r\n(غير مؤكدة)\r\n\r\n1: مؤكدة من قبل الطالب',
  `p_currency_id` int(11) NOT NULL COMMENT 'العملة',
  `p_company_notes` text DEFAULT NULL,
  `p_supervisor_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `r_id` int(11) NOT NULL,
  `r_student_id` int(11) DEFAULT NULL,
  `r_course_id` int(11) DEFAULT NULL,
  `r_grade` double DEFAULT NULL,
  `r_semester` int(11) DEFAULT NULL,
  `r_year` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `r_name` text NOT NULL COMMENT 'اسم الدور',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `r_name`, `created_at`, `updated_at`) VALUES
(1, 'أدمن', '2023-10-15 08:25:03', '0000-00-00 00:00:00'),
(2, 'طالب', '2023-10-15 08:25:27', '0000-00-00 00:00:00'),
(3, 'مشرف أكاديمي', '2023-10-15 08:25:57', '0000-00-00 00:00:00'),
(4, 'مساعد إداري', '2023-10-15 08:26:26', '0000-00-00 00:00:00'),
(5, 'مسؤول متابعة وتقييم', '2023-10-15 08:27:11', '0000-00-00 00:00:00'),
(6, 'مدير شركة', '2023-10-15 08:27:46', '0000-00-00 00:00:00'),
(7, 'مسؤول تدريب', '2023-10-15 08:28:30', '0000-00-00 00:00:00'),
(8, 'مسؤول التواصل مع الشركات', '2024-01-08 11:47:07', '2024-01-08 11:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses`
--

CREATE TABLE `semester_courses` (
  `sc_id` int(11) NOT NULL,
  `sc_course_id` int(11) NOT NULL,
  `sc_semester` int(11) NOT NULL,
  `sc_year` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses_assistants`
--

CREATE TABLE `semester_courses_assistants` (
  `sca_id` int(11) NOT NULL,
  `sca_semester_course_id` int(11) NOT NULL,
  `sca_assistant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_attendance`
--

CREATE TABLE `students_attendance` (
  `sa_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `sa_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `sa_student_company_id` int(11) NOT NULL COMMENT 'رقم التدريب',
  `sa_start_time_latitude` text NOT NULL COMMENT 'خط العرض عند تسجيل الحضور للشركة',
  `sa_start_time_longitude` text NOT NULL COMMENT 'خط الطول عند تسجيل الحضور للشركة',
  `sa_end_time_longitude` text DEFAULT NULL COMMENT 'خط الطول عند تسجيل المغادرة للشركة',
  `sa_end_time_latitude` text DEFAULT NULL COMMENT 'خط العرض عند تسجيل المغادرة للشركة',
  `sa_description` text DEFAULT NULL COMMENT 'ملاحظة حضور الطالب',
  `sa_in_time` datetime NOT NULL COMMENT 'وقت الحضور',
  `sa_out_time` datetime DEFAULT NULL COMMENT 'وقت المغادرة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_companies`
--

CREATE TABLE `students_companies` (
  `sc_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `sc_registration_id` int(11) NOT NULL COMMENT 'رقم تسجيل الطالب في مساق',
  `sc_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `sc_company_id` int(11) DEFAULT NULL COMMENT 'تخزين رقم الشركة',
  `sc_branch_id` int(11) DEFAULT NULL COMMENT 'رقم فرع الشركة التي يتدرب بها الطالب',
  `sc_department_id` int(11) DEFAULT NULL COMMENT 'رقم دائرة الشركة',
  `sc_status` int(11) NOT NULL COMMENT 'حالة التدريب (1: ما زال يتدرب، 2: انهى التدريب، 3: محذوف)',
  `sc_agreement_file` text DEFAULT NULL COMMENT 'ملف الموافقة على تدريب الطالب في الشركة',
  `sc_mentor_trainer_id` int(11) DEFAULT NULL COMMENT 'رقم المدرب الموجود في الشركة',
  `sc_assistant_id` int(11) DEFAULT NULL COMMENT 'رقم مساعد المشرف الموجود في الجامعى',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_reports`
--

CREATE TABLE `student_reports` (
  `sr_id` int(11) NOT NULL,
  `sr_student_attendance_id` int(11) NOT NULL,
  `sr_report_text` text NOT NULL,
  `sr_attached_file` text DEFAULT NULL,
  `sr_student_id` int(11) NOT NULL,
  `sr_notes` text DEFAULT NULL COMMENT 'ملاحظات المشرف',
  `sr_notes_company` text DEFAULT NULL COMMENT 'ملاحظات الشركة',
  `sr_submit_longitude` text NOT NULL,
  `sr_submit_latitude` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_assistants`
--

CREATE TABLE `supervisor_assistants` (
  `sa_id` int(11) NOT NULL,
  `sa_supervisor_id` int(11) NOT NULL,
  `sa_assistant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `s_id` int(11) NOT NULL COMMENT 'الرقم التسلسلي',
  `s_title` text NOT NULL COMMENT 'عنوان الاستبيان',
  `s_description` text NOT NULL COMMENT 'وصف الاستبيان',
  `st_id` int(11) NOT NULL COMMENT 'الفئة المستهدفة',
  `s_start_date` date NOT NULL COMMENT 'وقت الظهور',
  `s_end_date` date NOT NULL COMMENT 'وقت الاختفاء',
  `s_added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `sq_id` int(11) NOT NULL COMMENT 'الرقم التسلسلي للسؤال',
  `sq_s_id` int(11) NOT NULL COMMENT 'رقم التسلسلي للاستبيان',
  `sq_question_text` text NOT NULL COMMENT 'نص السؤال',
  `sq_question_type` text NOT NULL COMMENT 'نوع السؤال \r\nنصي 0 \r\nاختيار من متعدد 1\r\nملف 2',
  `sq_question_required` int(11) DEFAULT NULL COMMENT '1 مطلوب\r\n0 غير مطلوب',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_options`
--

CREATE TABLE `survey_question_options` (
  `sqo_id` int(11) NOT NULL COMMENT 'الرقم التسلسلي لخيار السؤال',
  `sqo_sq_id` int(11) NOT NULL COMMENT 'رقم التسلسلي للسؤال',
  `sqo_option_text` text NOT NULL COMMENT 'نص الخيار',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_submission`
--

CREATE TABLE `survey_submission` (
  `ss_id` int(11) NOT NULL,
  `ss_u_id` int(11) NOT NULL COMMENT 'رقم المستخدم',
  `ss_s_id` int(11) NOT NULL COMMENT 'رقم الاستبيان',
  `ss_q_id` int(11) NOT NULL COMMENT 'رقم السؤال',
  `ss_sqo_option_text` int(11) NOT NULL COMMENT 'الاجابة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_target_group`
--

CREATE TABLE `survey_target_group` (
  `st_id` int(11) NOT NULL COMMENT 'رقم التسلسلي للفئة المستهدفة',
  `st_name` text NOT NULL COMMENT 'اسم الفئة المستهدفة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `ss_id` int(11) NOT NULL,
  `ss_semester_type` int(11) NOT NULL COMMENT '1: فصل اول\r\n2: فصل تاني\r\n3: فصل صيفي',
  `ss_year` text NOT NULL,
  `ss_sender` text NOT NULL,
  `ss_token` text NOT NULL,
  `ss_facebook_link` text NOT NULL,
  `ss_instagram_link` text NOT NULL,
  `ss_primary_background_color` text NOT NULL,
  `ss_primary_font_color` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`ss_id`, `ss_semester_type`, `ss_year`, `ss_sender`, `ss_token`, `ss_facebook_link`, `ss_instagram_link`, `ss_primary_background_color`, `ss_primary_font_color`, `created_at`, `updated_at`) VALUES
(1, 2, '2023', '', '', 'https://www.facebook.com/dual.ppu/', 'https://www.instagram.com/dual.ppu/', 'background-color:red;', '#ffffff', '2023-11-01 12:33:08', '2024-01-30 10:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `trainings_plans`
--

CREATE TABLE `trainings_plans` (
  `tp_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `tp_name` text DEFAULT NULL COMMENT 'اسم الخطة التدريبية',
  `tp_description` text DEFAULT NULL COMMENT 'وصف الخطة التدريبية',
  `tp_added_by` text DEFAULT NULL COMMENT 'أُضيفت الخطة التدريبية بواسطة ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'تمت إضافة الخطة التدريبية بتاريخ',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'تمت التعديل على الخطة التدريبية بتاريخ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `u_username` text NOT NULL COMMENT 'الرقم الجامعي للطلاب ، اسم المستخدم للباقي',
  `name` text NOT NULL COMMENT 'الاسم الكامل',
  `u_image` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `u_phone1` text DEFAULT NULL,
  `u_phone2` text DEFAULT NULL,
  `u_address` text DEFAULT NULL,
  `u_date_of_birth` date DEFAULT current_timestamp(),
  `u_gender` int(11) DEFAULT NULL COMMENT '0:ذكر\r\n1: انثى',
  `u_major_id` int(11) DEFAULT NULL COMMENT 'تخصص الطالب',
  `u_company_id` int(11) DEFAULT NULL COMMENT 'رقم الشركة التي يعمل بها الموظف (خاصة ب موظفين الشركة)',
  `u_role_id` int(11) NOT NULL,
  `u_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `name`, `u_image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `u_phone1`, `u_phone2`, `u_address`, `u_date_of_birth`, `u_gender`, `u_major_id`, `u_company_id`, `u_role_id`, `u_status`) VALUES
(1, 'admin', 'admin', NULL, 'admin@gmail.com', NULL, '$2y$10$TuvSiY.HRBJAsTjFoYI0IevSZoDdDS3ABDT0O.K3qs689sIZnNuOm', NULL, '2024-02-26 08:18:00', '2024-02-26 09:22:21', '1234567890', NULL, NULL, '2024-02-26', 1, NULL, NULL, 1, 1),
(2, 'امين خلاف ', 'امين خلاف ', NULL, 'abdelmajeed@jawwal.ps', NULL, '$2y$10$ilV9F5CWQanZV0uonbSwFukoZwFRdxR0SpK1rXXG4NrVHYagnt8Oy', NULL, '2024-02-26 06:25:20', '2024-02-26 09:34:45', '599276670', NULL, 'دورا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(3, 'سمية الحوامدة ', 'سمية الحوامدة ', NULL, 'summaia20102020@gmail.com', NULL, '$2y$10$I2bJJognxRVhCMqUhYrR0u0tyFCZgovEWvg/m5K2cLrd2oHhqb4cq', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-379928', NULL, 'السموع ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(4, 'عبيدة التلبيشي ', 'عبيدة التلبيشي ', NULL, 'Obaydah-ins@outlook.com', NULL, '$2y$10$oa0PafEP4Gr00t9c5LQZbO407Ewxn4O3cnp7SeZnitn8eA4oo5mnm', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0597-318885', NULL, 'يطا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(5, 'يوسف مسالمة ', 'يوسف مسالمة ', NULL, 'al.yousif.co.2020@gmail.com', NULL, '$2y$10$bGh7ADTOxns1zWna7cNGAup03KI/OWskTmYmfuAFQdiS45XTI5OTi', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-102601', NULL, 'يطا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(6, 'محمد ', 'محمد ', NULL, 'megaline.ps@gmail.com', NULL, '$2y$10$39kPNqnwJBqJLyDrvpFB8esjFo2IaKAbULOlhGV9gDq73TvVcbKEC', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0568-102077', NULL, 'يطا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(7, 'احمد مناصرة ', 'احمد مناصرة ', NULL, 'north.hebro@pal-champers.org', NULL, '$2y$10$iUJcZ1tfUA.0DtQI5q.dmOtQwheDk0MIk9mWYKsLP7c4VJxYgw5oW', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0598-888422', NULL, 'حلحول ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(8, 'فراس الشريف ', 'فراس الشريف ', NULL, 'info@universal.ps', NULL, '$2y$10$D0ozahPwlHgbI3R8I67jAeLpOshq9IzK36rjwuxGQx1fn.IcDNPs.', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:23', '0599-678166', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(9, 'احمد غازي قواسمي', 'احمد غازي قواسمي', NULL, 'info@qawasmij.com', NULL, '$2y$10$zmQxhJOWPwk2A.Fu7dxGJesjgIQ9a3mZ67n5dYDvR6ezOfs0HR/rO', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0569-222221', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(10, 'أشرف  الجعبري ', 'أشرف  الجعبري ', NULL, 'ashrafasyj@yahoo.com', NULL, '$2y$10$kwZ5Z0rRnkUPuX/PJdJta.fXw2mcthimAfeNfvDPuq/7UBdET.Xse', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-203068', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(11, 'اشرف أبو عمر', 'اشرف أبو عمر', NULL, 'bazaar-2018@hotmail.com', NULL, '$2y$10$26WErVD5/oSIiENMyVa40etJMYmf/KpwTadFOKN3Diqi64dKN.ySm', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:21', '0599-438797', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(12, 'ايهاب حسونة', 'ايهاب حسونة', NULL, 'ehabh73@yahoo.com\n', NULL, '$2y$10$sF5cUDSb3wh70cZcDyy2yuiPzzvnMiWY98XNJt6S6qxhdEtVfOE36', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-272000', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(13, 'باسل القاضي', 'باسل القاضي', NULL, '\nbasel@ppid.ps', NULL, '$2y$10$mvB51XtbhuHN1j5xKsqoee75.wEz0meyjpy1pou6jmCUY9e3.t5Fa', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-242000', NULL, 'حلحول', '2024-02-26', NULL, NULL, NULL, 6, 1),
(14, 'بلال سنقرط', 'بلال سنقرط', NULL, 'info@alnoorjewelry.com', NULL, '$2y$10$p5xNtx13GGvC30JjxFSRzOrblhTRJirCqr1HSNQuqPkqcCY6aDTHS', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-202569', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(15, 'بهاء سنقرط', 'بهاء سنقرط', NULL, 'bahaasin@hotmail.com', NULL, '$2y$10$Da0dvg79aMCbOnPlfG9X2u/JU8qag9BuOWtv0LzSUwdwyOQLtj9hO', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-319683', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(16, 'حازم التميمي', 'حازم التميمي', NULL, 'tamimico1000@yahoo.com', NULL, '$2y$10$GCXAr.rJpTktN7PcDCNPF.ZdATwEykFM6jriWFRUCX5je9Sm.aMzS', NULL, '2024-02-26 06:25:20', '2024-02-26 06:25:20', '0599-222011', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(17, 'حمدي داود', 'حمدي داود', NULL, ' ceo@crystal.ps', NULL, '$2y$10$nrwgQE.8cmPsoUcj3Vtct.2JGdfY5YJDD9xv45BvYamXe8JgrQeiC', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-999646', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(18, 'رامي النتشة', 'رامي النتشة', NULL, 'designrami@gmail.com', NULL, '$2y$10$2taklbihjY5yLgezAVS.UuT.dsQJjF7iadu4O6IpF/NYwGB5JSvpu', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-649178', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(19, 'صادق نيروخ', 'صادق نيروخ', NULL, 'sadeq@taqaddom.com\n', NULL, '$2y$10$mWC7lU5LnP..u6xGDCbAM.wA.WVOzTyTFO1XkQRsJ5T08BsEN48u2', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-210601', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(20, 'صفوت الحرباوي', 'صفوت الحرباوي', NULL, 'info@al-ahlia.ps', NULL, '$2y$10$.4.TyZM3q7i.Y1qfYcS7c.9wagKiCehXDLDtWnBzdO7nzv3xDlVMW', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0595-806666', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(21, 'عامر العسيلي', 'عامر العسيلي', NULL, 'osailyitc.ps@gmail.com\n', NULL, '$2y$10$ColsFTFooNVX6UrHd5d8W.C9qXyhA2BieOuGJuHnfoZxDvSTzOtTq', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-390390', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(22, 'عبد الله شويكي', 'عبد الله شويكي', NULL, 'sbic_co@yahoo.com', NULL, '$2y$10$54sJHirHUID/AJcSQMEdIOcX5kqOMczr1JhLPwcg0wBISrrlwNGpu', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-828451', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(23, 'عيسى النتشة', 'عيسى النتشة', NULL, 'taifead@live.com', NULL, '$2y$10$GE4hTTowW1FHTKnuuV3nsekddxx17TzdNErOEs.10AlM2Kjy7KouK', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-870011', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(24, 'فايز العملة', 'فايز العملة', NULL, '\ninfo@tblock.ps', NULL, '$2y$10$0yw0..LmbYsWV0qyyzDQfeTLd9y0BmZ3z69F7lvPic17lMbKpCjlK', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0569-214840', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(25, 'ماهر الفاخوري', 'ماهر الفاخوري', NULL, 'maher172@hotmail.com', NULL, '$2y$10$IdoJGZ3tx0CfOpo1TWjOweM/hAlqc5qpc4oWjArHEEKMpEQkETeye', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '\n0569-292705', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(26, 'محسن  زلوم', 'محسن  زلوم', NULL, 'mohsen@mzalloum.com', NULL, '$2y$10$Qtb4Xr0ZiaMmchQeRkCkeOfyPOfjm406uf4hhmSlgujvvR3qOXREi', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-401301', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(27, 'محمد مسوده ', 'محمد مسوده ', NULL, 'ossama72m@yahoo.com', NULL, '$2y$10$wxaLLOfQHfg7nH6iTWTzEem19ygN459HjrZCl/7k6NtylTCAuP/K.', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-333030', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(28, 'محمود اشهب', 'محمود اشهب', NULL, 'mahmoud@petromall.ps', NULL, '$2y$10$JNJiOw1TORXIENZniCN0Wu2Xk5XVwlue5bQDnA1HQZg/Q1TumZZUG', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-299324', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(29, 'محمود  سنقرط', 'محمود  سنقرط', NULL, 'Mavi.solution@gmail.com', NULL, '$2y$10$hHquzMbP5iR0jqlUgS1ZyeJdr5Z8wf1l091l6QRHDbS.anLGEn19K', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0569-032052', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(30, 'منذر أبو منشار', 'منذر أبو منشار', NULL, 'munther@abumunshar.com', NULL, '$2y$10$HZi6CBun.QvzysbD9m1ozujToUn7WA6siSNLZfWfDAXJMObg8Qj9y', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-224060', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(31, 'هيثم الشماس', 'هيثم الشماس', NULL, 'haytham@crownsystem.co', NULL, '$2y$10$.kI3qcN2.EVMSrvTN9Ia8eMyO5lvY6ihonNkTCLEqfNHycZvktrJi', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0569-373333', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(32, 'رزان العويوي', 'رزان العويوي', NULL, 'beautymare 005 @gmail.com', NULL, '$2y$10$hHO/MHvATaOUjAvS81oiS.xFNk5N/DtxGZT1zjbXe8ED44ERkD2EK', NULL, '2024-02-26 06:25:21', '2024-02-26 06:25:21', '0599-999600', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(33, 'سعد جرادات', 'سعد جرادات', NULL, 'saedjaradat@gmail.com', NULL, '$2y$10$ItoO98pNG6wMS9Veqpo0we7G8Adx7AzpemYr9YMhdU/z8WolIdnP.', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-508666', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(34, 'رانيا ', 'رانيا ', NULL, 'rania@abdoinsurance.com', NULL, '$2y$10$k5InVY7HeaaWmsbjpVtx0egW5Wtdtan3AG4.qFBhfU2DX.2ljI/fa', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-498833', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(35, 'عماد الرجوب ', 'عماد الرجوب ', NULL, 'imad@royal.ps', NULL, '$2y$10$l6m2vrnv.YBUQT.Fja09nOsgbaiaNlAskq9zwkEO6qOgbgkSnyV3y', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-340226', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(36, 'ضياء القواسمي', 'ضياء القواسمي', NULL, 'diyaaqawasmeh@gmail.com', NULL, '$2y$10$sgP3pB06lXZEHHghHlbn4uie5vLXXOAfwhvv4nM8Tqzbb9n4ecZfy', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-035205', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(37, 'جلال الزغل ', 'جلال الزغل ', NULL, 'info@raz.ps', NULL, '$2y$10$eVnlifN6RzC8iuJjKCtsOuoayFoaFUrp1G/Oaq.d0rmeA1VFE1hV2', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-274286', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(38, 'قصي السعافين ', 'قصي السعافين ', NULL, 'info@supertex.ps', NULL, '$2y$10$0N6g/3wGlazFW8vkzFsnq.Nb/SCjkUsh0mjhy7Ke//qKARHyPGosG', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-991992', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(39, 'علاء دعنا ', 'علاء دعنا ', NULL, 'alaa@alwakeel.ps', NULL, '$2y$10$y6wC4WHkVRqwL/J58Q.o/.mp6N4nj5xZXO7iETCDHrT4VLjwbCMLC', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0597-877000', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(40, 'فادي الجعبري ', 'فادي الجعبري ', NULL, 'fade_aljabari_2006@hotmail.com', NULL, '$2y$10$fOVw78./zTH8nDcdZrZ4PePpNeMx5TvoT2b70IawLCLlPJqn4B6VG', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0598-123620', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(41, 'رجائي مسودة / عبد الرحيم ابو حديد ', 'رجائي مسودة / عبد الرحيم ابو حديد ', NULL, 'hadeid_a@hotmail.com ', NULL, '$2y$10$hhUnaHnNb9vTEcjoOMwMAeb8/X01X1GghF2.mYITv9pTfMP1pG7i2', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0598-741754', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(42, 'فادي مظلوم ', 'فادي مظلوم ', NULL, 'fadi.mazloom@qudsbank.ps', NULL, '$2y$10$Dom2QduTMiip5PNJ.WZj5uM/BbmdVVjoi2NSnXkAlBw9vfWA.Vev2', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0568-278888', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(43, 'محمد مصطفى ', 'محمد مصطفى ', NULL, 'marketing@pic-pal.ps', NULL, '$2y$10$UN.8g3.Z5/EKtp4EDTvRfO/SLPWpomS6yAGkEpuQ4zeZslMQmGhii', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0594-550218', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(44, 'بشرى الشريف ', 'بشرى الشريف ', NULL, 'B.sharif@palpay.ps', NULL, '$2y$10$70iIHf0k1.5F//hrFB8PHeLNVH2HDDi6T/1N0OOYGVkIde.9M08M6', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0568-848026', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(45, 'فارس مجاهد / مروة ابو علان ', 'فارس مجاهد / مروة ابو علان ', NULL, 'gm@selco.ps / a.marwa@selco.ps', NULL, '$2y$10$yOiWz7x7g3l9TsszfqQbDOpqqkQHiP8Tt4jLISoC5OMgXKqE4dtni', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0592-777000 / 0595-044877', NULL, 'دورا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(46, 'وفاء الجنيدي', 'وفاء الجنيدي', NULL, 'wafa.aljuneidi@wpi.ps', NULL, '$2y$10$zm7UpCgmmY.bm54wJn/MO.t7QNZPwd2nYx8FWbAbebzRNnpLW82UO', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0598-939291', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(47, 'نهاية عوضات ', 'نهاية عوضات ', NULL, 'nawadat@nbc-pal.com', NULL, '$2y$10$/aMW0FWcLLg/KeZhrfblR.ugQnDce9t7Itgh1iuVveH6cKRDbe14m', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0594-430339', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(48, 'رنا عوض ', 'رنا عوض ', NULL, 'rana.awad@jawwal.ps', NULL, '$2y$10$H64dVazKQIbOTIclIlKGAuwSvKvfYJFPENkEnrwD1vHKE0aiJwFoG', NULL, '2024-02-26 06:25:22', '2024-02-26 06:25:22', '0599-000864', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(49, 'حلمي الحرباوي ', 'حلمي الحرباوي ', NULL, 'hithelmi@gmail.com', NULL, '$2y$10$XcsmkZ9o1xvxgy8clI7Lxu.Ef9Rx/MVkCVHk4GZz1q9s5do5sKawy', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0562-331335', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(50, 'احمد ديرية ', 'احمد ديرية ', NULL, 'hr@al-jebrini.com', NULL, '$2y$10$FMvwQ.5KgpjPLrNn2jnw9.YXdBoUIpRIt3TD6HsRg3FX3DpHVNVj6', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0568-226000', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(51, 'امل وزوز ', 'امل وزوز ', NULL, 'gmassistant@aljuneidi.com', NULL, '$2y$10$SkezP.iIqrAwOiL1aU.pMO1QIg7tSN2gZL.mzkKti1RgFHRRGGPBS', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0595-260002', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(52, 'مروان المختار ', 'مروان المختار ', NULL, 'marwan.mokhtar@shamsuna.ps', NULL, '$2y$10$FpN7pn0PGluym/rv2XqVQ.oIwJil1.vcoxNwAKWEr5iMpJLEHytXC', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0599-764900', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(53, 'وائل نيروخ ', 'وائل نيروخ ', NULL, 'waelsecand@gmail.com', NULL, '$2y$10$016KNw/dCqPwdu40/oXCTupwLqtlmdZtnOaO63I01v/.qdhdJJhEO', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0597-257000', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(54, 'رغيد القواسمي ', 'رغيد القواسمي ', NULL, 'ragheed.q@gmail.com', NULL, '$2y$10$Mqs61cNHfOcFZ316O3jnHepz.P.r8e21hqeMRWb.MXGMNJ/JfKUv2', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0599-110417', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(55, 'فاطمة القاضي ', 'فاطمة القاضي ', NULL, 'fatima.qadi@madfooat.ps', NULL, '$2y$10$2j/7qkAPjEgiRN5NQkQrEuxT6x5q0JzrrvmL3TPzEg9.MHEcK6/9y', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0594-266100', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(56, 'عبد الله النتشة ', 'عبد الله النتشة ', NULL, 'abdallah@alsalamgroup.com', NULL, '$2y$10$56pr2F7NlVvr/nQV4rwoXeh0KHvBYvl2VeFDyEDzRRyYdEclW7ene', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0599-034039', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(57, 'غسان عليان ', 'غسان عليان ', NULL, 'golayan@yahoo.com', NULL, '$2y$10$dQFmTmvZ0DDcpBBm/SzhKOxOJqxTX/WARcCCaV885cf7C9/sVklfW', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0592-265001', NULL, 'بيت لحم / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(58, 'روان امسيح ', 'روان امسيح ', NULL, 'rawani@bisan.com', NULL, '$2y$10$pRW.yL2orcLAfKm.muMlqegxMSGQPqiVqzz9airVl8EluFyC0lZEW', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0597-270493', NULL, 'رام الله  ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(59, 'رولا عوايص ', 'رولا عوايص ', NULL, 'rola@acad.ps', NULL, '$2y$10$/EFYdjgLl1REfLU/w2zE2uAeCoXNI0Kyyl6wcw3.C129TIZOK81oy', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0562-600400', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(60, 'جواد الطويل ', 'جواد الطويل ', NULL, 'jawad@ppiu.ps', NULL, '$2y$10$6v/M1OnIcp7ZSm.iPeUSne138sVOjuVBo8HhjSPdHRa7iHpJN2wLa', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0599-211098', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(61, 'يوسف دبابسة ', 'يوسف دبابسة ', NULL, 'aboyousefe@hotmail.com', NULL, '$2y$10$zYuZbJYZJ5tgwWq13Ofpz.FFjBuEltOlVak5q0i8uFdjfaCdjWbNK', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0568-264799', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(62, 'مالك ابو الفيلات ', 'مالك ابو الفيلات ', NULL, 'malek@tahaluf.ps', NULL, '$2y$10$beU/.8TOIBM4qDFZLLH.Xespauv.9zxkkCDDnm7Swz16BsmJ4vd/e', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0000000000', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(63, 'نورا طميزي ', 'نورا طميزي ', NULL, 'nouratomize@gmail.com', NULL, '$2y$10$ryYk.nlA4FH6.mJ6lqh3mulc9Xzogqq5MJsmjXkkVQIy/D1Za.N36', NULL, '2024-02-26 06:25:23', '2024-02-26 06:25:23', '0568-390700', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(64, 'معتز القواسمي ', 'معتز القواسمي ', NULL, 'info@infinity.ps', NULL, '$2y$10$p5xv0vYKr0ULFBjEivvD7e3bYws972j/q/ylShAsAAhhmKhxWvZSu', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0598-909800', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(65, 'حنين ', 'حنين ', NULL, 'hanin.kh@faten.org', NULL, '$2y$10$24sDuI/fnyjuRpTW5OjKIeqfz6xDlg2kZqd1WA398jX9HTag04k5e', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0000000000', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(66, 'سامح الجعبري', 'سامح الجعبري', NULL, 'samehjabari@gmail.com', NULL, '$2y$10$iZRVP3bvxnm9DLMsyOoV6uu3UT0u4enwKrvpXKQbV54gLwyhhNXX2', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0599-849632', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(67, 'فادي الشعبة ', 'فادي الشعبة ', NULL, 'fadi.alshubi@islamicbank.ps', NULL, '$2y$10$OhD1n6fIh83D6p6yd8p.CufhKb6VFNZLNsjGyPNCQY71Rm/U/O8tW', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0598-242683', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(68, 'علي الجعبة', 'علي الجعبة', NULL, 'alijopar@gmail.com', NULL, '$2y$10$9FWTyujA/GYGDxN00BfAzOoPL/pHsW1T2/822hqMa2xR.aPxgQdny', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0000000000', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(69, 'عبد الحميد سليمية ', 'عبد الحميد سليمية ', NULL, 'info@toplines.ps', NULL, '$2y$10$F/lK1AD7ffcEai9/1vVkqOI078WA430tCgCbgtkLfn6De8SoL/Ap6', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0599-675378', NULL, 'الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(70, 'احمد البرنسي ', 'احمد البرنسي ', NULL, 'a.hijawi@qudra.ps / rezeq.direya@qudra.ps', NULL, '$2y$10$YVqoVTnxp88qGE5d4l3Hp.seEifT6XD0yCdlWEdqw4iixScyoEP2G', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0562-171833', NULL, 'رام الله ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(71, 'ملك شريتح / ابراهيم عيسى ', 'ملك شريتح / ابراهيم عيسى ', NULL, 'malak.shreteh@palijara.com / ibrahimt.issa@palijara.com', NULL, '$2y$10$apd7CONiKPxvSKYAVLfTdO2JzXpIH6/mLSHpfhwXxmObjWu6nwePe', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0000000000', NULL, 'رام الله / الخليل ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(72, 'عمر البدارين ', 'عمر البدارين ', NULL, 'info@samou.ps', NULL, '$2y$10$mB1ManNou39BfIv8OQ1yf.4OUnO9a8UdLRL/j8a0vDWFx2QCva9W6', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0598-933933', NULL, 'السموع ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(73, 'عدنان الرجوب ', 'عدنان الرجوب ', NULL, 'adnanrjoub2022@gmail.com', NULL, '$2y$10$NRj/63e1h2ZV.8.EdvB87ebSKmekeE1ONobS9g8xBMPIfcPADQGHi', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0000000000', NULL, 'دورا ', '2024-02-26', NULL, NULL, NULL, 6, 1),
(74, 'هاني الزرو', 'هاني الزرو', NULL, 'madsamir2006@gmail.com', NULL, '$2y$10$DhWmjD2hOX4hMFh4YRRddeD.mFBHG8.fA6oVulg2y8DAWRfW.pJE2', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0599-110707', NULL, 'الخليل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(75, 'جهاد شاهين /احمد طيطي', 'جهاد شاهين /احمد طيطي', NULL, 'design@shaheencom.com', NULL, '$2y$10$0VlHXSQBqR4HlO4d7JmpVOoac65mIFc8DiJpX6F99ohfoY8.y2Ui2', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '0597918004/0568918005', NULL, 'الخليل/سنجر', '2024-02-26', NULL, NULL, NULL, 6, 1),
(76, 'فيصل ابو حديد', 'فيصل ابو حديد', NULL, 'samer_qwa@hotmail.com', NULL, '$2y$10$VczwL9gTMlHq/4eZCXWBjuYQSsIMZguo5Wx/O6lzquMUbkgNg1m3S', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '599046375', NULL, 'الخليل/بيت عينون', '2024-02-26', NULL, NULL, NULL, 6, 1),
(77, 'صفوان صلاح', 'صفوان صلاح', NULL, 'salahsafwan@gmail.com', NULL, '$2y$10$NfnmWHUNxDy9l97HzT0r/OD/WsDnOACK2mfXfh3omub5Tjaq2Ba1G', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '593555529', NULL, 'الخليل/الضاحية', '2024-02-26', NULL, NULL, NULL, 6, 1),
(78, 'اسماعيل رضوان/ابو محمد', 'اسماعيل رضوان/ابو محمد', NULL, 'waseem@super-nimer.com', NULL, '$2y$10$ak46TDpjFyLGH6QvQbyJr.PPpJXROh5HtStT55TRR4qcYvUFXVhPa', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '599522065', NULL, 'بيت اولا/المنطقة الصناعية', '2024-02-26', NULL, NULL, NULL, 6, 1),
(79, 'عماد ارفاعية/عبد الله ابو اسنينة', 'عماد ارفاعية/عبد الله ابو اسنينة', NULL, 'abdallahsuliman@1990@gmail.com', NULL, '$2y$10$qrxXBxzkUaOMmoBMe6fgU.w8ZdwEelI7E4WwendvqE56KZwOQ1teq', NULL, '2024-02-26 06:25:24', '2024-02-26 06:25:24', '598882161', NULL, 'الخليل/نمره', '2024-02-26', NULL, NULL, NULL, 6, 1),
(80, 'بهاء حسونه', 'بهاء حسونه', NULL, 'm.hr@zmzmco.com', NULL, '$2y$10$ZSAfVUd3dqWnVp7hYVQEheQsJFMU0IvH29x3RVGKIKmiiEdEUP8N2', NULL, '2024-02-26 06:25:25', '2024-02-26 06:25:25', '569380000', NULL, 'الخليل/بيت كاحل', '2024-02-26', NULL, NULL, NULL, 6, 1),
(81, 'EzdeharJwabreh', 'Ezdehar Jwabreh', '', 'EzdeharJwabreh@ppu.edu.ps', NULL, '$2y$10$23Eppv713X9fanaEX2g8xuxaYPNSCHYzPEeZr2sEt5AJ68/RLTATm', NULL, '2024-02-26 09:24:49', '2024-02-26 09:24:49', '0592654115', NULL, 'Hebron', '1999-05-05', 1, NULL, NULL, 3, 1),
(82, 'mazen', 'Mazen Zalloum', NULL, 'mazen@ppu.edu.ps', NULL, '$2y$10$OucJ9AmjCMYL9bwRzRy0muI1RL4W5EHINM5h5xVPocBBAdanuvLYC', NULL, '2024-02-26 09:29:38', '2024-02-26 09:29:38', '0599999999', NULL, 'hebron', '2024-02-26', 0, NULL, NULL, 4, 1),
(83, 'Ayman', 'Ayman Sultan', NULL, 'Ayman@ppu.edu.ps', NULL, '$2y$10$ilV9F5CWQanZV0uonbSwFukoZwFRdxR0SpK1rXXG4NrVHYagnt8Oy', NULL, '2024-02-26 09:31:50', '2024-02-26 09:31:50', '0596222355', NULL, 'Hebron', '2024-02-26', 0, NULL, NULL, 5, 1),
(84, '179033', 'Reem Herbawi', NULL, '179033@ppu.edu.ps', NULL, '$2y$10$dxh.H71bgCD/TuYIptzU.u5u/oXfUqf0oCnje53hGEnq/sRUrWVUW', NULL, '2024-02-26 09:37:48', '2024-02-26 09:37:48', '0568619702', '', 'hebron', '2024-02-26', NULL, NULL, NULL, 0, 1),
(85, '', '', NULL, '', NULL, '', NULL, '2024-02-26 09:37:48', '2024-02-26 09:37:48', NULL, NULL, NULL, '2024-02-26', 1, 3, NULL, 2, 1),
(86, 'mohamadher', 'Mohamad Herbawi', NULL, 'mohamadher@ppu.edu.ps', NULL, '$2y$10$/wjC6vC84cuSdY1.v.tZxeBjtxRmnSrKMsJuVoEXBDk3THq6UI/NG', NULL, '2024-02-26 09:40:58', '2024-02-26 09:40:58', '0599999999', NULL, 'hebron', '2024-02-26', 0, NULL, NULL, 8, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `companies_categories`
--
ALTER TABLE `companies_categories`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `company_branches`
--
ALTER TABLE `company_branches`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `company_branches_departments`
--
ALTER TABLE `company_branches_departments`
  ADD PRIMARY KEY (`cbd_id`);

--
-- Indexes for table `company_branches_locations`
--
ALTER TABLE `company_branches_locations`
  ADD PRIMARY KEY (`bl_id`);

--
-- Indexes for table `company_departments`
--
ALTER TABLE `company_departments`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fcm_registration_tokens`
--
ALTER TABLE `fcm_registration_tokens`
  ADD PRIMARY KEY (`frt_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `major_supervisors`
--
ALTER TABLE `major_supervisors`
  ADD PRIMARY KEY (`ms_id`);

--
-- Indexes for table `mentors_companies`
--
ALTER TABLE `mentors_companies`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `semester_courses`
--
ALTER TABLE `semester_courses`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `students_attendance`
--
ALTER TABLE `students_attendance`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `students_companies`
--
ALTER TABLE `students_companies`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `student_reports`
--
ALTER TABLE `student_reports`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `supervisor_assistants`
--
ALTER TABLE `supervisor_assistants`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`sq_id`);

--
-- Indexes for table `survey_question_options`
--
ALTER TABLE `survey_question_options`
  ADD PRIMARY KEY (`sqo_id`);

--
-- Indexes for table `survey_submission`
--
ALTER TABLE `survey_submission`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `survey_target_group`
--
ALTER TABLE `survey_target_group`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexes for table `trainings_plans`
--
ALTER TABLE `trainings_plans`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي', AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `companies_categories`
--
ALTER TABLE `companies_categories`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `company_branches`
--
ALTER TABLE `company_branches`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي', AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `company_branches_departments`
--
ALTER TABLE `company_branches_departments`
  MODIFY `cbd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_branches_locations`
--
ALTER TABLE `company_branches_locations`
  MODIFY `bl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_departments`
--
ALTER TABLE `company_departments`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fcm_registration_tokens`
--
ALTER TABLE `fcm_registration_tokens`
  MODIFY `frt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `major_supervisors`
--
ALTER TABLE `major_supervisors`
  MODIFY `ms_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentors_companies`
--
ALTER TABLE `mentors_companies`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `semester_courses`
--
ALTER TABLE `semester_courses`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_attendance`
--
ALTER TABLE `students_attendance`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `students_companies`
--
ALTER TABLE `students_companies`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `student_reports`
--
ALTER TABLE `student_reports`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisor_assistants`
--
ALTER TABLE `supervisor_assistants`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'الرقم التسلسلي';

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `sq_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'الرقم التسلسلي للسؤال';

--
-- AUTO_INCREMENT for table `survey_question_options`
--
ALTER TABLE `survey_question_options`
  MODIFY `sqo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'الرقم التسلسلي لخيار السؤال';

--
-- AUTO_INCREMENT for table `survey_submission`
--
ALTER TABLE `survey_submission`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_target_group`
--
ALTER TABLE `survey_target_group`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم التسلسلي للفئة المستهدفة';

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trainings_plans`
--
ALTER TABLE `trainings_plans`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
