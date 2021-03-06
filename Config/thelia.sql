# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- DROP Tables
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_region`;
DROP TABLE IF EXISTS `insee_geo_department`;
DROP TABLE IF EXISTS `insee_geo_municipality`;
DROP TABLE IF EXISTS `insee_geo_region_i18n`;
DROP TABLE IF EXISTS `insee_geo_department_i18n`;
DROP TABLE IF EXISTS `insee_geo_municipality_i18n`;

-- ---------------------------------------------------------------------
-- insee_geo_region
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_region`
(
  `id` INTEGER NOT NULL,
  `prefecture_id` VARCHAR(5),
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_department
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_department`
(
  `id` INTEGER NOT NULL,
  `insee_code` VARCHAR(5) NOT NULL,
  `position` INTEGER NOT NULL,
  `main_municipality_id` VARCHAR(5),
  `region_id` INTEGER,
  `geo_point2d_x` DOUBLE,
  `geo_point2d_y` DOUBLE,
  `geo_shape` TEXT,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`),
  INDEX `FI_insee_geo_department_region_id` (`region_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_municipality
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_municipality`
(
  `id` INTEGER NOT NULL,
  `insee_code` VARCHAR(5),
  `zip_code` VARCHAR(5),
  `geo_point2d_x` DOUBLE,
  `geo_point2d_y` DOUBLE,
  `geo_shape` TEXT,
  `municipality_code` INTEGER,
  `district_code` INTEGER,
  `department_id` INTEGER,
  `region_id` INTEGER,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`id`),
  INDEX `idx_insee_code` (`insee_code`(5)),
  INDEX `idx_zip_code` (`zip_code`(5)),
  INDEX `FI_insee_geo_municipality_department_id` (`department_id`),
  INDEX `FI_insee_geo_municipality_region_id` (`region_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_region_i18n
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_region_i18n`
(
  `id` INTEGER NOT NULL,
  `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
  `name` TEXT NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_department_i18n
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_department_i18n`
(
  `id` INTEGER NOT NULL,
  `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
  `name` TEXT NOT NULL,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_municipality_i18n
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_municipality_i18n`
(
  `id` INTEGER NOT NULL,
  `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
  `name` TEXT,
  PRIMARY KEY (`id`,`locale`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Contraintes pour les tables exportées
-- ---------------------------------------------------------------------

--
-- Contraintes pour la table `insee_geo_department`
--
ALTER TABLE `insee_geo_department`
  ADD CONSTRAINT `fk_insee_geo_department_region_id` FOREIGN KEY (`region_id`) REFERENCES `insee_geo_region` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `insee_geo_department_i18n`
--
ALTER TABLE `insee_geo_department_i18n`
  ADD CONSTRAINT `insee_geo_department_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `insee_geo_department` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `insee_geo_municipality`
--
ALTER TABLE `insee_geo_municipality`
  ADD CONSTRAINT `fk_insee_geo_municipality_department_id` FOREIGN KEY (`department_id`) REFERENCES `insee_geo_department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_insee_geo_municipality_region_id` FOREIGN KEY (`region_id`) REFERENCES `insee_geo_region` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `insee_geo_municipality_i18n`
--
ALTER TABLE `insee_geo_municipality_i18n`
  ADD CONSTRAINT `insee_geo_municipality_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `insee_geo_municipality` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `insee_geo_region_i18n`
--
ALTER TABLE `insee_geo_region_i18n`
  ADD CONSTRAINT `insee_geo_region_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `insee_geo_region` (`id`) ON DELETE CASCADE;


# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;