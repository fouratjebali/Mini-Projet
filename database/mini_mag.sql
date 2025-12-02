-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 09:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_mag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `date_creation`) VALUES
(1, 'admin', 'admin123', 'admin@minimag.com', '2025-11-30 16:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `kicker` varchar(100) NOT NULL,
  `lead` text NOT NULL,
  `contenu` text NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `date_publication` datetime DEFAULT current_timestamp(),
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `kicker`, `lead`, `contenu`, `image_url`, `auteur`, `date_publication`, `slug`) VALUES
(1, 'Les coulisses d\'un festival local', 'Culture', 'Des répétitions aux food trucks, immersion dans une édition pas comme les autres.', '<h2>Au programme</h2><p>Le festival s\'appuie sur un réseau de bénévoles et des partenariats locaux pour valoriser les talents de la scène émergente.</p><p>L\'édition 2025 met l\'accent sur la réduction des déchets, l\'accessibilité et l\'inclusion.</p><h2>Points clés</h2><ul><li>Programmation 100% locale et éco-conçue</li><li>Décors modulaires réutilisables</li><li>Charte éthique pour les exposants</li></ul>', 'https://images.unsplash.com/photo-1506157786151-b8491531f063?q=80&w=1600&auto=format&fit=crop', 'A. Martin', '2025-11-30 16:53:19', 'coulisses-festival-local'),
(2, 'IA : le tournant grand public', 'Tech', 'Outils créatifs, assistants et éducation : l\'IA quitte les labos pour nos usages quotidiens.', '<h2>Au programme</h2><p>L\'accessibilité des nouveaux outils ouvre des opportunités, mais demande transparence et formation.</p><p>Entre gains de productivité et enjeux éthiques, les choix de design sont déterminants.</p><h2>Points clés</h2><ul><li>Comprendre les limites des modèles</li><li>Protéger ses données personnelles</li><li>Développer la littératie numérique</li></ul>', 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1600&auto=format&fit=crop', 'N. Saïd', '2025-11-30 16:53:19', 'ia-tournant-grand-public'),
(3, '48h à Naples : dolce vita express', 'Voyage', 'Entre patrimoine, cafés historiques et belvédères, un concentré de Méditerranée.', '<h2>Au programme</h2><p>Arpentez Spaccanapoli, visitez le musée archéologique et grimpez au belvédère de San Martino.</p><p>Côté cuisine, la pizza fritta et le sfogliatella sont incontournables.</p><h2>Points clés</h2><ul><li>Itinéraires courts par quartier</li><li>Transports publics et funiculaires</li><li>Bonnes adresses pour un budget moyen</li></ul>', 'https://www.royalcaribbean.com/media-assets/pmc/content/dam/shore-x/naples-nap/npa1-leisurely-sorrento/stock-photo-landscape-with-atrani-town-at-famous-amalfi-coast-italy-1436187389.jpg?w=1920', 'L. Rossi', '2025-11-30 16:53:19', '48h-naples-dolce-vita');

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `article_id`, `nom`, `commentaire`, `date_commentaire`) VALUES
(1, 2, 'Fourat', 'good article', '2025-11-30 17:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `date_like` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `article_id`, `ip_address`, `date_like`) VALUES
(1, 1, '::1', '2025-11-30 17:21:44'),
(2, 2, '::1', '2025-11-30 17:22:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_date` (`date_publication`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_article` (`article_id`),
  ADD KEY `idx_date` (`date_commentaire`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`article_id`,`ip_address`),
  ADD KEY `idx_article` (`article_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
