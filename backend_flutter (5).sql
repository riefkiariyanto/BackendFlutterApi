-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2023 pada 16.39
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend_flutter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'admin1', 'admin1@admin.com', NULL, '$2y$10$PHrSLlt/E7kRxBluxiarpuCqGAdta6TqG5xuCBWLPq2Y8/AipmP.y', NULL, '2023-11-20 00:54:17', '2023-11-20 00:54:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata_toko`
--

CREATE TABLE `biodata_toko` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `id_clients` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `logo` text NOT NULL,
  `front_store` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biodata_toko`
--

INSERT INTO `biodata_toko` (`id`, `id_clients`, `store_name`, `address`, `no_telp`, `latitude`, `longitude`, `logo`, `front_store`, `created_at`, `updated_at`) VALUES
(3, 6, 'Orino Pet Shop and vet Clinic', 'Jl. Saxophone Ruko Green Village No.3, Kota Malang, Jawa Timur 65144', '081230697181', '-7.9278347', '112.603927', '1692075180.png', '1692075173.png', '2023-11-19 20:59:44', '2023-11-19 20:59:44'),
(4, 7, 'happy pets', 'Jl. Saxophone Ruko Green Village No.3, Kota Malang, Jawa Timur 65144', '081230639477', '-7.9396733', '112.606263', '1692078706.gif', '1692078706.jpg', '2023-11-19 21:01:20', '2023-11-19 21:01:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_products` bigint(20) UNSIGNED NOT NULL,
  `id_biodata_toko` bigint(11) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `id_products`, `id_biodata_toko`, `id_user`, `qty`, `date`, `status`, `created_at`, `updated_at`) VALUES
