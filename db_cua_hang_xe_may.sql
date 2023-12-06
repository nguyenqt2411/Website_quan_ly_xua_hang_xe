-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 04:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cua_hang_xe_may`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `shop_id`, `branch_no`, `name`, `address`, `created_at`, `updated_at`) VALUES
(2, 1, 'CN000002', 'Chi nhánh 1', 'Chi nhánh 1', '2023-11-04 12:42:11', '2023-11-12 08:24:48'),
(3, 1, 'CN000003', 'Chi nhánh 2', 'Chi nhánh 2', '2023-11-04 12:42:18', '2023-11-12 08:24:53'),
(4, 1, 'CN000004', 'Kho số 1', 'Hà nội', '2023-11-12 08:01:03', '2023-11-12 08:25:00'),
(5, 1, 'CN000005', 'Kho số 2', 'Hải phòng', '2023-11-12 08:01:23', '2023-11-12 08:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trademark_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `shop_id`, `name`, `trademark_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wave Alpha 110', 2, '2023-11-04 20:00:53', '2023-11-04 20:00:53'),
(2, 1, 'Air Blade 125/160', 2, '2023-11-04 20:01:38', '2023-11-04 20:01:38'),
(3, 1, 'Gold Wing 2023', 2, '2023-11-04 20:01:48', '2023-11-04 20:01:48'),
(4, 1, 'Rebel 500 2023', 2, '2023-11-04 20:01:53', '2023-11-04 20:01:53'),
(5, 1, 'SH160i/125i', 2, '2023-11-04 20:02:06', '2023-11-04 20:02:06'),
(6, 1, 'SH350i', 2, '2023-11-04 20:02:19', '2023-11-04 20:02:19'),
(7, 1, 'Winner X', 2, '2023-11-04 20:02:31', '2023-11-04 20:02:31'),
(8, 1, 'Sh Mode 125cc', 2, '2023-11-04 20:02:40', '2023-11-04 20:02:40'),
(9, 1, 'FREEGO', 3, '2023-11-04 20:03:11', '2023-11-04 20:03:11'),
(10, 1, 'GRANDE', 3, '2023-11-04 20:03:17', '2023-11-04 20:03:41'),
(11, 1, 'LATTE', 3, '2023-11-04 20:03:22', '2023-11-04 20:03:51'),
(12, 1, 'JANUS', 3, '2023-11-04 20:03:30', '2023-11-04 20:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `shop_id`, `customer_no`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'KH000001', 'Nguyễn Văn A', 'duocnvoit@gmail.com', '0359020898', 'HN', NULL, '2023-11-12 08:20:47'),
(3, 1, 'KH000003', 'Nguyễn Văn A', 'duocnvit@gmail.com', '0928817228', 'HN', NULL, '2023-11-30 08:13:11');

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
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý cửa hàng xe', 'Quản lý cửa hàng xe', '2023-11-12 07:29:23', '2023-11-12 07:29:23'),
(2, 'Quản lý chi nhánh kho', 'Quản lý chi nhánh kho', '2023-11-12 07:29:50', '2023-11-12 07:29:50'),
(3, 'Quản lý hãng xe', 'Quản lý hãng xe', '2023-11-12 07:29:59', '2023-11-12 07:29:59'),
(4, 'Quản lý dòng xe', 'Quản lý dòng xe', '2023-11-12 07:30:08', '2023-11-12 07:30:08'),
(5, 'Quản lý nhà cung cấp', 'Quản lý nhà cung cấp', '2023-11-12 07:30:21', '2023-11-12 07:30:21'),
(6, 'Quản lý sản phẩm', 'Quản lý sản phẩm', '2023-11-12 07:30:35', '2023-11-12 07:30:35'),
(7, 'Quản lý khách hàng', 'Quản lý khách hàng', '2023-11-12 07:31:01', '2023-11-12 07:31:01'),
(8, 'Quản lý nhập kho', 'Quản lý nhập kho', '2023-11-12 07:31:10', '2023-11-12 07:31:10'),
(9, 'Quản lý xuất kho', 'Quản lý xuất kho', '2023-11-12 07:31:28', '2023-11-12 07:31:28'),
(10, 'Quản lý vai trò', 'Quản lý vai trò', '2023-11-12 07:31:38', '2023-11-12 07:31:38'),
(11, 'Quản lý người dùng', 'Quản lý người dùng', '2023-11-12 07:31:47', '2023-11-12 07:31:47'),
(12, 'Quản lý website', 'Quản lý website', '2023-11-12 07:39:00', '2023-11-12 07:39:00'),
(13, 'Quản lý bán hàng', 'Quản lý bán hàng', '2023-11-22 10:07:26', '2023-11-22 10:07:26'),
(14, 'Quản lý thống kê', 'Quản lý thống kê', '2023-12-05 08:40:15', '2023-12-05 08:40:15');

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
(1, '2023_10_11_154325_create_shops_table', 1),
(2, '2023_10_12_000000_create_users_table', 1),
(3, '2023_10_12_100000_create_password_resets_table', 1),
(4, '2023_10_13_171541_laravel_entrust_setup_tables', 1),
(5, '2023_10_14_000000_create_failed_jobs_table', 1),
(6, '2023_10_19_155152_create_trademarks_table', 1),
(7, '2023_10_19_161731_create_categories_table', 1),
(8, '2023_10_19_161845_create_suppliers_table', 1),
(9, '2023_10_19_162211_create_products_table', 1),
(10, '2023_10_19_163559_create_branches_table', 1),
(11, '2023_10_27_075908_create_customers_table', 1),
(12, '2023_11_04_095931_create_warehouses_table', 1),
(13, '2023_11_05_024634_add_trademark_id_to_categories_table', 1),
(14, '2023_11_08_150916_create_product_warehousing_table', 2),
(15, '2023_11_24_033128_add_selling_id_to_warehouses_table', 3);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_permission_id`, `created_at`, `updated_at`) VALUES
(1, 'danh-sach-cua-hang-xe', 'Danh sách cửa hàng xe', 'Danh sách cửa hàng xe', 1, '2023-11-12 07:32:10', '2023-11-12 07:32:44'),
(2, 'them-cua-hang-xe', 'Thêm cửa hàng xe', 'Thêm cửa hàng xe', 1, '2023-11-12 07:32:54', '2023-11-12 07:32:54'),
(3, 'chinh-sua-cua-hang-xe', 'Chỉnh sửa cửa hàng xe', 'Thêm cửa hàng xe', 1, '2023-11-12 07:33:07', '2023-11-12 07:33:07'),
(4, 'xoa-cua-hang-xe', 'Xóa cửa hàng xe', 'Xóa cửa hàng xe', 1, '2023-11-12 07:33:15', '2023-11-12 07:33:15'),
(5, 'danh-sach-chi-nhanh-hoac-kho', 'Danh sách chi nhánh hoặc kho', 'Danh sách chi nhánh hoặc kho', 2, '2023-11-12 07:33:35', '2023-11-12 07:33:35'),
(6, 'them-chi-nhanh-hoac-kho', 'Thêm chi nhánh hoặc kho', 'Thêm chi nhánh hoặc kho', 2, '2023-11-12 07:33:58', '2023-11-12 07:33:58'),
(7, 'chinh-sua-chi-nhanh-hoac-kho', 'Chỉnh sửa chi nhánh hoặc kho', 'Chỉnh sửa chi nhánh hoặc kho', 2, '2023-11-12 07:34:11', '2023-11-12 07:34:11'),
(8, 'xoa-chi-nhanh-hoac-kho', 'Xóa chi nhánh hoặc kho', 'Xóa chi nhánh hoặc kho', 2, '2023-11-12 07:34:22', '2023-11-12 07:34:22'),
(9, 'danh-sach-hang-xe', 'Danh sách hãng xe', 'Danh sách hãng xe', 3, '2023-11-12 07:35:10', '2023-11-12 07:35:10'),
(10, 'them-moi-hang-xe', 'Thêm mới hãng xe', 'Thêm mới hãng xe', 3, '2023-11-12 07:36:11', '2023-11-12 07:36:11'),
(11, 'chinh-sua-hang-xe', 'Chỉnh sửa hãng xe', 'Chỉnh sửa hãng xe', 3, '2023-11-12 07:36:24', '2023-11-12 07:36:24'),
(12, 'xoa-hang-xe', 'Xóa hãng xe', 'Xóa hãng xe', 3, '2023-11-12 07:36:33', '2023-11-12 07:36:33'),
(13, 'danh-sach-dong-xe', 'Danh sách dòng xe', 'Danh sách dòng xe', 4, '2023-11-12 07:36:46', '2023-11-12 07:36:46'),
(14, 'them-dong-xe', 'Thêm dòng xe', 'Thêm dòng xe', 4, '2023-11-12 07:36:59', '2023-11-12 07:36:59'),
(15, 'chinh-sua-dong-xe', 'Chỉnh sửa dòng xe', 'Chỉnh sửa dòng xe', 4, '2023-11-12 07:37:14', '2023-11-12 07:37:14'),
(16, 'xoa-dong-xe', 'Xóa dòng xe', 'Xóa dòng xe', 4, '2023-11-12 07:37:26', '2023-11-12 07:37:26'),
(17, 'danh-sach-nha-cung-cap', 'Danh sách nhà cung cấp', 'Danh sách nhà cung cấp', 5, '2023-11-12 07:37:40', '2023-11-12 07:37:40'),
(18, 'them-nha-cung-cap', 'Thêm nhà cung cấp', 'Thêm nhà cung cấp', 5, '2023-11-12 07:37:51', '2023-11-12 07:37:51'),
(19, 'chinh-sua-nha-cung-cap', 'Chỉnh sửa nhà cung cấp', 'Chỉnh sửa nhà cung cấp', 5, '2023-11-12 07:38:04', '2023-11-12 07:38:04'),
(20, 'xoa-nha-cung-cap', 'Xóa nhà cung cấp', 'Xóa nhà cung cấp', 5, '2023-11-12 07:38:18', '2023-11-12 07:38:18'),
(21, 'truy-cap-website', 'Truy cập website', 'Truy cập website', 12, '2023-11-12 07:39:26', '2023-11-12 07:39:26'),
(22, 'toan-quyen-quan-ly', 'Toàn quyền quản lý', 'Toàn quyền quản lý', 12, '2023-11-12 07:39:37', '2023-11-12 07:39:37'),
(23, 'danh-sach-san-pham', 'Danh sách sản phẩm', 'Danh sách sản phẩm', 6, '2023-11-12 07:40:18', '2023-11-12 07:40:18'),
(24, 'them-san-pham', 'Thêm sản phẩm', 'Thêm sản phẩm', 6, '2023-11-12 07:40:27', '2023-11-12 07:40:27'),
(25, 'chinh-sua-san-pham', 'Chỉnh sửa sản phẩm', 'Chỉnh sửa sản phẩm', 6, '2023-11-12 07:40:41', '2023-11-12 07:40:41'),
(26, 'xoa-san-pham', 'Xóa sản phẩm', 'Xóa sản phẩm', 6, '2023-11-12 07:41:10', '2023-11-12 07:41:10'),
(27, 'danh-sach-khach-hang', 'Danh sách khách hàng', 'Danh sách khách hàng', 7, '2023-11-12 07:41:27', '2023-11-12 07:41:27'),
(29, 'them-moi-khach-hang', 'Thêm mới khách hàng', 'Thêm mới khách hàng', 7, '2023-11-12 07:41:53', '2023-11-12 07:41:53'),
(30, 'chinh-sua-khach-hang', 'Chỉnh sửa khách hàng', 'Chỉnh sửa khách hàng', 7, '2023-11-12 07:42:10', '2023-11-12 07:42:10'),
(31, 'xoa-khach-hang', 'Xóa khách hàng', 'Xóa khách hàng', 7, '2023-11-12 07:42:23', '2023-11-12 07:42:23'),
(32, 'danh-sach-nhap-kho', 'Dánh sách nhập kho', 'Dánh sách nhập kho', 8, '2023-11-12 07:43:02', '2023-11-12 07:43:02'),
(33, 'them-nhap-kho', 'Thêm nhập kho', 'Thêm nhập kho', 8, '2023-11-12 07:43:14', '2023-11-12 07:43:14'),
(34, 'chinh-sua-nhap-kho', 'Chỉnh sửa nhập kho', 'Chỉnh sửa nhập kho', 8, '2023-11-12 07:43:30', '2023-11-12 07:43:30'),
(35, 'xoa-nhap-kho', 'Xóa nhập kho', 'Xóa nhập kho', 8, '2023-11-12 07:43:43', '2023-11-12 07:43:43'),
(36, 'danh-sach-san-pham-da-nhap', 'Danh sách sản phẩm đã nhập', 'Danh sách sản phẩm đã nhập', 8, '2023-11-12 07:43:56', '2023-11-12 07:43:56'),
(37, 'them-xuat-kho', 'Thêm xuất kho', 'Thêm xuất kho', 9, '2023-11-22 10:22:34', '2023-11-22 10:22:34'),
(38, 'chinh-sua-xuat-kho', 'Chỉnh sửa xuất kho', 'Chỉnh sửa xuất kho', 9, '2023-11-22 10:22:53', '2023-11-22 10:22:53'),
(39, 'xoa-xuat-kho', 'Xóa xuất kho', 'Xóa xuất kho', 9, '2023-11-22 10:23:07', '2023-11-22 10:23:07'),
(40, 'danh-sach-xuat-kho', 'Danh sách xuất kho', 'Danh sách xuất kho', 9, '2023-11-22 10:24:01', '2023-11-22 10:24:01'),
(41, 'san-pham-da-xuat', 'Sản phẩm đã xuất', 'Sản phẩm đã xuất', 9, '2023-11-22 10:24:15', '2023-11-22 10:24:15'),
(42, 'danh-sach-vai-tro', 'Danh sách vai trò', 'Danh sách vai trò', 10, '2023-11-22 10:24:53', '2023-11-22 10:24:53'),
(43, 'them-moi-vai-tro', 'Thêm mới vai trò', 'Thêm mới vai trò', 10, '2023-11-22 10:25:03', '2023-11-22 10:25:03'),
(44, 'chinh-sua-vai-tro', 'Chỉnh sửa vai trò', 'Chỉnh sửa vai trò', 10, '2023-11-22 10:25:15', '2023-11-22 10:25:15'),
(45, 'xoa-vai-tro', 'Xóa vai trò', 'Xóa vai trò', 10, '2023-11-22 10:25:25', '2023-11-22 10:25:25'),
(46, 'xoa-san-pham-da-nhap', 'Xóa sản phẩm đã nhập', 'Xóa sản phẩm đã nhập', 8, '2023-11-22 10:35:12', '2023-11-22 10:35:12'),
(47, 'hoa-don-nhap-kho', 'Hóa đơn nhập kho', 'Hóa đơn nhập kho', 8, '2023-11-22 10:35:29', '2023-11-22 10:40:25'),
(48, 'xoa-san-pham-da-xuat', 'Xóa sản phẩm đã xuất', 'Xóa sản phẩm đã xuất', 9, '2023-11-22 10:37:14', '2023-11-22 10:37:14'),
(49, 'hoa-don-xuat-kho', 'Hóa đơn xuất kho', 'Hóa đơn xuất kho', 9, '2023-11-22 10:37:35', '2023-11-22 10:37:35'),
(50, 'danh-sach-ban-hang', 'Danh sách bán hàng', 'Danh sách bán hàng', 13, '2023-11-24 01:14:17', '2023-11-24 01:14:17'),
(51, 'them-moi-phieu-mua-hang', 'Thêm mới phiếu mua hàng', 'Thêm mới phiếu mua hàng', 13, '2023-11-24 01:14:27', '2023-11-24 01:14:27'),
(52, 'chinh-sua-phieu-mua-hang', 'Chỉnh sửa phiếu mua hàng', 'Chỉnh sửa phiếu mua hàng', 13, '2023-11-24 01:16:59', '2023-11-24 01:16:59'),
(53, 'xoa-phieu-mua-hang', 'Xóa phiếu mua hàng', 'Xóa phiếu mua hàng', 13, '2023-11-24 01:17:11', '2023-11-24 01:17:11'),
(54, 'hoa-don-phieu-mua-hang', 'Hóa đơn phiếu mua hàng', 'Hóa đơn phiếu mua hàng', 13, '2023-11-24 01:17:22', '2023-11-24 01:17:22'),
(55, 'danh-sach-nguoi-dung', 'Danh sách người dùng', 'Danh sách người dùng', 11, '2023-11-24 01:19:24', '2023-11-24 01:19:24'),
(56, 'them-moi-nguoi-dung', 'Thêm mới người dùng', 'Thêm mới người dùng', 11, '2023-11-24 01:19:33', '2023-11-24 01:19:33'),
(57, 'chinh-sua-nguoi-dung', 'Chỉnh sửa người dùng', 'Chỉnh sửa người dùng', 11, '2023-11-24 01:19:43', '2023-11-24 01:19:43'),
(58, 'xoa-nguoi-dung', 'Xóa người dùng', 'Xóa người dùng', 11, '2023-11-24 01:19:51', '2023-11-24 01:19:51'),
(59, 'danh-sach-thong-ke', 'Danh sách thống kê', NULL, 14, '2023-12-05 08:40:35', '2023-12-05 08:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trademark_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) DEFAULT 0,
  `number` bigint(20) DEFAULT 0,
  `selling` bigint(20) DEFAULT 0,
  `contents` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `shop_id`, `trademark_id`, `category_id`, `product_no`, `name`, `image`, `price`, `number`, `selling`, `contents`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 6, NULL, 'SH350i', '2023-11-10__85a31eb5876669c90c4da3a15773e2d2.jpg', 60000000, 0, 0, '<p>Tại Việt Nam, h&igrave;nh ảnh mẫu xe SH từ l&acirc;u đ&atilde; trở th&agrave;nh biểu tượng cho t&iacute;nh đẳng cấp, sang trọng v&agrave; sự ho&agrave;n hảo. Kế thừa những n&eacute;t đặc trưng đ&oacute;, mẫu xe SH350i ra mắt năm 2021 đ&atilde; g&acirc;y ấn tượng mạnh mẽ với vẻ đẹp đậm chất &quot;&quot;hiện đại c&ocirc;ng nghệ&quot;&quot; v&agrave; &ldquo;bề thế&rdquo;. Với động cơ mạnh mẽ v&agrave; thiết kế sang trọng nhất, c&ugrave;ng chi tiết phối m&agrave;u mới g&acirc;y ấn tượng, mẫu SH350i mới ph&ocirc; diễn được sức mạnh c&ugrave;ng khả năng vận h&agrave;nh đột ph&aacute;, thể hiện đẳng cấp của chủ sở hữu, xứng đ&aacute;ng với vị tr&iacute; &ocirc;ng ho&agrave;ng trong ph&acirc;n kh&uacute;c xe tay ga cao cấp tại Việt Nam.</p>', '2023-11-10 08:34:42', '2023-11-30 10:47:10'),
(2, 1, 2, 1, NULL, 'Xe wave alpha 110', '2023-11-10__3a0d281851a56526d9e258a7690b497f.jpg', 200000, 0, 0, '<p>Wave Alpha được trang bị động cơ 110cc với hiệu suất vượt trội nhưng vẫn đảm bảo tiết kiệm nhi&ecirc;n liệu tối ưu, cho bạn th&ecirc;m tự tin v&agrave; trải nghiệm tốt nhất tr&ecirc;n mọi h&agrave;nh tr&igrave;nh. Th&ecirc;m v&agrave;o đ&oacute;, 4 m&agrave;u - 2 phi&ecirc;n bản c&ugrave;ng thiết kế bộ tem mới phong c&aacute;ch đầy ấn tượng tr&ecirc;n xe gi&uacute;p bạn thể hiện sự trẻ trung, năng động, thu h&uacute;t mọi &aacute;nh nh&igrave;n.</p>', '2023-11-10 10:15:20', '2023-11-23 22:16:39'),
(3, 1, 2, 6, NULL, 'sdfdsfs', '2023-11-30__aad5581800cfdd28c89e3da7022b7a57.jpg', 50000000, 0, 0, '<p>fsdfsdfsdf</p>', '2023-11-30 08:12:24', '2023-11-30 08:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehousing`
--

CREATE TABLE `product_warehousing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `export_branch_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_number` int(11) DEFAULT 0,
  `price` double(20,2) DEFAULT NULL,
  `total_price` double(20,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehousing`
--

INSERT INTO `product_warehousing` (`id`, `warehouse_id`, `product_id`, `supplier_id`, `customer_id`, `export_branch_id`, `branch_id`, `shop_id`, `total_number`, `price`, `total_price`, `type`, `note`, `created_at`, `updated_at`) VALUES
(8, 3, 1, 1, NULL, NULL, 2, 1, 3, 60000000.00, 180000000.00, 1, NULL, '2023-11-10 21:34:32', '2023-11-10 21:34:32'),
(9, 3, 2, 1, NULL, NULL, 2, 1, 5, 15000000.00, 75000000.00, 1, NULL, '2023-11-10 21:34:32', '2023-11-10 21:34:32'),
(10, 4, 1, 1, NULL, NULL, 3, 1, 5, 60000000.00, 300000000.00, 1, NULL, '2023-11-10 21:38:01', '2023-11-10 21:38:01'),
(19, 7, 1, NULL, NULL, 4, 2, 1, 2, 150000000.00, 300000000.00, 2, NULL, '2023-11-22 07:19:33', '2023-11-22 07:19:33'),
(20, 7, 1, NULL, NULL, NULL, 2, 1, 2, 150000000.00, 300000000.00, 1, NULL, '2023-11-22 07:19:33', '2023-11-22 07:19:33'),
(27, 10, 1, 1, NULL, NULL, 4, 1, 20, 120000000.00, 2400000000.00, 1, NULL, '2023-11-24 02:02:10', '2023-11-24 02:02:10'),
(56, 8, 2, NULL, NULL, NULL, 2, 1, 1, 200000.00, 200000.00, 3, NULL, '2023-11-24 09:20:55', '2023-11-24 09:20:55'),
(57, 8, 1, NULL, NULL, NULL, 4, 1, 2, 200000.00, 400000.00, 3, NULL, '2023-11-24 09:20:56', '2023-11-24 09:20:56'),
(58, 11, 2, 1, NULL, NULL, 3, 1, 10, 200000.00, 2000000.00, 1, NULL, '2023-11-30 08:14:06', '2023-11-30 08:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'Administrator', 'Administrator', '2023-10-23 02:44:55', '2023-10-23 02:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `information` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `email`, `phone`, `address`, `information`, `created_at`, `updated_at`) VALUES
(1, 'Xe máy Nguyễn Trưởng', 'nguyentruong@gmail.com', '0928817228', 'Hà Nội', NULL, '2023-10-20 13:23:22', '2023-10-20 13:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `shop_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'Honda', 'honda@gmail.com', '0359020898', '2023-10-21 18:34:32', '2023-11-06 01:28:01'),
(2, 1, 'Yamaha', 'yamaha@gmail.com', '0928817228', '2023-11-06 01:44:00', '2023-11-06 01:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `trademarks`
--

CREATE TABLE `trademarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trademarks`
--

INSERT INTO `trademarks` (`id`, `shop_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(2, 1, 'Honda', NULL, '2023-11-04 12:42:48', '2023-11-04 12:42:48'),
(3, 1, 'Yamaha', NULL, '2023-11-04 12:42:56', '2023-11-04 12:42:56'),
(4, 1, 'Piaggio', NULL, '2023-11-04 12:44:06', '2023-11-04 12:44:06'),
(5, 1, 'Suzuki', NULL, '2023-11-04 12:44:14', '2023-11-04 12:44:14'),
(6, 1, 'Triumph', NULL, '2023-11-04 12:44:26', '2023-11-04 12:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `gender` tinyint(4) DEFAULT 1,
  `birthday` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `shop_id`, `user_no`, `name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `address`, `status`, `gender`, `birthday`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 1, 'ND000001', 'Admin', 'admin@gmail.com', '0928817228', NULL, '$2y$10$v1V/ILKaqTALBsGWm4FM9OW5Iyzynld.X.mfRCcWWcJ41ZhXyOj/W', '2023-11-11__85a31eb5876669c90c4da3a15773e2d2.jpg', 'sdfsdfsdf', 1, 1, '2003-06-22', 'T1HRtbx69X9CY673WYtbptPm2gtmHWKpAyYSldyQcw4xEBKrNLLzw0lYVlt2', '2023-10-20 13:23:22', '2023-12-01 19:44:56'),
(4, NULL, 'ND000002', 'Nguyễn Văn Dược', 'duocnvoit@gmail.com', '0359020898', NULL, '$2y$10$0eM8ROBE0LQN7xH0Z6HjKe8YBC4VuUIGroRpB.fhjxZUgkIqcNKvq', NULL, 'Thái Bình', 1, 1, NULL, NULL, NULL, '2023-10-23 03:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `warehouse_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `selling_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `shop_id`, `user_id`, `warehouse_no`, `name`, `note`, `type`, `created_at`, `updated_at`, `selling_id`) VALUES
(3, 1, 2, '16996312268168', 'Nhập kho SHi 350', 'Nhập kho SHi 350', 1, '2023-11-10 08:47:00', '2023-11-10 21:34:32', NULL),
(4, 1, 2, '16996774887237', 'Nhập kho ngày 11/11', 'Nhập kho ngày 11/11', 1, '2023-11-10 21:38:01', '2023-11-10 21:38:01', NULL),
(7, 1, 2, '17006627803555', 'Xuất hàng tới kho số 1', 'Xuất hàng tới kho số 1', 2, '2023-11-22 07:19:33', '2023-11-22 07:19:33', NULL),
(8, 1, 2, '17008125948790', 'Nguyễn Văn A', 'bán cho khacha A', 3, '2023-11-24 00:56:31', '2023-11-24 09:20:55', 1),
(10, 1, 2, '17008165358779', 'Nhập hàng vào kho', 'Nhập hàng vào kho', 1, '2023-11-24 02:02:10', '2023-11-24 02:02:10', NULL),
(11, 1, 2, '17013572526690', 'nhập kho ngày 30/11/2023', 'nhập kho ngày 30/11/2023', 1, '2023-11-30 08:14:06', '2023-11-30 08:14:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_shop_id_foreign` (`shop_id`),
  ADD KEY `categories_trademark_id_foreign` (`trademark_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_permission_name_unique` (`name`);

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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_group_permission_id_foreign` (`group_permission_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`),
  ADD KEY `products_trademark_id_foreign` (`trademark_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_warehousing`
--
ALTER TABLE `product_warehousing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_warehousing_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `product_warehousing_product_id_foreign` (`product_id`),
  ADD KEY `product_warehousing_supplier_id_foreign` (`supplier_id`),
  ADD KEY `product_warehousing_customer_id_foreign` (`customer_id`),
  ADD KEY `product_warehousing_branch_id_foreign` (`branch_id`),
  ADD KEY `product_warehousing_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `trademarks`
--
ALTER TABLE `trademarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trademarks_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_user_no_unique` (`user_no`),
  ADD KEY `users_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouses_shop_id_foreign` (`shop_id`),
  ADD KEY `warehouses_user_id_foreign` (`user_id`),
  ADD KEY `warehouses_selling_id_foreign` (`selling_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_warehousing`
--
ALTER TABLE `product_warehousing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trademarks`
--
ALTER TABLE `trademarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_trademark_id_foreign` FOREIGN KEY (`trademark_id`) REFERENCES `trademarks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_group_permission_id_foreign` FOREIGN KEY (`group_permission_id`) REFERENCES `group_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_trademark_id_foreign` FOREIGN KEY (`trademark_id`) REFERENCES `trademarks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_warehousing`
--
ALTER TABLE `product_warehousing`
  ADD CONSTRAINT `product_warehousing_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehousing_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trademarks`
--
ALTER TABLE `trademarks`
  ADD CONSTRAINT `trademarks_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD CONSTRAINT `warehouses_selling_id_foreign` FOREIGN KEY (`selling_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouses_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `warehouses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
