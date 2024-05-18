<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
$db = getDatabaseConnection();

try {
    $db->exec('DELETE FROM CHAT WHERE chatID NOT IN (SELECT chatID FROM MESSAGE_)');

} catch (PDOException $e) {
  
    error_log('Error cleaning up CHAT table: ' . $e->getMessage());
}

session_destroy();

header('Location: ../code/home.php');
exit(); 
?>
