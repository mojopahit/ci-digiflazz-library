--
-- Struktur dari tabel `api`
--

CREATE TABLE `api` (
  `id_api` int(2) NOT NULL,
  `api` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `api`
--

INSERT INTO `api` (`id_api`, `api`, `value`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'digiflazz', '{\"user_digi\":\"userdigiAnda\",\"key_digi\":\"keyDigi\",\"private_digi\":\"privateDigi\",\"sandbox\":\"1\"}', '2022-06-25 04:38:08', 1, NULL, NULL);

-- --------------------------------------------------------