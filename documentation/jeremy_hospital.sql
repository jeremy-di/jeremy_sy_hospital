-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 déc. 2023 à 15:51
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jeremy_hospital`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231217012326', '2023-12-17 02:23:36', 1388);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `zip_code` int(11) NOT NULL,
  `town` varchar(255) NOT NULL,
  `insee_number` varchar(255) NOT NULL,
  `medical_mutual` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `pathology` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `name`, `first_name`, `address`, `zip_code`, `town`, `insee_number`, `medical_mutual`, `phone_number`, `pathology`) VALUES
(1, 'Valentine', 'Jill', '33 rue des asturies', 35000, 'Rennes', '2850235123589', 'Almerys', '0645879630', 'Blessure à la tête sans commotion'),
(2, 'Alpert', 'Jimmy', '25 rue de Bourgogne', 35760, 'Rennes', '1890135236589', 'Armonie', '0656963014', 'Asthme aggravé');

-- --------------------------------------------------------

--
-- Structure de la table `patient_user`
--

CREATE TABLE `patient_user` (
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient_user`
--

INSERT INTO `patient_user` (`patient_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `staff_member_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `number` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `staff_member_id`, `patient_id`, `number`, `service`, `type`) VALUES
(1, 1, NULL, 'Box 1', 'Urgences', 'Box des urgences'),
(2, 1, NULL, 'Box 2', 'Urgences', 'Box des urgences'),
(3, 1, NULL, 'Box 3', 'Urgences', 'Box des urgences'),
(4, 1, NULL, '101', 'Cardiologie', 'Chambre de service'),
(5, 1, NULL, '102', 'Cardiologie', 'Chambre de service'),
(6, 1, NULL, '103', 'Cardiologie', 'Chambre de service'),
(7, 1, NULL, '104', 'Chirurgie', 'Chambre de service'),
(8, 1, NULL, '105', 'Chirurgie', 'Chambre de service'),
(9, 1, NULL, '106', 'Chirurgie', 'Salle de reveil'),
(10, 1, NULL, '201', 'Epidemiologie', 'Chambre de service'),
(11, 1, NULL, '202', 'Epidemiologie', 'Chambre de service'),
(12, 1, NULL, '203', 'Epidemiologie', 'Chambre de service'),
(13, 1, NULL, '301', 'Geriatrie', 'Chambre de service'),
(14, 1, NULL, '302', 'Geriatrie', 'Chambre de service'),
(15, 1, NULL, '303', 'Geriatrie', 'Chambre de service'),
(16, 1, NULL, '401', 'Laboratoire', 'Chambre de service'),
(17, 1, NULL, '402', 'Laboratoire', 'Chambre de service'),
(18, 1, NULL, '403', 'Laboratoire', 'Chambre de service'),
(19, 1, NULL, '501', 'Nephrologie', 'Chambre de service'),
(20, 1, NULL, '502', 'Nephrologie', 'Chambre de service'),
(21, 1, NULL, '503', 'Nephrologie', 'Chambre de service'),
(22, 1, NULL, '504', 'Oncologie', 'Chambre de service'),
(23, 1, NULL, '505', 'Oncologie', 'Chambre de service'),
(24, 1, NULL, '506', 'Oncologie', 'Chambre de service'),
(25, 1, 2, '601', 'Pediatrie', 'Chambre de service'),
(26, 1, NULL, '602', 'Pediatrie', 'Chambre de service'),
(27, 1, NULL, '603', 'Pediatrie', 'Chambre de service'),
(28, 1, NULL, '701', 'Pneumologie', 'Chambre de service'),
(29, 1, NULL, '702', 'Pneumologie', 'Chambre de service'),
(30, 1, NULL, '703', 'Pneumologie', 'Chambre de service'),
(31, 1, NULL, 'Box 4', 'Urgences pediatriques', 'Box des urgences'),
(32, 1, NULL, 'Box 5', 'Urgences pediatriques', 'Box des urgences'),
(33, 1, NULL, 'Box 6', 'Urgences pediatriques', 'Box des urgences'),
(34, 1, 1, 'UH 1', 'UHTCD', 'Chambre de service'),
(35, 1, NULL, 'UH 2', 'UHTCD', 'Chambre de service'),
(36, 1, NULL, 'UH 3', 'UHTCD', 'Chambre de service');

-- --------------------------------------------------------

--
-- Structure de la table `transmission`
--

