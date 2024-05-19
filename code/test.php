<?php
    $db = new PDO('../database.sql');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = file_get_contents('../database.sql');
    try {
        $db->exec($sql);
        echo "Database tables created successfully";
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
    
    $stmt = $db->prepare("INSERT INTO USER (username, email, password_) VALUES (?, ?, ?)");
    $stmt->execute(['username', 'email@example.com', 'hashed_password']);
    $db = null;
?>