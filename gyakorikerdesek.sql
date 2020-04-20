-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2020. Ápr 20. 20:54
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
(28, 1, '2020-04-19 18:26:41'),
(29, 1, '2020-04-19 18:26:44'),
(30, -1, '2020-04-19 18:27:28');

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
(4, 'macilaci15', 'inmemoratus@gmail.com', '$2y$10$a7/fMX8Q8dz4CJSoG.ZeDeXCDfccZ8pq06oCEVpWdck5dhvCbO7s6', '2020-04-14 23:05:43'),
(5, 'egyfelhasznalo2020', 'onlinemozi@onlinemozi.nhely.hu', '$2y$10$TPKnOSXllrzlPXTuh5jzquBji6LoZ/r64lFhtCNtn7NJCcrDCUPoa', '2020-04-19 18:07:10');

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
(5, 28),
(5, 29),
(5, 30);

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
(5, 31),
(5, 32),
(5, 33);

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
(5, 204),
(5, 205),
(5, 206),
(5, 207),
(5, 208),
(5, 209),
(5, 210),
(5, 211),
(5, 212);

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
(4, 1),
(5, 1);

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
(5, 28),
(5, 29),
(5, 30);

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
(31, 'Ez az első kérdés?', 'Ez az első kérdés', '2020-04-19 18:26:16'),
(32, 'Ez még egy kérdés?', 'Ez még egy kérdés', '2020-04-19 18:27:09'),
(33, 'Ehhez lesz hozzászólás?', 'Ehhez a kérdéshez nem lesz hozzászólás', '2020-04-19 18:27:56');

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
(31, 1),
(31, 3),
(32, 2),
(32, 4),
(32, 5),
(33, 7);

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
(31, 204),
(31, 205),
(31, 206),
(31, 207),
(31, 208),
(32, 209),
(32, 210),
(32, 211),
(33, 212);

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
(31, 28),
(31, 29),
(32, 30);

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
(204, '2020-04-19 18:26:18'),
(205, '2020-04-19 18:26:29'),
(206, '2020-04-19 18:26:40'),
(207, '2020-04-19 18:26:43'),
(208, '2020-04-19 18:26:46'),
(209, '2020-04-19 18:27:11'),
(210, '2020-04-19 18:27:24'),
(211, '2020-04-19 18:27:30'),
(212, '2020-04-19 18:27:57');

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
(1, 'Tag'),
(2, 'Admin');

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
(28, 'Ez egy hozzászólás', '2020-04-19 18:26:27'),
(29, 'Ez még egy hozzászólás', '2020-04-19 18:26:38'),
(30, 'Ez még egy hozzászólás', '2020-04-19 18:27:22');

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
(28, 28),
(29, 29),
(30, 30);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `kerdesek`
--
ALTER TABLE `kerdesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `lattak`
--
ALTER TABLE `lattak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT a táblához `rangok`
--
ALTER TABLE `rangok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `valaszok`
--
ALTER TABLE `valaszok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
