SET FOREIGN_KEY_CHECKS = 0;

-- Department
TRUNCATE TABLE `insee_geo_department`;

-- Check if the column is already in the table. If not, create it.
-- Use `|` instead of `;` for the procedure, Thelia will replace them by `;` (Thelia/Install/Database.php:128)
CREATE PROCEDURE addPositionColumn()
  BEGIN
    IF NOT EXISTS(
        SELECT *
        FROM information_schema.COLUMNS
        WHERE COLUMN_NAME = 'position'
              AND TABLE_NAME = 'insee_geo_department'
              AND TABLE_SCHEMA = DATABASE()
    )
    THEN
      ALTER TABLE `insee_geo_department` ADD COLUMN `position` INTEGER NOT NULL
      AFTER `insee_code`|
    END IF|
  END|
;

CALL addPositionColumn();

DROP PROCEDURE addPositionColumn;

INSERT INTO `insee_geo_department`
VALUES
  (01, "01", 1, "01053", 82, 0, 0, "", now(), now()),
  (02, "02", 2, "02408", 22, 0, 0, "", now(), now()),
  (03, "03", 3, "03190", 83, 0, 0, "", now(), now()),
  (04, "04", 4, "04070", 93, 0, 0, "", now(), now()),
  (05, "05", 5, "05061", 93, 0, 0, "", now(), now()),
  (06, "06", 6, "06088", 93, 0, 0, "", now(), now()),
  (07, "07", 7, "07186", 82, 0, 0, "", now(), now()),
  (08, "08", 8, "08105", 21, 0, 0, "", now(), now()),
  (09, "09", 9, "09122", 73, 0, 0, "", now(), now()),
  (10, "10", 10, "10387", 21, 0, 0, "", now(), now()),
  (11, "11", 11, "11069", 91, 0, 0, "", now(), now()),
  (12, "12", 12, "12202", 73, 0, 0, "", now(), now()),
  (13, "13", 13, "13055", 93, 0, 0, "", now(), now()),
  (14, "14", 14, "14118", 25, 0, 0, "", now(), now()),
  (15, "15", 15, "15014", 83, 0, 0, "", now(), now()),
  (16, "16", 16, "16015", 54, 0, 0, "", now(), now()),
  (17, "17", 17, "17300", 54, 0, 0, "", now(), now()),
  (18, "18", 18, "18033", 24, 0, 0, "", now(), now()),
  (19, "19", 19, "19272", 74, 0, 0, "", now(), now()),
  (201, "2A", 20, "2A004", 94, 0, 0, "", now(), now()),
  (202, "2B", 21, "2B033", 94, 0, 0, "", now(), now()),
  (21, "21", 22, "21231", 26, 0, 0, "", now(), now()),
  (22, "22", 23, "22278", 53, 0, 0, "", now(), now()),
  (23, "23", 24, "23096", 74, 0, 0, "", now(), now()),
  (24, "24", 25, "24322", 72, 0, 0, "", now(), now()),
  (25, "25", 26, "25056", 43, 0, 0, "", now(), now()),
  (26, "26", 27, "26362", 82, 0, 0, "", now(), now()),
  (27, "27", 28, "27229", 23, 0, 0, "", now(), now()),
  (28, "28", 29, "28085", 24, 0, 0, "", now(), now()),
  (29, "29", 30, "29232", 53, 0, 0, "", now(), now()),
  (30, "30", 31, "30189", 91, 0, 0, "", now(), now()),
  (31, "31", 32, "31555", 73, 0, 0, "", now(), now()),
  (32, "32", 33, "32013", 73, 0, 0, "", now(), now()),
  (33, "33", 34, "33063", 72, 0, 0, "", now(), now()),
  (34, "34", 35, "34172", 91, 0, 0, "", now(), now()),
  (35, "35", 36, "35238", 53, 0, 0, "", now(), now()),
  (36, "36", 37, "36044", 24, 0, 0, "", now(), now()),
  (37, "37", 38, "37261", 24, 0, 0, "", now(), now()),
  (38, "38", 39, "38185", 82, 0, 0, "", now(), now()),
  (39, "39", 40, "39300", 43, 0, 0, "", now(), now()),
  (40, "40", 41, "40192", 72, 0, 0, "", now(), now()),
  (41, "41", 42, "41018", 24, 0, 0, "", now(), now()),
  (42, "42", 43, "42218", 82, 0, 0, "", now(), now()),
  (43, "43", 44, "43157", 83, 0, 0, "", now(), now()),
  (44, "44", 45, "44109", 52, 0, 0, "", now(), now()),
  (45, "45", 46, "45234", 24, 0, 0, "", now(), now()),
  (46, "46", 47, "46042", 73, 0, 0, "", now(), now()),
  (47, "47", 48, "47001", 72, 0, 0, "", now(), now()),
  (48, "48", 49, "48095", 91, 0, 0, "", now(), now()),
  (49, "49", 50, "49007", 52, 0, 0, "", now(), now()),
  (50, "50", 51, "50502", 25, 0, 0, "", now(), now()),
  (51, "51", 52, "51108", 21, 0, 0, "", now(), now()),
  (52, "52", 53, "52121", 21, 0, 0, "", now(), now()),
  (53, "53", 54, "53130", 52, 0, 0, "", now(), now()),
  (54, "54", 55, "54395", 41, 0, 0, "", now(), now()),
  (55, "55", 56, "55029", 41, 0, 0, "", now(), now()),
  (56, "56", 57, "56260", 53, 0, 0, "", now(), now()),
  (57, "57", 58, "57463", 41, 0, 0, "", now(), now()),
  (58, "58", 59, "58194", 26, 0, 0, "", now(), now()),
  (59, "59", 60, "59350", 31, 0, 0, "", now(), now()),
  (60, "60", 61, "60057", 22, 0, 0, "", now(), now()),
  (61, "61", 62, "61001", 25, 0, 0, "", now(), now()),
  (62, "62", 63, "62041", 31, 0, 0, "", now(), now()),
  (63, "63", 64, "63113", 83, 0, 0, "", now(), now()),
  (64, "64", 65, "64445", 72, 0, 0, "", now(), now()),
  (65, "65", 66, "65440", 73, 0, 0, "", now(), now()),
  (66, "66", 67, "66136", 91, 0, 0, "", now(), now()),
  (67, "67", 68, "67482", 42, 0, 0, "", now(), now()),
  (68, "68", 69, "68066", 42, 0, 0, "", now(), now()),
  (69, "69", 70, "69123", 82, 0, 0, "", now(), now()),
  (70, "70", 71, "70550", 43, 0, 0, "", now(), now()),
  (71, "71", 72, "71270", 26, 0, 0, "", now(), now()),
  (72, "72", 73, "72181", 52, 0, 0, "", now(), now()),
  (73, "73", 74, "73065", 82, 0, 0, "", now(), now()),
  (74, "74", 75, "74010", 82, 0, 0, "", now(), now()),
  (75, "75", 76, "75056", 11, 0, 0, "", now(), now()),
  (76, "76", 77, "76540", 23, 0, 0, "", now(), now()),
  (77, "77", 78, "77288", 11, 0, 0, "", now(), now()),
  (78, "78", 79, "78646", 11, 0, 0, "", now(), now()),
  (79, "79", 80, "79191", 54, 0, 0, "", now(), now()),
  (80, "80", 81, "80021", 22, 0, 0, "", now(), now()),
  (81, "81", 82, "81004", 73, 0, 0, "", now(), now()),
  (82, "82", 83, "82121", 73, 0, 0, "", now(), now()),
  (83, "83", 84, "83137", 93, 0, 0, "", now(), now()),
  (84, "84", 85, "84007", 93, 0, 0, "", now(), now()),
  (85, "85", 86, "85191", 52, 0, 0, "", now(), now()),
  (86, "86", 87, "86194", 54, 0, 0, "", now(), now()),
  (87, "87", 88, "87085", 74, 0, 0, "", now(), now()),
  (88, "88", 89, "88160", 41, 0, 0, "", now(), now()),
  (89, "89", 90, "89024", 26, 0, 0, "", now(), now()),
  (90, "90", 91, "90010", 43, 0, 0, "", now(), now()),
  (91, "91", 92, "91228", 11, 0, 0, "", now(), now()),
  (92, "92", 93, "92050", 11, 0, 0, "", now(), now()),
  (93, "93", 94, "93008", 11, 0, 0, "", now(), now()),
  (94, "94", 95, "94028", 11, 0, 0, "", now(), now()),
  (95, "95", 96, "95500", 11, 0, 0, "", now(), now()),
  (971, "971", 97,  "97105", 01, 0, 0, "", now(), now()),
  (972, "972", 98,  "97209", 02, 0, 0, "", now(), now()),
  (973, "973", 99,  "97302", 03, 0, 0, "", now(), now()),
  (974, "974", 100,  "97411", 04, 0, 0, "", now(), now()),
  (976, "976", 101,	"97608", 06, 0, 0, "", now(), now());

SET FOREIGN_KEY_CHECKS = 1;