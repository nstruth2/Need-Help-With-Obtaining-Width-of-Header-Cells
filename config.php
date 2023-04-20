<?php
    define('USER', 'phptest');
    define('PASSWORD', 'phptest123');
    define('HOST', 'localhost');
    define('DATABASE', 'school');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
?>