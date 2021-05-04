-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 04 May 2021, 17:20:18
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `support`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `takipno` text COLLATE utf8_turkish_ci NOT NULL,
  `urunno` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanicino` text COLLATE utf8_turkish_ci NOT NULL,
  `durum` text COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `fotograf` text COLLATE utf8_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tickets`
--

INSERT INTO `tickets` (`id`, `takipno`, `urunno`, `kullanicino`, `durum`, `mesaj`, `fotograf`) VALUES
(1, 'ABC1234', '1', '28459406198', 'Ürünün elimize ulaşması bekleniyor.', 'Ürün arızalı geldi ve açılmıyor, tamir ya da iade talep ediyorum.', 'img/tamir.jpg'),
(2, 'DSF4321', '2', '28459406198', 'Talep sonlandı.', 'Lütfen tamir edin.', 'img/kırıklaptop.jpeg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `kullanicitc` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanicitur` tinyint(1) NOT NULL,
  `kullanicimail` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanicisifre` text COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`kullanicitc`(11))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`kullanicitc`, `kullanicitur`, `kullanicimail`, `kullanicisifre`) VALUES
('28459406198', 1, 'batu@batu.com', 'b1234'),
('12345678999', 0, 'admin@admin.com', 'a1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
