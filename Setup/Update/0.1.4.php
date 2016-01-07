<?php

// Update 0.1.4.php
// execute insert sql script

$database->insertSql(
    null,
    [
        $moduleDir . DS . 'Config' . DS . 'clear.sql',
        $moduleDir . DS . 'Config' . DS . 'thelia.sql',
        $moduleDir . DS . 'Config' . DS . 'insert.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_0.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_1.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_2.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_3.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_18_0.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_18_1.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_18_2.sql',
        $moduleDir . DS . 'Config' . DS . 'insert_city_18_3.sql'
    ]
);
