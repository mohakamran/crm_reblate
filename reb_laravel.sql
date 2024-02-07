-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 06:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reb_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_start_date` date NOT NULL,
  `project_type` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `project_description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `project_name`, `project_start_date`, `project_type`, `client_email`, `client_phone`, `project_description`, `created_at`, `updated_at`) VALUES
(8, 'Mehfooz Imran', 'Majestic Sellerz', '2022-01-01', 'on going', 'kamran@reblatesols.com', '', '', '2024-01-02 12:46:47', '2024-01-04 06:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Emp_Code` text NOT NULL,
  `Emp_Full_Name` varchar(255) NOT NULL,
  `department` text NOT NULL,
  `Emp_Email` varchar(255) NOT NULL,
  `Emp_Phone` varchar(255) NOT NULL,
  `Emp_Designation` varchar(255) NOT NULL,
  `Emp_Status` varchar(255) NOT NULL,
  `Emp_Shift_Time` varchar(255) NOT NULL,
  `Emp_Joining_Date` date NOT NULL,
  `Emp_Address` varchar(255) NOT NULL,
  `Emp_Image` varchar(255) NOT NULL,
  `Emp_Relation` varchar(255) NOT NULL,
  `Emp_Relation_Name` varchar(255) NOT NULL,
  `Emp_Relation_Phone` varchar(255) NOT NULL,
  `Emp_Relation_Address` varchar(255) NOT NULL,
  `Emp_Bank_Name` varchar(255) NOT NULL,
  `Emp_Bank_IBAN` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `Emp_Code`, `Emp_Full_Name`, `department`, `Emp_Email`, `Emp_Phone`, `Emp_Designation`, `Emp_Status`, `Emp_Shift_Time`, `Emp_Joining_Date`, `Emp_Address`, `Emp_Image`, `Emp_Relation`, `Emp_Relation_Name`, `Emp_Relation_Phone`, `Emp_Relation_Address`, `Emp_Bank_Name`, `Emp_Bank_IBAN`, `created_at`, `updated_at`) VALUES
