<?php     
    if(!isset($_COOKIE['user-auth'])){
        header("Location: login.php");
    }
    else $user = $_COOKIE['user-auth'];

    $conn = new PDO("mysql:host=localhost;dbname=keepnotes", "root");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        // echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $sql = "SELECT * FROM notes WHERE user_id = '$user' ORDER BY note_id DESC";
    $delete = $conn->prepare("DELETE FROM notes WHERE note_id = ?");
    $insert = "INSERT INTO notes (user_id, note_text) VALUES ('$user', null);";
    $update = $conn->prepare("UPDATE notes SET note_text = ?, note_title = ? WHERE note_id = ?");
    $update_color = $conn->prepare("UPDATE notes SET color = ? WHERE note_id = ?");

    $notes = $conn->query($sql);

    if(!empty($_POST)) {
        if(!empty($_POST['id'])) {
            $id = $_POST['id']; 
            $delete->bindParam(1, $id[0], PDO::PARAM_INT);
            $delete->execute();
            header("Location: index.php");
        }
        elseif(!empty($_POST['new-note'])) {
            $conn->query($insert);
            header("Location: index.php");
        }
        elseif(!empty($_POST['update_id'])){
            $updateid = $_POST['update_id'];
            $note_text = $_POST['text'];
            $note_title = $_POST['title'];
            $update->bindParam(1, $note_text[0], PDO::PARAM_STR);
            $update->bindParam(2, $note_title[0], PDO::PARAM_STR);
            $update->bindParam(3, $updateid[0], PDO::PARAM_INT);
            $update->execute();
            header("Location: index.php");
        }
        elseif(!empty($_POST['color'])){
            $color = $_POST['color'];
            $noteid = $_POST['changecolorid'];
            $update_color->bindParam(1, $color[0], PDO::PARAM_STR);
            $update_color->bindParam(2, $noteid[0], PDO::PARAM_INT);
            $update_color->execute();
            header("Location: index.php");
        }
        elseif(!empty($_POST['log-out'])){
            setcookie('user-auth', "", time()-3600);
            header("Location: login.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Keep notes</title>
</head>
<body>
    <div class='navbar'>
        <form method='post' action='index.php' class='add-new-note'>
            <input type="hidden" name='new-note' value='new-note'>
            <button type='submit'>
                <i class='fas fa-plus'></i>
                <p>Add new note</p>
            </button>
        </form>
        <h1>KeepNotes</h1>
        <form class='log-out' method='post' action='index.php'>
            <input type="hidden" name='log-out' value='log-out'>
            <button class='log-out-btn' type='submit'>Log out</button>
            <i class='fas fa-sign-out-alt'></i>
        </form>     
    </div>
    <div class='notes'>
        <?php 
        foreach($notes as $note){
            echo "
                <div class='note' style='background-color: {$note['color']}'>
                    <form method='post' action='index.php'>
                        <input type='hidden' name='id[]' value={$note["note_id"]}>
                        <button class='del-btn' type='submit'><i class='fas fa-trash'></i></button>
                    </form>

                    <form method='post' action='index.php'>
                        <input type='hidden' name='update_id[]' value={$note["note_id"]}>
                        <div class='note-title'>
                            <textarea type='text' name='title[]' id='title1' value='note-title'>{$note["note_title"]}</textarea>
                        </div>
                        <div class='note-text'>
                            <textarea name='text[]' id='text1' value='note_text'>{$note["note_text"]}</textarea>
                        </div>
                    <button class='update-btn' type='submit'>SAVE</button>
                    </form>

                    <div class='color-picker'>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='rgb(247, 243, 119)' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:rgb(247, 243, 119);'></button>
                        </form>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='teal' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:teal;'></button>
                        </form>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='#7653bb' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:#7653bb;'></button>
                        </form>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='chartreuse' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:chartreuse;'></button>
                        </form>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='yellow' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:yellow;'></button>
                        </form>
                        <form class='color' method='post' action='index.php'>
                            <input type='hidden' value='#d13c3c' name='color[]'>
                            <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:#d13c3c;'></button>
                        </form>
                    </div>
                </div>
                ";}
            ?>
        </div>
        <script src="https://kit.fontawesome.com/58812d83b9.js" crossorigin="anonymous"></script>
    </body>
</html>
