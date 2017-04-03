<?php
    $dsn = 'mysql:host=sql1.njit.edu;dbname=ea242';
    $username = 'ea242';
    $password = 'genetic26';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>