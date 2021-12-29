-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 10:15 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umroh`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternative_criteria`
--

CREATE TABLE `alternative_criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alternative_id` int(10) UNSIGNED DEFAULT NULL,
  `criteria_id` int(10) UNSIGNED DEFAULT NULL,
  `score` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternative_criteria`
--

INSERT INTO `alternative_criteria` (`id`, `alternative_id`, `criteria_id`, `score`) VALUES
(2, 2, 2, 80),
(3, 2, 3, 70),
(4, 2, 4, 75),
(5, 2, 5, 60),
(6, 3, 2, 60),
(7, 3, 3, 75),
(8, 3, 4, 60),
(9, 3, 5, 80),
(10, 4, 2, 95),
(11, 4, 3, 75),
(12, 4, 4, 70),
(13, 4, 5, 80),
(14, 5, 2, 70),
(15, 5, 3, 90),
(16, 5, 4, 75),
(17, 5, 5, 85);

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id`, `name`, `weight`) VALUES
(2, 'Harga', '80'),
(3, 'Wisata', '70'),
(4, 'Durasi', '50'),
(5, 'Fasilitas', '60');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_card` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `passport_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_already_umrah` tinyint(1) NOT NULL DEFAULT 0,
  `last_education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_identity_card` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_phone` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_18_174600_create_packages_table', 1),