(364, 17, 3, 12, 1, '2023-11-21', 'pending', '2023-11-21 15:05:51', '2023-11-21 15:05:51'),
(365, 18, 4, 12, 1, '2023-11-21', 'pending', '2023-11-21 15:06:15', '2023-11-21 15:06:15'),
(366, 23, 3, 12, 1, '2023-11-21', 'pending', '2023-11-21 15:10:05', '2023-11-21 15:10:05'),
(367, 26, 3, 12, 1, '2023-11-21', 'pending', '2023-11-21 15:10:09', '2023-11-21 15:10:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'test1', 'test1@gmail.com', NULL, '$2y$10$ezT50ZSdm1Wte56nU1VMIuj.zVK..yHiKN/9rPOtrR8MOGecuUYQ2', NULL, '2023-08-14 21:50:08', '2023-08-14 21:50:08'),
(7, 'test2', 'test2@gmail.com', NULL, '$2y$10$hYgOQyhpdWabv2q.4RFjfuOA903sBRbsPSZpwZTsHi9X7189Pn6h2', NULL, '2023-08-14 22:51:09', '2023-08-14 22:51:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_30_120553_create_admins_table', 1),
(6, '2023_07_16_070054_create_clients_table', 1),
(14, '2014_10_12_000000_create_users_table', 1),
(15, '2014_10_12_100000_create_password_resets_table', 1),
(16, '2019_08_19_000000_create_failed_jobs_table', 1),
(17, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(18, '2022_03_30_120553_create_admins_table', 1),
(19, '2023_07_16_070054_create_clients_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'backend_flutter', 'c91d074cc2628880510e2bb6bb0321b95c9258d06a7d8376c06d479e1d022a1a', '[\"*\"]', NULL, '2023-08-07 08:16:05', '2023-08-07 08:16:05'),
(2, 'App\\Models\\User', 3, 'backend_flutter', '974c0e32164e0814fd410d881f83da4dc140a5b8281328c31f16bee27d75dbed', '[\"*\"]', NULL, '2023-08-14 22:27:10', '2023-08-14 22:27:10'),
(3, 'App\\Models\\User', 4, 'backend_flutter', '2490721cda20be834731a27c54a78c1fa72c21d2607620831dd7ad3a0a53fc38', '[\"*\"]', NULL, '2023-08-14 22:49:46', '2023-08-14 22:49:46'),
(4, 'App\\Models\\User', 5, 'backend_flutter', '49b106c4955bf283e36f40e9a81434567a86261aaec4916f9c3fb128406a1083', '[\"*\"]', NULL, '2023-08-17 07:33:07', '2023-08-17 07:33:07'),
(5, 'App\\Models\\User', 6, 'backend_flutter', 'caaf1659cb1315b162fe0bcc5f97951485dd11df773dabda2d057b039599e043', '[\"*\"]', NULL, '2023-08-17 09:55:53', '2023-08-17 09:55:53'),
(6, 'App\\Models\\User', 5, 'backend_flutter', '7e245363d6801d1832e233b554e7aa26bce57525c4a6d038ed2ed43520ec987b', '[\"*\"]', NULL, '2023-08-17 10:19:18', '2023-08-17 10:19:18'),
(7, 'App\\Models\\User', 5, 'backend_flutter', 'd888e124e85a5055b593151488efa1cd63c3e779353bb51a44d0cb95f16e0172', '[\"*\"]', NULL, '2023-08-17 10:27:12', '2023-08-17 10:27:12'),
(8, 'App\\Models\\User', 5, 'backend_flutter', '709e24cab66e641d036bb016be5aa1e3a7833d5025466bf7c2c093cc534ac8c0', '[\"*\"]', NULL, '2023-08-17 10:28:56', '2023-08-17 10:28:56'),
(9, 'App\\Models\\User', 7, 'backend_flutter', '4932c817bea3aba265d1f8fc6bf997548bb22f45f34648c6797788671f863425', '[\"*\"]', NULL, '2023-08-17 10:30:16', '2023-08-17 10:30:16'),
(10, 'App\\Models\\User', 5, 'backend_flutter', '1103a86641aa43fb7923742866797b00fc465ac8dd30884c301d4df4f3d7556a', '[\"*\"]', NULL, '2023-08-17 10:30:40', '2023-08-17 10:30:40'),
(11, 'App\\Models\\User', 7, 'backend_flutter', 'cb5823dfb5d70d56eb7f814df8420d9a9753d49cd7546d730fdc4bb841a5fbb9', '[\"*\"]', NULL, '2023-08-17 10:31:55', '2023-08-17 10:31:55'),
(12, 'App\\Models\\User', 5, 'backend_flutter', '615290ec9ac45c2d834b39469c0cd057d1edff559eac2d88e6e193c63a887380', '[\"*\"]', NULL, '2023-08-17 10:39:28', '2023-08-17 10:39:28'),
(13, 'App\\Models\\User', 8, 'backend_flutter', '6061d6f96a5c2a3faacfacfc014e508d51a08136638249d8e8e9e34c03d9adf7', '[\"*\"]', NULL, '2023-08-17 11:03:53', '2023-08-17 11:03:53'),
(14, 'App\\Models\\User', 7, 'backend_flutter', '075b59fd88117dc6757a1b9809ceef6350c74f81c3d6d1f3f044969b2e080d2e', '[\"*\"]', NULL, '2023-08-17 11:09:20', '2023-08-17 11:09:20'),
(15, 'App\\Models\\User', 5, 'backend_flutter', '527c624bb0a9273eadf419267ce318077b3a4a36b8e40ed6da6c83cbc26acdf5', '[\"*\"]', NULL, '2023-08-17 11:09:35', '2023-08-17 11:09:35'),
(16, 'App\\Models\\User', 7, 'backend_flutter', 'a3a2c519d38d7cdf43329f354cca0d7b808ee210a4c68d9f06852531f2a5a3b6', '[\"*\"]', NULL, '2023-08-17 11:41:39', '2023-08-17 11:41:39'),
(17, 'App\\Models\\User', 7, 'backend_flutter', 'a2f5882a3c6ba63921f6462f149cb18b5a4d748d5764bfb8cbf931cb051da2ba', '[\"*\"]', NULL, '2023-08-17 19:53:38', '2023-08-17 19:53:38'),
(18, 'App\\Models\\User', 5, 'backend_flutter', '5dbc416938c19898125820ea2342a2ef2dab46a2e636ce907987986f6ebc0ac3', '[\"*\"]', NULL, '2023-08-17 20:04:49', '2023-08-17 20:04:49'),
(19, 'App\\Models\\User', 7, 'backend_flutter', '93af23402170fb28ddf761596602790c62e7ac9de42aa03d95c162f43f34d830', '[\"*\"]', NULL, '2023-08-17 21:34:51', '2023-08-17 21:34:51'),
(20, 'App\\Models\\User', 7, 'backend_flutter', '9d2a6a9beb6515358c5c20c26c80f298a50b0a7cad3c8d1cea9b838e0d182179', '[\"*\"]', NULL, '2023-08-20 23:13:20', '2023-08-20 23:13:20'),
(21, 'App\\Models\\User', 7, 'backend_flutter', '7c4144b4d3545e02b70cfb34763159536143d80d9e3ab4945e7843a5673aeb72', '[\"*\"]', NULL, '2023-08-20 23:28:52', '2023-08-20 23:28:52'),
(22, 'App\\Models\\User', 5, 'backend_flutter', '416568ab40dd79ee72760b77abcb2d4041a772ed72af9bfe2847714a07665830', '[\"*\"]', NULL, '2023-08-21 00:18:41', '2023-08-21 00:18:41'),
(23, 'App\\Models\\User', 7, 'backend_flutter', 'e784f0a555932b6258155ba0f73e03f13d8fa8130c52345ebfb1698865de240f', '[\"*\"]', NULL, '2023-08-21 00:27:40', '2023-08-21 00:27:40'),
(24, 'App\\Models\\User', 7, 'backend_flutter', 'a0f8373c0a31517d4c1e0f3b0180ad97c90b68cb12b53c724f6c559900517a9d', '[\"*\"]', NULL, '2023-08-21 02:03:33', '2023-08-21 02:03:33'),
(25, 'App\\Models\\User', 7, 'backend_flutter', '2474967d10724640341310f82cf1f2e6cb2ea573b6b4a28137869e545e48bc0e', '[\"*\"]', NULL, '2023-08-21 04:33:10', '2023-08-21 04:33:10'),
(26, 'App\\Models\\User', 7, 'backend_flutter', '8516909d23c13281a57535285832b2d19205df627b26b8a60fd116fa9d79023b', '[\"*\"]', NULL, '2023-08-21 04:33:30', '2023-08-21 04:33:30'),
(27, 'App\\Models\\User', 7, 'backend_flutter', '32b73fe711ea7e05bcda75a104a627d8d4d9f6a4524d75a98a8e3e3b698c0d4b', '[\"*\"]', NULL, '2023-08-21 04:38:48', '2023-08-21 04:38:48'),
(28, 'App\\Models\\User', 7, 'backend_flutter', 'adbeef0cfac49b49f6c57f01a4c5d83ba899d3d967345fb73edbeef3e2224b98', '[\"*\"]', NULL, '2023-08-21 04:41:21', '2023-08-21 04:41:21'),
(29, 'App\\Models\\User', 7, 'backend_flutter', '4819ed7eb2b72dfee3eb0a1be15218cb868a2ac591b03a2454e4f4b5d2499b7d', '[\"*\"]', NULL, '2023-08-21 04:43:56', '2023-08-21 04:43:56'),
(30, 'App\\Models\\User', 7, 'backend_flutter', '6957adc96bae13f16b85e6ec56f854d3d8b01bbd4b4aa216c974615ead675094', '[\"*\"]', NULL, '2023-08-21 04:45:16', '2023-08-21 04:45:16'),
(31, 'App\\Models\\User', 7, 'backend_flutter', 'e827ee384f1e732f73427e5801b648695055f969044d3eccb86a95249fd057d3', '[\"*\"]', NULL, '2023-08-21 04:46:29', '2023-08-21 04:46:29'),
(32, 'App\\Models\\User', 5, 'backend_flutter', 'e642c0372acdbbc11559103d0d924b090ca0e9dbe846f47c19c72c2975448c2d', '[\"*\"]', NULL, '2023-08-21 04:56:24', '2023-08-21 04:56:24'),
(33, 'App\\Models\\User', 7, 'backend_flutter', 'f3c9d4a62f7e825a84e52064115edee088fb7a2db77e39606d33b658f3b24921', '[\"*\"]', NULL, '2023-08-21 04:57:14', '2023-08-21 04:57:14'),
(34, 'App\\Models\\User', 7, 'backend_flutter', '1c68fdbb17807cc171502aab651eb3bc527ecf5455640813c450380312f461e4', '[\"*\"]', NULL, '2023-08-21 06:07:24', '2023-08-21 06:07:24'),
(35, 'App\\Models\\User', 7, 'backend_flutter', '967337cda0121e2517fc9f4a27a5df90f982dc60f6c3cb4a318b37647c81adfd', '[\"*\"]', NULL, '2023-08-21 19:13:38', '2023-08-21 19:13:38'),
(36, 'App\\Models\\User', 7, 'backend_flutter', 'fdcf4561e90e630bc0b190d4f9e1811ac89ff3b592d4af4d0032c0664edca51d', '[\"*\"]', NULL, '2023-08-22 06:37:50', '2023-08-22 06:37:50'),
(37, 'App\\Models\\User', 5, 'backend_flutter', 'add1b1f9c1da7084323a236ee5ff4986e91c817ec63adf42728467a714daa267', '[\"*\"]', NULL, '2023-08-22 06:40:31', '2023-08-22 06:40:31'),
(38, 'App\\Models\\User', 7, 'backend_flutter', '704d0584adea74b0a39c12248865f3885b96cfff62767cd3762bfeeaeaa3f2a9', '[\"*\"]', NULL, '2023-08-22 06:40:48', '2023-08-22 06:40:48'),
(39, 'App\\Models\\User', 5, 'backend_flutter', 'd59d9e25bba19cc58b2d51ae55582586cc5487240905b2c1a07cc76f874a2ed8', '[\"*\"]', NULL, '2023-08-22 06:45:17', '2023-08-22 06:45:17'),
(40, 'App\\Models\\User', 8, 'backend_flutter', 'd22de694e7fb6a39b710031bff2d53e5906ed04c3a8f388f339e04fe701832f8', '[\"*\"]', NULL, '2023-08-22 06:45:39', '2023-08-22 06:45:39'),
(41, 'App\\Models\\User', 9, 'backend_flutter', '30601424d8db1e120268045e7715546d1c28372c2ee250d9c71aff27828708d1', '[\"*\"]', NULL, '2023-08-22 06:47:15', '2023-08-22 06:47:15'),
(42, 'App\\Models\\User', 5, 'backend_flutter', '5ecbe3d2c31c9d0cc5ad4dd8f5b15519f4bf388ea8a933b4e71f74daabdf6838', '[\"*\"]', NULL, '2023-08-22 07:03:30', '2023-08-22 07:03:30'),
(43, 'App\\Models\\User', 9, 'backend_flutter', '2901e1a5ac6046f0595632f3976352067753c5af19ec409bbe3de8e640b527f0', '[\"*\"]', NULL, '2023-08-22 09:09:23', '2023-08-22 09:09:23'),
(44, 'App\\Models\\User', 9, 'backend_flutter', 'd81b425b502c0df8d7fd747f1016fc9f67a0f0d34978da3ab05db756cf090bde', '[\"*\"]', NULL, '2023-08-22 12:37:30', '2023-08-22 12:37:30'),
(45, 'App\\Models\\User', 9, 'backend_flutter', '36da762792132a9cf7d3584c1faf445666ebfd9b534660d250da99b219082728', '[\"*\"]', NULL, '2023-08-22 13:21:12', '2023-08-22 13:21:12'),
(46, 'App\\Models\\User', 9, 'backend_flutter', '5bae1a4eb4c816e1ab695aacee7cc7346ffbf0ebf1fcdaa6a766fa8f81d30518', '[\"*\"]', NULL, '2023-08-22 13:33:54', '2023-08-22 13:33:54'),
(47, 'App\\Models\\User', 9, 'backend_flutter', 'dbbed96fdcffa4f171a7f6d3d39406a16c3f7c8af23113c13d6d9623302bd635', '[\"*\"]', NULL, '2023-08-22 13:37:02', '2023-08-22 13:37:02'),
(48, 'App\\Models\\User', 9, 'backend_flutter', '145844b3f919ea099a45081ab94ce0f9a08558e03a687e63191857420d37d9b1', '[\"*\"]', NULL, '2023-08-22 21:32:48', '2023-08-22 21:32:48'),
(49, 'App\\Models\\User', 9, 'backend_flutter', 'acd0fd6a686cd44ff0c80042ed0af6aba75327052e9097a65ee17d2d5e7cbcd8', '[\"*\"]', NULL, '2023-08-22 21:57:59', '2023-08-22 21:57:59'),
(50, 'App\\Models\\User', 9, 'backend_flutter', '947bc5135d9f9ca2e2b7a302fa26f8222a51c9540237505f245a08005b08bf9d', '[\"*\"]', NULL, '2023-08-22 22:14:28', '2023-08-22 22:14:28'),
(51, 'App\\Models\\User', 9, 'backend_flutter', 'a4be3e66501465c67fd46397845ac6d1a9f43e372df7836cc0e26758f9e2ae0c', '[\"*\"]', NULL, '2023-08-22 23:13:15', '2023-08-22 23:13:15'),
(52, 'App\\Models\\User', 9, 'backend_flutter', '193b6a6af2650d05abddc07377895e6c1b180fd4caccc68f15af53438c332c9d', '[\"*\"]', NULL, '2023-08-22 23:22:36', '2023-08-22 23:22:36'),
(53, 'App\\Models\\User', 9, 'backend_flutter', '080e57b9d922e5179136b1b1eaf6240adb2edee34781e03568f933d391b8f720', '[\"*\"]', NULL, '2023-08-23 01:01:44', '2023-08-23 01:01:44'),
(54, 'App\\Models\\User', 9, 'backend_flutter', '55b1455ab667727beb71d5a5b6bc6969f4ce0549ada9b3b21a6583c406906e02', '[\"*\"]', NULL, '2023-08-23 01:02:46', '2023-08-23 01:02:46'),
(55, 'App\\Models\\User', 9, 'backend_flutter', 'bcae9fb8822efba2d06de5e09d5428f1d07e8c77b603f37ba1261233aaaea6f2', '[\"*\"]', NULL, '2023-08-23 01:37:38', '2023-08-23 01:37:38'),
(56, 'App\\Models\\User', 9, 'backend_flutter', 'ebd6e2b5b2f508b526067a46827f1d2d639be4b4fe43588b942719f2c0a8f79e', '[\"*\"]', NULL, '2023-08-23 04:06:24', '2023-08-23 04:06:24'),
(57, 'App\\Models\\User', 9, 'backend_flutter', '8d5ca98a0ebcd96d2607bee0bc668803826146d74b757c885e6b0e29cc857615', '[\"*\"]', NULL, '2023-08-23 06:27:28', '2023-08-23 06:27:28'),
(58, 'App\\Models\\User', 9, 'backend_flutter', '78dcf20f253bf10c3ed0f7bbc9ae3e24a88de9e98f2140dd4436c485a1bc56f6', '[\"*\"]', NULL, '2023-08-23 07:26:35', '2023-08-23 07:26:35'),
(59, 'App\\Models\\User', 9, 'backend_flutter', '924c79d284f3ca677fc0b5c3f4d6c5d96669c8fe5d56b2f93134291e8105ebd8', '[\"*\"]', NULL, '2023-08-23 08:58:15', '2023-08-23 08:58:15'),
(60, 'App\\Models\\User', 9, 'backend_flutter', '311ae2adfc5ed2b52ed7b32995474fa6b98804cf50fb1eba36dfba7e7cb8a7c2', '[\"*\"]', NULL, '2023-08-23 09:23:16', '2023-08-23 09:23:16'),
(61, 'App\\Models\\User', 9, 'backend_flutter', 'dcf887fb9a59fff7cc0f5e9e3a9fcf94e7dd6cdb1f2e911c91bf350525c9bddb', '[\"*\"]', NULL, '2023-08-23 09:25:00', '2023-08-23 09:25:00'),
(62, 'App\\Models\\User', 9, 'backend_flutter', 'e6e463503849cf561c7cd167d4f973db098aa67450416b17327a2f6b7af52c10', '[\"*\"]', NULL, '2023-08-23 09:26:49', '2023-08-23 09:26:49'),
(63, 'App\\Models\\User', 5, 'backend_flutter', 'bf2f8de7387a8bc6a5483cf4aac39c1701a4d074728d4a6610dce33ee49fb743', '[\"*\"]', NULL, '2023-08-23 09:51:47', '2023-08-23 09:51:47'),
(64, 'App\\Models\\User', 9, 'backend_flutter', 'd613ec3a5aecca724b4ca29cdb114b4f8b64e94d5f0594cd68586cee79b5ad3c', '[\"*\"]', NULL, '2023-08-23 17:42:24', '2023-08-23 17:42:24'),
(65, 'App\\Models\\User', 9, 'backend_flutter', 'f82844227c57514364ca94239eccbd063b47f0a9716080e2ff8e1f01d0552862', '[\"*\"]', NULL, '2023-08-23 18:52:32', '2023-08-23 18:52:32'),
(66, 'App\\Models\\User', 9, 'backend_flutter', '7727dfb8724fa34e5489f284cd4dd2823c9d479f0beffd4ce6f18577603f875c', '[\"*\"]', NULL, '2023-08-23 19:59:52', '2023-08-23 19:59:52'),
(67, 'App\\Models\\User', 9, 'backend_flutter', 'b209c23675affda3aa56e1edc3e0a11d0a6f0956bb56cb4e267f268ef3c757aa', '[\"*\"]', NULL, '2023-08-23 21:00:09', '2023-08-23 21:00:09'),
(68, 'App\\Models\\User', 9, 'backend_flutter', '324b6b2e786ada94dd8569def0f66123a6bb903e43977dbe71ea0a5d09afe60e', '[\"*\"]', NULL, '2023-08-23 22:27:25', '2023-08-23 22:27:25'),
(69, 'App\\Models\\User', 9, 'backend_flutter', '9b9985550afe2faf3ba61090ac360f24b13776dbedf5834ead0fde176cb85640', '[\"*\"]', NULL, '2023-08-23 23:47:37', '2023-08-23 23:47:37'),
(70, 'App\\Models\\User', 9, 'backend_flutter', 'eea75984a96e31c55c071e2e1fd58ef6b09fa24abcd1874e4c14c282acf9d58f', '[\"*\"]', NULL, '2023-08-24 13:13:25', '2023-08-24 13:13:25'),
(71, 'App\\Models\\User', 9, 'backend_flutter', '5ceeeffb0420b1feb0a3d914e3df46a5095643f205dcad96443687c7ad9258e9', '[\"*\"]', NULL, '2023-08-25 08:19:10', '2023-08-25 08:19:10'),
(72, 'App\\Models\\User', 5, 'backend_flutter', 'b5b03c3ddda92ae9bb89c81ac52bf1287d44a09dbe1c1d9f59dbe0059daa441d', '[\"*\"]', NULL, '2023-08-25 08:49:48', '2023-08-25 08:49:48'),
(73, 'App\\Models\\User', 9, 'backend_flutter', 'f2bbf47f882c6dc1dc35bcd7231d2779ee37751211f864e694ef34a8a978d03b', '[\"*\"]', NULL, '2023-08-25 08:50:18', '2023-08-25 08:50:18'),
(74, 'App\\Models\\User', 9, 'backend_flutter', '75db76e84dbf39addf48f7791003c8fcfb366a0ab91990158185ff6fc36a4646', '[\"*\"]', NULL, '2023-08-28 03:23:51', '2023-08-28 03:23:51'),
(75, 'App\\Models\\User', 9, 'backend_flutter', '49ec261bc373268201162d2e42b8b7f0c42f61aa45cd6615a8bd7ce7072d181a', '[\"*\"]', NULL, '2023-08-30 07:38:36', '2023-08-30 07:38:36'),
(76, 'App\\Models\\User', 9, 'backend_flutter', 'c8fecdb0f456c957c12f38c1aacc68bb8f8ad81f0ea05cb5674ae8f70137ff29', '[\"*\"]', NULL, '2023-08-31 23:35:11', '2023-08-31 23:35:11'),
(77, 'App\\Models\\User', 9, 'backend_flutter', '5a8e43d0f96b61364dc69e8e56435c8bbabea374850c0d6281d398acb318bf38', '[\"*\"]', NULL, '2023-08-31 23:41:26', '2023-08-31 23:41:26'),
(78, 'App\\Models\\User', 9, 'backend_flutter', '4b3546e8210b04f41357af01f3d1711834dea33567510de3ea52fd4ec53170fa', '[\"*\"]', NULL, '2023-09-01 00:13:53', '2023-09-01 00:13:53'),
(79, 'App\\Models\\User', 9, 'backend_flutter', 'cb680fc3e8099fdeca5662502c8ed705cbcb4a8762261f0eddf824cb74433cf4', '[\"*\"]', NULL, '2023-09-01 00:17:35', '2023-09-01 00:17:35'),
(80, 'App\\Models\\User', 9, 'backend_flutter', 'f053c214e9d67ab5e449204f565250b68d1afb13807c3d8bf20894b81be97734', '[\"*\"]', NULL, '2023-09-01 00:18:44', '2023-09-01 00:18:44'),
(81, 'App\\Models\\User', 9, 'backend_flutter', 'f0f48e5b1389905fb9c9b60e69d87369e68021c2bbdb30ca0369e81a09e4ba91', '[\"*\"]', NULL, '2023-09-01 00:59:24', '2023-09-01 00:59:24'),
(82, 'App\\Models\\User', 9, 'backend_flutter', 'af918f807f5c1b89b08ebe410502a48e7a0a118535ed3f6fadd33c8bd1fa8d26', '[\"*\"]', NULL, '2023-09-01 01:01:31', '2023-09-01 01:01:31'),
(83, 'App\\Models\\User', 9, 'backend_flutter', 'a872c973ce23f401fe0170e91a8f93c59c97e229e3e84b8ad55f8acffae9e7b1', '[\"*\"]', NULL, '2023-09-01 01:03:47', '2023-09-01 01:03:47'),
(84, 'App\\Models\\User', 9, 'backend_flutter', 'e7a3a4e3a5c7b6fcc07ed3e7978b2e58b9412f44b6de791d0beedcb4b8174dee', '[\"*\"]', NULL, '2023-09-01 01:51:20', '2023-09-01 01:51:20'),
(85, 'App\\Models\\User', 9, 'backend_flutter', '3518dc5ed9707a6f8c668e8204f2c8aaeda60a10f166d4fd3e4c3069fb5280ea', '[\"*\"]', NULL, '2023-09-01 03:02:16', '2023-09-01 03:02:16'),
(86, 'App\\Models\\User', 9, 'backend_flutter', 'd5e3088882cc11b7bb1dba67b90e255e1efa2cd4ff1fe9a3c3816ca4a58232d6', '[\"*\"]', NULL, '2023-09-01 03:05:22', '2023-09-01 03:05:22'),
(87, 'App\\Models\\User', 9, 'backend_flutter', 'b345e973cc0d0c12c6f7a5afe1e90c431df59883ed36d8e91f6c2ebdcc238503', '[\"*\"]', NULL, '2023-09-01 03:13:49', '2023-09-01 03:13:49'),
(88, 'App\\Models\\User', 9, 'backend_flutter', '8bbde68412954140abfb5314bd75310a32c52bea060fa5db24aa344ee5fcde3f', '[\"*\"]', NULL, '2023-09-01 03:18:53', '2023-09-01 03:18:53'),
(89, 'App\\Models\\User', 9, 'backend_flutter', '76033706d4e90ddbfe0e36237bb01ed03944e33e2a435c8800c28683c1177e9c', '[\"*\"]', NULL, '2023-09-01 04:20:05', '2023-09-01 04:20:05'),
(90, 'App\\Models\\User', 9, 'backend_flutter', '170af7c65f6dbcd81c14cb71cf6741596b6a51d07e9f44cc347e66b8bbded47d', '[\"*\"]', NULL, '2023-09-01 04:22:07', '2023-09-01 04:22:07'),
(91, 'App\\Models\\User', 9, 'backend_flutter', '1916ed0a04d6f45166f532681796ca9f62845278d13b25bf460a474b72aaf8a1', '[\"*\"]', NULL, '2023-09-06 21:58:12', '2023-09-06 21:58:12'),
(92, 'App\\Models\\User', 9, 'backend_flutter', '23de9d8b4f2cfc5c9770dc13a28683585245e666ddfaa0992dd4bebd3c340145', '[\"*\"]', NULL, '2023-09-06 22:08:19', '2023-09-06 22:08:19'),
(93, 'App\\Models\\User', 9, 'backend_flutter', '685d3c2d278236b8bc5af99b36846af4d6bf1f80890b287b6625f1254b1fc7f3', '[\"*\"]', NULL, '2023-09-06 22:27:10', '2023-09-06 22:27:10'),
(94, 'App\\Models\\User', 9, 'backend_flutter', 'e469c241085bec794830020ed1ba053feecf09103a9f55a13342844449f1efc8', '[\"*\"]', NULL, '2023-09-06 23:25:46', '2023-09-06 23:25:46'),
(95, 'App\\Models\\User', 9, 'backend_flutter', '31cd0b1737c4777c30a828c49028701f8954a9ac2f4d0f0f4e43f6b2773dfe8d', '[\"*\"]', NULL, '2023-09-07 08:40:55', '2023-09-07 08:40:55'),
(96, 'App\\Models\\User', 9, 'backend_flutter', '91f1e706b0f7350b56bdd0cd9f91a5741eb72fecc601e1c110b9ad2fa3c2a1cb', '[\"*\"]', NULL, '2023-09-07 08:50:49', '2023-09-07 08:50:49'),
(97, 'App\\Models\\User', 9, 'backend_flutter', 'dc5ef548f7f480c655a5689f719251951c87d9d5fd3325e5eeba06eb0f70577f', '[\"*\"]', NULL, '2023-09-10 05:32:26', '2023-09-10 05:32:26'),
(98, 'App\\Models\\User', 9, 'backend_flutter', 'dd6c91121b5c79166f637dd75ebfc305d8b499dc93df35384be1cf2c7ba30abe', '[\"*\"]', NULL, '2023-09-10 07:40:12', '2023-09-10 07:40:12'),
(99, 'App\\Models\\User', 9, 'backend_flutter', '475dc84906d8480490a6b0df390f786b24d8114e489cadb67df8affb4a263462', '[\"*\"]', NULL, '2023-09-10 08:08:06', '2023-09-10 08:08:06'),
(100, 'App\\Models\\User', 9, 'backend_flutter', '9fa5fd83d76bc831a130aa82a2d99a3c0d4ad53fe893a99cd5c64b85e452b246', '[\"*\"]', NULL, '2023-09-10 08:37:27', '2023-09-10 08:37:27'),
(101, 'App\\Models\\User', 9, 'backend_flutter', '2bdce4bf3256f0b75e41fca363fae13b0b9904a52522eff1902e84e1afd76cab', '[\"*\"]', NULL, '2023-09-10 09:48:24', '2023-09-10 09:48:24'),
(102, 'App\\Models\\User', 9, 'backend_flutter', 'bd9ceb62f6aa552ace030331b1115cf4b3650984015e3be5fb5b64f315f62063', '[\"*\"]', NULL, '2023-09-10 09:49:13', '2023-09-10 09:49:13'),
(103, 'App\\Models\\User', 9, 'backend_flutter', '5b1270ea6e9942458147c9ac00b4901146210f032a8e90085910bc10d4338421', '[\"*\"]', NULL, '2023-09-10 10:21:30', '2023-09-10 10:21:30'),
(104, 'App\\Models\\User', 9, 'backend_flutter', '66dc7d8694844bd98a28686175eda3f1f2f6851053d64752999c2518adafac88', '[\"*\"]', NULL, '2023-09-10 12:39:54', '2023-09-10 12:39:54'),
(105, 'App\\Models\\User', 9, 'backend_flutter', '87dd7c315c827b00a4c69d564c59c20d9fdaf0253b39db8b568d96e94beaf4db', '[\"*\"]', NULL, '2023-09-10 12:45:40', '2023-09-10 12:45:40'),
(106, 'App\\Models\\User', 9, 'backend_flutter', 'c05484de3599d4560de353c783e6380fd9e554d0bdbff28c3121054cb8b3187f', '[\"*\"]', NULL, '2023-09-11 05:38:58', '2023-09-11 05:38:58'),
(107, 'App\\Models\\User', 9, 'backend_flutter', '4c85119fefb34053c9ce91f308240806b8f0ffea6b33a78e8c9b310e8b2268a6', '[\"*\"]', NULL, '2023-09-12 05:33:01', '2023-09-12 05:33:01'),
(108, 'App\\Models\\User', 9, 'backend_flutter', 'c51962265654a5c5d5b45d5699f990507f99e572fe7bf137a470b2a276f57208', '[\"*\"]', NULL, '2023-09-12 05:58:40', '2023-09-12 05:58:40'),
(109, 'App\\Models\\User', 9, 'backend_flutter', 'f4a3df6157cfdda5b57de37e15e75971bcd7c5586f57eabe8911e0bb3df6e759', '[\"*\"]', NULL, '2023-09-12 06:34:16', '2023-09-12 06:34:16'),
(110, 'App\\Models\\User', 9, 'backend_flutter', 'e2e431e5eec5427d63bc6cccf2a9b0b8ac57f866a775e391228f6275743e6380', '[\"*\"]', NULL, '2023-09-12 06:40:05', '2023-09-12 06:40:05'),
(111, 'App\\Models\\User', 9, 'backend_flutter', '93106fd82a8bab39294e2d5c56d1872e45021ca5b1627e95523e5e100a3f99c5', '[\"*\"]', NULL, '2023-09-12 06:40:34', '2023-09-12 06:40:34'),
(112, 'App\\Models\\User', 5, 'backend_flutter', 'd15bcf76ad9770d3655f259ba7c9a53418ddb799d0bdb40c752427621d79c947', '[\"*\"]', NULL, '2023-09-12 06:51:14', '2023-09-12 06:51:14'),
(113, 'App\\Models\\User', 9, 'backend_flutter', 'f06ffd1828ecbf1fd5eca519bbed1bb9647612d6a119af7e38ef562c26d9a456', '[\"*\"]', NULL, '2023-09-12 09:28:44', '2023-09-12 09:28:44'),
(114, 'App\\Models\\User', 5, 'backend_flutter', '55d6328b22d0cfa2204a268806aad1e2b1e1a1afefe77e2844942693e3b21598', '[\"*\"]', NULL, '2023-09-13 00:26:27', '2023-09-13 00:26:27'),
(115, 'App\\Models\\User', 9, 'backend_flutter', 'da530be78452d4607e1ff8f3acab9a4ee0863266c25fefcd03ff8673d843d1b2', '[\"*\"]', NULL, '2023-09-13 05:49:34', '2023-09-13 05:49:34'),
(116, 'App\\Models\\User', 8, 'backend_flutter', 'a3b29dc64af7841b552810077de9165ef2683b64688621e922c2fd35a7f6b5d4', '[\"*\"]', NULL, '2023-09-14 04:29:30', '2023-09-14 04:29:30'),
(117, 'App\\Models\\User', 8, 'backend_flutter', 'd1a34679c1fa4ccee05fe65c22d1d6fe417c5685dee9ad30373363b2f78627f9', '[\"*\"]', NULL, '2023-09-14 05:13:57', '2023-09-14 05:13:57'),
(118, 'App\\Models\\User', 9, 'backend_flutter', '03f345a11278e322c66103a0172e4ea61ccb33d5b0845fd24ebb0becb3056159', '[\"*\"]', NULL, '2023-09-22 02:05:49', '2023-09-22 02:05:49'),
(119, 'App\\Models\\User', 9, 'backend_flutter', 'a2559e982d87e6c19823fc1115883d0c5d7cf9c66678667156001ff64f8e597a', '[\"*\"]', NULL, '2023-10-24 11:39:41', '2023-10-24 11:39:41'),
(120, 'App\\Models\\User', 9, 'backend_flutter', 'e56c6f12bee2fe54a0c625f60d1bd194d95dd44fd407664d2c88389a5705805b', '[\"*\"]', NULL, '2023-10-24 15:54:51', '2023-10-24 15:54:51'),
(121, 'App\\Models\\User', 9, 'backend_flutter', '90a6913bd7b09de38488167aa07cd8d213f571f37278e77fbce4b3063e8f0bc2', '[\"*\"]', NULL, '2023-11-02 06:49:02', '2023-11-02 06:49:02'),
(122, 'App\\Models\\User', 9, 'backend_flutter', '5fa15903c636f0a36f2931c799f7ba00110c3527dac41b83d277c34fa65523a4', '[\"*\"]', NULL, '2023-11-06 00:51:32', '2023-11-06 00:51:32'),
(123, 'App\\Models\\User', 5, 'backend_flutter', '7cff31a5635c33b34745fe101763d1cc60c43ac31b68fa090ccea1ae7f8311f2', '[\"*\"]', NULL, '2023-11-06 06:10:32', '2023-11-06 06:10:32'),
(124, 'App\\Models\\User', 9, 'backend_flutter', '201768130a2499060880ffb7edff9d7a3620d934414272da5248d93009730b96', '[\"*\"]', NULL, '2023-11-09 02:22:14', '2023-11-09 02:22:14'),
(125, 'App\\Models\\User', 8, 'backend_flutter', '99b4dc3c2356f2f52d7b63751b565518125adec194087f1939ab4fd3568b9028', '[\"*\"]', NULL, '2023-11-12 21:08:10', '2023-11-12 21:08:10'),
(126, 'App\\Models\\User', 5, 'backend_flutter', 'edcde020dbe5aa4f59201576e815659b46f618becbab4c8894ac6134515fbe8b', '[\"*\"]', NULL, '2023-11-12 21:31:04', '2023-11-12 21:31:04'),
(127, 'App\\Models\\User', 9, 'backend_flutter', 'a4c229efb4d8c9c3e04214a4f70e2ed32f31eaa3506c4ece4b815d7ddcc49abe', '[\"*\"]', NULL, '2023-11-14 03:30:22', '2023-11-14 03:30:22'),
(128, 'App\\Models\\User', 9, 'backend_flutter', '2458a29dc4f96d60d331e6c7d0eb0a0b3f60c3b35c4ee15e0fea5d18ab09aee0', '[\"*\"]', NULL, '2023-11-19 13:09:43', '2023-11-19 13:09:43'),
(129, 'App\\Models\\User', 10, 'backend_flutter', '5397d9eeefcff54c1b1eff0c4921be9e7f68e8e52ab35bb498dac61651af1d57', '[\"*\"]', NULL, '2023-11-20 22:51:00', '2023-11-20 22:51:00'),
(130, 'App\\Models\\User', 11, 'backend_flutter', '6259aa8a7ce10ed001123701846027c3f791dce57b7f7176cf44548c8d130341', '[\"*\"]', NULL, '2023-11-21 08:01:56', '2023-11-21 08:01:56'),
(131, 'App\\Models\\User', 12, 'backend_flutter', 'dda210ccae0910f9bb0251cafa5f4784cc751c697d100e5f3766f45119ea160d', '[\"*\"]', NULL, '2023-11-21 08:05:41', '2023-11-21 08:05:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idclient` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(9999) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `idclient`, `name`, `category`, `price`, `image`, `description`, `qty`, `created_at`, `updated_at`) VALUES
(11, 7, 'Wanpy 80g Snack kucing Snack Hwan Peliharaan Cat Strip Cat Wet Food', 'makanan hewan', '20000', '1692078995.png', 'Spesifikasi:\r\n100% baru dan berkualitas tinggi\r\nmakanan basah kucing daging segar\r\nBergizi untuk kucing dan anjing\r\nRasa: tuna; tuna + ikan teri kecil; daging ayam + kepiting; ayam + udang; rasa ayam; tuna + salmon;\r\n\r\nHarap dicatat bahwa tanggal pada kemasan adalah tanggal produksi.\r\ndan akan kedaluwarsa 24 bulan setelah tanggal produksi.', '12', '2023-08-14 22:56:35', '2023-08-14 22:56:35'),
(17, 6, 'TOSAND Bathing Sand Pasir Mandi Hamster', 'hamster', '9500', '1692712645.png', 'TOSAND Bathing Sand Pasir Mandi Hamster 500 + 100 GR\r\n\r\nPasir mandi Hamster untuk menjaga agar bulu tidak lembab dan menjadikan bulu hamster tetap bersih dan lembut.', '12', '2023-08-22 06:57:25', '2023-08-22 06:57:25'),
(18, 7, 'Snack anjing  Strip dog Wet Food', 'makanan hewan', '12000', '1692712890.png', 'snak hewan anjing dengan segala jenis umur', '50', '2023-08-22 07:01:30', '2023-08-22 07:01:30'),
(23, 6, 'PAW POWER Tofu Cat Litter Fast Clumping 7L - Pasir Kucing Gumpal Soya - Trial Size 1Kg, Green Tea', 'Kesehatan', '34900', '1696863038.jpg', 'Paw Power Tofu Cat Litter memiliki komposisi utama yang berasal dari bahan alami, yaitu serat kedelai dan pati jagung, sehingga mudah larut dalam air dan dapat dibuang dengan flushing ke toilet tanpa khawatir akan adanya penyumbatan pada saluran air. Terlebih lagi, Kandungan antiseptik dan antibakteri di dalamnya menciptakan lingkungan rumah dan kotak pasir anabul menjadi lebih higienis, sehingga Pawparents dapat merasa lebih tenang\r\n\r\nFitur:\r\n🐾 Penggumpalan kotoran anabul super cepat ⚡\r\n🐾 Bahan alami dan ramah lingkungan\r\n🐾 Menyerap bau kotoran anabul\r\n🐾 Mudah diflush di toilet dan cepat larut dalam air\r\n🐾 Cocok untuk semua usia kucing dari kitten sampai dewasa\r\n🐾 Toxic-free dan minim debu, sehingga aman bagi kesehatan anabul\r\n\r\nVarian:\r\n🐾 Original (Milk)\r\n🐾 Green Tea\r\n🐾 Charcoal (Activated Carbon)\r\n\r\nSpesifikasi\r\nKomposisi: serat kedelai, pati jagung, tepung, guar gum, antiseptik antioksidan, dan deodoran antibakteri', '100', '2023-10-09 07:50:38', '2023-10-09 07:50:38'),
(24, 6, 'Vitakraft Serbuk Kayu Bedding Alas Kandang Hamster Marmut Kelinci 15L', 'Kesehatan', '45000', '1696863413.jpg', 'Tempat tidur hewan kecil yang menyerap bau - bersih dan higienis dengan aroma alami. Serpihan-serpihan yang lembut ini terbuat dari kayu lembut yang belum diolah dan bukan saja ramah untuk hewan-hewan kecil tetapi juga ramah lingkungan karena dapat diurai menjadi kompos. Untuk memudahkan penyimpanan dan transportasi\r\n\r\nProduk alam terbuat dari kayu lembut yang belum diolah.\r\nBebas dari benda-benda yang terpolusi\r\nDengan aroma alami yang menyenangkan.\r\nBebas debu dan rendah iritasi\r\nMenyerap air dan tidak berbau, 100% dapat menjadi kompos', '100', '2023-10-09 07:56:53', '2023-10-09 07:56:53'),
(25, 6, 'Jogging Wheel Hamster', 'accesories', '25000', '1696863562.jpg', 'Diameter 11.5 cm', '50', '2023-10-09 07:59:23', '2023-10-09 07:59:23'),
(26, 6, 'Tempat Tidur Kasur Rumah Kucing Keranjang Tenda Hewan Cat Sleeping Bed - Size M', 'accesories', '100000', '1696863676.jpg', 'Spesifikasi\r\nMaterial Katun dan Velvet\r\nUkuran M: 35 x 33 x 33 cm\r\nTempat Hewan\r\nKeranjang Tidur ini didesain khusus untuk hewan peliharaan Anda seperti kucing dan anjing, sehingga mereka memiliki tempat sendiri dan tidak mengotori rumah Anda.\r\n\r\nDesain Tenda\r\nTempat tidur hewan peliharaan ini hadir dengan desain tenda yang tidak biasa dari kebanyakan tempat tidur hewan. Terdapat lubang di bagian depan agar hewan peliharaan Anda dapat keluar-masuk dengan mudah.\r\n\r\nBahan Berkualitas\r\nTenda hewan ini terbuat dari bahan katun dan velvet berkualitas yang empuk, sehingga hewan peliharaan Anda akan nyaman dan betah tidur di dalamnya.', '20', '2023-10-09 08:01:16', '2023-10-09 08:01:16'),
(27, 6, 'Pet Feeder M03 Tempat Makan Anjing/Kucing Dispenser Minum Hewan 2PCS', 'accesories', '50000', '1696863764.jpg', 'Keungulan Produk :\r\n-Berbahan material PP BPA Free yang tidak beracun, tidak berbau, dan juga pastinya aman untuk hewan peliharaan anda\r\n-Mangkuk yang dapat dilepas, dan mudah dibersihkan\r\n-Dengan kapasitas besar sehingga lebih banyak memuat makan dan minum\r\n-Lengkap dapat menuang air dan makanan dengan otomatis\r\n-Praktis dan mudah digunakan\r\n-1 set tempat makan ( 2.1 kg ) dan tempat minum ( 3.8 L )\r\n-Sudut kemiringan 15 derajat , makanan keluar otomatis\r\n-Hemat tempat\r\n\r\nDetail Produk :\r\nVarian : 1 Set, Tempat Makan, Tempat Minum\r\nUkuran Produk :14.8 x 27.9 cm\r\nBerat Produk 1Set : 1200g\r\nBerat Produk Tempat Makan / Minum : 600g\r\nUkuran Paket 1 Set : 35 x 16 x 30\r\nUkuran Paket Tempat Makan / Minum : 22 x 16 x 30\r\nBerat Volume / Paket 1 Set : 2.800\r\nBerat Volume / Paket Tempat Makan / Minum : 1.760\r\n(Pengukuran manual ada kemungkinan perbedaan 1-2 cm)\r\nKapasitas :\r\nTempat makan : 2.1 Kg (13-15 hari untuk hewan ukuran kecil, 5-6 hari untuk hewan ukuran besar)\r\nTempat minum ; 3.8 L (9-12 hari untuk hewan ukuran kecil, 7-9 hari untuk hewan ukuran besar)', '30', '2023-10-09 08:02:44', '2023-10-09 08:02:44'),
(28, 6, 'FOCAT Litter Box Kucing M21 Cat Toilet Tempat Bak Pasir Kucing Besar', 'accesories', '69000', '1696863881.jpg', 'Bak pasir hewan semi closed extra besar dapat memberi peliharaan anda tempat lebih luas untuk membuang air kecil/besar dengan nyaman. Dilengkapi dengan papan filter didepan bak untuk memastikan hewan peliharaan tidak membawa kotoran/pasir keluar dari bak. Terdapat free sekop untuk menyaring kotoran dari pasir dalam bak. Cocok bagi kalian yang ingin menyediakan toilet khusus untuk hewan rumah anda.\r\n\r\nKeunggulan produk :\r\n- Design semi-tertutup sehingga disukai dengan hewan peliharaan anda\r\n- Pagar 86mm extra tinggi sehingga pasir kucing tidak keluar dari bak\r\n- Ergonomis, higienis, efektif, effisien, ramah lingkungan dan mudah dibersihkan\r\n- Terdapat free sekop untuk memudahkan dan mempercepat mengangkatan kotoran dalam bak, sekop dapat di gantung di samping\r\n- Papan filter untuk mencegah hewan peliharaan keluar bak dengan pasir ditelapak tangan/kaki\r\n- Bak kapasitas 12L yang besar\r\n- Instalasi dan bongkar yang mudah untuk pembersihan\r\n\r\nUkuran: 18.5 x 34.5 x 50.5 CM\r\nMohon perhatian, pengukuran dilakukan secara manual, mungkin ada kesalahan 1-2cm, mohon merujuk ke produk', '50', '2023-10-09 08:04:41', '2023-10-09 08:04:41'),
(29, 7, 'Pet Cargo', 'accesories', '79000', '1696864028.png', 'Tas Gendongan Backpack Astronot merupakan tas ransel traveling untuk hewan peliharaan Anda. Tas ini memiliki desain yang cool, nyaman digunakan dan akan membuat orang melihat Anda ketika Anda membawanya berpergian. Anda tidak perlu repot-repot menggendong atau menuntun hewan Anda. Tas Gendongan Backpack Astronot ini di desain full frame transparan agar bisa memudahkan Anjing atau Kucing Anda memiliki pandangan luas dan tidak merasa stress ketika berada di dalamnya dan Anda pun bisa memperhatikan mereka pada saat berjalan.\r\n\r\n**Kualitas PREMIUM jangan tertipu dengan harga lebih murah, bisa dibandingkan**\r\n\r\nKeunggulan Tas Gendongan Backpack\r\n🐾Terbuat dari bahan yang tidak beracun, ramah lingkungan sehingga aman untuk Anda dan anjing atau kucing Anda.\r\n🐾Terdapat 3 lubang ventilasi udara di bagian bawah, 3 lubang ventilasi udara di bagian samping yang memastikan anjing atau kucing tidak kesulitan bernapas.\r\n🐾Terbuat dari material berkualitas yang tidak mudah rusak dan menjamin keamanan anjing atau kucing Anda.\r\n\r\n\r\nSpesifikasi:\r\n- Material : ABS, Transparent PC.', '15', '2023-10-09 08:07:08', '2023-10-09 08:07:08'),
(30, 7, 'Baju Kucing Anjing Model Dinosaurus Kostum Cat Dog Pakaian Hoodie', 'accesories', '35000', '1696864137.jpg', 'Kostum lucu untuk anabul. Terbuat dari bahan fleece yg halus, lembut dan nyaman dipakai.Bisa dipakai untuk semua jenis anjing dan kucing\r\n\r\nRekomendasi berat badan:\r\nXS 1-1.5kg\r\nS 1.5-2.5kg\r\nM 2-3kg\r\nL 3-4kg\r\nXL 4-6kg\r\nXXL 6-10kg', '20', '2023-10-09 08:08:57', '2023-10-09 08:08:57'),
(31, 7, 'Shampoo Conditioner 2in1/Anti Jamur/Anti Kutu Khusus Anjing dan Kucing - 250 ml, Anti Fungal', 'Kesehatan', '33000', '1696864257.jpg', 'Zoologe Shampoo terdiri dari :\r\n- 2 in 1 Concentrate and Conditioner\r\nKhusus untuk shampo biasa fungsinya menghaluskan bulu dan melembutkan jika dipakai. Sangat aman untuk anjing atau kucing kesayangan Anda. Jadi tidak perlu lagi beli conditioner karena sudah ada didalam shampoo ini. Untuk varian ini memiliki aroma milk yang enak wanginya. Bulu jadi lebih halus dan wangi tahan lama.\r\n\r\n-Greentea Aromatic\r\nShampoo varian ini diformalisasikan khusus untuk mengeringkan dan membasmi jamur yang ada ditubuh anjing atau kucing kesayangan Anda. Untuk pemakaian yang rutin akan mendapatkan hasil maksimal.\r\n\r\n- Mint Menthol Aromatic\r\nJenis shampoo ini khusus untuk membasmi dan menghilangkan kutu yang ada pada tubuh anjing atau kucing kesayangan Anda. Aroma Menthol yang kuat akan mengusir kutu dan tidak akan kembali lagi, jika digunakan secara rutin.\r\n\r\nZoologe Shampoo merupakan shampoo yang menggunakan bahan lembut sehingga aman dan tidak menimbulkan alergi untuk hewan peliharaan Anda jika digunakan.\r\n\r\nKomposisi Zoologe Shampoo varian Anti Tick and Flea yaitu Sodium Laureth Sulfate, Sodium Chloride, Cocamida Dea, Cetrimonium Chloride, tetrasodium DmDmh, Tetrasodium DmDm, Cocamidoprpyl Betaine, Fragrance, Menthol Crystal, Ci42090,and water.\r\n\r\nKomposisi utk Zoologe Shampoo varian Anti Fungal Shampoo (greentea) yaitu Sodium Laureth Sulfate, Sodium Chloride, Cocamida Dea, Cetrimonium Chloride, tetrasodium DmDmh, Tetrasodium DmDm, Cocamidoprpyl Betaine, Fragrance, Menthol Crystal, Ci42090,ci19140, and water.\r\n\r\nKomposisi Zoologe Shampo 2 in 1 Shampoo and conditioner (milk) yaitu Sodium Laureth Sulfate, Sodium Chloride, Cocamida Dea, Cetrimonium Chloride, tetrasodium DmDmh, Tetrasodium DmDm, Cocamidoprpyl Betaine, Fragrance, Ci42090,ci19140, and water.\r\n\r\nSpesifikasi:\r\nIsi: 250ml & 500ml\r\n\r\nVarian:\r\n- Milk (2 in 1 Shampoo and Conditioner)\r\n- Flower Scent (2 in 1 Shampoo and Conditioner)\r\n- Greentea (Anti Fungal/Anti Jamur)\r\n- Mint (Anti Tick and Flea/Anti Kutu)', '50', '2023-10-09 08:10:57', '2023-10-09 08:10:57'),
(32, 6, '1', '1', '1', '1700579728.png', 'op', '1', '2023-11-21 08:15:29', '2023-11-21 08:15:29'),
(33, 6, '1', '1', '1', '1700580414.png', '1', '1', '2023-11-21 08:26:54', '2023-11-21 08:26:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` bigint(20) NOT NULL,
  `idclient` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `id_cart` int(11) UNSIGNED NOT NULL,
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `code`, `id_cart`, `id_client`, `id_user`, `status`, `date`) VALUES
(109, 'Zvq48', 364, 6, 12, 'pending', '2023-11-21'),
(110, 'mqh36', 365, 7, 12, 'pending', '2023-11-21'),
(111, 'Wty71', 366, 6, 12, 'pending', '2023-11-21'),
(112, 'Wty71', 367, 6, 12, 'pending', '2023-11-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `phone`, `address`, `images`, `remember_token`, `created_at`, `updated_at`) VALUES
(12, 'test', 'test', 'test@gmail.com', NULL, '$2y$10$rHRip1z1mmQiECF87kE4s.BuBHfg5IQ8jisVvNkBPeOQQOntrY2bW', '08953888888', 'test blok a', NULL, NULL, '2023-11-21 08:05:41', '2023-11-21 08:05:41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `biodata_toko`
--
ALTER TABLE `biodata_toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_clients` (`id_clients`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_products` (`id_products`,`id_biodata_toko`,`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_biodata_toko` (`id_biodata_toko`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idclient` (`idclient`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idclient` (`idclient`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cart` (`id_cart`,`id_client`,`id_user`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_2` (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `biodata_toko`
--
ALTER TABLE `biodata_toko`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biodata_toko`
--
ALTER TABLE `biodata_toko`
  ADD CONSTRAINT `biodata_toko_ibfk_1` FOREIGN KEY (`id_clients`) REFERENCES `clients` (`id`);

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_biodata_toko`) REFERENCES `biodata_toko` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `clients` (`id`);

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `clients` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
