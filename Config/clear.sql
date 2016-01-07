# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- insee_geo_region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_region`;

-- ---------------------------------------------------------------------
-- insee_geo_department
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_department`;

-- ---------------------------------------------------------------------
-- insee_geo_municipality
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_municipality`;

-- ---------------------------------------------------------------------
-- insee_geo_region_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_region_i18n`;

-- ---------------------------------------------------------------------
-- insee_geo_department_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_department_i18n`;

-- ---------------------------------------------------------------------
-- insee_geo_municipality_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `insee_geo_municipality_i18n`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
