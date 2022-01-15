<?php 
        $db = new PDO("mysql:host=localhost;", "root");

        $create_db = "CREATE DATABASE IF NOT EXISTS keepnotes";

        $create_tables = "
            CREATE TABLE IF NOT EXISTS users (
            username VARCHAR(25) NOT NULL UNIQUE,
            pass VARCHAR(30) NOT NULL,
            bckg_color VARCHAR(20) DEFAULT '#1b1b1b');

            CREATE TABLE IF NOT EXISTS notes (
                note_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(25) NOT NULL,
                note_text TEXT DEFAULT NULL,
                note_title VARCHAR(30) DEFAULT 'New note',
                color VARCHAR(20) DEFAULT 'rgb(247, 243, 119)',
                CONSTRAINT FOREIGN KEY (username) REFERENCES users(username)    
            ); ";

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        try{} catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        $db->query($create_db);
?>