(12, '201sols', 'Ahsan Qureshi', 'Operations', 'ahsq11@gmail.com', '03045889566', 'Operations Manager', 'active', 'Morning', '2023-09-01', 'House No. E-12, Left Bank, Wapda Mangla Colony, Mirpur Azad Kashmir', 'employee_images/1701324201.jfif', 'Father', 'Muhammad Shoaib Qureshi', '03008133521', 'House No. E-12, Left Bank, Wapda Mangla Colony, Mirpur Azad Kashmir', 'no_bank', 'no_iban', '2023-11-30 06:03:21', '2023-11-30 06:03:21'),
(13, '204sols', 'Muhammad Kamran', 'Development', 'mohammadkamran1515@gmail.com', '03078907120', 'Web Development', 'active', 'Morning', '2023-09-11', 'Professor Colony, Jhelum, Pakistan', 'employee_images/1701324534.jpg', 'Father', 'Muhammad Suleman', '03495765064', 'Professor Colony, Jhelum, Pakistan', 'no_bank', 'no_iban', '2023-11-30 06:08:54', '2023-11-30 06:08:54'),
(14, '203sols', 'Muhammad Abubakar', 'Development', 'm3abubakar@gmail.com', '03009514299', 'Web Development', 'active', 'Morning', '2023-09-01', 'Doctor\'s Street, Machine Mohalla No. 3, Jhelum', 'employee_images/1701324865.jpeg', 'Father', 'Mirza Muhammad Suleman', '0300 9514299', 'Doctor\'s Street, Machine Mohalla No. 3, Jhelum', 'no_bank', 'no_iban', '2023-11-30 06:14:25', '2023-11-30 06:14:25'),
(15, '205sols', 'Muhammad Imran Matloob', 'Graphics', 'imran222278622@gmail.com', '03161588625', 'Graphic Designer', 'active', 'Morning', '2023-09-01', 'Village Mohal, Dina Jhelum', 'employee_images/1701325170.jpeg', 'Brother', 'Amir Matloob', '03331544234', 'Village Mohal, Dina Jhelum', 'no_bank', 'no_iban', '2023-11-30 06:19:30', '2023-11-30 06:19:30'),
(16, '206sols', 'Junaid Abdul Rehman', 'Graphics', 'mirzajoni149@gmail.com', '03073687893', 'Senior Graphic Designer', 'active', 'Morning', '2023-09-21', 'VPO/kharka, Tehsil Sarai Alamgir, District, Gujrat', 'employee_images/1701325813.jpeg', 'Mother', 'Rukhsana Shamim', '03058950537', 'VPO/kharka, Tehsil Sarai Alamgir, District, Gujrat', 'no_bank', 'no_iban', '2023-11-30 06:30:13', '2023-11-30 06:30:13'),
(17, '028sols', 'Muhammad Tehseen  Aleem', 'WFS/Wholesale', 'tehseenchoudhary69@gmail.com', '03325429876', 'Virtual Assistant', 'active', 'Night', '2023-07-01', 'Ch Kabir House, Dhok Barkat Ali, Kala Deo, Jhelum', 'employee_images/1701327806.png', 'Father', 'Muhammad Aleem', '03005429876', 'Ch Kabir House, Dhok Barkat Ali, Kala Deo, Jhelum', 'no_bank', 'no_iban', '2023-11-30 07:03:26', '2023-11-30 07:03:26'),
(18, '030sols', 'Afzaal Mehdi', 'Drop-Shipping', 'itxafzaal098@gmail.com', '03010542214', 'Virtual Assistant', 'active', 'Night', '2023-07-01', 'Bilal town, Jhelum', 'employee_images/1701328154.png', 'MOTHER', 'Afzaal\'s Mother', '03225854356', 'Bilal town, Jhelum', 'no_bank', 'no_iban', '2023-11-30 07:09:14', '2023-11-30 07:09:14'),
(19, '025sols', 'Hussnain Abdullah', 'Drop-Shipping', 'chabdullah555533@gmail.com', '03099245167', 'Virtual Assistant', 'active', 'Night', '2022-09-01', 'Post Office KALA DEO, Jhelum', 'employee_images/1701336041.png', 'Father', 'Shahzad Nazir', '03095061972', 'Post Office KALA DEO, Jhelum', 'no_bank', 'no_iban', '2023-11-30 09:20:41', '2023-11-30 09:20:41'),
(20, '020sols', 'Rohan Ahmed', 'WFS/Wholesale', 'rohansyed133@gmail.com', '03447793650', 'Virtual Assistant', 'active', 'Night', '2022-04-01', 'Street No. 2, Professors Colony, Civil line Jhelum/Punjab', 'employee_images/1701338976.png', 'Father', 'Sohail Ahmed', '03339573800', 'Street No. 2, Professors Colony, Civil line Jhelum/Punjab', 'no_bank', 'no_iban', '2023-11-30 10:09:36', '2023-11-30 10:09:36'),
(21, '014sols', 'Hassan Zahid', 'WFS/Wholesale', 'jeehasan41@gmail.com', '03175429218', 'Virtual Assistant', 'active', 'Night', '2021-10-01', 'House no 829D Bilal Town, Jhelum/Punjab', 'employee_images/1701339467.png', 'Uncle', 'Ansar Rasheed', '03145405333', 'House no 829D Bilal Town, Jhelum/Punjab', 'no_bank', 'no_iban', '2023-11-30 10:17:47', '2023-11-30 10:17:47'),
(22, '029sols', 'Muteeb Muzaffar', 'Arbitrage', 'muteebjanjua933@gmail.com', '03337860569', 'Virtual Assistant', 'active', 'Night', '2023-07-01', '221-B-Bilal town, Jhelum', 'employee_images/1701339847.png', 'Shahzad Zaffar', 'Father', '03009519109', '221-B-Bilal town, Jhelum', 'no_bank', 'no_iban', '2023-11-30 10:24:07', '2023-11-30 10:24:07'),
(23, '019sols', 'Raja Abdul Wahab', 'Management', 'reblate019sols@outlook.com', '0300770087', 'Operations Manager', 'active', 'Night', '2023-10-01', 'House No. E/1149, Bilal Town, Jhelum', 'employee_images/1701340173.png', 'Father', 'Khalid Hafeez', '03335823655', 'House No. E/1149, Bilal Town, Jhelum', 'no_bank', 'no_iban', '2023-11-30 10:29:33', '2023-11-30 10:29:33'),
(25, '112sols', 'Sunil Sethi', 'Web Development', 'kamran.ecomgladiators@gmail.com', '030245468000', 'Full stack Web Developer', 'active', 'Morning', '2024-01-24', 'emp address', 'employee_images/1706176354.jpg', 'nice', 'nice', '5636166551', 'simple address', 'no_bank', 'no_iban', '2024-01-24 07:40:19', '2024-01-25 04:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_amount` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_parent_category` varchar(255) NOT NULL,
  `expense_child_category` varchar(255) NOT NULL,
  `expense_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(191) NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `amount` text NOT NULL,
  `status` varchar(191) NOT NULL,
  `pdf_path` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, '2023_10_10_102640_create_employees_data', 2),
(22, '2023_10_12_065030_create_users_table', 4),
(23, '2014_10_12_000000_create_users_table', 5),
(30, '2014_10_12_100000_create_password_reset_tokens_table', 6),
(31, '2019_08_19_000000_create_failed_jobs_table', 6),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 6),
(33, '2023_10_11_060621_create_employees_table', 6),
(34, '2023_10_24_080655_create_users_table', 6),
(35, '2023_10_25_071550_add_remember_token_to_users_table', 7),
(37, '2014_10_12_100000_create_password_resets_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
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
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `emp_name` text NOT NULL,
  `file_name` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `emp_id`, `emp_name`, `file_name`, `status`, `date`, `created_at`, `updated_at`, `amount`) VALUES
(11, '201sols', 'Ahsan Qureshi', 'generated-salaries/201sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:01:30', '2023-12-11 08:01:30', ''),
(12, '204sols', 'Muhammad Kamran', 'generated-salaries/204sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:15:56', '2023-12-11 08:15:56', ''),
(13, '203sols', 'Muhammad Abubakar', 'generated-salaries/203sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:18:29', '2023-12-11 08:18:29', ''),
(14, '205sols', 'Muhammad Imran Matloob', 'generated-salaries/205sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:25:46', '2023-12-11 08:25:46', ''),
(15, '205sols', 'Muhammad Imran Matloob', 'generated-salaries/205sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:26:30', '2023-12-11 08:26:30', ''),
(16, '206sols', 'Junaid Abdul Rehman', 'generated-salaries/206sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:39:00', '2023-12-11 08:39:00', ''),
(17, '206sols', 'Junaid Abdul Rehman', 'generated-salaries/206sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:39:09', '2023-12-11 08:39:09', ''),
(18, '206sols', 'Junaid Abdul Rehman', 'generated-salaries/206sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 08:39:17', '2023-12-11 08:39:17', ''),
(19, '019sols', 'Raja Abdul Wahab', 'generated-salaries/019sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 20:38:35', '2023-12-11 20:38:35', ''),
(20, '029sols', 'Muteeb Muzaffar', 'generated-salaries/029sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 20:41:41', '2023-12-11 20:41:41', ''),
(21, '014sols', 'Hassan Zahid', 'generated-salaries/014sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 20:54:31', '2023-12-11 20:54:31', ''),
(22, '020', 'Rohan Ahmed', 'generated-salaries/020_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 21:13:15', '2023-12-11 21:13:15', ''),
(23, '020', 'Rohan Ahmed', 'generated-salaries/020_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 21:18:59', '2023-12-11 21:18:59', ''),
(24, '025sols', 'Hussnain Abdullah', 'generated-salaries/025sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 21:21:37', '2023-12-11 21:21:37', ''),
(25, '030sols', 'Afzaal Mehdi', 'generated-salaries/030sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 21:31:00', '2023-12-11 21:31:00', ''),
(26, '028sols', 'Muhammad Tehseen  Aleem', 'generated-salaries/028sols_November, 2023.pdf', 'paid', '11/12/2023', '2023-12-11 21:34:38', '2023-12-11 21:34:38', ''),
(27, '206sols', 'Junaid Abdul Rehman', 'generated-salaries/206sols_December, 2023.pdf', 'paid', '01/01/2024', '2024-01-01 11:46:20', '2024-01-01 11:46:20', ''),
(28, '205sols', 'Muhammad Imran Matloob', 'generated-salaries/205sols_December, 2023.pdf', 'paid', '01/01/2024', '2024-01-01 11:46:25', '2024-01-01 11:46:25', ''),
(29, '203sols', 'Muhammad Abubakar', 'generated-salaries/203sols_December, 2023.pdf', 'paid', '01/01/2024', '2024-01-01 11:46:31', '2024-01-01 11:46:31', ''),
(30, '204sols', 'Muhammad Kamran', 'generated-salaries/204sols_December, 2023.pdf', 'paid', '01/01/2024', '2024-01-01 11:46:35', '2024-01-01 11:46:35', ''),
(31, '201sols', 'Ahsan Qureshi', 'generated-salaries/201sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 11:52:30', '2024-01-10 11:52:30', '58000'),
(32, '019sols', 'Raja Abdul Wahab', 'generated-salaries/019sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 18:49:39', '2024-01-10 18:49:39', '65000'),
(33, '029sols', 'Muteeb Muzaffar', 'generated-salaries/029sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 18:51:47', '2024-01-10 18:51:47', '40000'),
(34, '014sols', 'Hassan Zahid', 'generated-salaries/014sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 19:03:44', '2024-01-10 19:03:44', '41500'),
(35, '020sols', 'Rohan Ahmed', 'generated-salaries/020sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 19:08:37', '2024-01-10 19:08:37', '40000'),
(36, '025sols', 'Hussnain Abdullah', 'generated-salaries/025sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 19:12:12', '2024-01-10 19:12:12', '40000'),
(37, '030sols', 'Afzaal Mehdi', 'generated-salaries/030sols_December, 2023.pdf', 'paid', '10/01/2024', '2024-01-10 19:18:47', '2024-01-10 19:18:47', '36000');

-- --------------------------------------------------------

--
-- Table structure for table `table_login_details`
--

CREATE TABLE `table_login_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `emp_code` varchar(191) NOT NULL,
  `employee_type` varchar(191) NOT NULL,
  `employees_access` varchar(191) DEFAULT NULL,
  `expenses_access` varchar(191) DEFAULT NULL,
  `clients_access` varchar(191) DEFAULT NULL,
  `invoices_access` varchar(191) DEFAULT NULL,
  `salary_slips_access` varchar(191) DEFAULT NULL,
  `reports_access` text NOT NULL,
  `tasks_access` varchar(191) DEFAULT NULL,
  `attendance_access` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `table_login_details`
--

INSERT INTO `table_login_details` (`id`, `username`, `email`, `emp_code`, `employee_type`, `employees_access`, `expenses_access`, `clients_access`, `invoices_access`, `salary_slips_access`, `reports_access`, `tasks_access`, `attendance_access`, `created_at`, `updated_at`) VALUES
(23, 'Muhammad Kamran', 'mohammadkamran1515@gmail.com', '204sols', 'employee', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', '2024-01-23 10:25:38', '2024-01-23 10:25:38'),
(25, 'Sunil Sethi', 'kamranstallionecom@gmail.com', '112sols', 'employee', 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none', '2024-01-24 10:54:40', '2024-01-24 10:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_type`, `password`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Kamran', 'kamran123@gmail.com', 'super_admin', '$2y$10$f5rmPF/c3O17s51sTvVoX.7G5bqI6xxGp9Ir0.OLoS1y7dVfjABNW', '2023-10-25 00:46:13', '2023-10-31 07:43:09', 'DLA35Y6DRmQgGAMGgHlVRmm5oEIj0dQMbSoadpsOJXWIgOFFjnNGmJ0xI5RZ'),
(4, 'Ahsan', 'ahsan@reblatesols.com', 'super_admin', '$2y$10$VN5YMyThKLhd7UzVotKoLOCJA82fPl.ACC7s5Pv8gLjHw3/MLikte', '2023-11-30 05:57:20', '2023-11-30 05:57:20', '7x3JmZj41VLEpSP1w1WrfElglVN9Q6kN72c2I9J7g9PgM5Br1gszBXqy6ytD'),
(5, 'Roveem Dar', 'roveemdar@gmail.com', 'admin', '$2y$10$CZXzpHL0VsbLSNs872Yc8eB7jYs6nOsakiBYglKnKtBDn3z/HG1FG', '2023-11-30 10:32:17', '2023-11-30 10:32:17', '3sxnOPDZgkXVOSRxzIPrTg8epoij1Ptutt9hv0djEfwQxGWRzXUsnSHaRVzQ'),
(9, 'Muhammad Kamran', 'mohammadkamran1515@gmail.com', 'admin', '$2y$10$T0ibmuiQYd.cpil4.w3RGuyziz8e1CSbBTMYvVheyTkc8w1ANCIRO', '2023-12-04 18:00:26', '2023-12-04 18:00:26', NULL),
(10, 'Muhammad Abuzar', 'zari964242@gmail.com', 'super_admin', '$2y$10$kyvFw4QYUXGm924GHicZo.Cfnia2HgJcjZ6ydinGwAKWQPW5RmmL.', '2023-12-08 12:00:18', '2023-12-08 12:00:18', 'aazZF7pjazzsGCZ2L4g2X8Q8tIkHUIxBbGuI2ZXDwaX9cEDzdfKZFGUGhAVd');

-- --------------------------------------------------------

--
-- Table structure for table `user_employee`
--

CREATE TABLE `user_employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL,
  `remember_token` varchar(250) NOT NULL,
  `employee_type` text NOT NULL,
  `emp_code` varchar(191) NOT NULL,
  `emp_email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `emp_img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_employee`
--

INSERT INTO `user_employee` (`id`, `username`, `password`, `status`, `remember_token`, `employee_type`, `emp_code`, `emp_email`, `created_at`, `updated_at`, `emp_img`) VALUES
(14, 'Muhammad Kamran', '$2y$10$uoej4VNCCEKBxWEs2b8Edepr/XFXRUQQlBMwPoMUcugUoB3fbvuX6', 'created', 'VPLPgSWGJ9x8kWo9g2uuG9W2HB6hw6UjpoqFLlS00uDpFNvN2v3fSfOxvvVL', 'employee', '204sols', 'mohammadkamran1515@gmail.com', '2024-01-23 10:25:39', '2024-01-23 10:25:39', 'default'),
(16, 'Sunil Sethi', '$2y$10$dzGOBaVlwQr4vtGvhzSMoe3lmM7SAobqXCa3RHXsxf6/A9uiOLfbC', 'created', 'LlyNegdqHDr1G8m6uL9Ojv9C067A62eyWU8sOwf309XUkFWeUOlv9la6SPvK', 'employee', '112sols', 'kamranstallionecom@gmail.com', '2024-01-24 10:54:40', '2024-01-25 05:50:38', 'employee_images/1706176354.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_login_details`
--
ALTER TABLE `table_login_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `table_login_details_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_employee`
--
ALTER TABLE `user_employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `table_login_details`
--
ALTER TABLE `table_login_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_employee`
--
ALTER TABLE `user_employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
