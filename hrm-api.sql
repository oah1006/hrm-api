-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 08:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm-api`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Phòng tài chính - kế toán', 'Phòng tài chính – kế toán, một bộ phận có vai trò tham mưu cho Ban Giám đốc trong việc hạch toán kế toán, quản lý nguồn vốn hiệu quả nhằm đảm bảo cho các hoạt động sản xuất kinh doanh của doanh nghiệp diễn ra thuận lợi và đạt hiệu quả tốt nhất', '2022-12-07 22:03:40', '2022-12-07 22:03:40'),
(2, 'Phòng nhân sự', 'Phòng nhân sự, người chịu trách nhiệm tạo lên kế hoạch và chiến lược tuyển dụng để thu hút được các nhân tài về với công ty', '2022-12-07 22:08:37', '2022-12-07 22:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','employee') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `birth_date`, `gender`, `password`, `role`, `created_at`, `updated_at`, `department_id`, `status`) VALUES
(1, 'Nhật Hào', 'Bùi', 'bnhao10062001@gmail.com', '0987654320', '2001-10-06', '1', '$2y$10$50z.lxc5DtBr1j3KcLdS0OZ1ubhqidrYttpZDB1PprCDP1yyYEaq.', 'admin', NULL, '2022-12-18 19:11:31', 1, 'active'),
(28, 'admin06', 'cc', 'admin06@gmail.com', '0908640035', '2022-12-22', '1', '$2y$10$9pAfMG.qGL4dyVCQlBJmj.tRHj4jQOH3K.GJETwrIT09HlejADxb2', 'admin', '2022-12-27 02:06:21', '2022-12-27 02:06:21', 1, 'active'),
(29, 'admin07', '123', 'admin07@gmail.com', '0908640037', '2022-12-22', '1', '$2y$10$I17yCuNthqpHO9spTV7rDurXpEs1Y/77AQXYYj/ZOEAheq2qbdj..', 'admin', '2022-12-27 02:06:56', '2022-12-27 02:06:56', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_day` date NOT NULL,
  `end_day` date NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `leave_type_id`, `start_day`, `end_day`, `reason`, `status`, `created_at`, `updated_at`, `employee_id`) VALUES
