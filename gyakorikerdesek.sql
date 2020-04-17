-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2020. Ápr 17. 21:15
-- Kiszolgáló verziója: 5.7.28
-- PHP verzió: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `gyakorikerdesek`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cimkek`
--

CREATE TABLE `cimkek` (
  `id` int(11) NOT NULL,
  `megnevezes` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `cimkek`
--

INSERT INTO `cimkek` (`id`, `megnevezes`) VALUES
(1, 'Állatok'),
(2, 'Növények'),
(3, 'Ételek, italok'),
(4, 'Sport, mozgás'),
(5, 'Utazás'),
(6, 'Ünnepek'),
(7, 'Számítástechnika');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `id` int(11) NOT NULL,
  `ertekeles` int(1) DEFAULT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ertekelesek`
--

INSERT INTO `ertekelesek` (`id`, `ertekeles`, `datum`) VALUES
(16, -1, '2020-04-15 13:25:05'),
(18, -1, '2020-04-15 12:34:11'),
(21, 1, '2020-04-17 11:49:48'),
(22, 1, '2020-04-17 11:50:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `jelszo` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `regdatum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `email`, `jelszo`, `regdatum`) VALUES
(4, 'macilaci15', 'inmemoratus@gmail.com', '$2y$10$a7/fMX8Q8dz4CJSoG.ZeDeXCDfccZ8pq06oCEVpWdck5dhvCbO7s6', '2020-04-14 23:05:43');

--
-- Eseményindítók `felhasznalok`
--
DELIMITER $$
CREATE TRIGGER `felhasznalok_after_insert` AFTER INSERT ON `felhasznalok` FOR EACH ROW BEGIN
INSERT INTO felhasznalo_rang
   ( rang_id,
     felh_id
   )
   VALUES
   ( 
    1,	
    NEW.id    
	);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_ertekeles`
--

CREATE TABLE `felhasznalo_ertekeles` (
  `felh_id` int(11) DEFAULT NULL,
  `ertekeles_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo_ertekeles`
--

INSERT INTO `felhasznalo_ertekeles` (`felh_id`, `ertekeles_id`) VALUES
(4, 16),
(4, 18),
(4, 21),
(4, 22);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_kerdes`
--

CREATE TABLE `felhasznalo_kerdes` (
  `felh_id` int(11) DEFAULT NULL,
  `kerdes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo_kerdes`
--

INSERT INTO `felhasznalo_kerdes` (`felh_id`, `kerdes_id`) VALUES
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_latta`
--

CREATE TABLE `felhasznalo_latta` (
  `felh_id` int(11) DEFAULT NULL,
  `latta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo_latta`
--

INSERT INTO `felhasznalo_latta` (`felh_id`, `latta_id`) VALUES
(4, 46),
(4, 47),
(4, 48),
(4, 49),
(4, 50),
(4, 51),
(4, 52),
(4, 53),
(4, 54),
(4, 55),
(4, 56),
(4, 57),
(4, 58),
(4, 59),
(4, 60),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(4, 66),
(4, 67),
(4, 68),
(4, 69),
(4, 70),
(4, 71),
(4, 72),
(4, 73),
(4, 74),
(4, 75),
(4, 76),
(4, 77),
(4, 78),
(4, 79),
(4, 80),
(4, 81),
(4, 82),
(4, 83),
(4, 84),
(4, 85),
(4, 86),
(4, 87),
(4, 88),
(4, 89),
(4, 90),
(4, 91),
(4, 92),
(4, 93),
(4, 94),
(4, 95),
(4, 96),
(4, 97),
(4, 98),
(4, 99),
(4, 100),
(4, 101),
(4, 102),
(4, 103),
(4, 104),
(4, 105),
(4, 106),
(4, 107),
(4, 108),
(4, 109),
(4, 110),
(4, 111),
(4, 112),
(4, 113),
(4, 114),
(4, 115),
(4, 116),
(4, 117),
(4, 118),
(4, 119),
(4, 120),
(4, 121),
(4, 122),
(4, 123),
(4, 124),
(4, 125),
(4, 126),
(4, 127),
(4, 128),
(4, 129),
(4, 130),
(4, 131),
(4, 132),
(4, 133),
(4, 134),
(4, 135),
(4, 136),
(4, 137),
(4, 138),
(4, 139),
(4, 140),
(4, 141),
(4, 142),
(4, 143),
(4, 144),
(4, 145),
(4, 146),
(4, 147),
(4, 148),
(4, 149),
(4, 150),
(4, 151),
(4, 152),
(4, 153),
(4, 154),
(4, 155),
(4, 156),
(4, 157),
(4, 158),
(4, 159),
(4, 160),
(4, 161),
(4, 162),
(4, 163),
(4, 164),
(4, 165),
(4, 166),
(4, 167),
(4, 168),
(4, 169),
(4, 170),
(4, 171),
(4, 172),
(4, 173),
(4, 174),
(4, 175),
(4, 176),
(4, 177),
(4, 178),
(4, 179);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_rang`
--

CREATE TABLE `felhasznalo_rang` (
  `felh_id` int(11) DEFAULT NULL,
  `rang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo_rang`
--

INSERT INTO `felhasznalo_rang` (`felh_id`, `rang_id`) VALUES
(4, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_valasz`
--

CREATE TABLE `felhasznalo_valasz` (
  `felh_id` int(11) DEFAULT NULL,
  `valasz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalo_valasz`
--

INSERT INTO `felhasznalo_valasz` (`felh_id`, `valasz_id`) VALUES
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdesek`
--

CREATE TABLE `kerdesek` (
  `id` int(11) NOT NULL,
  `kerdesrov` varchar(150) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `akerdes` varchar(2000) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdesek`
--

INSERT INTO `kerdesek` (`id`, `kerdesrov`, `akerdes`, `datum`) VALUES
(6, 'Helló Szia?', '9webewfneoiwenfiowniof', '2010-04-14 23:06:53'),
(7, 'Meló malÓ?', 'Ez egy kérdés', '2020-04-15 09:27:15'),
(8, 'Laciiii wienoiwenvion oiwnoienwiofioefn oiwnefionweoifnioen oiwnefionioenfioefnioenoienieoneininonoinionioiosnoniodvndionvdiondvio?', 'MajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusowneovneiwovnoienvieoneivniwenMajgkusown', '2020-04-15 12:17:56'),
(9, 'Mi a kő tyúkanyó kend a szobában lakik itt bent?', 'Marika feneke olyan mint a keneke vele tárgyal rája meg nem fogva rogyva de törve körbe', '2020-04-15 15:58:45'),
(10, 'Malika joli higy vabM?', 'Malika jóóó, de lalika nooo?', '2020-04-15 20:05:58'),
(11, 'Msagegraerg?', 'rehrehehrehrh', '2020-04-15 20:06:52'),
(12, 'ASDASDASD?', 'rejhrerhherhreerhher', '2020-04-15 20:07:04'),
(13, 'Ez az ami?', 'wuebveuwobovuewb', '2020-04-15 23:22:59'),
(14, 'Ez az ami?', 'Amimimim', '2020-04-15 23:23:19'),
(15, 'Ami ami?', 'Lali ami?', '2020-04-15 23:23:53'),
(16, 'Maki jani?', 'Lki hami', '2020-04-15 23:24:10'),
(17, 'Mali la?', 'qefg gh j', '2020-04-16 00:12:00'),
(18, 'Asdghj?', 'Asdasd', '2020-04-16 00:16:48'),
(19, 'Asdghj?', 'Asdasd', '2020-04-16 00:16:57'),
(20, 'Asdghj?', 'Asdasd', '2020-04-16 00:17:02'),
(21, 'Helló Szia?', 'Szia Helló', '2020-04-17 09:36:21'),
(22, 'Helló Szia?', 'Szia hello', '2020-04-17 11:11:22'),
(23, 'Ez az ami?', 'Ez mmi a gho', '2020-04-17 11:17:14'),
(24, 'Helló Szia?', 'szsdvoubvubsou', '2020-04-17 11:18:45'),
(25, 'Helló Szia?', 'Mali kali', '2020-04-17 11:55:23'),
(26, 'Helló Szia?', 'ipipvwipnevpi', '2020-04-17 12:12:21'),
(27, 'MMMMMMM?', 'Maosbvowbo', '2020-04-17 12:13:36');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdes_cimke`
--

CREATE TABLE `kerdes_cimke` (
  `kerdes_id` int(11) DEFAULT NULL,
  `cimke_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdes_cimke`
--

INSERT INTO `kerdes_cimke` (`kerdes_id`, `cimke_id`) VALUES
(6, 1),
(7, 1),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(9, 5),
(9, 6),
(9, 7),
(10, 3),
(10, 6),
(10, 7),
(11, 5),
(12, 6),
(13, 4),
(13, 7),
(14, 4),
(14, 7),
(15, 4),
(15, 7),
(16, 4),
(16, 7),
(17, 7),
(18, 5),
(19, 5),
(20, 5),
(21, 4),
(21, 7),
(22, 6),
(22, 7),
(23, 6),
(24, 4),
(25, 6),
(26, 5),
(27, 5);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdes_latta`
--

CREATE TABLE `kerdes_latta` (
  `kerdes_id` int(11) DEFAULT NULL,
  `latta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdes_latta`
--

INSERT INTO `kerdes_latta` (`kerdes_id`, `latta_id`) VALUES
(6, 46),
(6, 47),
(6, 48),
(6, 49),
(6, 50),
(6, 51),
(6, 52),
(6, 53),
(6, 54),
(6, 55),
(6, 56),
(6, 57),
(6, 58),
(6, 59),
(6, 60),
(6, 61),
(6, 62),
(6, 63),
(6, 64),
(6, 65),
(6, 66),
(6, 67),
(6, 68),
(6, 69),
(6, 70),
(6, 71),
(6, 72),
(6, 73),
(6, 74),
(6, 78),
(6, 84),
(6, 87),
(6, 91),
(6, 92),
(6, 98),
(6, 99),
(6, 100),
(6, 103),
(6, 104),
(6, 105),
(6, 106),
(6, 107),
(6, 108),
(6, 109),
(6, 110),
(6, 111),
(6, 112),
(6, 117),
(6, 118),
(6, 119),
(6, 120),
(6, 121),
(6, 122),
(6, 123),
(6, 124),
(6, 125),
(6, 126),
(6, 127),
(6, 128),
(6, 129),
(6, 130),
(6, 131),
(6, 132),
(6, 133),
(6, 134),
(6, 135),
(6, 136),
(6, 137),
(6, 138),
(6, 139),
(6, 140),
(6, 141),
(6, 142),
(6, 143),
(6, 144),
(6, 145),
(6, 146),
(6, 147),
(6, 148),
(6, 149),
(6, 150),
(6, 152),
(6, 153),
(6, 155),
(6, 157),
(6, 160),
(6, 162),
(6, 163),
(6, 166),
(6, 167),
(6, 168),
(7, 75),
(7, 76),
(7, 77),
(7, 79),
(7, 83),
(7, 86),
(7, 94),
(7, 97),
(7, 154),
(7, 158),
(7, 170),
(7, 172),
(7, 173),
(7, 174),
(7, 175),
(7, 176),
(7, 177),
(8, 80),
(8, 81),
(8, 82),
(8, 85),
(8, 88),
(8, 89),
(8, 90),
(8, 93),
(8, 95),
(8, 96),
(8, 113),
(8, 114),
(8, 115),
(8, 116),
(8, 156),
(8, 159),
(9, 101),
(9, 102),
(9, 151),
(11, 169),
(13, 171),
(17, 161),
(23, 164),
(24, 165),
(26, 178),
(27, 179);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdes_valasz`
--

CREATE TABLE `kerdes_valasz` (
  `kerdes_id` int(11) DEFAULT NULL,
  `valasz_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdes_valasz`
--

INSERT INTO `kerdes_valasz` (`kerdes_id`, `valasz_id`) VALUES
(6, 11),
(6, 12),
(6, 16),
(6, 17),
(6, 18),
(6, 21),
(7, 13),
(7, 19),
(7, 22),
(8, 14),
(8, 20),
(9, 14);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `lattak`
--

CREATE TABLE `lattak` (
  `id` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `lattak`
--

INSERT INTO `lattak` (`id`, `datum`) VALUES
(46, '2020-04-14 23:06:56'),
(47, '2020-04-14 23:07:03'),
(48, '2020-04-14 23:07:14'),
(49, '2020-04-14 23:07:19'),
(50, '2020-04-14 23:07:27'),
(51, '2020-04-14 23:20:34'),
(52, '2020-04-14 23:20:40'),
(53, '2020-04-14 23:23:28'),
(54, '2020-04-14 23:23:34'),
(55, '2020-04-14 23:28:58'),
(56, '2020-04-14 23:45:05'),
(57, '2020-04-14 23:45:11'),
(58, '2020-04-14 23:45:18'),
(59, '2020-04-14 23:45:24'),
(60, '2020-04-14 23:46:01'),
(61, '2020-04-14 23:46:07'),
(62, '2020-04-14 23:46:14'),
(63, '2020-04-14 23:46:21'),
(64, '2020-04-14 23:46:30'),
(65, '2020-04-14 23:49:45'),
(66, '2020-04-14 23:49:52'),
(67, '2020-04-14 23:49:58'),
(68, '2020-04-14 23:50:45'),
(69, '2020-04-14 23:51:50'),
(70, '2020-04-14 23:51:56'),
(71, '2020-04-14 23:53:18'),
(72, '2020-04-14 23:53:24'),
(73, '2020-04-14 23:53:30'),
(74, '2020-04-14 23:53:36'),
(75, '2020-04-15 09:27:21'),
(76, '2020-04-15 09:27:55'),
(77, '2020-04-15 09:28:04'),
(78, '2020-04-15 09:45:14'),
(79, '2020-04-15 09:45:18'),
(80, '2020-04-15 12:19:15'),
(81, '2020-04-15 12:27:36'),
(82, '2020-04-15 12:31:58'),
(83, '2020-04-15 12:32:09'),
(84, '2020-04-15 12:32:15'),
(85, '2020-04-15 12:32:56'),
(86, '2020-04-15 12:33:03'),
(87, '2020-04-15 12:33:07'),
(88, '2020-04-15 12:33:28'),
(89, '2020-04-15 12:34:03'),
(90, '2020-04-15 12:35:02'),
(91, '2020-04-15 13:22:31'),
(92, '2020-04-15 13:22:36'),
(93, '2020-04-15 13:23:12'),
(94, '2020-04-15 13:23:17'),
(95, '2020-04-15 13:23:37'),
(96, '2020-04-15 13:24:49'),
(97, '2020-04-15 13:24:53'),
(98, '2020-04-15 13:24:55'),
(99, '2020-04-15 13:25:11'),
(100, '2020-04-15 16:19:39'),
(101, '2020-04-15 16:19:54'),
(102, '2020-04-15 16:20:29'),
(103, '2020-04-15 18:18:51'),
(104, '2020-04-15 18:19:09'),
(105, '2020-04-15 18:58:58'),
(106, '2020-04-15 18:59:08'),
(107, '2020-04-15 18:59:21'),
(108, '2020-04-15 19:05:45'),
(109, '2020-04-15 19:05:58'),
(110, '2020-04-15 19:06:11'),
(111, '2020-04-15 19:06:18'),
(112, '2020-04-15 20:16:39'),
(113, '2020-04-15 20:17:25'),
(114, '2020-04-15 20:18:26'),
(115, '2020-04-15 20:18:44'),
(116, '2020-04-15 20:19:30'),
(117, '2020-04-15 23:46:22'),
(118, '2020-04-15 23:48:38'),
(119, '2020-04-15 23:48:58'),
(120, '2020-04-15 23:49:12'),
(121, '2020-04-15 23:49:22'),
(122, '2020-04-15 23:50:00'),
(123, '2020-04-15 23:50:12'),
(124, '2020-04-15 23:50:35'),
(125, '2020-04-15 23:52:53'),
(126, '2020-04-15 23:53:38'),
(127, '2020-04-15 23:53:50'),
(128, '2020-04-15 23:54:35'),
(129, '2020-04-15 23:54:50'),
(130, '2020-04-15 23:55:25'),
(131, '2020-04-15 23:55:51'),
(132, '2020-04-15 23:56:07'),
(133, '2020-04-15 23:56:27'),
(134, '2020-04-15 23:57:01'),
(135, '2020-04-15 23:57:13'),
(136, '2020-04-15 23:57:22'),
(137, '2020-04-15 23:57:56'),
(138, '2020-04-15 23:58:30'),
(139, '2020-04-15 23:58:52'),
(140, '2020-04-15 23:59:01'),
(141, '2020-04-16 00:01:25'),
(142, '2020-04-16 00:03:08'),
(143, '2020-04-16 00:05:04'),
(144, '2020-04-16 00:05:26'),
(145, '2020-04-16 00:06:05'),
(146, '2020-04-16 00:07:24'),
(147, '2020-04-16 00:08:01'),
(148, '2020-04-16 00:08:23'),
(149, '2020-04-16 00:08:43'),
(150, '2020-04-16 00:09:28'),
(151, '2020-04-16 11:00:31'),
(152, '2020-04-16 12:32:51'),
(153, '2020-04-16 12:33:07'),
(154, '2020-04-16 12:35:35'),
(155, '2020-04-16 22:29:08'),
(156, '2020-04-16 22:48:24'),
(157, '2020-04-16 22:57:04'),
(158, '2020-04-16 22:57:08'),
(159, '2020-04-16 22:57:10'),
(160, '2020-04-16 23:14:52'),
(161, '2020-04-16 23:19:11'),
(162, '2020-04-17 09:41:34'),
(163, '2020-04-17 09:43:02'),
(164, '2020-04-17 11:17:18'),
(165, '2020-04-17 11:18:50'),
(166, '2020-04-17 11:20:40'),
(167, '2020-04-17 11:46:54'),
(168, '2020-04-17 11:47:10'),
(169, '2020-04-17 11:47:19'),
(170, '2020-04-17 11:47:27'),
(171, '2020-04-17 11:47:32'),
(172, '2020-04-17 11:48:22'),
(173, '2020-04-17 11:48:26'),
(174, '2020-04-17 11:48:31'),
(175, '2020-04-17 11:49:43'),
(176, '2020-04-17 11:49:56'),
(177, '2020-04-17 11:50:07'),
(178, '2020-04-17 12:12:25'),
(179, '2020-04-17 12:13:40');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rangok`
--

CREATE TABLE `rangok` (
  `id` int(11) NOT NULL,
  `megnevezes` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rangok`
--

INSERT INTO `rangok` (`id`, `megnevezes`) VALUES
(1, 'Tag');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `valaszok`
--

CREATE TABLE `valaszok` (
  `id` int(11) NOT NULL,
  `valasz` varchar(2000) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `vdatum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `valaszok`
--

INSERT INTO `valaszok` (`id`, `valasz`, `vdatum`) VALUES
(11, 'INVOIWENOIEVNW', '2020-04-14 23:07:00'),
(12, 'ONWOINEOINIOiio', '2020-04-14 23:07:10'),
(13, 'weinvoieneioneineoiv', '2020-04-15 09:27:51'),
(14, 'ASdipnfbinepibnrpnrbepnbr', '2020-04-15 12:33:36'),
(15, 'ez lesz egy kérdés', '2020-04-15 16:20:04'),
(16, 'iguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziviguvivizvziv', '2020-04-15 18:19:01'),
(17, 'Mai napi', '2020-04-16 12:32:58'),
(18, 'Mai naő', '2020-04-16 12:33:13'),
(19, 'Merki', '2020-04-16 12:35:53'),
(20, 'Bolond vagy babe', '2020-04-16 22:48:34'),
(21, 'Válasz', '2020-04-17 09:41:39'),
(22, 'Macsk', '2020-04-17 11:49:39');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `valasz_ertekeles`
--

CREATE TABLE `valasz_ertekeles` (
  `valasz_id` int(11) DEFAULT NULL,
  `ertekeles_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `valasz_ertekeles`
--

INSERT INTO `valasz_ertekeles` (`valasz_id`, `ertekeles_id`) VALUES
(12, 16),
(13, 22),
(14, 18),
(22, 21);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cimkek`
--
ALTER TABLE `cimkek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalo_ertekeles`
--
ALTER TABLE `felhasznalo_ertekeles`
  ADD KEY `felh_id_ertekeles_id` (`felh_id`,`ertekeles_id`),
  ADD KEY `FK_felhasznalo_ertekeles_ertekelesek` (`ertekeles_id`);

--
-- A tábla indexei `felhasznalo_kerdes`
--
ALTER TABLE `felhasznalo_kerdes`
  ADD KEY `felh_id_kerdes_id` (`felh_id`,`kerdes_id`),
  ADD KEY `FK_felhasznalo_kerdes_kerdesek` (`kerdes_id`);

--
-- A tábla indexei `felhasznalo_latta`
--
ALTER TABLE `felhasznalo_latta`
  ADD KEY `felh_id_latta_id` (`felh_id`,`latta_id`),
  ADD KEY `FK_felhasznalo_latta_lattak` (`latta_id`);

--
-- A tábla indexei `felhasznalo_rang`
--
ALTER TABLE `felhasznalo_rang`
  ADD KEY `felh_id_rang_id` (`felh_id`,`rang_id`),
  ADD KEY `FK_felhasznalo_rang_rangok` (`rang_id`);

--
-- A tábla indexei `felhasznalo_valasz`
--
ALTER TABLE `felhasznalo_valasz`
  ADD KEY `felh_id_kerdes_id` (`felh_id`,`valasz_id`),
  ADD KEY `FK_felhasznalo_valasz_valaszok` (`valasz_id`);

--
-- A tábla indexei `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kerdes_cimke`
--
ALTER TABLE `kerdes_cimke`
  ADD KEY `kerdes_id_cimke_id` (`kerdes_id`,`cimke_id`),
  ADD KEY `FK_kerdes_cimke_cimkek` (`cimke_id`);

--
-- A tábla indexei `kerdes_latta`
--
ALTER TABLE `kerdes_latta`
  ADD KEY `kerdes_id_latta_id` (`kerdes_id`,`latta_id`),
  ADD KEY `FK_kerdes_latta_lattak` (`latta_id`);

--
-- A tábla indexei `kerdes_valasz`
--
ALTER TABLE `kerdes_valasz`
  ADD KEY `kerdes_id_valasz_id` (`kerdes_id`,`valasz_id`),
  ADD KEY `FK_kerdes_valasz_valaszok` (`valasz_id`);

--
-- A tábla indexei `lattak`
--
ALTER TABLE `lattak`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rangok`
--
ALTER TABLE `rangok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `valaszok`
--
ALTER TABLE `valaszok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `valasz_ertekeles`
--
ALTER TABLE `valasz_ertekeles`
  ADD KEY `valasz_id_ertekeles_id` (`valasz_id`,`ertekeles_id`),
  ADD KEY `FK_valasz_ertekeles_ertekelesek` (`ertekeles_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cimkek`
--
ALTER TABLE `cimkek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `kerdesek`
--
ALTER TABLE `kerdesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `lattak`
--
ALTER TABLE `lattak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT a táblához `rangok`
--
ALTER TABLE `rangok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `valaszok`
--
ALTER TABLE `valaszok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `felhasznalo_ertekeles`
--
ALTER TABLE `felhasznalo_ertekeles`
  ADD CONSTRAINT `FK_felhasznalo_ertekeles_ertekelesek` FOREIGN KEY (`ertekeles_id`) REFERENCES `ertekelesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_felhasznalo_ertekeles_felhasznalok` FOREIGN KEY (`felh_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `felhasznalo_kerdes`
--
ALTER TABLE `felhasznalo_kerdes`
  ADD CONSTRAINT `FK_felhasznalo_kerdes_felhasznalok` FOREIGN KEY (`felh_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_felhasznalo_kerdes_kerdesek` FOREIGN KEY (`kerdes_id`) REFERENCES `kerdesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `felhasznalo_latta`
--
ALTER TABLE `felhasznalo_latta`
  ADD CONSTRAINT `FK_felhasznalo_latta_felhasznalok` FOREIGN KEY (`felh_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_felhasznalo_latta_lattak` FOREIGN KEY (`latta_id`) REFERENCES `lattak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `felhasznalo_rang`
--
ALTER TABLE `felhasznalo_rang`
  ADD CONSTRAINT `FK_felhasznalo_rang_felhasznalok` FOREIGN KEY (`felh_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_felhasznalo_rang_rangok` FOREIGN KEY (`rang_id`) REFERENCES `rangok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `felhasznalo_valasz`
--
ALTER TABLE `felhasznalo_valasz`
  ADD CONSTRAINT `FK_felhasznalo_valasz_felhasznalok` FOREIGN KEY (`felh_id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_felhasznalo_valasz_valaszok` FOREIGN KEY (`valasz_id`) REFERENCES `valaszok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kerdes_cimke`
--
ALTER TABLE `kerdes_cimke`
  ADD CONSTRAINT `FK_kerdes_cimke_cimkek` FOREIGN KEY (`cimke_id`) REFERENCES `cimkek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_kerdes_cimke_kerdesek` FOREIGN KEY (`kerdes_id`) REFERENCES `kerdesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kerdes_latta`
--
ALTER TABLE `kerdes_latta`
  ADD CONSTRAINT `FK_kerdes_latta_kerdesek` FOREIGN KEY (`kerdes_id`) REFERENCES `kerdesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_kerdes_latta_lattak` FOREIGN KEY (`latta_id`) REFERENCES `lattak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `kerdes_valasz`
--
ALTER TABLE `kerdes_valasz`
  ADD CONSTRAINT `FK_kerdes_valasz_kerdesek` FOREIGN KEY (`kerdes_id`) REFERENCES `kerdesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_kerdes_valasz_valaszok` FOREIGN KEY (`valasz_id`) REFERENCES `valaszok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `valasz_ertekeles`
--
ALTER TABLE `valasz_ertekeles`
  ADD CONSTRAINT `FK_valasz_ertekeles_ertekelesek` FOREIGN KEY (`ertekeles_id`) REFERENCES `ertekelesek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_valasz_ertekeles_valaszok` FOREIGN KEY (`valasz_id`) REFERENCES `valaszok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
