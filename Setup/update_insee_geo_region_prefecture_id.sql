SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `insee_geo_region`
    MODIFY `prefecture_id` VARCHAR(5);

UPDATE `insee_geo_region`
    SET `prefecture_id` = '2A004'
WHERE `id` = 94;


SET FOREIGN_KEY_CHECKS = 1;