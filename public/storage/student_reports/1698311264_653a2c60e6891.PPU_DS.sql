-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2023 at 01:48 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PPU_DS`
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
  `c_user_id` int(11) DEFAULT NULL COMMENT 'رقم المستخدم',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies_categories`
--

CREATE TABLE `companies_categories` (
  `i_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `i_name` text NOT NULL COMMENT 'اسم تصنيف الشركة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies_employees`
--

CREATE TABLE `companies_employees` (
  `ce_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `ce_branch_id` int(11) DEFAULT NULL COMMENT 'رقم فرع الشركة',
  `ce_user_id` int(11) DEFAULT NULL COMMENT 'رقم المستخدم',
  `ce_company_id` int(11) DEFAULT NULL COMMENT 'رقم الشركة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_branches`
--

CREATE TABLE `company_branches` (
  `b_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `b_company_id` int(11) NOT NULL COMMENT 'رقم الشركة',
  `b_address` text NOT NULL COMMENT 'عنوان فرع الشركة',
  `b_phone1` text NOT NULL COMMENT 'رقم هاتف الشركة ، الرقم الأول',
  `b_phone2 (text)` text NOT NULL COMMENT 'رقم هاتف الشركة ، الرقم الثاني',
  `b_main_branch` int(11) NOT NULL COMMENT 'هل هو فرع رئيسي أم لا؟',
  `b_manager_id` int(11) NOT NULL COMMENT 'رقم المدير',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_branches_locations`
--

CREATE TABLE `company_branches_locations` (
  `bl_id` int(11) NOT NULL,
  `bl_branch_id` int(11) DEFAULT NULL,
  `bl_longitude` text DEFAULT NULL,
  `bl_latitude` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_departments`
--

CREATE TABLE `company_departments` (
  `d_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `d_name` text DEFAULT NULL,
  `company_branch_department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'تمت إضافة المساق بتاريخ',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'تم التعديل على معلومات المساق بتاريخ',
  `c_reference_code` text NOT NULL COMMENT 'الرمز المرجعي للمساق'
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `m_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `m_name` text NOT NULL COMMENT 'اسم التخصص',
  `m_description` text NOT NULL COMMENT 'وصف التخصص',
  `m_reference_code` text NOT NULL COMMENT 'الرمز المرجعي للتخصص',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `major_supervisors`
--

CREATE TABLE `major_supervisors` (
  `ms_id` int(11) NOT NULL,
  `ms_super_id` int(11) NOT NULL,
  `ms_major_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentors_companies`
--

CREATE TABLE `mentors_companies` (
  `mc_id` int(11) NOT NULL,
  `mc_company_employees_id` int(11) DEFAULT NULL,
  `mc_student_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `p_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `p_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `p_company_id` int(11) NOT NULL COMMENT 'رقم الشركة',
  `p_reference_id` int(11) NOT NULL,
  `p_payment_value` double NOT NULL COMMENT 'قيمة المبلغ المدفوع',
  `p_file` text NOT NULL COMMENT 'ملف',
  `p_inserted_by_id` int(11) NOT NULL COMMENT 'تمت الإضافة بواسطة',
  `p_insert_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'تمت الإضافة بتاريخ',
  `p_notes` text NOT NULL COMMENT 'ملاحظات',
  `p_status` int(11) NOT NULL COMMENT 'الحالة',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `r_year` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `r_name` text NOT NULL COMMENT 'اسم الدور',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses`
--

CREATE TABLE `semester_courses` (
  `sc_id` int(11) NOT NULL,
  `sc_course_id` int(11) NOT NULL,
  `sc_semester_id` int(11) NOT NULL,
  `sc_supervisor_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses_assistants`
--

CREATE TABLE `semester_courses_assistants` (
  `sca_id` int(11) NOT NULL,
  `sca_semester_course_id` int(11) NOT NULL,
  `sca_assistant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_attendance`
--

CREATE TABLE `students_attendance` (
  `sa_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `sa_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `sa_student_company_id` int(11) NOT NULL COMMENT 'رقم الشركة التي يتدرب لديها الطالب',
  `sa_start_time_latitude` text NOT NULL COMMENT 'خط العرض عند تسجيل الحضور للشركة',
  `sa_start_time_longitude` text NOT NULL COMMENT 'خط الطول عند تسجيل الحضور للشركة',
  `sa_end_time_longitude` text NOT NULL COMMENT 'خط الطول عند تسجيل المغادرة للشركة',
  `sa_end_time_latitude` text NOT NULL COMMENT 'خط العرض عند تسجيل المغادرة للشركة',
  `sa_description` text NOT NULL COMMENT 'وصف',
  `sa_in_time` datetime NOT NULL COMMENT 'وقت الحضور',
  `sa_out_time` datetime NOT NULL COMMENT 'وقت المغادرة',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_companies`
--

CREATE TABLE `students_companies` (
  `sc_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `sc_student_id` int(11) NOT NULL COMMENT 'رقم الطالب',
  `sc_branch_id` int(11) NOT NULL COMMENT 'رقم فرع الشركة التي يتدرب بها الطالب',
  `sc_department_id` int(11) NOT NULL COMMENT 'رقم دائرة الشركة',
  `sc_status` int(11) NOT NULL COMMENT 'حالة التدريب (ما زال يتدرب ام خرج)',
  `sc_agreement_file` text NOT NULL COMMENT 'ملف الموافقة على تدريب الطالب في الشركة',
  `sc_mentor_trainer_id` int(11) NOT NULL COMMENT 'رقم المدرب الموجود في الشركة',
  `sc_assistant_id` int(11) NOT NULL COMMENT 'رقم مساعد المشرف الموجود في الجامعى',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_reports`
--

CREATE TABLE `student_reports` (
  `s_id` int(11) NOT NULL,
  `s_student_attendance_id` int(11) NOT NULL,
  `s_report_text` text NOT NULL,
  `s_attached_file` text NOT NULL,
  `sr_student_id` int(11) NOT NULL,
  `sr_notes` text NOT NULL,
  `sr_submit_longitude` text NOT NULL,
  `sr_submit_latitude` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_assistants`
--

CREATE TABLE `supervisor_assistants` (
  `sa_id` int(11) NOT NULL,
  `sa_supervisor_id` int(11) NOT NULL,
  `sa_assistant_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `ss_id` int(11) NOT NULL,
  `ss_semester_type` int(11) NOT NULL,
  `ss_year` int(11) NOT NULL,
  `ss_sender` text NOT NULL,
  `ss_token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainings_plans`
--

CREATE TABLE `trainings_plans` (
  `tp_id` int(11) NOT NULL COMMENT 'رقم تسلسلي',
  `tp_name` text DEFAULT NULL COMMENT 'اسم الخطة التدريبية',
  `tp_description` text DEFAULT NULL COMMENT 'وصف الخطة التدريبية',
  `tp_added_by` text DEFAULT NULL COMMENT 'أُضيفت الخطة التدريبية بواسطة ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'تمت إضافة الخطة التدريبية بتاريخ',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'تمت التعديل على الخطة التدريبية بتاريخ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `companies_employees`
--
ALTER TABLE `companies_employees`
  ADD PRIMARY KEY (`ce_id`);

--
-- Indexes for table `company_branches`
--
ALTER TABLE `company_branches`
  ADD PRIMARY KEY (`b_id`);

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
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`e_id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`p_id`);

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
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `supervisor_assistants`
--
ALTER TABLE `supervisor_assistants`
  ADD PRIMARY KEY (`sa_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `companies_categories`
--
ALTER TABLE `companies_categories`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `companies_employees`
--
ALTER TABLE `companies_employees`
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `company_branches`
--
ALTER TABLE `company_branches`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

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
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

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
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';

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
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisor_assistants`
--
ALTER TABLE `supervisor_assistants`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainings_plans`
--
ALTER TABLE `trainings_plans`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'رقم تسلسلي';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