(5, '2020_12_18_174637_create_orders_table', 1),
(6, '2020_12_18_174707_create_payments_table', 1),
(7, '2020_12_22_162406_create_tables_spk', 1),
(8, '2020_12_26_140326_create_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `additional_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `price_total` decimal(12,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 100,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_paid_off` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quota` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 100,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `quota`, `start_date`, `end_date`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'UMRAH PLUS ISTANBUL', '<p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">TANGGAL BERANGKAT : 31 Oktober, 28 November, 26 Desember 2017, 23 januari &amp; 27 Februari 2018</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARGA PAKET : Rp. 36.620.000,- + Rp. 2.000.000,- /pax&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(Mekkah&amp;Madinah : Quad), (Istn : Double)&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(*) Harga &amp; jadwal sewaktu-waktu dapat berubah disebabkan adanya perubahan tarif, jadwal penerbangan, regulasi dan lain-lain tanpa pemberitahuan sebelumnya.</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">AKOMODASI :&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MADINAH : HOTEL Dallar Taibah : 3 malam&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MAKKAH : HOTEL Makarim Ajyad : 4 malam&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">ISTANBUL : HOTEL WOW</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">RUTE :</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>HARI 01:&nbsp;</strong><strong>BANDUNG</strong><strong>-JKT-MADINAH</strong><br>BANDUNG-JKT menggunakan bis AC, makan di Executive lounge bandara Soekarno-Hatta. perjalanan menuju Madinah dengan menggunakan penerbangan Ekonomi Class. tiba di Madinah perjalanan dilanjutkan menuju Hotel &nbsp;Transfer hotel.(B,L,D)<br><br><strong>HARI 02: MADINAH</strong><br>Ibadah di Masjid Nabawi ,Tahajud, Ziarah Nabawi: Makam Rasul, Raudhah, Makam Baqi, dll.(B,L,D)<br><br><strong>HARI 03: MADINAH</strong><br>Ibadah di Masjid Nabawi, Tahajud, tausyiah, Ziarah Madinah : Mesjid Quba, Jabal Uhud, Masjid Qiblatain, Stasion Kereta Api Turkey, Kebun Kurma, Percetakan Al- Quran.(B,L,D)<br>&nbsp;<br><strong>HARI 04: MADINAH-MEKKAH</strong><br>Ibadah di Masjid Nabawi, tahajud, tausyiah, dilanjutkan persiapan Miqat/ Umroh dari Bir Ali kemudian Menuju Mekkah menggunakan Bus AC, Transfer Hotel untuk melaksanakan Thawaf Umrah, Sa\'i dan tahalul,(B,L,D)<br><br><strong>HARI 05: MEKKAH</strong><br>Ibadah Masjidil Harrom, Ibadah Thawaf Sunat, Tahajud, tadarus, Tausyiah dan Ibadah Lainnya, tour masjidil harom (B,L,D)<br><br><strong>HARI 06: MEKKAH</strong><br>Ibadah di Masjidil Harrom, Ibadah Thawaf Sunat, Tahajud, tadarus, Tausyiah dan Ibadah lainnya Ziarah Mekkah : Arafah, Jabal Rahmah, Muzdalifah, Mina, Jabal Tsur, Jabal Nur/ Gua Hira, Hudaibiyah, peternakan unta, museum.(B,L,D)<br><br><strong>HARI 07: MEKKAH</strong><br>Ibadah di masjidil haram , thawaf sunat, tahajud , tadarus , Tausiah.(B,L,D)<br>&nbsp;<br><strong>HARI 08:&nbsp;</strong><strong>&nbsp;MEKKAH-</strong><strong>JEDDAH-</strong><strong>ISTANBUL</strong><br>Thawaf Wada , City Tour Jeddah : Pertokoan Corness/Balad , Laut Merah/Masjid terapung, Berkeliling kota jeddah , perjalanan menuju Istanbul dan akan akan dijemput&nbsp; oleh guide lokal<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; . (B,L,D)<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>09</strong>&nbsp; :&nbsp;<strong>ISTANBUL</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sarapan pagi, mengunjungi&nbsp;<strong>Hippodrome</strong>,&nbsp;<strong>Kolom Egyption</strong>,&nbsp;<strong>Kolom Cerpentine</strong>,&nbsp;<strong>Germain fountain</strong>&nbsp;Kunjungan ke&nbsp;<strong>Blue Mosque</strong>&nbsp;dan&nbsp;<strong>Topkapi Palace</strong>. Kunjungan dilanjutkan naik ferry untuk menelusuri selat bosphorus,Transfer ke hotel untuk bermalam. (B,L,D)<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>10</strong>&nbsp; :&nbsp;<strong>ISTANBUL</strong><br>Setelah makan pagi di hotel, kita tour mulai dengan kunjungan ke Negara bagian asia anda akan di ajak untuk memasuki daerah bukit camillca melihat pemandangan di sekitar maiden tower&nbsp; dilanjutkan mengunjungi istana&nbsp; Beylerbeyi,<strong>&nbsp;Grand Bazar&nbsp;</strong><strong>dan mengunjungi toko kulit</strong><strong>, perhiasan</strong><strong>&nbsp;dan karpet&nbsp;</strong><strong>Eyup&nbsp;Masjid,</strong><strong>dan eyup region dilanjutkan mengunjungi st Sopia(Hagia Sopia)</strong><strong>,</strong>&nbsp;(B,L,D)<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>11</strong>&nbsp; :&nbsp;<strong>ISTANBUL - JEDDAH-JKT</strong><br>Proses check out setelah sarapan di hotel, berkunjung di Masjid Suleymaniye Mosque. spice bazar, istiklal street.Setelah selesai diantar ke airport. Untuk perjalanan ke Jeddah (B.L.D)<br>&nbsp;&nbsp;&nbsp;<br><strong>HARI KE 1</strong><strong>2</strong>&nbsp; :&nbsp;<strong>JKT - BANDUNG</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tiba di Jakarta ,&nbsp; perjalanan dilanjutkan menuju Kantor Qiblat tour, singgah makan diperjalanan pembagian koper bagasi dan air zamzam&nbsp; dan dengan mengucapkan Alhamdulillah perjalanan ibadah Umroh Plus usai,&nbsp; para&nbsp; jamaah pulang ke rumah masing-masing. (L)<br><br><strong><em>Catatan : Program sewaktu – waktu dapat berubah disesuaikan dengan kondisi saat itu</em></strong>&nbsp;<strong><em>dan&nbsp; jadwal penerbangan tanpa mengurangi nilai ibadah.</em></strong></p>', 300, '2021-01-01', '2021-01-09', '36620000.00', '5ff562bcb0652.jpg', 100, '2020-12-18 11:39:11', '2021-01-06 00:11:56'),
(3, 'UMROH PLUS AL-AQSA', '<p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>TANGGAL BERANGKAT :&nbsp;</strong>31 Oktober, 26 Desember 2017 &amp; 27 Februari 2018</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>HARGA PAKET :&nbsp;</strong>Rp. 42.650.000,- + Rp. 2.000.000,- /pax</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(Mekkah&amp;Madinah : Quad), (Amman &amp; Yerusalem : Double)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(*) Harga &amp; jadwal sewaktu-waktu dapat berubah disebabkan adanya perubahan tarif, jadwal penerbangan, regulasi dan lain-lain tanpa pemberitahuan sebelumnya.</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>AKOMODASI :</strong></p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MADINAH : HOTEL DALLAR TAIBAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MAKKAH : HOTEL MAKARIM</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">AMMAN : HOTEL JARUSALEM INT / HOTEL DAYS INN</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">JARUSALEM : HOLI LAND / NATIONAL HOTEL</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>RUTE :</strong></p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>HARI 01:&nbsp;</strong><strong>BANDUNG</strong><strong>-JKT-MADINAH</strong><br>BANDUNG-JKT menggunakan bis AC, makan di Executive lounge bandara Soekarno-Hatta. perjalanan menuju Madinah dengan menggunakan penerbangan Ekonomi Class. tiba di Madinah perjalanan dilanjutkan menuju Hotel &nbsp;Transfer hotel.(B,L,D)<br><br><strong>HARI 02: MADINAH</strong><br>Ibadah di Masjid Nabawi ,Tahajud, Ziarah Nabawi: Makam Rasul, Raudhah, Makam Baqi, dll.(B,L,D)<br><br><strong>HARI 03: MADINAH</strong><br>Ibadah di Masjid Nabawi, Tahajud, tausyiah, Ziarah Madinah : Mesjid Quba, Jabal Uhud, Masjid Qiblatain, Stasion Kereta Api Turkey, Kebun Kurma, Percetakan Al- Quran.(B,L,D)<br>&nbsp;<br><strong>HARI 04: MADINAH-MEKKAH</strong><br>Ibadah di Masjid Nabawi, tahajud, tausyiah, dilanjutkan persiapan Miqat/ Umroh dari Bir Ali kemudian Menuju Mekkah menggunakan Bus AC, Transfer Hotel untuk melaksanakan Thawaf Umrah, Sa\'i dan tahalul,(B,L,D)<br><br><strong>HARI 05: MEKKAH</strong><br>Ibadah Masjidil Harrom, Ibadah Thawaf Sunat, Tahajud, tadarus, Tausyiah dan Ibadah Lainnya, tour masjidil harom (B,L,D)<br><br><strong>HARI 06: MEKKAH</strong><br>Ibadah di Masjidil Harrom, Ibadah Thawaf Sunat, Tahajud, tadarus, Tausyiah dan Ibadah lainnya Ziarah Mekkah : Arafah, Jabal Rahmah, Muzdalifah, Mina, Jabal Tsur, Jabal Nur/ Gua Hira, Hudaibiyah, peternakan unta, museum.(B,L,D)<br><br><strong>HARI 07: MEKKAH</strong><br>Ibadah di masjidil haram , thawaf sunat, tahajud , tadarus , Tausiah.(B,L,D)<br><br><strong>HARI 08:&nbsp;</strong><strong>MEKKAH-&nbsp;</strong><strong>JEDDAH-</strong><strong>AMAN- JERUSALEM</strong><br>Setelah sarapan pagi , Perjalanan Menuju bandara king abdul azis untuk terbang ke &nbsp;&nbsp;Aman Yordania.(B,L,D)<br>Tiba di Amman, &nbsp;makan Siang di Restaurant lokal, &nbsp;menaruh &nbsp;&nbsp;&nbsp;kopor / bagasi di&nbsp; Toko Holyland Ceramic &amp; Glass Factory ( ABU&nbsp; ALA ) &nbsp;,setelah itu langsung menuju perbatasan&nbsp; ALLENBY BRIDGE,mengunjungi &nbsp;tempat &nbsp;&nbsp;kelahiran Nabi ISA&nbsp; as di Bethlehem. Kunjungan selanjutnya ke HEBRON untuk &nbsp;Shalat di&nbsp; &nbsp;Masjidil KHALILULL RAHMAN ( Masjid Ibrahim ). Sore hari kembali ke &nbsp;&nbsp;MASJID AL &nbsp;AQSA untuk Shalat &nbsp;Magrib&nbsp; &amp; Isya yang di Jama Qasr. Check in di Hotel&nbsp; &amp; &nbsp;&nbsp;makan &nbsp;&nbsp;malam. ( B,L,D )<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>09</strong><strong>&nbsp; : JERUSALEM</strong><br>&nbsp;Dinihari kita siap untuk berangkat&nbsp; Shalat Shubuh di Masjidil AL AQSA. Setelah Shalat &nbsp;Shubuh , kita mengunjungi WAILLING WALL ( Tembok Ratapan kaum Yahudi ) .Kembali ke Hotel&nbsp; untuk sarapan pagi. Setelah sarapan pagi ziarah&nbsp; mengunjungi Maqam SALMAN AL FARIZI &amp;&nbsp; RABI’AH AL ADAWIYAH di Bukit Zaitun. Shalat Dzuhur &amp; Ashar dilakukan secara jama’ Qasr di Masjidil AL AQSA, begitu juga Magrib &amp; Isya. ( B,L,D )<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>10</strong><strong>&nbsp; : JERUSALEM – AMMAN</strong><br>&nbsp;Setelah sarapan pagi ,check out dari Hotel, ziarah ke Maqam Nabi MUSA as dan mengunjungi JERICHO. Setelah itu menuju&nbsp; perbatasan&nbsp; ALLENBY BRIDGE, memasuki Negara Jordan kembali. Makan&nbsp; siang di Restaurant di pantai Danau Laut Mati ( DEAD SEA ). Disana terletak bekas – bekas peninggalan Sejarah SODDOM &amp; ]&nbsp;&nbsp;&nbsp;&nbsp; GOMORRAH pada zaman Nabi LUTH as. Dilanjutkan mandi – mandi di tepi pantai tersebut. Kembali ke Toko ABU ALA untuk Shopping &amp; mengambil kopor – kopor&nbsp; &amp; menyimpan belanjaan didalam kopor tersebut. Ziarah dilanjutkan ke Maqam Nabi SYU’AIB as. Kunjungan terakhir hari itu ke&nbsp; GUA AL KAHFI. Setelah itu masuk Hotel dan bermalam. ( B,L,D )<br>&nbsp;<br><strong>HARI KE&nbsp;</strong><strong>11</strong><strong>&nbsp; : AMMAN –&nbsp;</strong><strong>JEDDAH -JAKARATA</strong><br>Makan pagi check out dari Hotel untuk &nbsp;transfer ke Bandara untuk &nbsp;terbang ke Jakarta namun transit di jeddah ( B,L )<br><br><strong>HARI KE 1</strong><strong>2</strong>&nbsp; :&nbsp;<strong>JKT - BANDUNG</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tiba di Jakarta ,&nbsp; perjalanan dilanjutkan menuju Kantor Qiblat tourSinggah makan diperjalanan pembagian koper bagasi dan air zamzam&nbsp; dan dengan mengucapkan Alhamdulillah perjalanan ibadah Umroh Plus usai,&nbsp; para&nbsp; jamaah pulang ke rumah masing-masing. (L)<br><br><strong><em>Catatan : Program sewaktu – waktu dapat berubah disesuaikan dengan kondisi saat itu dan&nbsp; jadwal penerbangan tanpa mengurangi nilai ibadah.</em></strong></p>', 200, '2021-02-23', '2021-02-28', '43650000.00', '5ff563894deed.jpg', 100, '2020-12-19 05:09:06', '2021-01-06 00:15:21'),
(4, 'UMROH PLUS CAIRO', '<p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">TANGGAL BERANGKAT : 31 Okt, 28 Nov, 26 Des 2017 &amp; 23 Jan, 27 Feb 2018</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARGA PAKET : Rp. 33.980.000,- + Rp. 2.000.000,- /PAX</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(Mekkah &amp; Madinah : Quad), (Cairo : Double)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(*) Harga &amp; jadwal sewaktu-waktu dapat berubah disebabkan adanya perubahan tarif, jadwal penerbangan, regulasi dan lain-lain tanpa pemberitahuan sebelumnya.</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">AKOMODASI :&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MADINAH : Hotel Dallah Taibah (3 malam),&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MEKKAH : Hotel Makarim Ajyad (4 malam)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">CAIRO : Hotel Sofitel Le SPinx / Hotel Le Meridien</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">RUTE :</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 01 : BANDUNG - JAKARTA - MADINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">perjalanan Bdg - Jkt menggunakan Bus AC, makan di Executive Lounge Bandara Soekarno - Hatta, perjalanan menuju Madinah dengan menggunakan penerbangan Economy Class, tiba di Madinah perjalanan dilanjutkan menuju Hotel. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 02 : MADINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Mesjid Nabawi, Tahajud, Ziarah Madinah : Mesjid Quba, Kebun Kurma, Jabal Uhud, Percetakan Al-quran, Mesjid Qiblatain, Mesjid Tujuh/Khandaq, Kebun kurma. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 03 : MADINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Mesjdi Nabawi, Tahajud, Tausyiah, Ziarah Mesjid Nabawi : Makam Rosul, Raudhoh, Makam Baqi, Ziarah Mesjid Ghamamah, Ex-Rumah para sahabat Rosul. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 04 : MADINAH - CAIRO</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Setelah solat subuh, sarapan pagi, check out hotel, perjalanan menuju Bandara King Abdul Aziz, perjalanan menuju Cairo, setelah urusan imigrasi selesai dijemput dan transfer hotel, langsung makan malam diatas kapal berlayar di Sungai Nile, kembali ke hotel &amp; istirahat. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 05 : CAIRO</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Setelah sarapan pagi, mengunjungi El Sayeeda Zainab, Masjid El Husein, Mesjid Moh. Aly, Universitas Al-Azhar, kembali ke hotel dan istirahat. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 06 : CAIRO</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Setelah sarapan pagi, kunjungan ke Pyramid &amp; Spinx di Giza, kemudian ke Museum Mesir &amp; Khan Khalili Bazaar, Pharaonic, &amp; Felucca Ride di Sungai Nile, setelah makan malam langsung masuk hotel &amp; istirahat. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 07 CAIRO - MEKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">setelah sarapan dilanjutkan check out dan diantar menuju Queen Alia International Airport untuk menuju Mekkah, transit hotel di Mekkah. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 08 : MEKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Mesjidil Harom, ziarah Mesjidil Harom : Maulid Nabi, Istana Raja, Zam zam Tower. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 09 : MEKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Mesjidil Harom, Ziarah Mekkah :&nbsp;Jabal Tsur, Arafah, Jabal Rahmah, Muzdalifah, Mina , Jabal Nur, Hudaibiyah dan Museum Asmaul Husna (jika dapat tasreh). (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 10 : MEKKAH - JEDDAH - JAKARTA</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di mesjidil Harom, Thawaf Whada, perjalanan menuju Jeddah, Sholat Dzuhur di Mesjid Qishas, Makan siang di Tomyam Resto, Shoping Chornise/Balad, Laut Merah, Makam Siti Hawa, Shalat Ashar di Mesjid Terapung, Take Off Jeddah - Jakarta. (B,L,D)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">HARI 11 : JAKARTA - BANDUNG</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Tiba di Bandara Soekarno - Hatta Jakarta, perjalanan menuju Kantor Qiblat Tour, singgah makan di perjalanan. (B,L,D)</p>', 200, '2020-12-21', '2020-12-31', '33980000.00', '5ff563f2ea2fe.png', 100, '2020-12-19 05:12:03', '2021-01-06 00:17:06'),
(5, 'Umroh Plus Dubai', '<p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>TANGGAL BERANGKAT :</strong>&nbsp;31 Okt, 28 Nov, 26 Des 2017 &amp; 23 jan, 27 Feb 2018</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>HARGA PAKET :&nbsp;</strong>Rp. 39.950.000,- + Rp. 2.000.000,- /pax</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">(*) Harga &amp; jadwal sewaktu-waktu dapat berubah disebabkan adanya perubahan tarif, jadwal penerbangan, regulasi dan lain-lain tanpa pemberitahuan sebelumnya.</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\"><strong>AKOMODASI :</strong></p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MADINAH : HOTEL DALLAR TAIBAH / AL HARAM</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">MAKKAH : HOTEL ELAF KINDA / ROYAL DAR AL EIMAN</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">DUBAI : HOTEL SIGNATURE AL BARSHA / HILTON GARDEN INN AL MINA</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">RUTE PERJALANAN :</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 01: JAKARTA – DUBAI - MEDINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Dari gedung Qiblat Tour dengan menggunakan Bis AC berangkat menuju Bandara Internasional Soekarno – Hatta, dengan menggunakan penerbangan Economy Class menuju Medinah dengan transit penerbangan di Dubai, tiba di Medinah transfer menuju hotel. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 02 : MEDINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjid Nabawi, ziarah Masjid Nabawi : Raudha, Makam Rasulullah SAW, Masjid Gamamah, Masjid Ali, Ex-rumah para sahabat Rosul, Pemakaman Baqe. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 03 : MEDINAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjid Nabawi, ziarah Madinah dengan berkunjung ke Masjid Quba, Jabal Uhud, Masjid Qiblatain, Percetakan Al-quran, Museum Nabawi/Asmaul Husna (jika mendapat Tasreh), Kebun Kurma. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 04 : MEDINAH – MAKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Check Out Hotel dilanjutkan dengan mengunjungi Laut Merah, Masjid Qishas dan Pusat Pertokoan Balad. Makan siang di Resto Tom Yam. Solat&nbsp; ashar di Masjid Terapung. Miqat di Bir Ali. Transfer menuju hotel untuk beristirahat. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 05 : MAKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjidil Haram, Tahajud, ziarah Masjidil Haram : Maulid Nabi, Istana Raja, Zam zam Tower dll. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 06 : MAKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjidil Haram, Tahajud, Tawaf Sunat. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 07 : MAKKAH</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjidil Haram, ziarah Makkah :&nbsp; Jabal Tsur, Jabal Rahmah, Arafah, Muzdalifah, Mina, Jabal Nur / Gua Hira, Pemakaman Ma’la, kemudian menuju Masjid Abu Hurairah. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 08 : MAKKAH – DUBAI</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Ibadah di Masjidil Haram, Thawaf Wada, check out hotel, perjalanan menuju Bandara di kota Jeddah, Take off Jeddah – Dubai, tiba di Dubai langsung transfer hotel, Setelah makan siang kemudian melaksanakan City Tour kota lama Dubai (old Dubai) dengan mengunjungi Dubai Museum, Bastakiya Area, Abras Water Taxi dan Gold Souk. Setelah makan siang transfer menuju hotel untuk beristirahat. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">&nbsp;</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 09 : DUBAI</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Sore hari jamaah akan di jemput dengan menggunakan kendaraan 4 X 4 Jeep untuk mengikuti petualangan SAFARI PADANG PASIR , di tempat tujuan akan disajikan atraksi Tunggang Unta &amp; Hena Painting. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 10 : DUBAI</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Setelah sarapan pagi dilanjutkan dengan City Tour kota Dubai mengunjungi Photo Stop Burj Al Arab, Palm Jumeirah menggunakan Monorail, Masjid Jumeirah, Photo Stop di Atlantis Palm dan Burj Khalif. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 11 : DUBAI – JAKARTA</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Pagi hari setelah makan pagi check out dari hotel untuk kemudian melanjutkan perjalanan menuju airport untuk kembali ke Jakarta. (Breakfast, Lunch, Dinner)</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Hari Ke 12 : JAKARTA – BANDUNG</p><p style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;\">Tiba di Bandara Internasional Soekarno – Hatta Jakarta dilanjutkan perjalanan menuju Qiblat Tour, singgah makan di perjalanan. (Breakfast, Lunch)</p>', 300, '2020-12-31', '2021-01-09', '39950000.00', '5fddee4ccf941.jpg', 100, '2020-12-19 05:13:00', '2020-12-19 05:13:00');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_holder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(12,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_count` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `is_down_payment` tinyint(1) NOT NULL DEFAULT 0,
  `is_verification` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_card` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `identity_card`, `email_verified_at`, `password`, `avatar`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '087112334556', '3256167898763456', NULL, '$2y$10$iZNEEUmfsjorjQrLyesJ9.9Ei/NXMHtLsP7/GwztwYLZUjRnAY2rK', '5fdcea2fab2e6.png', 'admin', NULL, '2020-12-18 10:29:30', '2020-12-18 10:43:11'),
(2, 'Pevita Pearce', 'pevita@gmail.com', '089765467889', '0987623455678909', NULL, '$2y$10$8UVjeKzad.4dXvIPNU3I9uNb0DiH0qtwXMkLEPQLCxxA9fDWXGyHG', NULL, 'member', NULL, '2020-12-19 05:00:49', '2020-12-19 05:00:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternative_criteria`
--
ALTER TABLE `alternative_criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
-- AUTO_INCREMENT for table `alternative_criteria`
--
ALTER TABLE `alternative_criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
