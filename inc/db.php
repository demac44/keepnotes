<?php     
    require 'create_db.php';

    $conn = new PDO("mysql:host=localhost;dbname=keepnotes", "root");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{} catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $conn->query($create_tables);

?>