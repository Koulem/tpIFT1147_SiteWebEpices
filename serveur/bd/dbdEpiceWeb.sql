-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2024 at 12:42 AM
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
-- Database: `dbdEpiceWeb`
--

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idcmd` int(11) NOT NULL,
  `idm` int(11) NOT NULL,
  `ide` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `datecmd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--

CREATE TABLE `connexion` (
  `idm` int(11) NOT NULL,
  `courriel` varchar(256) NOT NULL,
  `motDePass` varchar(12) NOT NULL,
  `role` varchar(2) NOT NULL,
  `statut` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`idm`, `courriel`, `motDePass`, `role`, `statut`) VALUES
(1, 'ray_chartmn@live.ca', 'Ray_charl2', 'A', 'A'),
(5, 'kahilthibodeau@videotron.ca', 'Kahitibod1', 'M', 'A'),
(6, 'julioronc@udmstd.ca', 'Julioudm2', 'M', 'A'),
(7, 'johndoe@live.com', 'Johnydoe4', 'M', 'A'),
(8, 'michoubro@live.ca', 'Michelle02', 'M', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `epices`
--

CREATE TABLE `epices` (
  `ide` int(11) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `types` varchar(40) NOT NULL,
  `prix` float NOT NULL,
  `vendeur` varchar(80) NOT NULL,
  `images` varchar(256) NOT NULL,
  `descriptions` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `epices`
--

INSERT INTO `epices` (`ide`, `nom`, `types`, `prix`, `vendeur`, `images`, `descriptions`) VALUES
(1, 'Gingembre moulu', 'Épice', 3.1, 'Épices du Monde', 'gingembre.webp', 'Épice chaude et piquante, utilisée dans les pâtisseries, les marinades et les plats asiatiques.'),
(2, 'Fenugrec moulu', 'Épice', 2.75, 'La Maison des Arômes', 'fenugrec.webp', 'Épice amère et noisettée, utilisée dans les currys, les mélanges d\'épices et pour faire du pain.'),
(3, 'Piment de Cayenne', 'Épice', 3.5, 'Les Saveurs Exotiques', 'cayenne.webp', 'Épice très piquante, utilisée pour relever les plats, les sauces et les marinades.'),
(4, 'Clous de girofle moulus', 'Épice', 4.4, 'Au Poivre Sauvage', 'clous_de_girofle.webp', 'Épice piquante et chaude, utilisée dans les plats mijotés, les desserts et pour l\'assaisonnement des viandes.'),
(5, 'Graines de fenouil', 'Épice', 3, 'Épices Traditionnelles', 'fenouil.webp', 'Épice anisée et douce, utilisée dans les plats de poisson, les sauces et les saucisses.'),
(6, 'Graines de moutarde', 'Épice', 2.9, 'Épices du Monde', 'moutarde.webp', 'Épice piquante et rustique, utilisée dans la préparation de condiments et pour assaisonner les plats.'),
(7, 'Piment doux', 'Épice', 3.25, 'La Maison des Arômes', 'piment_doux.webp', 'Épice légèrement piquante et sucrée, utilisée dans les plats mijotés et les sauces.'),
(8, 'Anis étoilé', 'Épice', 5.5, 'Les Saveurs Exotiques', 'anis_etoile.webp', 'Épice douce avec un goût rappelant la réglisse, utilisée dans les plats sucrés et salés, et pour aromatiser les boissons.'),
(9, 'Grains de paradis', 'Épice', 6.2, 'Au Poivre Sauvage', 'grains_de_paradis.webp', 'Épice africaine au goût poivré et légèrement citronné, utilisée dans les plats mijotés et les marinades.'),
(10, 'Sumac', 'Épice', 3.8, 'Épices Traditionnelles', 'sumac.webp', 'Épice acide et fruitée, utilisée dans la cuisine moyen-orientale, pour assaisonner les salades, les viandes et les poissons.'),
(11, 'Ras el hanout', 'Épice', 4.5, 'Épices du Monde', 'ras_el_hanout.webp', 'Mélange d\'épices nord-africain, utilisé dans les tajines, les soupes et les plats de riz.'),
(12, 'Herbes de Provence', 'Mélange d\'épices', 3.35, 'La Maison des Arômes', 'herbes_de_provence.webp', 'Mélange d\'herbes aromatiques typique de la cuisine française, utilisé pour les grillades, les ragoûts et les légumes.'),
(13, 'Poudre de chili', 'Mélange d\'épices', 3.6, 'Les Saveurs Exotiques', 'poudre_de_chili.webp', 'Mélange d\'épices piquant, utilisé dans la préparation du chili con carne et d\'autres plats tex-mex.'),
(14, 'Curry en poudre', 'Mélange d\'épices', 3.95, 'Au Poivre Sauvage', 'curry.webp', 'Mélange d\'épices indien, utilisé dans les currys, les soupes et comme assaisonnement.'),
(15, 'Cinq-épices chinois', 'Mélange d\'épices', 4.1, 'Épices Traditionnelles', 'cinq_epices.webp', 'Mélange d\'épices utilisé dans la cuisine chinoise, idéal pour mariner les viandes et parfumer les plats mijotés.'),
(16, 'Garam masala', 'Mélange d\'épices', 4.25, 'Épices du Monde', 'garam_masala.webp', 'Mélange d\'épices chauffant, utilisé dans les plats indiens pour ajouter de la profondeur et de la chaleur.'),
(17, 'Thym séché', 'Herbe', 2.65, 'La Maison des Arômes', 'thym.webp', 'Herbe aromatique, utilisée dans les ragoûts, les bouillons et pour assaisonner les légumes.'),
(18, 'Romarin séché', 'Herbe', 2.75, 'Les Saveurs Exotiques', 'romarin.webp', 'Herbe boisée et parfumée, utilisée dans les plats de viande, les soupes et les pommes de terre.'),
(19, 'Basilic séché', 'Herbe', 2.85, 'Au Poivre Sauvage', 'basilic.webp', 'Herbe douce et légèrement poivrée, utilisée dans les sauces, les salades et les plats de pâtes.'),
(20, 'Origan séché', 'Herbe', 2.5, 'Épices Traditionnelles', 'origan.webp', 'Herbe aromatique avec un goût piquant, utilisée dans la cuisine italienne, grecque et mexicaine.');

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `idm` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `courriel` varchar(256) NOT NULL,
  `sexe` varchar(2) NOT NULL,
  `daten` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`idm`, `nom`, `prenom`, `courriel`, `sexe`, `daten`) VALUES
(1, 'Charles', 'Ray', 'ray_chartmn@live.ca', 'M', '1972-09-22'),
(5, 'katamb', 'kahil', 'kahilthibodeau@videotron.ca', 'M', '2005-05-02'),
(6, 'Roncho', 'jules', 'julioronc@udmstd.ca', 'M', '2009-07-07'),
(7, 'Doe', 'John', 'johndoe@live.com', 'M', '2010-04-03'),
(8, 'Lebro', 'Michelle', 'michoubro@live.ca', 'F', '2007-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `profileImg`
--

CREATE TABLE `profileImg` (
  `imgId` int(11) NOT NULL,
  `objPhotoRecue` varchar(256) NOT NULL,
  `imgDate` date NOT NULL,
  `idm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profileImg`
--

INSERT INTO `profileImg` (`imgId`, `objPhotoRecue`, `imgDate`, `idm`) VALUES
(1, 'Array', '2022-06-24', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idcmd`),
  ADD KEY `commande_idm_FK` (`idm`),
  ADD KEY `commande_ide_FK` (`ide`);

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD KEY `connexion_idm_FK` (`idm`);

--
-- Indexes for table `epices`
--
ALTER TABLE `epices`
  ADD PRIMARY KEY (`ide`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idm`);

--
-- Indexes for table `profileImg`
--
ALTER TABLE `profileImg`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `profileImg_FK_idm` (`idm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `idcmd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `epices`
--
ALTER TABLE `epices`
  MODIFY `ide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profileImg`
--
ALTER TABLE `profileImg`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ide_FK` FOREIGN KEY (`ide`) REFERENCES `epices` (`ide`),
  ADD CONSTRAINT `commande_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);

--
-- Constraints for table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `connexion_idm_FK` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);

--
-- Constraints for table `profileImg`
--
ALTER TABLE `profileImg`
  ADD CONSTRAINT `profileImg_FK_idm` FOREIGN KEY (`idm`) REFERENCES `membres` (`idm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION 

=====
CREATE TABLE `categories` (
   idCateg int(11) NOT NULL AUTO_INCREMENT,
   nom varchar (100) NOT NULL,
   categ varchar(40) COLLATE utf8_unicode_ci NOT NULL,
   PRIMARY KEY (idcateg),
   FOREIGN KEY (nom) REFERENCES `epices` (nom)
);

*/;
