-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 08:27 PM
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
-- Database: `manage_dreamlockmr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Profile` text DEFAULT NULL,
  `user_type` text DEFAULT NULL,
  `phone_no` text DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `Profile`, `user_type`, `phone_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ankit Saini', 'ankit@gmail.com', '$2y$10$xkTOdiTEVKyy1bOHdupnOOBvUKDMIiWH/PVx87sHnamlHREGSwNHm', 'aca07157dd2f072bf6b3f722c614d795.png', NULL, '343444343434', 1, NULL, '2024-12-03 17:57:48'),
(2, 'admin', 'admin@gmail.com', '$2y$10$Dtr3aIR6lTIfsNRJKIpxVOTMpr9ZaonYNCbnCNWrq2XE5rxpxLHmO', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Hemant ', 'hemant@gmail.com', '$2y$12$QGVC5cnfzVm2Pt.MnqaiOO/1oqB1zrsktb48V9aaep4mSd3oQ.pK2', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Absent',
  `punch_out` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `status`, `punch_out`, `created_at`, `updated_at`) VALUES
(2, 39, '2024-12-13', 'Present', '2024-12-16 09:40:14', '2024-12-13 09:52:08', '2024-12-13 12:26:30'),
(3, 39, '2024-12-14', 'Present', '2024-12-16 09:40:14', '2024-12-13 13:20:58', '2024-12-14 12:54:18'),
(5, 39, '2024-12-16', 'Present', '2024-12-16 09:59:26', '2024-12-16 10:36:04', '2024-12-16 10:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `attendence_deatails`
--

CREATE TABLE `attendence_deatails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `salary_id` bigint(20) UNSIGNED DEFAULT NULL,
  `month` varchar(7) NOT NULL,
  `working_days` int(11) NOT NULL DEFAULT 0,
  `leave_days` int(11) NOT NULL DEFAULT 0,
  `half_days` int(11) NOT NULL DEFAULT 0,
  `total_salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pay_status` varchar(255) NOT NULL DEFAULT '0',
  `bonus_salary` varchar(255) DEFAULT NULL,
  `bonus_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendence_deatails`
--

INSERT INTO `attendence_deatails` (`id`, `user_id`, `salary_id`, `month`, `working_days`, `leave_days`, `half_days`, `total_salary`, `pay_status`, `bonus_salary`, `bonus_name`, `created_at`, `updated_at`) VALUES
(2, 39, 2, '2024-12', 3, 0, 0, 1100.97, '1', '30', 'add more', '2024-12-13 09:52:08', '2024-12-17 13:19:15');

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
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_reason` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type`, `start_date`, `end_date`, `leave_reason`, `status`, `approved_by`, `approved_at`, `created_at`, `updated_at`) VALUES
(1, 39, 'Sick Leave', '2024-12-18', '2024-12-19', 'done', 0, NULL, NULL, '2024-12-19 12:33:07', '2024-12-19 13:55:54'),
(2, 37, 'Earned Leave', '2024-12-20', '2024-12-13', 'done', 2, NULL, NULL, '2024-12-19 12:33:07', '2024-12-19 13:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_08_04_114953_create_permission_tables', 1),
(19, '2024_12_08_084151_create_attendances_table', 2),
(32, '2024_12_12_123457_create_salaries_table', 3),
(33, '2024_12_12_125830_create_attendence_deatails_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 25),
(4, 'App\\Models\\User', 9),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 26),
(4, 'App\\Models\\User', 27),
(6, 'App\\Models\\User', 39),
(7, 'App\\Models\\User', 8),
(7, 'App\\Models\\User', 14);

-- --------------------------------------------------------

--
-- Table structure for table `office_ips`
--

CREATE TABLE `office_ips` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT 'Office IP',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_ips`
--

INSERT INTO `office_ips` (`id`, `ip`, `Address`, `created_at`, `updated_at`) VALUES
(5, '127.0.0.1', 'Office IP', '2024-12-13 16:35:00', '2024-12-14 19:04:18');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'add_users', 'web', '2024-11-23 10:55:11', '2024-11-24 01:53:06'),
(3, 'edit_users', 'web', '2024-11-23 10:55:12', '2024-11-23 10:55:12'),
(4, 'delete_users', 'web', '2024-11-23 10:55:12', '2024-11-23 10:55:12'),
(5, 'manage_roles', 'web', '2024-11-23 10:55:13', '2024-11-23 10:55:13'),
(6, 'manage_permissions', 'web', '2024-11-23 10:55:13', '2024-11-23 10:55:13');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Associate', 'admin', '2024-11-23 04:32:51', '2024-11-27 13:22:15'),
(2, 'Senior Associate', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(3, 'SPOC', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(4, 'HR', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(5, 'Manager', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(6, 'Team Leader', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(7, 'Project Manager', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(8, 'Operation Head', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(9, 'Sales Head', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(10, 'Supply Manager', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51'),
(11, 'Office boy', 'admin', '2024-11-23 04:32:51', '2024-11-23 04:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month` varchar(7) NOT NULL,
  `salary` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `user_id`, `month`, `salary`, `created_at`, `updated_at`) VALUES
