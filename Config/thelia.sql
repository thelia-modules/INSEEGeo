
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- insee_geo_region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_region`;

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

DROP TABLE IF EXISTS `insee_geo_department`;

CREATE TABLE `insee_geo_department`
(
    `id` VARCHAR(3) NOT NULL,
    `main_municipality_id` VARCHAR(5),
    `region_id` INTEGER,
    `geo_point2d_x` DOUBLE,
    `geo_point2d_y` DOUBLE,
    `geo_shape` TEXT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `FI_insee_geo_department_region_id` (`region_id`),
    CONSTRAINT `fk_insee_geo_department_region_id`
        FOREIGN KEY (`region_id`)
        REFERENCES `insee_geo_region` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_municipality
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_municipality`;

CREATE TABLE `insee_geo_municipality`
(
    `id` VARCHAR(5) NOT NULL,
    `zip_code` VARCHAR(5),
    `geo_point2d_x` DOUBLE,
    `geo_point2d_y` DOUBLE,
    `geo_shape` TEXT,
    `municipality_code` INTEGER,
    `district_code` INTEGER,
    `department_id` VARCHAR(2),
    `region_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `FI_insee_geo_municipality_department_id` (`department_id`),
    INDEX `FI_insee_geo_municipality_region_id` (`region_id`),
    CONSTRAINT `fk_insee_geo_municipality_department_id`
        FOREIGN KEY (`department_id`)
        REFERENCES `insee_geo_department` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE,
    CONSTRAINT `fk_insee_geo_municipality_region_id`
        FOREIGN KEY (`region_id`)
        REFERENCES `insee_geo_region` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_region_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_region_i18n`;

CREATE TABLE `insee_geo_region_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `name` TEXT NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `insee_geo_region_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `insee_geo_region` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_department_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_department_i18n`;

CREATE TABLE `insee_geo_department_i18n`
(
    `id` VARCHAR(3) NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `name` TEXT NOT NULL,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `insee_geo_department_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `insee_geo_department` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- insee_geo_municipality_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_municipality_i18n`;

CREATE TABLE `insee_geo_municipality_i18n`
(
    `id` VARCHAR(5) NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `name` TEXT,
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `insee_geo_municipality_i18n_FK_1`
        FOREIGN KEY (`id`)
        REFERENCES `insee_geo_municipality` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
