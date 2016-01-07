SET FOREIGN_KEY_CHECKS = 0;

-- Department table update
-- Update de le table department
UPDATE `insee_geo_department`
SET `region_id` = concat('0',`region_id`)
WHERE LENGTH(`region_id`) = 1;

-- region table update
-- Update de le table region
UPDATE `insee_geo_region`
SET `id` = concat('0',`id`)
WHERE LENGTH(`id`) = 1;
UPDATE `insee_geo_region`
SET `prefecture_id` = concat('0',`prefecture_id`)
WHERE LENGTH(`prefecture_id`) = 4;

-- region i18n  table update
-- Update de la table region i18n
UPDATE `insee_geo_region_i18n`
SET `id` = concat('0',`id`)
WHERE LENGTH(`id`) = 1;

-- municipality  table update
-- Update de le table municipality
UPDATE `insee_geo_municipality`
SET `id` = concat('0',`id`)
WHERE LENGTH(`id`) = 4;
UPDATE `insee_geo_municipality`
SET `zip_code` = concat('0',`zip_code`)
WHERE LENGTH(`zip_code`) = 4;
UPDATE `insee_geo_municipality`
SET `department_id` = concat('0',`department_id`)
WHERE LENGTH(`department_id`) = 1;
UPDATE `insee_geo_municipality`
SET `region_id` = concat('0',`region_id`)
WHERE LENGTH(`region_id`) = 1;

-- municipality i18n  table update
-- Update de la table municipality i18n
UPDATE `insee_geo_municipality_i18n`
SET `id` = concat('0',`id`)
WHERE LENGTH(`id`) = 4;

SET FOREIGN_KEY_CHECKS = 1;