(2, 39, '2024-12', 9000, '2024-12-13 09:52:08', '2024-12-17 13:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_email` varchar(255) NOT NULL,
  `site_contact` varchar(255) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `site_fav_icon` varchar(100) DEFAULT NULL,
  `site_logo` varchar(100) DEFAULT NULL,
  `AID` varchar(255) DEFAULT NULL,
  `anugapty_name_snstha` varchar(255) DEFAULT NULL,
  `anugapty_no` varchar(255) DEFAULT NULL,
  `anugapty_state` varchar(255) DEFAULT NULL,
  `anugapty_phone` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `insta_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `youtub_url` varchar(255) DEFAULT NULL,
  `linkdin_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_email`, `site_contact`, `site_address`, `site_fav_icon`, `site_logo`, `AID`, `anugapty_name_snstha`, `anugapty_no`, `anugapty_state`, `anugapty_phone`, `facebook_url`, `insta_url`, `twitter_url`, `youtub_url`, `linkdin_url`, `updated_at`, `created_at`) VALUES
(1, 'Ankit Saini', 'ankit@gmail.com', 'Ankit Saini', 'Sambhar Lake', '4f95b2e2218e52073581ac81066b73a4.jpg', 'bbb4e7d396a64ab7217db1297aae1288.jpg', '323232323', '3232323', '32323', '3232323', '2323', 'http://127.0.0.1:8000/admin/sittings/editpro', 'http://127.0.0.1:8000/admin/sittings/editpro', 'http://127.0.0.1:8000/admin/sittings/editpro', 'http://127.0.0.1:8000/admin/sittings/editpro', 'http://127.0.0.1:8000/admin/sittings/editpro', '2024-08-13 08:53:13', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `bank_acount` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0' COMMENT ' 1 => Active, \r\n0 => inactive,\r\n2 => Admin ,',
  `Address` varchar(255) DEFAULT NULL,
  `work_type` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `Profile` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `bank_acount`, `password`, `role`, `id_proof`, `status`, `Address`, `work_type`, `phone_no`, `Profile`, `remember_token`, `created_at`, `updated_at`) VALUES
(37, 'HR', 'hr@gmail.com', NULL, '1111111111111111111111', '$2y$10$ZvsqNVnrnxT/FXXX.l884.wl9l6AU0UTSDL.c6JwnJ60LiE.s21VO', 'HR', '19a6e93d60d7d25de17f7452ae2782cb.jpg', '1', 'Sambhar Lake', 'WFO', '02147483647', '19a6e93d60d7d25de17f7452ae2782cb.jpg', NULL, NULL, '2024-12-13 09:46:04'),
(38, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$10$.tpkQFhQ7dIB7nGs8bShzOSFZHgD5LHppOF1eLAWCx3v1sMr.rtZu', 'Admin', NULL, '2', NULL, NULL, NULL, '95d507517f1f54ea01c3bf9169bdc2d1.jpg', NULL, NULL, NULL),
(39, 'Ankit Saini', 'user@gmail.com', NULL, NULL, '$2y$12$ZqUYe7cPe9YP1WqJzzDqFOgjMUyRyqVdTbEHwBgw6JR9ZA5k/vO.q', 'Associate', 'd424a9c4eb9add71917f93b07aeae4a9.jpg', '1', 'Sambhar Lake', 'WFH', '09828993237', 'd424a9c4eb9add71917f93b07aeae4a9.jpg', NULL, '2024-12-13 09:47:48', '2024-12-14 13:05:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `attendence_deatails`
--
ALTER TABLE `attendence_deatails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendence_deatails_user_id_foreign` (`user_id`),
  ADD KEY `attendence_deatails_salary_id_foreign` (`salary_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `office_ips`
--
ALTER TABLE `office_ips`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendence_deatails`
--
ALTER TABLE `attendence_deatails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `office_ips`
--
ALTER TABLE `office_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendence_deatails`
--
ALTER TABLE `attendence_deatails`
  ADD CONSTRAINT `attendence_deatails_salary_id_foreign` FOREIGN KEY (`salary_id`) REFERENCES `salaries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendence_deatails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