CREATE TABLE `transmission` (
  `id` int(11) NOT NULL,
  `staff_member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transmission`
--

INSERT INTO `transmission` (`id`, `staff_member_id`, `title`, `date`, `content`) VALUES
(1, 1, 'Valentine Jill', '2023-12-17 02:32:24', 'Reçu en chirurgie pour des points de suture, surveillance en chambre durant 2 jours avec traitement'),
(2, 2, 'Alpert Jimmy', '2023-12-18 14:09:52', 'Arrivée suite à une crise d\'asthme aigue, prise en charge avec oxygène à 9 litres par minutes puis mise en place d\'un aérosol Brycanil, Atrovent. Soulagement dans l\'heure qui à suivie puis attente de stabilité. Je décide d\'hospitalisé le patient au service pédiatrie lorsque son état sera stabilisé.\r\n\r\nInfirmière Caralan : Transmission bien reçue, je fais le nécessaire auprès du service de pédiatrie.');

-- --------------------------------------------------------

--
-- Structure de la table `treatment`
--

CREATE TABLE `treatment` (
  `id` int(11) NOT NULL,
  `staff_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `posology` varchar(255) NOT NULL,
  `validation` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `treatment`
--

INSERT INTO `treatment` (`id`, `staff_member_id`, `name`, `description`, `posology`, `validation`, `status`) VALUES
(1, 1, 'Bétadine 200', 'Appliquer la bétadine sur la plaie avec une compresse 3 fois par jour durant 2 jours', '3', 'Vu et validé par équipe soignante', 'En cours'),
(2, 2, 'Brycanil', 'Brycanil 10 microgrammes en aérosol 3 fois par jour', '3', 'Vu et validé par équipe soignante', 'En cours'),
(3, 2, 'Atrovent', '5 microgrammes en ampoule par aérosol\r\n3 fois par jour en même temps que le brycanil', '3', 'Vu et validé par équipe soignante', 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `treatment_patient`
--

CREATE TABLE `treatment_patient` (
  `treatment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `treatment_patient`
--

INSERT INTO `treatment_patient` (`treatment_id`, `patient_id`) VALUES
(1, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`, `first_name`, `service`, `phone_number`, `status`, `job_title`) VALUES
(1, 'wesker.a@umb-admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$8G9mQgxqw2MCbbf9Ee1Szu4q4J3b3GLJ8nZXIsCbVK4PrWyFZUOTO', 'Wesker', 'Albert', 'Chirurgie', '0222105501', 'Actif', 'Medecin'),
(2, 'ashford.a@umb-med.com', '[\"ROLE_MED\"]', '$2y$13$JYkIQetynCJfGPbt8yagJu9DCRpqMT9wkIa6UMVuutdMqvSV5czpS', 'Ashford', 'Alexia', 'Urgences', '0222105502', 'Actif', 'Medecin'),
(3, 'caralan.d@umb-inf.com', '[\"ROLE_INF\"]', '$2y$13$q8Ukexquf1D8JVQ1cnQqq.dNPNCmpAS48PNtGHaq/j6jxwB6SrKFi', 'Caralan', 'Deborah', 'Urgences', '0222105503', 'Actif', 'Infirmiere'),
(4, 'birkin.a@umb-admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$WZg0EmL0eZVRMaZgyjzqlOQ7j68fMJvDsaVUAclDOOJfINjIe7MVq', 'Birkin', 'Annette', 'Laboratoire', '0222105504', 'Actif', 'Medecin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `patient_user`
--
ALTER TABLE `patient_user`
  ADD PRIMARY KEY (`patient_id`,`user_id`),
  ADD KEY `IDX_4029B816B899279` (`patient_id`),
  ADD KEY `IDX_4029B81A76ED395` (`user_id`);

--
-- Index pour la table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_729F519B44DB03B1` (`staff_member_id`),
  ADD KEY `IDX_729F519B6B899279` (`patient_id`);

--
-- Index pour la table `transmission`
--
ALTER TABLE `transmission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7F87199F44DB03B1` (`staff_member_id`);

--
-- Index pour la table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_98013C3144DB03B1` (`staff_member_id`);

--
-- Index pour la table `treatment_patient`
--
ALTER TABLE `treatment_patient`
  ADD PRIMARY KEY (`treatment_id`,`patient_id`),
  ADD KEY `IDX_621C1527471C0366` (`treatment_id`),
  ADD KEY `IDX_621C15276B899279` (`patient_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `transmission`
--
ALTER TABLE `transmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `patient_user`
--
ALTER TABLE `patient_user`
  ADD CONSTRAINT `FK_4029B816B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4029B81A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519B44DB03B1` FOREIGN KEY (`staff_member_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_729F519B6B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);

--
-- Contraintes pour la table `transmission`
--
ALTER TABLE `transmission`
  ADD CONSTRAINT `FK_7F87199F44DB03B1` FOREIGN KEY (`staff_member_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `FK_98013C3144DB03B1` FOREIGN KEY (`staff_member_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `treatment_patient`
--
ALTER TABLE `treatment_patient`
  ADD CONSTRAINT `FK_621C1527471C0366` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_621C15276B899279` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
