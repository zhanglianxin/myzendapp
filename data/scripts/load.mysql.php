<?php

// scripts/load.mysql.php

/**
* Script for creating and loading database
*/

// Initialize the configuration
$global = require_once dirname(dirname(__FILE__)) . '/../config/autoload/global.php';
$local = require_once dirname(dirname(__FILE__)) . '/../config/autoload/local.php';

// Initialize and retrieve DB resource
$dsn = $global['db']['dsn'];
$username = $local['db']['username'];
$password = $local['db']['password'];
$db = new PDO($dsn, $username, $password);

// let the user know whats going on (we are actually creating a database here)
echo 'Writing Database <' . $dsn . '> in (control-c to cancel): ' . PHP_EOL;
for ($x = 5; $x > 0; $x--) {
    echo $x . "\r";
    sleep(1);
}

// this block executes the actual statements that were loaded from the schema file.
try {
    $setEncoding = 'SET NAMES \'UTF8\'';
    $db->exec($setEncoding);
    echo PHP_EOL;

    $fh = fopen(__DIR__ . '/schema.mysql.sql', 'r');
    // use the connection directly to load sql in batches
    while ($line = fread($fh, 4096)) {
        // echo $line . PHP_EOL;
        $db->exec($line);
    }

    echo PHP_EOL . 'Database Created' . PHP_EOL;

    $fh = fopen(__DIR__ . '/data.mysql.sql', 'r');
    // use the connection directly to load sql in batches
    while ($line = fread($fh, 4096)) {
        // echo $line . PHP_EOL;
        $db->exec($line);
    }

    echo PHP_EOL . 'Data Loaded.' . PHP_EOL;
} catch (Exception $e) {
    echo 'AN ERROR HAS OCCURED:' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    return false;
} finally {
}

// generally speaking, this script will be run from the command line
return true;
