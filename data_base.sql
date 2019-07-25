-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 09:02 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `data_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `commande` varchar(255) NOT NULL,
  `idmember` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `email`, `commande`, `idmember`, `class`) VALUES
(4, 'brahimiroumaissa1@gmail.com', 'i have seen your work ,\r\nand i want you to make one for me ;\r\nplease leave to me a massege in this email time you can.', 3, '0'),
(9, 'romaissa@gmail.com', 'i like it', 4, 'media');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE IF NOT EXISTS `dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `id_article`, `id_membre`) VALUES
(3, 4, 3),
(17, 5, 3),
(19, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_article`, `id_membre`) VALUES
(9, 4, 5),
(25, 5, 5),
(24, 7, 3),
(17, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `idmember` int(11) NOT NULL,
  `confirme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `email`, `message`, `idmember`, `confirme`) VALUES
(2, 'brahimiroumaissa1@gmail.com', 'maybe yes maybe no', 3, 1),
(3, 'zerioul@gmail.com', 'heloo', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idfname` int(11) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `texte` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `approuve` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `idfname`, `produit`, `texte`, `class`, `approuve`) VALUES
(8, 3, '16147_antique-books-design-256450.jpg', 'book', 'book', 0),
(3, 4, '46582_6.jpeg', '', 'brand', 1),
(5, 5, '74451_black-blank-space-brand-1493324(1).jpg', 'brand', 'brand', 1),
(6, 5, '75299_blur-brand-depth-of-field-2016145.jpg', 'brand', 'brand', 1),
(10, 5, '40414_65269366_2363996087206684_6493184472089886720_n.jpg', 'logo', 'logo', 0),
(9, 3, '85749_images.png', 'logo', 'logo', 0),
(11, 5, '38159_65054161_2363995823873377_8280911093757378560_n.jpg', 'logo', 'logo', 0),
(12, 5, '60840_65279706_2363996317206661_4668779315045859328_n.jpg', 'logo', 'logo', 0),
(13, 5, '59525_65299783_2363995963873363_2292859572185989120_n.jpg', 'logo', 'logo', 0),
(14, 5, '11786_65497649_137190980813051_1406859491772727296_n.jpg', 'logo', 'logo', 0),
(15, 5, '62961_65069113_135849217613894_160301163172855808_n.jpg', 'logo', 'logo', 0),
(16, 5, '40604_FB_IMG_15540467388128486.jpg', 'logo', 'logo', 0),
(17, 4, '73981_64725079_621023508420200_8885880163934404608_n.jpg', 'media', 'media', 0),
(18, 4, '46191_64914723_2283256838606241_1827079431315783680_n.jpg', 'media', 'media', 0),
(19, 4, '48447_64801743_2312827282324959_333724739925180416_n.jpg', 'media', 'media', 0),
(20, 4, '22537_FB_IMG_15540471242328412.jpg', 'media', 'media', 0),
(21, 12, '52185_FB_IMG_15540466963080406.jpg', ' food covre', ' food covre', 0),
(22, 12, '79148_FB_IMG_15567451936780158.jpg', ' food covre', ' food covre', 0),
(23, 12, '1171_FB_IMG_15615695149196274.jpg', ' food covre', ' food covre', 0),
(24, 12, '17669_FB_IMG_15615695108576779.jpg', ' food covre', ' food covre', 0),
(25, 12, '91794_FB_IMG_15615699693672140.jpg', ' food ', ' food ', 0),
(26, 12, '82264_FB_IMG_15618383378321536.jpg', 'media', 'media', 0),
(27, 4, '30527_FB_IMG_15622432435342859.jpg', 'brand', 'brand', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `confirme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `fname`, `lname`, `email`, `pass`, `avatar`, `job`, `confirme`) VALUES
(3, 'Admin', 'page', 'admin@gmail.com', '14b5db8193b4e5cd91189bd51556d7866cbbc6d4', '3.png', 'Admin', 1),
(4, 'sarra', 'leulmi', 'sara@gmail.com', 'c15b7b735c97215ce1d2a4b5502e96b9b8cbbe57', '4.jpg', 'designer ', 1),
(5, 'roumaissa', 'brahimi ', 'romaissa@gmail.com', 'cb4fc4206a10eb1e63aafc82ae0f03e5296591d4', '5.jpg', 'designer', 1),
(12, 'Imane', 'Mezdour', 'imane@gmail.com', 'ac42d9cc0095b3aa940679294d413133fcefcce9', '12.jpg', 'designer ', 1);
