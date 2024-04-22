<?php 
    declare(strict_types=1);

    function getDatabaseConnection() : PDO {
        $db = new PDO('sqlite:' .__DIR__. '/../database/database.db');
        $db->setAttributte(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttributte(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

?>