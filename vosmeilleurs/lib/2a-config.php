<?php
// SILENT NOTIFICATIONS
error_reporting(E_ALL & ~E_NOTICE);

// PATH - AUTOMATIC
// ! CHANGE IF YOU GET PATH ISSUES !
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);

// DATABASE SETTINGS
// ! CHANGE TO YOUR OWN !
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// MAX ALLOWED STARS
define('MAX_STARS', 5);
?>