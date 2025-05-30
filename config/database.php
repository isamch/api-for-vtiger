<?php

function getDatabaseConnection() {
    try {
        $host = 'localhost:8080';
        $dbname = 'vtigercrm';
        $username = 'root';
        $password = 'isamch';
        
        $dbConnection = new PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $username,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        
        return $dbConnection;
    } catch (PDOException $e) {
        error_log("Database Connection Error: " . $e->getMessage());
        throw new Exception("Database connection failed");
    }
} 