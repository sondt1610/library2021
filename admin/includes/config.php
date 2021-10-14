<?php
    // DB credentials.
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'library2021');
    // Establish database connection.
    try {
        $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

    // define(all User => 最多の借りる本数と借りる日)
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/uploads/");

    define("SOLANMUON", 5);
    define("SONGAY", 10);
?>
