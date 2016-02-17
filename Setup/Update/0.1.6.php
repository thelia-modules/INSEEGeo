<?php

// Update 0.1.6.php
// Execute sql script
// Execute clear-insert.0.1.6.sql here to be sure it's executed first

$database->insertSql(
    null,
    [
        $moduleDir . DS . 'Setup' . DS . 'Update' . DS . 'clear-insert.0.1.6.sql',
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
