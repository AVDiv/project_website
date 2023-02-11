<?php
// Hosted DB config

    $url = getenv('JAWSDB_MARIA_URL');
    $dbparts = parse_url($url);

    define("HOST", $dbparts['host']);
    define("USER", $dbparts['user']);
    define("PSK", $dbparts['pass']);
    define("DB", ltrim($dbparts['path'],'/'));

// Local DB config
    // All the constants for the database transactions
//    define("HOST", "localhost");
//    define("USER", "pixi_user_8237");
//    define("PSK", "QzMKGFmPpgcE4yNe");
//    define("DB", "Pixihire");
?>