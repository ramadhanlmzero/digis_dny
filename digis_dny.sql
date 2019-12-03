-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2019 pada 14.44
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digis_dny`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `coordinate` point DEFAULT NULL,
  `place_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id`, `address`, `phone`, `gender`, `capacity`, `coordinate`, `place_id`, `user_id`, `created_at`, `updated_at`) VALUES
('601dd248-51a7-464c-a1b7-d6f95df48916', 'Jl. Ketintang, Wonokromo, Kota Surabaya, Jawa Timur', '083831811803', 'Perempuan', 1500, '\0\0\0\0\0\0\02öK`©.\\@†&ÈP<=¿', 'd730246a-5a02-4953-a41d-c0c8c73a9ad9', '59497745-1e81-4151-b4d7-d69b16f92e05', '2019-11-26 11:29:27', '2019-11-29 17:39:36'),
('c7df193f-35ab-42ef-8eff-16e0768565d2', 'Jl. Raya Kebonsari No.VI-B/8, Kebonsari, Kota Surabaya, Jawa Timur', '083838383838', 'Laki-laki', 5, '\0\0\0\0\0\0\0,-#ıû-\\@#†¬§R¿', 'd730246a-5a02-4953-a41d-c0c8c73a9ad9', '884c738f-cda3-4f72-9323-9fb2dd9743b4', '2019-11-29 17:45:37', '2019-11-29 17:49:31'),
('cf1be791-b85d-4d51-8c1d-99da8ee81783', 'Jl. Ponorogo - Solo, Krajan, Tambakbayan, Kabupaten Ponorogo, Jawa Timur', '083831811803', 'Laki-laki', 1000, '\0\0\0\0\0\0\0´†X]›[@äß√Øu¿', 'b27c0ea9-7a8c-479b-8b56-3023fd5b8b60', '0d3e544e-e01a-43c7-978f-f6b0f99fe7ec', '2019-11-24 17:34:19', '2019-11-29 17:39:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor_product`
--

CREATE TABLE `distributor_product` (
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_11_19_010004_create_kotas_table', 1),
(3, '2019_11_19_011637_create_distributors_table', 1),
(4, '2019_11_19_012059_create_transaksis_table', 1),
(5, '2019_11_19_012552_create_produks_table', 1),
(6, '2019_11_19_012743_create_stoks_table', 1),
(7, '2019_11_19_013346_create_pembelians_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `place`
--

CREATE TABLE `place` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `place`
--

INSERT INTO `place` (`id`, `city`, `created_at`, `updated_at`) VALUES
('a5ac473d-709e-4cd8-a168-9838840479a0', 'LUMAJANG', '2019-11-29 15:14:43', '2019-11-29 15:17:12'),
('b27c0ea9-7a8c-479b-8b56-3023fd5b8b60', 'PONOROGO', '2019-11-25 17:11:47', '2019-11-28 20:53:36'),
('b2940c5e-6802-435b-818f-04c2f6dc13a6', 'SIDOARJO', '2019-11-28 21:00:56', '2019-11-28 21:00:56'),
('d730246a-5a02-4953-a41d-c0c8c73a9ad9', 'SURABAYA', '2019-11-26 09:24:48', '2019-11-28 20:23:50'),
('d8ed4a45-b572-411d-9542-661223f66cae', 'KEDIRI', '2019-11-28 21:07:07', '2019-11-28 21:07:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
('c7fadd89-87bb-426e-a4c1-dbbb0e4c4c4b', 'Hijab Sport Intan', 'Hijab Sport Intan yuk beli!', 25000.00, 'product_26_11_2019_6261.jpeg', '2019-11-26 16:57:05', '2019-11-26 17:15:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_transaction`
--

CREATE TABLE `product_transaction` (
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `total_paid` double(8,2) NOT NULL,
  `total_change` double(8,2) NOT NULL,
  `distributor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
('01c22751-a8b5-48bd-8c25-06ef63e5ddf0', 'Muhamad Ramadhan', 'muhamadramadhan57@gmail.com', NULL, '$2y$10$J/BCApzFI9knSvwT2Sn8m.0iBY6mU0FCxiFzoNsxPpvBR.3ysK5SC', 'user_29_11_2019_2966.jpg', 'Admin', NULL, '2019-11-24 17:07:57', '2019-11-29 15:24:28'),
('0d3e544e-e01a-43c7-978f-f6b0f99fe7ec', 'Ringgia Widananta Fikar', 'ringgia@gmail.com', NULL, '$2y$10$TutitA.vuf6W7nKQkKuJweTJk0aEEO7wT9KxggK8m2W6/6gXDUwRK', 'user_27_11_2019_3845.jpg', 'Distributor', NULL, '2019-11-24 17:34:19', '2019-11-26 17:13:26'),
('59497745-1e81-4151-b4d7-d69b16f92e05', 'Fitriayu Priyadi Putri', 'fitriayupp1@gmail.com', NULL, '$2y$10$ca2HX.K3ImG5/GloLx3OguPvGf6tBrSGf3fTwbWHzOuW46eiSDQWS', NULL, 'Distributor', NULL, '2019-11-26 11:29:26', '2019-11-26 11:29:26'),
('884c738f-cda3-4f72-9323-9fb2dd9743b4', 'Fandi Ilham', 'fandiilham@gmail.com', NULL, '$2y$10$7.Lvahvrzrl3iROOZQuTweFGusowsmAdk7i3x.J5OCPZQBHoSuDz6', NULL, 'Distributor', NULL, '2019-11-29 17:45:37', '2019-11-29 17:45:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distributor_place_id_foreign` (`place_id`),
  ADD KEY `distributor_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `distributor_product`
--
ALTER TABLE `distributor_product`
  ADD KEY `distributor_product_product_id_foreign` (`product_id`),
  ADD KEY `distributor_product_distributor_id_foreign` (`distributor_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD KEY `product_transaction_product_id_foreign` (`product_id`),
  ADD KEY `product_transaction_transaction_id_foreign` (`transaction_id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_distributor_id_foreign` (`distributor_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD CONSTRAINT `distributor_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distributor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `distributor_product`
--
ALTER TABLE `distributor_product`
  ADD CONSTRAINT `distributor_product_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `distributor_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD CONSTRAINT `product_transaction_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_transaction_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
