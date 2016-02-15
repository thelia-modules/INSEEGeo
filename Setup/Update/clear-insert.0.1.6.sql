SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- insee_geo_department_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_municipality`;

DROP TABLE IF EXISTS `insee_geo_municipality_i18n`;

-- ---------------------------------------------------------------------
-- insee_geo_department_i18n
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
-- insee_geo_municipality_i18n
-- ---------------------------------------------------------------------

CREATE TABLE `insee_geo_municipality_i18n`
(
  `id` INTEGER NOT NULL,
  `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
  `name` TEXT,
  PRIMARY KEY (`id`,`locale`),
  CONSTRAINT `insee_geo_municipality_i18n_FK_1`
  FOREIGN KEY (`id`)
  REFERENCES `insee_geo_municipality` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
