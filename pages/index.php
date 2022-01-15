<?php 
    if(!isset($_COOKIE['user-auth'])){
        header("Location: login.php");
    }
    else $user = $_COOKIE['user-auth'];

    require '../inc/notes_actions.php';

    $get_user = $conn->query("SELECT * FROM users WHERE username='$user'");

    foreach($get_user as $guser){
        $bckg_color = $guser['bckg_color'];
    }

?>

<?php 
    require '../inc/header.php';

    echo "<body style='background-color: $bckg_color;'>" 
?>
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
            <button class='log-out-btn' type='submit'>
                <p>Log out</p>
                <i class='fas fa-sign-out-alt'></i>
            </button>
        </form>     
    </div>
    <div class='notes'>
        <?php   
            include '../inc/sidebar.php';

            $notes = $conn->query($sql);

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
                                <input type='hidden' value='#e63333' name='color[]'>
                                <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                                <button type='submit' style='background-color:#e63333;'></button>
                            </form>
                            <form class='color' method='post' action='index.php'>
                                <input type='hidden' value='#c562a4' name='color[]'>
                                <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                            <button type='submit' style='background-color:#c562a4;'></button>
                        </form>
                        </div>
                    </div>"
                ;}
            ?>
        </div>
        <script src="https://kit.fontawesome.com/58812d83b9.js" crossorigin="anonymous"></script>
    </body>
</html>
