<?php 
declare(strict_types=1);

function getDatabaseConnection(): PDO {
    try {
        // Initialize the PDO instance for SQLite database connection
        $db = new PDO('sqlite:' . __DIR__ . '/../database/database.db');
        
        // Set PDO attributes
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  // Set default fetch mode to associative array
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);      // Set error mode to exceptions

        // Enable foreign key constraints
        $db->exec("PRAGMA foreign_keys = ON");

        return $db;
    } catch (PDOException $e) {
        
        error_log('Database connection failed: ' . $e->getMessage());
        throw new Exception('Failed to connect to the database');
    }
}
?>
