<?php
    require 'db.php'; 

    
    $sql = "SELECT * FROM notes WHERE username = '$user' ORDER BY note_id DESC";
    $delete = $conn->prepare("DELETE FROM notes WHERE note_id = ?");
    $insert = "INSERT INTO notes (username, note_text) VALUES ('$user', null);";
    $update = $conn->prepare("UPDATE notes SET note_text = ?, note_title = ? WHERE note_id = ?");
    $update_color = $conn->prepare("UPDATE notes SET color = ? WHERE note_id = ?");
    $update_bckg = $conn->prepare("UPDATE users SET bckg_color = ?");

    if(isset($_POST)) {
        if(isset($_POST['id'])) {
            $id = $_POST['id']; 
            $delete->bindParam(1, $id[0], PDO::PARAM_INT);
            $delete->execute();
            header("Location: index.php");
        }
        elseif(isset($_POST['new-note'])) {
            $conn->query($insert);
            header("Location: index.php");
        }
        elseif(isset($_POST['update_id'])){
            $updateid = $_POST['update_id'];
            $note_text = $_POST['text'];
            $note_title = $_POST['title'];
            $update->bindParam(1, $note_text[0], PDO::PARAM_STR);
            $update->bindParam(2, $note_title[0], PDO::PARAM_STR);
            $update->bindParam(3, $updateid[0], PDO::PARAM_INT);
            $update->execute();
            header("Location: index.php");
        }
        elseif(isset($_POST['color'])){
            $color = $_POST['color'];
            $noteid = $_POST['changecolorid'];
            $update_color->bindParam(1, $color[0], PDO::PARAM_STR);
            $update_color->bindParam(2, $noteid[0], PDO::PARAM_INT);
            $update_color->execute();
            header("Location: index.php");
        }
        elseif(isset($_POST['bckg-color'])){
            $bcolor = $_POST['bckg-color'];
            $update_bckg->bindParam(1, $bcolor[0], PDO::PARAM_STR);
            $update_bckg->execute();
            header("Location: index.php");
        }
        elseif(isset($_POST['log-out'])){
            setcookie('user-auth', "", time()-3600);
            header("Location: login.php");
        }
    
    }
?>