(2, 4, '2001-06-10', '2001-06-20', 'Xin phép phía công ty xin nghỉ việc vì gia đình có tang, cần phải về nhà gấp để sắp xếp và chuẩn bị', 'approved', '2022-12-19 23:51:04', '2022-12-21 07:13:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(2, 'Casual leave', NULL, NULL),
(3, 'Public leave', NULL, NULL),
(5, 'Maternity leave', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_10_21_041632_create_employees_table', 1),
(5, '2022_10_24_101201_create_departments_table', 1),
(6, '2022_10_25_033239_add_department_id_to_employees_table', 1),
(7, '2022_10_26_031830_add_status_to_employees_table', 1),
(8, '2022_11_11_055940_create_otps_table', 1),
(9, '2022_11_24_051438_create_leaves_table', 1),
(10, '2022_11_24_060720_create_leave_types_table', 1),
(11, '2022_12_20_062625_add_employee_id_to_leaves_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\Employee', 2, 'apitoken', '784e7fb9c32c6fb07265423c18137914bd513f535da4970461d1f97f70b89256', '[\"*\"]', NULL, NULL, '2022-12-02 02:34:47', '2022-12-02 02:34:47'),
(3, 'App\\Models\\Employee', 3, 'apitoken', '75c3c7ef120318b4e8f6b556f86bc86a0ca01e4d1a5e814aacdb01bde1ee75e0', '[\"*\"]', NULL, NULL, '2022-12-02 02:36:24', '2022-12-02 02:36:24'),
(4, 'App\\Models\\Employee', 5, 'apitoken', 'cfc4b07a29f3788162ee9cba3a503c1bc3bf2c75123ae2710e06ad8a381b99e0', '[\"*\"]', NULL, NULL, '2022-12-02 02:38:26', '2022-12-02 02:38:26'),
(5, 'App\\Models\\Employee', 6, 'apitoken', '7a396a0d3d2402a036e5e5d71eab0db952265258742138cb0d31628a62f121b2', '[\"*\"]', NULL, NULL, '2022-12-02 02:39:10', '2022-12-02 02:39:10'),
(10, 'App\\Models\\Employee', 7, 'apitoken', 'efe21b3baa447fd1c14d5cea0d3315037efcdd9a3fe982570ecd1158ec6ee582', '[\"*\"]', NULL, NULL, '2022-12-05 23:09:01', '2022-12-05 23:09:01'),
(13, 'App\\Models\\Employee', 8, 'apitoken', '704f520186a3e16940dc23f45a89363d1692ba35478927cc98e6f4fa6c28a6fa', '[\"*\"]', NULL, NULL, '2022-12-07 21:34:09', '2022-12-07 21:34:09'),
(108, 'App\\Models\\Employee', 9, 'apitoken', '8b597428da75aa1f3e621d471df3639f6e4c47c63f42c4b76a7fd3e593d3f123', '[\"*\"]', NULL, NULL, '2022-12-18 04:33:04', '2022-12-18 04:33:04'),
(110, 'App\\Models\\Employee', 10, 'apitoken', 'e5665b5c15e34a67853cb949b0814da75673b7aeccafcc9ea4ab950f84a06d4d', '[\"*\"]', NULL, NULL, '2022-12-18 05:13:57', '2022-12-18 05:13:57'),
(111, 'App\\Models\\Employee', 11, 'apitoken', 'f019c9ce6544c6bf20831fee045e28dee3ae42aeafa6626f39cb3dfe984700ef', '[\"*\"]', NULL, NULL, '2022-12-18 05:20:31', '2022-12-18 05:20:31'),
(113, 'App\\Models\\Employee', 12, 'apitoken', '6d449365968a4e26d94d905b090ff2a75bedbf35c0fe3f03585cbb4255c9f04c', '[\"*\"]', NULL, NULL, '2022-12-18 05:20:58', '2022-12-18 05:20:58'),
(114, 'App\\Models\\Employee', 13, 'apitoken', '2f5cc9cf7fd90813b819565e5ee8d9e06dd3797839423b2de503654b7ee145c7', '[\"*\"]', NULL, NULL, '2022-12-18 05:21:21', '2022-12-18 05:21:21'),
(115, 'App\\Models\\Employee', 14, 'apitoken', '22e801613fb14f420d640f664f526aac88af8616b474dcb60cffc25a87f3d8fa', '[\"*\"]', NULL, NULL, '2022-12-18 05:22:10', '2022-12-18 05:22:10'),
(116, 'App\\Models\\Employee', 15, 'apitoken', 'a6b7b5db3c0f72bf699e4bfd5291eb23f529befeb1e7003368ece085ca42c961', '[\"*\"]', NULL, NULL, '2022-12-18 05:22:52', '2022-12-18 05:22:52'),
(117, 'App\\Models\\Employee', 16, 'apitoken', '10f49168ee939e532e17904f55b3071ed6dd7c75d3401820a1f2a48ef81bbda6', '[\"*\"]', NULL, NULL, '2022-12-18 05:23:39', '2022-12-18 05:23:39'),
(118, 'App\\Models\\Employee', 17, 'apitoken', 'f74b0ced2100d8793c079f0f14a869655b57b895837cc5241064370ee7d6a641', '[\"*\"]', NULL, NULL, '2022-12-18 05:34:06', '2022-12-18 05:34:06'),
(119, 'App\\Models\\Employee', 18, 'apitoken', '925266a98c51c0a74cde492d4395b7e0a999cbb88e0f2a92d50d9bae51f62de3', '[\"*\"]', NULL, NULL, '2022-12-18 05:48:53', '2022-12-18 05:48:53'),
(120, 'App\\Models\\Employee', 19, 'apitoken', '4913b49e5f31b5c6a5cb1f8e7d1e65c5cf61fcb40eafe72e7f92fa9dad5a210f', '[\"*\"]', NULL, NULL, '2022-12-18 05:55:45', '2022-12-18 05:55:45'),
(121, 'App\\Models\\Employee', 20, 'apitoken', 'eab0ea5a3277352974797a2347439568384cbd550441a31e4fb31a60c48e44ed', '[\"*\"]', NULL, NULL, '2022-12-18 05:56:53', '2022-12-18 05:56:53'),
(122, 'App\\Models\\Employee', 21, 'apitoken', 'a98c5dfde352ec24a0e038676e0c3a00a615ce74db249c46c85c162b4d500da6', '[\"*\"]', NULL, NULL, '2022-12-18 05:57:36', '2022-12-18 05:57:36'),
(123, 'App\\Models\\Employee', 22, 'apitoken', 'b4ff4744a03eb12cf31c865d4f92b5f277808eb5b63271db312aef76cc9304d2', '[\"*\"]', NULL, NULL, '2022-12-18 05:58:50', '2022-12-18 05:58:50'),
(139, 'App\\Models\\Employee', 23, 'apitoken', '99d6352b929d579f3caa9b4fcfc411df10a03f58e2eef329921e4c183ebbd97c', '[\"*\"]', NULL, NULL, '2022-12-21 20:42:13', '2022-12-21 20:42:13'),
(147, 'App\\Models\\Employee', 1, 'apitoken', '3555423218ae0d0da6ea85f29ef62a83d9ba940a22aa416918aeec845b38ca32', '[\"*\"]', '2022-12-26 00:14:21', NULL, '2022-12-25 08:38:01', '2022-12-26 00:14:21'),
(148, 'App\\Models\\Employee', 1, 'apitoken', 'fa2169f7faffbf06280d40f5f90b8e285065c29cd9247f657c0d53082b590af0', '[\"*\"]', '2022-12-27 10:35:15', NULL, '2022-12-27 00:46:01', '2022-12-27 10:35:15'),
(149, 'App\\Models\\Employee', 24, 'apitoken', '78223b2eab6920cac05b57ee75761c56b46ac2ddd98944b31ffe096998f0c6fe', '[\"*\"]', NULL, NULL, '2022-12-27 02:01:12', '2022-12-27 02:01:12'),
(150, 'App\\Models\\Employee', 25, 'apitoken', 'eee843319486de7ad85ad8a23478f5bc4cb5bae1fb05e7e7f5a73e65c8e0307a', '[\"*\"]', NULL, NULL, '2022-12-27 02:01:53', '2022-12-27 02:01:53'),
(151, 'App\\Models\\Employee', 26, 'apitoken', '7c9031a0b4033b60719691c49556d16302efc7a64e88140c11893ed69cbdca97', '[\"*\"]', NULL, NULL, '2022-12-27 02:02:09', '2022-12-27 02:02:09'),
(152, 'App\\Models\\Employee', 27, 'apitoken', '4b87f9dfd9c261a72ac0374779598cfe25a50014a45c8643cf2802e1a6d1a9fb', '[\"*\"]', NULL, NULL, '2022-12-27 02:05:59', '2022-12-27 02:05:59'),
(153, 'App\\Models\\Employee', 28, 'apitoken', 'c77535a2b36e64cf9ea7b39931272e37b15bebd9e20b60a88a80b139fdbb20db', '[\"*\"]', NULL, NULL, '2022-12-27 02:06:21', '2022-12-27 02:06:21'),
(154, 'App\\Models\\Employee', 29, 'apitoken', '1369957510e408796e90ff32827da4d19b743db6b2e3fff54cf4eeb15ea2c2bc', '[\"*\"]', NULL, NULL, '2022-12-27 02:06:56', '2022-12-27 02:06:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_department_name_index` (`department_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_phone_number_unique` (`phone_number`),
  ADD KEY `employees_first_name_index` (`first_name`),
  ADD KEY `employees_last_name_index` (`last_name`),
  ADD KEY `employees_birth_date_index` (`birth_date`),
  ADD KEY `employees_gender_index` (`gender`),
  ADD KEY `employees_status_index` (`status`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
