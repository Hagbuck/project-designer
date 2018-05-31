-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 31 mai 2018 à 21:44
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projectdesigner`
--

-- --------------------------------------------------------

--
-- Structure de la table `accede`
--

CREATE TABLE `accede` (
  `id_projet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `est_admin` tinyint(1) NOT NULL,
  `est_moderateur` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `accede`
--

INSERT INTO `accede` (`id_projet`, `id_utilisateur`, `est_admin`, `est_moderateur`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(8, 1, 1, 1),
(11, 7, 1, 1),
(12, 10, 1, 1),
(13, 4, 1, 1),
(14, 4, 1, 1),
(15, 4, 1, 1),
(11, 3, 1, 1),
(12, 2, 1, 1),
(16, 10, 1, 1),
(17, 11, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `branche`
--

CREATE TABLE `branche` (
  `id_diagramme` int(11) NOT NULL,
  `id_branche` int(11) NOT NULL,
  `nom_branche` varchar(255) COLLATE utf8_latvian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `branche`
--

INSERT INTO `branche` (`id_diagramme`, `id_branche`, `nom_branche`) VALUES
(1, 1, 'Programation'),
(1, 2, 'Design'),
(1, 5, 'Random'),
(2, 1, 'BrancheTest'),
(2, 2, 'Un autre test'),
(2, 3, 'AimeTest'),
(4, 1, 'test'),
(6, 1, 'Design'),
(6, 2, 'Gameplay'),
(6, 3, 'Technos');

-- --------------------------------------------------------

--
-- Structure de la table `diagramme`
--

CREATE TABLE `diagramme` (
  `id_diagramme` int(11) NOT NULL,
  `id_projet` int(11) NOT NULL,
  `nom_diagramme` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `description_diagramme` varchar(512) COLLATE utf8_latvian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `diagramme`
--

INSERT INTO `diagramme` (`id_diagramme`, `id_projet`, `nom_diagramme`, `description_diagramme`) VALUES
(1, 1, 'Super Diagram', 'Un super Diagram qui est vraiment trop cool!'),
(2, 1, 'Un Autre Diagram', 'Car trop cool les diagrammes ! '),
(3, 2, 'GameDesign', 'Inception ! '),
(4, 11, 'DiagTest', 'test'),
(5, 12, 'Diag1', 'Diag 1'),
(6, 17, 'AdminGraphs ', 'Cause admins like graphs ! ');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `nom_projet` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `date_creation_projet` date NOT NULL,
  `description_projet` varchar(512) COLLATE utf8_latvian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`id_projet`, `nom_projet`, `date_creation_projet`, `description_projet`) VALUES
(1, 'Test_projet', '2018-05-17', 'Ceci est un projet test'),
(2, 'Test_projet 2', '2018-05-17', 'Ceci est un projet test 2'),
(7, 'Test 3', '2018-05-17', 'duhfsdmf'),
(17, 'AdminProject', '2018-05-31', 'This is a special admin project ! '),
(10, 'ThisIsAtest', '2018-05-27', 'Tets'),
(12, 'Projet1', '2018-05-31', 'test'),
(14, 'SuperDragzProject', '2018-05-31', '1 2 3 '),
(15, 'TestPointVirgule', '2018-05-31', 'Il ne faut pas mettre de point virgule ! '),
(16, 'ProjetPartage', '2018-05-31', 'Partage');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `id_diagramme` int(11) NOT NULL,
  `texte_tag` varchar(32) COLLATE utf8_latvian_ci NOT NULL,
  `pos_x_tag` int(10) DEFAULT NULL,
  `pos_y_tag` int(10) DEFAULT NULL,
  `couleur_tag` varchar(256) COLLATE utf8_latvian_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id_tag`, `id_diagramme`, `texte_tag`, `pos_x_tag`, `pos_y_tag`, `couleur_tag`) VALUES
(1, 1, 'My Text', 214, 423, '#B65B80'),
(2, 1, 'Oui', -186, -111, '#1dc943'),
(18, 2, 'Test2', -123, -48, '#808000'),
(17, 2, 'TestX', -127, 42, '#8080ff'),
(22, 1, 'supermega', -90, -23, '#408080'),
(14, 1, 'New note', 88, -85, '#F0FA0F'),
(19, 2, 'Work', 80, -68, '#808000'),
(20, 2, 'golom', 69, 55, '#ff00ff'),
(21, 2, 'Test', -163, -124, '#5abd4d'),
(23, 3, 'SuperNote', -324, -93, '#883dcd'),
(24, 4, 'This is a tag', 129, -37, '#4d99bd'),
(25, 4, 'Another tag', 206, 43, '#ba8f50'),
(26, 4, 'Police', 91, 42, '#6a2edc'),
(27, 4, 'Yiop', 247, -34, '#e29327'),
(28, 6, 'Vampires ? ', -136, -160, '#3481d6'),
(29, 6, 'DanceFloor', -88, -78, '#800080'),
(30, 6, 'Medival', -52, 55, '#00ff00'),
(31, 6, 'Futurist', -88, 141, '#ff8000'),
(32, 6, 'C', 117, -2, '#87b158'),
(33, 6, 'JS', 233, -36, '#ff0080');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `prenom_utilisateur` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `pseudo_utilisateur` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `mdp_utilisateur` varchar(256) COLLATE utf8_latvian_ci NOT NULL,
  `mail_utilisateur` varchar(256) COLLATE utf8_latvian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_latvian_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `pseudo_utilisateur`, `mdp_utilisateur`, `mail_utilisateur`) VALUES
(1, 'Mensoif', 'Gérard', 'FreshWater91', 'limonade1*', 'g.mensoif@gmail.com'),
(2, 'Kennobi', 'Obi Juan', 'ForceSaver', 'a6hfaD9%', 'ObiJuanKennobiOfficial@conseil-jedi.com'),
(3, 'Einstein', 'Albert', 'Test', 'testmdp', 'atomic_mind@paradise.com'),
(4, 'Prévu', 'Corentin', 'Dragzou_ChatLord', 'd3vIsLif3', 'c.p@u-psud.fr'),
(6, 'Test', 'Tset', 'Je suis un Test', 'test', 'test@test.com'),
(7, 'Corentin', 'Troadec', 'Dragz', 'admin', 'dragzTest@gmail.com'),
(8, 'Pass', 'Word', 'Retest', 'password', 'test@test.com'),
(9, 'Pass', 'Word', 'ReTest', 'pass', 'test@test.com'),
(10, 'Jean', 'Mich', 'Jean-Mich', '123', 'jean@mich.com'),
(11, 'admin', 'admin', 'admin', 'admin', 'admin@admin.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accede`
--
ALTER TABLE `accede`
  ADD PRIMARY KEY (`id_projet`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `branche`
--
ALTER TABLE `branche`
  ADD PRIMARY KEY (`id_diagramme`,`id_branche`);

--
-- Index pour la table `diagramme`
--
ALTER TABLE `diagramme`
  ADD PRIMARY KEY (`id_diagramme`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD KEY `id_diagramme` (`id_diagramme`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `branche`
--
ALTER TABLE `branche`
  MODIFY `id_branche` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `diagramme`
--
ALTER TABLE `diagramme`
  MODIFY `id_diagramme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
